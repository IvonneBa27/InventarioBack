<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\salaryAdjustment;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\salaryAdjustmentRequest;
use Illuminate\Support\Facades\DB;

class salaryAdjustmentController extends Controller
{
    //
    public function create(salaryAdjustmentRequest $request){
        
        $salaryAdjustment = salaryAdjustment::create([
            'user_id' => $request['user_id'],
            'previous_departament_id' => $request['previous_departament_id'],
            'previous_subcategory_id' => $request['previous_subcategory_id'],
            'previous_position_id' => $request['previous_position_id'],
            'previous_campania_id' => $request['previous_campania_id'],
            'previous_salary' => $request['previous_salary'],
            'admission_date' => $request['admission_date'],
            'salary_adjustment' => $request['salary_adjustment'],
            'updated_departament_id' => $request['updated_departament_id'],
            'updated_subcategory_id' => $request['updated_subcategory_id'],
            'updated_position_id' => $request['updated_position_id'],
            'updated_campania_id' => $request['updated_campania_id'],
            'updated_salary' => $request['updated_salary'],
            'authorized_user_id' => $request['authorized_user_id'],
            'observations' => $request['observations'],
        ]);
    

        return response()->json([
            'status' => 'success',
            'msg' => 'Registro de ajuste salarial agregado',
            'data' => $salaryAdjustment
        ]);
    }

}
