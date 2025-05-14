<?php
session_start();
include('conexion.php'); // Usamos conexion.php para la conexión a la base de datos
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="catalogo_producto.css">
</head>
<body>
<div class="title-container">
    <img src="media/tempologo.png" alt="Logo" class="logo">
    <a href="carrito.php" class="carrito"></a>
    <h1>Productos</h1>
</div>

<div class="productos-container">
    <?php
    // Consulta para obtener todos los productos
    $sql = "SELECT id, marca, modelo, precio, descripcion, stock, genero, imagen FROM productos";
    $result = $conn->query($sql);

    // Verificar si hay productos
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="producto-card">';
            echo '  <div class="card-content">'; // Contenedor principal de contenido
            echo '    <div class="producto-imagen">';
            echo '      <img src="' . htmlspecialchars($row['imagen']) . '" alt="' . htmlspecialchars($row['marca']) . '">';
            echo '    </div>';
            echo '    <div class="producto-info">';
            echo '      <div class="info-item"><span class="info-label">Marca:</span> ' . htmlspecialchars($row['marca']) . '</div>';
            echo '      <div class="info-item"><span class="info-label">Modelo:</span> ' . htmlspecialchars($row['modelo']) . '</div>';
            echo '      <div class="info-item"><span class="info-label">Precio:</span> $' . htmlspecialchars($row['precio']) . '</div>';
            echo '      <div class="info-item"><span class="info-label">Descripción:</span> ' . htmlspecialchars($row['descripcion']) . '</div>';
            echo '      <div class="info-item"><span class="info-label">Stock:</span> ' . htmlspecialchars($row['stock']) . '</div>';
            echo '      <div class="info-item"><span class="info-label">Género:</span> ' . htmlspecialchars($row['genero']) . '</div>';
            echo '    </div>';
            echo '  </div>'; // Cierre de card-content

            // Formulario para agregar al carrito
            echo '  <div class="card-footer">';
            echo '    <form action="agregar_carrito.php" method="POST">';
            echo '      <input type="hidden" name="id_producto" value="' . $row['id'] . '">';
            echo '      <input type="number" class="cantidad" name="cantidad" value="1" min="1" max="' . $row['stock'] . '" required>';
            echo '      <button type="submit" class="btn-agregar">Agregar al carrito</button>';
            echo '    </form>';
            echo '  </div>';

            echo '</div>';
        }
    } else {
        echo '<p>No hay productos disponibles.</p>';
    }

    $conn->close();
    ?>
</div>

<div class="contenedor-btn-volver">
    <a href="home.php" class="btn-volver">← Volver a la página de inicio</a>
</div>

</body>
</html>