<?php
use Illuminate\Support\Str;
use App\Models\Producto;
use App\Models\Proveedor;

$proveedores = Proveedor::all();
if($proveedores->isEmpty()){
    echo "Debe existir al menos un proveedor.";
    exit;
}

$nuevosProductos = [
    // Snacks
    ['nombre' => 'Papas Ruffles Tamaño Familiar', 'precio' => 3.5, 'precio_compra' => 2, 'categoria' => 'Snacks'],
    ['nombre' => 'Doritos Mega Queso', 'precio' => 3.8, 'precio_compra' => 2.2, 'categoria' => 'Snacks'],
    ['nombre' => 'Maní La Especial (Lata)', 'precio' => 5, 'precio_compra' => 3, 'categoria' => 'Snacks'],
    ['nombre' => 'Chicarrón Jack\'s', 'precio' => 2.5, 'precio_compra' => 1.2, 'categoria' => 'Snacks'],

    // Congelados
    ['nombre' => 'Hielo en Cubos (Bolsa 5Kg)', 'precio' => 2.5, 'precio_compra' => 1.0, 'categoria' => 'Congelados'],
    ['nombre' => 'Helado Tío Rico (Bote 1L)', 'precio' => 6, 'precio_compra' => 4, 'categoria' => 'Congelados'],
    ['nombre' => 'Pulpa de Fruta Congelada', 'precio' => 1.5, 'precio_compra' => 0.8, 'categoria' => 'Congelados'],

    // Lácteos (o mezclas)
    ['nombre' => 'Leche Completa 1L', 'precio' => 1.8, 'precio_compra' => 1.2, 'categoria' => 'Lácteos'],
    ['nombre' => 'Queso Blanco Rallado 500g', 'precio' => 4, 'precio_compra' => 2.8, 'categoria' => 'Lácteos'],
    ['nombre' => 'Crema de Leche', 'precio' => 2, 'precio_compra' => 1.3, 'categoria' => 'Lácteos'],

    // Dulces
    ['nombre' => 'Chocolate Savoy', 'precio' => 1.2, 'precio_compra' => 0.7, 'categoria' => 'Dulces'],
    ['nombre' => 'Galletas Oreo (Paquete)', 'precio' => 1.5, 'precio_compra' => 0.9, 'categoria' => 'Dulces'],
    ['nombre' => 'Caramelos Mentos', 'precio' => 1.0, 'precio_compra' => 0.5, 'categoria' => 'Dulces'],
    ['nombre' => 'Gomitas Trululu', 'precio' => 1.8, 'precio_compra' => 1.0, 'categoria' => 'Dulces'],

    // Cigarros
    ['nombre' => 'Marlboro Rojo (Cajetilla)', 'precio' => 4.5, 'precio_compra' => 3.0, 'categoria' => 'Cigarros'],
    ['nombre' => 'Belmont (Cajetilla)', 'precio' => 4.0, 'precio_compra' => 2.8, 'categoria' => 'Cigarros'],
    ['nombre' => 'Lucky Strike (Cajetilla)', 'precio' => 4.2, 'precio_compra' => 2.9, 'categoria' => 'Cigarros'],
];

$creados = 0;

foreach($nuevosProductos as $prodData) {
    if(!Producto::where('nombre', $prodData['nombre'])->exists()) {
        $prov = $proveedores->random();
        
        Producto::create([
            'id' => (string) Str::uuid(),
            'nombre' => $prodData['nombre'],
            'precio' => $prodData['precio'],
            'precio_compra' => $prodData['precio_compra'],
            'stock' => rand(15, 60),
            'stock_critico' => rand(10, 20),
            'categoria' => $prodData['categoria'],
            'proveedor_id' => $prov->id,
            'activo' => 1
        ]);
        $creados++;
    }
}

// Ensure there are some low stock items in these categories too
Producto::whereIn('categoria', ['Snacks', 'Congelados', 'Lácteos', 'Dulces', 'Cigarros'])
    ->inRandomOrder()->take(5)->update(['stock' => rand(2, 8)]);

echo "Se agregaron {$creados} productos nuevos abarcando todas las categorias del sistema!\n";
