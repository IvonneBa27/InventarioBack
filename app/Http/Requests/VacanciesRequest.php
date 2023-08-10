<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;


class VacanciesRequest extends FormRequest
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
               // 'date' => 'required', //
              //  'vacancy_numbers' => 'required', //
            ];
        }
    
    
        public function messages()
        {
    
            return [
               // 'vacancy_numbers.required' => 'El número de vacantes es requerido', 
              //  'date.required' => 'El número de vacantes es requerido', 
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
    