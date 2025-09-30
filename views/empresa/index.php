<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$rol = $_SESSION['id_rol'] ?? null;

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Empresas</title>
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
            <h2 class="text-3xl font-bold text-color-2">Gestión de Empresas</h2>
            <a href="/empresa/crear"
               class="bg-color-2 text-color-5 px-6 py-3 rounded-lg shadow hover:bg-color-3 transition duration-300">
                + Nueva Empresa
            </a>
        </div>

        <div class="overflow-x-auto w-full bg-color-5 shadow-lg rounded-xl border border-color-4">
            <table class="table-auto w-full min-w-[800px] text-sm text-gray-700">
                <thead class="bg-color-3 text-color-5">
                    <tr>
                        <th class="p-4 text-left">ID</th>
                        <th class="p-4 text-left w-48">Nombre Empresa</th>
                        <th class="p-4 text-left">NIT</th>
                        <th class="p-4 text-left">Rubro</th>
                        <th class="p-4 text-left w-64">Dirección</th>
                        <th class="p-4 text-left">Representante</th>
                        <th class="p-4 text-left">Cargo Representante</th>
                        <th class="p-4 text-left">Email Representante</th>
                        <th class="p-4 text-left">Teléfono Representante</th>
                        <th class="p-4 text-center">Verificada</th>
                        <th class="p-4 text-center">Imagen</th>
                        <th class="p-4 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($empresa as $e): ?>
                    <tr class="border-b hover:bg-color-5 transition">
                        <td class="p-4"><?= $e['id_empresa'] ?></td>
                        <td class="p-4 font-medium text-color-1"><?= $e['nombre_empresa'] ?></td>
                        <td class="p-4"><?= $e['nit'] ?></td>
                        <td class="p-4"><?= $e['rubro'] ?></td>
                        <td class="p-4"><?= $e['direccion'] ?></td>
                        <td class="p-4"><?= $e['representante_nombre'] ?> <?= $e['representante_apellido'] ?></td>
                        <td class="p-4"><?= $e['cargo_representante'] ?></td>
                        <td class="p-4"><?= $e['representante_email'] ?></td>
                        <td class="p-4"><?= $e['representante_telefono'] ?></td>           
                        <td class="p-4 text-center"><?= $e['verificada'] ? 'Sí' : 'No' ?></td>
                        <td class="p-4 text-center">
                            <?php if (!empty($e['imagen'])): ?>
                            <img src="/img/empresa/<?= $e['imagen'] ?>" class="h-16 w-16 object-cover rounded-md mx-auto">
                            <?php else: ?>
                                Sin imagen
                            <?php endif; ?>
                        </td>
                        <td class="p-4 text-center flex gap-2 justify-center">
                            <a href="/empresa/editar?id_empresa=<?= $e['id_empresa'] ?>" 
                               class="px-3 py-1 bg-color-4 text-color-1 rounded-md hover:bg-color-2 hover:text-color-5 transition">
                               Editar
                            </a>
                            <a href="/empresa/eliminar?id=<?= $e['id_empresa'] ?>" 
                               class="px-3 py-1 bg-red-600 text-color-5 rounded-md hover:bg-red-700 transition"
                               onclick="return confirm('¿Seguro que deseas eliminar esta empresa?')">
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
