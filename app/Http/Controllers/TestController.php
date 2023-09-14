<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\catalogAcademicLevel;
use App\Http\Requests\AcademicLevelRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class TestController extends Controller
{
    public function createTest(Request $request){
        try {
            $academicLevel = catalogAcademicLevel::create([
            'name_academic_level'=>$request['name_academic_level'],
            'id_status'=>$request['id_status'],
             ]);
            
             return response()->json([
                'status' => 'success',
                'msg' => 'Nivel de estudio agregado',
                'data' => $academicLevel
                 ]);
             
    } catch  (Exception $e) {
            // Manejar la excepción
          
        }
    }

    
}
