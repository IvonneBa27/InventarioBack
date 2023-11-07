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
                            ->select('uv.id', 'uv.user_id', 'u.usuario', 'u.nombre_completo', 'u.fecha_ingreso', 'u.curp')
                            ->selectRaw('SUM(uvd.days_requested) as total_days_requested, uv.update_days')
                            ->join('users_vacations_details as uvd', 'uv.id', '=', 'uvd.vacation_id')
                            ->join('users as u', 'uv.user_id', '=', 'u.id')
                            ->groupBy('uv.user_id')
                            ->get();
                            return response()->json([
                                'status' => 'success',
                                'msg' => 'Lista de Vacaciones',
                                'data' =>  $usersVacations
                            ]);
    }

    public function getById(Request $request){  
        $id = $request->get('id'); // Metodo por GET
        $usersVacations = usersVacations::where('id','=', $id)->get();
        return response()->json([
            'status' => 'success',
            'msg' => 'Vacaciones obtenidas por Id',
            'data' => $usersVacations
        ]);
    }

    public function indexId(Request $request){ 
        $id = $request->get('id'); 
        // $usersVacations = DB::SELECT('CALL get_ListVacations()');
        $usersVacations =DB::table('users_vacations_details')
                            ->select('users_vacations_details.id', 'users.nombre_completo', 'users.curp', 'users_vacations_details.application_date', 'users_vacations_details.days_requested', 'users_vacations_details.observations')
                            ->join('users_vacations','users_vacations_details.vacation_id','=','users_vacations.id')
                            ->join('users','users_vacations.user_id','=','users.id')
                            ->where('users_vacations_details.vacation_id','=',$id)
                            ->get();
                             return response()->json([
                                 'status' => 'success',
                                 'msg' => 'Lista de Vacaciones Id',
                                 'data' =>  $usersVacations
                             ]);
     }


     public function searchUsersVacation(Request $request){
        $param = $request->get('param');

        $usersVacations = DB::table('users_vacations as uv')
                            ->select('uv.id', 'uv.user_id', 'u.usuario', 'u.nombre_completo', 'u.fecha_ingreso', 'u.curp')
                            ->selectRaw('SUM(uvd.days_requested) as total_days_requested, uv.update_days')
                            ->join('users_vacations_details as uvd', 'uv.id', '=', 'uvd.vacation_id')
                            ->join('users as u', 'uv.user_id', '=', 'u.id')
                            ->where('u.nombre_completo', 'like', '%'.$param.'%')
                            ->orwhere('u.curp', 'like', '%'.$param.'%')
                            ->groupBy('uv.user_id')
                            ->get();
                            return response()->json([
                                'status' => 'success',
                                'msg' => 'Lista de Vacaciones',
                                'data' =>  $usersVacations
                            ]);

       
    }
}
