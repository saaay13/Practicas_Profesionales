<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$rol = $_SESSION["rol"] ?? null;
$links = [
    1 => [
        ['url'=>'/usuario','label'=>'Usuarios'],
        ['url'=>'/empresa','label'=>'Empresas'],
        ['url'=>'/convocatoria','label'=>'Convocatorias'],
        ['url'=>'/postulacion','label'=>'Postulaciones'],
        ['url'=>'/practica','label'=>'Prácticas'],
        ['url'=>'/asistencia','label'=>'Asistencia'],
        ['url'=>'/mensaje/index','label'=>'Mesaje'],
    ],
    2 => [
        ['url'=>'/empresa/misempresas','label'=>'Mi Panel'],
        ['url'=>'/empresa/misconvocatorias','label'=>'Mis Convocatorias'],
        ['url'=>'/empresa/mispostulaciones','label'=>'Postulaciones'],
    ],
    3 => [
        ['url'=>'/user/convocatoria','label'=>'Convocatorias'],
        ['url'=>'/empresa/panel','label'=>'Empresas'],
        ['url'=>'/usuario/mispostulaciones','label'=>'Mis Postulaciones'],
    ],
    4 => [
        ['url'=>'/user/convocatoria','label'=>'Convocatorias'],
        ['url'=>'/empresa/panel','label'=>'Empresas'],
        ['url'=>'/usuario/mispostulaciones','label'=>'Mis Postulaciones'],

    ]
    
];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plataforma</title>
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
        <a href="/"><img src="/img/logoSF.png" alt="Logo" class="h-10 w-10 object-contain"></a>
        <a href="/" class="text-2xl font-bold tracking-wide text-color-4 hover-text-color-5 transition duration-300">PracTIca</a>
    </div>

    <div class="hidden md:flex ml-10 space-x-4">
        <a href="/" class="px-3 py-2 rounded hover-bg-color-3 transition duration-300">Inicio</a>
        <?php if (!empty($_SESSION["login"])): ?>
            <?php 
            if ($rol && isset($links[$rol])) {
                foreach($links[$rol] as $link) {
                    echo '<a href="'.$link['url'].'" class="px-3 py-2 rounded hover-bg-color-3 transition duration-300">'.$link['label'].'</a>';
                }
            }
            ?>
        <span class="px-3 py-2 font-semibold">
        <a href="/contacto/crear" class="px-3 py-2 rounded hover-bg-color-3 transition duration-300">Contacto</a>
    👋 Hola, <?= htmlspecialchars($_SESSION["nombre"] ?? 'Usuario') ?>
        </span>
            <form action="/logout" method="GET" class="inline">
                <button type="submit" class="px-3 py-2 rounded hover-bg-color-3 transition duration-300">Cerrar sesión</button>
            </form>
        <?php else: ?>
            <a href="/empresa/panel" class="px-3 py-2 rounded hover-bg-color-3 transition duration-300">Empresa</a>
            <a href="/user/convocatoria" class="px-3 py-2 rounded hover-bg-color-3 transition duration-300">Convocatorias</a>
            <a href="/nosotros" class="px-3 py-2 rounded hover-bg-color-3 transition duration-300">Nosotros</a>
            <a href="/contacto/crear" class="px-3 py-2 rounded hover-bg-color-3 transition duration-300">Contacto</a>
            <a href="/login" class="px-3 py-2 rounded hover-bg-color-3 transition duration-300">Login</a>

        <?php endif; ?>
    </div>
</div>
</nav>

<main class="flex-grow w-full">
    <?php echo $contenido ?>
</main>
<br>
<br>
<footer class="bg-color-1 text-color-5 mt-auto shadow-lg">
    <div class="max-w-7xl mx-auto px-4 py-10 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between gap-8">
        
        <!-- Logo y descripción -->
        <div class="flex flex-col items-center md:items-start">
            <a href="/"><img src="/img/logoSF.png" alt="Logo" class="h-10 w-10 object-contain"></a>
            <p class="mt-2 text-sm">MiSitio - Conectando estudiantes y empresas</p>
        </div>

        <!-- Menú vertical de enlaces -->
        <div class="flex flex-col space-y-2">
            <?php if ($rol && isset($links[$rol])): ?>
                <?php foreach($links[$rol] as $link): ?>
                    <a href="<?= $link['url'] ?>" class="hover:text-color-4 transition"><?= $link['label'] ?></a>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Redes sociales -->
        <div class="flex space-x-4 justify-center md:justify-start mt-4 md:mt-0">
            <a href="#" class="hover:text-color-4 transition" aria-label="Facebook">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.522-4.477-10-10-10S2 6.478 2 12c0 5.004 3.657 9.128 8.438 9.876v-6.987h-2.54v-2.89h2.54V9.797c0-2.507 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.463h-1.26c-1.243 0-1.63.771-1.63 1.562v1.875h2.773l-.443 2.89h-2.33v6.987C18.343 21.128 22 17.004 22 12z"/></svg>
            </a>
            <a href="#" class="hover:text-color-4 transition" aria-label="Twitter">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M22.162 5.656c-.793.352-1.644.588-2.538.694a4.456 4.456 0 001.955-2.458 8.91 8.91 0 01-2.823 1.08 4.448 4.448 0 00-7.58 4.054A12.62 12.62 0 013.15 4.92a4.447 4.447 0 001.377 5.93 4.435 4.435 0 01-2.016-.558v.056a4.45 4.45 0 003.563 4.356 4.43 4.43 0 01-2.012.077 4.451 4.451 0 004.155 3.08 8.91 8.91 0 01-5.514 1.9A8.97 8.97 0 012 19.54a12.558 12.558 0 006.82 2"/></svg>
            </a>
            <a href="#" class="hover:text-color-4 transition" aria-label="Instagram">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M7 2C4.243 2 2 4.243 2 7v10c0 2.757 2.243 5 5 5h10c2.757 0 5-2.243 5-5V7c0-2.757-2.243-5-5-5H7zm0 2h10a3 3 0 013 3v10a3 3 0 01-3 3H7a3 3 0 01-3-3V7a3 3 0 013-3zm8 1a1 1 0 100 2 1 1 0 000-2zM12 7a5 5 0 100 10 5 5 0 000-10z"/></svg>
            </a>
            <a href="#" class="hover:text-color-4 transition" aria-label="LinkedIn">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M4.98 3.5C3.34 3.5 2 4.84 2 6.48s1.34 2.98 2.98 2.98 2.98-1.34 2.98-2.98S6.62 3.5 4.98 3.5zM2.4 9h5.16V21H2.4V9zm7.12 0h4.92v1.66h.07c.69-1.3 2.38-2.68 4.9-2.68 5.24 0 6.2 3.45 6.2 7.93V21h-5.16v-6.87c0-1.64-.03-3.75-2.28-3.75-2.28 0-2.63 1.78-2.63 3.62V21H9.52V9z"/></svg>
            </a>
        </div>
    </div>
</footer>


<script>
    const btn = document.getElementById('menu-btn');
    const menu = document.getElementById('mobile-menu');
    btn?.addEventListener('click', () => {
        menu.classList.toggle('hidden');
    });
</script>

</body>
</html>


