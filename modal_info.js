document.getElementById("modalButton").addEventListener("click", function() {
    Swal.fire({
        title: 'Bienvenido!',
        text: 'Aquí encontrarás información útil sobre el hardware y cómo seleccionar el adecuado.',
        icon: 'info',
        confirmButtonText: '¡Entendido!',
        background: '#f9f9f9',
        confirmButtonColor: '#3085d6',
        customClass: {
            title: 'my-swal-title',
            confirmButton: 'my-swal-button'
        }
    });
});
