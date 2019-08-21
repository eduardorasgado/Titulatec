<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlanEstudioRequest extends FormRequest
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
            'clave' => 'required|string|max:150',
            'is_actual' => 'required|numeric|digits_between:0,1',
            'especialidad' => 'required|numeric',
        ];
    }
}
