@extends('layouts.auth')

@section('content')
<!-- Header con Logo -->
<div class="text-center mb-6 sm:mb-8">
    <div class="flex justify-center mb-4">
        <div class="w-16 h-16 sm:w-20 sm:h-20 bg-gradient-to-br from-blue-400 to-blue-600 rounded-lg shadow-2xl flex items-center justify-center transform hover:scale-105 transition">
            <span class="text-2xl sm:text-3xl">🍷</span>
        </div>
    </div>
    <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 via-blue-500 to-blue-700 mb-2">Punto frio donde beto</h1>
    <p class="text-blue-600 text-xs sm:text-sm tracking-widest font-semibold">Crear Nueva Cuenta</p>
</div>

<!-- Form Container -->
<div class="bg-gradient-to-b from-white to-blue-50 rounded-2xl shadow-2xl border border-blue-200 p-6 sm:p-8 space-y-6">
    <h2 class="text-xl sm:text-2xl font-bold text-blue-900 text-center">Registrarse</h2>

    <form action="{{ route('registrar.post') }}" method="POST" class="space-y-5">
        @csrf
        
        <!-- Nombre Input -->
        <div class="group">
            <label class="block text-blue-700 text-sm font-semibold mb-2 ml-1">👤 Nombre Completo</label>
            <div class="relative">
                <input 
                    type="text" 
                    name="nombre" 
                    required
                    class="w-full px-4 py-3 bg-white border-2 border-blue-300 rounded-lg text-slate-900 placeholder-slate-400 focus:outline-none focus:border-blue-600 focus:bg-blue-50 transition duration-200"
                    placeholder="Juan Pérez"
                    value="{{ old('nombre') }}"
                >
                <span class="absolute right-3 top-3 text-blue-500">✓</span>
            </div>
            @error('nombre')
                <p class="text-red-600 text-xs mt-1 ml-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email Input -->
        <div class="group">
            <label class="block text-blue-700 text-sm font-semibold mb-2 ml-1">📧 Correo Electrónico</label>
            <div class="relative">
                <input 
                    type="email" 
                    name="correo" 
                    required
                    class="w-full px-4 py-3 bg-white border-2 border-blue-300 rounded-lg text-slate-900 placeholder-slate-400 focus:outline-none focus:border-blue-600 focus:bg-blue-50 transition duration-200"
                    placeholder="tu@email.com"
                    value="{{ old('correo') }}"
                >
                <span class="absolute right-3 top-3 text-blue-500">✓</span>
            </div>
            @error('correo')
                <p class="text-red-600 text-xs mt-1 ml-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password Input -->
        <div class="group">
            <label class="block text-blue-700 text-sm font-semibold mb-2 ml-1">🔐 Contraseña</label>
            <div class="relative">
                <input 
                    type="password" 
                    name="password" 
                    required
                    class="w-full px-4 py-3 bg-white border-2 border-blue-300 rounded-lg text-slate-900 placeholder-slate-400 focus:outline-none focus:border-blue-600 focus:bg-blue-50 transition duration-200"
                    placeholder="••••••••"
                >
                <span class="absolute right-3 top-3 text-blue-500">🔒</span>
            </div>
            @error('password')
                <p class="text-red-600 text-xs mt-1 ml-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit Button -->
        <button 
            type="submit"
            class="w-full py-3 mt-8 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-bold rounded-lg shadow-lg hover:shadow-2xl transform hover:scale-105 transition duration-200 text-lg tracking-wide"
        >
            ✨ Crear Cuenta
        </button>
    </form>

    <!-- Divider -->
    <div class="flex items-center gap-4 my-6">
        <div class="flex-1 h-px bg-gradient-to-r from-transparent to-blue-300"></div>
        <span class="text-blue-500 text-xs font-semibold">O</span>
        <div class="flex-1 h-px bg-gradient-to-l from-transparent to-blue-300"></div>
    </div>

    <!-- Login Link -->
    <div class="text-center">
        <p class="text-slate-600 text-xs sm:text-sm">
            ¿Ya tienes cuenta?
            <a 
                href="{{ route('login') }}" 
                class="text-blue-600 font-semibold hover:text-blue-700 transition ml-1 hover:underline"
            >
                Inicia sesión aquí
            </a>
        </p>
    </div>
</div>

<!-- Footer -->
<div class="text-center mt-8 text-slate-500 text-xs">
    <p>© 2026 Punto frio donde beto - Sistema de Punto de Venta</p>
    <p class="text-blue-600 mt-2 font-semibold">🍺 Vinos • Licores • Bebidas Destiladas</p>
</div>
@endsection