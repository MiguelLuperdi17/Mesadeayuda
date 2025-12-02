<style>
    .dataTables_filter input {
            border: 1px solid #b3c0ca; /* Borde azul suave */
            border-radius: 5px; /* Borde redondeado */
            background-color: #f8f9fa; /* Color de fondo */
            padding: 8px 13px; /* Añadir espacio en el interior del input */
            margin-bottom: 10px; /* Añadir espacio en la parte inferior */
            box-shadow: 0 0 5px rgba(0, 0, 255, 0.1); /* Sombra azul suave */
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.previous::after,
    .dataTables_wrapper .dataTables_paginate .paginate_button.next::after {
        font-family: 'Arial', sans-serif; /* Asegúrate de tener una fuente que incluya las flechas */
        content: "\2190"; /* Flecha izquierda */
        display: inline-block;
        width: 40px; /* Ancho del botón */
        height: 40px; /* Altura del botón */
        text-align: center;
        line-height: 40px; /* Ajuste vertical */
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.next::after {
        content: "\2192"; /* Flecha derecha */
    }
    .dataTables_wrapper tbody tr:nth-child(odd) {
            background-color: transparent !important; /* Establece el fondo transparente */
        }
    /*LOADER */
    .header {
        color: #36A0FF;
        font-size: 27px;
        padding: 10px;
    }

    .bi {
        color: #36A0FF;
    }


    .loader {
        border: 5px solid #f3f3f3; /* Light grey */
        border-top: 5px solid #3498db; /* Blue */
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spin 1s linear infinite;
        display: none;
        margin: 0 auto;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

</style>