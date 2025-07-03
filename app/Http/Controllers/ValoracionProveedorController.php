<?php

namespace App\Http\Controllers;

use App\Models\ValoracionProveedor;
use App\Models\Paciente;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class ValoracionProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = ValoracionProveedor::with(['paciente', 'proveedor']);

        // Aplicar filtros
        if ($request->filled('paciente_id')) {
            $query->where('paciente_id', $request->paciente_id);
        }

        if ($request->filled('proveedor_id')) {
            $query->where('proveedor_id', $request->proveedor_id);
        }

        if ($request->filled('modalidad')) {
            $query->where('modalidad', $request->modalidad);
        }

        if ($request->filled('puntuacion')) {
            $query->where('puntuacion', $request->puntuacion);
        }

        $valoraciones = $query->orderBy('fecha', 'desc')->get();

        // Obtener datos para los filtros
        $pacientes = Paciente::orderBy('nombre_completo', 'ASC')->get();
        $proveedores = Proveedor::orderBy('nombre', 'ASC')->get();

        return view('admin.valoraciones_proveedores.index', compact('valoraciones', 'pacientes', 'proveedores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ValoracionProveedor $valoracionProveedor)
    {
        return view('admin.valoraciones_proveedores.show', compact('valoracionProveedor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ValoracionProveedor $valoracionProveedor)
    {
        $valoracionProveedor->delete();
        return redirect()->route('valoraciones_proveedores.index')->with('eliminado', 'ok');
    }
}
