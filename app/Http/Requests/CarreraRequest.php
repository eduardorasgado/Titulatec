<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarreraRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // TODO: Autorizar siempre que sea false su memmorandum en tabla ProcesoTitulacion
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
            'otherTECNM' => 'nullable|string|max:50',
            'generacion' => 'required|string|max:30',
            'anexo' => 'nullable|string|max:400',
            'opcion' => 'required|numeric',
            'especialidad' => 'required|numeric',
            'plan' => 'required',
        ];
    }
}
