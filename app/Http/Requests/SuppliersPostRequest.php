<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class SuppliersPostRequest extends FormRequest
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
         
                'razon_social'=> 'required',
                'rfc'=> 'required',
                'idPais' => 'required',
                'idCiudad'=> 'required',
                'idMunicipio'  => 'required',
                'calle' => 'required',
                'no_ext' => 'required',
                'colonia' => 'required',
                'cp' => 'required',
                'clabe_intenbancaria' => 'max:18',


               
             
    
            
        ];
    }

    public function messages()
    {

        return [

            'rfc.required' =>'El RFC es requerido',
            'idPais.required'=> 'El pais es requerido',
            'idCiudad.required'  => 'La ciudad es requerido',
            'idMunicipio.required' => 'El municipio es requerido',
            'calle.required' => 'La calle es requerido',
            'no_ext.required' => 'El No. Ext es requerido',
            'colonia.required' => 'La colonia es requerido',
            'cp.required' => 'El codigo postal es requerido',
            'no_ext.required' => 'El No. Ext es requerido',
            'clabe_interbancaria.max' => 'La CLABE interbancaria debe ser 18 digitos',
        
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
