<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empresas</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="p-6 bg-gray-50">
    <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">Empresas</h1>

    <div class="flex justify-end mb-4">
        <a href="/empresa/crear" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-300">
            Nueva Empresa
        </a>
    </div>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="table-auto w-full text-sm text-gray-700">
            <thead class="bg-gray-100 text-gray-900">
                <tr>
                    <th class="p-3 border-b">ID</th>
                    <th class="p-3 border-b">Nombre</th>
                    <th class="p-3 border-b">Apellido</th>
                    <th class="p-3 border-b">Email</th>
                    <th class="p-3 border-b">Teléfono</th>
                    <th class="p-3 border-b">Nombre Empresa</th>
                    <th class="p-3 border-b">NIT</th>
                    <th class="p-3 border-b">Rubro</th>
                    <th class="p-3 border-b">Dirección</th>
                    <th class="p-3 border-b">Representante</th>
                    <th class="p-3 border-b">Cargo Representante</th>
                    <th class="p-3 border-b">Verificada</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($empresa as $e): ?>
                <tr class="hover:bg-gray-50">
                    <td class="border-b p-3"><?= $e['id_empresa'] ?></td>
                    <td class="border-b p-3"><?= $e['nombre'] ?></td>
                    <td class="border-b p-3"><?= $e['apellido'] ?></td>
                    <td class="border-b p-3"><?= $e['email'] ?></td>
                    <td class="border-b p-3"><?= $e['telefono'] ?></td>
                    <td class="border-b p-3"><?= $e['nombre_empresa'] ?></td>
                    <td class="border-b p-3"><?= $e['nit'] ?></td>
                    <td class="border-b p-3"><?= $e['rubro'] ?></td>
                    <td class="border-b p-3"><?= $e['direccion'] ?></td>
                    <td class="border-b p-3"><?= $e['representante'] ?></td>
                    <td class="border-b p-3"><?= $e['cargo_representante'] ?></td>
                    <td class="border-b p-3"><?= $e['verificada'] ? 'Sí' : 'No' ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>
