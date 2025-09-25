<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Plataforma de Prácticas</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    :root {
      --color-1: #000a23; /* Fondo más oscuro */
      --color-2: #02253d; /* Azul fuerte */
      --color-3: #153f59; /* Azul intermedio */
      --color-4: #94b8d7; /* Azul claro */
      --color-5: #cbd5e1; /* Gris azulado */
    }
  </style>
</head>

<body class="flex flex-col min-h-screen bg-[var(--color-5)]">
  <main class="flex-grow">
    <!-- Hero con imagen de fondo -->
<section class="relative text-white text-center h-[500px] bg-cover bg-center bg-fixed"
         style="background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('http://localhost:8080/img/inicio.png');">
  <div class="relative z-10 max-w-3xl mx-auto px-6 pt-32">
    <h2 class="text-4xl sm:text-5xl font-bold mb-4">Impulsa tu carrera profesional</h2>
    <p class="mb-6 text-[var(--color-5)]">
      Encuentra mejores oportunidades de prácticas profesionales en tu área de estudio y comienza tu camino hacia el éxito.
    </p>
    <a href="#"
       class="bg-[var(--color-4)] text-[var(--color-1)] font-bold py-3 px-6 rounded-lg hover:bg-[var(--color-5)] transition">
       Explorar Prácticas
    </a>
  </div>
