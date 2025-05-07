<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y mostrar datos para depuración
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    $id = $_POST['id'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $precio = $_POST['precio'];
    $descripcion = $_POST['descripcion'];
    $stock = $_POST['stock'];
    $genero = $_POST['genero'];
    $imagen = $_POST['imagen'];

    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Consulta para ver el producto actual
    $sql_select = "SELECT * FROM productos WHERE id = ?";
    $stmt_select = $conn->prepare($sql_select);
    $stmt_select->bind_param("i", $id);
    $stmt_select->execute();
    $result = $stmt_select->get_result();
    $producto_actual = $result->fetch_assoc();

    echo "<h2>Valores actuales en BD:</h2>";
    echo "<pre>";
    print_r($producto_actual);
    echo "</pre>";

    // Consulta de actualización
    $sql = "UPDATE productos SET marca=?, modelo=?, precio=?, descripcion=?, stock=?, genero=?, imagen=? WHERE id=?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Error en preparación: " . $conn->error);
    }

    $stmt->bind_param("ssdsissi", $marca, $modelo, $precio, $descripcion, $stock, $genero, $imagen, $id);


    if ($stmt->execute()) {
        echo "<p style='color:green;'>Actualización exitosa!</p>";

        // Verificar los valores actualizados
        $stmt_select->execute();
        $result = $stmt_select->get_result();
        $producto_actualizado = $result->fetch_assoc();

        echo "<h2>Valores después de actualizar:</h2>";
        echo "<pre>";
        print_r($producto_actualizado);
        echo "</pre>";

        // Redirigir después de 5 segundos para ver la depuración
        echo "<script>setTimeout(function(){ window.location.href='productos_admini.php'; }, 0);</script>";
    } else {
        echo "<p style='color:red;'>Error al actualizar: " . $stmt->error . "</p>";
    }

    $stmt->close();
    $stmt_select->close();
    $conn->close();
} else {
    header("Location: productos_admini.php");
    exit();
}
?>


