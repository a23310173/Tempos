<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Producto</title>
    <link rel="stylesheet" href="eliminar_producto.css">

</head>
<body>

    <?php
    include 'conexion.php';
    // Verificar si se ha pasado un ID de producto
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Consulta para eliminar el producto por ID
        $sql = "DELETE FROM productos WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            //MOstrar la imagen del producto eliminado
            $sql = "SELECT imagen FROM productos WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo "<img src='" . htmlspecialchars($row['imagen']) . "' alt='Imagen del producto eliminado' class='imagen-eliminada'>";
            } else {
                echo "<h1>No se encontró la imagen del producto eliminado.</h1>";
            }
            // Mensaje de éxito
            echo "<h1>Producto eliminado con éxito.</h1>";
            echo "<a href='productos_admini.php'>Volver a la lista de productos</a>";
        } else {
            echo "<h1>Error al eliminar el producto.</h1>";
            echo "<a href='productos_admini.php'>Volver a la lista de productos</a>";
        }

        $stmt->close();
    } else {
        echo "<h1>ID de producto no proporcionado.</h1>";
    }
    $conn->close();
    ?>

</body>