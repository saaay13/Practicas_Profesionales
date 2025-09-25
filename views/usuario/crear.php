<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Usuario</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h1 class="text-2xl font-bold mb-6 text-center">Crear Usuario</h1>
        <form action="" method="POST" enctype="multipart/form-data" class="space-y-4">
            
            <div>
                <label for="nombre" class="block font-medium mb-1">Nombre:</label>
                <input type="text" id="nombre" name="usuario[nombre]" required
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="apellido" class="block font-medium mb-1">Apellido:</label>
                <input type="text" id="apellido" name="usuario[apellido]" required
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="email" class="block font-medium mb-1">Email:</label>
                <input type="email" id="email" name="usuario[email]" required
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="password" class="block font-medium mb-1">Contraseña:</label>
                <input type="password" id="password" name="usuario[password]" required
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="telefono" class="block font-medium mb-1">Teléfono:</label>
                <input type="text" id="telefono" name="usuario[telefono]"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="id_rol" class="block font-medium mb-1">Rol:</label>
                <select id="id_rol" name="usuario[id_rol]" required
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Seleccione un rol</option>
                    <?php foreach ($rol as $r): ?>
                        <option value="<?= $r['id_rol'] ?>"><?= $r['nombre_rol'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit"
                    class="w-full bg-blue-600 text-white font-bold py-2 rounded hover:bg-blue-700 transition-colors">
                Crear Usuario
            </button>
        </form>
    </div>
</body>
</html>
