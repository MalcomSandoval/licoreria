<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// 1. RUTA PRINCIPAL
Route::get('/', [AuthController::class, 'mostrarRegistro']);

// 2. RUTAS DE REGISTRO Y ACTIVACIÓN
Route::get('/registro', [AuthController::class, 'mostrarRegistro'])->name('registro.index');
Route::post('/registrar', [AuthController::class, 'registrar'])->name('registrar.post');
Route::post('/activar', [AuthController::class, 'activar'])->name('activar.post');

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
Route::get('/ventas', function() { return "Sección de Ventas"; })->name('ventas.index');
Route::get('/productos', function() { return "Sección de Inventario"; })->name('productos.index'); // <-- ESTA ES LA QUE FALTABA
Route::get('/reportes', function() { return "Sección de Reportes"; })->name('reportes.index');