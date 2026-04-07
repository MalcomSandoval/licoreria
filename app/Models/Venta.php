<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = 'ventas';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    const CREATED_AT = 'fecha_venta';
    const UPDATED_AT = null;

    protected $fillable = [
        'id',
        'usuario_id',
        'total',
        'precio_compra',
        'fecha_venta',
        'metodo_pago',
        'activa'
    ];

    protected $casts = [
        'total'         => 'decimal:2',
        'precio_compra' => 'decimal:2',
        'fecha_venta'   => 'datetime',
        'activa'        => 'boolean',
    ];

    public function detalles()
    {
        return $this->hasMany(DetalleVenta::class, 'venta_id');
    }
}