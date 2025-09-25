<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Convocatorias</title>
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

        .estado-abierta { background-color: #d1fae5; color: #065f46; }
        .estado-cerrada { background-color: #fee2e2; color: #991b1b; }
        .estado-cancelada { background-color: #e5e7eb; color: #374151; }
    </style>
</head>

<body class="bg-color-5">
<section class="relative text-white bg-color-2 text-center h-[200px] bg-fixed bg-cover bg-center mb-10">
    <div class="relative z-10 max-w-3xl mx-auto px-6 flex flex-col justify-center h-full">
        <h2 class="text-4xl sm:text-5xl font-bold mb-2 text-color-4 ">Convocatoria</h2>
    </div>
</section>

<!-- Contenedor centrado con padding -->
<!-- Grid con un pequeño padding a los lados -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 px-8">
    <?php foreach ($convocatoria as $c): ?>
    <div class="card rounded-xl shadow-md overflow-hidden hover-shadow-md">
        <?php if(!empty($c['imagen'])): ?>
        <img src="<?= $c['imagen'] ?>" alt="<?= $c['titulo'] ?>" class="w-full h-48 object-cover">
        <?php else: ?>
        <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500">
            Sin imagen
        </div>
        <?php endif; ?>
        <div class="p-4">
            <h2 class="text-xl font-semibold mb-2"><?= $c['titulo'] ?></h2>
            <p class="mb-1"><strong>Empresa:</strong> <?= $c['nombre_empresa'] ?? $c['id_empresa'] ?></p>
            <p class="mb-1"><?= strlen($c['descripcion'])>100 ? substr($c['descripcion'],0,100)."..." : $c['descripcion'] ?></p>
            <p class="text-sm mb-1"><strong>Requisitos:</strong> <?= $c['requisitos'] ?></p>
            <p class="text-sm mb-2"><strong>Publicación:</strong> <?= $c['fecha_publicacion'] ?> |
                <strong>Cierre:</strong> <?= $c['fecha_cierre'] ?></p>
            <span class="inline-block px-3 py-1 text-sm font-medium rounded-full <?= $c['estado']==='abierta'?'estado-abierta':($c['estado']==='cerrada'?'estado-cerrada':'estado-cancelada') ?>">
                <?= ucfirst($c['estado']) ?>
            </span>
        </div>
    </div>
    <?php endforeach; ?>
</div>

</body>

</html>
