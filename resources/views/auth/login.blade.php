@extends('layouts.auth')

@section('title', 'Iniciar Sesión')

@section('content')
    <!-- Error Message -->
    @if(session('error'))
        <div class="bg-red-500/10 border border-red-500/20 text-red-500 px-4 py-3 rounded-xl flex items-start gap-3 mb-6 animate-pulse">
            <span class="text-xl">⚠️</span>
            <p class="text-sm">{{ session('error') }}</p>
        </div>
    @endif

    <div class="text-center mb-8">
        <h2 class="text-2xl sm:text-3xl font-bold text-white tracking-tight">Iniciar Sesión</h2>
        <p class="text-app-textMuted text-sm mt-2">Bienvenido de vuelta, administrador</p>
    </div>

    <form action="{{ route('login.post') }}" method="POST" class="space-y-6">
        @csrf
        
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
                    name="contrasena" 
                    required
                    class="w-full pl-11 pr-4 py-3 bg-app-bg/50 border border-app-accent rounded-xl text-white placeholder-app-textMuted/50 focus:outline-none focus:border-app-primary focus:ring-1 focus:ring-app-primary transition duration-200"
                    placeholder="••••••••"
                >
            </div>
            <div class="flex justify-end mt-2">
                <a href="#" class="text-xs text-app-primary hover:text-app-primaryHover transition-colors">¿Olvidaste tu contraseña?</a>
            </div>
        </div>

        <!-- Submit Button -->
        <button 
            type="submit"
            class="w-full py-3.5 mt-4 bg-app-primary hover:bg-app-primaryHover text-slate-900 font-bold rounded-xl shadow-[0_0_20px_rgba(245,158,11,0.3)] hover:shadow-[0_0_25px_rgba(245,158,11,0.5)] transform hover:-translate-y-0.5 transition duration-200 text-lg flex items-center justify-center gap-2"
        >
            <span>Entrar al Sistema</span>
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
        </button>
    </form>

    <!-- Divider -->
    <div class="flex items-center gap-4 my-8">
        <div class="flex-1 h-px bg-app-accent/50"></div>
        <span class="text-app-textMuted text-xs font-semibold uppercase tracking-wider">Acceso Seguro</span>
        <div class="flex-1 h-px bg-app-accent/50"></div>
    </div>

    <!-- Register Link -->
    <div class="text-center">
        <p class="text-app-textMuted text-sm">
            ¿No tienes cuenta?
            <a href="{{ route('registro.index') }}" class="text-app-primary font-semibold hover:text-white transition-colors ml-1">
                Regístrate aquí
            </a>
        </p>
    </div>
@endsection