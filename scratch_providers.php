<?php
use Illuminate\Support\Str;

$nombres = [
    ['nombre' => 'Ventas Cervecería Polar', 'empresa' => 'Empresas Polar'],
    ['nombre' => 'Distribución Diageo Venezuela', 'empresa' => 'Diageo'],
    ['nombre' => 'Representaciones Pernod Ricard', 'empresa' => 'Pernod Ricard'],
    ['nombre' => 'Surtidora Regional Los Andes', 'empresa' => 'Independiente']
];

// Crear nuevos proveedores
foreach($nombres as $n) {
    if(!App\Models\Proveedor::where('empresa', $n['empresa'])->exists()) {
        App\Models\Proveedor::create([
            'id' => Str::uuid(),
            'nombre' => $n['nombre'],
            'empresa' => $n['empresa'],
            'activo' => 1
        ]);
    }
}

// Enlazar los productos con distintos proveedores y setear un stock crítico parejo
$proveedores = App\Models\Proveedor::all();
$productos = App\Models\Producto::all();

foreach($productos as $index => $prod) {
    $prov = $proveedores[$index % $proveedores->count()];
    $prod->update([
        'proveedor_id' => $prov->id,
        'stock_critico' => rand(10, 20)
    ]);
}

// Poner a varios en estado crítico para la demostración
App\Models\Producto::inRandomOrder()->take(6)->update(['stock' => rand(1, 8)]);

echo "Proveedores y productos asociados y puestos en crítico exitosamente!\n";
