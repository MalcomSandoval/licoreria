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
        $request->validate([
            'metodo_pago' => 'required|in:efectivo,tarjeta,transferencia',
            'items'       => 'required|array|min:1',
            'items.*.producto_id'    => 'required|exists:productos,id',
            'items.*.cantidad'       => 'required|integer|min:1',
            'items.*.precio_unitario'=> 'required|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            $ventaId = Str::uuid();
            $venta = Venta::create([
                'id'            => $ventaId,
                'usuario_id'    => Auth::id(),
                'total'         => 0,
                'precio_compra' => 0,
                'metodo_pago'   => $request->metodo_pago,
                'activa'        => 1,
            ]);

            $totalVenta = 0;
            $totalCosto = 0;

            foreach ($request->items as $item) {
                $producto = Producto::findOrFail($item['producto_id']);

                if ($producto->stock < $item['cantidad']) {
                    DB::rollBack();
                    return response()->json([
                        'error' => "Stock insuficiente para {$producto->nombre}. Disponible: {$producto->stock}"
                    ], 422);
                }

                $subtotal = $item['cantidad'] * $item['precio_unitario'];

                $precioCompraItem = isset($item['precio_compra']) && $item['precio_compra'] > 0
                    ? (float) $item['precio_compra']
                    : (float) ($producto->precio_compra ?? 0);

                DetalleVenta::create([
                    'id'              => Str::uuid(),
                    'venta_id'        => $ventaId,
                    'producto_id'     => $item['producto_id'],
                    'cantidad'        => $item['cantidad'],
                    'precio_unitario' => $item['precio_unitario'],
                    'subtotal'        => $subtotal,
                    'precio_compra'   => $precioCompraItem,
                ]);

                $producto->decrement('stock', $item['cantidad']);
                $totalVenta += $subtotal;
                $totalCosto += $precioCompraItem * $item['cantidad'];
            }

            $venta->update([
                'total'         => $totalVenta,
                'precio_compra' => $totalCosto,
            ]);

            DB::commit();
            return response()->json([
                'success' => true,
                'venta_id' => $ventaId,
                'total' => $totalVenta,
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => 'Error al procesar la venta',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id)
    {
        $venta = Venta::with('detalles.producto')->findOrFail($id);

        if (!$venta->activa) {
            return response()->json([
                'success' => false,
                'error'   => 'Esta venta ya fue anulada anteriormente.',
            ], 409);
        }

        $revertidos = [];

        DB::transaction(function () use ($venta, &$revertidos) {
            foreach ($venta->detalles as $detalle) {
                Producto::where('id', $detalle->producto_id)
                    ->increment('stock', $detalle->cantidad);

                $revertidos[] = [
                    'nombre'   => $detalle->producto->nombre ?? 'Producto eliminado',
                    'cantidad' => $detalle->cantidad,
                ];
            }

            $venta->update(['activa' => 0]);
        });

        return response()->json([
            'success'     => true,
            'total'       => $venta->total,
            'metodo_pago' => $venta->metodo_pago,
            'revertidos'  => $revertidos,
            'mensaje'     => 'Venta anulada correctamente. Stock y registros restaurados.',
        ]);
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
