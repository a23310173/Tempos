<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link rel="stylesheet" href="administrar_usuarios.css"> <!-- Mantienes el mismo CSS -->
</head>
<body>

<div class="title-container">
    <img src="media/tempologo.png" alt="Logo" class="logo">
    <h1>Usuarios</h1>
</div>

<div class="usuarios-container">
    <?php
    require_once 'conexion.php';  // Asegúrate de que este archivo esté correcto

    // Consulta para obtener todos los usuarios
    $sql = "SELECT id, nombre, email, pais, ciudad FROM usuarios";
    $result = $conn->query($sql);

    // Verificamos si la consulta fue exitosa
    if (!$result) {
        die("Error en la consulta SQL: " . $conn->error);
    }

    // Mostrar todos los usuarios
    if ($result->num_rows > 0) {
        echo '<table class="usuarios-table">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>ID</th>';
        echo '<th>Nombre</th>';
        echo '<th>Email</th>';
        echo '<th>País</th>';
        echo '<th>Ciudad</th>';
        echo '<th>Acciones</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '  <td>' . htmlspecialchars($row['id']) . '</td>';
            echo '  <td>' . htmlspecialchars($row['nombre']) . '</td>';
            echo '  <td>' . htmlspecialchars($row['email']) . '</td>';
            echo '  <td>' . htmlspecialchars($row['pais']) . '</td>';
            echo '  <td>' . htmlspecialchars($row['ciudad']) . '</td>';
            echo '  <td>';
            echo '    <a href="modificar_usuario.php?id=' . htmlspecialchars($row['id']) . '" class="btn-modificar">Modificar</a>';
            echo '    <a href="eliminar_usuario.php?id=' . htmlspecialchars($row['id']) . '" class="btn-eliminar">Eliminar</a>';
            echo '  </td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
    } else {
        echo '<p class="no-usuarios">No hay usuarios registrados</p>';
    }

    $conn->close();
    ?>
</div>

<div class="contenedor-btn-volver">
    <a href="home.php" class="btn-volver">← Volver a la página de inicio</a>
</div>

</body>
</html>
