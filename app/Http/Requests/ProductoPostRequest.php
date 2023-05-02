<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class ProductoPostRequest extends FormRequest
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

                'idtipoProducto' => 'required|integer',
                'sku' => 'required|string|max:25',
                'serial' => 'required|string|max:35',
                'idMarca' => 'required|integer',
                'modelo' => 'required|string|max:50',
                'skunum' => 'required|string|max:25',
                'descripcion' => 'required|string|max:85',
                'foto' => 'required|string|max:85',
                'inventariable' => 'required|string|max:5',
         
        ];
    }


    public function messages()
    {

        return [

                'idtipoProducto.required' => 'El id del producto es requerido',
                'idtipoProducto.integer' => 'El id del producto es numerico',
                'sku.required' => 'El sku producto es requerido',
                'sku.string' => 'El sku producto debe ser texto',
                'sku.max' => 'El sku debe tener maximo 25 caracteres',
                'serial.required' => 'El serial del producto es requerido',
                'serial.string' => 'El serial del producto debe ser texto',
                'serial.max' => 'El serial  debe tener maximo 35 caracteres',
                'idMarca.required' => 'El id del producto es requerido',
                'idMarca.integer' => 'El id de la marca es numerico',
                'modelo.required' => 'El modelo del producto es requerido',
                'modelo.string' => 'El modelo del producto debe ser texto',
                'modelo.max' => 'El modelo debe tener maximo 50 caracteres',
                'skunum.required' => 'El sku interno del producto es requerido',
                'skunum.string' => 'El sku interno del producto debe ser texto',
                'skunum.max' => 'El sku interno debe tener maximo 25 caracteres',
                'descripcion.required' => 'La descripcion del producto es requerido',
                'descripcion.string' => 'La descripcion del producto debe ser texto',
                'descripcion.max' => 'La descripcion del producto debe tener maximo 85 caracteres',
                'foto.required' => 'La foto del producto es requerido',
                'foto.string' => 'La foto del producto debe ser texto',
                'foto.max' => 'La foto del producto debe tener maximo 85 caracteres',
                'inventariable.required' => 'El inventariable del producto es requerido',
                'foto.string' => 'El inventariable del producto debe ser texto',
                'foto.max' => 'El inventariable del producto debe tener maximo 5 caracteres',

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
