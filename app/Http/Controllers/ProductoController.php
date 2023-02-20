<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Http\Requests\ProductoPostRequest;

class ProductoController extends Controller
{
    //Crear datos en la tabla Productos
    public function create(ProductoPostRequest $request){


        $producto = Producto::create([
            'idtipoProducto'=>$validatedData['idtipoProducto'],
            'sku'=>$validatedData['sku'],
            'serial'=>$validatedData['serial'],
            'idMarca'=>$validatedData['idMarca'],
            'modelo'=>$validatedData['modelo'],
            'skunum'=>$validatedData['skunum'],
            'descripcion'=>$validatedData['descripcion'],
            'foto'=>$validatedData['foto'],
            'inventariable'=>$validatedData['inventariable'],
        ]);
         return response()->json([
             'status' => 'success',
             'msg' => 'Producto agregado',
             'data' => $producto
         ]);


     }

     //Metodo para visualizar los datos de la tabla producto
       public function get(){
        $producto = Producto::all();
        return response()->json([
            'status' => 'success',
            'msg' => 'Productos obtenidos correctamente',
            'data' => $producto
        ]);
    }


    //Metodo para actualizar los datos de la tabla producto
    //un campo serial
     public function update(Request $request){
        $producto = Producto::find($request['id']);  //Get parametro por metodo post    
        $producto->serial=$request['serial'];
        $producto->modelo=$request['modelo'];
        $producto->skunum=$request['skunum'];
        $producto->descripcion=$request['descripcion'];
        $producto->foto=$request['foto'];
        $producto->inventariable=$request['inventariable'];
        $producto->save();
        return response()->json([
            'status' => 'success',
            'msg' => 'Producto actualizado',
            'data' => $producto
        ]);


     }


      public function delete(Request $request){
        $id = $request->get('id');
        $producto=Producto::find($id);
        $producto->delete();
         return response()->json([
             'status' => 'success',
             'msg' => 'Producto eliminado',
             'data' => $producto
         ]);
     }

}
