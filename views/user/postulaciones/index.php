<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$rol = $_SESSION['rol'] ?? null;


?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Mis Postulaciones</title>
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
        <h2 class="text-3xl font-bold text-color-2">Mis Postulaciones</h2>
        
    </div>

    <div class="overflow-x-auto w-full bg-color-5 shadow-lg rounded-xl border border-color-4">
        <table class="table-auto w-full min-w-[800px] text-sm text-gray-700">
            <thead class="bg-color-3 text-color-5">
                <tr>
                    <th class="p-4 text-left">Usuarios</th>
                    <th class="p-4 text-left">Convocatoria</th>
                    <th class="p-4 text-left">Empresa</th>
                    <th class="p-4 text-left">Fecha</th>
                    <th class="p-4 text-left">Estado</th>
                    <th class="p-4 text-left w-64">Mensaje</th>
                    <th class="p-4 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($postulaciones as $p): ?>
                <tr class="border-b hover:bg-color-5 transition">
                    <td class="p-4 font-medium"><?= htmlspecialchars($p['estudiante_nombre'] . ' ' . $p['estudiante_apellido']) ?></td>
                    <td class="p-4"><?= htmlspecialchars($p['convocatoria_titulo']) ?></td>
                    <td class="p-4"><?= htmlspecialchars($p['nombre_empresa']) ?></td>
                    <td class="p-4"><?= htmlspecialchars($p['fecha_postulacion']) ?></td>
                    <td class="p-4">
                        <?php
                            $estado = $p['estado_postulacion'];
                            $colorEstado = match($estado){
                                'aceptada' => 'bg-green-500 text-white',
                                'rechazada' => 'bg-red-500 text-white',
                                'en_revision' => 'bg-yellow-400 text-color-1',
                                'finalizada' => 'bg-gray-400 text-white',
                                default => 'bg-gray-200 text-color-1'
                            };
                        ?>
                        <span class="px-3 py-1 rounded-full text-sm font-semibold <?= $colorEstado ?>">
                            <?= ucfirst(str_replace('_',' ',$estado)) ?>
                        </span>
                    </td>
                        <td class="p-4"><?= htmlspecialchars(isset($p['mensaje_presentacion']) ? $p['mensaje_presentacion'] : '-') ?></td>
                    <td class="p-4 flex gap-2 justify-center flex-wrap">
                        <a href="/postulacion/editar?id_postulacion=<?= $p['id_postulacion'] ?>" 
                           class="px-3 py-1 bg-color-4 text-color-1 rounded-md hover:bg-color-2 hover:text-color-5 transition">
                           Editar
                        </a>
                        <a href="/postulacion/eliminar?id_postulacion=<?= $p['id_postulacion'] ?>" 
                           class="px-3 py-1 bg-red-600 text-color-5 rounded-md hover:bg-red-700 transition"
                           onclick="return confirm('¿Seguro que deseas eliminar esta postulación?')">
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
