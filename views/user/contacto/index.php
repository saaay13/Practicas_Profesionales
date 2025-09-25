<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex flex-col min-h-screen bg-gradient-to-r from-indigo-50 to-purple-50">
    <main class="flex-grow">
        <section class="max-w-4xl mx-auto p-8 bg-white shadow-2xl rounded-2xl mt-12 border border-gray-200">
            <h2 class="text-3xl font-bold text-center mb-8 text-indigo-700">Contáctanos</h2>
            <p class="text-center text-gray-600 mb-8">
                Completa el formulario y nos pondremos en contacto contigo lo antes posible.
            </p>

            <form action="/contacto" method="POST" class="space-y-6">
                <div>
                    <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                    <input type="text" name="contacto[nombre]" id="nombre"
                        class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:ring-2 focus:ring-indigo-300 focus:border-indigo-500"
                        placeholder="Tu nombre completo" required>
                </div>

                <div>
                    <label for="correo" class="block text-sm font-medium text-gray-700">Correo</label>
                    <input type="email" name="contacto[correo]" id="correo"
                        class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:ring-2 focus:ring-indigo-300 focus:border-indigo-500"
                        placeholder="ejemplo@correo.com" required>
                </div>

                <div>
                    <label for="mensaje" class="block text-sm font-medium text-gray-700">Mensaje</label>
                    <textarea name="contacto[mensaje]" id="mensaje" rows="5"
                        class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:ring-2 focus:ring-indigo-300 focus:border-indigo-500"
                        placeholder="Escribe tu mensaje aquí..." required></textarea>
                </div>

                <div class="text-center">
                    <button type="submit"
                        class="bg-gradient-to-r from-indigo-500 to-purple-500 text-white font-semibold py-3 px-8 rounded-full shadow-lg hover:from-indigo-600 hover:to-purple-600 transition-all">
                        Enviar Mensaje
                    </button>
                </div>
            </form>
        </section>
    </main>
</body>

</html>