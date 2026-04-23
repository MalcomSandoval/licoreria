<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Proveedor;
use Illuminate\Support\Str;

class ProveedorController extends Controller
{
    public function index()
    {
        $proveedores = Proveedor::with(['productos' => function ($query) {
            $query->where('activo', 1);
        }])->where('activo', 1)->latest()->get();
        return view('proveedores.index', compact('proveedores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'empresa' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'direccion' => 'nullable|string',
            'frecuencia_visita' => 'nullable|string|max:255'
        ]);

        Proveedor::create([
            'id' => (string) Str::uuid(),
            'nombre' => $request->nombre,
            'empresa' => $request->empresa,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'direccion' => $request->direccion,
            'frecuencia_visita' => $request->frecuencia_visita,
            'activo' => 1
        ]);

        return redirect()->route('proveedores.index')->with('success', 'Proveedor creado exitosamente.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'empresa' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'direccion' => 'nullable|string',
            'frecuencia_visita' => 'nullable|string|max:255'
        ]);

        $proveedor = Proveedor::findOrFail($id);
        $proveedor->update($request->all());

        return redirect()->route('proveedores.index')->with('success', 'Proveedor actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        $proveedor->update(['activo' => 0]);
        return redirect()->route('proveedores.index')->with('success', 'Proveedor eliminado exitosamente.');
    }
}
