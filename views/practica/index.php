<?php
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prácticas</title>
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
        <h2 class="text-3xl font-bold text-color-2">Gestión de Prácticas</h2>
        <a href="/practica/crear"
           class="bg-color-2 text-color-5 px-6 py-3 rounded-lg shadow hover:bg-color-3 transition duration-300">
            + Nueva Práctica
        </a>
    </div>

    <div class="overflow-x-auto w-full bg-color-5 shadow-lg rounded-xl border border-color-4">
        <table class="table-auto w-full min-w-[800px] text-sm text-gray-700">
            <thead class="bg-color-3 text-color-5">
                <tr>
                    <th class="p-4 text-left">ID</th>
                    <th class="p-4 text-left">Supervisor</th>
                    <th class="p-4 text-left">Fecha Inicio</th>
                    <th class="p-4 text-left">Fecha Fin</th>
                    <th class="p-4 text-left">Horas Requeridas</th>
                    <th class="p-4 text-left">Horas Cumplidas</th>
                    <th class="p-4 text-left">Estado</th>
                    <th class="p-4 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($practica as $p): ?>
                <tr class="border-b hover:bg-color-5 transition">
                    <td class="p-4"><?= $p['id_practica'] ?></td>
<td class="p-4"><?= $p['supervisor_nombre'] ?? '-' ?> <?= $p['supervisor_apellido'] ?? '' ?></td>
                    <td class="p-4"><?= $p['fecha_inicio'] ?? '-' ?></td>
                    <td class="p-4"><?= $p['fecha_fin'] ?? '-' ?></td>
                    <td class="p-4"><?= $p['horas_requeridas'] ?? '-' ?></td>
                    <td class="p-4"><?= $p['horas_cumplidas'] ?? '-' ?></td>
                    <td class="p-4"><?= $p['estado'] ?? '-' ?></td>
                    <td class="p-4 flex gap-2 justify-center flex-wrap">
                              <a href="/practica/editar?id_practica=<?= $p['id_practica'] ?>" 
   class="px-3 py-1 bg-color-4 text-color-1 rounded-md hover:bg-color-2 hover:text-color-5 transition">
   Editar
</a>


                            <a href="/practica/eliminar?id_practica=<?= $p['id_practica'] ?>" 
   class="px-3 py-1 bg-red-600 text-color-5 rounded-md hover:bg-red-700 transition"
   onclick="return confirm('¿Seguro que deseas eliminar esta postulación?')">
   Eliminar
</a>
                        <a href="/asistencia/crear?id_practica=<?= $p['id_practica'] ?>"
                            class="px-3 py-1 bg-color-2 text-color-5 rounded-md hover:bg-color-3 transition">
                            Registrar Asistencia
                            </a>

                        <?php if(!empty($p['id_estudiante'])): ?>
                            <a href="/asistencia/historial?id_practica=<?= $p['id_practica'] ?>&id_usuario=<?= $p['id_estudiante'] ?>"
                               class="px-3 py-1 bg-color-4 text-color-1 rounded-md hover:bg-color-2 hover:text-color-5 transition">
                               Ver Asistencias
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</main>
</body>
</html>
