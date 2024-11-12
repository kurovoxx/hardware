<?php
// Incluir el archivo que contiene la conexi�n a la base de datos
include("Conex.inc");

$mensajeInsercion = "";  // Variable para almacenar el mensaje de �xito o error

// Verificamos que el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Recoger los datos enviados por el formulario
    $nombre = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];  // Contrase�a en texto plano

    try {
        // Preparamos la consulta SQL para insertar los datos en la tabla 'usuario'
        // Aunque la columna se llama password_hash, almacenaremos la contrase�a sin hash
        $consulta = "INSERT INTO usuario (nombre, email, password_hash) VALUES (?, ?, ?)";

        // Preparamos la consulta con el objeto de conexi�n
        $stmt = $db->prepare($consulta);

        // Ejecutamos la consulta con los valores proporcionados (almacenamos la contrase�a en texto plano)
        if ($stmt->execute([$nombre, $email, $password])) {
            // Si la inserci�n es exitosa, redirigimos al men�
            header("Location: menu.html");
            exit();
        } else {
            // Si ocurre un error, lanzamos una excepci�n
            throw new Exception("Error al registrar el usuario.");
        }

    } catch (Exception $e) {
        // Mostrar el mensaje de error si ocurre alg�n problema
        echo "<h2>Error: " . $e->getMessage() . "</h2>";
    }
}
?>
