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
            
               /* 'idtipoUsuario' => 'required|integer',
                'usuario' => 'required|string|max:15',
                'nombre' => 'required|string|max:25',
                'apaterno' => 'required|string|max:25',
                'amaterno' => 'required|string|max:25',
                'email' => 'required|string|max:85',
                'password' => 'required|string|max:85',*/
                'apellido_pat'=> 'required',
                'apellido_pat'=> 'required',
                'nombre' => 'required',
                'numero_empleado'=> 'required|unique:users',
                'id_tipo_usuario'=> 'required',
                'usuario'  => 'required',
                'email_personal' => 'required',
                'email' => 'required',
                'curp' => 'required|unique:users',
                'rfc' => 'required',
                'nss' => 'required',
                'id_sexo' => 'required',
                'fecha_nacimiento' => 'required',
                'id_estatus' => 'required',
                'id_ubicacion' => 'required',
                'id_empresa_rh' => 'required',
                'id_subcategoria' => 'required',
                'ejecuciion_administrativa' => 'required',
                'id_departamento_empresa' => 'required',
                'id_puesto' => 'required',
                'id_turno' => 'required',
                'id_banco' => 'required',
                'numero_cuenta_bancaria' => 'required',
                'clabe_inter_bancaria' => 'required',
                'fecha_ingreso' => 'required',
            
        ];
    }

    public function messages()
    {

        return [

            'numero_empleado.required' =>'El numero de empleado es requerido',
            'numero_empleado.unique' => 'El numero de empleado, ya se encuentra registrado.',

            'id_tipo_usuario.required'=> 'El tipo de usuario es requerido',
            'usuario.required'  => 'El usuario es requerido',
            'email_personal.required' => 'Email personal es requerido',
            'email.required' => 'Email es requerido',
            'curp.required' => 'El CURP es requerido',
            'curp.unique' => 'El CURP, ya se encuentra registrado',
            'rfc.required' => 'El RFC es requerido',
            'nss.required' => 'El NSS es requerido',
            'id_sexo.required' => 'El tipo de sexo es requerido',
            'fecha_nacimiento.required' => 'La fecha de nacimiento es requerida',
            'id_estatus.required' => 'El tipo de estatus es requerida',
            'id_ubicacion.required' => 'El tipo de ubicación es requerida'
            'id_empresa_rh.required' => 'El tipo de empresa es requerida',
            'id_subcategoria.required' => 'El tipo de categoria es requerida',
            'ejecuciion_administrativa.required' => 'El tipo de ejecucion administrativa es requerida',
            'id_departamento_empresa.required' => 'El tipo de departamento de empresa es requerida',
            'id_puesto.required' => 'El tipo de puesto es requerido',
            'id_turno.required' => 'El tipo de turno es requerido',
            'id_banco.required' => 'El tipo de banco es requerido',
            'numero_cuenta_bancaria.required' => 'El numero de cuenta bancaria es requerido',
            'clabe_inter_bancaria.required' => 'La cableinterbancaria es requerido',
            'fecha_ingreso.required' => 'La fecha de ingreso es requerida',

            /*'idtipoUsuario.required' => 'El id del usuario es requerido',
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
            'password.max' => 'El password debe tener maximo 85 caracteres',*/

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
