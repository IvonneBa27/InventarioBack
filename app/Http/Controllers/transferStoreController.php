<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\transferStore;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\transferStorePostRequest;
use Illuminate\Support\Facades\DB;

class transferStoreController extends Controller
{
    //
    public function create(transferStorePostRequest $request){
        $transferStore = transferStore::create([
            'store_origin_id'=>$request['store_origin_id'],
            'section_origin_id'=>$request['section_origin_id'],
            'store_destiny_id'=>$request['store_destiny_id'],
            'section_destiny_id'=>$request['section_destiny_id'],
            'category_id'=>$request['category_id'],
            'subcategory_id'=>$request['subcategory_id'],
            'brand_id'=>$request['brand_id'],
            'user_id'=>$request['user_id'],
            'income_id'=>$request['income_id'],
            'product_id'=>$request['product_id'],
             
        ]);
         return response()->json([
             'status' => 'success',
             'msg' => 'Traspaso agregado',
             'data' => $transferStore
         ]);
     }


     public function get(){
        $transferStore = transferStore::all();
        return response()->json([
            'status' => 'success',
            'msg' => 'Traspaso obtenido correctamente',
            'data' => $transferStore
        ]);
     }

     public function getById(Request $request){  
        $id = $request->get('id'); 
        $transferStore = transferStore::find($id);
        
        return response()->json([
            'status' => 'success',
            'msg' => 'Traspaso obtenido por Id correctamente',
            'data' =>  $transferStore
        ]);
    }

    public function update(Request $request){
        $transferStore = transferStore::find($request['id']);
        $transferStore->amount=$request['amount'];
        $transferStore->total_received=$request['total_received'];
        $transferStore->id_status=$request['id_status'];
        $transferStore->observation=$request['observation'];
        $transferStore->save();
        return response()->json([
            'status' => 'success',
            'msg'    => 'Registro detallado actualizado',
            'data'   =>  $transferStore
        ]);

    }

    public function updateCancelled(Request $request){
        $id = $request->get('id');
        $transferStore = transferStore::find($id);
        $transferStore->id_status=6;
        $transferStore->user_id=$request['user_id'];
        $transferStore->save();
        
         return response()->json([
             'status' => 'success',
             'msg'  => 'Registro cancelado',
             'data' => $transferStore
         ]);

    }


      //Lista de Almacen por ingreso de Almacen 
      public function getListTransferStore(){
        $transferStore = DB::SELECT('CALL get_list_transfer_store()');
        return response()->json([
            'status' => 'success',
            'msg' => 'Lista de Traspasos de Almacen',
            'data' => $transferStore
        ]);
     }


    // Listas de
    public function getListTransfer(Request $request){  
        $store_destiny_id = $request->get('store_destiny_id'); 
        $transferStore  = DB::SELECT('CALL get_list_transfer(?)', [$store_destiny_id]);
        return response()->json([
            'status' => 'success',
            'msg' => 'Lista de Ingresos de Almacen',
            'data' => $transferStore
        ]);
    }

    public function updateAmount(Request $request){
        $transferStore =  transferStore::find($request['id']);
        $transferStore->total_received=$request['total_received'];
        $transferStore->save();
        return response()->json([
            'status' => 'success',
            'msg'    => 'Monto actualizado',
            'data'   =>   $transferStore
        ]);

    }





     
}
