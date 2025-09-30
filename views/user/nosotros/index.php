<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Nosotros - Plataforma de Prácticas</title>
<script src="https://cdn.tailwindcss.com"></script>
<style>
    :root {
        --color-1: #000a23;
        --color-2: #02253d;
        --color-3: #153f59;
        --color-4: #94b8d7;
        --color-5: #cbd5e1;
        --gradient-1: linear-gradient(135deg, #02253d, #09406e);
        --gradient-2: linear-gradient(135deg, #153f59, #3f6c99);
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

    .gradient-hero { background: var(--gradient-1); }
    .gradient-card { background: var(--gradient-2); }

</style>
</head>
<body class="bg-color-5 font-sans">

<!-- Hero -->
 <section class="relative text-white bg-color-2 text-center h-[200px] bg-fixed bg-cover bg-center mb-10">
    <div class="relative z-10 max-w-3xl mx-auto px-6 flex flex-col justify-center h-full">
        <h2 class="text-4xl sm:text-5xl font-bold mb-2 text-color-4">Nosotros</h2>
        <p class="text-color-4 text-lg">onectamos estudiantes y egresados con las mejores oportunidades
             de prácticas profesionales. Brindamos experiencias reales para potenciar tu desarrollo
              profesional.</p>
    </div>
</section>
<!-- Equipo -->
<section class="py-24 bg-color-5">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-5xl font-bold mb-16 text-color-1">Nuestro Equipo</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-16">
            <!-- Tarjeta 1 -->
            <div class="relative bg-white rounded-3xl shadow-xl overflow-hidden hover:scale-105 transform transition duration-500">
                <div class="absolute top-0 left-0 w-full h-1/2 gradient-card"></div>
                <div class="p-10 relative z-10 flex flex-col items-center">
                    <img src="https://via.placeholder.com/150" alt="Kehila Molina" class="w-36 h-36 rounded-full border-8 border-color-5 -mt-20 mb-6">
                    <h3 class="text-3xl font-bold text-color-1 mb-2">Kehila Molina</h3>
                    <h5 class="text-color-4 font-semibold mb-4">CEO</h5>
                    <p class="text-color-2 text-center max-w-xs">Lidera la plataforma y asegura la calidad de las oportunidades de prácticas.</p>
                </div>
            </div>

            <!-- Tarjeta 2 -->
            <div class="relative bg-white rounded-3xl shadow-xl overflow-hidden hover:scale-105 transform transition duration-500">
                <div class="absolute top-0 left-0 w-full h-1/2 gradient-card"></div>
                <div class="p-10 relative z-10 flex flex-col items-center">
                    <img src="https://via.placeholder.com/150" alt="Susann Baldiviezo" class="w-36 h-36 rounded-full border-8 border-color-5 -mt-20 mb-6">
                    <h3 class="text-3xl font-bold text-color-1 mb-2">Susann Baldiviezo</h3>
                    <h5 class="text-color-4 font-semibold mb-4">CTO</h5>
                    <p class="text-color-2 text-center max-w-xs">Responsable de la plataforma tecnológica y mejora continua de la experiencia del usuario.</p>
                </div>
            </div>

            <!-- Tarjeta 3 -->
            <div class="relative bg-white rounded-3xl shadow-xl overflow-hidden hover:scale-105 transform transition duration-500">
                <div class="absolute top-0 left-0 w-full h-1/2 gradient-card"></div>
                <div class="p-10 relative z-10 flex flex-col items-center">
                    <img src="https://via.placeholder.com/150" alt="Nicolas Sivila" class="w-36 h-36 rounded-full border-8 border-color-5 -mt-20 mb-6">
                    <h3 class="text-3xl font-bold text-color-1 mb-2">Nicolas Sivila</h3>
                    <h5 class="text-color-4 font-semibold mb-4">COO</h5>
                    <p class="text-color-2 text-center max-w-xs">Coordina los procesos internos y asegura la relación con empresas y estudiantes.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-24 gradient-hero text-color-5">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-5xl font-bold mb-16">Nuestros Servicios</h2>
        <p class="text-xl max-w-3xl mx-auto mb-12">Conectamos el talento del futuro con las oportunidades del presente, ofreciendo herramientas y soporte completo.</p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
            <div class="bg-white rounded-3xl shadow-lg p-8 hover:shadow-2xl transition transform hover:-translate-y-2">
                <div class="w-16 h-16 mx-auto mb-6 rounded-full bg-color-2 flex items-center justify-center">
                    <svg class="w-8 h-8 text-color-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L15 8H9L12 2zM12 22L9 16H15L12 22z"/></svg>
                </div>
                <h3 class="text-2xl font-bold mb-2 text-color-1">Nuestra Plataforma</h3>
                <p class="text-color-2">Somos el puente digital que simplifica la búsqueda y gestión de prácticas profesionales.</p>
            </div>

            <div class="bg-white rounded-3xl shadow-lg p-8 hover:shadow-2xl transition transform hover:-translate-y-2">
                <div class="w-16 h-16 mx-auto mb-6 rounded-full bg-color-2 flex items-center justify-center">
                    <svg class="w-8 h-8 text-color-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L15 8H9L12 2zM12 22L9 16H15L12 22z"/></svg>
                </div>
                <h3 class="text-2xl font-bold mb-2 text-color-1">Nuestra Comunidad</h3>
                <p class="text-color-2">Servicios diseñados para estudiantes y egresados recientes en busca de experiencia.</p>
            </div>

            <div class="bg-white rounded-3xl shadow-lg p-8 hover:shadow-2xl transition transform hover:-translate-y-2">
                <div class="w-16 h-16 mx-auto mb-6 rounded-full bg-color-2 flex items-center justify-center">
                    <svg class="w-8 h-8 text-color-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L15 8H9L12 2zM12 22L9 16H15L12 22z"/></svg>
                </div>
                <h3 class="text-2xl font-bold mb-2 text-color-1">Conectamos Talento</h3>
                <p class="text-color-2">Actuamos como intermediarios de confianza y generamos oportunidades.</p>
            </div>

            <div class="bg-white rounded-3xl shadow-lg p-8 hover:shadow-2xl transition transform hover:-translate-y-2">
                <div class="w-16 h-16 mx-auto mb-6 rounded-full bg-color-2 flex items-center justify-center">
                    <svg class="w-8 h-8 text-color-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L15 8H9L12 2zM12 22L9 16H15L12 22z"/></svg>
                </div>
                <h3 class="text-2xl font-bold mb-2 text-color-1">Ventajas Exclusivas</h3>
                <p class="text-color-2">Acceso a convocatorias, seguimiento en tiempo real y gestión ágil de postulantes.</p>
            </div>
        </div>
    </div>
</section>

</body>
</html>
