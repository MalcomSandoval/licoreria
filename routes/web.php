<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;

// --- 1. RUTAS PÚBLICAS (Cualquiera puede verlas) ---
Route::get('/', function () {
    return view('principal');
})->name('principal');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Registro y Activación
Route::get('/registro', [AuthController::class, 'mostrarRegistro'])->name('registro.index');
Route::post('/registrar', [AuthController::class, 'registrar'])->name('registrar.post');
Route::post('/activar', [AuthController::class, 'activar'])->name('activar.post');
Route::post('/reenviar-codigo', [AuthController::class, 'reenviarCodigo'])->name('reenviar.codigo');


// --- 2. RUTAS PROTEGIDAS (Solo usuarios LOGUEADOS Y ACTIVOS) ---
Route::middleware(['auth', 'user.active'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [AuthController::class, 'mostrarDashboard'])->name('dashboard');

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

    // Reportes (Temporal)
    Route::get('/reportes', function () {
        return "Sección de Reportes";
    })->name('reportes.index');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});