<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StoresExit;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateStoreExitRequest;

class StoreExitController extends Controller
{
    
    //Crear registro de Salida de Almacen
    public function create(CreateStoreExitRequest $request){
        $exitStore = StoresExit::create([
            'store_origin_id'=>$request['store_origin_id'],
            'section_origin_id'=>$request['section_origin_id'],
            'id_type_exit'=>$request['id_type_exit'],
            'user_id'=>$request['user_id'],
            'authorized_id'=>$request['authorized_id'],
            'person_who_receives'=>$request['person_who_receives'],
            'category_id'=>$request['category_id'],
            'subcategory_id'=>$request['subcategory_id'],
            'brand_id'=>$request['brand_id'],
        ]);

        return response()->json([
            'status' => 'success',
            'msg' => 'Registro de salida de Almacén',
            'data' => $exitStore
        ]);

    }

    //Visualizacion de registro de salida por Id
    public function getById(Request $request){  
        $id = $request->get('id'); 
        $exitStore = StoresExit::find($id);
        
        return response()->json([
            'status' => 'success',
            'msg' => 'Salida de Almacén por Id obtenido correctamente',
            'data' =>  $exitStore
        ]);
    }


    //Actualizacion de registro por Id
    public function update(Request $request){
        $exitStore = StoresExit::find($request['id']);
        $exitStore->amount=$request['amount'];
        $exitStore->total_received=$request['total_received'];
        $exitStore->id_status=$request['id_status'];
        $exitStore->observations=$request['observations'];
        $exitStore->save();
        return response()->json([
            'status' => 'success',
            'msg'    => 'Registro de salida de Almacen actualizdo',
            'data'   =>  $exitStore
        ]);

    }
}
