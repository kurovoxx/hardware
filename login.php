<?php
// Incluir archivo de conexión a la base de datos
include 'conex.inc';

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Preparar la consulta SQL para buscar al usuario
    $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Usuario encontrado - redirigir a nivel.html
        header("Location: nivel.html");
        exit(); // Es importante usar exit() después de header para detener la ejecución del script.
    } else {
        // Usuario no encontrado - mostrar alerta y redirigir nuevamente al login
        echo "<script>alert('Invalid username or password.');</script>";
        echo "<script>window.location.href='login.html';</script>";  // Redirige al login nuevamente
    }

    // Cerrar la conexión
    $stmt->close();
    $conn->close();
}
?>
