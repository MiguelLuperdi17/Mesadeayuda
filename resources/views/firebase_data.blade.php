<!DOCTYPE html>
<html>
<head>
    <title>Visualización de datos de Firebase</title>
</head>
<body>
    <h1>Conteo</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Artículo</th>
                <th>Cantidad</th>
                <th>Cantidad</th>
                <th>Cantidad</th>
                <th>Cantidad</th>
                <th>Cantidad</th>
                <th>Cantidad</th>
                <!-- Agrega más columnas según tus necesidades -->
            </tr>
        </thead>
        <tbody>
            @foreach ($conteoData as $key => $value)
                @php
                    // Decodificar la cadena JSON en un array
                    $conteo = json_decode($value);
                @endphp
                <tr>
                    <td>{{ $conteo[0] }}</td>
                    <td>{{ $conteo[1] }}</td>
                    <td>{{ $conteo[2] }}</td>
                    <td>{{ $conteo[3] }}</td>
                    <td>{{ $conteo[4] }}</td>
                    <td>{{ $conteo[5] }}</td>
                    <td>{{ $conteo[6] }}</td>
                    <td>{{ $conteo[7] }}</td>
                    <!-- Agrega más columnas según tus necesidades -->
                </tr>
            @endforeach
        </tbody>
    </table>

    <h1>ConteoGA</h1>
    <!-- Aquí puedes mostrar los datos de ConteoGA según tus necesidades -->

</body>
</html>