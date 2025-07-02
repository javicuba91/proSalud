<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PresupuestoPrueba extends Model
{
    //
    protected $table = "presupuestos_pruebas";

    protected $fillable = [
        'prueba_id',
        'precio',
        'proveedor_id',
        'estado'
    ];

    public function prueba()
    {
        return $this->belongsTo(Prueba::class);
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }
}
