<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración - Usuarios</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --color-1: #000a23;
            --color-2: #02253d;
            --color-3: #153f59;
            --color-4: #94b8d7;
            --color-5: #cbd5e1;
        }
        .text-color-1 { color: var(--color-1); }
        .text-color-2 { color: var(--color-2); }
        .text-color-3 { color: var(--color-3); }
        .text-color-4 { color: var(--color-4); }
        .text-color-5 { color: var(--color-5); }
        .bg-color-1 { background-color: var(--color-1); }
        .bg-color-2 { background-color: var(--color-2); }
        .bg-color-3 { background-color: var(--color-3); }
        .bg-color-4 { background-color: var(--color-4); }
        .bg-color-5 { background-color: var(--color-5); }
    </style>
</head>

<body class="bg-color-5 min-h-screen">
    <main class="w-full px-6 py-10">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-bold text-color-2">Gestión de Usuarios</h2>
            <div class="flex gap-4">
                <a href="/usuario/crear"
                   class="bg-color-2 text-color-5 px-6 py-3 rounded-lg shadow hover:bg-color-3 transition duration-300">
                    + Nuevo Usuario
                </a>
                <a href="/estudiante"
                   class="bg-color-4 text-color-1 px-6 py-3 rounded-lg shadow hover:bg-color-2 hover:text-color-5 transition duration-300">
                    Ver Estudiantes
                </a>
                <a href="/egresado"
                   class="bg-color-4 text-color-1 px-6 py-3 rounded-lg shadow hover:bg-color-2 hover:text-color-5 transition duration-300">
                    Ver Egresados
                </a>
            </div>
        </div>

        <div class="overflow-x-auto bg-color-5 shadow-lg rounded-xl border border-color-4">
            <table class="table-auto w-full text-sm text-gray-700">
                <thead class="bg-color-3 text-color-5">
                    <tr>
                        <th class="p-4 text-left">ID</th>
                        <th class="p-4 text-left">Nombre</th>
                        <th class="p-4 text-left">Apellido</th>
                        <th class="p-4 text-left">Email</th>
                        <th class="p-4 text-left">Teléfono</th>
                        <th class="p-4 text-left">Rol</th>
                        <th class="p-4 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuario as $u): ?>
                    <tr class="border-b hover:bg-color-4 transition">
                        <td class="p-4"><?= $u['id_usuario'] ?></td>
                        <td class="p-4 font-medium text-color-1"><?= $u['nombre'] ?></td>
                        <td class="p-4"><?= $u['apellido'] ?></td>
                        <td class="p-4"><?= $u['email'] ?></td>
                        <td class="p-4"><?= $u['telefono'] ?></td>
                        <td class="p-4 font-semibold text-color-2"><?= $u['nombre_rol'] ?></td>
                        <td class="p-4 text-center flex gap-2 justify-center">
                            <a href="/usuario/editar?id=<?= $u['id_usuario'] ?>" 
                               class="px-3 py-1 bg-color-4 text-color-1 rounded-md hover:bg-color-2 hover:text-color-5 transition">
                               Editar
                            </a>
                            <a href="/usuario/eliminar?id=<?= $u['id_usuario'] ?>" 
                               class="px-3 py-1 bg-red-600 text-color-5 rounded-md hover:bg-red-700 transition"
                               onclick="return confirm('¿Seguro que deseas eliminar este usuario?')">
                               Eliminar
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>
