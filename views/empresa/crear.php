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
    <title>Crear Empresa - Administrador</title>
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
<body class="bg-color-5 min-h-screen flex items-center justify-center px-6">
<div class="bg-color-5 p-10 rounded-xl shadow-lg w-full max-w-5xl border border-color-3 mx-auto mt-16">
    <h1 class="text-3xl font-bold mb-8 text-center text-color-1">Crear Empresa</h1>
    <form action="" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <div>
            <label for="nombre_empresa" class="block font-medium mb-1 text-color-2">Nombre de la Empresa:</label>
            <input type="text" id="nombre_empresa" name="empresa[nombre_empresa]" required
                   class="w-full border border-color-3 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-color-2 bg-color-5 text-color-1">
        </div>

        <div>
            <label for="nit" class="block font-medium mb-1 text-color-2">NIT:</label>
            <input type="text" id="nit" name="empresa[nit]" required
                   class="w-full border border-color-3 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-color-2 bg-color-5 text-color-1">
        </div>

        <div>
            <label for="rubro" class="block font-medium mb-1 text-color-2">Rubro:</label>
            <input type="text" id="rubro" name="empresa[rubro]" required
                   class="w-full border border-color-3 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-color-2 bg-color-5 text-color-1">
        </div>

        <div>
            <label for="direccion" class="block font-medium mb-1 text-color-2">Dirección:</label>
            <input type="text" id="direccion" name="empresa[direccion]" required
                   class="w-full border border-color-3 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-color-2 bg-color-5 text-color-1">
        </div>

        <div>
            <label for="id_representante" class="block font-medium mb-1 text-color-2">Representante:</label>
            <select id="id_representante" name="empresa[id_representante]" required
                    class="w-full border border-color-3 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-color-2 bg-color-5 text-color-1">
                <option value="">Seleccione un representante</option>
                <?php foreach ($usuario as $u): ?>
                        <option value="<?= $u['id_usuario'] ?>" <?= $u['nombre'] === 'Administrador' ? 'selected' : '' ?>>
                            <?= $u['nombre'] ?>
                        </option>
                    <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label for="cargo_representante" class="block font-medium mb-1 text-color-2">Cargo del Representante:</label>
            <input type="text" id="cargo_representante" name="empresa[cargo_representante]" required
                   class="w-full border border-color-3 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-color-2 bg-color-5 text-color-1">
        </div>

        <div class="flex items-center space-x-2">
            <input type="checkbox" id="verificada" name="empresa[verificada]" class="accent-color-2">
            <label for="verificada" class="text-color-2 font-medium">Empresa Verificada</label>
        </div>

        <div>
            <label for="imagen" class="block font-medium mb-1 text-color-2">Imagen de la Empresa:</label>
            <input type="file" id="imagen" name="empresa[imagen]" accept="image/*"
                   class="w-full border border-color-3 rounded px-3 py-2 bg-color-5 text-color-1">
        </div>

        <div class="md:col-span-2">
            <button type="submit"
                    class="w-full bg-color-2 text-color-5 font-bold py-3 rounded-lg hover:bg-color-3 transition-colors">
                Crear Empresa
            </button>
        </div>
    </form>
</div>
</body>
</html>
