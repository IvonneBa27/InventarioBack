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
            'observation'=>$request['observation'],
            'id_status'=>$request['id_status'],
            'amount'=>$request['amount'],
            'total_received'=>$request['total_received'],         
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
        $transferStore->observation=$request['observation'];
        $transferStore->save();
        return response()->json([
            'status' => 'success',
            'msg'    => 'Registro detallado actualizado',
            'data'   =>  $transferStore
        ]);

    }





     
}
