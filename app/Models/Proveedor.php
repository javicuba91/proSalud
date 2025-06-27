<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = "proveedores";

    protected $fillable = [
        'user_id', 'tipo', 'nombre', 'ciudad', 'direccion',
        'numero_identificacion', 'email', 'telefono'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
