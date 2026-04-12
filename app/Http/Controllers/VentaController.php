<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Venta;
use App\Models\Producto;
use App\Models\DetalleVenta;


class VentaController extends Controller
{    
    public function index()
    {
        $ventas = Venta::with(['detalles.producto'])
            ->where('activa', 1)
            ->latest('fecha_venta')
            ->get();

        $hoy = now()->toDateString();
        $ventasHoy     = Venta::whereDate('fecha_venta', $hoy)->where('activa', 1)->sum('total');
        $cantidadHoy   = Venta::whereDate('fecha_venta', $hoy)->where('activa', 1)->count();
        $promedioHoy   = $cantidadHoy > 0 ? $ventasHoy / $cantidadHoy : 0;

        $metodoPopular = Venta::whereDate('fecha_venta', $hoy)
            ->where('activa', 1)
            ->select('metodo_pago', DB::raw('count(*) as total'))
            ->groupBy('metodo_pago')
            ->orderByDesc('total')
            ->first()?->metodo_pago ?? '-';

        $productos = Producto::where('activo', 1)->where('stock', '>', 0)->get();

        return view('ventas.index', compact(
            'ventas', 'ventasHoy', 'cantidadHoy', 'promedioHoy', 'metodoPopular', 'productos'
        ));
    }

    public function store(Request $request)
{
    // Si la validación falla aquí, Laravel devuelve 422 JSON automáticamente 
    // SIEMPRE QUE el JS envíe 'Accept: application/json'.
    $request->validate([
        'metodo_pago' => 'required|in:efectivo,tarjeta,transferencia',
        'items'       => 'required|array|min:1',
        'items.*.id'  => 'required|exists:productos,id', // Ojo: tu JS enviaba 'id', no 'producto_id'
        'items.*.cantidad'       => 'required|integer|min:1',
        'items.*.precio_unitario'=> 'required|numeric|min:0',
        'items.*.tipo_venta'     => 'required|in:unidad,caja',
    ]);

    DB::beginTransaction();
    try {
        $venta = Venta::create([
            // Solo usa Str::uuid() si tu migración dice $table->uuid('id')
            'id'            => (string) Str::uuid(), 
            'usuario_id'    => Auth::id() ?? 1, // Fallback por si no hay sesión
            'total'         => 0,
            'precio_compra' => 0,
            'metodo_pago'   => $request->metodo_pago,
            'activa'        => 1,
        ]);

        $totalVenta = 0;
        $totalCosto = 0;

        foreach ($request->items as $item) {
            $producto = Producto::findOrFail($item['id']); // Cambiado de producto_id a id según tu JS

            $unidadesARestar = ($item['tipo_venta'] === 'caja') 
                ? ($item['cantidad'] * ($producto->cantidad_caja ?? 1)) 
                : $item['cantidad'];

            if ($producto->stock < $unidadesARestar) {
                throw new \Exception("Stock insuficiente para {$producto->nombre}.");
            }

            $subtotal = $item['cantidad'] * $item['precio_unitario'];
            $precioCompraItem = (float) ($producto->precio_compra ?? 0);

            $venta->detalles()->create([
                'id'              => (string) Str::uuid(),
                'producto_id'     => $item['id'],
                'cantidad'        => $item['cantidad'],
                'tipo_venta'      => $item['tipo_venta'],
                'precio_unitario' => $item['precio_unitario'],
                'subtotal'        => $subtotal,
                'precio_compra'   => $precioCompraItem,
            ]);

            $producto->decrement('stock', $unidadesARestar);
            
            $totalVenta += $subtotal;
            $totalCosto += ($precioCompraItem * $unidadesARestar);
        }

        $venta->update([
            'total'         => $totalVenta,
            'precio_compra' => $totalCosto,
        ]);

        DB::commit();
        return response()->json([
            'success' => true,
            'venta_id' => $venta->id,
            'total' => $totalVenta,
        ]);

    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json([
            'success' => false, // Agregado para que tu JS lo detecte bien
            'error' => $e->getMessage(),
        ], 500);
    }
}

    public function destroy($id)
    {
        $venta = Venta::with('detalles')->findOrFail($id);

        if (!$venta->activa) {
            return response()->json(['success' => true]);
        }

        DB::transaction(function () use ($venta) {
            foreach ($venta->detalles as $detalle) {
                Producto::where('id', $detalle->producto_id)->increment('stock', $detalle->cantidad);
            }

            $venta->update(['activa' => 0]);
        });

        return response()->json(['success' => true]);
    }

    public function filtrar(Request $request)
    {
        $query = Venta::with(['detalles.producto'])->where('activa', 1);

        if ($request->metodo_pago) {
            $query->where('metodo_pago', $request->metodo_pago);
        }
        if ($request->fecha) {
            $query->whereDate('fecha_venta', $request->fecha);
        }

        $ventas = $query->latest('fecha_venta')->get();
        return response()->json($ventas);
    }
}
