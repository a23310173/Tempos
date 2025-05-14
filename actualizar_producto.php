<?php
include 'conexion.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['id'];
    $marca = trim($_POST['marca']);
    $modelo = trim($_POST['modelo']);
    $precio = $_POST['precio'];
    $descripcion = trim($_POST['descripcion']);
    $stock = $_POST['stock'];
    $genero = $_POST['genero'];
    $imagen = trim($_POST['imagen']);

    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $nombre_usuario = $_SESSION['user_name'];

    // Actualizar o insertar en la tabla sesion_activa
    $conn->query("
    INSERT INTO sesion_activa (id, usuario) 
    VALUES (1, '$nombre_usuario') 
    ON DUPLICATE KEY UPDATE usuario = '$nombre_usuario'
");
    // Consulta de actualización
    $sql = "UPDATE productos 
            SET marca = ?, modelo = ?, precio = ?, descripcion = ?, stock = ?, genero = ?, imagen = ? 
            WHERE id = ?";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Error en preparación: " . $conn->error);
    }

    $stmt->bind_param("ssdsissi", $marca, $modelo, $precio, $descripcion, $stock, $genero, $imagen, $id);

    if ($stmt->execute()) {
        header("Location: productos_admini.php?msg=Producto actualizado correctamente");
        exit();
    } else {
        echo "<p style='color:red;'>Error al actualizar: " . $stmt->error . "</p>";
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: productos_admini.php");
    exit();
}

?>
