const app = Vue.createApp({
    data() {
        return {
            nivelSeleccionado: 'a', // Opción seleccionada
            mensaje: '',             // Mensaje de éxito o error
            opciones: [
                {
                    texto: '¿Listo para seleccionar el hardware?',
                    url: 'hardware.php',
                    claseBoton: 'btn btn-success',
                    botonTexto: 'Seleccionar Hardware'
                },
                {
                    texto: '¿Ver tu selección de hardware?',
                    url: 'seleccion.php',
                    claseBoton: 'btn btn-info',
                    botonTexto: 'Ver Selección'
                },
                {
                    texto: '¿Volver a la página principal?',
                    url: 'index.html',
                    claseBoton: 'btn btn-secondary',
                    botonTexto: 'Volver al Inicio'
                }
            ]
        };
    },
    computed: {
        mensajeClase() {
            return this.mensaje === 'Selección guardada exitosamente.' ? 'text-success' : 'text-danger';
        }
    },
    methods: {
        enviarFormulario() {
            // Validar y enviar el formulario aquí
            if (this.nivelSeleccionado) {
                this.mensaje = 'Selección guardada exitosamente.';
            } else {
                this.mensaje = 'Hubo un error al guardar la selección.';
            }
        }
    },
    mounted() {
        // Chequea parámetros de URL al cargar
        const urlParams = new URLSearchParams(window.location.search);
        const status = urlParams.get('status');
        if (status === 'success') {
            this.mensaje = 'Selección guardada exitosamente.';
        } else if (status === 'error') {
            this.mensaje = 'Hubo un error al guardar la selección.';
        }
    }
});

app.mount('#app');
