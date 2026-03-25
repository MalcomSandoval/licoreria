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
}