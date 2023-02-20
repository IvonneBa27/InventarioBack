<?php

namespace App\Http\Controllers;
use App\Models\catPermiso;

use Illuminate\Http\Request;

class CatPermisoController extends Controller
{
    //
    //Obtener todos los registros
    public function get(){
        $permiso = catPermiso::all();
        return response()->json([
            'status' => 'success',
            'msg' => 'Permisos obtenidos correctamente',
            'data' => $permiso
        ]);
    }
    public function getById(Request $request){  
        $id = $request->get('id'); // Metodo por GET
        $permiso = catPermiso::find($id);
        //$permiso = catPermiso::where('permiso', '=', 'Actualizacion')->get();
        return response()->json([
            'status' => 'success',
            'msg' => 'Permisos obtenidos correctamente',
            'data' => $permiso
        ]);
    }

    public function create(Request $request){

        $validatedData = $request->validate([
            'permiso' => 'required|string|max:50',
        ]);
    
         $permiso = catPermiso::create(['permiso'=>$validatedData['permiso']]);
         return response()->json([
             'status' => 'success',
             'msg' => 'Permisos obtenidos correctamente',
             'data' => $permiso
         ]);


     }

     public function delete(Request $request){
        $id = $request->get('id');
        $permiso=catPermiso::find($id);
        $permiso->delete();
         return response()->json([
             'status' => 'success',
             'msg' => 'Permiso eliminado',
             'data' => $permiso
         ]);
     }


     public function update(Request $request){
        $permiso = catPermiso::find($request['id']);  //Get parametro por metodo post    
        $permiso->permiso=$request['permiso'];
        $permiso->save();
        return response()->json([
            'status' => 'success',
            'msg' => 'Permiso actualizado',
            'data' => $permiso
        ]);

     }

}
