<?php
require_once 'conexion.php';
session_start();

// Verificar permisos y sesión
if (!isset($_SESSION['user_name'])) {
    header("Location: login.php");
    exit;
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    $_SESSION['error'] = "ID de usuario no válido";
    header("Location: administrar_usuarios.php");
    exit;
}

// Registrar usuario en sesion_activa
$nombre_usuario = $_SESSION['user_name'];
$conn->query("
    INSERT INTO sesion_activa (id, usuario) 
    VALUES (1, '$nombre_usuario') 
    ON DUPLICATE KEY UPDATE usuario = '$nombre_usuario'
");

// Obtener datos actuales del usuario
$stmt = $conn->prepare("SELECT nombre, email, pais, ciudad FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();

if (!$usuario) {
    $_SESSION['error'] = "Usuario no encontrado";
    header("Location: administrar_usuarios.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar y sanitizar inputs
    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);
    $pais = trim($_POST['pais']);
    $ciudad = trim($_POST['ciudad']);
    $contrasena = trim($_POST['contrasena']);

    // Validar campos obligatorios
    if (empty($nombre) || empty($email)) {
        $_SESSION['error'] = "Nombre y email son campos obligatorios";
        header("Location: modificar_usuario.php?id=$id");
        exit;
    }

    // Verificar si el email ya existe (excluyendo al usuario actual)
    $stmt_check = $conn->prepare("SELECT id FROM usuarios WHERE email = ? AND id != ?");
    $stmt_check->bind_param("si", $email, $id);
    $stmt_check->execute();
    if ($stmt_check->get_result()->num_rows > 0) {
        $_SESSION['error'] = "El email ya está en uso por otro usuario";
        header("Location: modificar_usuario.php?id=$id");
        exit;
    }

    // Actualizar contraseña solo si se proporcionó una nueva
    if (!empty($contrasena)) {
        $hashedPassword = password_hash($contrasena, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE usuarios SET nombre = ?, email = ?, pais = ?, ciudad = ?, contrasena = ? WHERE id = ?");
        $stmt->bind_param("sssssi", $nombre, $email, $pais, $ciudad, $hashedPassword, $id);
    } else {
        $stmt = $conn->prepare("UPDATE usuarios SET nombre = ?, email = ?, pais = ?, ciudad = ? WHERE id = ?");
        $stmt->bind_param("ssssi", $nombre, $email, $pais, $ciudad, $id);
    }

    if ($stmt->execute()) {
        $_SESSION['success'] = "Usuario actualizado con éxito";
        header("Location: administrar_usuarios.php");
        exit;
    } else {
        $_SESSION['error'] = "Error al actualizar el usuario: " . $conn->error;
        header("Location: modificar_usuario.php?id=$id");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Usuario</title>
    <link rel="stylesheet" href="modificar_usuario.css">
</head>
<body>
<div class="container">
    <div class="title-container">
        <img src="media/tempologo.png" alt="Logo" class="logo">
        <h1>Modificar Usuario</h1>
    </div>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert error"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($usuario['nombre']) ?>" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" required>
        </div>

        <div class="form-group">
            <label for="pais">País:</label>
            <input type="text" id="pais" name="pais" value="<?= htmlspecialchars($usuario['pais']) ?>">
        </div>

        <div class="form-group">
            <label for="ciudad">Ciudad:</label>
            <input type="text" id="ciudad" name="ciudad" value="<?= htmlspecialchars($usuario['ciudad']) ?>">
        </div>

        <div class="form-group">
            <label for="contrasena">Nueva Contraseña (dejar en blanco para no cambiar):</label>
            <input type="password" id="contrasena" name="contrasena" placeholder="Nueva contraseña">
        </div>

        <div class="button-group">
            <button type="submit" class="btn-update">Actualizar</button>
            <a href="administrar_usuarios.php" class="btn-cancel">Cancelar</a>
        </div>
    </form>
</div>
</body>
</html>