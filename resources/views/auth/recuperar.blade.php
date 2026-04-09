@extends('layouts.auth')

@section('title', 'Recuperar Acceso')

@section('content')
    {{-- Script de EmailJS --}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>
    <script>
        emailjs.init("TKOSAIOMp5yR3l0xL"); // Tu Public Key

        let tiempoRestante = 0;

        // Si el modal se abre (porque existe session 'status'), enviamos el correo automáticamente
        @if(session('status'))
            window.onload = function () {
                enviarEmailJS("{{ session('correo_temp') }}", "{{ session('codigo_simulado') }}");
            };
        @endif

        function enviarEmailJS(correo, codigo) {
            emailjs.send('service_al7vroi', 'template_imvldj6', {
                user_email: correo,
                codigo_verificacion: codigo
            }).then(() => {
                const notification = document.getElementById('notificacion-enviada');
                if (notification) notification.classList.remove('hidden');
                iniciarCountdown();
            });
        }

        function iniciarCountdown() {
            tiempoRestante = 60;
            const btn = document.getElementById('btn-reenviar');
            const contador = document.getElementById('contador-tiempo');
            if(!btn) return;

            btn.disabled = true;
            btn.classList.add('opacity-50', 'cursor-not-allowed');

            const intervalo = setInterval(() => {
                tiempoRestante--;
                contador.textContent = `(${tiempoRestante}s)`;
                if (tiempoRestante <= 0) {
                    clearInterval(intervalo);
                    btn.disabled = false;
                    btn.classList.remove('opacity-50', 'cursor-not-allowed');
                    contador.textContent = '';
                }
            }, 1000);
        }

        function reenviarCodigo() {
            const btn = document.getElementById('btn-reenviar');
            const correo = "{{ session('correo_temp') }}";
            btn.disabled = true;
            btn.innerHTML = '⏳ Generando...';

            fetch("{{ route('reenviar.codigo') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                body: JSON.stringify({ correo: correo })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    btn.innerHTML = '🔄 Reenviar código <span id="contador-tiempo"></span>';
                    // Re-enviamos el nuevo código a través de EmailJS
                    enviarEmailJS(correo, data.nuevo_codigo || "Revisa tu correo"); 
                    iniciarCountdown();
                }
            });
        }
    </script>

    {{-- Formulario Inicial (Paso 1) --}}
    <div class="text-center mb-8">
        <h2 class="text-2xl sm:text-3xl font-bold text-white tracking-tight">Recuperar Acceso</h2>
        <p class="text-app-textMuted text-sm mt-2">Ingresa tu correo para recibir un código</p>
    </div>

    @if($errors->any())
        <div class="bg-red-500/10 border border-red-500/20 text-red-500 px-4 py-3 rounded-xl mb-6 text-sm">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('password.email') }}" method="POST" class="space-y-6">
        @csrf
        <div class="group">
            <input type="email" name="correo" required class="w-full px-4 py-3 bg-app-bg/50 border border-app-accent rounded-xl text-white focus:outline-none focus:border-app-primary transition-all" placeholder="tu@email.com" value="{{ old('correo') }}">
        </div>
        <button type="submit" class="w-full py-3.5 bg-app-primary hover:bg-app-primaryHover text-slate-900 font-bold rounded-xl shadow-lg transition duration-200">
            Enviar Código
        </button>
    </form>

    <div class="text-center mt-6">
        <a href="{{ route('login') }}" class="text-app-textMuted text-sm hover:text-white transition-colors">Volver al login</a>
    </div>

    {{-- MODAL PASO 2: VERIFICACIÓN Y CAMBIO --}}
    @if(session('status'))
    <div id="modalRestablecer" class="fixed inset-0 z-[9999] flex items-center justify-center p-4">
        {{-- Fondo con desenfoque --}}
        <div class="fixed inset-0 bg-slate-950/80 backdrop-blur-md"></div>
        
        <div class="relative bg-app-bg border border-app-accent w-full max-w-md p-8 rounded-2xl shadow-2xl animate-in fade-in zoom-in duration-300">
            
            {{-- Notificación EmailJS --}}
            <div id="notificacion-enviada" class="hidden bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 px-4 py-3 rounded-xl flex items-start gap-3 mb-6 animate-pulse">
                <span class="text-xl">✨</span>
                <p class="text-sm pt-0.5">Código enviado correctamente a tu Gmail.</p>
            </div>

            <div class="text-center mb-6">
                <h3 class="text-xl font-bold text-white">Verifica tu Identidad</h3>
                <p class="text-app-textMuted text-sm mt-1">Enviado a: <span class="text-app-primary">{{ session('correo_temp') }}</span></p>
            </div>

            <form action="{{ route('password.update.public') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="correo" value="{{ session('correo_temp') }}">

                <div>
                    <label class="block text-app-textMuted text-center text-xs font-semibold mb-3 uppercase tracking-widest">🔐 Código de 6 dígitos</label>
                    <input type="text" name="codigo" required maxlength="6" inputmode="numeric" class="w-full px-4 py-4 bg-app-bg/80 border border-app-accent rounded-xl text-white text-center text-3xl tracking-[0.4em] font-bold focus:border-app-primary outline-none shadow-inner" placeholder="000000">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-app-textMuted text-[10px] font-bold mb-1 uppercase">Nueva Clave</label>
                        <input type="password" name="password" required class="w-full px-3 py-2.5 bg-app-bg border border-app-accent rounded-lg text-white text-sm focus:border-app-primary outline-none" placeholder="••••••">
                    </div>
                    <div>
                        <label class="block text-app-textMuted text-[10px] font-bold mb-1 uppercase">Confirmar</label>
                        <input type="password" name="password_confirmation" required class="w-full px-3 py-2.5 bg-app-bg border border-app-accent rounded-lg text-white text-sm focus:border-app-primary outline-none" placeholder="••••••">
                    </div>
                </div>

                <button type="submit" class="w-full py-3.5 mt-4 bg-white text-slate-900 font-bold rounded-xl hover:bg-app-primary transition-all shadow-xl active:scale-95">
                    Restablecer Contraseña
                </button>
            </form>

            <div class="flex flex-col items-center mt-6 pt-4 border-t border-app-accent/30 gap-3">
                <button id="btn-reenviar" type="button" onclick="reenviarCodigo()" class="text-app-primary text-xs font-medium hover:underline inline-flex items-center gap-2">
                    🔄 Reenviar código <span id="contador-tiempo"></span>
                </button>
                
                {{-- Botón para cerrar modal y corregir correo --}}
                <a href="{{ route('password.request') }}" class="text-app-textMuted text-[11px] hover:text-white transition-colors">
                    ¿Te equivocaste de correo? Haz clic aquí
                </a>
            </div>
        </div>
    </div>
    @endif
@endsection