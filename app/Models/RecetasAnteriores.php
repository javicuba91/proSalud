<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecetasAnteriores extends Model
{
    //
    protected $fillable = [
        'ruta_archivo',
        'receta_id',
    ];

    public function receta()
    {
        return $this->belongsTo(Receta::class);
    }
}
