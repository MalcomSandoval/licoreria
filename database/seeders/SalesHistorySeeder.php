<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Venta;
use App\Models\DetalleVenta;
use App\Models\Producto;
use App\Models\Usuario;
use Illuminate\Support\Facades\DB;

class SalesHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usuario = Usuario::first();
        if (!$usuario) {
            $this->command->error('No hay usuarios en el sistema. Crea un usuario primero antes de ejecutar este seeder.');
            return;
        }

        // 1. Crear varios productos realistas de una licorería
        $productosData = [
            ['nombre' => 'Cerveza Polar Pilsen (Caja)', 'precio' => 20, 'precio_compra' => 12, 'stock' => 500],
            ['nombre' => 'Ron Cacique (Botella 1L)', 'precio' => 10, 'precio_compra' => 6, 'stock' => 200],
            ['nombre' => 'Ron Santa Teresa 1796', 'precio' => 35, 'precio_compra' => 22, 'stock' => 50],
            ['nombre' => 'Whisky Old Parr 12 años', 'precio' => 45, 'precio_compra' => 30, 'stock' => 100],
            ['nombre' => 'Whisky Buchanan\'s 12 años', 'precio' => 42, 'precio_compra' => 28, 'stock' => 80],
            ['nombre' => 'Vino Tinto Casillero del Diablo', 'precio' => 15, 'precio_compra' => 9, 'stock' => 120],
            ['nombre' => 'Vodka Gordon\'s', 'precio' => 8, 'precio_compra' => 5, 'stock' => 300],
            ['nombre' => 'Ginebra Tanqueray', 'precio' => 30, 'precio_compra' => 18, 'stock' => 60],
            ['nombre' => 'Cerveza Zulia (Caja)', 'precio' => 22, 'precio_compra' => 14, 'stock' => 400],
            ['nombre' => 'Sangría Caroreña (Caja)', 'precio' => 38, 'precio_compra' => 25, 'stock' => 150],
            ['nombre' => 'Anís Cartujo', 'precio' => 7, 'precio_compra' => 4, 'stock' => 250],
        ];

        $productosCreados = [];
        foreach ($productosData as $data) {
            // Check if it already exists to not duplicate on multiple runs
            $prod = Producto::where('nombre', $data['nombre'])->first();
            if (!$prod) {
                $prod = Producto::create([
                    'id' => (string) Str::uuid(),
                    'nombre' => $data['nombre'],
                    'precio' => $data['precio'],
                    'precio_compra' => $data['precio_compra'],
                    'stock' => $data['stock'],
                    'activo' => true
                ]);
            }
            $productosCreados[] = $prod;
        }
        $this->command->info('Se verificaron/crearon ' . count($productosCreados) . ' productos realistas.');


        // 2. Crear las ventas con estos productos diferentes
        $metodos = ['Efectivo', 'Tarjeta', 'Transferencia', 'Pago Móvil'];
        $numVentas = 120; // Aumentamos las ventas para más diversidad

        DB::beginTransaction();

        try {
            for ($i = 0; $i < $numVentas; $i++) {
                // Fechas aleatorias en los últimos 90 días
                $diasAtras = rand(0, 90);
                $horasAtras = rand(0, 23);
                $minutosAtras = rand(0, 59);
                
                $fecha = Carbon::now()
                    ->subDays($diasAtras)
                    ->subHours($horasAtras)
                    ->subMinutes($minutosAtras);
                
                $ventaId = (string) Str::uuid();
                
                // Determinar cuántos productos de diferentes tipos llevará esta venta (de 1 a 4 tipos de productos)
                $numTiposProductos = rand(1, 4);
                shuffle($productosCreados); // Mezclar para tomar productos disferentes

                $ventaTotal = 0;
                $ventaTotalCompra = 0;
                $detallesVenta = [];

                for ($j = 0; $j < $numTiposProductos; $j++) {
                    $productoSeleccionado = $productosCreados[$j];
                    $cantidad = rand(1, 3); // De 1 a 3 cajas o botellas
                    
                    $subtotal = $cantidad * $productoSeleccionado->precio;
                    $subtotalCompra = $cantidad * $productoSeleccionado->precio_compra;
                    
                    $ventaTotal += $subtotal;
                    $ventaTotalCompra += $subtotalCompra;

                    $detallesVenta[] = [
                        'id' => (string) Str::uuid(),
                        'venta_id' => $ventaId,
                        'producto_id' => $productoSeleccionado->id,
                        'cantidad' => $cantidad,
                        'tipo_venta' => 'unidad',
                        'precio_unitario' => $productoSeleccionado->precio,
                        'subtotal' => $subtotal,
                        'precio_compra' => $productoSeleccionado->precio_compra,
                    ];
                }

                Venta::insert([
                    'id' => $ventaId,
                    'usuario_id' => $usuario->id,
                    'total' => $ventaTotal,
                    'precio_compra' => $ventaTotalCompra,
                    'fecha_venta' => $fecha,
                    'metodo_pago' => $metodos[array_rand($metodos)],
                    'activa' => true,
                ]);

                foreach ($detallesVenta as $detalle) {
                    DetalleVenta::insert($detalle);
                }
            }

            DB::commit();
            $this->command->info("Se han creado $numVentas ventas en el historial, empalmadas con " . count($productosCreados) . " productos variados.");

        } catch (\Exception $e) {
            DB::rollBack();
            $this->command->error("Error al crear ventas: " . $e->getMessage());
        }
    }
}
