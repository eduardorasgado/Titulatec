<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class JefeAcademiaRequest extends FormRequest
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
            'password' => ['required', function ($attribute, $value, $fail) {
                if (!\Hash::check($value, Auth::user()->password)) {
                    $fail('La contraseña del usuario no es correcta.');
                }
            }],
            'cedula_profesional' => ['required', 'string', 'max:255'],
            'especialidad_estudiada' => ['required', 'string', 'max:300'],
            'academia' => ['required', 'numeric']
        ];
    }
}
