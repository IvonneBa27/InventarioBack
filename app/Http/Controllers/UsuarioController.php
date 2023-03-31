<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\ModulePermisse;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserPostRequest;
use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
{
    //
     public function create(UserPostRequest $request){

     
        $usuario = Usuario::create([
            'id_tipo_usuario'=>$request['id_tipo_usuario'],
            'usuario'=>$request['usuario'],
            'nombre'=>$request['nombre'],
            'apellido_pat'=>$request['apellido_pat'],
            'apellido_mat'=>$request['apellido_mat'],
            'id_ubicacion'=>$request['id_ubicacion'],
            'id_empresa_rh'=>$request['id_empresa_rh'],
            'email_personal'=>$request['email_personal'],
            'email'=>$request['email'],
            'password' => Hash::make($request['password']),
            /*'password'=>$request['password'],*/
            'numero_empleado'=>$request['numero_empleado'],
            'nombre_completo'=>$request['nombre_completo'],
            'curp'=>$request['curp'],
            'rfc'=>$request['rfc'],
            'nss'=>$request['nss'],
            'id_sexo'=>$request['id_sexo'],
            'id_subcategoria'=>$request['id_subcategoria'],
            /*'id_domicilo'=>$request['id_domicilo'],*/
            'ejecucion_administrativa:'=>$request['ejecucion_administrativa:'],
            /*'id_compania'=>$request['id_compania'],*/
            /*'ola'=>$request['ola'],*/
            'id_puesto'=>$request['id_puesto'],
            'sueldo'=>$request['sueldo'],
            'id_banco'=>$request['id_banco'],
            'numero_cuenta_bancaria'=>$request['numero_cuenta_bancaria'],
            'clabe_inter_bancaria'=>$request['clabe_inter_bancaria'],
            'fecha_ingreso'=>$request['fecha_ingreso'],
            /*'fecha_contrato'=>$request['fecha_contrato'],*/
            'fecha_nacimiento'=>$request['fecha_nacimiento'],
            'id_departamento_empresa'=>$request['id_departamento_empresa'],
            'id_estatus'=>$request['id_estatus'],
            'id_turno'=>$request['id_turno'],
            /*'fecha_baja'=>$request['fecha_baja'],
            'motivo_baja'=>$request['motivo_baja'],
            'mes_baja'=>$request['mes_baja'],
            'fecha_inicio_capacitacion'=>$request['fecha_inicio_capacitacion'],
            'fecha_fin_capacitacion'=>$request['fecha_fin_capacitacion'],*/
            'img_profile'=>$request['img_profile'],

        ]);
         return response()->json([
             'status' => 'success',
             'msg' => 'Usuario agregado',
             'data' => $usuario
         ]);


     }


    public function getOrderBy(){
        $usuario = Usuario::where('id_estatus','=',1)->orderBy('nombre_completo','asc')->get();
        
        return response()->json([
            'status' => 'success',
            'msg' => 'Usuarios obtenidos correctamente',
            'data' => $usuario
        ]);


    }

    public function get(){
        $usuario = Usuario::where('id_estatus','=',1)->get();
        
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
            'msg' => 'Usuario por id obtenido correctamente',
            'data' => $usuario
        ]);
    }

      public function update(Request $request){
        $usuario = Usuario::find($request['id']);  //Get parametro por metodo post    
        $usuario->id_tipo_usuario=$request['id_tipo_usuario'];
        $usuario->usuario=$request['usuario'];
        $usuario->nombre=$request['nombre'];
        $usuario->apellido_pat=$request['apellido_pat'];
        $usuario->apellido_mat=$request['apellido_mat'];
        $usuario->id_ubicacion=$request['id_ubicacion'];
        $usuario->id_empresa_rh=$request['id_empresa_rh'];
        $usuario->email_personal=$request['email_personal'];
        $usuario->email=$request['email'];
        /*$usuario->nombre_completo=$request['nombre_completo'];*/
        $usuario->curp=$request['curp'];
        $usuario->rfc=$request['rfc'];
        $usuario->nss=$request['nss'];
        $usuario->id_sexo=$request['id_sexo'];
        $usuario->id_subcategoria=$request['id_subcategoria'];
        $usuario->ejecucion_administrativa=$request['ejecucion_administrativa'];
       /* $usuario->ola=$request['ola'];*/
        $usuario->id_puesto=$request['id_puesto'];
        $usuario->sueldo=$request['sueldo'];
        $usuario->id_banco=$request['id_banco'];
        $usuario->numero_cuenta_bancaria=$request['numero_cuenta_bancaria'];
        $usuario->clabe_inter_bancaria=$request['clabe_inter_bancaria'];
        $usuario->fecha_ingreso=$request['fecha_ingreso'];
       /* $usuario->fecha_contrato=$request['fecha_contrato'];*/
        $usuario->fecha_nacimiento=$request['fecha_nacimiento'];
        $usuario->id_estatus=$request['id_estatus'];
        $usuario->id_departamento_empresa=$request['id_departamento_empresa'];
        $usuario->id_turno=$request['id_turno'];
        /*$usuario->fecha_baja=$request['fecha_baja'];
        $usuario->motivo_baja=$request['motivo_baja'];
        $usuario->mes_baja=$request['mes_baja'];
        $usuario->fecha_inicio_capacitacion=$request['fecha_inicio_capacitacion'];
        $usuario->fecha_fin_capacitacion=$request['fecha_fin_capacitacion'];*/
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
        $usuario->id_estatus=2;
        $usuario->fecha_baja=$request['fecha_baja'];
        $usuario->motivo_baja=$request['motivo_baja'];
        $usuario->mes_baja=$request['mes_baja'];
        $usuario->save();
        /*$usuario->delete();*/
         return response()->json([
             'status' => 'success',
             'msg' => 'Usuario eliminado',
             'data' => $usuario
         ]);
     }


     public function getModuleUser( Request $request){
        $id = $request->get('id');
        $id_module = $request->get('id_module');

        $modules
        = DB::table('users')
        ->select('users.id as user_id', 'module_permisses.*', 'cat_modues.name')
        ->join('module_permisses', 'users.id', '=', 'module_permisses.id_usuario')
        ->join('cat_modues', 'module_permisses.id_modulo', '=', 'cat_modues.id')
        ->where('module_permisses.id_usuario', '=', $id)
        ->where('module_permisses.id_modulo', '=', $id_module)
        ->get();
        return response()->json([
            'status' => 'success',
            'msg' => 'Modulos Obtenidos.',
            'data' => $modules
        ]);
     }


    public function getModuleUserById(Request $request)
    {
        $id = $request->get('id');

        $modules
        = DB::table('users')
            ->select('users.id as user_id', 'module_permisses.*', 'cat_modues.name')
            ->join('module_permisses', 'users.id', '=', 'module_permisses.id_usuario')
            ->join('cat_modues', 'module_permisses.id_modulo', '=', 'cat_modues.id')
            ->where('module_permisses.id_usuario', '=', $id)
            ->get();
        return response()->json([
            'status' => 'success',
            'msg' => 'Modulos Obtenidos.',
            'data' => $modules
        ]);
    }

    public function addPermisse( Request $request){

        try {
            foreach ($request->all() as $mod) {

                $modexist = ModulePermisse::where('id_modulo', '=', $mod['id_modulo'])->where('id_usuario', '=', $mod['id_usuario'])->delete();

                
                // if($modexist->isNotEmpty()){
                //     return response()->json([
                //         'status' => 'success',
                //         'msg' => 'Permisos guardados correctamente.',
                //         'data' => $modexist
                //     ]);
                //     $modexist->delete();
                // }

                
                $module = ModulePermisse::create(
                    $mod
                );

            }

        } catch (\Exception $e) {
            $error_code = $e->getMessage();
            return response()->json([
                'msg' => ' Error al crear el registro',
                'data' => $error_code
            ]);
           
        }



        return response()->json([
            'status' => 'success',
            'msg' => 'Permisos guardados correctamente.',
            'data' => $modexist
        ]);

        

    }


}
