<?php
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Acceso Denegado</title>
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
        .text-color-4 { color: var(--color-4); }
    </style>
</head>
<body class="bg-color-5 flex items-center justify-center h-screen">
    <div class="bg-color-4 p-10 rounded-xl shadow-xl text-center max-w-md">
        <h1 class="text-4xl font-bold mb-4 text-color-1">⚠ Acceso Denegado</h1>
        <p class="text-color-1 mb-6">No tienes permisos para acceder a esta página.</p>
        <a href="/" class="inline-block bg-color-2 text-color-5 px-6 py-3 rounded font-semibold hover:bg-color-3 transition">
            Volver al Inicio
        </a>
    </div>
</body>
</html>
