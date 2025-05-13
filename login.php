<?php
// Iniciar la sesión
session_start();

// Incluir la conexión a la base de datos
include('conexion.php');

// Procesar el formulario de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['contrasena']; // Debe coincidir con el nombre en el formulario

    // Consulta para verificar el usuario
    $sql = "SELECT id, nombre, contrasena FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verificar la contraseña encriptada
        if (password_verify($password, $row['contrasena'])) {
            // Inicio de sesión exitoso
            $_SESSION['id_usuario'] = $row['id'];  // Guardamos el id del usuario en la sesión
            $_SESSION['user_name'] = $row['nombre'];

            // Redirigir al carrito o a la página deseada
            header("Location: home.php"); // La redirección puede cambiar dependiendo de si es un usuario logueado o invitado
            exit();
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Usuario no encontrado.";
    }

    $stmt->close();
}

// Cerrar la conexión
$conn->close();
?>
