<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class usuario extends Model
{

    protected $table = 'usuarios';

    protected $primaryKey = 'id_usuario';
    public $timestamps = false;

    protected $fillable = [
        'usuario',
        'nombre',
        'apellido',
        'cedula',
        'contraseña',
        'correo',
        'estado',
        'ip',
        'fecha_creacion',
        'fecha_actualizacion'
    ];
}
