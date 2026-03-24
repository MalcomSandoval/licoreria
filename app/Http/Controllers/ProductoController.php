<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Producto;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        $totalProductos = $productos->count();
        $totalActivos = $productos->where('activo', 1)->count();
        $totalInactivos = $productos->where('activo', 0)->count();
        $valorInventario = $productos->where('activo', 1)->sum(fn($p) => $p->precio * $p->stock);
        $stockBajo = $productos->where('activo', 1)->where('stock', '<=', 5)->count();
        $totalCategorias = $productos->where('activo', 1)->pluck('categoria')->unique()->count();

        return view('productos.index', compact(
            'productos',
            'totalProductos',
            'totalActivos',
            'totalInactivos',
            'valorInventario',
            'stockBajo',
            'totalCategorias'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0.01',
            'stock' => 'required|integer|min:0',
            'categoria' => 'required|string',
        ]);

        Producto::create([
            'id' => Str::uuid(),
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'stock' => $request->stock,
            'categoria' => $request->categoria,
            'codigo_barras' => $request->codigo_barras,
            'activo' => 1,
        ]);

        return response()->json(['success' => true]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0.01',
            'categoria' => 'required|string',
        ]);

        $producto = Producto::findOrFail($id);
        $nuevoStock = $producto->stock + ($request->suma_stock ?? 0);

        $producto->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'stock' => $nuevoStock,
            'categoria' => $request->categoria,
            'codigo_barras' => $request->codigo_barras,
        ]);

        return response()->json(['success' => true]);
    }

    public function desactivar($id)
    {
        Producto::where('id', $id)->update(['activo' => 0]);
        return response()->json(['success' => true]);
    }

    public function activar($id)
    {
        Producto::where('id', $id)->update(['activo' => 1]);
        return response()->json(['success' => true]);
    }

    public function filtrar(Request $request)
    {
        $query = Producto::query();

        if ($request->buscar) {
            $query->where(function ($q) use ($request) {
                $q->where('nombre', 'like', "%{$request->buscar}%")
                    ->orWhere('codigo_barras', 'like', "%{$request->buscar}%");
            });
        }
        if ($request->categoria) {
            $query->where('categoria', $request->categoria);
        }
        if ($request->stock === 'bajo') {
            $query->where('stock', '<=', 5)->where('stock', '>', 0);
        } elseif ($request->stock === 'disponible') {
            $query->where('stock', '>', 0);
        } elseif ($request->stock === 'agotado') {
            $query->where('stock', 0);
        }

        if ($request->estado === 'activo') {
            $query->where('activo', 1);
        } elseif ($request->estado === 'inactivo') {
            $query->where('activo', 0);
        }

        return response()->json($query->get());
    }
}