<?php
// Iniciar la sesión
session_start();

// Incluir la conexión a la base de datos
include('conexion.php');

// Verificar si el usuario ha iniciado sesión
if (isset($_SESSION['id_usuario'])) {
    $id_usuario = $_SESSION['id_usuario'];  // El ID del usuario logueado
} else {
    // Si no hay sesión, asignamos un ID de invitado
    if (!isset($_SESSION['guest_id'])) {
        // Generar un ID único para el carrito del invitado
        $_SESSION['guest_id'] = uniqid('guest_');
    }
    $id_usuario = $_SESSION['guest_id'];  // Usamos el ID del invitado
}

// Consulta para obtener los productos del carrito
$sql = "SELECT p.nombre, p.precio, c.cantidad
        FROM carrito c
        INNER JOIN productos p ON c.id_producto = p.id
        WHERE c.id_usuario = ?";

$stmt = $conn->prepare($sql);
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
    <link rel="stylesheet" href="carrito.css">
</head>
<body>
<h1>Carrito de Compras</h1>

<?php if ($result->num_rows > 0): ?>
    <table>
        <thead>
        <tr>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                <td><?php echo $row['cantidad']; ?></td>
                <td><?php echo number_format($row['precio'], 2); ?></td>
                <td><?php echo number_format($row['precio'] * $row['cantidad'], 2); ?></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No hay productos en tu carrito.</p>
<?php endif; ?>

<a href="home.php">Volver a la tienda</a>

<?php $stmt->close(); ?>
</body>
</html>

<?php
// Cerrar la conexión
$conn->close();
?>
