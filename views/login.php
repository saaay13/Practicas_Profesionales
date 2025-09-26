<?php
if (session_status() === PHP_SESSION_NONE) session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --color-1: #000a23;
            --color-2: #02253d;
            --color-3: #153f59;
            --color-4: #94b8d7;
            --color-5: #cbd5e1;
        }
        .bg-color-1 { background-color: var(--color-1); }
        .bg-color-2 { background-color: var(--color-2); }
        .bg-color-3 { background-color: var(--color-3); }
        .bg-color-4 { background-color: var(--color-4); }
        .bg-color-5 { background-color: var(--color-5); }

        .text-color-1 { color: var(--color-1); }
        .text-color-4 { color: var(--color-4); }
        .text-color-2 { color: var(--color-2); }
        .text-color-3 { color: var(--color-3); }
        .text-color-5 { color: var(--color-5); }
        .hover-bg-color-2:hover { background-color: var(--color-2); }
        .hover-bg-color-3:hover { background-color: var(--color-3); }
        .hover-text-color-4:hover { color: var(--color-4); }
    </style>
</head>
<body class="flex items-center justify-center h-screen" style="
    background: linear-gradient(
        135deg, 
        var(--color-1), 
        var(--color-2), 
        var(--color-3), 
        var(--color-4), 
        var(--color-5)
    );
">

<div class="bg-color-5 p-8 rounded-xl shadow-xl w-96">
    <h2 class="text-color-1 text-2xl font-bold mb-6 text-center">Iniciar Sesión</h2>

    <?php if (!empty($errores)): ?>
        <?php foreach($errores as $error): ?>
            <div class="mb-4 p-3 rounded bg-red-100 text-red-700 border border-red-300 text-center font-semibold">
                <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <form action="" method="POST" class="space-y-4">
        <div>
            <label for="email" class="block text-sm font-medium text-color-1">Email</label>
            <input type="email" name="email" id="email"
                   class="mt-1 block w-full rounded-md border border-color-3 p-2 focus:outline-none focus:ring-2 focus:ring-color-4"
                   required value="<?= htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-color-1">Contraseña</label>
            <input type="password" name="password" id="password"
                   class="mt-1 block w-full rounded-md border border-color-3 p-2 focus:outline-none focus:ring-2 focus:ring-color-4"
                   required value="<?= htmlspecialchars($_POST['password'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
        </div>

        <button type="submit"
                class="w-full py-2 bg-color-3 text-color-5 rounded-md font-semibold hover-bg-color-2 transition duration-300">
            Ingresar
        </button>
    </form>

    <div class="mt-6 text-center text-color-1">
        ¿No tienes cuenta?
        <a href="/usuario/crear" class="font-bold hover-text-color-4">Regístrate aquí</a>
    </div>
</div>

</body>
</html>
