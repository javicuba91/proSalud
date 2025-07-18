<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PedidoImagen extends Model
{
    protected $table = "pedido_imagenes";

    protected $fillable = [
        'qr',
        'fecha_hora',
        'motivo',
        'sintoma',
        'antecedentes',
        'informe_consulta_id'
    ];

     public function informeConsulta()
    {
        return $this->belongsTo(InformeConsulta::class,'informe_consulta_id');
    }

         public function pruebas()
    {
        return $this->hasMany(Prueba::class);
    }
}
