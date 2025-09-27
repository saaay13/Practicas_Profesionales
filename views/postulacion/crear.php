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
    <title>Crear Postulación</title>
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
<div class="bg-color-5 p-10 rounded-xl shadow-lg w-full max-w-4xl border border-color-3 mx-auto mt-16">
    <h1 class="text-3xl font-bold mb-8 text-center text-color-1">Crear Postulación</h1>
    <form action="" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <div>
            <label for="id_convocatoria" class="block font-medium mb-1 text-color-2">Convocatoria:</label>
            <select id="id_convocatoria" name="postulacion[id_convocatoria]" required
                    class="w-full border border-color-3 rounded px-3 py-2 bg-color-5 text-color-1">
                <option value="">Seleccione una convocatoria</option>
                <?php foreach ($convocatoria as $c): ?>
                    <option value="<?= $c['id_convocatoria'] ?>">
                        <?= $c['titulo'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label for="id_usuario" class="block font-medium mb-1 text-color-2">Usuario:</label>
            <select id="id_usuario" name="postulacion[id_usuario]" required
                    class="w-full border border-color-3 rounded px-3 py-2 bg-color-5 text-color-1">
                <option value="">Seleccione un usuario</option>
                <?php foreach ($usuario as $u): ?>
                    <option value="<?= $u['id_usuario'] ?>">
                        <?= $u['nombre'] . ' ' . $u['apellido'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label for="fecha_postulacion" class="block font-medium mb-1 text-color-2">Fecha Postulación:</label>
            <input type="date" id="fecha_postulacion" name="postulacion[fecha_postulacion]" required
                   value="<?= date('Y-m-d') ?>"
                   class="w-full border border-color-3 rounded px-3 py-2 bg-color-5 text-color-1">
        </div>

        <div>
            <label for="estado" class="block font-medium mb-1 text-color-2">Estado:</label>
            <select id="estado" name="postulacion[estado]" required
                    class="w-full border border-color-3 rounded px-3 py-2 bg-color-5 text-color-1">
                <option value="en_revision">En Revisión</option>
                <option value="aceptada">Aceptada</option>
                <option value="rechazada">Rechazada</option>
                <option value="finalizada">Finalizada</option>
            </select>
        </div>

        <div class="md:col-span-2">
            <label for="mensaje_presentacion" class="block font-medium mb-1 text-color-2">Mensaje de Presentación:</label>
            <textarea id="mensaje_presentacion" name="postulacion[mensaje_presentacion]" rows="4"
                      class="w-full border border-color-3 rounded px-3 py-2 bg-color-5 text-color-1"></textarea>
        </div>

        <div class="md:col-span-2">
            <button type="submit"
                    class="w-full bg-color-2 text-color-5 font-bold py-3 rounded-lg hover:bg-color-3 transition-colors">
                Crear Postulación
            </button>
        </div>

    </form>
</div>
</body>
</html>
