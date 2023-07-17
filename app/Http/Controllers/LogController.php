<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Logs;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LogPostRequest;


class LogController extends Controller
{
    public function create(LogPostRequest $request){

     
        $log = Logs::create([
            'message'=>$request['message'],
            'event'=>$request['event'],
            'id_user'=>$request['id_user'],
            'system'=>$request['system'],
        ]);
         return response()->json([
             'status' => 'success',
             'msg' => 'Registro agregado',
             'data' => $log
         ]);
     }


      

    public function get(){
        $log = Logs::all();
        return response()->json([
            'status' => 'success',
            'msg' => 'Registros obtenidos correctamente',
            'data' => $log
        ]);
    }

}
