<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\transferStoreDetail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class transferStoreDetailController extends Controller
{


     public function create(Request $request){
     
        try{
            foreach($request->all() as $transfer){
                $transferStoreDetail = transferStoreDetail::create(
                    $transfer
                );
            }

            return response()->json([
                'status' => 'success',
                'msg' => 'Registro de detalle traspaso de Almacén',
                'data' =>  $transferStoreDetail
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
