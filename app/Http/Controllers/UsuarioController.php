<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Paciente;
use App\Models\Profesional;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = User::all();
        return view('admin.usuarios.index', compact('usuarios'));
    }

    /**
     * Mostrar listado de pacientes
     */
    public function indexPaciente()
    {
        $usuarios = User::where('role','=','paciente')->get();
        return view('admin.usuarios.index', compact('usuarios'));
    }

    /**
     * Mostrar listado de profesionales
     */
    public function indexProfesional()
    {
        $usuarios = User::where('role','=','profesional')->get();
        return view('admin.usuarios.index', compact('usuarios'));
    }

    /**
     * Mostrar listado de proveedores
     */
    public function indexProveedor()
    {
        $usuarios = User::where('role','=','proveedor')->get();
        return view('admin.usuarios.index', compact('usuarios'));
    }

    /**
     * Mostrar listado de administradores
     */
    public function indexAdmin()
    {
        $usuarios = User::where('role','=','admin')->get();
        return view('admin.usuarios.index', compact('usuarios'));
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
        $usuario = $this->loadUserWithRelations($id);
        return view('admin.usuarios.show', compact('usuario'));
    }

    /**
     * Display a specific patient.
     */
    public function showPaciente(string $id)
    {
        $usuario = $this->loadUserWithRelations($id, 'paciente');
        return view('admin.usuarios.show', compact('usuario'));
    }

    /**
     * Display a specific professional.
     */
    public function showProfesional(string $id)
    {
        $usuario = $this->loadUserWithRelations($id, 'profesional');
        return view('admin.usuarios.show', compact('usuario'));
    }

    /**
     * Display a specific provider.
     */
    public function showProveedor(string $id)
    {
        $usuario = $this->loadUserWithRelations($id, 'proveedor');
        return view('admin.usuarios.show', compact('usuario'));
    }

    /**
     * Display a specific admin.
     */
    public function showAdmin(string $id)
    {
        $usuario = User::where('role', 'admin')->findOrFail($id);
        return view('admin.usuarios.show', compact('usuario'));
    }

    /**
     * Load user with appropriate relations based on role
     */
    private function loadUserWithRelations(string $id, ?string $expectedRole = null)
    {
        $query = User::query();

        if ($expectedRole) {
            $query->where('role', $expectedRole);
        }

        $user = $query->findOrFail($id);

        $relations = $this->getRelationsByRole($user->role);

        return User::with($relations)->findOrFail($id);
    }

    /**
     * Get the relations to be loaded based on the user role.
     */
    private function getRelationsByRole(string $role): array
    {
        switch ($role) {
            case 'paciente':
                return [
                    'paciente.segurosMedicos',
                    'paciente.antecedentes',
                    'paciente.contactos_emergencia',
                    'paciente.citas',
                    'paciente.valoraciones'
                ];

            case 'profesional':
                return [
                    'profesional.especializaciones.especialidad',
                    'profesional.especializaciones.subespecialidad',
                    'profesional.ciudad.provincia',
                    'profesional.plan',
                    'profesional.consultorios',
                    'profesional.segurosMedicos',
                    'profesional.citas',
                    'profesional.valoraciones'
                ];

            case 'proveedor':
                return ['proveedor'];

            default:
                return [];
        }
    }

    /**
     * Show the form for editing the specified resource.
     * Redirects to the specific edit method based on user role.
     */
    public function edit(string $id)
    {
        $usuario = User::findOrFail($id);

        // Redirect to specific edit method based on role
        return match ($usuario->role) {
            'paciente' => redirect()->route('pacientes.edit', $id),
            'profesional' => redirect()->route('profesionales.edit', $id),
            'proveedor' => redirect()->route('proveedores.edit', $id),
            'admin' => redirect()->route('administradores.edit', $id),
            default => $this->editGeneral($id)
        };
    }

    /**
     * Show the form for editing a generic user (fallback).
     */
    private function editGeneral(string $id)
    {
        $usuario = $this->loadUserWithRelations($id);
        return view('admin.usuarios.edit', compact('usuario'));
    }

    /**
     * Show the form for editing a specific patient.
     */
    public function editPaciente(string $id)
    {
        $usuario = $this->loadUserWithRelations($id, 'paciente');
        return view('admin.usuarios.edit', compact('usuario'));
    }

    /**
     * Show the form for editing a specific professional.
     */
    public function editProfesional(string $id)
    {
        $usuario = $this->loadUserWithRelations($id, 'profesional');
        return view('admin.usuarios.edit', compact('usuario'));
    }

    /**
     * Show the form for editing a specific provider.
     */
    public function editProveedor(string $id)
    {
        $usuario = $this->loadUserWithRelations($id, 'proveedor');
        return view('admin.usuarios.edit', compact('usuario'));
    }

    /**
     * Show the form for editing a specific admin.
     */
    public function editAdmin(string $id)
    {
        $usuario = User::where('role', 'admin')->findOrFail($id);
        return view('admin.usuarios.edit', compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $usuario = User::findOrFail($id);
        return $this->updateUserByRole($request, $usuario);
    }

    /**
     * Update a specific patient.
     */
    public function updatePaciente(Request $request, string $id)
    {
        $usuario = User::where('role', 'paciente')->findOrFail($id);
        return $this->updateUserByRole($request, $usuario);
    }

    /**
     * Update a specific professional.
     */
    public function updateProfesional(Request $request, string $id)
    {
        $usuario = User::where('role', 'profesional')->findOrFail($id);
        return $this->updateUserByRole($request, $usuario);
    }

    /**
     * Update a specific provider.
     */
    public function updateProveedor(Request $request, string $id)
    {
        $usuario = User::where('role', 'proveedor')->findOrFail($id);
        return $this->updateUserByRole($request, $usuario);
    }

    /**
     * Update a specific admin.
     */
    public function updateAdmin(Request $request, string $id)
    {
        $usuario = User::where('role', 'admin')->findOrFail($id);
        return $this->updateUserByRole($request, $usuario);
    }

    /**
     * Update user based on their role with appropriate validation.
     */
    private function updateUserByRole(Request $request, User $usuario)
    {

        $validatedData = $this->validateUserDataByRole($request, $usuario->role, $usuario->id);
        DB::beginTransaction();

        // Actualizar datos básicos del usuario
        $userUpdates = [
            'name' => $validatedData['name'],
        ];

        // Actualizar rol si ha cambiado
        if (isset($validatedData['role']) && $validatedData['role'] !== $usuario->role) {
            $userUpdates['role'] = $validatedData['role'];
            $usuario->role = $validatedData['role']; // Actualizar temporalmente para la lógica siguiente
        }

        // Actualizar estado activo si está presente
        if (isset($validatedData['activo'])) {
            $userUpdates['activo'] = (bool)$validatedData['activo'];
        }

        // Actualizar verificación de email si está presente
        if (isset($validatedData['email_verified'])) {
            $userUpdates['email_verified_at'] = $validatedData['email_verified'] ? now() : null;
        }

        $usuario->update($userUpdates);

        // Actualizar contraseña si se proporciona
        if (!empty($validatedData['password'])) {
            $usuario->update(['password' => bcrypt($validatedData['password'])]);
        }

        // Actualizar datos específicos del rol
        $this->updateRoleSpecificData($usuario, $validatedData);

        DB::commit();

        $roleRoutes = [
            'paciente' => 'usuarios.pacientes',
            'profesional' => 'usuarios.profesionales',
            'proveedor' => 'usuarios.proveedores',
            'admin' => 'usuarios.administradores'
        ];

        $redirectRoute = $roleRoutes[$usuario->role] ?? 'usuarios.index';

        return redirect()->route($redirectRoute)
            ->with('success', 'Usuario actualizado correctamente');
    }

    /**
     * Validate user data based on role.
     */
    private function validateUserDataByRole(Request $request, string $role, ?int $userId = null)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|confirmed',
            'role' => 'required|in:admin,paciente,profesional,proveedor',
            'activo' => 'nullable|boolean',
            'email_verified' => 'nullable|boolean',
        ];

        // Obtener el rol del request si es diferente (para cambios de rol)
        $targetRole = $request->input('role', $role);

        // Agregar validaciones específicas por rol objetivo
        switch ($targetRole) {
            case 'paciente':
                $rules = array_merge($rules, [
                    'paciente_foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                    'paciente_nombre_completo' => 'required|string|max:255',
                    'paciente_fecha_nacimiento' => 'nullable|date|before:today',
                    'paciente_genero' => 'nullable|in:Masculino,Femenino,Otro',
                    'paciente_estado_civil' => 'nullable|string|max:255',
                    'paciente_nacionalidad' => 'nullable|string|max:255',
                    'paciente_celular' => 'nullable|string|max:255',
                    'paciente_direccion' => 'nullable|string|max:1000',
                    'paciente_cedula' => 'nullable|string|max:255',
                    'paciente_grupo_sanguineo' => 'nullable|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
                ]);
                break;

            case 'profesional':
                $rules = array_merge($rules, [
                    'profesional_nombre_completo' => 'nullable|string|max:255',
                    'profesional_foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                    'profesional_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                    'profesional_fecha_nacimiento' => 'nullable|date|before:today',
                    'profesional_genero' => 'nullable|in:Hombre,Mujer,Otro',
                    'profesional_telefono_personal' => 'nullable|string|max:255',
                    'profesional_telefono_profesional' => 'nullable|string|max:255',
                    'profesional_cedula_identidad' => 'nullable|string|max:255',
                    'profesional_idiomas' => 'nullable|string|max:255',
                    'profesional_descripcion_profesional' => 'nullable|string|max:1000',
                    'profesional_anios_experiencia' => 'nullable|integer|min:0|max:100',
                    'profesional_licencia_medica' => 'nullable|string|max:255',
                    'profesional_numero_cuenta' => 'nullable|string|max:255',
                    'profesional_plan_id' => 'nullable|integer|exists:plans,id',
                    'profesional_num_colegiado' => 'nullable|string|max:255',
                    'profesional_categoria_id' => 'nullable|integer|exists:categorias,id',
                    'profesional_ciudad_id' => 'nullable|integer|exists:ciudades,id',
                    'profesional_presencial' => 'nullable|boolean',
                    'profesional_videoconsulta' => 'nullable|boolean',
                ]);
                break;

            case 'proveedor':
                $rules = array_merge($rules, [
                    'proveedor_tipo' => 'required|in:farmacia,laboratorio,centro_imagenes',
                    'proveedor_nombre' => 'required|string|max:255',
                    'proveedor_ciudad' => 'required|string|max:255',
                    'proveedor_direccion' => 'required|string|max:1000',
                    'proveedor_numero_identificacion' => 'required|string|max:255',
                    'proveedor_telefono' => 'required|string|max:255',
                ]);
                break;
        }

        $validated = $request->validate($rules);

        return $validated;
    }

    /**
     * Update role-specific data.
     */
    private function updateRoleSpecificData(User $usuario, array $validatedData)
    {

        switch ($usuario->role) {
            case 'paciente':
                $pacienteData = [
                    'nombre_completo' => $validatedData['paciente_nombre_completo'] ?? null,
                    'fecha_nacimiento' => $validatedData['paciente_fecha_nacimiento'] ?? null,
                    'genero' => $validatedData['paciente_genero'] ?? null,
                    'estado_civil' => $validatedData['paciente_estado_civil'] ?? null,
                    'nacionalidad' => $validatedData['paciente_nacionalidad'] ?? null,
                    'celular' => $validatedData['paciente_celular'] ?? null,
                    'email' => $usuario->email,
                    'direccion' => $validatedData['paciente_direccion'] ?? null,
                    'cedula' => $validatedData['paciente_cedula'] ?? null,
                    'grupo_sanguineo' => $validatedData['paciente_grupo_sanguineo'] ?? null,
                ];

                // Filtrar valores null para no sobreescribir datos existentes
                $pacienteData = array_filter($pacienteData, function ($value) {
                    return $value !== null;
                });

                // Manejar subida de foto
                if (request()->hasFile('paciente_foto')) {
                    $foto = request()->file('paciente_foto');
                    $nombreFoto = time() . '_paciente_' . $usuario->id . '.' . $foto->getClientOriginalExtension();

                    // Crear directorio si no existe
                    $uploadPath = public_path('uploads/pacientes');
                    if (!file_exists($uploadPath)) {
                        mkdir($uploadPath, 0755, true);
                    }

                    $foto->move($uploadPath, $nombreFoto);
                    $pacienteData['foto'] = 'uploads/pacientes/' . $nombreFoto;
                }

                if ($usuario->paciente) {
                    $usuario->paciente->update($pacienteData);
                } else {
                    $pacienteData['user_id'] = $usuario->id;
                    Paciente::create($pacienteData);
                }
                break;

            case 'profesional':
                $profesionalData = [
                    'nombre_completo' => $validatedData['profesional_nombre_completo'] ?? null,
                    'fecha_nacimiento' => $validatedData['profesional_fecha_nacimiento'] ?? null,
                    'genero' => $validatedData['profesional_genero'] ?? null,
                    'telefono_personal' => $validatedData['profesional_telefono_personal'] ?? null,
                    'telefono_profesional' => $validatedData['profesional_telefono_profesional'] ?? null,
                    'cedula_identidad' => $validatedData['profesional_cedula_identidad'] ?? null,
                    'email' => $usuario->email,
                    'idiomas' => $validatedData['profesional_idiomas'] ?? null,
                    'descripcion_profesional' => $validatedData['profesional_descripcion_profesional'] ?? null,
                    'anios_experiencia' => $validatedData['profesional_anios_experiencia'] ?? null,
                    'licencia_medica' => $validatedData['profesional_licencia_medica'] ?? null,
                    'numero_cuenta' => $validatedData['profesional_numero_cuenta'] ?? null,
                    'plan_id' => $validatedData['profesional_plan_id'] ?? null,
                    'num_colegiado' => $validatedData['profesional_num_colegiado'] ?? null,
                    'categoria_id' => $validatedData['profesional_categoria_id'] ?? null,
                    'ciudad_id' => $validatedData['profesional_ciudad_id'] ?? null,
                    'presencial' => isset($validatedData['profesional_presencial']) ? (bool)$validatedData['profesional_presencial'] : false,
                    'videoconsulta' => isset($validatedData['profesional_videoconsulta']) ? (bool)$validatedData['profesional_videoconsulta'] : false,
                ];

                // Filtrar valores null para no sobreescribir datos existentes
                $profesionalDataFiltered = array_filter($profesionalData, function ($value) {
                    return $value !== null;
                });

                // Manejar subida de foto
                if (request()->hasFile('profesional_foto')) {
                    $foto = request()->file('profesional_foto');
                    $nombreFoto = time() . '_profesional_foto_' . $usuario->id . '.' . $foto->getClientOriginalExtension();

                    $uploadPath = public_path('uploads/profesionales');
                    if (!file_exists($uploadPath)) {
                        mkdir($uploadPath, 0755, true);
                    }

                    $foto->move($uploadPath, $nombreFoto);
                    $profesionalDataFiltered['foto'] = 'uploads/profesionales/' . $nombreFoto;
                }

                // Manejar subida de logo
                if (request()->hasFile('profesional_logo')) {
                    $logo = request()->file('profesional_logo');
                    $nombreLogo = time() . '_profesional_logo_' . $usuario->id . '.' . $logo->getClientOriginalExtension();

                    $uploadPath = public_path('uploads/profesionales');
                    if (!file_exists($uploadPath)) {
                        mkdir($uploadPath, 0755, true);
                    }

                    $logo->move($uploadPath, $nombreLogo);
                    $profesionalDataFiltered['logo'] = 'uploads/profesionales/' . $nombreLogo;
                }


                if ($usuario->profesional) {
                    $usuario->profesional->update($profesionalDataFiltered);
                } else {
                    $profesionalDataFiltered['user_id'] = $usuario->id;
                    Profesional::create($profesionalDataFiltered);
                }
                break;

            case 'proveedor':
                $proveedorData = [
                    'tipo' => $validatedData['proveedor_tipo'] ?? null,
                    'nombre' => $validatedData['proveedor_nombre'] ?? null,
                    'ciudad' => $validatedData['proveedor_ciudad'] ?? null,
                    'direccion' => $validatedData['proveedor_direccion'] ?? null,
                    'numero_identificacion' => $validatedData['proveedor_numero_identificacion'] ?? null,
                    'email' => $usuario->email,
                    'telefono' => $validatedData['proveedor_telefono'] ?? null,
                ];

                // Filtrar valores null
                $proveedorData = array_filter($proveedorData, function ($value) {
                    return $value !== null;
                });


                if ($usuario->proveedor) {
                    $usuario->proveedor->update($proveedorData);
                } else {
                    $proveedorData['user_id'] = $usuario->id;
                    Proveedor::create($proveedorData);
                }
                break;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $usuario)
    {
        $usuario->delete();
        return redirect()->route('usuarios.index')->with('eliminado', 'ok');
    }

    /**
     * Helper method for debugging request data
     */
    private function debugRequestData(Request $request, string $context = '')
    {
        Log::info("Debug Request Data - {$context}", [
            'all_data' => $request->all(),
            'files' => $request->allFiles(),
            'method' => $request->method(),
            'url' => $request->url(),
            'headers' => $request->headers->all()
        ]);
    }
}
