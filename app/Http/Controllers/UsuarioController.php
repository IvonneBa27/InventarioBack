<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\ModulePermisse;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserPostRequest;
use Illuminate\Support\Facades\DB;
use App\Models\SectionsPermissions;

class UsuarioController extends Controller
{
    //
    public function create(UserPostRequest $request)
    {


        $usuario = Usuario::create([
            'id_tipo_usuario' => $request['id_tipo_usuario'],
            'usuario' => $request['usuario'],
            'nombre' => $request['nombre'],
            'apellido_pat' => $request['apellido_pat'],
            'apellido_mat' => $request['apellido_mat'],
            'id_ubicacion' => $request['id_ubicacion'],
            'id_empresa_rh' => $request['id_empresa_rh'],
            'email_personal' => $request['email_personal'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'numero_empleado' => $request['numero_empleado'],
            'nombre_completo' => $request['nombre_completo'],
            'curp' => $request['curp'],
            'rfc' => $request['rfc'],
            'nss' => $request['nss'],
            'id_sexo' => $request['id_sexo'],
            'id_subcategoria' => $request['id_subcategoria'],
            'ejecucion_administrativa:' => $request['ejecucion_administrativa:'],

            'id_puesto' => $request['id_puesto'],
            'sueldo' => $request['sueldo'],
            'id_banco' => $request['id_banco'],
            'numero_cuenta_bancaria' => $request['numero_cuenta_bancaria'],
            'clabe_inter_bancaria' => $request['clabe_inter_bancaria'],
            'fecha_ingreso' => $request['fecha_ingreso'],
            'fecha_nacimiento' => $request['fecha_nacimiento'],
            'id_departamento_empresa' => $request['id_departamento_empresa'],
            'id_estatus' => $request['id_estatus'],
            'id_turno' => $request['id_turno'],

            'img_profile' => $request['img_profile'],

        ]);
        return response()->json([
            'status' => 'success',
            'msg' => 'Usuario agregado',
            'data' => $usuario
        ]);
    }


    public function getOrderBy()
    {
        $usuario = Usuario::where('id_estatus', '=', 1)->orderBy('nombre_completo', 'asc')->get();

        return response()->json([
            'status' => 'success',
            'msg' => 'Usuarios obtenidos correctamente',
            'data' => $usuario
        ]);
    }

    public function get()
    {

        $usuario = Usuario::where('id_estatus', '=', 1)->get();

        return response()->json([
            'status' => 'success',
            'msg' => 'Usuarios obtenidos correctamente',
            'data' => $usuario

        ]);
    }

    public function getUserExcel(){
        $usuario = DB::table('users')
                    ->select('users.numero_empleado as NUMERO_EMPLEADO', 'users.nombre_completo as NOMBRE_COMPLETO', 'users.curp as CURP', 'company_structure_type.nombre as EJECUCION_ADMINISTRATIVA', 'company_department.nombre as ESTRUCTURA', 'catalog_company_position.nombre as PUESTO', 'users.sueldo as SUELDO', 'users.fecha_ingreso as FECHA_INGRESO', 'users.rfc as RFC', 'users.nss as NSS', 'users.fecha_nacimiento as FECHA_NACIMIENTO', 'gender.nombre as SEXO', 'users.email_personal as CORREO_ELECTRONICO_PERSONAL', 'users.email as CORREO_ELECTRONICO_LABORAL', 'users.fecha_pago as FECHA_PAGO', 'companies_payment.nombre as EMPRESA', 'status.nombre as ESTATUS', 'ubicaciones.nombre as UBICACIÓN', 'type_schedule.nombre as TURNO')
                    ->join('company_structure_type','users.ejecucion_administrativa','=','company_structure_type.id')
                    ->join('company_department','users.id_departamento_empresa','=','company_department.id')
                    ->join('catalog_company_position','users.id_puesto','=','catalog_company_position.id')
                    ->join('gender','users.id_sexo','=','gender.id')
                    ->join('companies_payment','users.id_empresa_rh','=','companies_payment.id')
                    ->join('status','users.id_estatus','=','status.id')
                    ->join('ubicaciones','users.id_ubicacion','=','ubicaciones.id')
                    ->join('type_schedule','users.id_turno','=','type_schedule.id')
                    ->get();
            
            return response()->json([
                        'status' => 'success',
                        'msg' => 'Usuarios obtenidos correctamente',
                        'data' => $usuario
            
                    ]);
    }


    public function getStatus(Request $request)
    {
        $param = $request->get('param');
        $usuario = Usuario::where('id_estatus', '=', $param)->get();

        return response()->json([
            'status' => 'success',
            'msg' => 'Usuarios obtenidos correctamente',
            'data' => $usuario

        ]);
    }


    public function getById(Request $request)
    {
        $id = $request->get('id'); // Metodo por GET
        $usuario = Usuario::with('puesto')->find($id);

        return response()->json([
            'status' => 'success',
            'msg' => 'Usuario por id obtenido correctamente',
            'data' => $usuario
        ]);
    }

    public function update(Request $request)
    {
        $usuario = Usuario::find($request['id']);  //Get parametro por metodo post    
        $usuario->id_tipo_usuario = $request['id_tipo_usuario'];
        $usuario->usuario = $request['usuario'];
        $usuario->nombre = $request['nombre'];
        $usuario->apellido_pat = $request['apellido_pat'];
        $usuario->apellido_mat = $request['apellido_mat'];
        $usuario->id_ubicacion = $request['id_ubicacion'];
        $usuario->id_empresa_rh = $request['id_empresa_rh'];
        $usuario->email_personal = $request['email_personal'];
        $usuario->email = $request['email'];
        /*$usuario->nombre_completo=$request['nombre_completo'];*/
        $usuario->curp = $request['curp'];
        $usuario->rfc = $request['rfc'];
        $usuario->nss = $request['nss'];
        $usuario->id_sexo = $request['id_sexo'];
        $usuario->id_subcategoria = $request['id_subcategoria'];
        $usuario->ejecucion_administrativa = $request['ejecucion_administrativa'];
        /* $usuario->ola=$request['ola'];*/
        $usuario->id_puesto = $request['id_puesto'];
        $usuario->sueldo = $request['sueldo'];
        $usuario->id_banco = $request['id_banco'];
        $usuario->numero_cuenta_bancaria = $request['numero_cuenta_bancaria'];
        $usuario->clabe_inter_bancaria = $request['clabe_inter_bancaria'];
        $usuario->fecha_ingreso = $request['fecha_ingreso'];
        /* $usuario->fecha_contrato=$request['fecha_contrato'];*/
        $usuario->fecha_nacimiento = $request['fecha_nacimiento'];
        $usuario->id_estatus = $request['id_estatus'];
        $usuario->id_departamento_empresa = $request['id_departamento_empresa'];
        $usuario->id_turno = $request['id_turno'];
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

    public function delete(Request $request)
    {
        $id = $request->get('id');
        $usuario = Usuario::find($id);
        $usuario->id_estatus = 2;
        $usuario->fecha_baja = $request['fecha_baja'];
        $usuario->motivo_baja = $request['motivo_baja'];
        $usuario->mes_baja = $request['mes_baja'];
        $usuario->save();
        /*$usuario->delete();*/
        return response()->json([
            'status' => 'success',
            'msg' => 'Usuario eliminado',
            'data' => $usuario
        ]);
    }


    public function getModuleUser(Request $request)
    {
        $id = $request->get('id');
        $id_module = $request->get('id_module');

        $modules
            = DB::table('users')
            ->select('users.id as user_id', 'module_users_permissions.*', 'catalog_modules.name')
            ->join('module_users_permissions', 'users.id', '=', 'module_users_permissions.id_usuario')
            ->join('catalog_modules', 'module_users_permissions.id_modulo', '=', 'catalog_modules.id')
            ->where('module_users_permissions.id_usuario', '=', $id)
            ->where('module_users_permissions.id_modulo', '=', $id_module)
            ->get();
        return response()->json([
            'status' => 'success',
            'msg' => 'Modulos Obtenidos.',
            'data' => $modules
        ]);
    }

    public function getSectionUser(Request $request)
    {
        $id = $request->get('id');
        $id_module = $request->get('id_module');

        $modules
            = DB::table('users')
            ->select('sections_permissions.id_section', 'sections_permissions.show')
            ->join('sections_permissions','users.id','=','sections_permissions.id_user')
            ->join('catalog_sections','sections_permissions.id_section','=','catalog_sections.id')
            ->join('catalog_modules','catalog_modules.id','=','catalog_sections.id_parent')
            ->where('sections_permissions.id_user','=', $id)
            ->where('catalog_modules.id','=',$id_module)
            ->get();
        return response()->json([
            'status' => 'success',
            'msg' => 'Modulos Obtenidos.',
            'data' => $modules
        ]);
    }


    public function getModuleUserById(Request $request)
    {
        $id_usuario = $request->get('id');

        // $modules
        // = DB::table('users')
        //     ->select('users.id as user_id', 'module_users_permissions.*', 'catalog_modules.name')
        //     ->join('module_users_permissions', 'users.id', '=', 'module_users_permissions.id_usuario')
        //     ->join('catalog_modules', 'module_users_permissions.id_modulo', '=', 'catalog_modules.id')
        //     ->where('module_users_permissions.id_usuario', '=', $id)
        // ->get();

        $modules
        =
        DB::table('catalog_modules')
        ->select(
            'catalog_modules.id_type as isModule',
            'catalog_modules.id',
            'catalog_modules.name',
            DB::raw('COALESCE(module_users_permissions.read, 0) AS `read`'),
            DB::raw('COALESCE(module_users_permissions.edit, 0) AS edit'),
            DB::raw('COALESCE(module_users_permissions.create, 0) AS `create`'),
            DB::raw('COALESCE(module_users_permissions.delete, 0) AS `delete`'),
            DB::raw('COALESCE(module_users_permissions.show, 0) AS `show`')
        )
        ->leftJoin('module_users_permissions', function ($join) use ($id_usuario) {
            $join->on('catalog_modules.id', '=', 'module_users_permissions.id_modulo')
            ->where('module_users_permissions.id_usuario', '=', $id_usuario);
        })
        ->get();
        return response()->json([
            'status' => 'success',
            'msg' => 'Modulos Obtenidos.',
            'data' => $modules
        ]);
    }


   /* public function getSectionUserById(Request $request)
    {
        $id_usuario = $request->get('id');
        $modules =
        DB::table('catalog_sections')
            ->select('catalog_sections.id as id_section', 
                     'catalog_sections.name as name', 
                     'catalog_sections.id_parent', 
                     DB::raw('COALESCE(sections_permissions.show, 0) AS `show`'))
            ->leftJoin('sections_permissions','catalog_sections.id','=','sections_permissions.id_section')
            ->where('sections_permissions.id_user','=',$id_usuario)
            ->get();
        return response()->json([
            'status' => 'success',
            'msg' => 'Secciones Obtenidos.',
            'data' => $modules
        ]);

    }*/

    public function getSectionUserById(Request $request)
    {
        $id_usuario = $request->get('id');
        $modules =
        DB::table('catalog_sections')
            ->select('catalog_sections.id as id_section', 
                     'catalog_sections.name as name', 
                     'catalog_sections.id_parent', 
                     DB::raw('COALESCE(sections_permissions.show, 0) AS `show`'))

                     ->leftJoin('sections_permissions', function ($join) use ($id_usuario) {
                        $join->on('catalog_sections.id','=','sections_permissions.id_section')
                        ->where('sections_permissions.id_user', '=', $id_usuario);
                        
                    })
                    ->get();
        return response()->json([
            'status' => 'success',
            'msg' => 'Secciones Obtenidos.',
            'data' => $modules
        ]);

    }




    public function addPermisse(Request $request)
    {
        try {
            $requestData = $request->all(); 
        
            foreach ($requestData as $item) {

                if (isset($item['seccion']) && is_array($item['seccion']) && isset($item['id_modulo'])) {

                  /*  ModulePermisse::where('id_usuario', $item['id_usuario'])
                        ->where('id_modulo', $item['id_modulo'])
                        ->update(['show' => $item['show']]);*/

                        ModulePermisse::updateOrCreate(
                            ['id_usuario' => $item['id_usuario'], 'id_modulo' => $item['id_modulo']],
                            [
                                'show' => $item['show'],
                                'read' => $item['read'],
                                'edit' => $item['edit'],
                                'delete' => $item['delete'],
                                'create' => $item['create'],
                            ]
                        );
        
                   
                    foreach ($item['seccion'] as $subSection) {
                       /* SectionsPermissions::where('id_user', $subSection['id_user'])
                            ->where('id_section', $subSection['id_section'])
                            ->update(['show' => $subSection['show']]);*/
                        SectionsPermissions::updateOrCreate(
                            ['id_user' => $subSection['id_user'], 'id_section' => $subSection['id_section']],
                            ['show' => $subSection['show']]
                        );
                    }
                }
            }
        
   
            return response()->json([
                'status' => 'success',
                'msg' => 'Permisos guardados correctamente.',
                'data' => $requestData
            ]);
        } catch (Exception $e) {
       
            $error_code = $e->getMessage();
            return response()->json([
                //'msg' => ' Error al crear el registro',
               // 'data' => $error_code
            ]);
        }

       /* try {
            foreach ($request->all() as $mod) {

              $modexist = ModulePermisse::where('id_modulo', '=', $mod['id_modulo'])->where('id_usuario', '=', $mod['id_usuario'])->delete();

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
            'data' => $dataToUpdate
        ]);*/
    }


    public function getPermissionModules(Request $request)
    {
        $id_usuario = $request->get('id_usuario');

        try {

            $permission = DB::table('module_users_permissions')
                ->select('module_users_permissions.id_modulo', 'module_users_permissions.show')
                ->where('id_usuario', '=', $id_usuario)
                ->get();
            return response()->json([
                'status' => 'success',
                'msg' => 'Permisos obtenidos correctamente.',
                'data' => $permission
            ]);
        } catch (\Exception $e) {
            $error_code = $e->getMessage();
            return response()->json([
                'status' => 'error',
                'msg' => 'Error al obtener los permisos'
            ]);
        }
    }


    public function getPermissionSection(Request $request)
    {
        $id_usuario = $request->get('id_usuario');

        try {

            $permission = DB::table('sections_permissions')
                ->select('sections_permissions.id_section', 'sections_permissions.show')
                ->where('id_user', '=', $id_usuario)
                ->get();
            return response()->json([
                'status' => 'success',
                'msg' => 'Permisos obtenidos correctamente.',
                'data' => $permission
            ]);
        } catch (\Exception $e) {
            $error_code = $e->getMessage();
            return response()->json([
                'status' => 'error',
                'msg' => 'Error al obtener los permisos'
            ]);
        }
    }


    public function retiervePassword(Request $request)
    {
        $id = $request['id']; // Metodo por GET
        try {
            $usuario = Usuario::find($id);
            $usuario->password = Hash::make($request['password']);

            $usuario->save();


            return response()->json([
                'status' => 'success',
                'msg' => 'Contraseña actualizada correctamente.',
                'data' => $usuario
            ]);
        } catch (\Exception $e) {
            $error_code = $e->getMessage();
            return response()->json([
                'status' => 'error',
                'msg' => ' Error al actualizar la contraseña intente de nuevo',
                'data' => $error_code
            ]);
        }
    }


    public function updateImgProfile(Request $request)
    {
        $id = $request['id']; // Metodo por GET
        try {
            $usuario = Usuario::find($id);
            $usuario->img_profile = $request['img_profile'];

            $usuario->save();


            return response()->json([
                'status' => 'success',
                'msg' => 'Imagen actualizada correctamente.',
                'data' => $usuario
            ]);
        } catch (\Exception $e) {
            $error_code = $e->getMessage();
            return response()->json([
                'status' => 'error',
                'msg' => ' Error al actualizar la Imagen intente de nuevo',
                'data' => $error_code
            ]);
        }
    }
}
