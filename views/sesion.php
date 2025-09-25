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
        .text-color-2 { color: var(--color-2); }
        .text-color-3 { color: var(--color-3); }
        .text-color-4 { color: var(--color-4); }
        .text-color-5 { color: var(--color-5); }

        .hover-bg-color-3:hover { background-color: var(--color-3); }
        .hover-bg-color-2:hover { background-color: var(--color-2); }
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

        <?php if(!empty($mensaje)): ?>
            <div class="mensaje text-red-600 mb-4 text-center font-semibold"><?php echo $mensaje; ?></div>
        <?php endif; ?>

        <form action="/login" method="post" class="space-y-4">
            <input type="email" name="email" placeholder="Email" required
                   class="w-full px-4 py-2 border border-color-3 rounded-md focus:outline-none focus:ring-2 focus:ring-color-4">
            <input type="password" name="password" placeholder="Contraseña" required
                   class="w-full px-4 py-2 border border-color-3 rounded-md focus:outline-none focus:ring-2 focus:ring-color-4">
            <button type="submit" class="w-full py-2 bg-color-3 text-white rounded-md font-semibold hover-bg-color-2 transition duration-300">
                Ingresar
            </button>
        </form>

        <div class="registro mt-6 text-center text-color-1">
            ¿No tienes cuenta?
            <a href="/usuario/crear" class="font-bold hover-text-color-4">Regístrate aquí</a>
        </div>
    </div>

</body>
</html>
