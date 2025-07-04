<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePropietarioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:255',
            'fecha_nacimiento' => 'nullable|date',
            'genero' => 'nullable|string|max:20',
            'telefono_personal' => 'nullable|string|max:20',
            'cedula_identidad' => 'nullable|string|max:50',
            'telefono_profesional' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'proveedor_id' => 'nullable|exists:proveedores,id',
        ];
    }
}
