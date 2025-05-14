<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
include('conexion.php');

// Verificar si el usuario ha iniciado sesión o es un guest
if (isset($_SESSION['id_usuario'])) {
    $id_usuario = $_SESSION['id_usuario'];
} else {
    if (!isset($_SESSION['guest_id'])) {
        $_SESSION['guest_id'] = uniqid('guest_');
    }
    $id_usuario = $_SESSION['guest_id'];
}

// Consulta para obtener los productos del carrito
$sql = "SELECT p.marca, p.modelo, p.precio, c.cantidad, c.id_producto
        FROM carrito c
        INNER JOIN productos p ON c.id_producto = p.id
        WHERE c.id_usuario = ?";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Error en la consulta: " . $conn->error); // Si la preparación falla, terminamos con el error
}
$stmt->bind_param("s", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="carritod.css">
</head>
<body>

<div class="title-container">
    <img src="media/tempologo.png" alt="Logo" class="logo">
    <h1>Carrito de Compras</h1>
</div>

<?php if ($result->num_rows > 0): ?>
    <table>
        <thead>
        <tr>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Total</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['marca'] . " " . $row['modelo']); ?></td>
                <td><?php echo $row['cantidad']; ?></td>
                <td><?php echo number_format($row['precio'], 2); ?></td>
                <td><?php echo number_format($row['precio'] * $row['cantidad'], 2); ?></td>
                <td>
                    <a href="eliminar_carrito.php?id=<?php echo $row['id_producto']; ?>" class="btn-eliminar">Eliminar</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No hay productos en tu carrito.</p>
<?php endif; ?>

<!-- Botón "Volver" -->
<a href="productos_usuario.php">Volver a la tienda</a>

<!-- Botón "Comprar" -->
<a href="compra.php">Comprar</a>

<?php $stmt->close(); ?>
</body>
</html>

<?php $conn->close(); ?>
