<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    protected $table = "ciudades";

    protected $fillable = [
        'nombre',
        'provincia_id'
    ];

    public function provincia()
    {
        return $this->belongsTo(Provincia::class);
    }

    public function region()
    {
        return $this->hasOneThrough(Region::class, Provincia::class, 'id', 'id', 'provincia_id', 'region_id');
    }
}
