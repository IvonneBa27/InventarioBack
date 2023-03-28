<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoModulo;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\catTipoModuloPostRequest;

class catTipoModuloController extends Controller
{
    //


    public function create(catTipoModuloPostRequest $request){


        $tipomodulo = TipoModulo::create([
            'name'=>$request['name'],
            'status'=>$request['status'],
            
        ]);
         return response()->json([
             'status' => 'success',
             'msg' => 'Tipo módulo agregado',
             'data' => $tipomodulo
         ]);
     }


     public function get(){
        $tipomodulo = TipoModulo::where('status','=',1)->get();
        
        return response()->json([
            'status' => 'success',
            'msg' => 'Tipos de módulos obtenidos correctamente',
            'data' => $tipomodulo
        ]);
    }


    public function getById(Request $request){  
        $id = $request->get('id'); 
        $tipomodulo = TipoModulo::find($id);
        
        return response()->json([
            'status' => 'success',
            'msg' => 'Tipo de módulo por id obtenido correctamente',
            'data' => $tipomodulo
        ]);
    }

      public function update(Request $request){
        
        $tipomodulo = TipoModulo::find($request['id']);   
        $tipomodulo->name=$request['name'];
        $tipomodulo->status=$request['status'];
        $tipomodulo->save();
        return response()->json([
            'status' => 'success',
            'msg' => 'Tipo módulo actualizado',
            'data' => $tipomodulo
        ]);

     }

     public function delete(Request $request){
        $id = $request->get('id');
        $tipomodulo=TipoModulo::find($id);
        $tipomodulo->status=2;
        $tipomodulo->save();

         return response()->json([
             'status' => 'success',
             'msg' => 'Tipo módulo eliminado',
             'data' => $tipomodulo
         ]);
     }

}
