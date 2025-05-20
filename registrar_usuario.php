<<?php
require_once 'conexion.php';
session_start();

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar y limpiar los datos de entrada
    $nombre = trim($_POST['nombre'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $contrasena = $_POST['contrasena'] ?? '';
    $confirmar_contrasena = $_POST['confirmar_contrasena'] ?? '';
    $pais = trim($_POST['pais'] ?? '');
    $ciudad = trim($_POST['ciudad'] ?? '');

    // Validaciones
    $errores = [];

    if (empty($nombre)) {
        $errores[] = "El nombre es obligatorio";
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "El email no es válido";
    }

    if (empty($contrasena) || strlen($contrasena) < 8) {
        $errores[] = "La contraseña debe tener al menos 8 caracteres";
    }

    if ($contrasena !== $confirmar_contrasena) {
        $errores[] = "Las contraseñas no coinciden";
    }

    // Verificar si el email ya existe
    $stmt_check = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
    $stmt_check->bind_param("s", $email);
    $stmt_check->execute();
    $stmt_check->store_result();

    if ($stmt_check->num_rows > 0) {
        $errores[] = "El email ya está registrado";
    }

    // Si no hay errores, proceder con el registro
    if (empty($errores)) {
        // Registrar usuario en sesion_activa (si es un admin registrando)
        if (isset($_SESSION['user_name'])) {
            $nombre_usuario = $_SESSION['user_name'];
            $conn->query("
                INSERT INTO sesion_activa (id, usuario) 
                VALUES (1, '$nombre_usuario') 
                ON DUPLICATE KEY UPDATE usuario = '$nombre_usuario'
            ");
        }

        // Encriptar contraseña
        $hashedPassword = password_hash($contrasena, PASSWORD_DEFAULT);

        // Insertar el nuevo usuario
        $stmt = $conn->prepare("INSERT INTO usuarios (nombre, email, contrasena, pais, ciudad) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $nombre, $email, $hashedPassword, $pais, $ciudad);

        if ($stmt->execute()) {
            $_SESSION['success'] = "Usuario registrado correctamente";

            // Si no hay sesión activa (registro público), iniciar sesión
            if (!isset($_SESSION['user_id'])) {
                $_SESSION['user_id'] = $stmt->insert_id;
                $_SESSION['user_name'] = $nombre;
                $_SESSION['user_email'] = $email;
            }

            header("Location: perfil.php");
            exit;
        } else {
            $errores[] = "Error al registrar el usuario: " . $conn->error;
        }
    }

    // Si hay errores, guardarlos en sesión
    if (!empty($errores)) {
        $_SESSION['errores'] = $errores;
        $_SESSION['datos_formulario'] = [
            'nombre' => $nombre,
            'email' => $email,
            'pais' => $pais,
            'ciudad' => $ciudad
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="css/estilos.css">
    <style>
        .error { color: red; margin-bottom: 10px; }
        .success { color: green; margin-bottom: 10px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="title-container">
        <img src="media/tempologo.png" alt="Logo" class="logo">
        <h1>Registro de Usuario</h1>
    </div>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="success"><?= htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?></div>
    <?php endif; ?>

    <?php if (isset($_SESSION['errores'])): ?>
        <div class="error-messages">
            <?php foreach ($_SESSION['errores'] as $error): ?>
                <div class="error"><?= htmlspecialchars($error) ?></div>
            <?php endforeach; ?>
            <?php unset($_SESSION['errores']); ?>
        </div>
    <?php endif; ?>

    <form method="post" action="registrar_usuario.php">
        <div class="form-group">
            <label for="nombre">Nombre completo:</label>
            <input type="text" id="nombre" name="nombre"
                   value="<?= htmlspecialchars($_SESSION['datos_formulario']['nombre'] ?? '') ?>" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email"
                   value="<?= htmlspecialchars($_SESSION['datos_formulario']['email'] ?? '') ?>" required>
        </div>

        <div class="form-group">
            <label for="contrasena">Contraseña (mínimo 8 caracteres):</label>
            <input type="password" id="contrasena" name="contrasena" required>
        </div>

        <div class="form-group">
            <label for="confirmar_contrasena">Confirmar contraseña:</label>
            <input type="password" id="confirmar_contrasena" name="confirmar_contrasena" required>
        </div>

        <div class="form-group">
            <label for="pais">País (opcional):</label>
            <input type="text" id="pais" name="pais"
                   value="<?= htmlspecialchars($_SESSION['datos_formulario']['pais'] ?? '') ?>">
        </div>

        <div class="form-group">
            <label for="ciudad">Ciudad (opcional):</label>
            <input type="text" id="ciudad" name="ciudad"
                   value="<?= htmlspecialchars($_SESSION['datos_formulario']['ciudad'] ?? '') ?>">
        </div>

        <div class="form-group">
            <button type="submit">Registrarse</button>
        </div>
    </form>

    <p>¿Ya tienes una cuenta? <a href="login.php">Inicia sesión aquí</a></p>
</div>
</body>
</html>
<?php
// Limpiar datos del formulario después de mostrarlos
if (isset($_SESSION['datos_formulario'])) {
    unset($_SESSION['datos_formulario']);
}
?>?php
