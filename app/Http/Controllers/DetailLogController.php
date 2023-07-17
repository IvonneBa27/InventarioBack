<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailLog;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\DetailLogCreateRequest;

class DetailLogController extends Controller
{
    //
    public function create(DetailLogCreateRequest $request){
        $detailLog = DetailLog::create([
            'id_log'=>$request['id_log'],
            'message'=>$request['message'],
            'movement_type'=>$request['movement_type'],
            'observations'=>$request['observations'],
           
        ]);
         return response()->json([
             'status' => 'success',
             'msg' => 'Registro agregado',
             'data' => $detailLog
         ]);
     }

     public function update(Request $request){
        $detailLog = DetailLog::find($request['id']);
        $detailLog->observations=$request['observations'];
        $detailLog->save();
        return response()->json([
            'status' => 'success',
            'msg'    => 'Registro detallado actualizado',
            'data'   =>  $detailLog
        ]);

    }


      

    public function get(){
        $detailLog = DetailLog::all();
        return response()->json([
            'status' => 'success',
            'msg' => 'Registros obtenidos correctamente',
            'data' => $detailLog
        ]);
    }

}
