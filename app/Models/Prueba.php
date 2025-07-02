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
}
