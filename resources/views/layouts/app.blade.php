<!DOCTYPE html>
<html lang="es" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Punto Frío Beto')</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Outfit', 'sans-serif'],
                    },
                    colors: {
                        app: {
                            bg: '#0f172a', /* slate-900 */
                            card: '#1e293b', /* slate-800 */
                            sidebar: '#0b0f19', /* deeper dark */
                            primary: '#f59e0b', /* amber-500 */
                            primaryHover: '#d97706', /* amber-600 */
                            accent: '#334155', /* slate-700 */
                            textMain: '#f8fafc', /* slate-50 */
                            textMuted: '#94a3b8', /* slate-400 */
                        }
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.3s ease-out',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0', transform: 'translateY(10px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        }
                    }
                }
            }
        }
    </script>
    <!-- Alpine JS for interactions -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        body { font-family: 'Outfit', sans-serif; }
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: #0f172a; }
        ::-webkit-scrollbar-thumb { background: #334155; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #475569; }
    </style>
    @stack('styles')
</head>

<body class="bg-app-bg text-app-textMain min-h-screen antialiased selection:bg-app-primary selection:text-white">

    <div class="flex h-screen overflow-hidden" x-data="{ sidebarOpen: false }">

        <!-- Mobile Sidebar Overlay -->
        <div x-show="sidebarOpen" x-transition.opacity class="fixed inset-0 z-20 bg-black/50 lg:hidden" @click="sidebarOpen = false"></div>

        {{-- Sidebar --}}
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-30 w-64 bg-app-sidebar border-r border-app-accent transform transition-transform duration-300 lg:translate-x-0 lg:static lg:inset-auto flex flex-col justify-between">
            <div>
                <div class="h-20 flex items-center px-6 border-b border-app-accent justify-between shadow-sm">
                    <h1 class="text-white text-2xl font-bold flex items-center gap-3">
                        <span class="text-app-primary text-3xl">🧊</span>
                        <span class="tracking-tight">Punto <span class="text-app-primary">Frío</span></span>
                    </h1>
                    <button @click="sidebarOpen = false" class="lg:hidden text-app-textMuted hover:text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <nav class="p-4 mt-4">
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('dashboard') }}" class="group flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-app-primary/10 text-app-primary' : 'text-app-textMuted hover:bg-app-accent hover:text-white' }}">
                                <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 -1 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                                <span class="font-medium">Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('ventas.index') }}" class="group flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('ventas.*') ? 'bg-app-primary/10 text-app-primary' : 'text-app-textMuted hover:bg-app-accent hover:text-white' }}">
                                <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                <span class="font-medium">Ventas</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('productos.index') }}" class="group flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('productos.*') ? 'bg-app-primary/10 text-app-primary' : 'text-app-textMuted hover:bg-app-accent hover:text-white' }}">
                                <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                <span class="font-medium">Inventario</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('proveedores.index') }}" class="group flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('proveedores.*') ? 'bg-app-primary/10 text-app-primary' : 'text-app-textMuted hover:bg-app-accent hover:text-white' }}">
                                <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                <span class="font-medium">Proveedores</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('reportes.index') }}" class="group flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('reportes.*') ? 'bg-app-primary/10 text-app-primary' : 'text-app-textMuted hover:bg-app-accent hover:text-white' }}">
                                <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                                <span class="font-medium">Reportes</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>

            <!-- Sidebar Footer (Profile / Support) -->
            <div class="p-4 border-t border-app-accent/50 text-center text-xs text-app-textMuted">
                <p>Punto Frío OS v1.0</p>
                <p class="mt-1">Desarrollado con ♥</p>
            </div>
        </aside>

        {{-- Contenido Principal --}}
        <div class="flex-1 flex flex-col min-w-0 bg-app-bg relative">

            {{-- Navbar Superior --}}
            <header class="h-20 bg-app-bg/80 backdrop-blur-md border-b border-app-accent flex items-center justify-between px-6 z-10 sticky top-0">
                <div class="flex items-center gap-4">
                    <button @click="sidebarOpen = true" class="lg:hidden text-app-textMuted hover:text-white p-2 rounded-lg bg-app-card border border-app-accent">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                    <!-- Título dinámico por sección -->
                    <h2 class="text-white font-semibold text-xl tracking-wide hidden sm:block">
                        @yield('title', 'Panel de Control')
                    </h2>
                </div>

                <div class="flex items-center gap-6">
                    <!-- Eliminado: Componente de Notificaciones -->

                    <!-- Perfil de Usuario Dropdown -->
                    <div class="relative" x-data="{ userMenu: false }">
                        <button @click="userMenu = !userMenu" @click.away="userMenu = false" class="flex items-center gap-3 hover:opacity-80 transition-opacity">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-app-primary to-yellow-300 border-2 border-app-card shadow-lg p-[2px]">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->nombre ?? 'Usuario') }}&background=1e293b&color=f59e0b&bold=true" alt="Avatar" class="w-full h-full rounded-full object-cover">
                            </div>
                            <div class="text-left hidden md:block">
                                <p class="text-sm font-semibold text-white leading-tight -mb-1">{{ auth()->user()->nombre ?? 'Administrador' }}</p>
                                <span class="text-xs text-app-primary">Online</span>
                            </div>
                        </button>
                    </div>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('password.edit') }}" 
                        class="p-2 bg-app-accent/20 hover:bg-app-primary/20 text-app-textMuted hover:text-app-primary rounded-xl border border-app-accent/50 transition-all duration-200" 
                        title="Seguridad">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                            </svg>
                        </a>

                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" 
                                    class="p-2 bg-red-500/10 hover:bg-red-500/20 text-red-400 hover:text-red-500 rounded-xl border border-red-500/20 transition-all duration-200" 
                                    title="Cerrar Sesión">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            {{-- Main Contenido --}}
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-app-bg p-4 sm:p-6 lg:p-8 animate-fade-in">
                <!-- Flash Messages Mockup / Session logic -->
                @if(session('success'))
                <div x-data="{ show: true }" x-show="show" class="mb-6 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 px-4 py-3 rounded-lg flex justify-between items-center">
                    <span class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        {{ session('success') }}
                    </span>
                    <button @click="show = false" class="text-emerald-400 hover:text-emerald-300">&times;</button>
                </div>
                @endif
                
                @if(session('error'))
                <div x-data="{ show: true }" x-show="show" class="mb-6 bg-red-500/10 border border-red-500/20 text-red-400 px-4 py-3 rounded-lg flex justify-between items-center">
                    <span class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        {{ session('error') }}
                    </span>
                    <button @click="show = false" class="text-red-400 hover:text-red-300">&times;</button>
                </div>
                @endif

                @yield('content')
            </main>

        </div>
    </div>

    @stack('scripts')
</body>
</html>
