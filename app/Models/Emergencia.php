<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Emergencia extends Model
{
    //
    protected $table = "emergencias";

    public function provincia()
    {
        return $this->belongsTo(Provincia::class);
    }
    public function ciudad()
    {
        return $this->belongsTo(Ciudad::class);
    }
}
