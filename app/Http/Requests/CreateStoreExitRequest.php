<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class CreateStoreExitRequest extends FormRequest
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
           
            'id_type_exit' => 'required', //
            'authorized_id' => 'required',
            
            
        ];
    }
    public function messages()
    {

        return [
        
            'id_type_exit.required' => 'El tipo de salida es requerido',
            'authorized_id.required' => 'La persona que autoriza es requerida',
        
          

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
