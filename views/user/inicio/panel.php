<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Empresa</title>
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

        .hover-bg-color-2:hover { background-color: var(--color-2); }
        .hover-shadow-md:hover { box-shadow: 0 4px 15px rgba(0,0,0,0.2); }

        .titulo {
            background-color: var(--color-2);
            color: var(--color-5);
        }

        .card {
            background-color: var(--color-4);
            color: var(--color-1);
            transition: transform 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>

<body class="bg-color-5 p-6">

<section class="relative text-white bg-color-2 text-center h-[200px] bg-fixed bg-cover bg-center mb-10">
    <div class="relative z-10 max-w-3xl mx-auto px-6 flex flex-col justify-center h-full">
        <h2 class="text-4xl sm:text-5xl font-bold mb-2 text-color-4">Empresas</h2>
        <p class="text-color-4 text-lg">Gestiona y visualiza la información de tus empresas de forma sencilla</p>
    </div>
</section>

<!-- Grid con pequeño padding lateral -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 px-8">
    <?php foreach($empresa as $e): ?>
    <div class="card rounded-xl shadow-md overflow-hidden hover-shadow-md">
        <!-- Imagen de la empresa -->
        <?php if(!empty($e['imagen'])): ?>
          <img src="/img/empresa/<?= $e['imagen'] ?>" alt="<?= $e['nombre_empresa'] ?>" class="w-full h-48 object-cover rounded mb-4">
        <?php else: ?>
        <div class="w-full h-52 bg-gray-200 flex items-center justify-center text-gray-500">
            Sin imagen
        </div>
        <?php endif; ?>

        <!-- Información de la empresa -->
        <div class="p-4">
            <h2 class="text-xl font-semibold mb-2"><?= $e['nombre_empresa'] ?></h2>
            <p class="text-sm mb-1 text-color-3"><strong>NIT:</strong> <?= $e['nit'] ?></p>
            <p class="text-color-3 mb-1"><strong>Rubro:</strong> <?= $e['rubro'] ?></p>
            <p class="text-color-3 mb-1"><strong>Dirección:</strong> <?= $e['direccion'] ?></p>
            <p class="text-sm mb-1 text-color-3"><strong>Representante:</strong> <?= $e['representante_nombre'] ?> <?= $e['representante_apellido'] ?> (<?= $e['cargo_representante'] ?>)</p>
            <p class="text-sm mb-1 text-color-3"><strong>Email:</strong> <?= $e['representante_email'] ?></p>
            <p class="text-sm mb-1 text-color-3"><strong>Teléfono:</strong> <?= $e['representante_telefono'] ?></p>
            <p class="mt-2 text-sm <?= $e['verificada'] ? 'text-green-600' : 'text-red-600' ?>"><?= $e['verificada'] ? 'Verificada' : 'No verificada' ?></p>
            </div>
    </div>
    <?php endforeach; ?>
</div>

</body>
</html>
