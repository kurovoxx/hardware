<?php
// Incluir el archivo de conexi�n a la base de datos
include('Conex.inc');

// Iniciar la sesi�n para obtener el ID del usuario
session_start();

// Verificar si el usuario ha iniciado sesi�n
if (!isset($_SESSION['id_usuario'])) {
    // Si no hay un usuario en la sesi�n, redirigir al formulario de login
    header("Location: login.html");
    exit();
}

// Obtener el ID del usuario
$id_usuario = $_SESSION['id_usuario'];

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos enviados por el formulario
    $cpu_id = $_POST['cpu'];
    $ram_id = $_POST['ram'];
    $disco_id = $_POST['disco'];
    $monitor_id = $_POST['monitor'];

    // Comprobar si el usuario ya tiene una selecci�n
    $consulta_verificar = "SELECT * FROM seleccion WHERE id_usuario = ?";
    $stmt_verificar = mysqli_prepare($db, $consulta_verificar);
    mysqli_stmt_bind_param($stmt_verificar, "i", $id_usuario);
    mysqli_stmt_execute($stmt_verificar);
    $resultado = mysqli_stmt_get_result($stmt_verificar);
    
    if (mysqli_num_rows($resultado) > 0) {
        // El usuario ya tiene una selecci�n, hacer un UPDATE
        $consulta_update = "UPDATE seleccion SET cpu_id = ?, ram_id = ?, disco_id = ?, monitor_id = ? WHERE id_usuario = ?";
        $stmt_update = mysqli_prepare($db, $consulta_update);
        mysqli_stmt_bind_param($stmt_update, "iiiii", $cpu_id, $ram_id, $disco_id, $monitor_id, $id_usuario);

        // Ejecutar la consulta de actualizaci�n
        if (mysqli_stmt_execute($stmt_update)) {
            // Redirigir al men� si la actualizaci�n fue exitosa
            header("Location: menu.html");
            exit();
        } else {
            echo "<h2>Error al actualizar la seleccion</h2>";
        }

        // Cerrar la declaraci�n de actualizaci�n
        mysqli_stmt_close($stmt_update);
    } else {
        // El usuario no tiene selecci�n, hacer un INSERT
        $consulta_insert = "INSERT INTO seleccion (id_usuario, cpu_id, ram_id, disco_id, monitor_id) VALUES (?, ?, ?, ?, ?)";
        $stmt_insert = mysqli_prepare($db, $consulta_insert);
        mysqli_stmt_bind_param($stmt_insert, "iiiii", $id_usuario, $cpu_id, $ram_id, $disco_id, $monitor_id);

        // Ejecutar la consulta de inserci�n
        if (mysqli_stmt_execute($stmt_insert)) {
            // Redirigir al men� si la inserci�n fue exitosa
            header("Location: menu.html");
            exit();
        } else {
            echo "<h2>Error al guardar la seleccion</h2>";
        }

        // Cerrar la declaraci�n de inserci�n
        mysqli_stmt_close($stmt_insert);
    }

    // Cerrar la declaraci�n de verificaci�n
    mysqli_stmt_close($stmt_verificar);
}

// Cerrar la conexi�n a la base de datos
mysqli_close($db);
?>
