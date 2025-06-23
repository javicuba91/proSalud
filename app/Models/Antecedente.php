<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Antecedente extends Model
{
    protected $table = "antecedentes";

    protected $fillable = [
        'alergias',
        'condiciones_medicas',
        'medicamentos',
        'paciente_id',
    ];    

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
}
