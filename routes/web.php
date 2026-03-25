<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\ProductoController;


// 1. RUTA PRINCIPAL
Route::get('/', function () {
    return view('Principal'); // Esto busca resources/views/Principal.blade.php
});

// 2. RUTAS DE REGISTRO Y ACTIVACIÓN
Route::get('/registro', [AuthController::class, 'mostrarRegistro'])->name('registro.index');
Route::post('/registrar', [AuthController::class, 'registrar'])->name('registrar.post');
Route::post('/activar', [AuthController::class, 'activar'])->name('activar.post');
Route::post('/reenviar-codigo', [AuthController::class, 'reenviarCodigo'])->name('reenviar.codigo');

// 3. RUTAS DE LOGIN
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// 4. RUTA DE SALIDA (LOGOUT)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 5. RUTA PROTEGIDA (DASHBOARD)
Route::get('/dashboard', [AuthController::class, 'mostrarDashboard'])->middleware('auth')->name('dashboard');

// 6. RUTAS TEMPORALES (Evitan errores de "Route not defined")
Route::get('/ventas', function () {
    return "Sección de Ventas";
})->name('ventas.index');
Route::get('/productos', function () {
    return "Sección de Inventario";
})->name('productos.index'); // <-- ESTA ES LA QUE FALTABA
Route::get('/reportes', function () {
    return "Sección de Reportes";
})->name('reportes.index');
Route::get('/registrar', [AuthController::class, 'mostrarRegistro'])->name('registro.get');


// ventas 
Route::get('/ventas', [VentaController::class, 'index'])->name('ventas.index');
Route::post('/ventas', [VentaController::class, 'store'])->name('ventas.store');
Route::delete('/ventas/{id}', [VentaController::class, 'destroy'])->name('ventas.destroy');
Route::get('/ventas/filtrar', [VentaController::class, 'filtrar'])->name('ventas.filtrar');
Route::get('/ventas/{id}/detalle', fn($id) => response()->json(
    \App\Models\Venta::with(['detalles.producto'])->findOrFail($id)
))->name('ventas.detalle');



// inventario 


Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
Route::get('/productos/filtrar', [ProductoController::class, 'filtrar'])->name('productos.filtrar');
Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');
Route::put('/productos/{id}', [ProductoController::class, 'update'])->name('productos.update');
Route::patch('/productos/{id}/desactivar', [ProductoController::class, 'desactivar'])->name('productos.desactivar');
Route::patch('/productos/{id}/activar', [ProductoController::class, 'activar'])->name('productos.activar');