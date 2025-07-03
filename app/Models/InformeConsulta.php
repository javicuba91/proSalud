<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformeConsulta extends Model
{
    protected $table = "informes_consultas";

    protected $fillable = [
        'cita_id',
        'motivo_consulta',
        'antecedentes_familiares',
        'antecedentes_personales',
        'enfermedad_actual',
        'exploracion_fisica',
        'pruebas_complementarias',
        'juicio_clinico',
        'dibujo_dental',
        'plan_terapeutico',
    ];

    public function cita()
    {
        return $this->belongsTo(Cita::class);
    }

    public function receta()
    {
        return $this->belongsTo(Receta::class);
    }

    public function pedidoLaboratorio()
    {
        return $this->hasOne(PedidoLaboratorio::class, 'informe_consulta_id');
    }

    public function pedidoImagen()
    {
        return $this->hasOne(PedidoImagen::class, 'informe_consulta_id');
    }
}
