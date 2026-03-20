<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use Notifiable;

    // Esta línea obliga a Laravel a buscar en 'usuarios' y no en 'users'
    protected $table = 'usuarios';

    // Configuraciones para tu ID tipo UUID (Char 36)
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    // Campos que se pueden llenar masivamente
    protected $fillable = [
        'id', 'nombre', 'correo', 'contrasena', 'rol', 'activo', 'codigo_verificacion'
    ];

    // Ocultar la contraseña en las consultas por seguridad
    protected $hidden = [
        'contrasena',
    ];

    // Generar el UUID automáticamente al crear un usuario
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    /**
     * IMPORTANTE: Laravel busca por defecto la columna 'password'.
     * Con esto le decimos que en tu tabla se llama 'contrasena'.
     */
    public function getAuthPassword()
    {
        return $this->contrasena;
    }
}