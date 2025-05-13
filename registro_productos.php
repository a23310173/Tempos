<?php

$servername = "localhost";
$username = "root";
$password = "123456789";
$dbname = "TEMPOS";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validar y sanitizar los inputs
    $marca = htmlspecialchars(trim($_POST['marca']));
    $modelo = htmlspecialchars(trim($_POST['modelo']));
    $precio = filter_var($_POST['precio'], FILTER_VALIDATE_FLOAT);
    $descripcion = htmlspecialchars(trim($_POST['descripcion']));
    $stock = filter_var($_POST['stock'], FILTER_VALIDATE_INT);
    $genero = htmlspecialchars(trim($_POST['genero']));
    $imagen = htmlspecialchars(trim($_POST['imagen']));

    // Verificar que no haya campos vacíos
    if ($marca && $modelo && $precio !== false && $descripcion && $stock !== false && $genero && $imagen) {

        // Preparar la consulta para evitar SQL Injection
        $stmt = $conn->prepare("INSERT INTO productos (marca, modelo, precio, descripcion, stock, genero, imagen) 
                                VALUES (?, ?, ?, ?, ?, ?, ?)");

        if ($stmt) {
            // Vincular parámetros
            $stmt->bind_param("ssdisss", $marca, $modelo, $precio, $descripcion, $stock, $genero, $imagen);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                echo "Producto registrado correctamente.";
            } else {
                echo "Error al registrar el producto: " . $stmt->error;
            }

            // Cerrar la declaración
            $stmt->close();
        } else {
            echo "Error en la preparación de la consulta: " . $conn->error;
        }

    } else {
        echo "Por favor, complete todos los campos correctamente.";
    }

}

// Cerrar la conexión
$conn->close();

?>
