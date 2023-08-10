<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class AgeRangeRequest extends FormRequest
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
                'name_age_range' => 'required', //
            ];
        }
    
    
        public function messages()
        {
    
            return [
                'name_age_range.required' => 'El rango de fecha es requerida', 
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
    