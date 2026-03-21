<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; // IMPORTANTE: Esta línea corrige el error de tu imagen
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function mostrarRegistro() {
        return view('auth.registro');
    }

    public function registrar(Request $request) {
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
        // Credenciales para el intento de login
        $credentials = [
            'correo' => $request->correo,
            'password' => $request->contrasena, // Laravel buscará 'password' por defecto
            'activo' => 1 // Solo permite entrar a cuentas activadas
        ];

        // Intentar iniciar sesión
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard'); 
        }

        return back()->with('error', 'Credenciales incorrectas o cuenta no activada.');
    }

    /**
     * Esta función corrige los errores de "Undefined variable" en tu Dashboard
     */
    public function mostrarDashboard() {
        $ventasHoy = 0.00; 
        $cantidadHoy = 0;
        $totalProductos = 0;
        $productosActivos = 0;
        $stockBajo = 0;
        $ventasMes = 0.00;
        $transaccionesMes = 0;

        // Colecciones vacías para que los bucles @forelse no fallen
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

    /**
     * Función de Logout corregida
     */
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    /**
     * Reenviar código de verificación
     */
    public function reenviarCodigo(Request $request) {
        try {
            $correo = $request->input('correo');
            
            // Buscar el usuario por correo
            $usuario = Usuario::where('correo', $correo)->first();
            
            if (!$usuario) {
                return response()->json(['success' => false, 'message' => 'Usuario no encontrado'], 404);
            }
            
            // Generar nuevo código
            $codigoNuevo = rand(100000, 999999);
            
            // Actualizar el código en la base de datos
            $usuario->update(['codigo_verificacion' => $codigoNuevo]);
            
            // Retornar success para que el frontend sepa que todo fue bien
            // El código será enviado automáticamente por EmailJS en el frontend
            return response()->json(['success' => true, 'message' => 'Código reenviado correctamente']);
            
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }
}