function obtenerParametroUrl(parametro) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(parametro);
}

const status = obtenerParametroUrl('status');
const mensajeDiv = document.getElementById('mensaje');

if (status === 'success') {
    mensajeDiv.textContent = 'Selección guardada exitosamente.';
    mensajeDiv.style.color = 'green';
} else if (status === 'error') {
    mensajeDiv.textContent = 'Hubo un error al guardar la selección.';
    mensajeDiv.style.color = 'red';
}
