<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactosEmergencia extends Model
{
    //

    protected $table = "contactos_emergencia";

    protected $fillable = [
        'nombre',
        'relacion',
        'telefono',
        'paciente_id',
    ];
    
}
