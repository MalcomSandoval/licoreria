<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $fillable = [
        'id',
        'nombre',
        'descripcion',
        'precio',
        'precio_compra',
        'precio_caja',        
        'precio_venta_caja',
        'stock',
        'stock_critico',
        'cantidad_caja',
        'categoria',
        'proveedor_id',
        'codigo_barras',
        'activo',
        'updated_by'
    ];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }

    protected $casts = [
        'precio' => 'decimal:2',
        'precio_compra' => 'decimal:2',
        'precio_caja' => 'decimal:2',
        'precio_venta_caja' => 'decimal:2',
        'stock' => 'integer',
        'cantidad_caja' => 'integer',
        'activo' => 'boolean',
    ];
}
