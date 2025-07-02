<?php

namespace App\Http\Controllers;

use App\Models\DocumentosProveedor;
use App\Models\Propietario;
use App\Models\Proveedor;
use App\Models\SegurosMedicos;
use App\Models\Prueba;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('proveedores.index');
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

    public function misEstadisticas()
    {
        return view('proveedores.misEstadisticas');
    }

    public function contactarAdministrador()
    {
        return view('proveedores.contactarAdministrador');
    }

    public function notificaciones()
    {
        return view('proveedores.notificaciones');
    }

    public function misPlanes()
    {
        return view('proveedores.misPlanes');
    }

    public function valoracionesComentarios()
    {
        return view('proveedores.valoracionesComentarios');
    }

    public function compartirResultados()
    {
        return view('proveedores.compartirResultados');
    }

    public function misDatos()
    {
        $userId = Auth::id();
        $proveedor = Proveedor::with(['propietario', 'segurosMedicos'])->where('user_id', $userId)->first();
        $seguros = SegurosMedicos::all();
        return view('proveedores.misDatos', compact('seguros', 'proveedor'));
    }
    public function GuardarMisDatos(Request $request)
    {

        // Validar los datos
        $request->validate([
            'fecha_nacimiento' => 'nullable|date',
            'genero' => 'nullable|in:Hombre,Mujer,Otro',
            'telefono_personal' => 'nullable|string|max:20',
            'cedula_identidad' => 'nullable|string|max:30',
            'telefono_profesional' => 'nullable|string|max:20',
            'email' => 'required|email',
            'nombre' => 'required|string|max:255',
            'ciudad' => 'required|string|max:255',
            'numero_identificacion' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'seguros_medicos' => 'nullable|array',
            'seguros_medicos.*' => 'exists:seguros_medicos,id',
            'imagenes' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'imagen_corporativa' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'clinica_edificio' => 'nullable|string|max:255'
        ]);

        // Buscar el proveedor
        $proveedor = Proveedor::where('user_id', Auth::id())->first();        // Manejar carga de imagen general
        $imagenesPath = $proveedor->imagenes; // Mantener la imagen actual por defecto

        // Verificar si se debe eliminar la imagen actual
        if ($request->has('eliminar_imagenes') && $request->eliminar_imagenes == '1') {
            // Eliminar archivo físico si existe
            if ($proveedor->imagenes && file_exists(public_path($proveedor->imagenes))) {
                unlink(public_path($proveedor->imagenes));
            }
            $imagenesPath = null;
        }

        if ($request->hasFile('imagenes')) {
            // Eliminar imagen anterior si existe y se está subiendo una nueva
            if ($proveedor->imagenes && file_exists(public_path($proveedor->imagenes))) {
                unlink(public_path($proveedor->imagenes));
            }

            $file = $request->file('imagenes');
            $filename = Str::slug($proveedor->id . '-imagenes-' . time()) . '.' . $file->getClientOriginalExtension();
            $path = 'imagenes/proveedores/' . $proveedor->id . '/imagenes';

            // Crear directorio si no existe
            if (!file_exists(public_path($path))) {
                mkdir(public_path($path), 0755, true);
            }

            $file->move(public_path($path), $filename);
            $imagenesPath = $path . '/' . $filename;
        }

        // Manejar carga de imagen corporativa/logo
        $imagenCorporativaPath = $proveedor->imagen_corporativa; // Mantener la imagen actual por defecto

        // Verificar si se debe eliminar la imagen corporativa actual
        if ($request->has('eliminar_imagen_corporativa') && $request->eliminar_imagen_corporativa == '1') {
            // Eliminar archivo físico si existe
            if ($proveedor->imagen_corporativa && file_exists(public_path($proveedor->imagen_corporativa))) {
                unlink(public_path($proveedor->imagen_corporativa));
            }
            $imagenCorporativaPath = null;
        }

        if ($request->hasFile('imagen_corporativa')) {
            // Eliminar imagen anterior si existe y se está subiendo una nueva
            if ($proveedor->imagen_corporativa && file_exists(public_path($proveedor->imagen_corporativa))) {
                unlink(public_path($proveedor->imagen_corporativa));
            }

            $file = $request->file('imagen_corporativa');
            $filename = Str::slug($proveedor->id . '-logo-' . time()) . '.' . $file->getClientOriginalExtension();
            $path = 'imagenes/proveedores/' . $proveedor->id . '/logo';

            // Crear directorio si no existe
            if (!file_exists(public_path($path))) {
                mkdir(public_path($path), 0755, true);
            }

            $file->move(public_path($path), $filename);
            $imagenCorporativaPath = $path . '/' . $filename;
        }

        // Buscar o crear el propietario
        if ($proveedor->propietario_id) {
            // Si ya existe propietario, actualizarlo
            $propietario = Propietario::find($proveedor->propietario_id);
            $propietario->update([
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'genero' => $request->genero,
                'telefono_personal' => $request->telefono_personal,
                'cedula_identidad' => $request->cedula_identidad,
                'telefono_profesional' => $request->telefono_profesional,
                'email' => $request->email
            ]);
        } else {
            // Si no existe propietario, crearlo
            $propietario = new Propietario([
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'genero' => $request->genero,
                'telefono_personal' => $request->telefono_personal,
                'cedula_identidad' => $request->cedula_identidad,
                'telefono_profesional' => $request->telefono_profesional,
                'email' => $request->email
            ]);
            $propietario->save();
        }

        // Actualizar el proveedor
        $proveedor->update([
            'nombre' => $request->nombre,
            'ciudad' => $request->ciudad,
            'numero_identificacion' => $request->numero_identificacion,
            'direccion' => $request->direccion,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'especializacion' => $request->especializacion,
            'direccion_maps' => $request->direccion_maps,
            'imagenes' => $imagenesPath,
            'imagen_corporativa' => $imagenCorporativaPath,
            'informacion_adicional' => $request->informacion_adicional,
            'listado_servicios' => $request->listado_servicios,
            'horarios' => $request->horarios,
            'clinica_edificio' => $request->clinica_edificio,
            'propietario_id' => $propietario->id
        ]);

        // Manejar seguros médicos (relación muchos a muchos)
        if ($request->has('seguros_medicos')) {
            // Filtrar valores válidos (excluir -1 que significa "Sin seguro")
            $segurosValidos = array_filter($request->seguros_medicos, function ($seguro) {
                return $seguro != '-1';
            });

            $proveedor->segurosMedicos()->sync($segurosValidos);
        } else {
            // Si no se seleccionó ningún seguro, limpiar la relación
            $proveedor->segurosMedicos()->detach();
        }

        // Actualizar la contraseña de gestión si se proporcionó
        if ($request->filled('password_gestion') && $request->filled('password_gestion_repetir')) {
            if ($request->password_gestion == $request->password_gestion_repetir) {
                $proveedor->user->update([
                    'password' => Hash::make($request->password_gestion)
                ]);
            }
        }

        return redirect()->route('proveedores.misDatos')->with('success', 'Datos actualizados correctamente.');
    }

    public function guardarDocumento(Request $request, $proveedorID)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|string',
            'documento' => 'required|file|max:5120', // max 5MB, ajusta si quieres
        ]);

        // Guardar archivo en public/documentos/{prove$proveedorID}/
        $file = $request->file('documento');
        $folder = public_path("documentos/{$proveedorID}");

        if (!File::exists($folder)) {
            File::makeDirectory($folder, 0755, true);
        }

        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move($folder, $filename);

        // Guardar registro en BD
        DocumentosProveedor::create([
            'proveedor_id' => $proveedorID,
            'nombre' => $request->nombre,
            'tipo' => $request->tipo,
            'archivo' => "documentos/{$proveedorID}/{$filename}",
        ]);

        return redirect()->back()->with('success', 'Documento guardado correctamente.');
    }

    public function misCitas()
    {
        return view('proveedores.misCitas');
    }

    public function listadoCitasPasadas()
    {
        return view('proveedores.listadoCitasPasadas');
    }

    public function listadoCitasAceptadas()
    {
        return view('proveedores.listadoCitasAceptadas');
    }

    public function listadoCitasPendientes()
    {
        return view('proveedores.listadoCitasPendientes');
    }

    public function agendarCitaProveedor()
    {
        return view('proveedores.agendarCitaProveedor');
    }

    public function misClinicasPacientes()
    {
        return view('proveedores.misClinicasPacientes');
    }

    public function historialPruebas()
    {
        return view('proveedores.historialPruebas');
    }

    public function eliminarDocumento(DocumentosProveedor $documento)
    {
        // Eliminar archivo físico
        if (File::exists(public_path($documento->archivo))) {
            File::delete(public_path($documento->archivo));
        }

        // Eliminar registro DB
        $documento->delete();

        return back()->with('success', 'Documento eliminado correctamente.');
    }

    public function guardarSeguro(Request $request)
    {
        $proveedor = Proveedor::where('user_id', auth()->id())->first();
        $proveedor->segurosMedicos()->syncWithoutDetaching([$request->seguro_id]);

        return response()->json(['success' => true]);
    }

    public function eliminarSeguro(Request $request)
    {
        $proveedor = Proveedor::where('user_id', auth()->id())->first();
        $proveedor->segurosMedicos()->detach($request->seguro_id);

        return response()->json(['success' => true]);
    }


    public function misPedidosPresupuestos()
    {
        $proveedor = Proveedor::where('user_id', auth()->id())->first();
      
        if ($proveedor && $proveedor->tipo == 'centro_imagenes') {
            $pruebas = Prueba::where('pedido_imagen_id', '!=', null)->get();
            return view('proveedores.misPedidos', compact('pruebas'));
        } elseif ($proveedor && $proveedor->tipo == 'laboratorio') {
            $pruebas = Prueba::where('pedido_laboratorio_id', '!=', null)->get();
            return view('proveedores.misPedidos', compact('pruebas'));
        } else {
            return redirect()->back()->with('error', 'No tienes permisos para ver los pedidos de presupuestos.');
        }
    }
}

    
