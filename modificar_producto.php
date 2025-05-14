<?php
include 'conexion.php';
session_start();
// Mostrar el producto a modificar
if (!isset($_GET['id'])) {
    header("Location: productos_admini.php");
    exit();
}

$id = $_GET['id'];
$sql = "SELECT * FROM productos WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    header("Location: productos_admini.php?error=notfound");
    exit();
}

$producto = $result->fetch_assoc();
$stmt->close();
?>

    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Modificar Producto</title>
        <link rel="stylesheet" href="modificar_productos.css">
    </head>
    <body>
    <div class="title-container">
        <img src="media/tempologo.png" alt="Logo" class="logo">
        <h1>Modificar Producto</h1>
    </div>

    <form action="actualizar_producto.php" method="POST">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($producto['id']); ?>">

        <label for="marca">Marca:</label>
        <input type="text" id="marca" name="marca" value="<?php echo htmlspecialchars($producto['marca']); ?>" required>

        <label for="modelo">Modelo:</label>
        <input type="text" id="modelo" name="modelo" value="<?php echo htmlspecialchars($producto['modelo']); ?>" required>

        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="precio" step="0.01" value="<?php echo htmlspecialchars($producto['precio']); ?>" required>

        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" required><?php echo htmlspecialchars($producto['descripcion']); ?></textarea>

        <label for="stock">Stock:</label>
        <input type="number" id="stock" name="stock" value="<?php echo htmlspecialchars($producto['stock']); ?>" required>

        <label for="genero">Género:</label>
        <select id="genero" name="genero" required>
            <option value="Hombre" <?php echo ($producto['genero'] == 'Hombre') ? 'selected' : ''; ?>>Hombre</option>
            <option value="Mujer" <?php echo ($producto['genero'] == 'Mujer') ? 'selected' : ''; ?>>Mujer</option>
            <option value="Unisex" <?php echo ($producto['genero'] == 'Unisex') ? 'selected' : ''; ?>>Unisex</option>
        </select>

        <label for="imagen">Imagen (URL):</label>
        <input type="text" id="imagen" name="imagen" value="<?php echo htmlspecialchars($producto['imagen']); ?>">

        <div class="button-group">
            <button type="submit" class="btn-update">Actualizar Producto</button>
            <button type="button" class="btn-cancel" onclick="window.location.href='productos_admini.php'">Cancelar</button>
        </div>
    </form>
    </body>
    </html>
<?php $conn->close(); ?>