// Selecciona el elemento del combobox
const combobox = document.getElementById('combobox');

// Función para mostrar advertencia
function mostrarAdvertencia() {
    alert("Has cambiado la opción de familiaridad con el Hardware.");
}

// Agrega un evento para detectar cambios en el combobox
combobox.addEventListener('change', mostrarAdvertencia);
