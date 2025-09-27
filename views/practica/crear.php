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
    <title>Crear Práctica</title>
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
    <h1 class="text-3xl font-bold mb-8 text-center text-color-1">Crear Práctica</h1>
    <form action="" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <div>
            <label for="id_postulacion" class="block font-medium mb-1 text-color-2">Postulación:</label>
            <select id="id_postulacion" name="practica[id_postulacion]" required
                    class="w-full border border-color-3 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-color-2 bg-color-5 text-color-1">
                <option value="">Seleccione una postulación</option>
                <?php foreach ($postulacion as $p): ?>
                        <option value="<?= $p['id_postulacion'] ?>">
                            <?= $p['id_postulacion'] ?>
                        </option>
                    <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label for="id_supervisor" class="block font-medium mb-1 text-color-2">Supervisor:</label>
            <select id="id_supervisor" name="practica[id_supervisor]" required
                    class="w-full border border-color-3 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-color-2 bg-color-5 text-color-1">
                <option value="">Seleccione un supervisor</option>
                <?php foreach ($usuario as $u): ?>
                        <option value="<?= $u['id_usuario'] ?>" <?= $u['nombre'] === 'Administrador' ? 'selected' : '' ?>>
                            <?= $u['nombre'] ?>
                        </option>
                    <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label for="fecha_inicio" class="block font-medium mb-1 text-color-2">Fecha Inicio:</label>
            <input type="date" id="fecha_inicio" name="practica[fecha_inicio]" required
                   class="w-full border border-color-3 rounded px-3 py-2 bg-color-5 text-color-1">
        </div>

        <div>
            <label for="fecha_fin" class="block font-medium mb-1 text-color-2">Fecha Fin:</label>
            <input type="date" id="fecha_fin" name="practica[fecha_fin]" required
                   class="w-full border border-color-3 rounded px-3 py-2 bg-color-5 text-color-1">
        </div>

        <div>
            <label for="horas_requeridas" class="block font-medium mb-1 text-color-2">Horas Requeridas:</label>
            <input type="number" id="horas_requeridas" name="practica[horas_requeridas]" 
                value="170" readonly
                class="w-full border border-color-3 rounded px-3 py-2 bg-color-5 text-color-1">
        </div>


        <div>
            <label for="horas_cumplidas" class="block font-medium mb-1 text-color-2">Horas Cumplidas:</label>
            <input type="number" id="horas_cumplidas" name="practica[horas_cumplidas]" required
                   class="w-full border border-color-3 rounded px-3 py-2 bg-color-5 text-color-1">
        </div>

        <div class="md:col-span-2">
            <label for="estado" class="block font-medium mb-1 text-color-2">Estado:</label>
            <select id="estado" name="practica[estado]" required
                    class="w-full border border-color-3 rounded px-3 py-2 bg-color-5 text-color-1">
                <option value="pendiente">Pendiente</option>
                <option value="en_curso">En Curso</option>
                <option value="finalizada">Finalizada</option>
            </select>
        </div>

        <div class="md:col-span-2">
            <button type="submit"
                    class="w-full bg-color-2 text-color-5 font-bold py-3 rounded-lg hover:bg-color-3 transition-colors">
                Crear Práctica
            </button>
        </div>
    </form>
</div>
</body>
</html>
