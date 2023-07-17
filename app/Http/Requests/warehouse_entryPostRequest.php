<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class warehouse_entryPostRequest extends FormRequest
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

            'warehouse_id'=> 'required',
            'section_id'=> 'required',
            'warehouse_entry_type_id' => 'required'
        
    ];
}

public function messages()
{

    return [

        'warehouse_id.required' =>'El Almacén es requerido',
        'section_id.required' => 'La sección es requerida',
        'warehouse_entre_type_id' => 'El tipo de ingreso es requerido',
     

       
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
