<?php

namespace App\Http\Controllers;

use App\Models\CategoriaProfesional;
use App\Models\Ciudad;
use App\Models\Plan;
use App\Models\Profesional;
use App\Models\User;
use Illuminate\Http\Request;

class ProfesionalFrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('frontend.profesionales.index');
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
        return view('frontend.profesionales.beneficios');
    }

    public function funcionalidades()
    {
        //
        return view('frontend.profesionales.funcionalidades');
    }

    public function planes()
    {
        $planes = Plan::all();
        return view('frontend.profesionales.planes', compact('planes'));
    }

    public function login()
    {
        return view('frontend.profesionales.login');
    }
    public function registro()
    {
        $categorias=CategoriaProfesional::all();
        $ciudades = Ciudad::orderBy('nombre')->get();
        return view('frontend.profesionales.registro', compact('categorias','ciudades'));
    }

    public function registroProfesional(Request $request)
    {
        $usuario = new User();
        $usuario->name = $request->nombre." ".$request->apellidos;
        $usuario->email = $request->email;
        $usuario->role = "profesional";
        $usuario->password = bcrypt($request->cedula);
        $usuario->save();

        $profesional = new Profesional();
        $profesional->user_id = $usuario->id;
        $profesional->nombre_completo = $request->nombre." ".$request->apellidos;
        $profesional->telefono_personal = $request->telefono;
        $profesional->email = $request->email;
        $profesional->cedula_identidad = $request->cedula;
        $profesional->categoria_id = $request->categoria_id;
        $profesional->save();

        return redirect()->route('profesionales.registro')->with('success','Gracias por registrate. Accede a tu panel');
    }

    public function contacto()
    {
        return view('frontend.profesionales.contacto');
    }

    public function detalleProfesional($id)
    {

        $profesional = Profesional::find($id);
        return view('frontend.pacientes.fichas.detalleProfesional',compact('profesional'));
    }

}
