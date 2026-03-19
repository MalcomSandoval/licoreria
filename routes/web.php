<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/ventas', fn() => view('dashboard.index'))->name('ventas.index');
Route::get('/productos', fn() => view('dashboard.index'))->name('productos.index');
Route::get('/reportes', fn() => view('dashboard.index'))->name('reportes.index');