<?php
// Iniciar la sesión
session_start();

// Verificar si ya hay una sesión de usuario o un guest_id
if (!isset($_SESSION['guest_id'])) {
    // Si no existe un guest_id, crear uno
    $_SESSION['guest_id'] = uniqid('guest_');
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TEMPO</title>
    <link rel="stylesheet" href="homes.css">
    <link href="https://fonts.googleapis.com/css2?family=Title+Hero&display=swap" rel="stylesheet">
</head>
<body>
<div class="container">
    <nav class="navbar">
        <ul>
            <li><a href="productos_usuario.php">Productos</a></li>
            <li><a href="https://maps.app.goo.gl/RP6LHUu6US6wS6ov7">Ubicación</a></li>
        </ul>
        <div class="auth-buttons">
            <a href="login.html">Login</a>
            <a href="register.html">Registro</a>
        </div>
    </nav>

    <header>
        <video width="1280" height="347" autoplay muted loop>
            <source src="media/tempohome.mp4" type="video/mp4">
            Tu navegador no soporta la reproducción de videos.
        </video>
        <img src="media/tempologo.png" alt="Logo TEMPO" class="logo">
        <a href="carrito.php" class="carrito"></a>
        <div class="header-text">
            <h1>TEMPO</h1>
            <p>since 2025</p>
        </div>
    </header>

    <div class="mission-vision">
        <div class="nosotros-title">Nosotros</div>
        <div class="card">
            <h2>MISIÓN</h2>
            <p>Ofrecer relojes de alta calidad que combinen diseño, funcionalidad y artesanía, brindando una experiencia personalizada y asesoría experta para que cada cliente encuentre la pieza perfecta que refleje su estilo y personalidad, respaldados por un servicio excepcional.</p>
        </div>
        <div class="card">
            <h2>VISIÓN</h2>
            <p>Ser la tienda de relojes líder en ofrecer piezas únicas que fusionen tradición e innovación, convirtiéndonos en el referente de elegancia y precisión para nuestros clientes, mientras promovemos una cultura que valore el tiempo como un bien invaluable.</p>
        </div>
    </div>

    <div class="ubicacion">
        <h2>Ubicación</h2>
        <div class="direccion">
            <p>Nos pueden encontrar en la siguiente dirección.</p>
            <p><a href="https://maps.app.goo.gl/RP6LHUu6US6wS6ov7" target="_blank">https://maps.app.goo.gl/RP6LHUu6US6wS6ov7</a></p>
        </div>
        <img src="media/mapa.png" alt="Mapa" class="mapa">
    </div>

    <div class="social-footer">
        <a href="#" class="social-icon"><img src="media/facebook.png" alt="Facebook"></a>
        <a href="#" class="social-icon"><img src="media/x.png" alt="Twitter"></a>
        <a href="#" class="social-icon"><img src="media/instagram.png" alt="Instagram"></a>
    </div>
</div>
</body>
</html>
