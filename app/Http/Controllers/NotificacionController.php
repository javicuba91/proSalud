<?php

namespace App\Http\Controllers;

use App\Models\Notificacion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Mostrar todas las notificaciones
     */
    public function index()
    {
        $user = Auth::user();

        $notificaciones = Notificacion::where('usuario_id', $user->id)
            ->orWhereNull('usuario_id') // Notificaciones globales
            ->where('leida', 0)
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.notificaciones.index', compact('notificaciones'));
    }

    /**
     * Contar notificaciones no leídas (para el badge del navbar)
     */
    public function count()
    {
        $user = Auth::user();

        $count = Notificacion::where(function($query) use ($user) {
                $query->where('usuario_id', $user->id)
                      ->orWhereNull('usuario_id');
            })
            ->where('leida', 0)
            ->count();

        return response()->json(['count' => $count]);
    }

    /**
     * Obtener notificaciones para el dropdown (AJAX)
     */
    public function dropdown()
    {
        $user = Auth::user();

        $notificaciones = Notificacion::where(function($query) use ($user) {
                $query->where('usuario_id', $user->id)
                      ->orWhereNull('usuario_id');
            })
            ->where('leida', 0) // Solo no leídas
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        $html = '';
        foreach ($notificaciones as $notificacion) {
            $iconColor = $notificacion->tipo ?? 'info';
            $icon = $notificacion->icono ?? 'fas fa-info-circle';
            $timeAgo = $notificacion->created_at->diffForHumans();
            $readClass = $notificacion->leida ? '' : 'bg-light';

            $html .= '<a href="' . ($notificacion->url ?? '#') . '" class="dropdown-item ' . $readClass . '" data-id="' . $notificacion->id . '">';
            $html .= '<i class="' . $icon . ' text-' . $iconColor . ' mr-2"></i>';
            $html .= '<span class="text-truncate">' . $notificacion->titulo . '</span>';
            $html .= '<span class="float-right text-muted text-sm">' . $timeAgo . '</span>';
            $html .= '</a>';
            $html .= '<div class="dropdown-divider"></div>';
        }

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
            ->where(function($query) use ($user) {
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

        Notificacion::where(function($query) use ($user) {
                $query->where('usuario_id', $user->id)
                      ->orWhereNull('usuario_id');
            })
            ->noLeidas()
            ->update(['leida' => true]);

        return response()->json(['success' => true]);
    }

    /**
     * Crear nueva notificación (para administradores)
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'mensaje' => 'required|string',
            'tipo' => 'required|string|in:info,success,warning,danger',
            'usuario_id' => 'nullable|exists:users,id',
            'url' => 'nullable|url',
            'rol' => 'nullable|string'
        ]);

        $notificacion = Notificacion::create([
            'usuario_id' => $request->usuario_id,
            'titulo' => $request->titulo,
            'mensaje' => $request->mensaje,
            'tipo' => $request->tipo,
            'url' => $request->url,
            'icono' => $this->getIconoPorTipo($request->tipo),
            'rol' => $request->rol,
            'leida' => false
        ]);

        return response()->json(['success' => true, 'notificacion' => $notificacion]);
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
