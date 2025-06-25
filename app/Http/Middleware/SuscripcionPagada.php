<?php

namespace App\Http\Middleware;

use App\Models\Profesional;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuscripcionPagada
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if ($user && $user->role=='profesional') {
            $profesional = Profesional::where('user_id', auth()->id())->first();
            $suscripcion = $profesional->suscripcion;
            // Considera pagada si existe y está activa
            if (!$suscripcion || $suscripcion->pagado != 1) {
                // Si la suscripción no está pagada, redirige a Mis Planes con mensaje
                return redirect()->route('profesionales.misPlanes')
                    ->with('error', 'Debes tener tu suscripción activa para acceder a esta funcionalidad.');
            }
        }
        return $next($request);
    }
}
