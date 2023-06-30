<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StoresExitDetails;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class StoreExitDetailsController extends Controller
{
    //Crear registro de detalle de salida de Almacen
    public function create(Request $request){
     
        try{
            foreach($request->all() as $exit){
                $exitStoreDetail = StoresExitDetails::create(
                    $exit
                );
            }

            return response()->json([
                'status' => 'success',
                'msg' => 'Registro de detalle de salida de Almacén',
                'data' =>  $exitStoreDetail
            ]);
        }
        catch (\Exception $e) {
            $error_code = $e->getMessage();
            return response()->json([
                'msg' => ' Error al crear el registro',
                'data' => $error_code
            ]);
           
        }
     }
}
