<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prueba extends Model
{
    public function pedidoImagen()
    {
        return $this->belongsTo(PedidoImagen::class);
    }

    public function pedidoLaboratorio()
    {
        return $this->belongsTo(PedidoLaboratorio::class);
    }

    public function presupuestos()
    {
        return $this->hasMany(PresupuestoPrueba::class);
    }

    public function presupuestoProveedor($proveedorId)
    {
        return $this->presupuestos()->where('proveedor_id', $proveedorId)->first();
    }
}
