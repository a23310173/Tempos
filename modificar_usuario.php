<?php
require_once 'conexion.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    $stmt = $conn->prepare("SELECT nombre, email, pais, ciudad, contrasena FROM usuarios WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $usuario = $result->fetch_assoc();

    if (!$usuario) {
        echo "<div class='message error'>Usuario no encontrado.</div>";
        exit;
    }
} else {
    echo "<div class='message error'>ID no válido.</div>";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);
    $pais = trim($_POST['pais']);
    $ciudad = trim($_POST['ciudad']);
    $contrasena = trim($_POST['contrasena']);

    if (!empty($contrasena)) {
        $hashedPassword = password_hash($contrasena, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("UPDATE usuarios SET nombre = ?, email = ?, pais = ?, ciudad = ?, contrasena = ? WHERE id = ?");
        $stmt->bind_param("sssssi", $nombre, $email, $pais, $ciudad, $hashedPassword, $id);
    } else {
        $stmt = $conn->prepare("UPDATE usuarios SET nombre = ?, email = ?, pais = ?, ciudad = ? WHERE id = ?");
        $stmt->bind_param("ssssi", $nombre, $email, $pais, $ciudad, $id);
    }

    if ($stmt->execute()) {
        echo "<div class='message success'>Usuario actualizado con éxito.</div>";
    } else {
        echo "<div class='message error'>Error al actualizar el usuario.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Usuario</title>
    <link rel="stylesheet" href="modificar_usuario.css">
</head>
<body>

<div class="title-container">
    <img src="media/tempologo.png" alt="Logo" class="logo">
    <h1>Modificar Usuario</h1>
</div>

<form method="POST">
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($usuario['nombre']) ?>" required>

    <label for="email">Email:</label>
    <input type="text" id="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" required>

    <label for="pais">País:</label>
    <input type="text" id="pais" name="pais" value="<?= htmlspecialchars($usuario['pais']) ?>">

    <label for="ciudad">Ciudad:</label>
    <input type="text" id="ciudad" name="ciudad" value="<?= htmlspecialchars($usuario['ciudad']) ?>">

    <label for="contrasena">Nueva Contraseña (dejar en blanco para no cambiar):</label>
    <input type="password" id="contrasena" name="contrasena" placeholder="Nueva contraseña">

    <div class="button-group">
        <button type="submit" class="btn-update">Actualizar</button>
        <a href="administrar_usuarios.php" class="btn-cancel">Cancelar</a>
    </div>
</form>

</body>
</html>
