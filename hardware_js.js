document.addEventListener('DOMContentLoaded', function() {
    console.log("DOM completamente cargado y procesado.");

    // Funci�n para actualizar el precio total basado en la selecci�n del hardware
    function actualizarPrecioTotal() {
        console.log("Funcion actualizarPrecioTotal llamada.");

        let total = 0;

        // Obtener los precios seleccionados para CPU, RAM, Disco y Monitor
        const cpuSelect = document.getElementById('cpu');
        const ramSelect = document.getElementById('ram');
        const discoSelect = document.getElementById('disco');
        const monitorSelect = document.getElementById('monitor');

        // Sumar los precios de las opciones seleccionadas
        total += obtenerPrecio(cpuSelect);
        total += obtenerPrecio(ramSelect);
        total += obtenerPrecio(discoSelect);
        total += obtenerPrecio(monitorSelect);

        console.log("Precio total actualizado:", total);

        // Mostrar el precio total en el contenedor
        document.getElementById('total').textContent = total.toFixed(2);
    }

    // Funci�n para obtener el precio de una pieza de hardware (usando this)
    function obtenerPrecio(selectElement) {
        console.log("Funcion obtenerPrecio llamada para el elemento:", selectElement.id);

        const precio = selectElement.options[selectElement.selectedIndex].getAttribute('data-precio');
        console.log("Precio obtenido:", precio);
        
        return precio ? parseFloat(precio) : 0;
    }

    // Funci�n para mostrar detalles de la pieza seleccionada usando fetch
    function mostrarDetallesHardware(id, tipo, elementoDestino) {
        console.log(`Funcion mostrarDetallesHardware llamada para ${tipo} con ID: ${id}`);

        // Usamos fetch para traer los detalles desde el servidor
        fetch(`getHardwareDetails.php?id=${id}&tipo=${tipo}`)
            .then(response => response.json())
            .then(data => {
                console.log("Detalles obtenidos:", data);
                
                // Mostrar los detalles en el contenedor especificado
                elementoDestino.innerHTML = `<h3>Detalles de ${tipo}</h3>
                                            <p>Nombre: ${data.nombre}</p>
                                            <p>Precio: $${data.precio}</p>
                                            <p>Marca: ${data.marca}</p>`;
            })
            .catch(error => {
                console.error('Error al obtener los detalles del hardware:', error);
            });
    }

    // Funci�n para manejar el cambio de selecci�n en un combobox
    function manejarCambioSeleccion(selectElement, tipo) {
        console.log(`Funcion manejarCambioSeleccion llamada para ${tipo}`);

        const idSeleccionado = selectElement.value;
        const contenedorDetalles = document.getElementById('detalles-hardware');
        
        if (idSeleccionado) {
            console.log(`ID seleccionado para ${tipo}:`, idSeleccionado);

            // Mostrar los detalles del hardware seleccionado
            mostrarDetallesHardware(idSeleccionado, tipo, contenedorDetalles);
        } else {
            console.log(`No se selecciono ninguna ${tipo}.`);
            contenedorDetalles.innerHTML = '';  // Limpiar detalles si no hay selecci�n
        }

        // Actualizar el precio total
        actualizarPrecioTotal();
    }

    // Asignar manejadores de eventos a los comboboxes
    const cpuSelect = document.getElementById('cpu');
    const ramSelect = document.getElementById('ram');
    const discoSelect = document.getElementById('disco');
    const monitorSelect = document.getElementById('monitor');

    cpuSelect.addEventListener('change', function() {
        console.log("Evento change activado para CPU.");
        manejarCambioSeleccion(this, 'CPU');
    });

    ramSelect.addEventListener('change', function() {
        console.log("Evento change activado para RAM.");
        manejarCambioSeleccion(this, 'RAM');
    });

    discoSelect.addEventListener('change', function() {
        console.log("Evento change activado para Disco.");
        manejarCambioSeleccion(this, 'DISCO');
    });

    monitorSelect.addEventListener('change', function() {
        console.log("Evento change activado para Monitor.");
        manejarCambioSeleccion(this, 'MONITOR');
    });

    // Inicializar el precio total al cargar la p�gina
    console.log("Inicializando el precio total...");
    actualizarPrecioTotal();
});
