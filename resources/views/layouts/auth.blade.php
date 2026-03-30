<!DOCTYPE html>
<html lang="es" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Punto Frío Beto - @yield('title', 'Autenticación')</title>
    
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
                            bg: '#0f172a',
                            card: '#1e293b',
                            primary: '#f59e0b',
                            primaryHover: '#d97706',
                            accent: '#334155',
                            textMain: '#f8fafc',
                            textMuted: '#94a3b8',
                        }
                    },
                    animation: {
                        'float': 'floating 3s ease-in-out infinite',
                    },
                    keyframes: {
                        floating: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-10px)' },
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-app-bg text-app-textMain min-h-screen flex items-center justify-center font-sans p-4 sm:p-6 lg:p-8 relative overflow-hidden">
    
    <!-- Ambient Background Lighting -->
    <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-[20%] -left-[10%] w-[50%] h-[50%] bg-app-primary/20 blur-[120px] rounded-full mix-blend-screen opacity-50 animate-float"></div>
        <div class="absolute top-[60%] -right-[10%] w-[40%] h-[40%] bg-blue-500/10 blur-[120px] rounded-full mix-blend-screen opacity-50 animate-float" style="animation-delay: 1.5s;"></div>
    </div>

    <div class="relative z-10 w-full max-w-md">
        <!-- Logo Header -->
        <div class="w-fulltext-center mb-8 flex flex-col items-center justify-center">
            <div class="w-20 h-20 bg-app-card border border-app-accent rounded-2xl flex items-center justify-center shadow-xl shadow-app-primary/10 mb-4 transform rotate-3">
                <span class="text-4xl">🧊</span>
            </div>
            <h1 class="text-3xl font-bold tracking-tight">Punto <span class="text-app-primary">Frío</span></h1>
            <p class="text-app-textMuted mt-2 text-sm">Ingresa a tu cuenta para continuar</p>
        </div>
        
        <!-- Auth Container -->
        <div class="bg-app-card/80 backdrop-blur-xl border border-app-accent/50 p-8 rounded-3xl shadow-2xl relative">
            @yield('content')
        </div>
        
        <div class="mt-8 text-center text-xs text-app-textMuted/60">
            &copy; {{ date('Y') }} Punto Frío Beto. Sistema OS.
        </div>
    </div>

    @stack('scripts')
</body>
</html>
