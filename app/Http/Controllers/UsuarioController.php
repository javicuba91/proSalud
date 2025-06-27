<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Paciente;
use App\Models\Profesional;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function indexPaciente()
    {
        $usuarios = User::where('role','=','paciente')->get();
        return view('admin.usuarios.index', compact('usuarios'));
    }

    public function indexProfesional()
    {
        $usuarios = User::where('role','=','profesional')->get();
        return view('admin.usuarios.index', compact('usuarios'));
    }

    public function indexProveedor()
    {
        $usuarios = User::where('role','=','proveedor')->get();
        return view('admin.usuarios.index', compact('usuarios'));
    }

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
        return match($usuario->role) {
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

        try {
            DB::beginTransaction();

            // Actualizar datos básicos del usuario
            $usuario->update([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'telefono' => $validatedData['telefono'] ?? null,
                'fecha_nacimiento' => $validatedData['fecha_nacimiento'] ?? null,
                'genero' => $validatedData['genero'] ?? null,
                'direccion' => $validatedData['direccion'] ?? null,
            ]);

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
                'admin' => 'usuarios.admins'
            ];

            $redirectRoute = $roleRoutes[$usuario->role] ?? 'usuarios.index';

            return redirect()->route($redirectRoute)
                ->with('actualizado', 'ok')
                ->with('mensaje', 'Usuario actualizado correctamente');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => 'Error al actualizar el usuario: ' . $e->getMessage()])
                        ->withInput();
        }
    }

    /**
     * Validate user data based on role.
     */
    private function validateUserDataByRole(Request $request, string $role, ?int $userId = null)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email' . ($userId ? ",$userId" : ''),
            'telefono' => 'nullable|string|max:20',
            'fecha_nacimiento' => 'nullable|date|before:today',
            'genero' => 'nullable|in:masculino,femenino,otro',
            'direccion' => 'nullable|string|max:500',
            'password' => 'nullable|string|min:8|confirmed',
        ];

        // Agregar validaciones específicas por rol
        switch ($role) {
            case 'paciente':
                $rules = array_merge($rules, [
                    'cedula' => 'nullable|string|max:20',
                    'tipo_sangre' => 'nullable|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
                    'altura' => 'nullable|numeric|min:0|max:300',
                    'peso' => 'nullable|numeric|min:0|max:500',
                ]);
                break;

            case 'profesional':
                $rules = array_merge($rules, [
                    'cedula' => 'required|string|max:20',
                    'numero_licencia' => 'nullable|string|max:50',
                    'descripcion' => 'nullable|string|max:1000',
                ]);
                break;

            case 'proveedor':
                $rules = array_merge($rules, [
                    'nombre_empresa' => 'nullable|string|max:255',
                    'ruc' => 'nullable|string|max:20',
                    'descripcion' => 'nullable|string|max:1000',
                ]);
                break;
        }

        return $request->validate($rules);
    }

    /**
     * Update role-specific data.
     */
    private function updateRoleSpecificData(User $usuario, array $validatedData)
    {
        switch ($usuario->role) {
            case 'paciente':
                if ($usuario->paciente) {
                    $usuario->paciente->update([
                        'cedula' => $validatedData['cedula'] ?? null,
                        'tipo_sangre' => $validatedData['tipo_sangre'] ?? null,
                        'altura' => $validatedData['altura'] ?? null,
                        'peso' => $validatedData['peso'] ?? null,
                    ]);
                }
                break;

            case 'profesional':
                if ($usuario->profesional) {
                    $usuario->profesional->update([
                        'cedula' => $validatedData['cedula'],
                        'numero_licencia' => $validatedData['numero_licencia'] ?? null,
                        'descripcion' => $validatedData['descripcion'] ?? null,
                    ]);
                }
                break;

            case 'proveedor':
                if ($usuario->proveedor) {
                    $usuario->proveedor->update([
                        'nombre_empresa' => $validatedData['nombre_empresa'] ?? null,
                        'ruc' => $validatedData['ruc'] ?? null,
                        'descripcion' => $validatedData['descripcion'] ?? null,
                    ]);
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
}
