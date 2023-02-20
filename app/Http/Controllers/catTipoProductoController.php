<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\catTipoProducto;
use App\Http\Requests\TipoProductoPostRequest;


class catTipoProductoController extends Controller
{
    //
    public function create(TipoProductoPostRequest $request){

      
        $tipproducto = catTipoProducto::create([
            'tipoproducto'=>$validatedData['tipoproducto'],
  
        ]);
         return response()->json([
             'status' => 'success',
             'msg' => 'Tipo de producto agregado',
             'data' => $tipproducto
         ]);

     }

     
     //Metodo para visualizar los datos de la tabla tipo de producto
     public function get(){
        $tipproducto = catTipoProducto::all();
        return response()->json([
            'status' => 'success',
            'msg' => 'Tipo de Productos obtenidos correctamente',
            'data' => $tipproducto
        ]);
    }


      //Metodo para actualizar los datos de la tabla producto

    public function update(Request $request){
        $tipproducto = catTipoProducto::find($request['id']);  //Get parametro por metodo post    
        $tipproducto->tipoproducto=$request['tipoproducto'];
        $tipproducto->save();
        return response()->json([
            'status' => 'success',
            'msg' => 'Tipo producto actualizado',
            'data' => $tipproducto
        ]);
     }

     public function delete(Request $request){
        $id = $request->get('id');
        $tipproducto=catTipoProducto::find($id);
        $tipproducto->delete();
         return response()->json([
             'status' => 'success',
             'msg' => 'Tipo producto eliminado',
             'data' => $tipproducto
         ]);
     }

}
