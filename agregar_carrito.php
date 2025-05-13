<?php
session_start();
include('conexion.php');

// Verificar si el usuario ha iniciado sesión
if (isset($_SESSION['id_usuario'])) {
    $id_usuario = $_SESSION['id_usuario'];
} else {
    // Si no hay sesión de usuario, asignar un guest_id
    if (!isset($_SESSION['guest_id'])) {
        $_SESSION['guest_id'] = uniqid('guest_');
    }
    $id_usuario = $_SESSION['guest_id'];
}

// Verificar que los datos necesarios estén presentes
if (isset($_POST['id_producto'], $_POST['cantidad'])) {
    $id_producto = (int) $_POST['id_producto'];
    $cantidad = (int) $_POST['cantidad'];

    if ($cantidad > 0) {
        // Verificar si el producto ya está en el carrito
        $sql_check = "SELECT cantidad FROM carrito WHERE id_usuario = ? AND id_producto = ?";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->bind_param("si", $id_usuario, $id_producto);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();

        if ($result_check->num_rows > 0) {
            // Producto ya existe en el carrito, actualizar cantidad
            $row = $result_check->fetch_assoc();
            $nueva_cantidad = $row['cantidad'] + $cantidad;

            $sql_update = "UPDATE carrito SET cantidad = ? WHERE id_usuario = ? AND id_producto = ?";
            $stmt_update = $conn->prepare($sql_update);
            $stmt_update->bind_param("isi", $nueva_cantidad, $id_usuario, $id_producto);
            $stmt_update->execute();
        } else {
            // Producto no está en el carrito, insertarlo
            $sql_insert = "INSERT INTO carrito (id_usuario, id_producto, cantidad) VALUES (?, ?, ?)";
            $stmt_insert = $conn->prepare($sql_insert);
            $stmt_insert->bind_param("sii", $id_usuario, $id_producto, $cantidad);
            $stmt_insert->execute();
        }
    }
}

// Redirigir al carrito después de agregar el producto
header("Location: carrito.php");
exit();
?>
<?php
