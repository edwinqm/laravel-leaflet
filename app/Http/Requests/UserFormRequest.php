<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserFormRequest extends FormRequest
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
            'name' => 'required',
            'username' => 'required|min:3|max:15|regex:/^[a-z\d._-]{3,15}$/i',
            'email' => 'required|email|unique:users',
            // Contraseñas cuya longitud sea como mínimo 8 caracteres.
            // Contraseñas que contengan al menos un número o caracter especial.
            // Contraseñas que contengan al menos un caracter especial.
            // Contraseñas que contengan al menos una letra mayúscula.
            // Contraseñas que contengan al menos una letra minúscula.
            'password' => 'required|confirmed|regex:/^.*(?=.{8,})(?=.*\W+)(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/',
            // profile fields
            'address' => 'required',
            'phone' => 'required|regex:/^[0-9\-+]+$/',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Campo :attribute requerido',
        ];
    }
}
