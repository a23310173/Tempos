<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos (Vista de administrador)</title>
    <link rel="stylesheet" href="productos_admin.css">
</head>
<body>
<div class="title-container">
    <img src="media/tempologo.png" alt="Logo" class="logo">
    <h1>Productos</h1>
</div>
<table class="productos-table">
    <tr>
        <th>Marca</th>
        <th>Modelo</th>
        <th>Precio</th>
        <th>Descripción</th>
        <th>Stock</th>
        <th>Género</th>
        <th>Imagen</th>
    </tr>
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
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['marca']) . "</td>";
            echo "<td>" . htmlspecialchars($row['modelo']) . "</td>";
            echo "<td>" . htmlspecialchars($row['precio']) . "</td>";
            echo "<td>" . htmlspecialchars($row['descripcion']) . "</td>";
            echo "<td>" . htmlspecialchars($row['stock']) . "</td>";
            echo "<td>" . htmlspecialchars($row['genero']) . "</td>";
            // Mostrar imagen directamente desde la URL almacenada
            echo "<td><a href='" . htmlspecialchars($row['imagen']) . "' target='_blank'>Enlace</a></td>";;
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No hay productos registrados</td></tr>";
    }

    $conn->close();
    ?>
</table>
<a href="home.html">Volver a la página de inicio</a>
</body>
</html>