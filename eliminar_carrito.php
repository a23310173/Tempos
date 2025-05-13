<?php
session_start();
include 'conexion.php';

if (isset($_GET['id'])) {
    $id_producto = $_GET['id'];

    // Verificar si el usuario está logueado
    if (isset($_SESSION['id_usuario'])) {
        $id_usuario = $_SESSION['id_usuario'];
    } else {
        // Si no está logueado, usar sesión guest
        $id_usuario = 'guest';
    }

    // Eliminar el producto del carrito
    $sql = "DELETE FROM carrito WHERE id_producto = ? AND id_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $id_producto, $id_usuario);
    $stmt->execute();

    // Redirigir al carrito
    header('Location: carrito.php');
    exit();
}

$conn->close();
?>
<?php
