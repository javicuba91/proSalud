<?php

namespace App\Http\Controllers;

use App\Models\PresupuestoPrueba;
use App\Models\Prueba;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PresupuestoPruebaController extends Controller
{
    /**
     * Almacena o actualiza un presupuesto para una prueba.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'prueba_id' => 'required|exists:pruebas,id',
            'precio' => 'required|numeric|min:0',
            'proveedor_id' => 'required|exists:proveedores,id',
        ]);

        // Verificar que el proveedor logueado es quien está creando el presupuesto
        $proveedor = Proveedor::where('user_id', Auth::id())->first();

        if ($proveedor->id != $request->proveedor_id) {
            return response()->json([
                'errors' => ['proveedor' => ['No tienes permiso para crear este presupuesto.']]
            ], 403);
        }

        // Buscar si ya existe un presupuesto para esta prueba y proveedor
        $presupuesto = PresupuestoPrueba::where('prueba_id', $request->prueba_id)
            ->where('proveedor_id', $proveedor->id)
            ->first();

        if ($presupuesto) {
            // Si existe, actualizar
            $presupuesto->update([
                'precio' => $request->precio
            ]);

            $message = 'Presupuesto actualizado correctamente.';
        } else {
            // Si no existe, crear nuevo
            PresupuestoPrueba::create([
                'prueba_id' => $request->prueba_id,
                'precio' => $request->precio,
                'proveedor_id' => $proveedor->id
            ]);

            $message = 'Presupuesto creado correctamente.';
        }

        return response()->json([
            'success' => true,
            'message' => $message
        ]);
    }

    /**
     * Muestra los detalles de un presupuesto
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $presupuesto = PresupuestoPrueba::with(['prueba', 'proveedor'])->findOrFail($id);

        // Verificar que el usuario actual tiene permiso para ver este presupuesto
        $proveedor = Proveedor::where('user_id', Auth::id())->first();

        if ($proveedor->id != $presupuesto->proveedor_id) {
            abort(403, 'No tienes permiso para ver este presupuesto.');
        }

        return view('proveedores.presupuesto', compact('presupuesto'));
    }
}
