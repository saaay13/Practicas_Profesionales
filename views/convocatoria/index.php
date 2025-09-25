<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Convocatorias</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="p-6 bg-gray-50">
    <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">Convocatorias</h1>

    <div class="flex justify-end mb-4">
        <a href="/convocatoria/crear" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-300">
            Nueva Convocatoria
        </a>
    </div>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="table-auto w-full text-sm text-gray-700">
            <thead class="bg-gray-100 text-gray-900">
                <tr>
                    <th class="p-3 border-b">ID</th>
                    <th class="p-3 border-b">Empresa</th>
                    <th class="p-3 border-b">Título</th>
                    <th class="p-3 border-b">Descripción</th>
                    <th class="p-3 border-b">Requisitos</th>
                    <th class="p-3 border-b">Fecha Publicación</th>
                    <th class="p-3 border-b">Fecha Cierre</th>
                    <th class="p-3 border-b">Estado</th>
                    <th class="p-3 border-b">Imagen</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($convocatoria as $c): ?>
                <tr class="hover:bg-gray-50">
                    <td class="border-b p-3"><?= $c['id_convocatoria'] ?></td>
                    <td class="border-b p-3"><?= $c['nombre_empresa'] ?? $c['id_empresa'] ?></td>
                    <td class="border-b p-3"><?= $c['titulo'] ?></td>
                    <td class="border-b p-3"><?= $c['descripcion'] ?></td>
                    <td class="border-b p-3"><?= $c['requisitos'] ?></td>
                    <td class="border-b p-3"><?= $c['fecha_publicacion'] ?></td>
                    <td class="border-b p-3"><?= $c['fecha_cierre'] ?></td>
                    <td class="border-b p-3"><?= ucfirst($c['estado']) ?></td>
                    <td class="border-b p-3"><?= $c['imagen'] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>
