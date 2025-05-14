<?php
require_once 'conexion.php';
session_start();

// Verificar sesión y permisos
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
$update_sesion = $conn->prepare("
    INSERT INTO sesion_activa (id, usuario) 
    VALUES (1, ?) 
    ON DUPLICATE KEY UPDATE usuario = ?
");
$update_sesion->bind_param("ss", $nombre_usuario, $nombre_usuario);
$update_sesion->execute();

// Obtener datos del usuario a eliminar
$sql = "SELECT id, nombre, email, pais, ciudad FROM usuarios WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();

if (!$usuario) {
    $_SESSION['error'] = "Usuario no encontrado";
    header("Location: administrar_usuarios.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirmar'])) {
    // Verificar token CSRF
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $_SESSION['error'] = "Token de seguridad inválido";
        header("Location: administrar_usuarios.php");
        exit;
    }

    $sql = "DELETE FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Usuario eliminado correctamente";
        header("Location: administrar_usuarios.php");
        exit;
    } else {
        $_SESSION['error'] = "Error al eliminar el usuario: " . $conn->error;
        header("Location: eliminar_usuario.php?id=$id");
        exit;
    }
}

// Generar token CSRF
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Usuario</title>
    <link rel="stylesheet" href="eliminar_usuario.css">
</head>
<body>

<div class="container">
    <div class="title-container">
        <img src="media/tempologo.png" alt="Logo" class="logo">
        <h1>Eliminar Usuario</h1>
    </div>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert error"><?= htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <div class="delete-container">
        <?php if (isset($usuario)): ?>
            <div class="info">
                <p><strong>ID:</strong> <?= htmlspecialchars($usuario['id']) ?></p>
                <p><strong>Nombre:</strong> <?= htmlspecialchars($usuario['nombre']) ?></p>
                <p><strong>Email:</strong> <?= htmlspecialchars($usuario['email']) ?></p>
                <?php if (!empty($usuario['pais'])): ?>
                    <p><strong>País:</strong> <?= htmlspecialchars($usuario['pais']) ?></p>
                <?php endif; ?>
                <?php if (!empty($usuario['ciudad'])): ?>
                    <p><strong>Ciudad:</strong> <?= htmlspecialchars($usuario['ciudad']) ?></p>
                <?php endif; ?>
            </div>

            <div class="message warning">
                ¿Estás seguro de que deseas eliminar este usuario? Esta acción no se puede deshacer.
            </div>

            <form method="post">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
                <div class="button-group">
                    <button type="submit" name="confirmar" class="btn-confirmar">Confirmar Eliminación</button>
                    <a href="administrar_usuarios.php" class="btn-cancelar">Cancelar</a>
                </div>
            </form>
        <?php endif; ?>
    </div>
</div>

</body>
</html>