<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\usersVacationsRequest;
use App\Models\usersVacations;

class usersVacationsController extends Controller
{
    //

    public function create(usersVacationsRequest $request){

            $usersVacations = usersVacations::create([
            'user_id' => $request['user_id'],
            'admission_date' => $request['admission_date'],
            'period' => $request['period'],
            'total_days' => $request['total_days'],
            'update_days' => $request['update_days'],
            'status_id' => $request['status_id'],
            'admin_user_id' => $request['admin_user_id'],
        ]);
    

        return response()->json([
            'status' => 'success',
            'msg' => 'Registro de Vacaciones',
            'data' => $usersVacations
        ]);
    }


    public function update(Request $request){
        $usersVacations = usersVacations::find($request['id']);
        $usersVacations->update_days=$request['update_days'];
        $usersVacations->save();
        return response()->json([
            'status' => 'success',
            'msg'    => 'Dias actualizados',
            'data'   => $usersVacations
        ]);
    }


    public function index(){

       // $usersVacations = DB::SELECT('CALL get_ListVacations()');
       $usersVacations = DB::table('users_vacations as uv')
                            ->select('uv.user_id', 'u.usuario', 'u.nombre_completo', 'u.fecha_ingreso', 'u.curp')
                            ->selectRaw('SUM(uvd.days_requested) as total_days_requested, uv.update_days')
                            ->join('users_vacations_details as uvd', 'uv.id', '=', 'uvd.vacation_id')
                            ->join('users as u', 'uv.user_id', '=', 'u.id')
                            ->groupBy('uv.user_id')
                            ->get();
                            return response()->json([
                                'status' => 'success',
                                'msg' => 'Lista de Ajustes',
                                'data' =>  $usersVacations
                            ]);
    }
}
