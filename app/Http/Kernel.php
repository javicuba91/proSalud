<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $routeMiddleware = [        
       // 'suscripcion.pagada' => \App\Http\Middleware\SuscripcionPagada::class,
    ];
  
}
