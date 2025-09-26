<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Plataforma de Prácticas</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    :root {
      --color-1: #000a23; 
      --color-2: #02253d; 
      --color-3: #153f59; 
      --color-4: #94b8d7; 
      --color-5: #cbd5e1; 
    }
    .hover-shadow-md:hover { box-shadow: 0 4px 15px rgba(0,0,0,0.2); }

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

<body class="flex flex-col min-h-screen bg-color-5">
  <main class="flex-grow">

    <!-- Hero con imagen de fondo -->
    <section class="relative text-color-5 text-center h-[500px] bg-cover bg-center bg-fixed"
      style="background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('http://localhost:8080/img/inicio.png');">
      <div class="relative z-10 px-4 pt-32 flex flex-col justify-center h-full">
        <h2 class="text-4xl sm:text-5xl font-bold mb-4">Impulsa tu carrera profesional</h2>
        <p class="mb-6 text-color-5">
          Encuentra mejores oportunidades de prácticas profesionales en tu área de estudio y comienza tu camino hacia el éxito.
        </p>
        <a href="#convocatorias" class="text-color-1 font-bold py-3 px-6 rounded-lg">
          Explorar Prácticas
        </a>
      </div>
    </section>

    <!-- Convocatorias -->
    <section id="convocatorias" class="py-12 bg-color-5">
      <div class="px-6">
        <h2 class="text-2xl font-bold text-center mb-8 text-color-1">Convocatorias Disponibles</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <?php foreach ($convocatoria as $c): ?>
          <div class="bg-color-2 p-4 rounded-lg shadow-md hover-shadow-md">
            <?php if(!empty($c['imagen'])): ?>
              <img src="<?= $c['imagen'] ?>" alt="<?= $c['titulo'] ?>" class="w-full h-48 object-cover mb-4 rounded">
            <?php else: ?>
              <div class="w-full h-48 bg-color-1 mb-4 flex items-center justify-center text-gray-300 rounded">Sin imagen</div>
            <?php endif; ?>
            <h3 class="text-lg font-bold mb-2 text-color-4"><?= $c['titulo'] ?></h3>
            <p class="text-sm mb-2 text-color-5"><strong>Empresa:</strong> <?= $c['nombre_empresa'] ?? $c['id_empresa'] ?></p>
            <p class="text-sm mb-2 text-color-5"><?= strlen($c['descripcion'])>100 ? substr($c['descripcion'],0,100)."..." : $c['descripcion'] ?></p>
            <p class="text-sm mb-2 text-color-5"><strong>Requisitos:</strong> <?= $c['requisitos'] ?></p>
            <p class="text-sm mb-4 text-color-5"><strong>Publicación:</strong> <?= $c['fecha_publicacion'] ?> | <strong>Cierre:</strong> <?= $c['fecha_cierre'] ?></p>
            <span class="inline-block px-3 py-1 text-sm font-medium rounded-full <?= $c['estado']==='abierta'?'bg-green-600':($c['estado']==='cerrada'?'bg-red-600':'bg-gray-500') ?>">
              <?= ucfirst($c['estado']) ?>
            </span>
            <a href="#" class="mt-4 inline-block bg-color-4 text-color-1 px-4 py-2 rounded">Ver más</a>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <!-- Empresas destacadas -->
    <section class="py-12 bg-color-5 text-color-1">
      <h2 class="text-2xl font-bold text-center mb-8">Empresas Destacadas</h2>
      <div class="px-6 grid grid-cols-1 md:grid-cols-3 gap-6">
        <?php foreach($empresa as $e): ?>
        <div class="bg-color-2 text-color-5 p-4 rounded-lg shadow-md hover-shadow-md">
          <?php if(!empty($e['imagen'])): ?>
            <img src="<?= $e['imagen'] ?>" alt="<?= $e['nombre_empresa'] ?>" class="w-full h-52 object-cover mb-4 rounded">
          <?php else: ?>
            <div class="w-full h-52 bg-color-1 mb-4 flex items-center justify-center text-gray-300 rounded">Sin imagen</div>
          <?php endif; ?>
          <h3 class="text-lg font-bold mb-2 text-color-4"><?= $e['nombre_empresa'] ?></h3>
          <p class="text-sm mb-1 text-color-5"><strong>Rubro:</strong> <?= $e['rubro'] ?></p>
          <p class="text-sm mb-1 text-color-5"><strong>Dirección:</strong> <?= $e['direccion'] ?></p>
          <p class="text-sm mb-1 text-color-5"><strong>Representante:</strong> <?= $e['nombre'] ?> (<?= $e['cargo_representante'] ?>)</p>
          <p class="text-sm mb-1 text-color-5"><strong>Email:</strong> <?= $e['email'] ?></p>
          <p class="text-sm mb-1 text-color-5"><strong>Teléfono:</strong> <?= $e['telefono'] ?></p>
          <p class="mt-3 text-sm <?= $e['verificada'] ? 'text-green-600' : 'text-red-600' ?>">
            <?= $e['verificada'] ? 'Verificada' : 'No verificada' ?>
          </p>
          <a href="#" class="mt-4 inline-block bg-color-4 text-color-1 px-4 py-2 rounded">Ver Convocatorias</a>
        </div>
        <?php endforeach; ?>
      </div>
    </section>

    <!-- Información de apoyo -->
    <section class="py-12 bg-color-5 text-color-1">
      <h2 class="text-2xl font-bold text-center mb-10">Información de Apoyo</h2>
      <div class="px-6 grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-color-5 p-4 rounded-lg shadow-md flex flex-col justify-between">
          <div>
            <div class="h-32 bg-color-4 mb-4 flex items-center justify-center">📘</div>
            <h4 class="font-bold mb-2">Guía definitiva para tu CV</h4>
            <p class="text-sm text-gray-600 mb-4">Descripción de guía...</p>
          </div>
          <a href="#" class="bg-color-2 text-color-5 py-2 px-4 rounded text-center">Descargar PDF</a>
        </div>

        <div class="bg-color-5 p-4 rounded-lg shadow-md flex flex-col justify-between">
          <div>
            <div class="h-32 bg-color-4 mb-4 flex items-center justify-center">🎥</div>
            <h4 class="font-bold mb-2">Nombre de Taller</h4>
            <p class="text-sm text-gray-600 mb-4">Descripción de taller...</p>
          </div>
          <a href="#" class="bg-color-2 text-color-5 py-2 px-4 rounded text-center">Ver Video</a>
        </div>

        <div class="bg-color-5 p-4 rounded-lg shadow-md flex flex-col justify-between">
          <div>
            <div class="h-32 bg-color-4 mb-4 flex items-center justify-center">📑</div>
            <h4 class="font-bold mb-2">Plantillas de Cartas de Presentación</h4>
            <p class="text-sm text-gray-600 mb-4">Información...</p>
          </div>
          <a href="#" class="bg-color-2 text-color-5 py-2 px-4 rounded text-center">Ver</a>
        </div>

        <div class="bg-color-5 p-4 rounded-lg shadow-md flex flex-col justify-between">
          <div>
            <h4 class="font-bold mb-2 text-color-2">Próximos Eventos</h4>
            <ul class="space-y-2 text-sm text-gray-700">
              <li class="flex justify-between items-center">
                Información de evento <button class="bg-color-2 text-color-5 px-3 py-1 rounded">Agendar</button>
              </li>
              <li class="flex justify-between items-center">
                Información de evento <button class="bg-color-2 text-color-5 px-3 py-1 rounded">Agendar</button>
              </li>
              <li class="flex justify-between items-center">
                Información de evento <button class="bg-color-2 text-color-5 px-3 py-1 rounded">Agendar</button>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>

  </main>
</body>

</html>
