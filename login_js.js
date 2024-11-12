document.addEventListener('DOMContentLoaded', function() {
    console.log("DOM completamente cargado y procesado.");

    const loginForm = document.getElementById('loginForm');
    const errorMessage = document.getElementById('error-message');

    // Leer los par�metros de la URL
    const urlParams = new URLSearchParams(window.location.search);
    const error = urlParams.get('error');
    console.log("Par�metro 'error' en la URL:", error);

    // Si hay un mensaje de error en la URL, mostrarlo
    if (error) {
        console.log("Se detect� un error en la URL.");
        mostrarError(decodeURIComponent(error));
    }

    // Evento de env�o del formulario
    loginForm.addEventListener('submit', function(event) {
        console.log("Evento 'submit' del formulario activado.");
        event.preventDefault();
        
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;

        console.log("Valores ingresados - Email:", email, "Password:", password);

        // Validaci�n b�sica de campos
        if (!email || !password) {
            console.log("Validaci�n fallida. Campos vac�os detectados.");
            mostrarError("Por favor, complete todos los campos.");
            return;
        }

        console.log("Validaci�n exitosa. Enviando formulario...");
        // Enviar el formulario
        this.submit();
    });

    // Funci�n para mostrar errores
    function mostrarError(mensaje) {
        console.log("Mostrando mensaje de error:", mensaje);
        errorMessage.textContent = mensaje;
        errorMessage.style.display = 'block';
    }
});
