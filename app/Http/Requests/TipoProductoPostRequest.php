<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TipoProductoPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
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
            'tipoproducto' => 'required|string|max:50',
        
        ];
    }

    public function messages()
    {

        return [

            'tipoproducto.required' => 'El tipo de producto es requerida',
            'tipoproducto.string' => 'El valor debe ser texto',
            'tipoproducto.max' => 'El tipo de producto debe tener maximo 50 caracteres',

 

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
