<?php
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asistencias</title>
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
            <h2 class="text-3xl font-bold text-color-2">Gestión de Asistencias</h2>
            <a href="/asistencia/crear"
               class="bg-color-2 text-color-5 px-6 py-3 rounded-lg shadow hover:bg-color-3 transition duration-300">
                + Nueva Asistencia
            </a>
        </div>

        <div class="overflow-x-auto w-full bg-color-5 shadow-lg rounded-xl border border-color-4">
            <table class="table-auto w-full min-w-[900px] text-sm text-gray-700">
                <thead class="bg-color-3 text-color-5">
                    <tr>
                        <th class="p-4 text-left">ID</th>
                        <th class="p-4 text-left">Práctica</th>
                        <th class="p-4 text-left">Fecha</th>
                        <th class="p-4 text-left">Hora Ingreso</th>
                        <th class="p-4 text-left">Hora Salida</th>
                        <th class="p-4 text-left">Verificado Por</th>
                        <th class="p-4 text-left w-64">Observación</th>
                        <th class="p-4 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($asistencia as $a): ?>
                    <tr class="border-b hover:bg-color-5 transition">
                        <td class="p-4"><?= $a['id_asistencia'] ?></td>
                        <td class="p-4 font-medium text-color-1"><?= $a['id_practica'] ?></td>
                        <td class="p-4"><?= $a['fecha'] ?></td>
                        <td class="p-4"><?= $a['hora_ingreso'] ?></td>
                        <td class="p-4"><?= $a['hora_salida'] ?? '-' ?></td>
                        <td class="p-4"><?= $a['nombre_verificador'] ?? $a['verificado_por'] ?> <?= $a['apellido_verificador'] ?? '' ?></td>
                        <td class="p-4"><?= $a['observacion'] ?? '-' ?></td>
                        <td class="p-4 text-center flex gap-2 justify-center">
                            <a href="/asistencia/editar?id=<?= $a['id_asistencia'] ?>"
                               class="px-3 py-1 bg-color-4 text-color-1 rounded-md hover:bg-color-2 hover:text-color-5 transition">
                               Editar
                            </a>
                            <a href="/asistencia/eliminar?id=<?= $a['id_asistencia'] ?>"
                               class="px-3 py-1 bg-red-600 text-color-5 rounded-md hover:bg-red-700 transition"
                               onclick="return confirm('¿Seguro que deseas eliminar esta asistencia?')">
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
