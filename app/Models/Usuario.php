<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'apellido_materno',
        'apellido_paterno',
        'fecha_nacimiento',
        'ciudad',
        'estado',
        'nacionalidad',
        'correo',
        'contraseña',
    ];

    // Puedes agregar otros métodos o configuraciones aquí si es necesario
}
