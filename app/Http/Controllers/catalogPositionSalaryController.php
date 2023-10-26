<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\catalogPositionSalary;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\catalogPositionSalaryRequest;
use Illuminate\Support\Facades\DB;


class catalogPositionSalaryController extends Controller
{
    //


    public function index(){
        $catalogSalary = DB::table('catalog_position_salary')
                            ->select('catalog_position_salary.id', 'catalog_company_position.nombre as name_position', 'catalog_position_salary.min_salary', 'catalog_position_salary.max_salary', 'status.nombre as status')
                            ->join('catalog_company_position','catalog_company_position.id','=','catalog_position_salary.id_position')
                            ->join('status','catalog_position_salary.id_status','=','status.id')
                            ->get();
        return response()->json([
            'status' => 'success',
            'msg' => 'Catalogo de Salarios por Puesto, obtenidos correctamente',
            'data' => $catalogSalary

        ]);

    }

    public function idSalaryPosition(Request $request){  
        $id = $request->get('id'); 
        $catalogSalary = DB::table('catalog_position_salary')
                        ->select('catalog_position_salary.id', 'catalog_position_salary.id_position', 'catalog_company_position.nombre', 'catalog_position_salary.min_salary', 'catalog_position_salary.max_salary', 'status.id as status')
                        ->join('catalog_company_position','catalog_company_position.id','=','catalog_position_salary.id_position')
                        ->join('status','catalog_position_salary.id_status','=','status.id')
                        ->where('catalog_company_position.id','=',$id)
                        ->get();
                    
        return response()->json([
            'status' => 'success',
            'msg' => 'Registro Salarial por Puesto',
            'data' => $catalogSalary
        ]);
    }
    public function idSalary(Request $request){  
        $id = $request->get('id'); 
        $catalogSalary =catalogPositionSalary::find($id);
                    
        return response()->json([
            'status' => 'success',
            'msg' => 'Registro Salarial por Id',
            'data' => $catalogSalary
        ]);
    }


    public function create(catalogPositionSalaryRequest $request){

        $catalogSalary = catalogPositionSalary::create([
            'id_position' => $request['id_position'],
            'min_salary' => $request['min_salary'],
            'max_salary' => $request['max_salary'],
            'id_status' => $request['id_status'],
            'user_id' => $request['user_id'],
        ]);
        return response()->json([
            'status' => 'success',
            'msg' => 'Registro de posicion agregado',
            'data' => $catalogSalary
        ]);
    }

    public function update(Request $request){
        $catalogSalary = catalogPositionSalary::find($request['id']); 
        $catalogSalary->min_salary = $request['min_salary'];
        $catalogSalary->max_salary = $request['max_salary'];
        $catalogSalary->user_id = $request['user_id'];
        $catalogSalary->id_status = $request['id_status'];
   
        $catalogSalary->save();
        return response()->json([
            'status' => 'success',
            'msg' => 'Registro actualizado',
            'data' => $catalogSalary
        ]);
    }


}
