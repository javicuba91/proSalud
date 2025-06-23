<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    //

    public function medicamentosRecetados()
    {
        return $this->hasMany(MedicamentoReceta::class);
    }

    public function informeConsulta()
    {
        return $this->belongsTo(InformeConsulta::class, 'informe_consulta_id');
    }
}
