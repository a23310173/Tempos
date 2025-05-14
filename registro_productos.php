<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
include('conexion.php');

// Verificar conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}
// Registrar usuario en sesion_activa
if (isset($_SESSION['user_name'])) {
    $nombre_usuario = $_SESSION['user_name'];
    $conn->query("
                INSERT INTO sesion_activa (id, usuario) 
                VALUES (1, '$nombre_usuario') 
                ON DUPLICATE KEY UPDATE usuario = '$nombre_usuario'
            ");
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

        // Verificar que el usuario esté autenticado (si no está, redirigir a login)
        if (!isset($_SESSION['id_usuario'])) {
            echo "Por favor, inicie sesión para registrar un producto.";
            exit;
        }

        // Obtener el id_usuario de la sesión
        $id_usuario = $_SESSION['id_usuario'];

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
