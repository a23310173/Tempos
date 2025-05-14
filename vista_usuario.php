<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
include('conexion.php');

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['id_usuario'])) {
    header('Location: login.php');
    exit();
}

$id_usuario = $_SESSION['id_usuario'];

// Consulta para obtener los datos del usuario
$sql = "SELECT nombre, email, pais, ciudad FROM usuarios WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();

// Si no se encuentra el usuario, redirigir a login
if ($result->num_rows == 0) {
    header('Location: login.php');
    exit();
}
$nombre_usuario = $_SESSION['user_name'];

// Actualizar o insertar en la tabla sesion_activa
$conn->query("
    INSERT INTO sesion_activa (id, usuario) 
    VALUES (1, '$nombre_usuario') 
    ON DUPLICATE KEY UPDATE usuario = '$nombre_usuario'
");

// Verificar si es administrador
$sql_admin = "SELECT id FROM administradores WHERE nombre = ?";
$stmt_admin = $conn->prepare($sql_admin);
$stmt_admin->bind_param("s", $nombre_usuario);
$stmt_admin->execute();
$result_admin = $stmt_admin->get_result();

if ($result_admin->num_rows > 0) {
    header('Location: vista_administrador.php');
    exit();
}

$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista de Usuario</title>
    <link rel="stylesheet" href="vista_usuario.css">
</head>
<body>

<div class="title-container">
    <img src="media/tempologo.png" alt="Logo" class="logo">
    <h1>Bienvenido, <?php echo htmlspecialchars($user['nombre']); ?></h1>
</div>

<div class="user-info">
    <h2>Información de tu cuenta</h2>
    <p><strong>Nombre:</strong> <?php echo htmlspecialchars($user['nombre']); ?></p>
    <p><strong>Correo:</strong> <?php echo htmlspecialchars($user['email']); ?></p> <!-- Corregido aquí -->
    <p><strong>País:</strong> <?php echo htmlspecialchars($user['pais']); ?></p>
    <p><strong>Ciudad:</strong> <?php echo htmlspecialchars($user['ciudad']); ?></p>
</div>

<div class="button-group">
    <a href="logout.php" class="btn-logout">Logout</a>
    <a href="editar_usuario.php" class="btn-modificar">Modificar Datos</a> <!-- Enlace corregido -->
</div>

</body>
</html>

<?php $conn->close(); ?>
