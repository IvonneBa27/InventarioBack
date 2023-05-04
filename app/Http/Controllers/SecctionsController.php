<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\secctions;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\SecctionsPostRequest;
use Illuminate\Support\Facades\DB;

class SecctionsController extends Controller
{
    public function create(SecctionsPostRequest $request){

        $secctions = Secctions::create([
            'name'=>$request['name'],
            'id_status'=>$request['id_status'],
            'id_store'=>$request['id_store'],
            'nomenclature'=>$request['nomenclature'],
        ]);
         return response()->json([
             'status' => 'success',
             'msg' => 'Seccion agregado',
             'data' => $secctions
         ]);
     }


     public function get(){
        $secctions = Secctions::all();
        return response()->json([
            'status' => 'success',
            'msg' => 'Secciones obtenidoss correctamente',
            'data' => $secctions
        ]);
    }

    public function getByIdStore(Request $request){  
        $id = $request->get('id'); 
        $secctions = Secctions::where('id_store', '=',$id)->get();
    
        
        return response()->json([
            'status' => 'success',
            'msg' => 'Almacen por id  de Seccion obtenido correctamente',
            'data' => $secctions
        ]);
    }



    public function getById(Request $request){  
        $id = $request->get('id'); 
        $secctions = Secctions::find($id);
        
        return response()->json([
            'status' => 'success',
            'msg' => 'Seccion obtenido por Id obtenido correctamente',
            'data' => $secctions
        ]);
    }


    public function update(Request $request){
        $secctions = Secctions::find($request['id']);  //Get parametro por metodo post    
        $secctions->name=$request['name'];
        $secctions->id_store=$request['id_store'];
        $secctions->nomenclature=$request['nomenclature'];
        $secctions->save();
        return response()->json([
            'status' => 'success',
            'msg'    => 'Seccion actualizado',
            'data'   => $secctions
        ]);
     }

     public function delete(Request $request){
        $id = $request->get('id');
        $secctions = Secctions::find($id);
        $secctions->id_status=2;
        $secctions->save();
        
         return response()->json([
             'status' => 'success',
             'msg'  => 'Seccion eliminado',
             'data' =>   $secctions
         ]);
     }
}