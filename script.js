// Función para obtener el parámetro de la URL
function getParameterByName(name) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(name);
}

// Obtener el mensaje de la URL y mostrarlo en un alert
const mensaje = getParameterByName('mensaje');
if (mensaje) {
    alert(mensaje);
}
