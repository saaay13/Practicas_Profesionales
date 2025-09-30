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
    <title>Crear Convocatoria - Administrador</title>
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
    <h1 class="text-3xl font-bold mb-8 text-center text-color-1">Crear Convocatoria</h1>
    <form action="" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <div>
            <label for="id_empresa" class="block font-medium mb-1 text-color-2">Empresa:</label>
            <select id="id_empresa" name="convocatoria[id_empresa]" required
                    class="w-full border border-color-3 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-color-2 bg-color-5 text-color-1">
                <option value="">Seleccione una empresa</option>
                <?php foreach ($empresa as $e): ?>
                    <option value="<?= $e['id_empresa'] ?>"><?= $e['nombre_empresa'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label for="titulo" class="block font-medium mb-1 text-color-2">Título:</label>
            <input type="text" id="titulo" name="convocatoria[titulo]" required
                   class="w-full border border-color-3 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-color-2 bg-color-5 text-color-1">
        </div>

        <div class="md:col-span-2">
            <label for="descripcion" class="block font-medium mb-1 text-color-2">Descripción:</label>
            <textarea id="descripcion" name="convocatoria[descripcion]" rows="4" required
                      class="w-full border border-color-3 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-color-2 bg-color-5 text-color-1"></textarea>
        </div>

        <div class="md:col-span-2">
            <label for="requisitos" class="block font-medium mb-1 text-color-2">Requisitos:</label>
            <textarea id="requisitos" name="convocatoria[requisitos]" rows="4" required
                      class="w-full border border-color-3 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-color-2 bg-color-5 text-color-1"></textarea>
        </div>

        <div>
            <label for="fecha_publicacion" class="block font-medium mb-1 text-color-2">Fecha de Publicación:</label>
            <input type="date" id="fecha_publicacion" name="convocatoria[fecha_publicacion]" required
                   class="w-full border border-color-3 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-color-2 bg-color-5 text-color-1">
        </div>

        <div>
            <label for="fecha_cierre" class="block font-medium mb-1 text-color-2">Fecha de Cierre:</label>
            <input type="date" id="fecha_cierre" name="convocatoria[fecha_cierre]" required
                   class="w-full border border-color-3 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-color-2 bg-color-5 text-color-1">
        </div>

        <div>
            <label for="estado" class="block font-medium mb-1 text-color-2">Estado:</label>
            <select id="estado" name="convocatoria[estado]" required
                    class="w-full border border-color-3 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-color-2 bg-color-5 text-color-1">
                <option value="">Seleccione un estado</option>
                <option value="activa">Activa</option>
                <option value="cerrada">Cerrada</option>
            </select>
        </div>

         <div>
                <label for="imagen" class="block font-medium mb-1">Imagen:</label>
                <input type="file" id="imagen" name="imagen" accept="image/*" required
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

        <div class="md:col-span-2">
            <button type="submit"
                    class="w-full bg-color-2 text-color-5 font-bold py-3 rounded-lg hover:bg-color-3 transition-colors">
                Crear Convocatoria
            </button>
        </div>
    </form>
    <br>
    <br>
</div>
</body>
</html>
