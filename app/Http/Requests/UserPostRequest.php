<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UserPostRequest extends FormRequest
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
            
                'idtipoUsuario' => 'required|integer',
                'usuario' => 'required|string|max:15',
                'nombre' => 'required|string|max:25',
                'apaterno' => 'required|string|max:25',
                'amaterno' => 'required|string|max:25',
                'email' => 'required|string|max:85',
                'password' => 'required|string|max:85',
             
            
        ];
    }

    public function messages()
    {

        return [

            'idtipoUsuario.required' => 'El id del usuario es requerido',
            'idtipoUsuario.integer' => 'El valor debe ser numerico',
            'usuario.required'=> 'El usuario es requerido',
            'usuario.string' => 'El valor debe ser texto',
            'usuario.max' => 'El usuario debe tener maximo 15 caracteres',
            'nombre.required'=> 'El nombre es requerido',
            'nombre.string' => 'El valor debe ser texto',
            'nombre.max' => 'El nombre debe tener maximo 15 caracteres',
            'apaterno.required'=> 'El apellido paterno es requerido',
            'apaterno.string' => 'El valor debe ser texto',
            'apaterno.max' => 'El apellido paterno debe tener maximo 25 caracteres',
            'amaterno.required'=> 'El apellido materno es requerido',
            'amaterno.string' => 'El valor debe ser texto',
            'amaterno.max' => 'El apellido materno debe tener maximo 25 caracteres',
            'email.required'=> 'El email es requerido',
            'email.string' => 'El valor debe ser texto',
            'email.max' => 'El email debe tener maximo 85 caracteres',
            'password.required'=> 'El password es requerido',
            'password.string' => 'El valor debe ser texto',
            'password.max' => 'El password debe tener maximo 85 caracteres',

        ];

    }

    public function failedValidation(Validator $validator)

    {

        throw new HttpResponseException(response()->json([
            'status'    => 'error',
            'msg'       => $validator->errors()->first()
        ]));

    }
}
