<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    //
    protected $fillable = [
        'informe_consulta_id',
        'qr',
        'fecha_emision',
        'diagnostico',
        'comentarios',
        'ruta_firma',
    ];

    public function medicamentosRecetados()
    {
        return $this->hasMany(MedicamentoReceta::class);
    }

    public function informeConsulta()
    {
        return $this->belongsTo(InformeConsulta::class, 'informe_consulta_id');
    }
}
