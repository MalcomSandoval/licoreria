<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>
<script>
    emailjs.init("Owb5K2xDLKW8zAnoW"); // Tu Public Key

    window.onload = function() {
        emailjs.send('service_dgp24vt', 'template_34yan43', {
            user_email: "{{ $correo }}",
            codigo_verificacion: "{{ $codigo }}"
        }).then(() => alert("Código enviado."));
    };
</script>

<form action="{{ route('activar.post') }}" method="POST">
    @csrf
    <input type="hidden" name="correo" value="{{ $correo }}">
    <input type="text" name="codigo" placeholder="Ingresa los 6 números" required>
    <button type="submit">Verificar Cuenta</button>
</form>