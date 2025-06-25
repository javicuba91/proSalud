<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuscripcionPlan extends Model
{
    //
    protected $table = "suscripciones_planes";

    protected $fillable = ['profesional_id','plan_id'];

    protected $casts = [
        'pagado' => 'boolean',
    ];

    public function profesional()
    {
        return $this->belongsTo(Profesional::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
