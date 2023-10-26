<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\salaryAdjustment;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\salaryAdjustmentRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Usuario;

class salaryAdjustmentController extends Controller
{
    //
    public function create(salaryAdjustmentRequest $request){

        $salaryAdjustment = salaryAdjustment::create([
            'user_id' => $request['user_id'],
            'previous_department_id' => $request['previous_department_id'],
            'previous_subcategory_id' => $request['previous_subcategory_id'],
            'previous_position_id' => $request['previous_position_id'],
            'previous_campania_id' => $request['previous_campania_id'],
            'previous_salary' => $request['previous_salary'],
            'admission_date' => $request['admission_date'],
            'salary_adjustment' => $request['salary_adjustment'],
            'updated_department_id' => $request['updated_department_id'],
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

    public function updateSalaryAdjustment(Request $request){
        $usuario = Usuario::find($request['id']); 
        $usuario->id_subcategoria = $request['id_subcategoria'];
        $usuario->id_departamento_empresa = $request['id_departamento_empresa'];
        $usuario->id_puesto = $request['id_puesto'];
        $usuario->id_campania = $request['id_campania'];
        $usuario->sueldo = $request['sueldo'];
   

        $usuario->save();
        return response()->json([
            'status' => 'success',
            'msg' => 'Usuario actualizado, por ajuste Salarial',
            'data' => $usuario
        ]);
    }

    public function indexSalaryAdjustment(){

        $salaryAdjustment = DB::SELECT('CALL get_list_adjustSalary');

                            return response()->json([
                                'status' => 'success',
                                'msg' => 'Lista de Ajustes',
                                'data' => $salaryAdjustment
                            ]);
    }

}
