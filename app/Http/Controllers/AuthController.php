<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function mostrarRegistro() {
        return view('auth.registro');
    }

    public function registrar(Request $request) {
        // --- VALIDACIÓN CON MENSAJE PERSONALIZADO ---
        $request->validate([
            'correo' => 'required|email|unique:usuarios,correo',
            'nombre' => 'required|string|max:255',
            'password' => 'required|min:6',
        ], [
            // Este es el mensaje que aparecerá si el correo ya existe o hay errores
            'correo.unique' => 'Este correo ya está registrado en nuestro sistema o tienes algún error.',
            'required' => 'Este campo es obligatorio.',
            'min' => 'La contraseña es muy corta o tienes algún error.'
        ]);

        $codigo = rand(100000, 999999);

        $usuario = Usuario::create([
            'id' => (string) Str::uuid(),
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'contrasena' => Hash::make($request->password),
            'activo' => 0, 
            'codigo_verificacion' => $codigo
        ]);

        return view('auth.verificar', ['correo' => $usuario->correo, 'codigo' => $codigo]);
    }

    public function activar(Request $request) {
        $usuario = Usuario::where('correo', $request->correo)
                          ->where('codigo_verificacion', $request->codigo)
                          ->first();

        if ($usuario) {
            $usuario->update(['activo' => 1, 'codigo_verificacion' => null]);
            return redirect('/login')->with('success', 'Cuenta activada. Ya puedes iniciar sesión.');
        }
        return back()->with('error', 'Código incorrecto.');
    }

    public function login(Request $request) {
        $credentials = [
            'correo' => $request->correo,
            'password' => $request->contrasena, 
            'activo' => 1 
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard'); 
        }

        return back()->with('error', 'Credenciales incorrectas o cuenta no activada.');
    }

    public function mostrarDashboard() {
        $ventasHoy = 0.00; 
        $cantidadHoy = 0;
        $totalProductos = 0;
        $productosActivos = 0;
        $stockBajo = 0;
        $ventasMes = 0.00;
        $transaccionesMes = 0;

        $ventasRecientes = collect(); 
        $topProductos = collect();
        $metodosPago = collect();
        $productosStockBajo = collect();

        $totalSemana = 0.00;
        $promedioSemana = 0.00;
        $transaccionesSemana = 0;

        return view('dashboard.index', compact(
            'ventasHoy', 'cantidadHoy', 'totalProductos', 'productosActivos',
            'stockBajo', 'ventasMes', 'transaccionesMes', 'ventasRecientes',
            'topProductos', 'metodosPago', 'productosStockBajo', 'totalSemana',
            'promedioSemana', 'transaccionesSemana'
        ));
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function reenviarCodigo(Request $request) {
        try {
            $correo = $request->input('correo');
            $usuario = Usuario::where('correo', $correo)->first();
            
            if (!$usuario) {
                return response()->json(['success' => false, 'message' => 'Usuario no encontrado'], 404);
            }
            
            $codigoNuevo = rand(100000, 999999);
            $usuario->update(['codigo_verificacion' => $codigoNuevo]);
            
            return response()->json(['success' => true, 'message' => 'Código reenviado correctamente']);
            
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

   // Muestra el formulario de cambio de contraseña
    public function mostrarCambiarPassword() {
        return view('auth.cambiar-password');
    }

    // Procesa la actualización de la contraseña
    public function actualizarPassword(Request $request) {
        
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:6|confirmed', // 'confirmed' busca un campo llamado password_confirmation
        ], [
            'current_password.required' => 'Debes ingresar tu contraseña actual.',
            'password.required' => 'La nueva contraseña es obligatoria.',
            'password.min' => 'La nueva contraseña debe tener al menos 6 caracteres.',
            'password.confirmed' => 'La confirmación de la contraseña no coincide.',
        ]);

        $usuario = Auth::user();

        // 2. Verificar si la contraseña actual es correcta
        if (!Hash::check($request->current_password, $usuario->getAuthPassword())) {
            return back()->withErrors(['current_password' => 'La contraseña actual no es correcta.']);
        }

        // 3. Actualizar la contraseña
        // Nota: El modelo Usuario debe usar la columna 'contrasena' según tu código previo
        $usuario->update([
            'contrasena' => Hash::make($request->password)
        ]);

        return back()->with('status', '¡Contraseña actualizada con éxito!');
    }

    public function mostrarRecuperar() {
    return view('auth.recuperar'); // Una vista simple para pedir el correo
}

public function enviarCodigoRecuperacion(Request $request) {
    $request->validate(['correo' => 'required|email|exists:usuarios,correo']);
    
    $codigo = rand(100000, 999999);
    Usuario::where('correo', $request->correo)->update(['codigo_verificacion' => $codigo]);

    return back()
        ->with('correo_temp', $request->correo)
        ->with('codigo_simulado', $codigo) // Pasamos el código para que EmailJS lo envíe
        ->with('status', 'code_sent'); 
}

public function mostrarRestablecer($correo) {
    return view('auth.restablecer', compact('correo'));
}

public function confirmarRestablecer(Request $request) {
    $request->validate([
        'correo' => 'required|email|exists:usuarios,correo',
        'codigo' => 'required',
        'password' => 'required|min:6|confirmed'
    ], [
        'password.confirmed' => 'Las contraseñas no coinciden.',
        'password.min' => 'La contraseña debe tener al menos 6 caracteres.'
    ]);

    $usuario = Usuario::where('correo', $request->correo)
                      ->where('codigo_verificacion', $request->codigo)
                      ->first();

    if (!$usuario) {
        // Si el código es incorrecto, regresamos con error para que el modal no se cierre
        return back()->withErrors(['codigo' => 'El código de verificación es incorrecto o ha expirado.'])
                     ->withInput()
                     ->with('status', 'error_codigo'); 
    }

    // Actualizamos la contraseña
    $usuario->update([
        'contrasena' => Hash::make($request->password),
        'codigo_verificacion' => null // Limpiamos el código usado
    ]);

    // Redirección final al login con mensaje de éxito
    return redirect()->route('login')->with('success', '¡Contraseña restablecida! Ya puedes iniciar sesión.');
}
}
