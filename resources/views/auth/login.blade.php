<div class="login-container">
    <h2>Entrar a LICORERIA</h2>

    @if(session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    <form action="{{ route('login.post') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Correo:</label>
            <input type="email" name="correo" required>
        </div>
        
        <div class="form-group">
            <label>Contraseña:</label>
            <input type="password" name="contrasena" required>
        </div>

        <button type="submit">Iniciar Sesión</button>
    </form>
    
    <p>¿No tienes cuenta? <a href="{{ route('registro.index') }}">Regístrate aquí</a></p>
</div>