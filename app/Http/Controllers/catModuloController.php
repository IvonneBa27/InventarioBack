<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\catModulo;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\catModuloPostRequest;
use Illuminate\Support\Facades\DB;

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
             'msg' => 'Módulo agregado',
             'data' => $modulo
         ]);
     }


     public function get(){
        $modulo = catModulo::where('status','=',1)->get();
        
        return response()->json([
            'status' => 'success',
            'msg' => 'Módulos obtenidos correctamente',
            'data' => $modulo
        ]);
    }

    // Listas de Modulos 
    public function get_ListCatModules(){
        $modulo  = DB::SELECT('CALL get_list_modules()');
        return response()->json([
            'status' => 'success',
            'msg' => 'Lista de Modulos',
            'data' =>   $modulo 
        ]);
    }


    public function getById(Request $request){  
        $id = $request->get('id'); 
        $modulo = catModulo::find($id);
        
        return response()->json([
            'status' => 'success',
            'msg' => 'Módulo por id obtenido correctamente',
            'data' => $modulo
        ]);
    }

      public function update(Request $request){
        
        $modulo = catModulo::find($request['id']);   
        $modulo->name=$request['name'];
        $modulo->id_type=$request['id_type'];
       // $modulo->order=$request['order'];
        $modulo->status=$request['status'];

        $modulo->save();
        return response()->json([
            'status' => 'success',
            'msg' => 'Módulo actualizado',
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
             'msg' => 'Módulo eliminado',
             'data' => $modulo
         ]);
     }


}
