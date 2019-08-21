<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MaestroRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre' => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'cedula_profesional' => ['required', 'string', 'max:255'],
            'especialidad_estudiada' => ['required', 'string', 'max:300'],
            'academia' => ['required', 'numeric']
        ];
    }
}
