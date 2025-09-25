<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["usuario_activo"])) {
    header("Location: ../sesion.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="p-6 bg-gray-50">
    <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">Usuarios</h1>

    <div class="flex justify-end mb-4">
        <a href="/usuario/crear" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-300">Nuevo usuario</a>
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
                    <th class="p-3 border-b">Rol</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuario as $u): ?>
                <tr class="hover:bg-gray-50">
                    <td class="border-b p-3"><?= $u['id_usuario'] ?></td>
                    <td class="border-b p-3"><?= $u['nombre'] ?></td>
                    <td class="border-b p-3"><?= $u['apellido'] ?></td>
                    <td class="border-b p-3"><?= $u['email'] ?></td>
                    <td class="border-b p-3"><?= $u['telefono'] ?></td>
                    <td class="border-b p-3"><?= $u['id_rol'] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>
