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
    </style>
</head>

<body class="bg-color-5 min-h-screen p-6">
<section class="relative text-white bg-color-2 text-center h-[200px] bg-fixed bg-cover bg-center mb-10">
    <div class="relative z-10 max-w-3xl mx-auto px-6 flex flex-col justify-center h-full">
        <h2 class="text-4xl sm:text-5xl font-bold mb-2 text-color-4 ">Empresas</h2>
        <p class="text-color-4 text-lg">Gestiona y visualiza la información de tus empresas de forma sencilla</p>
    </div>
</section>

<div class="flex justify-center">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 max-w-7xl w-full">
        <?php foreach($empresa as $e): ?>
        <div class="bg-white rounded-xl shadow-md overflow-hidden hover-shadow-md transition duration-300 w-full">
            <!-- Imagen de la empresa -->
            <div class="h-52 bg-gray-200 flex items-center justify-center">
                <?php if(!empty($e['imagen'])): ?>
                    <img src="<?= $e['imagen'] ?>" alt="<?= $e['nombre_empresa'] ?>" class="h-64 w-full object-cover">
                <?php else: ?>
                    <span class="text-color-3 font-semibold">Sin imagen</span>
                <?php endif; ?>
            </div>
            <!-- Info de la empresa -->
            <div class="p-6">
                <h2 class="text-2xl font-bold text-color-1 mb-3"><?= $e['nombre_empresa'] ?></h2>
                <p class="text-color-3 mb-1"><strong>Rubro:</strong> <?= $e['rubro'] ?></p>
                <p class="text-color-3 mb-1"><strong>Dirección:</strong> <?= $e['direccion'] ?></p>
                <p class="text-color-3 mb-1"><strong>Representante:</strong> <?= $e['representante'] ?> (<?= $e['cargo_representante'] ?>)</p>
                <p class="text-color-3 mb-1"><strong>Email:</strong> <?= $e['email'] ?></p>
                <p class="text-color-3 mb-1"><strong>Teléfono:</strong> <?= $e['telefono'] ?></p>
                <p class="mt-3 text-sm <?= $e['verificada'] ? 'text-green-600' : 'text-red-600' ?>">
                    <?= $e['verificada'] ? 'Verificada' : 'No verificada' ?>
                </p>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

</body>

</html>
