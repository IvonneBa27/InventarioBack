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

}
