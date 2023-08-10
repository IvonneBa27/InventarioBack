<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\catalogJobExperience;
use App\Http\Requests\JobExperienceRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class JobExperienceController extends Controller
{
   //Crear datos en la tabla Job Experience
   public function create(JobExperienceRequest $request){
    $jobExperience = catalogJobExperience::create([
     'name_job'=>$request['name_job'],
     'id_status'=>$request['id_status'],
      ]);
     
      return response()->json([
         'status' => 'success',
         'msg' => 'Rango de experiencia laboral',
         'data' => $jobExperience
          ]);
      }

 //Lista de Nivel de estudios
 public function getListJobExperience(Request $request){    
    $jobExperience =
              DB::table('catalog_job_experience')
                ->select('catalog_job_experience.id', 'catalog_job_experience.name_job', 'catalog_job_experience.id_status', 'status.nombre')
                ->join('status','catalog_job_experience.id_status','=','status.id')
                ->get();
        
     return response()->json([
             'status' => 'success',
             'msg' => 'Lista de Rangos de experiencia laboral',
             'data' =>  $jobExperience
     ]);
 
 }
 //Obtener Nivel de Estudio por Id
 public function getById(Request $request){  
     $id = $request->get('id'); 
     $jobExperience = catalogJobExperience::find($id);
     
     return response()->json([
         'status' => 'success',
         'msg' => 'Experiencia Laboral por Id',
         'data' =>  $jobExperience
     ]);
 }

 //Actualizar Experiencia Laboral
 public function update(Request $request){
    $jobExperience = catalogJobExperience::find($request['id']);  //Get parametro por metodo post    
    $jobExperience->name_job=$request['name_job'];
    $jobExperience->save();
     return response()->json([
         'status' => 'success',
         'msg'    => 'Experiencia Laboral actualizada',
         'data'   =>   $jobExperience
     ]);
  }

  //Eliminar nivel de estudio
  public function delete(Request $request){
     $id = $request->get('id');
     $jobExperience = catalogJobExperience::find($id);
     $jobExperience->id_status=2;
     $jobExperience->save();
     
      return response()->json([
          'status' => 'success',
          'msg'  => 'Experiencia Laboral eliminado',
          'data' =>  $jobExperience
      ]);
  }

}
