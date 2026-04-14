<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\Producto;
use Carbon\Carbon;



// --- 1. RUTAS PÚBLICAS (Cualquiera puede verlas) ---
Route::get('/', function () {
    return view('principal');
})->name('principal');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Rutas para recuperar contraseña (Públicas)
Route::get('/recuperar-password', [AuthController::class, 'mostrarRecuperar'])->name('password.request');
Route::post('/enviar-codigo-recuperacion', [AuthController::class, 'enviarCodigoRecuperacion'])->name('password.email');
Route::get('/restablecer-password/{correo}', [AuthController::class, 'mostrarRestablecer'])->name('password.reset');
Route::post('/confirmar-restablecer', [AuthController::class, 'confirmarRestablecer'])->name('password.update.public');

// Registro y Activación
// Registro y Activación
Route::get('/registro', [AuthController::class, 'mostrarRegistro'])->name('registro.index');
Route::post('/registrar', [AuthController::class, 'registrar'])->name('registrar.post');
Route::post('/activar', [AuthController::class, 'activar'])->name('activar.post');
Route::post('/reenviar-codigo', [AuthController::class, 'reenviarCodigo'])->name('reenviar.codigo');

// --- 2. RUTAS PROTEGIDAS (Solo usuarios LOGUEADOS Y ACTIVOS) ---
Route::middleware(['auth', 'user.active'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Ventas
    Route::get('/ventas', [VentaController::class, 'index'])->name('ventas.index');
    Route::post('/ventas', [VentaController::class, 'store'])->name('ventas.store');
    Route::delete('/ventas/{id}', [VentaController::class, 'destroy'])->name('ventas.destroy');
    Route::get('/ventas/filtrar', [VentaController::class, 'filtrar'])->name('ventas.filtrar');
    Route::get('/ventas/{id}/detalle', fn($id) => response()->json(
        \App\Models\Venta::with(['detalles.producto'])->findOrFail($id)
    ))->name('ventas.detalle');

    // Inventario (Productos)
    Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
    Route::get('/productos/filtrar', [ProductoController::class, 'filtrar'])->name('productos.filtrar');
    Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');
    Route::put('/productos/{id}', [ProductoController::class, 'update'])->name('productos.update');
    Route::patch('/productos/{id}/desactivar', [ProductoController::class, 'desactivar'])->name('productos.desactivar');
    Route::patch('/productos/{id}/activar', [ProductoController::class, 'activar'])->name('productos.activar');

    // Proveedores
    Route::get('/proveedores', [ProveedorController::class, 'index'])->name('proveedores.index');
    Route::post('/proveedores', [ProveedorController::class, 'store'])->name('proveedores.store');
    Route::put('/proveedores/{id}', [ProveedorController::class, 'update'])->name('proveedores.update');
    Route::delete('/proveedores/{id}', [ProveedorController::class, 'destroy'])->name('proveedores.destroy');

    // Reportes
    Route::get('/reportes', function () {
        return view('reportes.reportes');
    })->name('reportes.index');

    Route::get('/reportes/data', function (Request $request) {
        $periodo = (int) ($request->periodo ?? 7);
        $fechaLimite = Carbon::now()->subDays($periodo);

        $ventas = Venta::with('detalles.producto')
            ->where('activa', 1)
            ->where('fecha_venta', '>=', $fechaLimite)
            ->get()
            ->map(function ($venta) {
                // Forzar campos numericos de la venta a tipos correctos
                $venta->total = (float) $venta->total;
                $venta->precio_compra = (float) ($venta->precio_compra ?? 0);

                $venta->detalles->transform(function ($d) {
                    $d->precio_unitario = (float) $d->precio_unitario;
                    $d->precio_compra = (float) ($d->precio_compra ?? 0);
                    $d->subtotal = (float) $d->subtotal;
                    $d->cantidad = (int) $d->cantidad;
                    return $d;
                });
                return $venta;
            });

        $productos = Producto::all();

        return response()->json([
            'ventas' => $ventas,
            'productos' => $productos,
        ]);
    })->name('reportes.data');
    
    // --- CAMBIO DE CONTRASEÑA ---
    Route::get('/cambiar-password', [AuthController::class, 'mostrarCambiarPassword'])->name('password.edit');
    Route::put('/cambiar-password', [AuthController::class, 'actualizarPassword'])->name('password.update');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});