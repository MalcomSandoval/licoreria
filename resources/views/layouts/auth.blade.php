<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Licorería - @yield('title', 'Autenticación')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-slate-50 via-blue-50 to-white min-h-screen flex items-center justify-center font-sans p-4 sm:p-6 lg:p-8">
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden">
        <div class="absolute top-10 left-10 w-32 h-32 bg-blue-400 rounded-full blur-3xl opacity-10"></div>
        <div class="absolute bottom-10 right-10 w-40 h-40 bg-blue-600 rounded-full blur-3xl opacity-10"></div>
        <div class="absolute top-1/2 right-1/4 w-36 h-36 bg-blue-300 rounded-full blur-3xl opacity-5"></div>
    </div>

    <div class="relative z-10 w-full max-w-md">
        @yield('content')
    </div>

    @stack('scripts')
</body>
</html>
