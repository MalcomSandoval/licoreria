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
        'stock',
        'categoria',
        'codigo_barras',
        'activo',
        'updated_by'
    ];
}