<?php

namespace App\Http\Controllers;
use App\Models\catMarca;

use Illuminate\Http\Request;
use App\Http\Requests\TipoMarcaPostRequest;

class catTipoMarcaController extends Controller
{
    //

    public function create(TipoMarcaPostRequest $request){


        $marca = catMarca::create([
            'marca'=>$validatedData['marca'],
  
        ]);
         return response()->json([
             'status' => 'success',
             'msg' => 'Tipo de marca agregado',
             'data' => $marca
         ]);

     }


       //Metodo para visualizar los datos de la tabla tipo de producto
       public function get(){
        $marca = catMarca::all();
        return response()->json([
            'status' => 'success',
            'msg' => 'Tipo de Marca obtenidos correctamente',
            'data' => $marca
        ]);
    }

    public function update(Request $request){
        $marca = catMarca::find($request['id']);  //Get parametro por metodo post    
        $marca->marca=$request['marca'];
        $marca->save();
        return response()->json([
            'status' => 'success',
            'msg' => 'Tipo marca actualizado',
            'data' => $marca
        ]);
     }

     public function delete(Request $request){
        $id = $request->get('id');
        $marca=catMarca::find($id);
        $marca->delete();
         return response()->json([
             'status' => 'success',
             'msg' => 'Tipo marca eliminado',
             'data' => $marca
         ]);
     }
}
