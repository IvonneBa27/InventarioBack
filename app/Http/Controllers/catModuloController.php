<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\catModulo;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\catModuloPostRequest;

class catModuloController extends Controller
{
    //

    public function create(catModuloPostRequest $request){


        $modulo = catModulo::create([
            'name'=>$request['name'],
            'id_type'=>$request['id_type'],
            'order'=>$request['order'],
            'status'=>$request['status'],
            
        ]);
         return response()->json([
             'status' => 'success',
             'msg' => 'Modulo agregado',
             'data' => $modulo
         ]);
     }


     public function get(){
        $modulo = catModulo::where('status','=',1)->get();
        
        return response()->json([
            'status' => 'success',
            'msg' => 'Modulos obtenidos correctamente',
            'data' => $modulo
        ]);
    }


    public function getById(Request $request){  
        $id = $request->get('id'); 
        $modulo = catModulo::find($id);
        
        return response()->json([
            'status' => 'success',
            'msg' => 'Modulo por id obtenido correctamente',
            'data' => $modulo
        ]);
    }

      public function update(Request $request){
        
        $modulo = catModulo::find($request['id']);   
       $modulo->name=$request['name'];
        $modulo->id_type=$request['id_type'];
        $modulo->order=$request['order'];
        $modulo->status=$request['status'];

        $modulo->save();
        return response()->json([
            'status' => 'success',
            'msg' => 'Modulo actualizado',
            'data' => $modulo
        ]);

     }

     public function delete(Request $request){
        $id = $request->get('id');
        $modulo=catModulo::find($id);
        $modulo->status=2;
        $modulo->save();

         return response()->json([
             'status' => 'success',
             'msg' => 'Modelo eliminado',
             'data' => $modulo
         ]);
     }


}
