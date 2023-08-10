<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\catalogAcademicLevel;
use App\Http\Requests\AcademicLevelRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AcademicLevelController extends Controller
{
       //Crear datos en la tabla Academic Level
       public function create(AcademicLevelRequest $request){
        $academicLevel = catalogAcademicLevel::create([
         'name_academic_level'=>$request['name_academic_level'],
         'id_status'=>$request['id_status'],
          ]);
         
          return response()->json([
             'status' => 'success',
             'msg' => 'Nivel de estudio agregado',
             'data' => $academicLevel
              ]);
          }
 
     //Lista de Nivel de estudios
     public function getListAcademicLevel(Request $request){    
        $academicLevel =
            DB::table('catalog_academic_level')
            ->select('catalog_academic_level.id', 'catalog_academic_level.name_academic_level', 'catalog_academic_level.id_status', 'status.nombre')
            ->join('status','catalog_academic_level.id_status','=','status.id')
            ->get();
     
         return response()->json([
                 'status' => 'success',
                 'msg' => 'Lista de Nivel de Estudio',
                 'data' => $academicLevel
         ]);
     }

     //Obtener Nivel de Estudio por Id
     public function getById(Request $request){  
         $id = $request->get('id'); 
         $academicLevel = catalogAcademicLevel::find($id);
         
         return response()->json([
             'status' => 'success',
             'msg' => 'Nivel de estudio por Id',
             'data' => $academicLevel
         ]);
     }
 
     //Actualizar nivel de estudio
     public function update(Request $request){
        $academicLevel = catalogAcademicLevel::find($request['id']);  //Get parametro por metodo post    
        $academicLevel->name_academic_level=$request['name_academic_level'];
        $academicLevel->save();
         return response()->json([
             'status' => 'success',
             'msg'    => 'Nivel de estudio actualizada',
             'data'   =>  $academicLevel
         ]);
      }
 
      //Eliminar nivel de estudio
      public function delete(Request $request){
         $id = $request->get('id');
         $academicLevel = catalogAcademicLevel::find($id);
         $academicLevel->id_status=2;
         $academicLevel->save();
         
          return response()->json([
              'status' => 'success',
              'msg'  => 'Nivel de estudio eliminado',
              'data' =>  $academicLevel
          ]);
      }

    }
