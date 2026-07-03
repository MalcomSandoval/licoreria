<?php

namespace App\Http\Controllers;

use App\Models\DetalleVenta;
use App\Models\Venta;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstadisticaVentaController extends Controller
{
    public function index()
    {
        return view('estadisticas.index');
    }

    /**
     * Devuelve únicamente estadísticas de VENTAS (sin datos de inventario/proveedores).
     */
    public function data(Request $request)
    {
        $periodo = (int) ($request->periodo ?? 30);
        $desde = Carbon::now()->subDays($periodo - 1)->startOfDay();
        $hasta = Carbon::now()->endOfDay();

        $ventasQuery = Venta::where('activa', 1)
            ->whereBetween('fecha_venta', [$desde, $hasta]);

        // ----- KPIs -----
        $totalIngresos    = (clone $ventasQuery)->sum('total');
        $totalTransacciones = (clone $ventasQuery)->count();
        $ticketPromedio   = $totalTransacciones > 0 ? $totalIngresos / $totalTransacciones : 0;

        $totalUnidades = DetalleVenta::whereHas('venta', function ($q) use ($desde, $hasta) {
                $q->where('activa', 1)->whereBetween('fecha_venta', [$desde, $hasta]);
            })->sum('cantidad');

        // Comparativo contra el periodo anterior equivalente
        $desdeAnterior = (clone $desde)->subDays($periodo);
        $hastaAnterior = (clone $desde)->subSecond();
        $ingresosAnterior = Venta::where('activa', 1)
            ->whereBetween('fecha_venta', [$desdeAnterior, $hastaAnterior])
            ->sum('total');
        $variacionIngresos = $ingresosAnterior > 0
            ? (($totalIngresos - $ingresosAnterior) / $ingresosAnterior) * 100
            : null;

        // ----- Serie temporal: ventas por día -----
        $porDia = (clone $ventasQuery)
            ->select(DB::raw('DATE(fecha_venta) as fecha'), DB::raw('SUM(total) as total'), DB::raw('COUNT(*) as transacciones'))
            ->groupBy(DB::raw('DATE(fecha_venta)'))
            ->orderBy('fecha')
            ->get();

        // ----- Ventas por método de pago -----
        $porMetodoPago = (clone $ventasQuery)
            ->select('metodo_pago', DB::raw('SUM(total) as total'), DB::raw('COUNT(*) as transacciones'))
            ->groupBy('metodo_pago')
            ->orderByDesc('total')
            ->get();

        // ----- Ventas por día de la semana -----
        $porDiaSemana = (clone $ventasQuery)
            ->select(DB::raw('DAYOFWEEK(fecha_venta) as dia'), DB::raw('SUM(total) as total'), DB::raw('COUNT(*) as transacciones'))
            ->groupBy(DB::raw('DAYOFWEEK(fecha_venta)'))
            ->orderBy('dia')
            ->get();

        // ----- Ventas por hora del día -----
        $porHora = (clone $ventasQuery)
            ->select(DB::raw('HOUR(fecha_venta) as hora'), DB::raw('SUM(total) as total'), DB::raw('COUNT(*) as transacciones'))
            ->groupBy(DB::raw('HOUR(fecha_venta)'))
            ->orderBy('hora')
            ->get();

        // ----- Top productos más vendidos (por cantidad) -----
        $topProductos = DetalleVenta::select('producto_id')
            ->selectRaw('SUM(cantidad) as unidades')
            ->selectRaw('SUM(subtotal) as ingresos')
            ->with('producto:id,nombre,categoria')
            ->whereHas('venta', function ($q) use ($desde, $hasta) {
                $q->where('activa', 1)->whereBetween('fecha_venta', [$desde, $hasta]);
            })
            ->groupBy('producto_id')
            ->orderByDesc('unidades')
            ->take(8)
            ->get()
            ->map(fn ($d) => [
                'nombre'   => $d->producto->nombre ?? 'Producto eliminado',
                'unidades' => (int) $d->unidades,
                'ingresos' => (float) $d->ingresos,
            ]);

        // ----- Ventas por categoría de producto -----
        $porCategoria = DetalleVenta::select(DB::raw('COALESCE(productos.categoria, "Sin categoría") as categoria'))
            ->selectRaw('SUM(detalles_venta.subtotal) as ingresos')
            ->selectRaw('SUM(detalles_venta.cantidad) as unidades')
            ->join('productos', 'productos.id', '=', 'detalles_venta.producto_id')
            ->whereHas('venta', function ($q) use ($desde, $hasta) {
                $q->where('activa', 1)->whereBetween('fecha_venta', [$desde, $hasta]);
            })
            ->groupBy('categoria')
            ->orderByDesc('ingresos')
            ->get();

        // ----- Vendedores (usuarios) con más ventas -----
        $porVendedor = (clone $ventasQuery)
            ->select('usuario_id', DB::raw('SUM(total) as total'), DB::raw('COUNT(*) as transacciones'))
            ->with('usuario:id,nombre')
            ->groupBy('usuario_id')
            ->orderByDesc('total')
            ->get()
            ->map(fn ($v) => [
                'nombre'        => $v->usuario->nombre ?? 'Usuario eliminado',
                'total'         => (float) $v->total,
                'transacciones' => (int) $v->transacciones,
            ]);

        // ----- Últimas ventas -----
        $ultimasVentas = (clone $ventasQuery)
            ->with('detalles')
            ->latest('fecha_venta')
            ->take(8)
            ->get()
            ->map(fn ($v) => [
                'id'           => $v->id,
                'fecha_venta'  => $v->fecha_venta,
                'total'        => (float) $v->total,
                'metodo_pago'  => $v->metodo_pago,
                'items'        => $v->detalles->sum('cantidad'),
            ]);

        return response()->json([
            'periodo' => $periodo,
            'kpis' => [
                'total_ingresos'      => (float) $totalIngresos,
                'total_transacciones' => $totalTransacciones,
                'ticket_promedio'     => (float) $ticketPromedio,
                'total_unidades'      => (int) $totalUnidades,
                'variacion_ingresos'  => $variacionIngresos,
            ],
            'serie_diaria'    => $porDia,
            'metodos_pago'    => $porMetodoPago,
            'dia_semana'      => $porDiaSemana,
            'hora_dia'        => $porHora,
            'top_productos'   => $topProductos,
            'categorias'      => $porCategoria,
            'vendedores'      => $porVendedor,
            'ultimas_ventas'  => $ultimasVentas,
        ]);
    }
}
