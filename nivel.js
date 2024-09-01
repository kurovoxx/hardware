const form = document.getElementById("combobox"); // combobox
const btn = document.getElementById("enviar");  // botón para enviar selección

btn.onclick = function(event) {
    event.preventDefault();
    const selectedValue = form.value;
    console.log("Valor seleccionado:", selectedValue);
    
    switch(selectedValue) { // redireccionar página dependiendo se selección
        case 'a':
            window.location.href = "nivel_1.html";
            break;
        case 'b':
            window.location.href = "nivel_2.html";
            break;
        case 'c':
            window.location.href = "nivel_3.html";
            break;
        case 'd':
            window.location.href = "nivel_4.html";
            break;
        default:
            console.log("Selección no válida");
            break;
    }
};
