<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    use HasFactory;

    // Specify the table if it's not the plural of the model name
    protected $table = 'direccions';

    // Define which attributes are mass assignable
    protected $fillable = [
        'cp',
        'seccion',
        'colonia',
        'calle',
        'n_exterior',
        'usuario_id',
    ];

    /**
     * Get the usuario that owns the direccion.
     */
    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}
