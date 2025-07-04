<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuscripcionesPlanesProveedores extends Model
{

     protected $fillable = [
        'proveedores_id',
        'plan_id',
        'fecha_inicio',
        'fecha_fin',
        'pagado'
    ];
    protected $casts = [
        'pagado' => 'boolean',
    ];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'proveedores_id');
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
    
}
