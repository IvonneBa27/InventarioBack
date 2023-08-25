<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\prospectEmployee;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\prospectEmployeeRequest;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class prospectEmployeeController extends Controller
{
    public function receiveExcel(Request $request)
    {
        $dataExcel = json_decode($request['dataExcel'], true, 512, JSON_THROW_ON_ERROR);
        try {
                    foreach ($dataExcel as $key => $dataE) {
                        $baseDate = Carbon::createFromDate(1899, 12, 30); 
                        $dateF = $dataE['Fecha'];
                        $dateForm = $baseDate->addDays($dateF);
                        $date = $dateForm->format('Y-m-d');

                        $birthdaleF = $dataE['fecha de nacimiento'];
                        $birthdaleForm = $baseDate->addDays($birthdaleF);
                        $birthdale = $dateForm->format('Y-m-d');
                
                                 $data =[

                                    'date' => $date,
                                    //'date' => $dataE['Fecha'],
                                    'platform' => $dataE['Plataforma'],
                                    'name_full' => $dataE['Nombre '],
                                    'mail' => $dataE['Email'],
                                    'phone' => $dataE['Telefono'],
                                // 'age' => $dataE['Edad'],
                                    'english_level' => $dataE['Nivel de ingles'],
                                    'service_experience' => $dataE['En que servicio de contact center tienes experiencia'],
                                    'state_residence' => $dataE['Estado de residencia'],
                                    'municipality_delegations' => $dataE['Municipios o delegaciones'],
                                    'personal_computer' => $dataE['Tienes computadora personal con internet y sistema windows'],
                                    'internet_provider' => $dataE['Cual es tu proveedor de internet'],
                                    'financial_dependents' => $dataE['Tienes dependientes financieros'],
                                // 'experience_computer' => $dataE['Del 1 al 10 siendo el 1 poco y 10 muy bueno  Que tan habil eres en la computadora'],
                                    'labor_days' => $dataE['Puedes cumplir una jornada de 48hrs a la semana  Por el momento no contamos con jornadas de medio tiempo'],
                                    'dual_monitor' => $dataE['Tienes habilidad para trabajar con dos monitores'],
                                    'monthly_salary' => $dataE['El rango de sueldo mensual que manejamos puede ser de 11k a 14k netos mas pago de horas extras y bonos por productividad estas de acuerdo '],
                                    'means_communication' => $dataE['What time are you available at Which communication method do you prefer WhatsApp or call'],
                                    //'educational_level' => $dataE['Nivel de estudios'],
                                    'campaign' => $dataE['Campaña'],
                                    //'birthdale' => $dataE['fecha de nacimiento'],
                                    'birthdale' => $birthdale,
                                ];     
                                prospectEmployee::create($data);
                          
             
                }
             
        } catch (JsonException $e) {
          
            return response()->json(['error' => 'JSON inválido'], 400);
        }

        return response()->json([
            'status' => 'success',
            'msg' => 'Valores obtenidos correctamente.',
            'data' => $data,
                ]);

       
    }


    public function get(){
        $prospect = DB::table('prospect_employee')
                          ->select('*')
                          ->orderBy('id','asc')
                          ->get();
           return response()->json([
            'status' => 'success',
            'msg' => 'Registros de tipo de dato obtenidos correctamente',
            'data' => $prospect
        ]);
    }

    
    public function dateRange(Request $request){
        $startDate = $request->get('startDate');
        $endDate = $request->get('endDate');  
        $prospect =   DB::table('prospect_employee')
                                ->select('*')
                                ->where('date','>=',$startDate)
                                ->where('date','<=',$endDate)
                                ->get();
        return response()->json([
            'status' => 'success',
            'msg' => 'Valores obtenidos correctamente.',
            'data Inicio' => $startDate,
            'data Fin' => $endDate,
            'data' => $prospect
        ]);
    }

    public function getCampaing(){
        $prospect = DB::table('prospect_employee')
                    ->select('campaign as nameCampaing')
                    ->groupBy('campaign')
                    ->get();
        return response()->json([
            'status' => 'success',
            'msg' => 'Campañas registradas',
            'data' => $prospect
        ]);
    }

    public function searchName(Request $request){
        $param = $request->get('param');

        $prospect = prospectEmployee::where('name_full', 'like', '%'.$param.'%')->get();
        return response()->json([
            'status' => 'success',
            'message' => 'Nombres obtenidos correctamente',
            'data' => $prospect
        ]);
    }

    public function searchCampaing(Request $request){
        $param = $request->get('param');

        $prospect = prospectEmployee::where('campaign', 'like', '%'.$param.'%')->get();
        return response()->json([
            'status' => 'success',
            'message' => 'Campañas obtenidos correctamente',
            'data' => $prospect
        ]);
    }


}

   


       