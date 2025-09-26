<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactos</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="p-6 bg-gray-50">
    <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">Mensajes de Contacto</h1>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="table-auto w-full text-sm text-gray-700">
            <thead class="bg-gray-100 text-gray-900">
                <tr>
                    <th class="p-3 border-b">ID</th>
                    <th class="p-3 border-b">Nombre</th>
                    <th class="p-3 border-b">Correo</th>
                    <th class="p-3 border-b">Mensaje</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contactos as $c): ?>
                <tr class="hover:bg-gray-50">
                    <td class="border-b p-3"><?= $c['id_contacto'] ?></td>
                    <td class="border-b p-3"><?= $c['nombre'] ?></td>
                    <td class="border-b p-3"><?= $c['correo'] ?></td>
                    <td class="border-b p-3"><?= $c['mensaje'] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>
