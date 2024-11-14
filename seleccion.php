<?php
include('Conex.inc');
session_start();

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.html");
    exit();
}

$id_usuario = $_SESSION['id_usuario'];
$consulta = "
    SELECT h.nombre, h.tipo, h.marca, h.precio 
    FROM seleccion s
    JOIN hardware h ON h.id_hardware IN (s.cpu_id, s.ram_id, s.disco_id, s.monitor_id)
    WHERE s.id_usuario = ?
";
$stmt = mysqli_prepare($db, $consulta);
mysqli_stmt_bind_param($stmt, "i", $id_usuario);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);

$seleccion = [];
$total_precio = 0;

while ($fila = mysqli_fetch_assoc($resultado)) {
    $seleccion[] = $fila;
    $total_precio += $fila['precio'];
}

mysqli_stmt_close($stmt);
mysqli_close($db);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu Selección de Hardware</title>
    <link rel="stylesheet" href="./css/seleccion_styles.css">
</head>
<body>
    <div class="container">
        <h1>Tu Selección de Hardware</h1>
        <table border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Marca</th>
                    <th>Tipo</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($seleccion) > 0): ?>
                    <?php foreach ($seleccion as $pieza): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($pieza['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($pieza['marca']); ?></td>
                            <td><?php echo htmlspecialchars($pieza['tipo']); ?></td>
                            <td><?php echo "$" . number_format($pieza['precio'], 2); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="4">No tienes ninguna selección.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
        <h2>Total: $<?php echo number_format($total_precio, 2); ?></h2>
    </div>
</body>
</html>
