@extends('layouts.auth')

@section('title', 'Registro de Administrador')

@section('content')
    <div class="text-center mb-8">
        <h2 class="text-2xl sm:text-3xl font-bold text-white tracking-tight">Crear Cuenta</h2>
        <p class="text-app-textMuted text-sm mt-2">Regístrate para gestionar tu inventario</p>
    </div>

    <form action="{{ route('registrar.post') }}" method="POST" class="space-y-5">
        @csrf
        
        <!-- Nombre Input -->
        <div class="group">
            <label class="block text-app-textMuted text-sm font-medium mb-2 pl-1">Nombre Completo</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-app-textMuted group-focus-within:text-app-primary transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </div>
                <input 
                    type="text" 
                    name="nombre" 
                    required
                    class="w-full pl-11 pr-4 py-3 bg-app-bg/50 border border-app-accent rounded-xl text-white placeholder-app-textMuted/50 focus:outline-none focus:border-app-primary focus:ring-1 focus:ring-app-primary transition duration-200"
                    placeholder="Tu nombre y apellido"
                    value="{{ old('nombre') }}"
                >
            </div>
            @error('nombre')
                <p class="text-red-400 text-xs mt-1.5 ml-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email Input -->
        <div class="group">
            <label class="block text-app-textMuted text-sm font-medium mb-2 pl-1">Correo Electrónico</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-app-textMuted group-focus-within:text-app-primary transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path></svg>
                </div>
                <input 
                    type="email" 
                    name="correo" 
                    required
                    class="w-full pl-11 pr-4 py-3 bg-app-bg/50 border border-app-accent rounded-xl text-white placeholder-app-textMuted/50 focus:outline-none focus:border-app-primary focus:ring-1 focus:ring-app-primary transition duration-200"
                    placeholder="tu@email.com"
                    value="{{ old('correo') }}"
                >
            </div>
            @error('correo')
                <p class="text-red-400 text-xs mt-1.5 ml-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password Input -->
        <div class="group">
            <label class="block text-app-textMuted text-sm font-medium mb-2 pl-1">Contraseña</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-app-textMuted group-focus-within:text-app-primary transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </div>
                <input 
                    type="password" 
                    name="password" 
                    required
                    class="w-full pl-11 pr-4 py-3 bg-app-bg/50 border border-app-accent rounded-xl text-white placeholder-app-textMuted/50 focus:outline-none focus:border-app-primary focus:ring-1 focus:ring-app-primary transition duration-200"
                    placeholder="••••••••"
                >
            </div>
            @error('password')
                <p class="text-red-400 text-xs mt-1.5 ml-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit Button -->
        <button 
            type="submit"
            class="w-full py-3.5 mt-6 bg-app-primary hover:bg-app-primaryHover text-slate-900 font-bold rounded-xl shadow-[0_0_20px_rgba(245,158,11,0.3)] hover:shadow-[0_0_25px_rgba(245,158,11,0.5)] transform hover:-translate-y-0.5 transition duration-200 text-lg flex items-center justify-center gap-2"
        >
            <span>Crear Cuenta Completada</span>
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
        </button>
    </form>

    <!-- Divider -->
    <div class="flex items-center gap-4 my-8">
        <div class="flex-1 h-px bg-app-accent/50"></div>
    </div>

    <!-- Login Link -->
    <div class="text-center">
        <p class="text-app-textMuted text-sm">
            ¿Ya tienes cuenta?
            <a href="{{ route('login') }}" class="text-app-primary font-semibold hover:text-white transition-colors ml-1">
                Inicia sesión aquí
            </a>
        </p>
    </div>
@endsection