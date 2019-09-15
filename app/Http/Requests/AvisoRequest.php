<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AvisoRequest extends FormRequest
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
            'fecha_examen_aviso' => 'required|string|max:100',
            'hora_inicio' => 'required|string|max:20',
            'lugar_protocolo' => 'required|string|max:50',
        ];
    }
}
