<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Punto Frío Beto')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <div class="flex h-screen">

        {{-- Sidebar --}}
        <aside class="bg-[#1e3a8a] w-64 min-h-screen p-4 flex-shrink-0" style="box-shadow: 2px 0 10px rgba(0,0,0,0.1)">
            <div class="mb-8">
                <h1 class="text-white text-xl font-bold flex items-center gap-2">
                    🧊 Punto Frío Beto
                </h1>
            </div>
            <nav>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('dashboard') }}"
                            class="flex items-center gap-3 text-white p-3 rounded-lg transition-colors {{ request()->routeIs('dashboard') ? 'bg-[#3b82f6]' : 'hover:bg-[#3b82f6]' }}">
                            <span class="text-xl">📊</span><span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('ventas.index') }}"
                            class="flex items-center gap-3 text-white p-3 rounded-lg transition-colors {{ request()->routeIs('ventas.*') ? 'bg-[#3b82f6]' : 'hover:bg-[#3b82f6]' }}">
                            <span class="text-xl">🛒</span><span>Ventas</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('productos.index') }}"
                            class="flex items-center gap-3 text-white p-3 rounded-lg transition-colors {{ request()->routeIs('productos.*') ? 'bg-[#3b82f6]' : 'hover:bg-[#3b82f6]' }}">
                            <span class="text-xl">📦</span><span>Inventario</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('reportes.index') }}"
                            class="flex items-center gap-3 text-white p-3 rounded-lg transition-colors {{ request()->routeIs('reportes.*') ? 'bg-[#3b82f6]' : 'hover:bg-[#3b82f6]' }}">
                            <span class="text-xl">📈</span><span>Reportes</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        {{-- Contenido --}}
        <div class="flex-1 flex flex-col overflow-hidden">

            {{-- Navbar --}}
            <nav class="bg-white shadow-md p-4 flex justify-between items-center flex-shrink-0">
                <h2 class="text-[#1e3a8a] font-semibold text-lg">Panel de Control</h2>
                <div class="flex items-center gap-4">
                    <div class="text-right">
                        <p class="text-sm text-gray-600">Bienvenido,</p>
                        <p class="font-semibold text-[#1e3a8a]">Administrador</p>
                    </div>
                </div>
            </nav>

            {{-- Main --}}
            <main class="flex-1 p-6 overflow-auto">
                @yield('content')
            </main>

        </div>
    </div>

    @stack('scripts')
</body>
</html>