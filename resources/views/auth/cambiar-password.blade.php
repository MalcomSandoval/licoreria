@extends('layouts.auth')

@section('title', 'Cambiar Contraseña')

@section('content')
    @if(session('status'))
        <div class="bg-green-500/10 border border-green-500/20 text-green-500 px-4 py-3 rounded-xl flex items-start gap-3 mb-6">
            <span class="text-xl">✅</span>
            <p class="text-sm">{{ session('status') }}</p>
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-500/10 border border-red-500/20 text-red-500 px-4 py-3 rounded-xl mb-6">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="text-center mb-8">
        <h2 class="text-2xl sm:text-3xl font-bold text-white tracking-tight">Cambiar Contraseña</h2>
        <p class="text-app-textMuted text-sm mt-2">Asegura tu cuenta con una clave nueva</p>
    </div>

    <form action="{{ route('password.update') }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT') {{-- Usamos PUT para actualizaciones --}}
        
        <div class="group">
            <label class="block text-app-textMuted text-sm font-medium mb-2 pl-1">Contraseña Actual</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-app-textMuted group-focus-within:text-app-primary transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </div>
                <input 
                    type="password" 
                    name="current_password" 
                    required
                    class="w-full pl-11 pr-4 py-3 bg-app-bg/50 border border-app-accent rounded-xl text-white placeholder-app-textMuted/50 focus:outline-none focus:border-app-primary focus:ring-1 focus:ring-app-primary transition duration-200"
                    placeholder="Contraseña actual"
                >
            </div>
        </div>

        <div class="flex-1 h-px bg-app-accent/30 my-2"></div>

        <div class="group">
            <label class="block text-app-textMuted text-sm font-medium mb-2 pl-1">Nueva Contraseña</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-app-textMuted group-focus-within:text-app-primary transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>
                </div>
                <input 
                    type="password" 
                    name="password" 
                    required
                    class="w-full pl-11 pr-4 py-3 bg-app-bg/50 border border-app-accent rounded-xl text-white placeholder-app-textMuted/50 focus:outline-none focus:border-app-primary focus:ring-1 focus:ring-app-primary transition duration-200"
                    placeholder="Mínimo 8 caracteres"
                >
            </div>
        </div>

        <div class="group">
            <label class="block text-app-textMuted text-sm font-medium mb-2 pl-1">Confirmar Nueva Contraseña</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-app-textMuted group-focus-within:text-app-primary transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <input 
                    type="password" 
                    name="password_confirmation" 
                    required
                    class="w-full pl-11 pr-4 py-3 bg-app-bg/50 border border-app-accent rounded-xl text-white placeholder-app-textMuted/50 focus:outline-none focus:border-app-primary focus:ring-1 focus:ring-app-primary transition duration-200"
                    placeholder="Repite la contraseña"
                >
            </div>
        </div>

        <button 
            type="submit"
            class="w-full py-3.5 mt-4 bg-app-primary hover:bg-app-primaryHover text-slate-900 font-bold rounded-xl shadow-[0_0_20px_rgba(245,158,11,0.3)] hover:shadow-[0_0_25px_rgba(245,158,11,0.5)] transform hover:-translate-y-0.5 transition duration-200 text-lg flex items-center justify-center gap-2"
        >
            <span>Actualizar Contraseña</span>
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        </button>
    </form>

    <div class="text-center mt-8">
        <a href="{{ route('dashboard') }}" class="text-app-textMuted text-sm hover:text-white transition-colors flex items-center justify-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Volver al Panel
        </a>
    </div>
@endsection