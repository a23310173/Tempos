<?php
require_once 'conexion.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    $sql = "SELECT id, nombre, email FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $usuario = $result->fetch_assoc();

    if (!$usuario) {
        echo "<div class='message error'>Usuario no encontrado.</div>";
    }
} else {
    echo "<div class='message error'>ID de usuario no válido.</div>";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['confirmar'])) {
        $sql = "DELETE FROM usuarios WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo "<div class='message success'>Usuario eliminado correctamente.</div>";
            header("Location: administrar_usuarios.php");
            exit;
        } else {
            echo "<div class='message error'>Error al eliminar el usuario.</div>";
        }
    } else {
        header("Location: administrar_usuarios.php");
        exit;
    }
}
?>

    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Eliminar Usuario</title>
        <link rel="stylesheet" href="eliminar_usuario.css">
    </head>
    <body>

    <div class="title-container">
        <img src="media/tempologo.png" alt="Logo" class="logo">
        <h1>Eliminar Usuario</h1>
    </div>

    <div class="delete-container">
        <?php if (isset($usuario)): ?>
            <div class="info">
                <p><strong>ID:</strong> <?= htmlspecialchars($usuario['id']) ?></p>
                <p><strong>Nombre:</strong> <?= htmlspecialchars($usuario['nombre']) ?></p>
                <p><strong>Email:</strong> <?= htmlspecialchars($usuario['email']) ?></p>
            </div>

            <div class="message warning">
                ¿Estás seguro de que deseas eliminar este usuario? Esta acción no se puede deshacer.
            </div>

            <form method="post">
                <div class="button-group">
                    <button type="submit" name="confirmar" class="btn-confirmar">Eliminar</button>
                    <a href="administrar_usuarios.php" class="btn-cancelar">Cancelar</a>
                </div>
            </form>
        <?php endif; ?>
    </div>

    </body>
    </html>
<?php
