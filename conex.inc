<?php
$host = "mysql.inf.uct.cl";
$user = "brojas";
$pass = "pRNk2zu4-Gu5Q+ZEf";
$db  = "A2024_brojas";

$link = mysqli_connect($host, $user, $pass, $db);

// Verificar si hay errores en la conexión
if (!$link) {
    die("Conexión fallida: " . mysqli_connect_error());
}
?>
