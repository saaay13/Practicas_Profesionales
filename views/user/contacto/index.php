<?php 
if (session_status() === PHP_SESSION_NONE) session_start();
$usuario = $_SESSION["nombre"] ?? '';
$id_usuario = $_SESSION["id_usuario"] ?? '';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --color-1: #000a23;
            --color-2: #02253d;
            --color-3: #153f59;
            --color-4: #94b8d7;
            --color-5: #cbd5e1;
        }

        body {
            background: linear-gradient(to right, var(--color-5), var(--color-4));
        }

        h2 {
            color: var(--color-2);
        }

        label {
            color: var(--color-3);
        }

        input,
        textarea {
            border-color: var(--color-3);
        }

        input:focus,
        textarea:focus {
            border-color: var(--color-2);
        }

        .btn-enviar {
            background: linear-gradient(to right, var(--color-2), var(--color-3));
        }

        .btn-enviar:hover {
            background: linear-gradient(to right, var(--color-3), var(--color-2));
        }
    </style>
</head>

<body class="flex flex-col min-h-screen">
    <main class="flex-grow max-w-6xl mx-auto p-6">

        <h2 class="text-4xl font-bold text-center mb-8">Contáctanos</h2>
        <p class="text-center text-gray-700 mb-8">
            Completa el formulario y nos pondremos en contacto contigo lo antes posible.
        </p>

        <!-- Contenedor principal: formulario grande y mapa debajo -->
        <div class="flex flex-col gap-8">

            <!-- Formulario grande -->
            <section class="bg-white shadow-2xl rounded-2xl p-8 border border-gray-200 w-full">
                <form action="" method="POST" class="space-y-6">

    <input type="hidden" name="contacto[id_usuario]" value="<?= htmlspecialchars($id_usuario) ?>">

    <div>
        <label for="nombre" class="block text-sm font-medium">Nombre</label>
        <input type="text" name="contacto[nombre_mostrar]" id="nombre"
            value="<?= htmlspecialchars($usuario) ?>"
            class="mt-1 block w-full rounded-xl shadow-sm px-5 py-3 focus:ring-2 focus:ring-offset-0 text-lg"
            placeholder="Tu nombre completo" required readonly>
    </div>

    <div>
        <label for="mensaje" class="block text-sm font-medium">Mensaje</label>
        <textarea name="contacto[mensaje]" id="mensaje" rows="6"
            class="mt-1 block w-full rounded-lg shadow-sm px-4 py-3 focus:ring-2 focus:border-2 focus:ring-offset-0 text-lg"
            placeholder="Escribe tu mensaje aquí..." required></textarea>
    </div>

    <div class="text-center">
        <button type="submit"
            class="btn-enviar text-white font-semibold py-4 px-10 rounded-full shadow-lg text-lg transition-all">
            Enviar Mensaje
        </button>
    </div>
</form>
            </section>

            <!-- Mapa de ubicación grande -->
            <section class="rounded-2xl overflow-hidden shadow-lg w-full h-[500px]">
                <h3 class="text-2xl font-semibold text-gray-700 mb-4 text-center">Nuestra Ubicación</h3>
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2345.1234567890123!2d-64.7500!3d-21.5333!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjHCsDMyJzMwLjMiUyA2NMKwNDUnMTIuMiJX!5e0!3m2!1ses!2sbo!4v1695654321000!5m2!1ses!2sbo"
                    width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </section>

        </div>
    </main>
</body>

</html>