</section>





    <!-- Convocatorias -->
    <section class="py-12 bg-[var(--color-5)] text-white">
      <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
          <div class="bg-[var(--color-2)] p-6 rounded-lg shadow-md">
            <div class="h-32 bg-[var(--color-1)] mb-4 flex items-center justify-center">📷</div>
            <h3 class="text-lg font-bold mb-2 text-[var(--color-4)]">Práctica en Desarrollo Web</h3>
            <p class="text-sm mb-4">Aprende y aplica tus conocimientos en programación y diseño de sitios web en un entorno profesional.</p>
            <a href="#" class="bg-[var(--color-4)] text-[var(--color-1)] px-4 py-2 rounded">Ver más</a>
          </div>

          <div class="bg-[var(--color-2)] p-6 rounded-lg shadow-md">
            <div class="h-32 bg-[var(--color-1)] mb-4 flex items-center justify-center">📷</div>
            <h3 class="text-lg font-bold mb-2 text-[var(--color-4)]">Práctica en Redes y Telecomunicaciones</h3>
            <p class="text-sm mb-4">Participa en proyectos de configuración, mantenimiento y monitoreo de redes corporativas.</p>
            <a href="#" class="bg-[var(--color-4)] text-[var(--color-1)] px-4 py-2 rounded">Ver más</a>
          </div>

          <div class="bg-[var(--color-2)] p-6 rounded-lg shadow-md">
            <div class="h-32 bg-[var(--color-1)] mb-4 flex items-center justify-center">📷</div>
            <h3 class="text-lg font-bold mb-2 text-[var(--color-4)]">Práctica en Desarrollo de Software</h3>
            <p class="text-sm mb-4">Contribuye en el desarrollo de aplicaciones y mejora tus habilidades de programación.</p>
            <a href="#" class="bg-[var(--color-4)] text-[var(--color-1)] px-4 py-2 rounded">Ver más</a>
          </div>
        </div>
      </div>
    </section>

    <!-- Empresas destacadas -->
    <section class="py-12 bg-[var(--color-5)] text-[var(--color-1)]">
      <h2 class="text-2xl font-bold text-center mb-8">Empresas Destacadas</h2>
      <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
        <div class="bg-[var(--color-2)] text-white p-6 rounded-lg shadow-md">
          <div class="h-32 bg-[var(--color-1)] mb-4 flex items-center justify-center">🏢</div>
          <h3 class="text-lg font-bold mb-2 text-[var(--color-4)]">Empresa Alpha</h3>
          <p class="text-sm mb-1">Rubro: Tecnología y Telecomunicaciones</p>
          <p class="text-sm mb-4">Carreras aceptadas: Ing. en Redes</p>
          <a href="#" class="bg-[var(--color-4)] text-[var(--color-1)] px-4 py-2 rounded">Ver Convocatorias</a>
        </div>

        <div class="bg-[var(--color-2)] text-white p-6 rounded-lg shadow-md">
          <div class="h-32 bg-[var(--color-1)] mb-4 flex items-center justify-center">🏢</div>
          <h3 class="text-lg font-bold mb-2 text-[var(--color-4)]">Empresa Beta</h3>
          <p class="text-sm mb-1">Rubro: Desarrollo de Software</p>
          <p class="text-sm mb-4">Carreras aceptadas: Ing. de Sistemas</p>
          <a href="#" class="bg-[var(--color-4)] text-[var(--color-1)] px-4 py-2 rounded">Ver Convocatorias</a>
        </div>

        <div class="bg-[var(--color-2)] text-white p-6 rounded-lg shadow-md">
          <div class="h-32 bg-[var(--color-1)] mb-4 flex items-center justify-center">🏢</div>
          <h3 class="text-lg font-bold mb-2 text-[var(--color-4)]">Empresa Gamma</h3>
          <p class="text-sm mb-1">Rubro: Telecomunicaciones</p>
          <p class="text-sm mb-4">Carreras aceptadas: Ing. en Redes</p>
          <a href="#" class="bg-[var(--color-4)] text-[var(--color-1)] px-4 py-2 rounded">Ver Convocatorias</a>
        </div>
      </div>
    </section>

    <!-- Información de apoyo -->
    <section class="py-12 bg-[var(--color-5)] text-[var(--color-1)]">
      <h2 class="text-2xl font-bold text-center mb-10">Información de Apoyo</h2>
      <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-4 gap-6">
        <!-- Tarjeta 1 -->
        <div class="bg-white p-6 rounded-lg shadow-md flex flex-col justify-between">
          <div>
            <div class="h-32 bg-[var(--color-4)] mb-4 flex items-center justify-center">📘</div>
            <h4 class="font-bold mb-2">Guía definitiva para tu CV</h4>
            <p class="text-sm text-gray-600 mb-4">Descripción de guía...</p>
          </div>
          <a href="#" class="bg-[var(--color-2)] text-white py-2 px-4 rounded text-center">Descargar PDF</a>
        </div>
        <!-- Tarjeta 2 -->
        <div class="bg-white p-6 rounded-lg shadow-md flex flex-col justify-between">
          <div>
            <div class="h-32 bg-[var(--color-4)] mb-4 flex items-center justify-center">🎥</div>
            <h4 class="font-bold mb-2">Nombre de Taller</h4>
            <p class="text-sm text-gray-600 mb-4">Descripción de taller...</p>
          </div>
          <a href="#" class="bg-[var(--color-2)] text-white py-2 px-4 rounded text-center">Ver Video</a>
        </div>
        <!-- Tarjeta 3 -->
        <div class="bg-white p-6 rounded-lg shadow-md flex flex-col justify-between">
          <div>
            <div class="h-32 bg-[var(--color-4)] mb-4 flex items-center justify-center">📑</div>
            <h4 class="font-bold mb-2">Plantillas de Cartas de Presentación</h4>
            <p class="text-sm text-gray-600 mb-4">Información...</p>
          </div>
          <a href="#" class="bg-[var(--color-2)] text-white py-2 px-4 rounded text-center">Ver</a>
        </div>
        <!-- Tarjeta 4 -->
        <div class="bg-white p-6 rounded-lg shadow-md flex flex-col justify-between">
          <div>
            <h4 class="font-bold mb-2 text-[var(--color-2)]">Próximos Eventos</h4>
            <ul class="space-y-2 text-sm text-gray-700">
              <li class="flex justify-between items-center">
                Información de evento <button class="bg-[var(--color-2)] text-white px-3 py-1 rounded">Agendar</button>
              </li>
              <li class="flex justify-between items-center">
                Información de evento <button class="bg-[var(--color-2)] text-white px-3 py-1 rounded">Agendar</button>
              </li>
              <li class="flex justify-between items-center">
                Información de evento <button class="bg-[var(--color-2)] text-white px-3 py-1 rounded">Agendar</button>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>
  </main>
</body>

</html>
