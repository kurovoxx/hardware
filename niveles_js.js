const form = document.getElementById("combobox");
const btn = document.getElementById("enviar");

btn.onclick = function(event) {
    event.preventDefault();
    const selectedValue = form.value;
    let mensaje;
    let url;

    switch(selectedValue) {
        case 'a':
            mensaje = "Bienvenido al Nivel 1";
            url = "nivel_1.html";
            break;
        case 'b':
            mensaje = "Bienvenido al Nivel 2";
            url = "nivel_2.html";
            break;
        case 'c':
            mensaje = "Bienvenido al Nivel 3";
            url = "nivel_3.html";
            break;
        case 'd':
            mensaje = "Bienvenido al Nivel 4";
            url = "nivel_4.html";
            break;
        default:
            mensaje = "Selección no válida";
            alert(mensaje);
            return;
    }

    window.location.href = `${url}?mensaje=${encodeURIComponent(mensaje)}`;
};
