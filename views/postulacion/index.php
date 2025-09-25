<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Postulaciones</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="p-6 bg-gray-50">
    <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">Postulaciones</h1>

    <div class="flex justify-end mb-4">
        <a href="/postulacion/crear" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-300">
            Nueva Postulación
        </a>
    </div>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="table-auto w-full text-sm text-gray-700">
            <thead class="bg-gray-100 text-gray-900">
                <tr>
                    <th class="p-3 border-b">ID</th>
                    <th class="p-3 border-b">Convocatoria</th>
                    <th class="p-3 border-b">Usuario</th>
                    <th class="p-3 border-b">Fecha Postulación</th>
                    <th class="p-3 border-b">Estado</th>
                    <th class="p-3 border-b">Mensaje Presentación</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($postulacion as $p): ?>
                <tr class="hover:bg-gray-50">
                    <td class="border-b p-3"><?= $p['id_postulacion'] ?></td>
                    <td class="border-b p-3"><?= $p['titulo_convocatoria'] ?? $p['id_convocatoria'] ?></td>
                    <td class="border-b p-3"><?= $p['nombre_usuario'] ?? $p['id_usuario'] ?></td>
                    <td class="border-b p-3"><?= $p['fecha_postulacion'] ?></td>
                    <td class="border-b p-3"><?= ucfirst($p['estado']) ?></td>
                    <td class="border-b p-3"><?= $p['mensaje_presentacion'] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>
