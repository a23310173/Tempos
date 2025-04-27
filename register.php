<?php
// Iniciar la sesión para manejar mensajes de error o éxito más adelante (si es necesario)
session_start();

// Conexión a la base de datos
$servername = "localhost"; // Servidor de la base de datos
$username = "root"; // Usuario de la base de datos
$password_db = "123456789"; // Contraseña de la base de datos
$dbname = "TEMPOS"; // Nombre de la base de datos

try {
    // Crear conexión
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password_db);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Obtener los datos del formulario
        $usuario = $_POST['usuario'];
        $contrasena = password_hash($_POST['contrasena'], PASSWORD_BCRYPT);
        $email = $_POST['email'];
        $pais = $_POST['pais'];  // Verifica que este campo esté correctamente capturado
        $ciudad = $_POST['ciudad'];  // Verifica que este campo esté correctamente capturado

        // Crear la consulta SQL para insertar los datos en la base de datos
        $sql = "INSERT INTO usuarios (nombre, email, contrasena, pais, ciudad) 
            VALUES (:nombre, :email, :contrasena, :pais, :ciudad)";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nombre', $usuario);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':contrasena', $contrasena);
        $stmt->bindParam(':pais', $pais);  // Asegúrate de que se esté pasando el valor de pais
        $stmt->bindParam(':ciudad', $ciudad);  // Asegúrate de que se esté pasando el valor de ciudad

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "Registro exitoso. Ahora puedes iniciar sesión.";
            //Redirigir a la página de inicio de sesión en 5 segundos
            header("refresh:5; url=login.html");
        } else {
            echo "Error al registrar usuario.";
        }
    }


    // Cerrar la conexión
    $conn = null;
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}

// Verificar los valores recibidos
echo "Usuario: " . $usuario . "<br>";
echo "Contraseña: " . $contrasena . "<br>";
echo "Email: " . $email . "<br>";
echo "País: " . $pais . "<br>";
echo "Ciudad: " . $ciudad . "<br>";

?>
