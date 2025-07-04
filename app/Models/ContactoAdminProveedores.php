<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactoAdminProveedores extends Model
{
    protected $table = "contactos_proveedores_admin";

    protected $fillable = [
        'proveedor_id', 'motivo', 'descripcion', 'estado', 'respuesta', 'fecha_respuesta'
    ];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }
}
