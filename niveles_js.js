const form = document.getElementById("combobox"); // combobox
const btn = document.getElementById("enviar");  // bot�n para enviar selecci�n

btn.onclick = function(event) {
    event.preventDefault();
    const selectedValue = form.value; // Obtener el valor seleccionado
    let mensaje;
    let url;

    switch(selectedValue) {
        case 'a':
            mensaje = "Bienvenido al Nivel 1";
            url = "nivel_1.html"; // URL para el nivel 1
            break;
        case 'b':
            mensaje = "Bienvenido al Nivel 2";
            url = "nivel_2.html"; // URL para el nivel 2
            break;
        case 'c':
            mensaje = "Bienvenido al Nivel 3";
            url = "nivel_3.html"; // URL para el nivel 3
            break;
        case 'd':
            mensaje = "Bienvenido al Nivel 4";
            url = "nivel_4.html"; // URL para el nivel 4
            break;
        default:
            mensaje = "Seleccion no valida";
            alert(mensaje); // Mostrar un mensaje si la selecci�n no es v�lida
            return; // No redirigir si la selecci�n es inv�lida
    }

    // Redirigir a la p�gina correspondiente con el mensaje en la URL
    window.location.href = `${url}?mensaje=${encodeURIComponent(mensaje)}`;
};
