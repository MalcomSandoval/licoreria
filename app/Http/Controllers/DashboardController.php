<?php

namespace App\Http\Controllers;

use App\Models\DetalleVenta;
use App\Models\Producto;
use App\Models\Venta;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $hoy = now()->toDateString();
        $inicioMes = now()->copy()->startOfMonth();
        $hace7Dias = now()->copy()->subDays(6)->startOfDay();
        $ventasActivas = Venta::query()->where('activa', 1);

        $ventasHoy = (clone $ventasActivas)->whereDate('fecha_venta', $hoy)->sum('total');
        $cantidadHoy = (clone $ventasActivas)->whereDate('fecha_venta', $hoy)->count();
        $totalProductos = Producto::count();
        $productosActivos = Producto::where('activo', 1)->count();
        $stockBajo = Producto::where('activo', 1)->where('stock', '<=', 5)->count();
        $ventasMes = (clone $ventasActivas)->where('fecha_venta', '>=', $inicioMes)->sum('total');
        $transaccionesMes = (clone $ventasActivas)->where('fecha_venta', '>=', $inicioMes)->count();

        $ventasRecientes = (clone $ventasActivas)
            ->latest('fecha_venta')
            ->take(5)
            ->get();

        $topProductos = DetalleVenta::select('producto_id', DB::raw('SUM(cantidad) as total_vendido'))
            ->with('producto:id,nombre')
            ->whereHas('venta', fn($query) => $query->where('activa', 1))
            ->groupBy('producto_id')
            ->orderByDesc('total_vendido')
            ->take(5)
            ->get()
            ->map(fn($detalle) => (object) [
                'nombre' => $detalle->producto->nombre ?? 'Desconocido',
                'total_vendido' => $detalle->total_vendido,
            ]);

        $totalVentas = (clone $ventasActivas)->sum('total') ?: 1;
        $metodosPago = (clone $ventasActivas)
            ->select('metodo_pago', DB::raw('SUM(total) as total'))
            ->groupBy('metodo_pago')
            ->get()
            ->map(fn($metodo) => (object) [
                'metodo_pago' => $metodo->metodo_pago,
                'total' => $metodo->total,
                'porcentaje' => ($metodo->total / $totalVentas) * 100,
            ]);

        $productosStockBajo = Producto::where('activo', 1)
            ->where('stock', '<=', 5)
            ->orderBy('stock')
            ->take(5)
            ->get();

        $ventasSemana = (clone $ventasActivas)->where('fecha_venta', '>=', $hace7Dias)->get();
        $totalSemana = $ventasSemana->sum('total');
        $transaccionesSemana = $ventasSemana->count();
        $promedioSemana = $transaccionesSemana > 0 ? $totalSemana / $transaccionesSemana : 0;

        return view('dashboard.index', compact(
            'ventasHoy',
            'cantidadHoy',
            'totalProductos',
            'productosActivos',
            'stockBajo',
            'ventasMes',
            'transaccionesMes',
            'ventasRecientes',
            'topProductos',
            'metodosPago',
            'productosStockBajo',
            'totalSemana',
            'promedioSemana',
            'transaccionesSemana'
        ));
    }
}
