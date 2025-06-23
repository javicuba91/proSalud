<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HorarioProfesional extends Model
{
    protected $table = "horarios";

    protected $fillable = [
        'profesional_id',
        'dia_semana', 
        'fecha',     
    ];
    
    public function detalles()
    {
        return $this->hasMany(DetalleHorario::class, 'horario_id');
    }
    

}