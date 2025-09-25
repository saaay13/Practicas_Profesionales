<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nosotros</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --color-1: #000a23; /* Fondo más oscuro */
            --color-2: #02253d; /* Azul fuerte */
            --color-3: #153f59; /* Azul intermedio */
            --color-4: #94b8d7; /* Azul claro */
            --color-5: #cbd5e1; /* Gris azulado */
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
<body class="bg-color-5 min-h-screen p-6">
        <section class="relative text-white bg-color-2 text-center h-[200px] bg-fixed bg-cover bg-center mb-10">
            <div class="relative z-10 max-w-3xl mx-auto px-6 flex flex-col justify-center h-full">
                <h2 class="text-4xl sm:text-5xl font-bold mb-2 text-color-4">Nosotros</h2>
                <p class="text-color-4 text-lg">Somos una plataforma dedicada a conectar estudiantes y egresados con las mejores oportunidades de prácticas profesionales.
                Nuestro objetivo es brindar experiencias de aprendizaje reales y potenciar tu desarrollo profesional.
            </p>
        </div>
        </section>


        <!-- Equipo -->
        <section class="mb-16">
            <h2 class="text-3xl font-semibold text-color-1 text-center mb-8">Nuestro Equipo</h2>
            <div class="flex justify-center">
                <div class="bg-color-4 p-5 rounded-xl shadow hover:shadow-lg transition m-5">
                    <h3 class="text-xl font-bold mb-1 text-color-2">Kehila Molina</h3>
                    <h5 class="text-color-3 font-semibold mb-2">CEO</h5>
                    <p>Lidera la plataforma y asegura la calidad de las oportunidades de prácticas.</p>
                </div>
                <div class="bg-color-4 p-5 rounded-xl shadow hover:shadow-lg transition m-5">
                    <h3 class="text-xl font-bold mb-1 text-color-2">Susann Baldiviezo</h3>
                    <h5 class="text-color-3 font-semibold mb-2">CTO</h5>
                    <p>Responsable de la plataforma tecnológica y mejora continua de la experiencia del usuario.</p>
                </div>
                <div class="bg-color-4 p-5 rounded-xl shadow hover:shadow-lg transition m-5">
                    <h3 class="text-xl font-bold mb-1 text-color-2">Nicolas Sivila</h3>
                    <h5 class="text-color-3 font-semibold mb-2">COO</h5>
                    <p>Coordina los procesos internos y asegura la relación con empresas y estudiantes.</p>
                </div>
            </div>
        </section>
        <!-- Servicios --> <section class="mb-16 text-center"> <h2 class="text-3xl font-semibold text-color-1 text-center mb-8">Nuestros Servicios</h2> 
    <p class="text-lg max-w-2xl mx-auto text-color-3">Conectamos el talento del futuro con las oportunidades del presente.</p> 
    </section>
        <section class="mb-16">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-x-12 gap-y-12 max-w-6xl mx-auto px-6 justify-between">
            <div class="servicio-card">
            <div class="text-color-5 p-4 rounded-full mb-4">
                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L15 8H9L12 2zM12 22L9 16H15L12 22z"/></svg>
            </div>
            <h3 class="text-xl font-bold text-color-2 mb-2">Nuestra Plataforma</h3>
            <p class="text-color-3 text-center">Somos el puente digital que simplifica la búsqueda y gestión de prácticas profesionales.</p>
            <br>
        </div>
        <div class="servicio-card">
            <div class="text-color-5 p-4 rounded-full mb-4">
                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L15 8H9L12 2zM12 22L9 16H15L12 22z"/></svg>
            </div>
            <br>
            <br>
            <br>
            <h3 class="text-xl font-bold text-color-2 mb-2">Nuestra Comunidad</h3>
            <p class="text-color-3 text-center">Servicios diseñados para estudiantes y egresados recientes en busca de experiencia.</p>
            
        </div>
        <div class="servicio-card">
            <div class="text-color-5 p-4 rounded-full mb-4">
                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L15 8H9L12 2zM12 22L9 16H15L12 22z"/></svg>
            </div>
            <h3 class="text-xl font-bold text-color-2 mb-2">Conectamos Talento</h3>
            <p class="text-color-3 text-center">Actuamos como intermediarios de confianza y generamos oportunidades.</p>
            <br>
        </div>
        <div class="servicio-card">
            <div class="text-color-5 p-4 rounded-full mb-4">
                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L15 8H9L12 2zM12 22L9 16H15L12 22z"/></svg>
            </div>
            <br>
            <br>
            <br>
            <h3 class="text-xl font-bold text-color-2 mb-2">Ventajas Exclusivas</h3>
            <p class="text-color-3 text-center">Acceso a convocatorias, seguimiento en tiempo real y gestión ágil de postulantes.</p>
        </div>
    </div>
</section>
</body>

</html>
