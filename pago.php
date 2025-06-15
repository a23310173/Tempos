<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
include('conexion.php'); // Asegúrate de que 'conexion.php' esté en la misma carpeta o la ruta sea correcta.

// Verificar si el usuario ha iniciado sesión o es un guest
if (isset($_SESSION['id_usuario'])) {
    $id_usuario = $_SESSION['id_usuario'];
} else {
    // Si no hay sesión de usuario, verifica o crea un ID de invitado
    if (!isset($_SESSION['guest_id'])) {
        $_SESSION['guest_id'] = uniqid('guest_'); // Genera un ID único para el invitado
    }
    $id_usuario = $_SESSION['guest_id'];
}

// Consulta para obtener los productos del carrito del usuario/guest
$sql = "SELECT p.marca, p.modelo, p.precio, c.cantidad, c.id_producto
        FROM carrito c
        INNER JOIN productos p ON c.id_producto = p.id
        WHERE c.id_usuario = ?";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Error en la preparación de la consulta: " . $conn->error);
}
$stmt->bind_param("s", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();

$total_compra = 0;
$productos_carrito = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $subtotal = $row['precio'] * $row['cantidad'];
        $total_compra += $subtotal;
        $productos_carrito[] = $row; // Almacena los productos para mostrarlos en el resumen
    }
}
$stmt->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalizar Compra - Tempo</title>
    <link rel="stylesheet" href="pago.css">

    <script src="https://www.paypal.com/sdk/js?client-id=AYJqwmjwBaOrnwOXMCRhg7zTjrZ3bE2efjEExmut5IQfI82sItArIoOkasGdXxLWYcbl_e2aiu0EtdQC&currency=MXN"></script>

</head>
<body>

<div class="container">
    <div class="header-pago">
        <img src="media/tempologo.png" alt="Logo Tempo" class="logo-pago">
        <h1>Finalizar Compra</h1>
    </div>

    <div class="payment-summary">
        <h2>Resumen del Pedido</h2>
        <?php if (!empty($productos_carrito)): ?>
            <ul>
                <?php foreach ($productos_carrito as $producto): ?>
                    <li>
                        <span><?php echo htmlspecialchars($producto['marca'] . " " . $producto['modelo']); ?> x <?php echo $producto['cantidad']; ?></span>
                        <span>$<?php echo number_format($producto['precio'] * $producto['cantidad'], 2); ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
            <div class="total">
                <span>Total a Pagar:</span>
                <span>$<?php echo number_format($total_compra, 2); ?></span>
            </div>
        <?php else: ?>
            <p>No hay productos en tu carrito para procesar el pago.</p>
            <a href="productos_usuario.php" class="btn-back">Volver a la tienda</a>
        <?php endif; ?>
    </div>

    <?php if (!empty($productos_carrito)): ?>
        <div class="payment-form-container">
            <h2>Selecciona tu Método de Pago</h2>
            <div class="paypal-option">
                <p>Haz clic en el botón de PayPal para completar tu compra.</p>
                <div id="paypal-button-container"></div>
                <div id="payment-message" class="payment-message"></div>
            </div>
        </div>
    <?php endif; ?>

    <button type="button" class="btn-cancel" onclick="window.history.back();">Cancelar Compra</button>

</div>

<script src="pago.js"></script>
</body>
</html>

<?php $conn->close(); ?>
