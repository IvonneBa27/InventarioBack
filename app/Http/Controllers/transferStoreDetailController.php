<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\transferStoreDetail;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\transferStoreDetailPostRequest;
use Illuminate\Support\Facades\DB;

class transferStoreDetailController extends Controller
{


     public function create(transferStoreDetailPostRequest $request){
     
        try{
            foreach($request->all() as $transfer){
                $transferStoreDetail = transferStoreDetail::create(
                    $transfer
                );
            }

            return response()->json([
                'status' => 'success',
                'msg' => 'Almacen agregado',
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

        /*$transferStoreDetail = transferStoreDetail::create([
            'id_transfer_store'=>$request['id_transfer_store'],
            'product_id'=>$request['product_id'],
            'product_name'=>$request['product_name'],
            'brand_name'=>$request['brand_name'],
            'sku'=>$request['sku'],
            'serial_number'=>$request['serial_number'],
            'id_det'=>$request['id_det'],
        ]);
         return response()->json([
             'status' => 'success',
             'msg' => 'Almacen agregado',
             'data' =>  $transferStoreDetail
         ]);*/
     }


}
