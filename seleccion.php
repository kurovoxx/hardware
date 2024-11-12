<?php
// Incluir el archivo de conexi�n a la base de datos
include('Conex.inc');

// Iniciar la sesi�n
session_start();

// Verificar si el usuario ha iniciado sesi�n
if (!isset($_SESSION['id_usuario'])) {
    // Si no hay un usuario en la sesi�n, redirigir al formulario de login
    header("Location: login.html");
    exit();
}

// Obtener el ID del usuario
$id_usuario = $_SESSION['id_usuario'];

// Consulta para obtener las piezas seleccionadas por el usuario
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

// Inicializar variables para almacenar el total y las filas de la tabla
$seleccion = [];
$total_precio = 0;

while ($fila = mysqli_fetch_assoc($resultado)) {
    $seleccion[] = $fila;
    $total_precio += $fila['precio']; // Sumar el precio al total
}

// Cerrar la declaraci�n
mysqli_stmt_close($stmt);

// Cerrar la conexi�n
mysqli_close($db);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu Seleccion de Hardware</title>
    <link rel="stylesheet" href="./css/seleccion_styles.css">
</head>
<body>
    <div class="container">
        <h1>Tu Seleccion de Hardware</h1>

        <!-- Mostrar la tabla con la selecci�n -->
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
                    <tr>
                        <td colspan="4">No se encontraron piezas seleccionadas.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Mostrar el precio total -->
        <h2>Precio Total: $<?php echo number_format($total_precio, 2); ?></h2>

        <!-- Bot�n para regresar al men� -->
        <div class="back-to-menu">
            <button onclick="window.location.href='menu.html'">Volver al Menu</button>
        </div>
    </div>
</body>
</html>
