<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asistencias</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="p-6 bg-gray-50">
    <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">Asistencias</h1>

    <div class="flex justify-end mb-4">
        <a href="/asistencia/crear" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-300">
            Nueva Asistencia
        </a>
    </div>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="table-auto w-full text-sm text-gray-700">
            <thead class="bg-gray-100 text-gray-900">
                <tr>
                    <th class="p-3 border-b">ID</th>
                    <th class="p-3 border-b">Práctica</th>
                    <th class="p-3 border-b">Fecha</th>
                    <th class="p-3 border-b">Hora Ingreso</th>
                    <th class="p-3 border-b">Hora Salida</th>
                    <th class="p-3 border-b">Verificado Por</th>
                    <th class="p-3 border-b">Observación</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($asistencia as $a): ?>
                <tr class="hover:bg-gray-50">
                    <td class="border-b p-3"><?= $a['id_asistencia'] ?></td>
                    <td class="border-b p-3"><?= $a['id_practica'] ?></td>
                    <td class="border-b p-3"><?= $a['fecha'] ?></td>
                    <td class="border-b p-3"><?= $a['hora_ingreso'] ?></td>
                    <td class="border-b p-3"><?= $a['hora_salida'] ?? '-' ?></td>
                    <td class="border-b p-3"><?= $a['nombre_verificador'] ?? $a['verificado_por'] ?></td>
                    <td class="border-b p-3"><?= $a['observacion'] ?? '-' ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>
