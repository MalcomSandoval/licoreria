<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'proveedores';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'nombre',
        'empresa',
        'telefono',
        'email',
        'direccion',
        'frecuencia_visita',
        'activo'
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];
}
