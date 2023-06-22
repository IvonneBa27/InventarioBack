<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class transferStorePostRequest extends FormRequest
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

            'observation'=> 'required',
        
    ];
}

public function messages()
{

    return [

        'observation.required' =>'La observacion es requerido',
     

       
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