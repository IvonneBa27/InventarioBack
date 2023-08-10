<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vacancies;
use App\Http\Requests\VacanciesRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class VacanciesController extends Controller
{
    //
      //Crear datos en la tabla Vacantes
      public function create(VacanciesRequest $request){
        $vacancies = Vacancies::create([
         'date'=>$request['date'],
         'id_position'=>$request['id_position'],
         'id_company'=>$request['id_company'],
         'id_department'=>$request['id_department'],
         'id_type_structure'=>$request['id_type_structure'],
         'id_type_schedule'=>$request['id_type_schedule'],
         'id_campaing'=>$request['id_campaing'], 
         'id_location'=>$request['id_location'],
         'id_age_range'=>$request['id_age_range'],
         'id_academic_level'=>$request['id_academic_level'],
         'id_job_experience'=>$request['id_job_experience'],
         'vacancy_numbers'=>$request['vacancy_numbers'],
         'salary'=>$request['salary'],
         'required_skills'=>$request['required_skills'], 
         'id_asiggned'=>$request['id_asiggned'],
         'user_id'=>$request['user_id'],
         'id_status'=>$request['id_status'],

          ]);
         
          return response()->json([
             'status' => 'success',
             'msg' => 'Nueva vacante agregada',
             'data' =>  $vacancies
              ]);
          }


    //Lista de Vacantes
     public function getListVacancies(Request $request){    
        $vacancies =
                DB::table('vacancies_list')
                ->select('vacancies_list.id','vacancies_list.date', 'catalog_company_position.nombre as position', 'groups_sysca.nombre as campaing', 'users.nombre_completo as requester', 'status.nombre as status')
                ->join('status','vacancies_list.id_status','=','status.id')
                ->join('catalog_company_position','vacancies_list.id_position','=','catalog_company_position.id')
                ->leftjoin('groups_sysca','vacancies_list.id_campaing','=','groups_sysca.id')
                ->join('users','vacancies_list.user_id','=','users.id')
                ->get();
     
         return response()->json([
                 'status' => 'success',
                 'msg' => 'Lista de Vacantes',
                 'data' =>  $vacancies
         ]);
     }
}
