<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="catalogo.css">
</head>
<body>
<div class="title-container">
    <img src="media/tempologo.png" alt="Logo" class="logo">
    <h1>Productos</h1>
</div>

<div class="productos-container">
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "123456789";
    $dbname = "TEMPOS";

    // Crear la conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Consulta para obtener todos los productos
    $sql = "SELECT marca, modelo, precio, descripcion, stock, genero, imagen FROM productos";
    $result = $conn->query($sql);

    // Mostrar todos los productos
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="producto-card">';
            echo '  <div class="producto-imagen">';
            echo '    <img src="' . htmlspecialchars($row['imagen']) . '" alt="' . htmlspecialchars($row['marca']) . '">';
            echo '  </div>';
            echo '  <div class="producto-info">';
            echo '    <div class="info-item"><span class="info-label">Marca:</span> ' . htmlspecialchars($row['marca']) . '</div>';
            echo '    <div class="info-item"><span class="info-label">Modelo:</span> ' . htmlspecialchars($row['modelo']) . '</div>';
            echo '    <div class="info-item"><span class="info-label">Precio:</span> $' . htmlspecialchars($row['precio']) . '</div>';
            echo '    <div class="info-item"><span class="info-label">Descripción:</span> ' . htmlspecialchars($row['descripcion']) . '</div>';
            echo '    <div class="info-item"><span class="info-label">Stock:</span> ' . htmlspecialchars($row['stock']) . '</div>';
            echo '    <div class="info-item"><span class="info-label">Género:</span> ' . htmlspecialchars($row['genero']) . '</div>';
            echo '    <button class="btn-agregar">Agregar al carrito</button>';
            echo '  </div>';
            echo '</div>';
        }
    } else {
        echo '<p class="no-productos">No hay productos registrados</p>';
    }

    $conn->close();
    ?>
</div>

<div class="contenedor-btn-volver">
    <a href="home.html" class="btn-volver">
        <span class="icono-flecha">←</span>
        Volver a la página de inicio
    </a>
</div>


</body>
</html>