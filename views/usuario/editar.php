<?php
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Editar Usuario</title>
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
    <h1 class="text-3xl font-bold mb-8 text-center text-color-1">Editar Usuario</h1>

    <form action="" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="flex flex-col">
            <label class="mb-1 text-color-2 font-semibold">Nombre</label>
            <input type="text" name="usuario[nombre]" value="<?= $usuario->nombre ?>" required class="p-2 border border-color-3 rounded">
        </div>
        <div class="flex flex-col">
            <label class="mb-1 text-color-2 font-semibold">Apellido</label>
            <input type="text" name="usuario[apellido]" value="<?= $usuario->apellido ?>" required class="p-2 border border-color-3 rounded">
        </div>
        <div class="flex flex-col">
            <label class="mb-1 text-color-2 font-semibold">Email</label>
            <input type="email" name="usuario[email]" value="<?= $usuario->email ?>" required class="p-2 border border-color-3 rounded">
        </div>
        <div class="flex flex-col">
            <label class="mb-1 text-color-2 font-semibold">Teléfono</label>
            <input type="text" name="usuario[telefono]" value="<?= $usuario->telefono ?>" class="p-2 border border-color-3 rounded">
        </div>
        <div class="md:col-span-2 flex justify-center mt-4">
            <button type="submit" class="bg-color-2 text-color-5 font-bold py-2 px-6 rounded hover:bg-color-3 transition">Actualizar Usuario</button>
        </div>
    </form>
</div>
</body>
</html>
