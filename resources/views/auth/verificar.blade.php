@extends('layouts.auth')

@section('title', 'Verificar Cuenta')

@section('content')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>
    <script>
        emailjs.init("TKOSAIOMp5yR3l0xL"); // Tu Public Key

        let tiempoRestante = 0;

        window.onload = function () {
            emailjs.send('service_al7vroi', 'template_u9ydqpc', {
                user_email: "{{ $correo }}",
                codigo_verificacion: "{{ $codigo }}"
            }).then(() => {
                // Mostrar notificación en la página en lugar de alert
                const notification = document.getElementById('notificacion-enviada');
                if (notification) {
                    notification.classList.remove('hidden');
                }
                // Iniciar el countdown de 60 segundos
                iniciarCountdown();
            });
        };

        function iniciarCountdown() {
            tiempoRestante = 60;
            const btn = document.getElementById('btn-reenviar');
            const contador = document.getElementById('contador-tiempo');

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
            const correo = "{{ $correo }}";

            btn.disabled = true;
            btn.innerHTML = '⏳ Enviando...';

            // Hacer solicitud al backend para generar nuevo código
            fetch("{{ route('reenviar.codigo') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    correo: correo
                })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Ahora enviar el nuevo código por EmailJS
                        emailjs.send('service_al7vroi', 'template_u9ydqpc', {
                            user_email: correo,
                            codigo_verificacion: "Por favor revisa tu email para el nuevo código"
                        }).then(() => {
                            // Mostrar notificación
                            const notification = document.getElementById('notificacion-enviada');
                            notification.classList.remove('hidden');

                            // Restablecer botón con countdown
                            btn.innerHTML = '🔄 Reenviar código <span id="contador-tiempo"></span>';
                            iniciarCountdown();
                        }).catch(error => {
                            console.error('EmailJS Error:', error);
                            btn.innerHTML = '✅ Código generado (revisa tu email)';
                            btn.disabled = true;
                            setTimeout(() => {
                                btn.innerHTML = '🔄 Reenviar código';
                                iniciarCountdown();
                            }, 2000);
                        });
                    } else {
                        btn.innerHTML = '❌ Error al enviar';
                        btn.disabled = false;
                        setTimeout(() => {
                            btn.innerHTML = '🔄 Reenviar código';
                        }, 2000);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    btn.innerHTML = '❌ Error de conexión';
                    btn.disabled = false;
                    setTimeout(() => {
                        btn.innerHTML = '🔄 Reenviar código';
                    }, 2000);
                });
        }
    </script>

    <div class="text-center mb-8">
        <h2 class="text-2xl sm:text-3xl font-bold text-white tracking-tight mb-3">Verifica tu Cuenta</h2>
        <p class="text-app-textMuted text-sm">Hemos enviado un código de verificación a:</p>
        <p class="text-app-primary font-semibold text-sm mt-1 bg-app-primary/10 inline-block px-3 py-1 rounded-lg border border-app-primary/20">{{ $correo }}</p>
    </div>

    <!-- Notificación de código enviado -->
    <div id="notificacion-enviada" class="hidden bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 px-4 py-3 rounded-xl flex items-start gap-3 mb-6 animate-pulse">
        <span class="text-xl">✨</span>
        <p class="text-sm pt-0.5">Código de verificación enviado correctamente a tu correo.</p>
    </div>

    <form action="{{ route('activar.post') }}" method="POST" class="space-y-6">
        @csrf
        <input type="hidden" name="correo" value="{{ $correo }}">

        <!-- Codigo Input -->
        <div class="group">
            <label class="block text-app-textMuted text-sm font-medium mb-3 pl-1 text-center">🔐 Ingresa tu Código de 6 Dígitos</label>
            <div class="relative max-w-xs mx-auto">
                <input 
                    type="text" 
                    name="codigo" 
                    required 
                    maxlength="6" 
                    inputmode="numeric"
                    class="w-full px-4 py-4 bg-app-bg/80 border border-app-accent rounded-xl text-white placeholder-app-textMuted/30 focus:outline-none focus:border-app-primary focus:ring-2 focus:ring-app-primary/50 transition duration-200 text-center text-3xl tracking-[0.5em] font-bold shadow-inner"
                    placeholder="000000"
                >
            </div>
            @error('codigo')
                <p class="text-red-400 text-xs mt-2 text-center">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit Button -->
        <button 
            type="submit"
            class="w-full py-3.5 mt-4 bg-app-primary hover:bg-app-primaryHover text-slate-900 font-bold rounded-xl shadow-[0_0_20px_rgba(245,158,11,0.3)] hover:shadow-[0_0_25px_rgba(245,158,11,0.5)] transform hover:-translate-y-0.5 transition duration-200 text-lg flex items-center justify-center gap-2"
        >
            <span>Verificar Cuenta</span>
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </button>
    </form>

    <!-- Divider -->
    <div class="flex items-center gap-4 my-8">
        <div class="flex-1 h-px bg-app-accent/50"></div>
    </div>

    <!-- Re-send Button -->
    <div class="text-center">
        <p class="text-app-textMuted text-sm mb-4">¿No recibiste el código o expiró?</p>
        <button 
            id="btn-reenviar" 
            type="button" 
            onclick="reenviarCodigo()"
            class="px-6 py-2.5 bg-app-bg/50 border border-app-accent hover:border-app-primary/50 text-app-textMuted hover:text-white font-medium rounded-xl shadow-sm transition duration-200 text-sm inline-flex items-center gap-2 group"
        >
            <svg class="w-4 h-4 text-app-primary group-hover:rotate-180 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
            Reenviar código <span id="contador-tiempo" class="text-app-primary ml-1"></span>
        </button>
    </div>
@endsection