const form = document.getElementById("combobox");
const btn = document.getElementById("btn");

btn.addEventListener('click', function(event) {
    event.preventDefault();
    const selectedValue = form.value;
    console.log("Valor seleccionado:", selectedValue);
    
    switch(selectedValue) {
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
});


