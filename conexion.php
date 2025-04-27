<?php
$servername = "localhost"; // El servidor de la base de datos, generalmente localhost
$username = "root"; // El usuario de la base de datos
$password = "123456789"; // La contraseña del usuario de la base de datos
$dbname = "TEMPOS"; // El nombre de la base de datos

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar si la conexión fue exitosa
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
echo "Conexión exitosa";
?>
