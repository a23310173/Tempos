<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
include('conexion.php'); // Tu archivo de conexión a la BD
require 'vendor/autoload.php'; // Carga las librerías de Composer (TCPDF)

use TCPDF as PDF;

// Clase extendida para TCPDF para añadir encabezado/pie de página
class MYPDF extends PDF {
    // Page header
    public function Header() {
        // Logo de tu tienda
        // Asegúrate de que esta ruta sea accesible desde donde se ejecuta ticket.php
        $image_file = __DIR__ . '/media/tempologo.png'; // __DIR__ asegura la ruta absoluta desde el script
        if (file_exists($image_file)) {
            // Ajusta las coordenadas y tamaño si es necesario
            $this->Image($image_file, 15, 10, 30, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        }

        $this->SetFont('helvetica', 'B', 16);
        $this->Cell(0, 15, 'Ticket de Compra - Tempo', 0, false, 'R', 0, '', 0, false, 'M', 'M');
        $this->SetFont('helvetica', 'N', 10);
        //cENTRALIZAR LA FECHA
        $this->SetY(20); // Ajusta la posición vertical del texto
        $this->SetX(150); // Ajusta la posición horizontal del texto
        $this->Cell(0, 25, 'Fecha: ' . date('d/m/Y H:i:s'), 0, false, 'R', 0, '', 0, false, 'M', 'M');
        $this->Ln(20); // Salto de línea después del encabezado
    }

    // Page footer
    public function Footer() {
        $this->SetY(-15);
        $this->SetFont('helvetica', 'I', 8);
        $this->Cell(0, 10, 'Página ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
        $this->Cell(0, 10, 'Gracias por tu compra en Tempo.', 0, false, 'R', 0, '', 0, false, 'T', 'M');
    }
}

$id_pedido = $_GET['id_pedido'] ?? null;

if (!$id_pedido) {
    die("ID de pedido no especificado. No se puede generar el ticket.");
}

// Obtener detalles del pedido y usuario
$sql_pedido = "SELECT p.id_pedido, p.fecha_pedido, p.total_pedido, p.estado_pedido, p.nombre_cliente, p.email_cliente, p.paypal_order_id
               FROM pedidos p
               WHERE p.id_pedido = ?";
$stmt_pedido = $conn->prepare($sql_pedido);
if (!$stmt_pedido) {
    die("Error al preparar consulta de pedido: " . $conn->error);
}
$stmt_pedido->bind_param("i", $id_pedido);
$stmt_pedido->execute();
$result_pedido = $stmt_pedido->get_result();
$pedido = $result_pedido->fetch_assoc();
$stmt_pedido->close();

if (!$pedido) {
    die("Pedido no encontrado para el ID: " . htmlspecialchars($id_pedido));
}

// Obtener detalles de los productos del pedido
$sql_productos_pedido = "SELECT dp.cantidad, dp.precio_unitario, dp.subtotal, pr.marca, pr.modelo
                         FROM detalle_pedidos dp
                         INNER JOIN productos pr ON dp.id_producto = pr.id
                         WHERE dp.id_pedido = ?";
$stmt_productos = $conn->prepare($sql_productos_pedido);
if (!$stmt_productos) {
    die("Error al preparar consulta de productos del pedido: " . $conn->error);
}
$stmt_productos->bind_param("i", $id_pedido);
$stmt_productos->execute();
$result_productos = $stmt_productos->get_result();
$productos_pedido = [];
while ($row = $result_productos->fetch_assoc()) {
    $productos_pedido[] = $row;
}
$stmt_productos->close();
$conn->close();

// --- Generación del PDF con TCPDF ---

$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Establecer información del documento
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Tempo');
$pdf->SetTitle('Ticket de Compra - Pedido #' . $id_pedido);
$pdf->SetSubject('Confirmación de Compra');
$pdf->SetKeywords('TCPDF, PDF, compra, ticket, Tempo');

// Establecer márgenes
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP + 10, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// Establecer saltos de página automáticos
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// Establecer modo de subconjunto de fuentes
$pdf->setFontSubsetting(true);

// Añadir una página
$pdf->AddPage();

// Establecer fuente principal
$pdf->SetFont('helvetica', '', 11);

// Contenido HTML del PDF
$html = '
<h2 style="text-align: center; color: #10663E;">Detalles de la Compra</h2>
<p><strong>Número de Pedido:</strong> ' . htmlspecialchars($pedido['id_pedido']) . '</p>
<p><strong>Fecha del Pedido:</strong> ' . date('d/m/Y H:i:s', strtotime($pedido['fecha_pedido'])) . '</p>
<p><strong>Estado del Pedido:</strong> ' . htmlspecialchars($pedido['estado_pedido']) . '</p>
<p><strong>ID de Transacción PayPal:</strong> ' . htmlspecialchars($pedido['paypal_order_id']) . '</p>

<h3 style="color: #10663E;">Información del Cliente</h3>
<p><strong>Nombre:</strong> ' . htmlspecialchars($pedido['nombre_cliente']) . '</p>
<p><strong>Email:</strong> ' . htmlspecialchars($pedido['email_cliente']) . '</p>

<h3 style="color: #10663E;">Productos Comprados</h3>
<table border="1" cellpadding="5" cellspacing="0" style="width: 100%;">
<thead>
    <tr style="background-color: #f2f2f2;">
        <th width="40%">Producto</th>
        <th width="15%" align="center">Cantidad</th>
        <th width="20%" align="right">Precio Unitario</th>
        <th width="25%" align="right">Subtotal</th>
    </tr>
</thead>
<tbody>';

foreach ($productos_pedido as $producto) {
    $html .= '
    <tr>
        <td>' . htmlspecialchars($producto['marca'] . ' ' . $producto['modelo']) . '</td>
        <td align="center">' . $producto['cantidad'] . '</td>
        <td align="right">$' . number_format($producto['precio_unitario'], 2) . ' MXN</td>
        <td align="right">$' . number_format($producto['subtotal'], 2) . ' MXN</td>
    </tr>';
}

$html .= '
    <tr>
        <td colspan="3" align="right"><strong>Total del Pedido:</strong></td>
        <td align="right"><strong>$' . number_format($pedido['total_pedido'], 2) . ' MXN</strong></td>
    </tr>
</tbody>
</table>

<p style="text-align: center; margin-top: 30px;">
    ¡Gracias por tu preferencia!
</p>
<p style="text-align: center;">
    Para cualquier consulta, contáctanos en <a href="mailto:temposwatch@gmail.com">temposwatch@gmail.com</a>.
</p>
';

// Escribir el HTML
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// Cerrar y generar documento PDF
// 'I' para mostrar en el navegador, 'D' para descargar
$pdf->Output('ticket_compra_' . $id_pedido . '.pdf', 'I');
exit;
?><?php
