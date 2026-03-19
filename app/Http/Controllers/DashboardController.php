<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Venta;
use App\Models\DetalleVenta;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $hoy = now()->toDateString();
        $inicioMes = now()->startOfMonth();
        $hace7Dias = now()->subDays(7);

        // Métricas principales
        $ventasHoy = Venta::whereDate('fecha_venta', $hoy)->sum('total');
        $cantidadHoy = Venta::whereDate('fecha_venta', $hoy)->count();
        $totalProductos = Producto::count();
        $productosActivos = Producto::where('activo', 1)->count();
        $stockBajo = Producto::where('stock', '<=', 5)->where('activo', 1)->count();
        $ventasMes = Venta::where('fecha_venta', '>=', $inicioMes)->sum('total');
        $transaccionesMes = Venta::where('fecha_venta', '>=', $inicioMes)->count();

        // Ventas recientes
        $ventasRecientes = Venta::latest('fecha_venta')->take(5)->get();

        // Top productos
        $topProductos = DetalleVenta::select('producto_id', DB::raw('SUM(cantidad) as total_vendido'))
            ->with('producto:id,nombre')
            ->groupBy('producto_id')
            ->orderByDesc('total_vendido')
            ->take(5)
            ->get()
            ->map(fn($d) => (object) [
                'nombre' => $d->producto->nombre ?? 'Desconocido',
                'total_vendido' => $d->total_vendido,
            ]);

        // Métodos de pago
        $totalVentas = Venta::sum('total') ?: 1;
        $metodosPago = Venta::select('metodo_pago', DB::raw('SUM(total) as total'))
            ->groupBy('metodo_pago')
            ->get()
            ->map(fn($m) => (object) [
                'metodo_pago' => $m->metodo_pago,
                'total' => $m->total,
                'porcentaje' => ($m->total / $totalVentas) * 100,
            ]);

        // Productos con stock bajo
        $productosStockBajo = Producto::where('stock', '<=', 5)
            ->where('activo', 1)
            ->take(5)
            ->get();

        // Resumen semanal
        $ventasSemana = Venta::where('fecha_venta', '>=', $hace7Dias)->get();
        $totalSemana = $ventasSemana->sum('total');
        $promedioSemana = $totalSemana / 7;
        $transaccionesSemana = $ventasSemana->count();

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