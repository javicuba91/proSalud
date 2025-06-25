<?php

namespace App\Http\Controllers;

use App\Models\SuscripcionPlan;
use App\Models\Profesional;
use App\Models\Plan;
use Illuminate\Http\Request;

class FacturacionController extends Controller
{
    public function index()
    {
        $suscripciones = SuscripcionPlan::with(['profesional', 'plan'])->get();
        return view('admin.facturacion.index', compact('suscripciones'));
    }

    public function show($id)
    {
        $suscripcion = SuscripcionPlan::with(['profesional', 'plan'])->findOrFail($id);
        return view('admin.facturacion.show', compact('suscripcion'));
    }

    public function pagar($id)
    {
        $suscripcion = SuscripcionPlan::with(['profesional', 'plan'])->findOrFail($id);
        return view('admin.facturacion.pagar', compact('suscripcion'));
    }

    public function pagarPost(Request $request, $id)
    {
        $suscripcion = SuscripcionPlan::findOrFail($id);
        // Simulación de pago
        $suscripcion->pagado = true;
        $suscripcion->save();
        return redirect()->route('admin.facturacion.index')->with('pago_exitoso', true);
    }
}
