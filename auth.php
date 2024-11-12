<?php
// Mostrar todos los errores para facilitar la depuraci�n
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Incluir el archivo que contiene la conexi�n a la base de datos
include("Conex.inc");

session_start(); // Iniciar sesi�n para almacenar los datos del usuario

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    // Recoger y limpiar los datos enviados por el formulario
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password']; // Contrase�a en texto plano

    // Validar el correo electr�nico
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<h2>Error: Formato de correo electronico no valido.</h2>";
        exit();
    }

    // Preparar la consulta para obtener el usuario con el correo ingresado
    $consulta = "SELECT * FROM usuario WHERE email = ?";
    $stmt = mysqli_prepare($db, $consulta);
    
    if ($stmt) {
        // Enlazar el par�metro y ejecutar la consulta
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);

        // Obtener el usuario de la base de datos
        $usuario = mysqli_fetch_assoc($resultado);

        // Verificar si el usuario fue encontrado
        if ($usuario) {
            // Comparar la contrase�a ingresada en texto plano con la almacenada en la base de datos
            if ($password === $usuario['password_hash']) { // Aseg�rate de que 'password_hash' es correcto
                // Si la contrase�a es correcta, iniciar la sesi�n
                $_SESSION['id_usuario'] = $usuario['id_usuario'];
                $_SESSION['nombre'] = $usuario['nombre'];

                // Redirigir al men� principal
                header("Location: menu.html");
                exit();
            } else {
                // Si la contrase�a no coincide, mostrar error
                echo "<h2>Error: Contraseña incorrecta.</h2>";
            }
        } else {
            // Si el usuario no existe
            echo "<h2>Error: No se encontro el usuario con ese correo.</h2>";
        }

        // Cerrar la declaraci�n
        mysqli_stmt_close($stmt);
    } else {
        echo "Error en la preparacion de la consulta: " . mysqli_error($db);
    }
}

// Cerrar la conexi�n
mysqli_close($db);
?>
