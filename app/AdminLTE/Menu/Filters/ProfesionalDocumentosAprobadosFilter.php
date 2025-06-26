<?php

namespace App\AdminLTE\Menu\Filters;

use App\Models\Profesional;
use Illuminate\Support\Facades\Auth;

class ProfesionalDocumentosAprobadosFilter
{
    public function transform($item)
    {
        // Solo aplica a profesionales autenticados
        if (isset($item['can']) && $item['can'] === 'solo-profesional') {
            $user = Auth::user();
            if ($user && $user->role == 'profesional') {
                 $profesional = Profesional::where('user_id', auth()->id())->first();
                // Opciones siempre permitidas
                $permitidas = [
                    '/profesional/mis-estadisticas',
                    '/profesional/mis-datos',
                    '/profesional/mis-planes',
                    '/profesional/contactar-administrador',
                ];
                // Si NO tiene documentos aprobados, solo mostrar las permitidas
                if (!$profesional->documentosAprobados()) {
                    if (!in_array($item['url'], $permitidas)) {
                        return false;
                    }
                }
            }
        }
        return $item;
    }
}
