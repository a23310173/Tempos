<?php
include 'conexion.php';
session_start();

// Verificar si se ha pasado un ID de producto
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Primero obtener los datos del producto para mostrar después
    $sql_select = "SELECT * FROM productos WHERE id = ?";
    $stmt_select = $conn->prepare($sql_select);
    $stmt_select->bind_param("i", $id);
    $stmt_select->execute();
    $result = $stmt_select->get_result();

    if ($result->num_rows > 0) {
        $producto = $result->fetch_assoc();

        // Registrar usuario en sesion_activa
        if (isset($_SESSION['user_name'])) {
            $nombre_usuario = $_SESSION['user_name'];
            $conn->query("
                INSERT INTO sesion_activa (id, usuario) 
                VALUES (1, '$nombre_usuario') 
                ON DUPLICATE KEY UPDATE usuario = '$nombre_usuario'
            ");
        }

        // Consulta para eliminar el producto
        $sql_delete = "DELETE FROM productos WHERE id = ?";
        $stmt_delete = $conn->prepare($sql_delete);
        $stmt_delete->bind_param("i", $id);

        if ($stmt_delete->execute()) {
            // Mostrar la imagen y datos del producto eliminado
            echo "<div class='container'>";
            echo "<h1>Producto eliminado con éxito</h1>";
            echo "<img src='" . htmlspecialchars($producto['imagen']) . "' alt='Imagen del producto eliminado' class='imagen-eliminada'>";
            echo "<div class='producto-info'>";
            echo "<p><strong>Marca:</strong> " . htmlspecialchars($producto['marca']) . "</p>";
            echo "<p><strong>Modelo:</strong> " . htmlspecialchars($producto['modelo']) . "</p>";
            echo "<p><strong>Precio:</strong> $" . number_format($producto['precio'], 2) . "</p>";
            echo "</div>";
            echo "<a href='productos_admini.php' class='btn-volver'>Volver a la lista de productos</a>";
            echo "</div>";
        } else {
            echo "<h1>Error al eliminar el producto: " . $conn->error . "</h1>";
            echo "<a href='productos_admini.php'>Volver a la lista de productos</a>";
        }

        $stmt_delete->close();
    } else {
        echo "<h1>No se encontró el producto con ID $id</h1>";
        echo "<a href='productos_admini.php'>Volver a la lista de productos</a>";
    }

    $stmt_select->close();
} else {
    echo "<h1>ID de producto no proporcionado</h1>";
    echo "<a href='productos_admini.php'>Volver a la lista de productos</a>";
}

$conn->close();
?>