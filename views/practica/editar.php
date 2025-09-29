<?php
if (session_status() === PHP_SESSION_NONE) session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Práctica</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-6">

<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-4">Editar Práctica</h1>

    <form action="" method="POST" class="space-y-4">

        <!-- Postulación -->
        <div>
            <label for="id_postulacion" class="block text-sm font-medium text-gray-700">Postulación:</label>
            <select name="practica[id_postulacion]" id="id_postulacion" class="mt-1 block w-full border border-gray-300 rounded-md p-2">
                <option value="">Seleccione una postulación</option>
                <?php foreach ($postulacion as $p): ?>
                    <option value="<?= $p['id_postulacion'] ?>" <?= ($p['id_postulacion'] == $practica->id_postulacion) ? 'selected' : '' ?>>
                        <?= $p['id_postulacion'] ?> - <?= $p['id_usuario'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Supervisor -->
        <div>
            <label for="id_supervisor" class="block text-sm font-medium text-gray-700">Supervisor:</label>
            <select name="practica[id_supervisor]" id="id_supervisor" class="mt-1 block w-full border border-gray-300 rounded-md p-2">
                <option value="">Seleccione un supervisor</option>
                <?php foreach ($usuario as $u): ?>
                    <option value="<?= $u['id_usuario'] ?>" <?= ($u['id_usuario'] == $practica->id_supervisor) ? 'selected' : '' ?>>
                        <?= $u['nombre'] ?> <?= $u['apellido'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Fecha de inicio -->
        <div>
            <label for="fecha_inicio" class="block text-sm font-medium text-gray-700">Fecha de inicio:</label>
            <input type="date" name="practica[fecha_inicio]" id="fecha_inicio" class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                   value="<?= $practica->fecha_inicio ?? '' ?>">
        </div>

        <!-- Fecha de fin -->
        <div>
            <label for="fecha_fin" class="block text-sm font-medium text-gray-700">Fecha de fin:</label>
            <input type="date" name="practica[fecha_fin]" id="fecha_fin" class="mt-1 block w-full border border-gray-300 rounded-md p-2"
                   value="<?= $practica->fecha_fin ?? '' ?>">
        </div>

        <!-- Estado -->
        <div>
            <label for="estado" class="block text-sm font-medium text-gray-700">Estado:</label>
            <select name="practica[estado]" id="estado" class="mt-1 block w-full border border-gray-300 rounded-md p-2">
                <option value="en_curso" <?= ($practica->estado ?? '') === 'en_curso' ? 'selected' : '' ?>>En curso</option>
                <option value="finalizado" <?= ($practica->estado ?? '') === 'finalizado' ? 'selected' : '' ?>>Finalizado</option>
            </select>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                Guardar cambios
            </button>
        </div>

    </form>
</div>

</body>
</html>
