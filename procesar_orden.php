<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
include('conexion.php'); // Tu archivo de conexión a la BD
require 'vendor/autoload.php'; // Carga las librerías de Composer (TCPDF y PHPMailer)

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

header('Content-Type: application/json'); // Asegura que la respuesta sea JSON

$response = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        $response['message'] = 'Error al decodificar JSON: ' . json_last_error_msg();
        echo json_encode($response);
        exit;
    }

    $paypal_order_id = $data['orderID'] ?? null;
    $paypal_details = $data['paypalDetails'] ?? null;

    if (!$paypal_order_id || !$paypal_details) {
        $response['message'] = 'Datos de PayPal incompletos.';
        echo json_encode($response);
        exit;
    }

    // Validación CRÍTICA: Asegúrate de que el pago esté 'COMPLETED' en los detalles de PayPal
    // En un entorno de producción, aquí también harías una llamada a la API de PayPal
    // para verificar el estado de la transacción directamente con ellos, usando el orderID.
    if (!isset($paypal_details['status']) || $paypal_details['status'] !== 'COMPLETED') {
        $response['message'] = 'Estado de pago de PayPal no es COMPLETED.';
        echo json_encode($response);
        exit;
    }

    // Obtener ID de usuario o guest_id
    $id_usuario = '';
    if (isset($_SESSION['id_usuario'])) {
        $id_usuario = $_SESSION['id_usuario'];
    } elseif (isset($_SESSION['guest_id'])) {
        $id_usuario = $_SESSION['guest_id'];
    }

    if (empty($id_usuario)) {
        $response['message'] = 'ID de usuario o invitado no encontrado en la sesión. No se puede procesar la orden.';
        echo json_encode($response);
        exit;
    }

    // Iniciar transacción de base de datos para asegurar atomicidad
    $conn->begin_transaction();

    try {
        // 1. Obtener productos del carrito para el pedido
        $sql_carrito = "SELECT p.id, p.marca, p.modelo, p.precio, c.cantidad
                        FROM carrito c
                        INNER JOIN productos p ON c.id_producto = p.id
                        WHERE c.id_usuario = ?";
        $stmt_carrito = $conn->prepare($sql_carrito);
        if (!$stmt_carrito) {
            throw new Exception("Error al preparar consulta de carrito: " . $conn->error);
        }
        $stmt_carrito->bind_param("s", $id_usuario);
        $stmt_carrito->execute();
        $result_carrito = $stmt_carrito->get_result();

        $productos_para_pedido = [];
        $total_compra = 0;
        if ($result_carrito->num_rows > 0) {
            while ($row = $result_carrito->fetch_assoc()) {
                $subtotal = $row['precio'] * $row['cantidad'];
                $total_compra += $subtotal;
                $productos_para_pedido[] = $row;
            }
        } else {
            throw new Exception("El carrito está vacío o no se encontraron productos para el ID de usuario proporcionado.");
        }
        $stmt_carrito->close();

        // Obtener nombre y email del pagador de los detalles de PayPal
        $payer_name = 'Cliente Invitado'; // Default
        $payer_email = 'no-reply@tutienda.com'; // Default

        if (isset($paypal_details['payer']) && isset($paypal_details['payer']['email_address'])) {
            $payer_email = $paypal_details['payer']['email_address'];
        }
        if (isset($paypal_details['payer']) && isset($paypal_details['payer']['name'])) {
            $payer_name = ($paypal_details['payer']['name']['given_name'] ?? '') . ' ' . ($paypal_details['payer']['name']['surname'] ?? '');
            $payer_name = trim($payer_name);
            if (empty($payer_name)) {
                $payer_name = 'Cliente ' . explode('@', $payer_email)[0]; // Usar parte del email si el nombre está vacío
            }
        }


        // 2. Insertar en la tabla 'pedidos'
        $sql_insert_pedido = "INSERT INTO pedidos (id_usuario, total_pedido, estado_pedido, paypal_order_id, nombre_cliente, email_cliente)
                              VALUES (?, ?, ?, ?, ?, ?)";
        $stmt_insert_pedido = $conn->prepare($sql_insert_pedido);
        if (!$stmt_insert_pedido) {
            throw new Exception("Error al preparar inserción de pedido: " . $conn->error);
        }
        $estado = 'Pagado'; // O 'Completado', 'Procesando'
        $stmt_insert_pedido->bind_param("sdssss", $id_usuario, $total_compra, $estado, $paypal_order_id, $payer_name, $payer_email);
        $stmt_insert_pedido->execute();
        $id_pedido = $conn->insert_id; // Obtener el ID del pedido recién insertado
        $stmt_insert_pedido->close();

        if (!$id_pedido) {
            throw new Exception("No se pudo obtener el ID del pedido insertado.");
        }

        // 3. Insertar en la tabla 'detalle_pedidos'
        $sql_insert_detalle = "INSERT INTO detalle_pedidos (id_pedido, id_producto, cantidad, precio_unitario, subtotal)
                               VALUES (?, ?, ?, ?, ?)";
        $stmt_insert_detalle = $conn->prepare($sql_insert_detalle);
        if (!$stmt_insert_detalle) {
            throw new Exception("Error al preparar inserción de detalle de pedido: " . $conn->error);
        }

        foreach ($productos_para_pedido as $producto) {
            $prod_id = $producto['id'];
            $prod_cantidad = $producto['cantidad'];
            $prod_precio = $producto['precio'];
            $prod_subtotal = $prod_precio * $prod_cantidad;
            $stmt_insert_detalle->bind_param("iiidd", $id_pedido, $prod_id, $prod_cantidad, $prod_precio, $prod_subtotal);
            $stmt_insert_detalle->execute();
        }
        $stmt_insert_detalle->close();

        // 4. Vaciar el carrito
        $sql_vaciar_carrito = "DELETE FROM carrito WHERE id_usuario = ?";
        $stmt_vaciar_carrito = $conn->prepare($sql_vaciar_carrito);
        if (!$stmt_vaciar_carrito) {
            throw new Exception("Error al preparar vaciado de carrito: " . $conn->error);
        }
        $stmt_vaciar_carrito->bind_param("s", $id_usuario);
        $stmt_vaciar_carrito->execute();
        $stmt_vaciar_carrito->close();

        $conn->commit(); // Confirmar la transacción si todo fue exitoso hasta aquí

        // 5. Enviar Email de Confirmación
        $mail = new PHPMailer(true); // Pasar `true` habilita las excepciones
        try {
            // Configuración del servidor SMTP (¡AJUSTA ESTO CON TUS DATOS REALES!)
            // Revisa la documentación de tu proveedor de correo para los detalles SMTP (Host, Puerto, Seguridad)
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com'; // Por ejemplo, para Gmail
            $mail->SMTPAuth   = true;
            $mail->Username   = 'santiagor.orozco@gmail.com'; // ¡Tu dirección de correo electrónico real!
            $mail->Password   = 'oyxgazxhoxhcsmpn'; // ¡Tu contraseña o contraseña de aplicación!
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Usar `PHPMailer::ENCRYPTION_STARTTLS` para puerto 587
            $mail->Port       = 587; // Puerto para SSL/SMTPS

            // Destinatarios
            $mail->setFrom('santiagor.orozco@gmail.com', 'Tienda Tempo'); // Desde (debe ser tu correo SMTP)
            $mail->addAddress($payer_email, $payer_name);     // A quién se envía (el cliente)

            // Contenido del correo
            $mail->isHTML(true); // Formato HTML
            $mail->Subject = 'Confirmación de tu compra en Tempo - Pedido #' . $id_pedido;
            $mail->Body    = '
                <html>
                <head>
                    <style>
                        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                        .container { width: 80%; max-width: 600px; margin: 20px auto; border: 1px solid #ddd; border-radius: 8px; overflow: hidden; }
                        .header { background-color: #10663E; color: white; padding: 20px; text-align: center; }
                        .content { padding: 20px; }
                        .footer { background-color: #f4f4f4; padding: 15px; text-align: center; font-size: 0.9em; color: #777; }
                        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
                        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                        th { background-color: #f2f2f2; }
                        .total { font-weight: bold; font-size: 1.1em; text-align: right; }
                        .logo-email { max-height: 60px; margin-bottom: 10px; }
                    </style>
                </head>
                <body>
                    <div class="container">
                        <div class="header">
                            <img src="https://i.ibb.co/SXC1CTJx/tempologo.png" alt="Logo Tempo" class="logo-email"> <h2>¡Gracias por tu compra en Tempo!</h2>
                        </div>
                        <div class="content">
                            <p>Hola <strong>' . htmlspecialchars($payer_name) . '</strong>,</p>
                            <p>Hemos recibido tu pedido <strong>#' . $id_pedido . '</strong> con éxito. Aquí tienes un resumen de tu compra:</p>

                            <h3>Detalles del Pedido</h3>
                            <p><strong>Fecha del Pedido:</strong> ' . date('d/m/Y H:i:s') . '</p>
                            <p><strong>Total Pagado:</strong> $' . number_format($total_compra, 2) . ' MXN</p>
                            <p><strong>Método de Pago:</strong> PayPal</p>

                            <h3>Productos Comprados:</h3>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Precio Unitario</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>';
            foreach ($productos_para_pedido as $item) {
                $mail->Body .= '<tr>
                                        <td>' . htmlspecialchars($item['marca'] . ' ' . $item['modelo']) . '</td>
                                        <td>' . $item['cantidad'] . '</td>
                                        <td>$' . number_format($item['precio'], 2) . '</td>
                                        <td>$' . number_format($item['precio'] * $item['cantidad'], 2) . '</td>
                                    </tr>';
            }
            $mail->Body .= '</tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="total">Total:</td>
                                        <td class="total">$' . number_format($total_compra, 2) . '</td>
                                    </tr>
                                </tfoot>
                            </table>
                            <p>Puedes ver y descargar tu ticket en cualquier momento desde <a href="https://tu_dominio.com/ticket.php?id_pedido=' . $id_pedido . '">este enlace</a>.</p> <p>¡Pronto te enviaremos actualizaciones sobre el estado de tu envío!</p>
                            <p>Saludos cordiales,<br>El equipo de Tempo.</p>
                        </div>
                        <div class="footer">
                            <p>&copy; ' . date('Y') . ' Tempo. Todos los derechos reservados.</p>
                        </div>
                    </div>
                </body>
                </html>
            ';

            $mail->send();
            $response['message'] = 'Orden registrada y correo de confirmación enviado.';
        } catch (Exception $e) {
            $response['message'] = 'Orden registrada, pero el correo no pudo ser enviado. Error de Mailer: ' . $mail->ErrorInfo;
            error_log("Error al enviar correo para pedido $id_pedido: " . $e->getMessage());
        }

        $response['success'] = true;
        $response['id_pedido'] = $id_pedido;

    } catch (Exception $e) {
        $conn->rollback(); // Revertir la transacción si algo falla
        $response['message'] = "Error al procesar la orden: " . $e->getMessage();
        $response['error'] = $e->getMessage();
        error_log("Error al procesar orden: " . $e->getMessage());
    }
} else {
    $response['message'] = 'Método no permitido.';
}

$conn->close();
echo json_encode($response);
exit;
?><?php
