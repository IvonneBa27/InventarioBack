<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Http\Requests\UserPostRequest;

class UsuarioController extends Controller
{
    //
     public function create(UserPostRequest $request){

     
        $usuario = Usuario::create([
            'idtipoUsuario'=>$validatedData['idtipoUsuario'],
            'usuario'=>$validatedData['usuario'],
            'nombre'=>$validatedData['nombre'],
            'apaterno'=>$validatedData['apaterno'],
            'amaterno'=>$validatedData['amaterno'],
            'email'=>$validatedData['email'],
            'password'=>$validatedData['password'],
           
        ]);
         return response()->json([
             'status' => 'success',
             'msg' => 'Usuario agregado',
             'data' => $usuario
         ]);


     }


         public function get(){
        $usuario = Usuario::all();
        return response()->json([
            'status' => 'success',
            'msg' => 'Usuarios obtenidos correctamente',
            'data' => $usuario
        ]);
    }


    public function getById(Request $request){  
        $id = $request->get('id'); // Metodo por GET
        $usuario = Usuario::find($id);
        
        return response()->json([
            'status' => 'success',
            'msg' => 'Permisos obtenidos correctamente',
            'data' => $usuario
        ]);
    }

      public function update(Request $request){
        $usuario = Usuario::find($request['id']);  //Get parametro por metodo post    
        $usuario->usuario=$request['usuario'];
        $usuario->nombre=$request['nombre'];
        $usuario->apaterno=$request['apaterno'];
        $usuario->amaterno=$request['amaterno'];
        $usuario->password=$request['password'];
        $usuario->save();
        return response()->json([
            'status' => 'success',
            'msg' => 'Usuario actualizado',
            'data' => $usuario
        ]);


     }

     public function delete(Request $request){
        $id = $request->get('id');
        $usuario=Usuario::find($id);
        $usuario->delete();
         return response()->json([
             'status' => 'success',
             'msg' => 'Usuario eliminado',
             'data' => $usuario
         ]);
     }


}
