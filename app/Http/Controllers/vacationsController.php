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
}
