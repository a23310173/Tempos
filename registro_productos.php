<?php

$servername = "localhost"; // El servidor de la base de datos, generalmente localhost
$username = "root"; // El usuario de la base de datos
$password = "123456789"; // La contraseña del usuario de la base de datos
$dbname = "TEMPOS"; // El nombre de la base de datos

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

$marca = $_POST['marca'];
$modelo = $_POST['modelo'];
$precio = $_POST['precio'];
$descripcion = $_POST['descripcion'];
$stock = $_POST['stock'];
$genero = $_POST['genero'];
$imagen = $_POST['imagen'];

$sql = mysqli_query($conn, "INSERT INTO productos (marca, modelo, precio, descripcion, stock, genero, imagen) VALUES ('$marca', '$modelo', $precio, '$descripcion', $stock, '$genero', '$imagen')");

if ($sql){
    echo "Producto registrado";
} else {
    echo "Error al registrar producto";
}

mysqli_close($conn);

?>