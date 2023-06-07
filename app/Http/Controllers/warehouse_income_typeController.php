<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\warehouse_income_type;
use App\Http\Requests\warehouse_income_typePostRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class warehouse_income_typeController extends Controller
{
    public function create(warehouse_income_typePostRequest $request){

    $typeIncome = warehouse_income_type::create([
            'name'=>$request['name'],
            ]);

         return response()->json([
             'status' => 'success',
             'msg' => 'Tipo de entrada agregado',
             'data' => $typeIncome
         ]);
     }

     public function get(){
        $typeIncome = warehouse_income_type::all();
            return response()->json([
             'status' => 'success',
             'msg' => 'Tipos de entrada obtenidos correctamente',
             'data' =>  $typeIncome
         ]);
     }
 
}