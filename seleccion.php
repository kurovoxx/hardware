<?php
include('Conex.inc');
session_start();

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.html");
    exit();
}

$id_usuario = $_SESSION['id_usuario'];

// Manejo de la eliminación
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar_hardware_id'], $_POST['tipo_hardware'])) {
    $id_hardware = (int)$_POST['eliminar_hardware_id'];
    $tipo_hardware = $_POST['tipo_hardware'];

    $column = '';
    switch ($tipo_hardware) {
        case 'cpu':
            $column = 'cpu_id';
            break;
        case 'ram':
            $column = 'ram_id';
            break;
        case 'disco':
            $column = 'disco_id';
            break;
        case 'monitor':
            $column = 'monitor_id';
            break;
        default:
            // Tipo inválido
            exit('Tipo de hardware inválido');
    }

    $eliminarConsulta = "UPDATE seleccion SET $column = NULL WHERE id_usuario = ? AND $column = ?";
    $stmtEliminar = mysqli_prepare($db, $eliminarConsulta);
    mysqli_stmt_bind_param($stmtEliminar, "ii", $id_usuario, $id_hardware);
    mysqli_stmt_execute($stmtEliminar);
    mysqli_stmt_close($stmtEliminar);

    // Redirige para evitar reenviar el formulario
    header("Location: seleccion.php");
    exit();
}

// Consulta de hardware seleccionado
$consulta = "
    SELECT h.id_hardware, h.nombre, h.tipo, h.marca, h.precio, 
           CASE
               WHEN h.id_hardware = s.cpu_id THEN 'cpu'
               WHEN h.id_hardware = s.ram_id THEN 'ram'
               WHEN h.id_hardware = s.disco_id THEN 'disco'
               WHEN h.id_hardware = s.monitor_id THEN 'monitor'
           END AS tipo_hardware
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
                    <th>Acciones</th>
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
                            <td>
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="eliminar_hardware_id" value="<?php echo $pieza['id_hardware']; ?>">
                                    <input type="hidden" name="tipo_hardware" value="<?php echo $pieza['tipo_hardware']; ?>">
                                    <button type="submit">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="5">No tienes ninguna selección.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
        <h2>Total: $<?php echo number_format($total_precio, 2); ?></h2>
    </div>
</body>
</html>
