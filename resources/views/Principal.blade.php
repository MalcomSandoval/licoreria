<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Punto Frío Beto</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        bavarian: {
                            blue: '#1e3a8a',
                            lightBlue: '#3b82f6',
                            darkBlue: '#1e2e6b',
                            gold: '#f59e0b'
                        }
                    }
                }
            }
        }
    </script>
    <style>
        @keyframes floatIce {
            0% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-30px) rotate(0deg);
            }

            100% {
                transform: translateY(10px) rotate(0deg);
            }
        }

        .ice {
            display: inline-block;
            animation: floatIce 3s ease-in-out infinite;
        }
    </style>

</head>

<body class="bg-gray-100">

    <!-- HERO -->
    <section
        class="min-h-screen flex items-center justify-center text-center text-white bg-gradient-to-br from-bavarian-blue via-bavarian-lightBlue to-bavarian-gold">

        <div class="max-w-4xl px-4">

            <div class="text-6xl mb-6 ice">🧊</div>

            <h1 class="text-6xl font-bold mb-6">
                Punto Frío <span class="text-yellow-300">Beto</span>
            </h1>

            <p class="text-xl mb-8">
                Sistema Integral de Gestión Empresarial para Pequeños Comercios
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">

                <a href="{{ route('dashboard') }}"
                    class="bg-yellow-400 hover:bg-yellow-500 px-8 py-4 rounded-lg font-bold">
                    Iniciar Sesión
                </a>

                <a href="#problema"
                    class="border-2 border-white px-8 py-4 rounded-lg font-bold hover:bg-white hover:text-blue-900">
                    Conocer Más
                </a>

            </div>

        </div>

    </section>


    <!-- PROBLEMATICA -->

    <section id="problema" class="py-20 bg-white">

        <div class="max-w-6xl mx-auto px-4">

            <div class="text-center mb-16">

                <h2 class="text-4xl font-bold text-bavarian-blue mb-6">
                    La Problemática
                </h2>

                <p class="text-gray-600 text-xl">
                    Los pequeños comercios enfrentan desafíos diarios en la gestión de su negocio
                </p>

            </div>

            <div class="grid md:grid-cols-3 gap-8">

                <div class="bg-red-50 p-8 rounded-xl shadow border-l-4 border-red-500">
                    <div class="text-4xl mb-4">📊</div>
                    <h3 class="font-bold text-xl text-red-700 mb-3">Control Manual</h3>
                    <p>
                        Llevar inventarios y ventas en cuadernos genera errores y pérdida de información.
                    </p>
                </div>

                <div class="bg-orange-50 p-8 rounded-xl shadow border-l-4 border-orange-500">
                    <div class="text-4xl mb-4">💸</div>
                    <h3 class="font-bold text-xl text-orange-700 mb-3">Pérdidas Económicas</h3>
                    <p>
                        Sin control del stock se generan pérdidas por productos vencidos o faltantes.
                    </p>
                </div>

                <div class="bg-yellow-50 p-8 rounded-xl shadow border-l-4 border-yellow-500">
                    <div class="text-4xl mb-4">⏰</div>
                    <h3 class="font-bold text-xl text-yellow-700 mb-3">Tiempo Perdido</h3>
                    <p>
                        Horas invertidas contando productos y calculando ventas manualmente.
                    </p>
                </div>

            </div>

        </div>

    </section>


    <!-- SOLUCION -->

    <section class="py-20 bg-bavarian-blue text-white">

        <div class="max-w-6xl mx-auto px-4">

            <div class="text-center mb-16">

                <h2 class="text-4xl font-bold mb-6">
                    Nuestra Solución
                </h2>

                <p class="text-xl opacity-90">
                    Un sistema integral diseñado para pequeños comercios
                </p>

            </div>

            <div class="grid md:grid-cols-4 gap-8">

                <div class="text-center bg-bavarian-lightBlue p-6 rounded-xl">
                    <div class="text-4xl mb-4">📦</div>
                    <h3 class="font-bold mb-2">Inventario Digital</h3>
                    <p>Control total de productos en tiempo real</p>
                </div>

                <div class="text-center bg-bavarian-lightBlue p-6 rounded-xl">
                    <div class="text-4xl mb-4">🛒</div>
                    <h3 class="font-bold mb-2">Ventas Inteligentes</h3>
                    <p>Registro rápido con actualización automática</p>
                </div>

                <div class="text-center bg-bavarian-lightBlue p-6 rounded-xl">
                    <div class="text-4xl mb-4">📈</div>
                    <h3 class="font-bold mb-2">Reportes Automáticos</h3>
                    <p>Análisis de ventas y métricas de negocio</p>
                </div>

                <div class="text-center bg-bavarian-lightBlue p-6 rounded-xl">
                    <div class="text-4xl mb-4">📱</div>
                    <h3 class="font-bold mb-2">Acceso Móvil</h3>
                    <p>Disponible desde cualquier dispositivo</p>
                </div>

            </div>

        </div>

    </section>


    <!-- MISION Y VISION -->

    <section class="py-20 bg-gray-50">

        <div class="max-w-6xl mx-auto px-4 grid md:grid-cols-2 gap-10">

            <div class="bg-white p-10 rounded-xl shadow">
                <h3 class="text-3xl font-bold text-bavarian-blue mb-4">
                    🎯 Nuestra Misión
                </h3>

                <p>
                    Democratizar la tecnología empresarial para pequeños comercios,
                    proporcionando herramientas digitales accesibles que faciliten
                    la gestión diaria del negocio.
                </p>

            </div>

            <div class="bg-white p-10 rounded-xl shadow">

                <h3 class="text-3xl font-bold text-yellow-500 mb-4">
                    🚀 Nuestra Visión
                </h3>

                <p>
                    Ser la plataforma líder en soluciones tecnológicas para pequeños
                    comercios en América Latina.
                </p>

            </div>

        </div>

    </section>


    <!-- BENEFICIOS -->

    <section class="py-20 bg-white">

        <div class="max-w-6xl mx-auto px-4 grid md:grid-cols-2 gap-10">

            <div class="space-y-6">

                <div>
                    <h4 class="text-xl font-bold text-blue-800">💰 Ahorro Económico</h4>
                    <p>Reduce pérdidas por inventario hasta en un 30%</p>
                </div>

                <div>
                    <h4 class="text-xl font-bold text-yellow-600">⚡ Eficiencia Operativa</h4>
                    <p>Automatiza tareas repetitivas</p>
                </div>

                <div>
                    <h4 class="text-xl font-bold text-green-600">📊 Decisiones Inteligentes</h4>
                    <p>Reportes en tiempo real</p>
                </div>

                <div>
                    <h4 class="text-xl font-bold text-purple-600">🔒 Seguridad</h4>
                    <p>Datos protegidos en la nube</p>
                </div>

            </div>

            <div class="bg-gradient-to-br from-bavarian-blue to-bavarian-gold text-white p-10 rounded-xl text-center">

                <div class="text-5xl mb-4">🏪</div>

                <h3 class="text-2xl font-bold mb-4">
                    Diseñado para ti
                </h3>

                <p>
                    Creado por emprendedores, para emprendedores.
                </p>

            </div>

        </div>

    </section>


    <!-- ESTADISTICAS -->

    <section class="py-20 bg-bavarian-blue text-white">

        <div class="max-w-6xl mx-auto px-4 grid grid-cols-2 md:grid-cols-4 gap-6 text-center">

            <div>
                <div class="text-4xl font-bold">30%</div>
                <p>Reducción de pérdidas</p>
            </div>

            <div>
                <div class="text-4xl font-bold">5h</div>
                <p>Ahorro semanal</p>
            </div>

            <div>
                <div class="text-4xl font-bold">100%</div>
                <p>Control digital</p>
            </div>

            <div>
                <div class="text-4xl font-bold">24/7</div>
                <p>Disponibilidad</p>
            </div>

        </div>

    </section>


    <!-- MAPA -->

    <section class="py-20">

        <div class="max-w-4xl mx-auto bg-white rounded-xl shadow overflow-hidden">

            <div class="bg-blue-600 text-white text-center py-4 font-bold text-xl">
                ❄️ AQUÍ ESTÁ EL PUNTO FRÍO
            </div>
            <iframe width="100%" height="450" style="border:0;" loading="lazy" allowfullscreen
                referrerpolicy="no-referrer-when-downgrade"
                src="https://www.google.com/maps?q=10.7410,-74.7570&hl=es&z=15&output=embed">
            </iframe>

            <div class="p-6 text-center">

                <p class="font-semibold">
                    Dirección: Calle 7A #8-22, Palmar de Varela
                </p>

                <a href="https://www.google.com/maps/dir/?api=1&destination=Calle+7A+%238-22+Palmar+de+Varela"
                    target="_blank" class="text-blue-600 font-bold hover:underline">
                    🚗 Cómo llegar
                </a>

            </div>

        </div>

    </section>


    <!-- FOOTER -->

    <footer class="bg-bavarian-darkBlue text-white text-center py-10">

        <h3 class="text-xl font-bold mb-2">
            🧊 Punto Frío Beto
        </h3>

        <p>
            Transformando pequeños comercios con tecnología accesible
        </p>

        <p class="mt-4 text-sm">
            © 2025 Punto Frío Beto
        </p>

    </footer>

</body>

</html>