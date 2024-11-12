<?php
// Incluir el archivo que contiene la conexi�n a la base de datos
include('Conex.inc');

// Verificar la conexi�n a la base de datos
if (!$db) {
    die("Error en la conexion a la base de datos: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccionar Hardware</title>
    <link rel="stylesheet" href="./css/hardware_styles.css">
</head>
<body>
    <div class="container">
        <h1>Selecciona tu Hardware</h1>
        <form action="guardar_seleccion.php" method="POST">
            <!-- Selecci�n de CPU -->
            <div class="hardware-section">
                <label for="cpu">CPU:</label>
                <select name="cpu" id="cpu" required>
                    <option value="">Seleccione una CPU</option>
                    <?php
                    $consulta = "SELECT id_hardware, nombre, precio FROM hardware WHERE tipo = 'CPU'";
                    $resultado = mysqli_query($db, $consulta);
                    if ($resultado && mysqli_num_rows($resultado) > 0) {
                        while ($fila = mysqli_fetch_assoc($resultado)) {
                            echo "<option value='" . $fila['id_hardware'] . "' data-precio='" . $fila['precio'] . "'>" . $fila['nombre'] . " - $" . $fila['precio'] . "</option>";
                        }
                    } else {
                        echo "<option value=''>No se encontraron CPUs.</option>";
                    }
                    mysqli_free_result($resultado);
                    ?>
                </select>
            </div>

            <!-- Selecci�n de RAM -->
            <div class="hardware-section">
                <label for="ram">RAM:</label>
                <select name="ram" id="ram" required>
                    <option value="">Seleccione una RAM</option>
                    <?php
                    $consulta = "SELECT id_hardware, nombre, precio FROM hardware WHERE tipo = 'RAM'";
                    $resultado = mysqli_query($db, $consulta);
                    if ($resultado && mysqli_num_rows($resultado) > 0) {
                        while ($fila = mysqli_fetch_assoc($resultado)) {
                            echo "<option value='" . $fila['id_hardware'] . "' data-precio='" . $fila['precio'] . "'>" . $fila['nombre'] . " - $" . $fila['precio'] . "</option>";
                        }
                    } else {
                        echo "<option value=''>No se encontraron RAMs.</option>";
                    }
                    mysqli_free_result($resultado);
                    ?>
                </select>
            </div>

            <!-- Selecci�n de Disco Duro -->
            <div class="hardware-section">
                <label for="disco">Disco:</label>
                <select name="disco" id="disco" required>
                    <option value="">Seleccione un Disco</option>
                    <?php
                    $consulta = "SELECT id_hardware, nombre, precio FROM hardware WHERE tipo = 'DISCO'";
                    $resultado = mysqli_query($db, $consulta);
                    if ($resultado && mysqli_num_rows($resultado) > 0) {
                        while ($fila = mysqli_fetch_assoc($resultado)) {
                            echo "<option value='" . $fila['id_hardware'] . "' data-precio='" . $fila['precio'] . "'>" . $fila['nombre'] . " - $" . $fila['precio'] . "</option>";
                        }
                    } else {
                        echo "<option value=''>No se encontraron Discos.</option>";
                    }
                    mysqli_free_result($resultado);
                    ?>
                </select>
            </div>

            <!-- Selecci�n de Monitor -->
            <div class="hardware-section">
                <label for="monitor">Monitor:</label>
                <select name="monitor" id="monitor" required>
                    <option value="">Seleccione un Monitor</option>
                    <?php
                    $consulta = "SELECT id_hardware, nombre, precio FROM hardware WHERE tipo = 'MONITOR'";
                    $resultado = mysqli_query($db, $consulta);
                    if ($resultado && mysqli_num_rows($resultado) > 0) {
                        while ($fila = mysqli_fetch_assoc($resultado)) {
                            echo "<option value='" . $fila['id_hardware'] . "' data-precio='" . $fila['precio'] . "'>" . $fila['nombre'] . " - $" . $fila['precio'] . "</option>";
                        }
                    } else {
                        echo "<option value=''>No se encontraron Monitores.</option>";
                    }
                    mysqli_free_result($resultado);
                    ?>
                </select>
            </div>

            <!-- Previsualizaci�n del precio total -->
            <div id="precio-total">
                <h2>Precio Total: $<span id="total">0.00</span></h2>
            </div>

            <!-- Bot�n de enviar -->
            <div class="submit-section">
                <button type="submit">Guardar Seleccion</button>
            </div>
        </form>

        <!-- Bot�n para regresar al men� -->
        <div class="back-to-menu">
            <button onclick="window.location.href='menu.html'">Regresar al Menu</button>
        </div>
    </div>

    <!-- Conexi�n al archivo JavaScript -->
    <script src="hardware_js.js"></script>
</body>
</html>

<?php
// Cerrar la conexi�n
mysqli_close($db);
?>
