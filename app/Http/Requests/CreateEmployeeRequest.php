<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class CreateEmployeeRequest extends FormRequest
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
            'apellido_pat' => 'required', //
            'nombre' => 'required', //
            'fecha_nacimiento' => 'required',
            'curp' => 'required|unique:users',
            'id_sexo' => 'required',
            'id_estado_civil' => 'required', //
            'nacionalidad' => 'required', //
            'id_pais' => 'required', //
            'id_estado' => 'required', //
            'id_municipio' => 'required', //
            'calle' => 'required', //
            'no_ext' => 'required', //
            'cp' => 'required', //
            'tel_personal' => 'required', //
            'email_personal' => 'required',
            'usuario' => 'required',
            'id_estatus' => 'required',
            'numero_empleado' => 'required|unique:users',

        ];
    }


    public function messages()
    {

        return [
            'fecha_nacimiento.required' => 'La fecha de nacimiento es requerida',
            'curp.required' => 'El CURP es requerido',
            'curp.unique' => 'El CURP, ya se encuentra registrado',
            'id_sexo.required' => 'El tipo de sexo es requerido',
            'usuario.required'  => 'El usuario es requerido',
            'id_estatus.required' => 'El tipo de estatus es requerida',
            'numero_empleado.required' => 'El numero de empleado es requerido',
            'numero_empleado.unique' => 'El numero de empleado, ya se encuentra registrado.',
            'apellido_pat.required' => 'El apellido paterno es requerido',
            'nombre.required' => 'El nombre es requerido',
            'nacionalidad.required' => 'La nacionalidad  es requerida',
            'id_pais.required' => 'El pais  es requerido',
            'id_estado.required' => 'El estado  es requerido',
            'id_municipio.required' => 'El municipio / alcaldia  es requerido',
            'calle.required' => 'La calle es requerida',
            'no_ext.required' => 'El numero exterior es requerido',
            'cp.required' => 'El  codigo postal es requerido',
            'tel_personal.required' => 'El  telefono personal es requerido',
            'id_estado_civil.required' => 'El  estado civil es requerido',



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
