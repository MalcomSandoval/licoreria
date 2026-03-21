@extends('layouts.auth')

@section('content')
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>
<script>
    emailjs.init("TKOSAIOMp5yR3l0xL"); // Tu Public Key

    let tiempoRestante = 0;

    window.onload = function() {
        emailjs.send('service_al7vroi', 'template_u9ydqpc', {
            user_email: "{{ $correo }}",
            codigo_verificacion: "{{ $codigo }}"
        }).then(() => {
            // Mostrar notificación en la página en lugar de alert
            const notification = document.getElementById('notificacion-enviada');
            if(notification) {
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
            
            if(tiempoRestante <= 0) {
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
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            },
            body: JSON.stringify({ correo: correo })
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                // Ahora enviar el nuevo código por EmailJS
                // El código nuevamente será generado entre 100000-999999 en el backend
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

<!-- Header con Logo -->
<div class="text-center mb-6 sm:mb-8">
    <div class="flex justify-center mb-4">
        <div class="w-16 h-16 sm:w-20 sm:h-20 bg-gradient-to-br from-blue-400 to-blue-600 rounded-lg shadow-2xl flex items-center justify-center transform hover:scale-105 transition">
            <span class="text-2xl sm:text-3xl">✓</span>
        </div>
    </div>
    <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 via-blue-500 to-blue-700 mb-2">Punto frio donde beto</h1>
    <p class="text-blue-600 text-xs sm:text-sm tracking-widest font-semibold">Verificar Cuenta</p>
</div>

<!-- Form Container -->
<div class="bg-gradient-to-b from-white to-blue-50 rounded-2xl shadow-2xl border border-blue-200 p-6 sm:p-8 space-y-6">
    <div class="text-center mb-6">
        <h2 class="text-xl sm:text-2xl font-bold text-blue-900 mb-3">Verifica tu Cuenta</h2>
        <p class="text-slate-600 text-sm">Hemos enviado un código de verificación a:</p>
        <p class="text-blue-600 font-semibold text-sm mt-1">{{ $correo }}</p>
    </div>

    <!-- Notificación de código enviado -->
    <div id="notificacion-enviada" class="hidden bg-green-50 border border-green-300 text-green-700 px-4 py-3 rounded-lg flex items-start gap-3 animate-pulse">
        <span class="text-xl">✅</span>
        <p class="text-sm">Código de verificación enviado correctamente</p>
    </div>

    <form action="{{ route('activar.post') }}" method="POST" class="space-y-6">
        @csrf
        <input type="hidden" name="correo" value="{{ $correo }}">
        
        <!-- Codigo Input -->
        <div class="group">
            <label class="block text-blue-700 text-sm font-semibold mb-2 ml-1">🔐 Código de Verificación</label>
            <div class="relative">
                <input 
                    type="text" 
                    name="codigo" 
                    required
                    maxlength="6"
                    inputmode="numeric"
                    class="w-full px-4 py-3 bg-white border-2 border-blue-300 rounded-lg text-slate-900 placeholder-slate-400 focus:outline-none focus:border-blue-600 focus:bg-blue-50 transition duration-200 text-center text-2xl tracking-widest font-bold"
                    placeholder="000000"
                >
                <span class="absolute right-3 top-3 text-blue-500">✓</span>
            </div>
            <p class="text-slate-500 text-xs mt-2 ml-1">Ingresa los 6 dígitos del código</p>
            @error('codigo')
                <p class="text-red-600 text-xs mt-1 ml-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit Button -->
        <button 
            type="submit"
            class="w-full py-3 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-bold rounded-lg shadow-lg hover:shadow-2xl transform hover:scale-105 transition duration-200 text-lg tracking-wide"
        >
            🚀 Verificar Cuenta
        </button>
    </form>

    <!-- Divider -->
    <div class="flex items-center gap-4 my-6">
        <div class="flex-1 h-px bg-gradient-to-r from-transparent to-blue-300"></div>
        <span class="text-blue-500 text-xs font-semibold">O</span>
        <div class="flex-1 h-px bg-gradient-to-l from-transparent to-blue-300"></div>
    </div>

    <!-- Re-send Button -->
    <div class="text-center">
        <p class="text-slate-600 text-xs sm:text-sm mb-3">
            ¿No recibiste el código?
        </p>
        <button 
            id="btn-reenviar"
            type="button"
            onclick="reenviarCodigo()"
            class="px-6 py-2 bg-gradient-to-r from-blue-400 to-blue-500 hover:from-blue-500 hover:to-blue-600 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transition duration-200 text-sm inline-flex items-center gap-2"
        >
            🔄 Reenviar código <span id="contador-tiempo"></span>
        </button>
    </div>
</div>

<!-- Footer -->
<div class="text-center mt-8 text-slate-500 text-xs">
    <p>© 2026 Punto frio donde beto - Sistema de Punto de Venta</p>
    <p class="text-blue-600 mt-2 font-semibold">🍺 Vinos • Licores • Bebidas Destiladas</p>
</div>
@endsection