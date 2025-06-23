<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Proveedor;
use App\Models\User;
use Illuminate\Http\Request;

class ProveedorFrontendController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('frontend.proveedores.index');
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
    public function show(string $id)
    {
        //
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
    public function destroy(string $id)
    {
        //
    }

    public function beneficios()
    {
        //
        return view('frontend.proveedores.beneficios');
    }

    public function funcionalidades()
    {
        //
        return view('frontend.proveedores.funcionalidades');
    }

    public function planes()
    {
        $planes = Plan::all();
        return view('frontend.proveedores.planes', compact('planes'));
    }

    public function login()
    {
        return view('frontend.proveedores.login');
    }
    public function registro()
    {
        return view('frontend.proveedores.registro');
    }

    public function contacto()
    {
        return view('frontend.proveedores.contacto');
    }

    public function registroProveedor(Request $request)
    {
        $usuario = new User();
        $usuario->name = $request->nombre;
        $usuario->email = $request->email;
        $usuario->role = "proveedor";
        $usuario->password = bcrypt($request->numero_identificacion);
        $usuario->save();
        
        $profesional = new Proveedor();
        $profesional->user_id = $usuario->id;
        $profesional->tipo = $request->tipo;
        $profesional->nombre = $request->nombre;
        $profesional->ciudad = $request->ciudad;
        $profesional->direccion = $request->direccion;
        $profesional->numero_identificacion = $request->numero_identificacion;
        $profesional->email = $request->email;
        $profesional->telefono = $request->telefono;
        $profesional->save();

        return redirect()->route('proveedores.registro')->with('success','Gracias por registrate. Accede a tu panel');
    }
}
