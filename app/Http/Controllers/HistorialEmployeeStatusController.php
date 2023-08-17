<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HistorialEmployeeStatus;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\HistorialEmployeeStatusRequest;

class HistorialEmployeeStatusController extends Controller
{
    //
    public function create(HistorialEmployeeStatusRequest $request){
        $historialStatus = HistorialEmployeeStatus::create([
            'user_id'=>$request['user_id'],
            'employeed_id'=>$request['employeed_id'],
            'status_id'=>$request['status_id'],
            'reason_id'=>$request['reason_id'],
            'cause_id'=>$request['cause_id'],
            'date'=>$request['date'],
        ]);
        return response()->json([
            'status' => 'success',
            'msg' => 'Historico agregado',
            'data' => $historialStatus
        ]);

    }
}
