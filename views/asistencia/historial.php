<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Asistencias</title>
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
            <h2 class="text-3xl font-bold text-color-2">Historial de Asistencias</h2>
            <a href="/practica" 
               class="bg-color-2 text-color-5 px-6 py-3 rounded-lg shadow hover:bg-color-3 transition duration-300">
                ← Volver a Prácticas
            </a>
        </div>

        <!-- Resumen de horas cumplidas -->
        <div class="mb-6 p-6 bg-color-3 text-color-5 rounded-xl shadow flex justify-between items-center">
    <strong>Total Horas Cumplidas:</strong> <?= number_format($totalHoras, 2) ?> horas
        </div>

        <div class="overflow-x-auto w-full bg-color-5 shadow-lg rounded-xl border border-color-4">
            <table class="table-auto w-full min-w-[900px] text-sm text-gray-700">
                <thead class="bg-color-3 text-color-5">
                    <tr>
                        <th class="p-4 text-left">Fecha</th>
                        <th class="p-4 text-left">Hora Ingreso</th>
                        <th class="p-4 text-left">Hora Salida</th>
                        <th class="p-4 text-left">Supervisor</th>
                        <th class="p-4 text-left">Observación</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($historial)): ?>
                        <?php foreach ($historial as $h): ?>
                        <tr class="border-b hover:bg-color-5 transition">
                            <td class="p-4"><?= $h['fecha'] ?></td>
                            <td class="p-4"><?= $h['hora_ingreso'] ?></td>
                            <td class="p-4"><?= $h['hora_salida'] ?? '-' ?></td>
                            <td class="p-4"><?= $h['supervisor_nombre'] ?? '' ?> <?= $h['supervisor_apellido'] ?? '' ?></td>
                            <td class="p-4"><?= $h['observacion'] ?? '-' ?></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="p-4 text-center text-gray-500">No hay asistencias registradas</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>
