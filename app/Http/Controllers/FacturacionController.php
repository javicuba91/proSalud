<?php

namespace App\Http\Controllers;

use App\Models\SuscripcionesPlanesProveedores;
use App\Models\SuscripcionPlan;
use App\Models\Profesional;
use App\Models\Plan;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class FacturacionController extends Controller
{
    public function index(Request $request)
    {
        $query = SuscripcionPlan::with(['profesional', 'plan']);

        // Aplicar filtros
        if ($request->filled('profesional_id')) {
            $query->where('profesional_id', $request->profesional_id);
        }

        if ($request->filled('plan_id')) {
            $query->where('plan_id', $request->plan_id);
        }

        if ($request->filled('fecha_inicio')) {
            $query->whereDate('fecha_inicio', '>=', $request->fecha_inicio);
        }

        if ($request->filled('fecha_fin')) {
            $query->whereDate('fecha_fin', '<=', $request->fecha_fin);
        }

        if ($request->filled('estado_pago')) {
            $query->where('pagado', $request->estado_pago);
        }

        $suscripciones = $query->orderBy('fecha_inicio', 'desc')->get();

        // Obtener datos para los filtros
        $profesionales = Profesional::orderBy('nombre_completo', 'ASC')->get();
        $planes = Plan::orderBy('nombre', 'ASC')->get();
       

        return view('admin.facturacion.index', compact('suscripciones', 'profesionales', 'planes'));
    }

    public function indexProveedor(Request $request)
    {
        $query = SuscripcionesPlanesProveedores::with(['proveedor', 'plan']);

        // Aplicar filtros
        if ($request->filled('proveedor_id')) {
            $query->where('proveedor_id', $request->proveedor_id);
        }

        if ($request->filled('plan_id')) {
            $query->where('plan_id', $request->plan_id);
        }

        if ($request->filled('fecha_inicio')) {
            $query->whereDate('fecha_inicio', '>=', $request->fecha_inicio);
        }

        if ($request->filled('fecha_fin')) {
            $query->whereDate('fecha_fin', '<=', $request->fecha_fin);
        }

        if ($request->filled('estado_pago')) {
            $query->where('pagado', $request->estado_pago);
        }

        $suscripciones = $query->orderBy('fecha_inicio', 'desc')->get();

        // Obtener datos para los filtros
        $proveedores = Proveedor::orderBy('nombre', 'ASC')->get();
        $planes = Plan::orderBy('nombre', 'ASC')->get();
       

        return view('admin.facturacion.proveedor.index', compact('suscripciones', 'proveedores', 'planes'));
    }

    public function show($id)
    {
        $suscripcion = SuscripcionPlan::with(['proveedor', 'plan'])->findOrFail($id);
        return view('admin.facturacion.show', compact('suscripcion'));
    }

    public function showProveedor($id)
    {
        $suscripcion = SuscripcionesPlanesProveedores::with(['proveedor', 'plan'])->findOrFail($id);
        return view('admin.facturacion.proveedor.show', compact('suscripcion'));
    }

    public function pagar($id)
    {
        $suscripcion = SuscripcionPlan::with(['profesional', 'plan'])->findOrFail($id);
        return view('admin.facturacion.pagar', compact('suscripcion'));
    }

    public function pagarProveedor($id)
    {
         $suscripcion = SuscripcionesPlanesProveedores::with(['proveedor', 'plan'])->findOrFail($id);
        return view('admin.facturacion.proveedor.pagar', compact('suscripcion'));
    }

    public function pagarPost(Request $request, $id)
    {
        $suscripcion = SuscripcionPlan::findOrFail($id);
        // Simulación de pago
        $suscripcion->pagado = true;
        $suscripcion->save();
        return redirect()->route('admin.facturacion.index')->with('pago_exitoso', true);
    }

    public function pagarPostProveedor(Request $request, $id)
    {
        $suscripcion = SuscripcionesPlanesProveedores::findOrFail($id);
        // Simulación de pago
        $suscripcion->pagado = true;
        $suscripcion->save();
        return redirect()->route('admin.facturacion.proveedor.index')->with('pago_exitoso', true);
    }
}
