<?php

namespace App\Http\Controllers;
use App\Models\movementHistory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class movementHistoryController extends Controller
{
     
    public function create_Kardex_Income(Request $request){  
        $id = $request->get('id'); 
        $movementHistory  = DB::SELECT('CALL createIncomeHistory(?)', [$id]);
        return response()->json([
            'status' => 'success',
            'msg' => 'Crear Movimiento de Ingreso',
            'data' =>  $movementHistory
        ]);   
    }

    public function create_Kardex_Transfer(Request $request){  
        $id = $request->get('id'); 
        $movementHistory  = DB::SELECT('CALL createTransferHistory(?)', [$id]);
        return response()->json([
            'status' => 'success',
            'msg' => 'Crear Movimiento de Traspaso',
            'data' =>  $movementHistory
        ]);   
    }

    public function create_Kardex_Exit(Request $request){  
        $id = $request->get('id'); 
        $movementHistory  = DB::SELECT('CALL createExitHistory(?)', [$id]);
        return response()->json([
            'status' => 'success',
            'msg' => 'Crear Movimiento de Salida',
            'data' =>  $movementHistory
        ]);   
    }

    public function get(Request $request){
        $movementHistory = DB::SELECT('CALL get_list_kardex()');
        return response()->json([
            'status' => 'success',
            'msg' => 'Lista de movimientos',
            'data' => $movementHistory
        ]);
     }


     public function searchKardexT(Request $request){
        $serial_number = $request->get('serial_number');

        $movementHistory  = DB::SELECT('CALL get_searchKardex(?)', [$serial_number]);
        return response()->json([
            'status' => 'success',
            'msg' => 'Lista de movimientos Kardex',
            'data' =>  $movementHistory
        ]);   

     
    }


    

        
}
