<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuscripcionPlan extends Model
{
    //
    protected $table = "suscripciones_planes";

    protected $fillable = ['profesional_id','plan_id'];
    
}
