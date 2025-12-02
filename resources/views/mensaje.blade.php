<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fondo Semi-Transparente</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Estilos personalizados -->
    <style>
        body {
            background-image: url('/prueba.jpeg'); /* Ruta relativa a la carpeta public */
            background-size: contain; /* Ajustar el tamaño para caber completamente sin recortar */
            background-position: center; /* Centrar la imagen */
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            font-family: 'Roboto', sans-serif; /* Tipo de letra bonito */
            position: relative;
        }
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.5); /* Color de fondo semi-transparente */
        }
        .content {
            z-index: 1;
             /* Color rojo para el texto */
        }
    </style>
</head>
<body>
    <div class="overlay"></div>
    <div class="container content" style="background-color:#FFF;">
        <h1 style="color:#ff0000;">TE AMO PANDA</h1><br>
        <p>Eres mi sueño hecho realidad, mi inspiración y mi razón para creer en el amor verdadero. Juntos, podemos superar cualquier desafío y crear un futuro lleno de amor, complicidad y felicidad infinita.

        Te amo más de lo que las palabras pueden expresar, y siempre estaré aquí para ti, en cada paso del camino.

        Para mi panda presiosa Nicole Palacios </p>
        <!-- Reproductor de audio -->
        <audio controls autoplay loop>
            <source src="./audio_prueba.ogg" type="audio/mpeg">
            Tu navegador no soporta la etiqueta de audio HTML5.
        </audio>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>