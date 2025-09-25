<?php
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plataforma</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Paleta de colores personalizada */
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
        .text-color-1 { color: var(--color-1); }
        .text-color-4 { color: var(--color-4); }
        .text-color-5 { color: var(--color-5); }
        .hover-bg-color-3:hover { background-color: var(--color-3); }
        .hover-text-color-4:hover { color: var(--color-4); }
        .gradient-color { background: linear-gradient(to right, var(--color-1), var(--color-2), var(--color-3)); }
    </style>
</head>
<body class="flex flex-col min-h-screen bg-color-5 text-color-1">
<nav class="gradient-color text-color-5 shadow-md">
<div class="w-full mx-0 px-9 flex items-center justify-between h-24">
    <div class="flex items-center space-x-3">
        <a href="/">
            <img src="/ruta/a/tu/logo.png" alt="Logo" class="h-12 w-12 object-contain">
        </a>
        <a href="/" class="text-2xl font-bold tracking-wide hover-text-color-4 transition duration-300">
            PracTIca
        </a>
    </div>

            <!-- Menú desktop -->
<div class="hidden md:flex ml-10 space-x-4">
                        <a href="/" class="px-3 py-2 rounded hover-bg-color-3 transition duration-300">Inicio</a>

                <!-- Links según rol -->
                <?php if (isset($_SESSION["usuario_activo"])): ?>

                            <!-- Menú según rol -->
                            <?php if ($_SESSION["rol"] ===1): ?>
                                <a href="/usuario" class="px-3 py-2 rounded hover-bg-color-3 transition duration-300">Usuarios</a>
                                <a href="/empresa" class="px-3 py-2 rounded hover-bg-color-3 transition duration-300">Empresas</a>
                                <a href="/convocatoria" class="px-3 py-2 rounded hover-bg-color-3 transition duration-300">Convocatorias</a>
                                <a href="/practica" class="px-3 py-2 rounded hover-bg-color-3 transition duration-300">Prácticas</a>
                                <a href="/postulacion" class="px-3 py-2 rounded hover-bg-color-3 transition duration-300">Postulaciones</a>
                                <a href="/asistencia" class="px-3 py-2 rounded hover-bg-color-3 transition duration-300">Asistencia</a>

                            <?php elseif ($_SESSION["rol"] === 2): ?>
                                <a href="/empresa/panel" class="px-3 py-2 rounded hover-bg-color-3 transition duration-300">Mi Panel</a>
                                <a href="/convocatoria" class="px-3 py-2 rounded hover-bg-color-3 transition duration-300">Mis Convocatorias</a>
                                <a href="/postulaciones" class="px-3 py-2 rounded hover-bg-color-3 transition duration-300">Postulaciones</a>

                            <?php elseif ($_SESSION["rol"] ===3): ?>
                                <a href="/convocatoria" class="px-3 py-2 rounded hover-bg-color-3 transition duration-300">Convocatorias</a>
                                <a href="/postulaciones" class="px-3 py-2 rounded hover-bg-color-3 transition duration-300">Mis Postulaciones</a>
                            <?php endif; ?>

                            <!-- Saludo y logout -->
                            <span class="px-3 py-2 font-semibold">👋 Hola, <?= htmlspecialchars($_SESSION["nombre"]) ?></span>
                            <form action="/logout" method="GET" class="inline">
                                <button type="submit" class="px-3 py-2 rounded hover-bg-color-3 transition duration-300">Cerrar sesión</button>
                            </form>    

                        <?php else: ?>
                            <!-- Menú para usuarios no registrados -->
                            <a href="/empresa/panel" class="px-3 py-2 rounded hover-bg-color-3 transition duration-300">Empresa</a>
                            <a href="/convocatoria" class="px-3 py-2 rounded hover-bg-color-3 transition duration-300">Convocatorias</a>
                            <a href="/contacto" class="px-3 py-2 rounded hover-bg-color-3 transition duration-300">Contacto</a>
                            <a href="/nosotros" class="px-3 py-2 rounded hover-bg-color-3 transition duration-300">Nosotros</a>
                            <a href="/login" class="px-3 py-2 rounded hover-bg-color-3 transition duration-300">Login</a>
                        <?php endif; ?>
    </div>
</nav>




    <!-- ===================== Contenido principal ===================== -->
    <main class="flex-grow w-full">
        <?php echo $contenido ?>
    </main>

    <!-- ===================== Footer ===================== -->
    <footer class="gradient-color text-color-5 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 py-10 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <p class="text-sm">&copy; <?php echo date("Y"); ?> MiSitio. Todos los derechos reservados.</p>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <a href="#" class="hover-text-color-4 transition duration-300">Facebook</a>
                    <a href="#" class="hover-text-color-4 transition duration-300">Twitter</a>
                    <a href="#" class="hover-text-color-4 transition duration-300">Instagram</a>
                    <a href="#" class="hover-text-color-4 transition duration-300">LinkedIn</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- ===================== Script menú móvil ===================== -->
    <script>
        const btn = document.getElementById('menu-btn');
        const menu = document.getElementById('mobile-menu');
        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });
    </script>

</body>
</html>
