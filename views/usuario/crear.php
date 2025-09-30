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
    <title>Crear Usuario - Administrador</title>
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
        <h1 class="text-3xl font-bold mb-8 text-center text-color-1">Crear Usuario</h1>
        <form action="" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div>
                <label for="nombre" class="block font-medium mb-1 text-color-2">Nombre:</label>
                <input type="text" id="nombre" name="usuario[nombre]" required
                       class="w-full border border-color-3 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-color-2 bg-color-5 text-color-1">
            </div>

            <div>
                <label for="apellido" class="block font-medium mb-1 text-color-2">Apellido:</label>
                <input type="text" id="apellido" name="usuario[apellido]" required
                       class="w-full border border-color-3 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-color-2 bg-color-5 text-color-1">
            </div>

            <div>
                <label for="email" class="block font-medium mb-1 text-color-2">Email:</label>
                <input type="email" id="email" name="usuario[email]" required
                       class="w-full border border-color-3 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-color-2 bg-color-5 text-color-1">
            </div>

            <div>
                <label for="password" class="block font-medium mb-1 text-color-2">Contraseña:</label>
                <input type="password" id="password" name="usuario[password]" required
                       class="w-full border border-color-3 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-color-2 bg-color-5 text-color-1">
            </div>

            <div>
                <label for="telefono" class="block font-medium mb-1 text-color-2">Teléfono:</label>
                <input type="text" id="telefono" name="usuario[telefono]"
                       class="w-full border border-color-3 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-color-2 bg-color-5 text-color-1">
            </div>

            <div>
                <label for="id_rol" class="block font-medium mb-1 text-color-2">Rol:</label>
                <select id="id_rol" name="usuario[id_rol]" required
                        class="w-full border border-color-3 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-color-2 bg-color-5 text-color-1">
                    <option value="">Seleccione un rol</option>
                    <?php foreach ($rol as $r): ?>
                        <option value="<?= $r['id_rol'] ?>" <?= $r['nombre_rol'] === 'Administrador' ? 'selected' : '' ?>>
                            <?= $r['nombre_rol'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="md:col-span-2">
                <button type="submit"
                        class="w-full bg-color-2 text-color-5 font-bold py-3 rounded-lg hover:bg-color-3 transition-colors">
                    Crear Usuario
                </button>
            </div>
            <!-- Campos adicionales dinámicos -->
<div id="campos-estudiante" class="hidden md:col-span-2 mt-4 bg-color-4 p-4 rounded">
    <h3 class="font-bold mb-2 text-color-1">Datos Estudiante</h3>
    <div class="mb-2">
        <label class="text-color-2">Carrera:</label>
        <input type="text" name="estudiante[carrera]" class="w-full border rounded px-2 py-1">
    </div>
    <div class="mb-2">
        <label class="text-color-2">Semestre:</label>
        <input type="number" name="estudiante[semestre]" class="w-full border rounded px-2 py-1">
    </div>
    <div class="mb-2">
        <label class="text-color-2">Matrícula:</label>
        <input type="text" name="estudiante[matricula]" class="w-full border rounded px-2 py-1">
    </div>
</div>

<div id="campos-egresado" class="hidden md:col-span-2 mt-4 bg-color-4 p-4 rounded">
    <h3 class="font-bold mb-2 text-color-1">Datos Egresado</h3>
    <div class="mb-2">
        <label class="text-color-2">Carrera:</label>
        <input type="text" name="egresado[carrera]" class="w-full border rounded px-2 py-1">
    </div>
    <div class="mb-2">
        <label class="text-color-2">Año de Egreso:</label>
        <input type="number" name="egresado[anio_egreso]" class="w-full border rounded px-2 py-1">
    </div>
</div>

<script>
const rolSelect = document.getElementById('id_rol');
const estudianteDiv = document.getElementById('campos-estudiante');
const egresadoDiv = document.getElementById('campos-egresado');

rolSelect.addEventListener('change', () => {
    const rolTexto = rolSelect.options[rolSelect.selectedIndex].text.toLowerCase();
    estudianteDiv.classList.add('hidden');
    egresadoDiv.classList.add('hidden');

    if (rolTexto === 'estudiante') estudianteDiv.classList.remove('hidden');
    if (rolTexto === 'egresado') egresadoDiv.classList.remove('hidden');
});
</script>

        </form>
    </div>
</body>

</html>
