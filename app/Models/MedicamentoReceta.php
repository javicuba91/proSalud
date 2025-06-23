<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicamentoReceta extends Model
{

    protected $table = "medicamentos_recetas";

    protected $fillable = [
        'receta_id',
        'medicamento_id',
        'presentacion_medicamentos_id',
        'dosis',
        'via_administracion_medicamentos_id',
        'intervalo_medicamentos_id',
        'duracion',
    ];   

    public function medicamento()
    {
        return $this->belongsTo(Medicamento::class);
    }
    public function presentacion()
    {
        return $this->belongsTo(PresentacionMedicamento::class);
    }
    public function viaAdministracion()
    {
        return $this->belongsTo(ViaAdministracionMedicamento::class);
    }
    public function intervalo()
    {
        return $this->belongsTo(IntervaloMedicamento::class);
    }
}
