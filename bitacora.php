<?php
// Conexión a la base de datos
include('conexion.php');

// Obtener los registros de la bitácora
$query = "SELECT * FROM bitacora ORDER BY fecha DESC, hora DESC";
$result = $conn->query($query);

?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Bitácora</title>
        <link rel="stylesheet" href="bitacora.css">
    </head>
    <body>
    <div class="title-container">
        <h1>Bitácora</h1>
    </div>

    <div class="content">
        <table class="bitacora-table">
            <thead>
            <tr>
                <th>Fecha</th>
                <th>Nombre</th>
                <th>Sentencia</th>
                <th>Contrasentencia</th>
                <th>Hora</th>
            </tr>
            </thead>
            <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['fecha']; ?></td>
                    <td><?php echo $row['nombre']; ?></td>
                    <td><?php echo $row['sentencia']; ?></td>
                    <td><?php echo $row['contrasentencia'] ? $row['contrasentencia'] : '-'; ?></td>
                    <td><?php echo $row['hora']; ?></td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    </body>
    </html>
<?php
