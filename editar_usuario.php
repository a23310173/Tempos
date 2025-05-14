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

$user = $result->fetch_assoc();

// Procesar el formulario de modificación
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $pais = $_POST['pais'];
    $ciudad = $_POST['ciudad'];
    $contrasena = $_POST['contrasena'];

    // Actualizar los datos
    if (!empty($contrasena)) {
        $contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);
        $update_sql = "UPDATE usuarios SET nombre = ?, pais = ?, ciudad = ?, contrasena = ? WHERE id = ?";
        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param("ssssi", $nombre, $pais, $ciudad, $contrasena_hash, $id_usuario);
    } else {
        $update_sql = "UPDATE usuarios SET nombre = ?, pais = ?, ciudad = ? WHERE id = ?";
        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param("sssi", $nombre, $pais, $ciudad, $id_usuario);
    }

    if ($stmt->execute()) {
        header('Location: vista_usuario.php');
        exit();
    } else {
        echo "Error al actualizar los datos.";
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="editar_usuario.css">
</head>
<body>

<div class="title-container">
    <img src="media/tempologo.png" alt="Logo" class="logo">
    <h1>Editar Datos de Usuario</h1>
</div>

<form method="POST" class="edit-form">
    <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($user['nombre']); ?>" required>
    </div>

    <div class="form-group">
        <label for="correo">Correo:</label>
        <input type="email" id="correo" name="correo" value="<?php echo htmlspecialchars($user['email']); ?>" disabled>
    </div>

    <div class="form-group">
        <label for="pais">País:</label>
        <input type="text" id="pais" name="pais" value="<?php echo htmlspecialchars($user['pais']); ?>" required>
    </div>

    <div class="form-group">
        <label for="ciudad">Ciudad:</label>
        <input type="text" id="ciudad" name="ciudad" value="<?php echo htmlspecialchars($user['ciudad']); ?>" required>
    </div>

    <div class="form-group">
        <label for="contrasena">Nueva Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena">
        <small>Deja este campo vacío si no deseas cambiar la contraseña.</small>
    </div>

    <div class="button-group">
        <button type="submit" class="btn-guardar">Guardar Cambios</button>
        <a href="vista_usuario.php" class="btn-cancelar">Cancelar</a>
    </div>
</form>

</body>
</html>

<?php $conn->close(); ?>
