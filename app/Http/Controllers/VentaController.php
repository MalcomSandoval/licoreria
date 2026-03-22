<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
                'id'          => $ventaId,
                'usuario_id'  => null,
                'total'       => 0,
                'metodo_pago' => $request->metodo_pago,
                'activa'      => 1,
            ]);

            foreach ($request->items as $item) {
                $producto = Producto::findOrFail($item['producto_id']);

                if ($producto->stock < $item['cantidad']) {
                    DB::rollBack();
                    return response()->json([
                        'error' => "Stock insuficiente para {$producto->nombre}. Disponible: {$producto->stock}"
                    ], 422);
                }

                DetalleVenta::create([
                    'id'              => Str::uuid(),
                    'venta_id'        => $ventaId,
                    'producto_id'     => $item['producto_id'],
                    'cantidad'        => $item['cantidad'],
                    'precio_unitario' => $item['precio_unitario'],
                    'subtotal'        => $item['cantidad'] * $item['precio_unitario'],
                ]);
            }

            DB::commit();
            return response()->json(['success' => true, 'venta_id' => $ventaId]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Error al procesar la venta'], 500);
        }
    }

    public function destroy($id)
    {
        Venta::where('id', $id)->update(['activa' => 0]);
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