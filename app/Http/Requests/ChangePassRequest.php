<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ChangePassRequest
 * Clase que es usada para el cambio de contraseña de todos los miembros que no son alumnos en su primer
 * acceso al sistema
 * @package App\Http\Requests
 */
class ChangePassRequest extends FormRequest
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
            //
            'old_password' => ['required', function ($attribute, $value, $fail) {
                if (!\Hash::check($value, $this->user()->password)) {
                    $fail('Old Password did not match to our records.');
                }
            }],
            'password' => 'required|min:6|max:40|confirmed'
        ];
    }
}
