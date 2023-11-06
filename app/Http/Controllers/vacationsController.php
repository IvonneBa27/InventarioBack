<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\vacationSettings;

class vacationsController extends Controller
{
    //
    public function index(){

        $vacationSettings = DB::table('vacation_settings')
                                ->select('vacation_settings.id', 'vacation_settings.antiquity', 'vacation_settings.days_year', 'vacation_settings.registration_year', 'status.nombre as status')
                                ->join('status','vacation_settings.status_id','=','status.id')
                                ->get();

                            return response()->json([
                                'status' => 'success',
                                'msg' => 'Lista de Ajustes',
                                'data' =>    $vacationSettings
                            ]);
    }

    public function vacationCalculation(Request $request){
        $id = $request->get('id'); 
        $yearsUsers = DB::table('users')
            ->selectRaw('TIMESTAMPDIFF(YEAR, fecha_ingreso, CURDATE()) AS years')
            ->where('id_estatus', 1)
            ->where('id', '=', $id)
            ->first(); 
    
        if($yearsUsers->years == 0){
            return response()->json([
                'status' => 'success',
                'msg' => 'No cuenta con antiguedad',
                'data' => $yearsUsers
            ]);
        } else {
            $daysVacation = DB::table('vacation_settings')
                ->select('days_year')
                ->where('antiquity', '=', $yearsUsers->years) // Corrección aquí
                ->get();
    
            return response()->json([
                'status' => 'success',
                'msg' => 'Dias de vacaciones',
                'data' => $daysVacation
            ]);
        }
    }
}
   
    
    
    
    