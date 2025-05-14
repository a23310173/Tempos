<?php
require_once 'conexion.php';
session_start();

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    $stmt = $conn->prepare("SELECT id, nombre, email, pais, ciudad FROM usuarios WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $usuario = $result->fetch_assoc();

    if (!$usuario) {
        die("Usuario no encontrado");
    }
} else {
    die("ID no válido");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar campos requeridos
    if (empty($_POST['nombre']) || empty($_POST['email'])) {
        die("Nombre y email son campos obligatorios");
    }

    // Obtener datos del formulario
    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
    $email = trim($_POST['email']);
    $pais = !empty($_POST['pais']) ? trim($_POST['pais']) : null;
    $ciudad = !empty($_POST['ciudad']) ? trim($_POST['ciudad']) : null;
    $contrasena = !empty($_POST['contrasena']) ? trim($_POST['contrasena']) : null;

    // ID del usuario que realiza la modificación (si existe sesión)
    $id_modificador = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : null;

    try {
        if ($contrasena) {
            $hashedPassword = password_hash($contrasena, PASSWORD_DEFAULT);
            $query = "UPDATE usuarios SET nombre=?, email=?, pais=?, ciudad=?, contrasena=?, id_usuario=? WHERE id=?";
            $stmt = $conn->prepare($query);
            // Manejar NULL para id_usuario correctamente
            if ($id_modificador === null) {
                $stmt->bind_param("sssssii", $nombre, $email, $pais, $ciudad, $hashedPassword, $id_modificador, $id);
            } else {
                $stmt->bind_param("sssssii", $nombre, $email, $pais, $ciudad, $hashedPassword, $id_modificador, $id);
            }
        } else {
            $query = "UPDATE usuarios SET nombre=?, email=?, pais=?, ciudad=?, id_usuario=? WHERE id=?";
            $stmt = $conn->prepare($query);
            // Manejar NULL para id_usuario correctamente
            if ($id_modificador === null) {
                $stmt->bind_param("ssssii", $nombre, $email, $pais, $ciudad, $id_modificador, $id);
            } else {
                $stmt->bind_param("ssssii", $nombre, $email, $pais, $ciudad, $id_modificador, $id);
            }
        }

        if ($stmt->execute()) {
            // Verificar si realmente se actualizó algún registro
            if ($stmt->affected_rows > 0) {
                header("Location: administrar_usuarios.php?success=1");
            } else {
                header("Location: modificar_usuario.php?id=$id&info=1");
            }
            exit();
        } else {
            throw new Exception("Error al actualizar: " . $stmt->error);
        }
    } catch (Exception $e) {
        die("Error: " . $e->getMessage());
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

    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success">Usuario actualizado correctamente</div>
    <?php endif; ?>

    <?php if (isset($_GET['info'])): ?>
        <div class="alert alert-info">No se realizaron cambios en el usuario</div>
    <?php endif; ?>

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
</div>
</body>
</html>