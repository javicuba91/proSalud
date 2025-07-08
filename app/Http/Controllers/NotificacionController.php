<?php

namespace App\Http\Controllers;

use App\Models\Notificacion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificacionController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role == "admin") {

            $notificaciones = Notificacion::where('usuario_id_destino', '=', NULL)
                ->orderBy('created_at', 'desc')
                ->paginate(20);
        } else {

            $notificaciones = Notificacion::where('usuario_id_destino', $user->id)
                ->where('usuario_id', '!=', NULL) // Notificaciones globales
                ->where('leida', 0) // Solo no leídas
                ->orderBy('created_at', 'desc')
                ->paginate(20);
        }

        return view('admin.notificaciones.index', compact('notificaciones'));
    }

    /**
     * Contar notificaciones no leídas (para el badge del navbar)
     */
    public function count()
    {
        $user = Auth::user();

        if ($user->role == "admin") {

            $count = Notificacion::where(function ($query) use ($user) {
                $query->where('usuario_id_destino', '=', NULL);
            })->where('leida', 0) // Solo no leídas
                ->count();
        } else {
            $count = Notificacion::where(function ($query) use ($user) {
                $query->where('usuario_id_destino', $user->id);
            })
                ->where('leida', 0) // Solo no leídas
                ->count();
        }

        return response()->json(['count' => $count]);
    }

    /**
     * Obtener notificaciones para el dropdown (AJAX)
     */
    public function dropdown()
    {
        $user = Auth::user();

        $notificaciones = Notificacion::where('usuario_id_destino', '=', NULL)
                ->where('leida', 0) // Solo no leídas
                ->orderBy('created_at', 'desc')
                ->get();

        $html = '';
        $html .= '<span class="dropdown-item dropdown-header">'.$notificaciones->count().' Notificationes</span>';
        $html .= '<a href="/admin/documentos-profesional?profesional_id=&estado=pendiente" class="dropdown-item">
                        <i class="fas fa-file mr-2"></i> Doc. Pendientes Profesional
                    </a><div class="dropdown-divider"></div>';
        $html .= '<a href="/admin/documentos-proveedor?proveedor_id=&estado=pendiente" class="dropdown-item">
                        <i class="fas fa-file mr-2"></i> Doc. Pendientes Proveedor
                    </a><div class="dropdown-divider"></div>';
        $html .= '<a href="/admin/contacto/profesional?profesional_id=&estado=pendiente" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i>Contactos Profesional
                    </a><div class="dropdown-divider"></div>';
        $html .= '<a href="/admin/contacto/proveedores?proveedor_id=&estado=pendiente" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i>Contactos Proveedor
                    </a><div class="dropdown-divider"></div>';
        $html .= '<a href="#" class="dropdown-item">
                        <i class="fas fa-star mr-2"></i>Valoraciones Profesional
                    </a><div class="dropdown-divider"></div>';
        $html .= '<a href="#" class="dropdown-item">
                        <i class="fas fa-star mr-2"></i>Valoraciones Proveedor
                    </a><div class="dropdown-divider"></div>';

        if ($notificaciones->isEmpty()) {
            $html = '<div class="dropdown-item text-center text-muted">No hay notificaciones</div>';
        }

        return response()->json(['html' => $html]);
    }

    /**
     * Marcar notificación como leída
     */
    public function marcarLeida($id)
    {
        $user = Auth::user();

        $notificacion = Notificacion::where('id', $id)
            ->where(function ($query) use ($user) {
                $query->where('usuario_id', $user->id)
                    ->orWhereNull('usuario_id');
            })
            ->first();

        if ($notificacion) {
            $notificacion->marcarComoLeida();
        }

        return response()->json(['success' => true]);
    }

    /**
     * Marcar todas las notificaciones como leídas
     */
    public function marcarTodasLeidas()
    {
        $user = Auth::user();

        if ($user->role == "admin") {

            Notificacion::where(function ($query) use ($user) {
                $query->where('usuario_id_destino', '=', NULL);
            })->where('leida', 0) // Solo no leídas
                ->update(['leida' => 1]);
        } else {
            Notificacion::where(function ($query) use ($user) {
                $query->where('usuario_id_destino', $user->id);
            })
                ->where('leida', 0) // Solo no leídas
                ->update(['leida' => 1]);
        }

        return response()->json(['success' => true]);
    }


    private function getIconoPorTipo($tipo)
    {
        $iconos = [
            'info' => 'fas fa-info-circle',
            'success' => 'fas fa-check-circle',
            'warning' => 'fas fa-exclamation-triangle',
            'danger' => 'fas fa-exclamation-circle'
        ];

        return $iconos[$tipo] ?? 'fas fa-bell';
    }
}
