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
        $transferStoreDetail = transferStore::create([
            'id_transfer_store'=>$request['id_transfer_store'],
            'product_id'=>$request['product_id'],
            'product_name'=>$request['product_name'],
            'brand_name'=>$request['brand_name'],
            'model_name'=>$request['model_name'],
            'sku'=>$request['sku'],
            'serial_number'=>$request['serial_number'],
            'id_det'=>$request['id_det'],
                    
        ]);
         return response()->json([
             'status' => 'success',
             'msg' => 'Traspaso agregado',
             'data' => $transferStoreDetail
         ]);
     }

     public function get(){
        $transferStoreDetail = transferStoreDetail::all();
        return response()->json([
            'status' => 'success',
            'msg' => 'Traspaso obtenido correctamente',
            'data' => $transferStoreDetail
        ]);

     }

     public function getById(Request $request){  
        $id = $request->get('id'); 
        $transferStoreDetail = transferStoreDetail::find($id);
        
        return response()->json([
            'status' => 'success',
            'msg' => 'Traspaso obtenido por Id correctamente',
            'data' => $transferStoreDetail
        ]);
    }
}
