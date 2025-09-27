<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$id_practica = $_GET['id_practica'] ?? null;
if (!$id_practica) {
    echo "<p>No se seleccionó ninguna práctica. <a href='/practica'>Volver a la lista</a></p>";
    exit;
}

$id_usuario = $_GET['id_usuario'] ?? null; 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Asistencia</title>
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
    <h1 class="text-3xl font-bold mb-8 text-center text-color-1">Registrar Asistencia</h1>
    <form action="" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">

      <div class="md:col-span-2">
    <!-- Mostrar estudiante -->
    <label class="block font-medium mb-1 text-color-2">Estudiante:</label>
    <p class="px-3 py-2 border border-color-3 rounded bg-color-5 text-color-1">
        <?= $practica['estudiante_nombre'] ?? 'Estudiante no disponible' ?>
        <?= $practica['estudiante_apellido'] ?? '' ?>
    </p>
    <input type="hidden" name="id_usuario" value="<?= $practica['id_estudiante'] ?? '' ?>">

    <!-- Mostrar supervisor -->
    <label class="block font-medium mb-1 mt-4 text-color-2">Supervisor:</label>
    <p class="px-3 py-2 border border-color-3 rounded bg-color-5 text-color-1">
        <?= $practica['supervisor_nombre'] ?? 'Supervisor no disponible' ?>
        <?= $practica['supervisor_apellido'] ?? '' ?>
    </p>
    <input type="hidden" name="asistencia[verificado_por]" value="<?= $practica['id_supervisor'] ?? '' ?>">

    <!-- IMPORTANTE: enviar también el id_practica -->
    <input type="hidden" name="id_practica" value="<?= $practica['id_practica'] ?? '' ?>">
</div>


        <div>
            <label for="fecha" class="block font-medium mb-1 text-color-2">Fecha:</label>
            <input type="date" id="fecha" name="asistencia[fecha]" required
                   class="w-full border border-color-3 rounded px-3 py-2 bg-color-5 text-color-1"
                   value="<?= date('Y-m-d') ?>">
        </div>

        <div>
            <label for="hora_ingreso" class="block font-medium mb-1 text-color-2">Hora Ingreso:</label>
            <input type="time" id="hora_ingreso" name="asistencia[hora_ingreso]" required
                   class="w-full border border-color-3 rounded px-3 py-2 bg-color-5 text-color-1">
        </div>

        <div>
            <label for="hora_salida" class="block font-medium mb-1 text-color-2">Hora Salida:</label>
            <input type="time" id="hora_salida" name="asistencia[hora_salida]"
                   class="w-full border border-color-3 rounded px-3 py-2 bg-color-5 text-color-1">
        </div>

        <div class="md:col-span-2">
            <label for="observacion" class="block font-medium mb-1 text-color-2">Observación:</label>
            <textarea id="observacion" name="asistencia[observacion]" rows="3"
                      class="w-full border border-color-3 rounded px-3 py-2 bg-color-5 text-color-1"></textarea>
        </div>

        <div class="md:col-span-2">
            <button type="submit"
                    class="w-full bg-color-2 text-color-5 font-bold py-3 rounded-lg hover:bg-color-3 transition-colors">
                Registrar Asistencia
                <a href="/asistencia/crear?id_practica=<?= $practica['id_practica'] ?>">Registrar Asistencia</a>

            </button>
        </div>

    </form>
</div>
</body>
</html>
