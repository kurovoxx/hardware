<?php
include("Conex.inc");

$mensajeInsercion = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    try {
        $consulta = "INSERT INTO usuario (nombre, email, password_hash) VALUES (?, ?, ?)";
        $stmt = $db->prepare($consulta);

        if ($stmt->execute([$nombre, $email, $password])) {
            header("Location: menu.html?status=success");
            exit();
        } else {
            throw new Exception("Error al registrar el usuario.");
        }
    } catch (Exception $e) {
        echo "<h2>Error: " . $e->getMessage() . "</h2>";
    }
}
?>
