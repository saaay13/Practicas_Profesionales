<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estudiantes</title>
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

<body class="p-6 bg-gray-50">
    <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">Estudiantes</h1>
<div class="overflow-x-auto bg-color-5 shadow-md rounded-lg border border-color-3">
    <table class="table-auto w-full text-sm text-color-1">
        <thead class="bg-color-3 text-color-5">
            <tr>
                <th class="p-3 border-b text-left">ID</th>
                <th class="p-3 border-b text-left">Nombre</th>
                <th class="p-3 border-b text-left">Apellido</th>
                <th class="p-3 border-b text-left">Email</th>
                <th class="p-3 border-b text-left">Teléfono</th>
                <th class="p-3 border-b text-left">Carrera</th>
                <th class="p-3 border-b text-left">Semestre</th>
                <th class="p-3 border-b text-left">Matrícula</th>
                <th class="p-3 border-b text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($estudiante as $e): ?>
            <tr class="hover:bg-color-4 transition">
                <td class="border-b p-3"><?= $e['id_estudiante'] ?></td>
                <td class="border-b p-3"><?= $e['usuario_nombre'] ?></td>
                <td class="border-b p-3"><?= $e['usuario_apellido'] ?></td>
                <td class="border-b p-3"><?= $e['usuario_email'] ?></td>
                <td class="border-b p-3"><?= $e['usuario_telefono'] ?></td>
                <td class="border-b p-3"><?= $e['carrera'] ?></td>
                <td class="border-b p-3"><?= $e['semestre'] ?></td>
                <td class="border-b p-3"><?= $e['matricula'] ?></td>
                <td class="border-b p-3 text-center flex gap-2 justify-center">
                    <a href="/estudiante/editar?id_estudiante=<?= $e['id_estudiante'] ?>" 
                       class="px-3 py-1 bg-color-4 text-color-1 rounded-md hover:bg-color-2 hover:text-color-5 transition">
                       Editar
                    </a>
                    <a href="/estudiante/eliminar?id=<?= $e['id_estudiante'] ?>" 
                       class="px-3 py-1 bg-red-600 text-color-5 rounded-md hover:bg-red-700 transition"
                       onclick="return confirm('¿Seguro que deseas eliminar este estudiante?')">
                       Eliminar
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>

</html>
