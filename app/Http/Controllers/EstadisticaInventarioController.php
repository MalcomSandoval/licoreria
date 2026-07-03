<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class EstadisticaInventarioController extends Controller
{
    public function index()
    {
        return view('estadisticas-inventario.index');
    }

    /**
     * Devuelve únicamente estadísticas de INVENTARIO (productos, stock, proveedores).
     * No incluye ningún dato de ventas.
     */
    public function data(Request $request)
    {
        $productos = Producto::with('proveedor')->get();

        $activos   = $productos->where('activo', 1);
        $inactivos = $productos->where('activo', 0);

        // ----- KPIs -----
        $totalProductos   = $productos->count();
        $totalActivos     = $activos->count();
        $totalInactivos   = $inactivos->count();
        $unidadesTotales  = (int) $activos->sum('stock');

        $valorCompra = (float) $activos->sum(fn ($p) => (float) $p->precio_compra * (int) $p->stock);
        $valorVenta  = (float) $activos->sum(fn ($p) => (float) $p->precio * (int) $p->stock);

        $sinStock = $activos->filter(fn ($p) => (int) $p->stock <= 0)->count();
        $stockBajo = $activos->filter(function ($p) {
            $critico = $p->stock_critico ?? 5;
            return (int) $p->stock > 0 && (int) $p->stock <= (int) $critico;
        })->count();
        $stockNormal = $totalActivos - $sinStock - $stockBajo;

        $totalCategorias = $activos->pluck('categoria')->filter()->unique()->count();
        $totalProveedores = $activos->pluck('proveedor_id')->filter()->unique()->count();

        // ----- Distribución por estado de stock (para doughnut) -----
        $estadoStock = [
            ['estado' => 'Sin stock', 'cantidad' => $sinStock],
            ['estado' => 'Stock crítico', 'cantidad' => $stockBajo],
            ['estado' => 'Stock normal', 'cantidad' => max($stockNormal, 0)],
        ];

        // ----- Activos vs inactivos -----
        $activosInactivos = [
            ['estado' => 'Activos', 'cantidad' => $totalActivos],
            ['estado' => 'Inactivos', 'cantidad' => $totalInactivos],
        ];

        // ----- Por categoría: unidades y valor -----
        $porCategoria = $activos
            ->groupBy(fn ($p) => $p->categoria ?: 'Sin categoría')
            ->map(function ($grupo, $categoria) {
                return [
                    'categoria'  => $categoria,
                    'productos'  => $grupo->count(),
                    'unidades'   => (int) $grupo->sum('stock'),
                    'valor_compra' => (float) $grupo->sum(fn ($p) => (float) $p->precio_compra * (int) $p->stock),
                    'valor_venta'  => (float) $grupo->sum(fn ($p) => (float) $p->precio * (int) $p->stock),
                ];
            })
            ->sortByDesc('valor_venta')
            ->values();

        // ----- Por proveedor: cantidad de productos y unidades -----
        $porProveedor = $activos
            ->groupBy(fn ($p) => $p->proveedor->nombre ?? 'Sin proveedor')
            ->map(function ($grupo, $proveedor) {
                return [
                    'proveedor' => $proveedor,
                    'productos' => $grupo->count(),
                    'unidades'  => (int) $grupo->sum('stock'),
                    'valor_compra' => (float) $grupo->sum(fn ($p) => (float) $p->precio_compra * (int) $p->stock),
                ];
            })
            ->sortByDesc('unidades')
            ->values()
            ->take(10);

        // ----- Top 10 productos con mayor stock -----
        $topStock = $activos
            ->sortByDesc('stock')
            ->take(10)
            ->map(fn ($p) => [
                'nombre'    => $p->nombre,
                'categoria' => $p->categoria ?: 'Sin categoría',
                'stock'     => (int) $p->stock,
            ])
            ->values();

        // ----- Productos en stock crítico o sin stock (listado completo, ordenado ascendente) -----
        $stockCritico = $activos
            ->filter(function ($p) {
                $critico = $p->stock_critico ?? 5;
                return (int) $p->stock <= (int) $critico;
            })
            ->sortBy('stock')
            ->take(15)
            ->map(fn ($p) => [
                'nombre'         => $p->nombre,
                'categoria'      => $p->categoria ?: 'Sin categoría',
                'stock'          => (int) $p->stock,
                'stock_critico'  => (int) ($p->stock_critico ?? 5),
                'proveedor'      => $p->proveedor->nombre ?? 'Sin proveedor',
            ])
            ->values();

        // ----- Top 10 productos con mejor margen (precio venta vs precio compra) -----
        $mejorMargen = $activos
            ->filter(fn ($p) => (float) $p->precio_compra > 0 && (float) $p->precio > 0)
            ->map(function ($p) {
                $margenPct = (((float) $p->precio - (float) $p->precio_compra) / (float) $p->precio_compra) * 100;
                return [
                    'nombre'        => $p->nombre,
                    'precio_compra' => (float) $p->precio_compra,
                    'precio_venta'  => (float) $p->precio,
                    'margen_pct'    => round($margenPct, 1),
                ];
            })
            ->sortByDesc('margen_pct')
            ->take(10)
            ->values();

        return response()->json([
            'kpis' => [
                'total_productos'    => $totalProductos,
                'total_activos'      => $totalActivos,
                'total_inactivos'    => $totalInactivos,
                'unidades_totales'   => $unidadesTotales,
                'valor_compra'       => $valorCompra,
                'valor_venta'        => $valorVenta,
                'sin_stock'          => $sinStock,
                'stock_bajo'         => $stockBajo,
                'total_categorias'   => $totalCategorias,
                'total_proveedores'  => $totalProveedores,
            ],
            'estado_stock'      => $estadoStock,
            'activos_inactivos' => $activosInactivos,
            'por_categoria'     => $porCategoria,
            'por_proveedor'     => $porProveedor,
            'top_stock'         => $topStock,
            'stock_critico'     => $stockCritico,
            'mejor_margen'      => $mejorMargen,
        ]);
    }
}
