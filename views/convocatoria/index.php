<?php
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Convocatorias</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --color-1: #000a23;
            --color-2: #02253d;
            --color-3: #153f59;
            --color-4: #94b8d7;
            --color-5: #cbd5e1;
        }
    </style>
</head>

<body class="bg-[var(--color-5)] min-h-screen">
    <main class="w-full px-6 py-10">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-bold text-[var(--color-2)]">Gestión de Convocatorias</h2>
            <a href="/convocatoria/crear"
               class="bg-[var(--color-2)] text-white px-6 py-3 rounded-lg shadow hover:bg-[var(--color-3)] transition duration-300">
                + Nueva Convocatoria
            </a>
        </div>

        <div class="overflow-x-auto bg-white shadow-lg rounded-xl border border-[var(--color-4)]">
            <table class="table-auto w-full text-sm text-gray-700">
                <thead class="bg-[var(--color-3)] text-white">
                    <tr>
                        <th class="p-4 text-left">ID</th>
                        <th class="p-4 text-left">Empresa</th>
                        <th class="p-4 text-left">Título</th>
                        <th class="p-4 text-left">Descripción</th>
                        <th class="p-4 text-left">Requisitos</th>
                        <th class="p-4 text-left">Fecha Publicación</th>
                        <th class="p-4 text-left">Fecha Cierre</th>
                        <th class="p-4 text-left">Estado</th>
                        <th class="p-4 text-left">Imagen</th>
                        <th class="p-4 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($convocatoria as $c): ?>
                    <tr class="border-b hover:bg-[var(--color-5)] transition">
                        <td class="p-4"><?= $c['id_convocatoria'] ?></td>
                        <td class="p-4 font-medium text-[var(--color-1)]"><?= $c['nombre_empresa'] ?? $c['id_empresa'] ?></td>
                        <td class="p-4"><?= $c['titulo'] ?></td>
                        <td class="p-4"><?= $c['descripcion'] ?></td>
                        <td class="p-4"><?= $c['requisitos'] ?></td>
                        <td class="p-4"><?= $c['fecha_publicacion'] ?></td>
                        <td class="p-4"><?= $c['fecha_cierre'] ?></td>
                        <td class="p-4"><?= ucfirst($c['estado']) ?></td>
                        <td class="p-4">
                            <?php if (!empty($c['imagen'])): ?>
                                <img src="/img/<?= $c['imagen'] ?>" class="h-16 w-16 object-cover rounded-md mx-auto">
                            <?php else: ?>
                                Sin imagen
                            <?php endif; ?>
                        </td>
                        <td class="p-4 text-center flex gap-2 justify-center">
                            <a href="/convocatoria/editar?id=<?= $c['id_convocatoria'] ?>" 
                               class="px-3 py-1 bg-[var(--color-4)] text-[var(--color-1)] rounded-md hover:bg-[var(--color-2)] hover:text-white transition">
                               Editar
                            </a>
                            <a href="/convocatoria/eliminar?id=<?= $c['id_convocatoria'] ?>" 
                               class="px-3 py-1 bg-red-600 text-white rounded-md hover:bg-red-700 transition"
                               onclick="return confirm('¿Seguro que deseas eliminar esta convocatoria?')">
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
