<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlumnoRequest extends FormRequest
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
            'numero_control' => 'required|string|max:50',
            'direccion' => 'required|string|max:250',
            'telefono' => 'required|string|max:20',
            'otherTECNM' => 'nullable|string|max:50',
            'estado' => 'required|string|max:80',
            'ciudad' => 'required|string|max:80',
            'lugar_trabajo' => 'nullable|string|max:20',
            'puesto_trabajo' => 'nullable|string|max:20',
            'generacion' => 'required|string|max:30',
            'anexo' => 'nullable|string|max:400',
        ];
    }
}
