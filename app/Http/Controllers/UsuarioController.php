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
            ->where('catalog_modules.status', '=', 1)
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
            ->select('sections_permissions.id_section','catalog_sections.nomenclature', 'sections_permissions.show')
            ->join('sections_permissions','users.id','=','sections_permissions.id_user')
            ->join('catalog_sections','sections_permissions.id_section','=','catalog_sections.id')
            ->join('catalog_modules','catalog_modules.id','=','catalog_sections.id_parent')
            ->where('sections_permissions.id_user','=', $id)
            ->where('catalog_modules.id','=',$id_module)
            ->where('catalog_sections.status', '=', 1)
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
        ->where('catalog_modules.status','=', 1)
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
                    ->where('catalog_sections.status', '=', 1)
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


    public function getGraphStaff(){

       // $graph = DB::SELECT('CALL get_GraphStaff()');

       $graph = DB::table('users')
                    ->select([
                        'company_structure_type.nombre as nameStaff',
                        DB::raw("CONCAT(FORMAT((COUNT(users.ejecucion_administrativa) / (SELECT COUNT(*) FROM users WHERE id_estatus = 1)) * 100, 2), '%') AS percentage"),
                        DB::raw('count(users.ejecucion_administrativa) as countUser'),
                    ])
                    ->join('company_structure_type', 'users.ejecucion_administrativa', '=', 'company_structure_type.id')
                    ->where('users.id_estatus', 1)
                    ->groupBy('users.ejecucion_administrativa', 'company_structure_type.nombre')
                    ->get();

        return response()->json([
            'status' => 'success',
            'msg' => 'Grafica Staff',
            'data' => $graph
        ]);
    }


    public function getGraphLocation(){

        //$graph = DB::SELECT('CALL get_GraphLocation()');

          $graph = DB::table('users')
                        ->select([
                            DB::raw('COUNT(users.id_ubicacion) as countLocation'),
                            'ubicaciones.nombre as nameLocation',
                        ])
                        ->join('ubicaciones', 'users.id_ubicacion', '=', 'ubicaciones.id')
                        ->where('users.id_estatus', 1)
                        ->groupBy('users.id_ubicacion', 'ubicaciones.nombre')
                        ->get();
                return response()->json([
                    'status' => 'success',
                    'msg' => 'Grafica Ubicación',
                    'data' => $graph
                ]);
        }

    public function getGraphCampaing(){
      //  $graph = DB::SELECT('CALL get_GraphCampaing()');

      $graph = DB::table('users')
                ->select([
                    DB::raw('COUNT(users.id_campania) as countCampania'),
                    'groups_sysca.nombre as nameCampania',
                ])
                ->join('groups_sysca', 'users.id_campania', '=', 'groups_sysca.id')
                ->where('users.id_estatus', 1)
                ->whereIn('users.id_puesto', [1, 2])
                ->groupBy('users.id_campania', 'groups_sysca.nombre')
                ->get();

        return response()->json([
            'status' => 'success',
            'msg' => 'Grafica Campaña',
            'data' => $graph
        ]);

    }

    public function getGraphInternet(){
     //   $graph = DB::SELECT('CALL get_GraphInternet()');
        $graph = DB::table('internet_disconnection as id')
                    ->select(DB::raw('SUM(id.counter) as days'), 's.nombre as Status')
                    ->join('status as s', 'id.status_id', '=', 's.id')
                    ->groupBy('counter', 's.nombre')
                    ->orderBy('days', 'asc')
                    ->get();

        return response()->json([
            'status' => 'success',
            'msg' => 'Grafica Internet',
            'data' => $graph
        ]);

    }

    public function getDataUser(Request $request)
    {
        $id = $request['id']; 
        $permission  = DB::table('catalog_sections as cs')
                    ->join('sections_permissions as sp', 'cs.id', '=', 'sp.id_section')
                    ->select('cs.nomenclature')
                    ->where('sp.id_user', $id)
                    ->where('sp.show', 1)
                    ->get()
                    ->pluck('nomenclature')
                    ->toArray();
          

        $dataUser = [];

      
        switch(true){
    

             case in_array('Emp-01', $permission) && in_array('Emp-02', $permission) && in_array('Emp-03', $permission) && in_array('Emp-04', $permission) && in_array('Emp-05', $permission) && in_array('Emp-06', $permission)  && in_array('Emp-07', $permission) && in_array('Emp-08', $permission):
            $dataUser = DB::table('users')
          ->select('users.id', 'users.nombre_completo', 'users.apellido_pat', 'users.apellido_mat', 'users.nombre', 'users.fecha_nacimiento', 'users.rfc', 'users.curp', 'gender.nombre as Sexo', 'catalog_civil_statuses.nombre as Estado_Civil', 'users.nss', 'users.numero_empleado', 'countries.pais', 'cities.ciudad', 'township.delegacion', 'users.colonia', 'users.calle', 'users.no_ext', 'users.no_int', 'users.cp', 'users.referencia', 'users.tel_personal', 'users.email_personal', 'users.contacto_emergencia_nombre', 'relationships.nombre as Parentesco', 'users.contacto_emergencia_telefono', 'type_bloods.nombre as tipo_sangre', 'users.contacto_emergencia_padecimientos', 'users.contacto_emergencia_movil', 'catalog_company_position.nombre as Puesto', 'catalog_company_subcategories.nombre as Area', 'company_department.nombre as Departamento', 'groups_sysca.nombre as Campaña', 'company_structure_type.nombre as ejecucion_administrativa', 'ubicaciones.nombre as ubicacion', 'type_schedule.nombre as turno', 'users.fecha_ingreso', 'users.tel_laboral', 'users.email', 'companies_payment.nombre as empresa_pago', 'users.sueldo', 'users.fecha_pago', 'banks_catalog.nombre as banco', 'users.numero_cuenta_bancaria', 'users.clabe_inter_bancaria', 'users.usuario')
                            ->leftJoin('banks_catalog','users.id_banco','=','banks_catalog.id')
                            ->leftJoin('companies_payment','users.id_empresa_rh','=','companies_payment.id')
                            ->leftJoin('catalog_company_position','users.id_puesto','=','catalog_company_position.id')
                            ->leftJoin('catalog_company_subcategories','users.id_subcategoria','=','catalog_company_subcategories.id')
                            ->leftJoin('company_department','users.id_departamento_empresa','=','company_department.id')
                            ->leftJoin('groups_sysca','users.id_campania','=','groups_sysca.id')
                            ->leftJoin('company_structure_type','users.ejecucion_administrativa','=','company_structure_type.id')
                            ->leftJoin('type_schedule','users.id_turno','=','type_schedule.id')
                            ->leftJoin('ubicaciones','users.id_ubicacion','=','ubicaciones.id')
                            ->leftJoin('gender','users.id_sexo','=','gender.id')
                            ->leftJoin('catalog_civil_statuses','users.id_estado_civil','=','catalog_civil_statuses.id')
                            ->leftJoin('countries','users.id_pais','=','countries.idpais')
                            ->leftJoin('township','users.id_municipio','=','township.iddelegacion')
                            ->leftJoin('cities','users.id_estado','=','cities.idciudad')
                            ->leftJoin('relationships','users.contacto_emergencia_parentesco','=','relationships.id')
                            ->leftJoin('type_bloods','users.contacto_emergencia_tip_sangre','=','type_bloods.id')
                            ->leftJoin('status','users.id_estatus','=','status.id')
                            ->where('users.id_estatus','=',1)
                            ->orderBy('users.id','asc')
                            ->get();
            break;
            case in_array('Emp-01', $permission) && in_array('Emp-07', $permission) && in_array('Emp-08', $permission):
                $dataUser = DB::table('users')
                            ->select('users.id', 'users.nombre_completo', 'users.apellido_pat', 'users.apellido_mat', 'users.nombre', 'users.fecha_nacimiento', 'users.rfc', 'users.curp', 'gender.nombre as Sexo', 'catalog_civil_statuses.nombre as Estado_Civil', 'users.nss', 'users.numero_empleado', 'banks_catalog.nombre as banco', 'users.numero_cuenta_bancaria', 'users.clabe_inter_bancaria', 'users.usuario', 'status.nombre')
                            ->leftJoin('status','users.id_estatus','=','status.id')
                            ->leftJoin('banks_catalog','users.id_banco','=','banks_catalog.id')
                            ->leftJoin('gender','users.id_sexo','=','gender.id')
                            ->leftJoin('catalog_civil_statuses','users.id_estado_civil','=','catalog_civil_statuses.id')
                            ->where('users.id_estatus','=',1)
                            ->orderBy('users.id','asc')
                            ->get();
            break;
            case in_array('Emp-01', $permission) && in_array('Emp-08', $permission):
                $dataUser = DB::table('users')
                ->select('users.id', 'users.nombre_completo', 'users.apellido_pat', 'users.apellido_mat', 'users.nombre', 'users.fecha_nacimiento', 'users.rfc', 'users.curp', 'gender.nombre as Sexo', 'catalog_civil_statuses.nombre as Estado_Civil', 'users.nss', 'users.numero_empleado', 'users.usuario', 'status.nombre')
                                ->leftJoin('status','users.id_estatus','=','status.id')
                                ->leftJoin('gender','users.id_sexo','=','gender.id')
                                ->leftJoin('catalog_civil_statuses','users.id_estado_civil','=','catalog_civil_statuses.id')
                                ->where('users.id_estatus','=',1)
                                ->orderBy('users.id','asc')
                                ->get();
             break;
       
            case in_array('Emp-01', $permission) && in_array('Emp-07', $permission):
                $dataUser = DB::table('users')
                            ->select('users.id', 'users.nombre_completo', 'users.apellido_pat', 'users.apellido_mat', 'users.nombre', 'users.fecha_nacimiento', 'users.rfc', 'users.curp', 'gender.nombre as Sexo', 'catalog_civil_statuses.nombre as Estado_Civil', 'users.nss', 'users.numero_empleado', 'banks_catalog.nombre as banco', 'users.numero_cuenta_bancaria', 'users.clabe_inter_bancaria')
                            ->leftJoin('banks_catalog','users.id_banco','=','banks_catalog.id')
                            ->leftJoin('gender','users.id_sexo','=','gender.id')
                            ->leftJoin('catalog_civil_statuses','users.id_estado_civil','=','catalog_civil_statuses.id')
                            ->where('users.id_estatus','=',1)
                            ->orderBy('users.id','asc')
                            ->get();
            break;
      

            case in_array('Emp-01', $permission) && in_array('Emp-02', $permission) && in_array('Emp-03', $permission) && in_array('Emp-04', $permission) && in_array('Emp-05', $permission) && in_array('Emp-06', $permission)  && in_array('Emp-07', $permission):
                $dataUser = DB::table('users')
                            ->select('users.id', 'users.nombre_completo', 'users.apellido_pat', 'users.apellido_mat', 'users.nombre', 'users.fecha_nacimiento', 'users.rfc', 'users.curp', 'gender.nombre as Sexo', 'catalog_civil_statuses.nombre as Estado_Civil', 'users.nss', 'users.numero_empleado', 'countries.pais', 'cities.ciudad', 'township.delegacion', 'users.colonia', 'users.calle', 'users.no_ext', 'users.no_int', 'users.cp', 'users.referencia', 'users.tel_personal', 'users.email_personal', 'users.contacto_emergencia_nombre', 'relationships.nombre as Parentesco', 'users.contacto_emergencia_telefono', 'type_bloods.nombre as tipo_sangre', 'users.contacto_emergencia_padecimientos', 'users.contacto_emergencia_movil', 'catalog_company_position.nombre as Puesto', 'catalog_company_subcategories.nombre as Area', 'company_department.nombre as Departamento', 'groups_sysca.nombre as Campaña', 'company_structure_type.nombre as ejecucion_administrativa', 'ubicaciones.nombre as ubicacion', 'type_schedule.nombre as turno', 'users.fecha_ingreso', 'users.tel_laboral', 'users.email', 'companies_payment.nombre as empresa_pago', 'users.sueldo', 'users.fecha_pago', 'banks_catalog.nombre as banco', 'users.numero_cuenta_bancaria', 'users.clabe_inter_bancaria')
                            ->leftJoin('banks_catalog','users.id_banco','=','banks_catalog.id')
                            ->leftJoin('companies_payment','users.id_empresa_rh','=','companies_payment.id')
                            ->leftJoin('catalog_company_position','users.id_puesto','=','catalog_company_position.id')
                            ->leftJoin('catalog_company_subcategories','users.id_subcategoria','=','catalog_company_subcategories.id')
                            ->leftJoin('company_department','users.id_departamento_empresa','=','company_department.id')
                            ->leftJoin('groups_sysca','users.id_campania','=','groups_sysca.id')
                            ->leftJoin('company_structure_type','users.ejecucion_administrativa','=','company_structure_type.id')
                            ->leftJoin('type_schedule','users.id_turno','=','type_schedule.id')
                            ->leftJoin('ubicaciones','users.id_ubicacion','=','ubicaciones.id')
                            ->leftJoin('gender','users.id_sexo','=','gender.id')
                            ->leftJoin('catalog_civil_statuses','users.id_estado_civil','=','catalog_civil_statuses.id')
                            ->leftJoin('countries','users.id_pais','=','countries.idpais')
                            ->leftJoin('township','users.id_municipio','=','township.iddelegacion')
                            ->leftJoin('cities','users.id_estado','=','cities.idciudad')
                            ->leftJoin('relationships','users.contacto_emergencia_parentesco','=','relationships.id')
                            ->leftJoin('type_bloods','users.contacto_emergencia_tip_sangre','=','type_bloods.id')
                            ->where('users.id_estatus','=',1)
                            ->orderBy('users.id','asc')
                            ->get();
            break;
            case in_array('Emp-01', $permission)  && in_array('Emp-06', $permission):
                $dataUser = DB::table('users')
                            ->select('users.id', 'users.nombre_completo', 'users.apellido_pat', 'users.apellido_mat', 'users.nombre', 'users.fecha_nacimiento', 'users.rfc', 'users.curp', 'gender.nombre as Sexo', 'catalog_civil_statuses.nombre as Estado_Civil', 'users.nss', 'users.numero_empleado',  'companies_payment.nombre as empresa_pago', 'users.sueldo', 'users.fecha_pago')
                            ->leftJoin('companies_payment','users.id_empresa_rh','=','companies_payment.id')
                            ->leftJoin('gender','users.id_sexo','=','gender.id')
                            ->leftJoin('catalog_civil_statuses','users.id_estado_civil','=','catalog_civil_statuses.id')        
                            ->where('users.id_estatus','=',1)
                            ->orderBy('users.id','asc')
                            ->get();
            break;
            case in_array('Emp-01', $permission) && in_array('Emp-02', $permission) && in_array('Emp-03', $permission) && in_array('Emp-04', $permission) && in_array('Emp-05', $permission) && in_array('Emp-06', $permission):
                $dataUser = DB::table('users')
                            ->select('users.id', 'users.nombre_completo', 'users.apellido_pat', 'users.apellido_mat', 'users.nombre', 'users.fecha_nacimiento', 'users.rfc', 'users.curp', 'gender.nombre as Sexo', 'catalog_civil_statuses.nombre as Estado_Civil', 'users.nss', 'users.numero_empleado', 'countries.pais', 'cities.ciudad', 'township.delegacion', 'users.colonia', 'users.calle', 'users.no_ext', 'users.no_int', 'users.cp', 'users.referencia', 'users.tel_personal', 'users.email_personal', 'users.contacto_emergencia_nombre', 'relationships.nombre as Parentesco', 'users.contacto_emergencia_telefono', 'type_bloods.nombre as tipo_sangre', 'users.contacto_emergencia_padecimientos', 'users.contacto_emergencia_movil', 'catalog_company_position.nombre as Puesto', 'catalog_company_subcategories.nombre as Area', 'company_department.nombre as Departamento', 'groups_sysca.nombre as Campaña', 'company_structure_type.nombre as ejecucion_administrativa', 'ubicaciones.nombre as ubicacion', 'type_schedule.nombre as turno', 'users.fecha_ingreso', 'users.tel_laboral', 'users.email', 'companies_payment.nombre as empresa_pago', 'users.sueldo', 'users.fecha_pago')
                            ->leftJoin('companies_payment','users.id_empresa_rh','=','companies_payment.id')
                            ->leftJoin('catalog_company_position','users.id_puesto','=','catalog_company_position.id')
                            ->leftJoin('catalog_company_subcategories','users.id_subcategoria','=','catalog_company_subcategories.id')
                            ->leftJoin('company_department','users.id_departamento_empresa','=','company_department.id')
                            ->leftJoin('groups_sysca','users.id_campania','=','groups_sysca.id')
                            ->leftJoin('company_structure_type','users.ejecucion_administrativa','=','company_structure_type.id')
                            ->leftJoin('type_schedule','users.id_turno','=','type_schedule.id')
                            ->leftJoin('ubicaciones','users.id_ubicacion','=','ubicaciones.id')
                            ->leftJoin('gender','users.id_sexo','=','gender.id')
                            ->leftJoin('catalog_civil_statuses','users.id_estado_civil','=','catalog_civil_statuses.id')
                            ->leftJoin('countries','users.id_pais','=','countries.idpais')
                            ->leftJoin('township','users.id_municipio','=','township.iddelegacion')
                            ->leftJoin('cities','users.id_estado','=','cities.idciudad')
                            ->leftJoin('relationships','users.contacto_emergencia_parentesco','=','relationships.id')
                            ->leftJoin('type_bloods','users.contacto_emergencia_tip_sangre','=','type_bloods.id')
                            ->where('users.id_estatus','=',1)
                            ->orderBy('users.id','asc')
                            ->get();
            break;
            case in_array('Emp-01', $permission) && in_array('Emp-02', $permission) && in_array('Emp-03', $permission):
                $dataUser = DB::table('users')
                            ->select('users.id', 'users.nombre_completo', 'users.apellido_pat', 'users.apellido_mat', 'users.nombre', 'users.fecha_nacimiento', 'users.rfc', 'users.curp', 'gender.nombre as Sexo', 'catalog_civil_statuses.nombre as Estado_Civil', 'users.nss', 'users.numero_empleado', 'countries.pais', 'cities.ciudad', 'township.delegacion', 'users.colonia', 'users.calle', 'users.no_ext', 'users.no_int', 'users.cp', 'users.referencia', 'users.tel_personal', 'users.email_personal')
                            ->leftJoin('gender','users.id_sexo','=','gender.id')
                            ->leftJoin('catalog_civil_statuses','users.id_estado_civil','=','catalog_civil_statuses.id')
                            ->leftJoin('countries','users.id_pais','=','countries.idpais')
                            ->leftJoin('township','users.id_municipio','=','township.iddelegacion')
                            ->leftJoin('cities','users.id_estado','=','cities.idciudad')
                            ->where('users.id_estatus','=',1)
                            ->orderBy('users.id','asc')
                            ->get();
            break;
            case in_array('Emp-01', $permission)  && in_array('Emp-05', $permission):
                $dataUser = DB::table('users')
                            ->select('users.id', 'users.nombre_completo', 'users.apellido_pat', 'users.apellido_mat', 'users.nombre', 'users.fecha_nacimiento', 'users.rfc', 'users.curp', 'gender.nombre as Sexo', 'catalog_civil_statuses.nombre as Estado_Civil', 'users.nss', 'users.numero_empleado', 'catalog_company_position.nombre as Puesto', 'catalog_company_subcategories.nombre as Area', 'company_department.nombre as Departamento', 'groups_sysca.nombre as Campaña', 'company_structure_type.nombre as ejecucion_administrativa', 'ubicaciones.nombre as ubicacion', 'type_schedule.nombre as turno', 'users.fecha_ingreso', 'users.tel_laboral', 'users.email')
                            ->leftJoin('catalog_company_position','users.id_puesto','=','catalog_company_position.id')
                            ->leftJoin('catalog_company_subcategories','users.id_subcategoria','=','catalog_company_subcategories.id')
                            ->leftJoin('company_department','users.id_departamento_empresa','=','company_department.id')
                            ->leftJoin('groups_sysca','users.id_campania','=','groups_sysca.id')
                            ->leftJoin('company_structure_type','users.ejecucion_administrativa','=','company_structure_type.id')
                            ->leftJoin('type_schedule','users.id_turno','=','type_schedule.id')
                            ->leftJoin('ubicaciones','users.id_ubicacion','=','ubicaciones.id')
                            ->leftJoin('gender','users.id_sexo','=','gender.id')
                            ->leftJoin('catalog_civil_statuses','users.id_estado_civil','=','catalog_civil_statuses.id')
                            ->where('users.id_estatus','=',1)
                            ->orderBy('users.id','asc')
                            ->get();
            break;
            case in_array('Emp-01', $permission) && in_array('Emp-02', $permission) && in_array('Emp-03', $permission) && in_array('Emp-04', $permission) && in_array('Emp-05', $permission):
                $dataUser = DB::table('users')
                            ->select('users.id', 'users.nombre_completo', 'users.apellido_pat', 'users.apellido_mat', 'users.nombre', 'users.fecha_nacimiento', 'users.rfc', 'users.curp', 'gender.nombre as Sexo', 'catalog_civil_statuses.nombre as Estado_Civil', 'users.nss', 'users.numero_empleado', 'countries.pais', 'cities.ciudad', 'township.delegacion', 'users.colonia', 'users.calle', 'users.no_ext', 'users.no_int', 'users.cp', 'users.referencia', 'users.tel_personal', 'users.email_personal', 'users.contacto_emergencia_nombre', 'relationships.nombre as Parentesco', 'users.contacto_emergencia_telefono', 'type_bloods.nombre as tipo_sangre', 'users.contacto_emergencia_padecimientos', 'users.contacto_emergencia_movil', 'catalog_company_position.nombre as Puesto', 'catalog_company_subcategories.nombre as Area', 'company_department.nombre as Departamento', 'groups_sysca.nombre as Campaña', 'company_structure_type.nombre as ejecucion_administrativa', 'ubicaciones.nombre as ubicacion', 'type_schedule.nombre as turno', 'users.fecha_ingreso', 'users.tel_laboral', 'users.email')
                            ->leftJoin('catalog_company_position','users.id_puesto','=','catalog_company_position.id')
                            ->leftJoin('catalog_company_subcategories','users.id_subcategoria','=','catalog_company_subcategories.id')
                            ->leftJoin('company_department','users.id_departamento_empresa','=','company_department.id')
                            ->leftJoin('groups_sysca','users.id_campania','=','groups_sysca.id')
                            ->leftJoin('company_structure_type','users.ejecucion_administrativa','=','company_structure_type.id')
                            ->leftJoin('type_schedule','users.id_turno','=','type_schedule.id')
                            ->leftJoin('ubicaciones','users.id_ubicacion','=','ubicaciones.id')
                            ->leftJoin('gender','users.id_sexo','=','gender.id')
                            ->leftJoin('catalog_civil_statuses','users.id_estado_civil','=','catalog_civil_statuses.id')
                            ->leftJoin('countries','users.id_pais','=','countries.idpais')
                            ->leftJoin('township','users.id_municipio','=','township.iddelegacion')
                            ->leftJoin('cities','users.id_estado','=','cities.idciudad')
                            ->leftJoin('relationships','users.contacto_emergencia_parentesco','=','relationships.id')
                            ->leftJoin('type_bloods','users.contacto_emergencia_tip_sangre','=','type_bloods.id')
                            ->where('users.id_estatus','=',1)
                            ->orderBy('users.id','asc')
                            ->get();
            break;
            case in_array('Emp-01', $permission)  && in_array('Emp-04', $permission):
                $dataUser = DB::table('users')
                            ->select('users.id', 'users.nombre_completo', 'users.apellido_pat', 'users.apellido_mat', 'users.nombre', 'users.fecha_nacimiento', 'users.rfc', 'users.curp', 'gender.nombre as Sexo', 'catalog_civil_statuses.nombre as Estado_Civil', 'users.nss', 'users.numero_empleado','users.contacto_emergencia_nombre', 'relationships.nombre as Parentesco', 'users.contacto_emergencia_telefono', 'type_bloods.nombre as tipo_sangre', 'users.contacto_emergencia_padecimientos', 'users.contacto_emergencia_movil')
                            ->leftJoin('gender','users.id_sexo','=','gender.id')
                            ->leftJoin('catalog_civil_statuses','users.id_estado_civil','=','catalog_civil_statuses.id')
                            ->leftJoin('relationships','users.contacto_emergencia_parentesco','=','relationships.id')
                            ->leftJoin('type_bloods','users.contacto_emergencia_tip_sangre','=','type_bloods.id')
                            ->where('users.id_estatus','=',1)
                            ->orderBy('users.id','asc')
                            ->get();
            break;
            case in_array('Emp-01', $permission) && in_array('Emp-02', $permission) && in_array('Emp-03', $permission) && in_array('Emp-04', $permission):
                $dataUser = DB::table('users')
                            ->select('users.id', 'users.nombre_completo', 'users.apellido_pat', 'users.apellido_mat', 'users.nombre', 'users.fecha_nacimiento', 'users.rfc', 'users.curp', 'gender.nombre as Sexo', 'catalog_civil_statuses.nombre as Estado_Civil', 'users.nss', 'users.numero_empleado', 'countries.pais', 'cities.ciudad', 'township.delegacion', 'users.colonia', 'users.calle', 'users.no_ext', 'users.no_int', 'users.cp', 'users.referencia', 'users.tel_personal', 'users.email_personal', 'users.contacto_emergencia_nombre', 'relationships.nombre as Parentesco', 'users.contacto_emergencia_telefono', 'type_bloods.nombre as tipo_sangre', 'users.contacto_emergencia_padecimientos', 'users.contacto_emergencia_movil')
                            ->leftJoin('gender','users.id_sexo','=','gender.id')
                            ->leftJoin('catalog_civil_statuses','users.id_estado_civil','=','catalog_civil_statuses.id')
                            ->leftJoin('countries','users.id_pais','=','countries.idpais')
                            ->leftJoin('township','users.id_municipio','=','township.iddelegacion')
                            ->leftJoin('cities','users.id_estado','=','cities.idciudad')
                            ->leftJoin('relationships','users.contacto_emergencia_parentesco','=','relationships.id')
                            ->leftJoin('type_bloods','users.contacto_emergencia_tip_sangre','=','type_bloods.id')
                            ->where('users.id_estatus','=',1)
                            ->orderBy('users.id','asc')
                            ->get();
            break;
            case in_array('Emp-01', $permission) && in_array('Emp-03', $permission):
                $dataUser = DB::table('users')
                            ->select('users.id', 'users.nombre_completo', 'users.apellido_pat', 'users.apellido_mat', 'users.nombre', 'users.fecha_nacimiento', 'users.rfc', 'users.curp', 'gender.nombre as Sexo', 'catalog_civil_statuses.nombre as Estado_Civil', 'users.nss', 'users.numero_empleado', 'users.tel_personal', 'users.email_personal')
                            ->leftJoin('gender','users.id_sexo','=','gender.id')
                            ->leftJoin('catalog_civil_statuses','users.id_estado_civil','=','catalog_civil_statuses.id')
                            ->where('users.id_estatus','=',1)
                            ->orderBy('users.id','asc')
                            ->get();
            break;
    
            case in_array('Emp-01', $permission) && in_array('Emp-02', $permission):
                $dataUser = DB::table('users')
                            ->select('users.id', 'users.nombre_completo', 'users.apellido_pat', 'users.apellido_mat', 'users.nombre', 'users.fecha_nacimiento', 'users.rfc', 'users.curp', 'gender.nombre as Sexo', 'catalog_civil_statuses.nombre as Estado_Civil', 'users.nss', 'users.numero_empleado', 'countries.pais', 'cities.ciudad', 'township.delegacion', 'users.colonia', 'users.calle', 'users.no_ext', 'users.no_int', 'users.cp', 'users.referencia')
                            ->leftJoin('gender','users.id_sexo','=','gender.id')
                            ->leftJoin('catalog_civil_statuses','users.id_estado_civil','=','catalog_civil_statuses.id')
                            ->leftJoin('countries','users.id_pais','=','countries.idpais')
                            ->leftJoin('township','users.id_municipio','=','township.iddelegacion')
                            ->leftJoin('cities','users.id_estado','=','cities.idciudad')
                            ->where('users.id_estatus','=',1)
                            ->orderBy('users.id','asc')
                            ->get();
            break;
            //Datos Personales
            case in_array('Emp-01', $permission):
                $dataUser = DB::table('users')
                            ->select('users.id', 'users.nombre_completo', 'users.apellido_pat', 'users.apellido_mat', 'users.nombre', 'users.fecha_nacimiento', 'users.rfc', 'users.curp', 'gender.nombre as Sexo', 'catalog_civil_statuses.nombre as Estado_Civil', 'users.nss', 'users.numero_empleado')
                            ->leftJoin('gender','users.id_sexo','=','gender.id')
                            ->leftJoin('catalog_civil_statuses','users.id_estado_civil','=','catalog_civil_statuses.id')
                            ->where('users.id_estatus','=',1)
                            ->orderBy('users.id','asc')
                            ->get();
            break;

            case in_array('Emp-02', $permission) && in_array('Emp-03', $permission) && in_array('Emp-04', $permission) && in_array('Emp-05', $permission) && in_array('Emp-06', $permission)  && in_array('Emp-07', $permission) && in_array('Emp-08', $permission):
                $dataUser = DB::table('users')
                ->select('users.id', 'users.nombre_completo','countries.pais', 'cities.ciudad', 'township.delegacion', 'users.colonia', 'users.calle', 'users.no_ext', 'users.no_int', 'users.cp', 'users.referencia', 'users.tel_personal', 'users.email_personal', 'users.contacto_emergencia_nombre', 'relationships.nombre as Parentesco', 'users.contacto_emergencia_telefono', 'type_bloods.nombre as tipo_sangre', 'users.contacto_emergencia_padecimientos', 'users.contacto_emergencia_movil', 'catalog_company_position.nombre as Puesto', 'catalog_company_subcategories.nombre as Area', 'company_department.nombre as Departamento', 'groups_sysca.nombre as Campaña', 'company_structure_type.nombre as ejecucion_administrativa', 'ubicaciones.nombre as ubicacion', 'type_schedule.nombre as turno', 'users.fecha_ingreso', 'users.tel_laboral', 'users.email', 'companies_payment.nombre as empresa_pago', 'users.sueldo', 'users.fecha_pago', 'banks_catalog.nombre as banco', 'users.numero_cuenta_bancaria', 'users.clabe_inter_bancaria', 'users.usuario', 'status.nombre')
                                ->leftJoin('status','users.id_estatus','=','status.id')
                                ->leftJoin('banks_catalog','users.id_banco','=','banks_catalog.id')
                                ->leftJoin('companies_payment','users.id_empresa_rh','=','companies_payment.id')
                                ->leftJoin('catalog_company_position','users.id_puesto','=','catalog_company_position.id')
                                ->leftJoin('catalog_company_subcategories','users.id_subcategoria','=','catalog_company_subcategories.id')
                                ->leftJoin('company_department','users.id_departamento_empresa','=','company_department.id')
                                ->leftJoin('groups_sysca','users.id_campania','=','groups_sysca.id')
                                ->leftJoin('company_structure_type','users.ejecucion_administrativa','=','company_structure_type.id')
                                ->leftJoin('type_schedule','users.id_turno','=','type_schedule.id')
                                ->leftJoin('ubicaciones','users.id_ubicacion','=','ubicaciones.id')
                                ->leftJoin('countries','users.id_pais','=','countries.idpais')
                                ->leftJoin('township','users.id_municipio','=','township.iddelegacion')
                                ->leftJoin('cities','users.id_estado','=','cities.idciudad')
                                ->leftJoin('relationships','users.contacto_emergencia_parentesco','=','relationships.id')
                                ->leftJoin('type_bloods','users.contacto_emergencia_tip_sangre','=','type_bloods.id')
                                ->where('users.id_estatus','=',1)
                                ->orderBy('users.id','asc')
                                ->get();
                break;
                case in_array('Emp-02', $permission) && in_array('Emp-03', $permission) && in_array('Emp-04', $permission) && in_array('Emp-05', $permission) && in_array('Emp-06', $permission)  && in_array('Emp-07', $permission):
                    $dataUser = DB::table('users')
                    ->select('users.id', 'users.nombre_completo','countries.pais', 'cities.ciudad', 'township.delegacion', 'users.colonia', 'users.calle', 'users.no_ext', 'users.no_int', 'users.cp', 'users.referencia', 'users.tel_personal', 'users.email_personal', 'users.contacto_emergencia_nombre', 'relationships.nombre as Parentesco', 'users.contacto_emergencia_telefono', 'type_bloods.nombre as tipo_sangre', 'users.contacto_emergencia_padecimientos', 'users.contacto_emergencia_movil', 'catalog_company_position.nombre as Puesto', 'catalog_company_subcategories.nombre as Area', 'company_department.nombre as Departamento', 'groups_sysca.nombre as Campaña', 'company_structure_type.nombre as ejecucion_administrativa', 'ubicaciones.nombre as ubicacion', 'type_schedule.nombre as turno', 'users.fecha_ingreso', 'users.tel_laboral', 'users.email', 'companies_payment.nombre as empresa_pago', 'users.sueldo', 'users.fecha_pago', 'banks_catalog.nombre as banco', 'users.numero_cuenta_bancaria', 'users.clabe_inter_bancaria')
                                    ->leftJoin('banks_catalog','users.id_banco','=','banks_catalog.id')
                                    ->leftJoin('companies_payment','users.id_empresa_rh','=','companies_payment.id')
                                    ->leftJoin('catalog_company_position','users.id_puesto','=','catalog_company_position.id')
                                    ->leftJoin('catalog_company_subcategories','users.id_subcategoria','=','catalog_company_subcategories.id')
                                    ->leftJoin('company_department','users.id_departamento_empresa','=','company_department.id')
                                    ->leftJoin('groups_sysca','users.id_campania','=','groups_sysca.id')
                                    ->leftJoin('company_structure_type','users.ejecucion_administrativa','=','company_structure_type.id')
                                    ->leftJoin('type_schedule','users.id_turno','=','type_schedule.id')
                                    ->leftJoin('ubicaciones','users.id_ubicacion','=','ubicaciones.id')
                                    ->leftJoin('countries','users.id_pais','=','countries.idpais')
                                    ->leftJoin('township','users.id_municipio','=','township.iddelegacion')
                                    ->leftJoin('cities','users.id_estado','=','cities.idciudad')
                                    ->leftJoin('relationships','users.contacto_emergencia_parentesco','=','relationships.id')
                                    ->leftJoin('type_bloods','users.contacto_emergencia_tip_sangre','=','type_bloods.id')
                                    ->where('users.id_estatus','=',1)
                                    ->orderBy('users.id','asc')
                                    ->get();
                break;
                case in_array('Emp-02', $permission) && in_array('Emp-03', $permission) && in_array('Emp-04', $permission) && in_array('Emp-05', $permission) && in_array('Emp-06', $permission):
                        $dataUser = DB::table('users')
                        ->select('users.id', 'users.nombre_completo','countries.pais', 'cities.ciudad', 'township.delegacion', 'users.colonia', 'users.calle', 'users.no_ext', 'users.no_int', 'users.cp', 'users.referencia', 'users.tel_personal', 'users.email_personal', 'users.contacto_emergencia_nombre', 'relationships.nombre as Parentesco', 'users.contacto_emergencia_telefono', 'type_bloods.nombre as tipo_sangre', 'users.contacto_emergencia_padecimientos', 'users.contacto_emergencia_movil', 'catalog_company_position.nombre as Puesto', 'catalog_company_subcategories.nombre as Area', 'company_department.nombre as Departamento', 'groups_sysca.nombre as Campaña', 'company_structure_type.nombre as ejecucion_administrativa', 'ubicaciones.nombre as ubicacion', 'type_schedule.nombre as turno', 'users.fecha_ingreso', 'users.tel_laboral', 'users.email', 'companies_payment.nombre as empresa_pago', 'users.sueldo', 'users.fecha_pago')
                                        ->leftJoin('companies_payment','users.id_empresa_rh','=','companies_payment.id')
                                        ->leftJoin('catalog_company_position','users.id_puesto','=','catalog_company_position.id')
                                        ->leftJoin('catalog_company_subcategories','users.id_subcategoria','=','catalog_company_subcategories.id')
                                        ->leftJoin('company_department','users.id_departamento_empresa','=','company_department.id')
                                        ->leftJoin('groups_sysca','users.id_campania','=','groups_sysca.id')
                                        ->leftJoin('company_structure_type','users.ejecucion_administrativa','=','company_structure_type.id')
                                        ->leftJoin('type_schedule','users.id_turno','=','type_schedule.id')
                                        ->leftJoin('ubicaciones','users.id_ubicacion','=','ubicaciones.id')
                                        ->leftJoin('countries','users.id_pais','=','countries.idpais')
                                        ->leftJoin('township','users.id_municipio','=','township.iddelegacion')
                                        ->leftJoin('cities','users.id_estado','=','cities.idciudad')
                                        ->leftJoin('relationships','users.contacto_emergencia_parentesco','=','relationships.id')
                                        ->leftJoin('type_bloods','users.contacto_emergencia_tip_sangre','=','type_bloods.id')
                                        ->where('users.id_estatus','=',1)
                                        ->orderBy('users.id','asc')
                                        ->get();
            break;
            case in_array('Emp-02', $permission) && in_array('Emp-03', $permission) && in_array('Emp-04', $permission) && in_array('Emp-05', $permission):
                $dataUser = DB::table('users')
                ->select('users.id', 'users.nombre_completo','countries.pais', 'cities.ciudad', 'township.delegacion', 'users.colonia', 'users.calle', 'users.no_ext', 'users.no_int', 'users.cp', 'users.referencia', 'users.tel_personal', 'users.email_personal', 'users.contacto_emergencia_nombre', 'relationships.nombre as Parentesco', 'users.contacto_emergencia_telefono', 'type_bloods.nombre as tipo_sangre', 'users.contacto_emergencia_padecimientos', 'users.contacto_emergencia_movil', 'catalog_company_position.nombre as Puesto', 'catalog_company_subcategories.nombre as Area', 'company_department.nombre as Departamento', 'groups_sysca.nombre as Campaña', 'company_structure_type.nombre as ejecucion_administrativa', 'ubicaciones.nombre as ubicacion', 'type_schedule.nombre as turno', 'users.fecha_ingreso', 'users.tel_laboral', 'users.email')
                                ->leftJoin('catalog_company_position','users.id_puesto','=','catalog_company_position.id')
                                ->leftJoin('catalog_company_subcategories','users.id_subcategoria','=','catalog_company_subcategories.id')
                                ->leftJoin('company_department','users.id_departamento_empresa','=','company_department.id')
                                ->leftJoin('groups_sysca','users.id_campania','=','groups_sysca.id')
                                ->leftJoin('company_structure_type','users.ejecucion_administrativa','=','company_structure_type.id')
                                ->leftJoin('type_schedule','users.id_turno','=','type_schedule.id')
                                ->leftJoin('ubicaciones','users.id_ubicacion','=','ubicaciones.id')
                                ->leftJoin('countries','users.id_pais','=','countries.idpais')
                                ->leftJoin('township','users.id_municipio','=','township.iddelegacion')
                                ->leftJoin('cities','users.id_estado','=','cities.idciudad')
                                ->leftJoin('relationships','users.contacto_emergencia_parentesco','=','relationships.id')
                                ->leftJoin('type_bloods','users.contacto_emergencia_tip_sangre','=','type_bloods.id')
                                ->where('users.id_estatus','=',1)
                                ->orderBy('users.id','asc')
                                ->get();
            break;

            case in_array('Emp-02', $permission) && in_array('Emp-03', $permission) && in_array('Emp-04', $permission):
                $dataUser = DB::table('users')
                ->select('users.id', 'users.nombre_completo','countries.pais', 'cities.ciudad', 'township.delegacion', 'users.colonia', 'users.calle', 'users.no_ext', 'users.no_int', 'users.cp', 'users.referencia', 'users.tel_personal', 'users.email_personal', 'users.contacto_emergencia_nombre', 'relationships.nombre as Parentesco', 'users.contacto_emergencia_telefono', 'type_bloods.nombre as tipo_sangre', 'users.contacto_emergencia_padecimientos', 'users.contacto_emergencia_movil')
                                ->leftJoin('countries','users.id_pais','=','countries.idpais')
                                ->leftJoin('township','users.id_municipio','=','township.iddelegacion')
                                ->leftJoin('cities','users.id_estado','=','cities.idciudad')
                                ->leftJoin('relationships','users.contacto_emergencia_parentesco','=','relationships.id')
                                ->leftJoin('type_bloods','users.contacto_emergencia_tip_sangre','=','type_bloods.id')
                                ->where('users.id_estatus','=',1)
                                ->orderBy('users.id','asc')
                                ->get();
            break;
            case in_array('Emp-02', $permission) && in_array('Emp-03', $permission):
                $dataUser = DB::table('users')
                ->select('users.id', 'users.nombre_completo','countries.pais', 'cities.ciudad', 'township.delegacion', 'users.colonia', 'users.calle', 'users.no_ext', 'users.no_int', 'users.cp', 'users.referencia', 'users.tel_personal', 'users.email_personal')
                                ->leftJoin('countries','users.id_pais','=','countries.idpais')
                                ->leftJoin('township','users.id_municipio','=','township.iddelegacion')
                                ->leftJoin('cities','users.id_estado','=','cities.idciudad')
                                ->where('users.id_estatus','=',1)
                                ->orderBy('users.id','asc')
                                ->get();
            break;
  
            //Datos de Domicilio
            case in_array('Emp-02', $permission):
                $dataUser = DB::table('users')
                            ->select('users.id', 'users.nombre_completo','countries.pais', 'cities.ciudad', 'township.delegacion', 'users.colonia', 'users.calle', 'users.no_ext', 'users.no_int', 'users.cp', 'users.referencia')
                            ->leftJoin('countries','users.id_pais','=','countries.idpais')
                            ->leftJoin('township','users.id_municipio','=','township.iddelegacion')
                            ->leftJoin('cities','users.id_estado','=','cities.idciudad')
                            ->where('users.id_estatus','=',1)
                            ->orderBy('users.id','asc')
                            ->get();
            break;
            case in_array('Emp-03', $permission) && in_array('Emp-04', $permission) && in_array('Emp-05', $permission) && in_array('Emp-06', $permission)  && in_array('Emp-07', $permission) && in_array('Emp-08', $permission):
                $dataUser = DB::table('users')
                ->select('users.id', 'users.nombre_completo','users.tel_personal', 'users.email_personal', 'users.contacto_emergencia_nombre', 'relationships.nombre as Parentesco', 'users.contacto_emergencia_telefono', 'type_bloods.nombre as tipo_sangre', 'users.contacto_emergencia_padecimientos', 'users.contacto_emergencia_movil', 'catalog_company_position.nombre as Puesto', 'catalog_company_subcategories.nombre as Area', 'company_department.nombre as Departamento', 'groups_sysca.nombre as Campaña', 'company_structure_type.nombre as ejecucion_administrativa', 'ubicaciones.nombre as ubicacion', 'type_schedule.nombre as turno', 'users.fecha_ingreso', 'users.tel_laboral', 'users.email', 'companies_payment.nombre as empresa_pago', 'users.sueldo', 'users.fecha_pago', 'banks_catalog.nombre as banco', 'users.numero_cuenta_bancaria', 'users.clabe_inter_bancaria', 'users.usuario', 'status.nombre')
                                ->leftJoin('status','users.id_estatus','=','status.id')
                                ->leftJoin('banks_catalog','users.id_banco','=','banks_catalog.id')
                                ->leftJoin('companies_payment','users.id_empresa_rh','=','companies_payment.id')
                                ->leftJoin('catalog_company_position','users.id_puesto','=','catalog_company_position.id')
                                ->leftJoin('catalog_company_subcategories','users.id_subcategoria','=','catalog_company_subcategories.id')
                                ->leftJoin('company_department','users.id_departamento_empresa','=','company_department.id')
                                ->leftJoin('groups_sysca','users.id_campania','=','groups_sysca.id')
                                ->leftJoin('company_structure_type','users.ejecucion_administrativa','=','company_structure_type.id')
                                ->leftJoin('type_schedule','users.id_turno','=','type_schedule.id')
                                ->leftJoin('ubicaciones','users.id_ubicacion','=','ubicaciones.id')
                                ->leftJoin('relationships','users.contacto_emergencia_parentesco','=','relationships.id')
                                ->leftJoin('type_bloods','users.contacto_emergencia_tip_sangre','=','type_bloods.id')
                                ->where('users.id_estatus','=',1)
                                ->orderBy('users.id','asc')
                                ->get();
                break;

            //Datos de Contacto
            case in_array('Emp-03', $permission):
                $dataUser = DB::table('users')
                            ->select('users.id', 'users.nombre_completo','users.tel_personal', 'users.email_personal')
                            ->where('users.id_estatus','=',1)
                            ->orderBy('users.id','asc')
                            ->get();
            break;
            //Datos de Contacto de Emergencia
            case in_array('Emp-04', $permission):
                $dataUser = DB::table('users')
                            ->select('users.id', 'users.nombre_completo', 'users.contacto_emergencia_nombre', 'relationships.nombre as Parentesco', 'users.contacto_emergencia_telefono', 'type_bloods.nombre as tipo_sangre', 'users.contacto_emergencia_padecimientos', 'users.contacto_emergencia_movil')
                            ->leftJoin('relationships','users.contacto_emergencia_parentesco','=','relationships.id')
                            ->leftJoin('type_bloods','users.contacto_emergencia_tip_sangre','=','type_bloods.id')
                            ->where('users.id_estatus','=',1)
                            ->orderBy('users.id','asc')
                            ->get();
                break;
            //Datos Laborales
            case in_array('Emp-05', $permission):
                $dataUser = DB::table('users')
                                ->select('users.id', 'users.nombre_completo', 'catalog_company_position.nombre as Puesto', 'catalog_company_subcategories.nombre as Area', 'company_department.nombre as Departamento', 'groups_sysca.nombre as Campaña', 'company_structure_type.nombre as ejecucion_administrativa', 'ubicaciones.nombre as ubicacion', 'type_schedule.nombre as turno', 'users.fecha_ingreso', 'users.tel_laboral', 'users.email')
                                ->leftJoin('catalog_company_position','users.id_puesto','=','catalog_company_position.id')
                                ->leftJoin('catalog_company_subcategories','users.id_subcategoria','=','catalog_company_subcategories.id')
                                ->leftJoin('company_department','users.id_departamento_empresa','=','company_department.id')
                                ->leftJoin('groups_sysca','users.id_campania','=','groups_sysca.id')
                                ->leftJoin('company_structure_type','users.ejecucion_administrativa','=','company_structure_type.id')
                                ->leftJoin('type_schedule','users.id_turno','=','type_schedule.id')
                                ->leftJoin('ubicaciones','users.id_ubicacion','=','ubicaciones.id')
                                ->where('users.id_estatus','=',1)
                                ->orderBy('users.id','asc')
                                ->get();
            break;
            //Datos de Nómina
            case in_array('Emp-06', $permission):
                $dataUser = DB::table('users')
                                ->select('users.id', 'users.nombre_completo', 'companies_payment.nombre as empresa_pago', 'users.sueldo', 'users.fecha_pago')
                                ->leftJoin('companies_payment','users.id_empresa_rh','=','companies_payment.id')
                                ->where('users.id_estatus','=',1)
                                ->orderBy('users.id','asc')
                                ->get();
            break;

            //Datos de Cuenta Bancaria

            case in_array('Emp-07', $permission):
                $dataUser = DB::table('users')
                                ->select('users.id', 'users.nombre_completo', 'banks_catalog.nombre as banco', 'users.numero_cuenta_bancaria', 'users.clabe_inter_bancaria')
                                ->leftJoin('banks_catalog','users.id_banco','=','banks_catalog.id')
                                ->where('users.id_estatus','=',1)
                                ->orderBy('users.id','asc')
                                ->get();
            break;

            //Datos de Acceso

            case in_array('Emp-08', $permission):
                $dataUser = DB::table('users')
                            ->select('users.id', 'users.nombre_completo', 'users.usuario', 'status.nombre')
                            ->leftJoin('status','users.id_estatus','=','status.id')
                            ->where('users.id_estatus','=',1)
                            ->orderBy('users.id','asc')
                            ->get();
            break;

          
        }
        



        
                    return response()->json([
                        'status' => 'success',
                        'msg' => 'Datos obtenidos',
                       //'data' => $permission
                        'data' => $dataUser
                    ]);

    }


    public function getUsersAuthorized()
    {
        $usuario = DB::table('users')
                    ->select('users.id', 'users.nombre_completo')
                    ->join('status','users.id_estatus','=','status.id')
                    ->join('catalog_company_position','users.id_puesto','=','catalog_company_position.id')
                    ->where('status.id','=',1)
                    ->whereIn('catalog_company_position.id',[32, 34, 56])
                    ->orderBy('users.nombre_completo','asc')
                    ->get();

        return response()->json([
            'status' => 'success',
            'msg' => 'Usuarios authorizados',
            'data' => $usuario

        ]);
    }


    
    public function getUsersReceives()
    {
        $usuario = DB::table('users')
                    ->select('users.id', 'users.nombre_completo')
                    ->join('status','users.id_estatus','=','status.id')
                    ->join('catalog_company_position','users.id_puesto','=','catalog_company_position.id')
                    ->where('status.id','=',1)
                   // ->whereNotIn('catalog_company_position.id',[34, 56])
                   ->orderBy('users.nombre_completo','asc')
                   ->get();

        return response()->json([
            'status' => 'success',
            'msg' => 'Usuarios authorizados',
            'data' => $usuario

        ]);
    }


    public function getGraphCampaingTala(){
        $graph = DB::table('groups_sysca as g')
        ->select('u.nombre as name_location', DB::raw('COUNT(uu.id) as countAgents'),'uu.id_campania')
        ->join('users as uu', 'g.id', '=', 'uu.id_campania')
        ->leftJoin('ubicaciones as u', 'uu.id_ubicacion', '=', 'u.id')
        ->where('uu.id_estatus', 1)
        ->where('g.id', 1) // Filtros por campaña
        ->where('uu.id_puesto', 1)
        ->groupBy('u.id', 'u.nombre')
        ->orderBy('u.id')
        ->get();

        return response()->json([
            'status' => 'success',
            'msg' => 'Grafica Campaña - Tala',
            'data' => $graph
        ]);

    }

    public function getGraphCampaingCox(){
        $graph = DB::table('groups_sysca as g')
        ->select('u.nombre as name_location', DB::raw('COUNT(uu.id) as countAgents'),'uu.id_campania')
        ->join('users as uu', 'g.id', '=', 'uu.id_campania')
        ->leftJoin('ubicaciones as u', 'uu.id_ubicacion', '=', 'u.id')
        ->where('uu.id_estatus', 1)
        ->where('g.id', 2) // Filtros por campaña
        ->where('uu.id_puesto', 2)
        ->groupBy('u.id', 'u.nombre')
        ->orderBy('u.id')
        ->get();

        return response()->json([
            'status' => 'success',
            'msg' => 'Grafica Campaña - Cox',
            'data' => $graph
        ]);

    }

    
    public function getGraphCampaingSurfmed(){
        $graph = DB::table('groups_sysca as g')
        ->select('u.nombre as name_location', DB::raw('COUNT(uu.id) as countAgents'), 'uu.id_campania')
        ->join('users as uu', 'g.id', '=', 'uu.id_campania')
        ->leftJoin('ubicaciones as u', 'uu.id_ubicacion', '=', 'u.id')
        ->where('uu.id_estatus', 1)
        ->where('g.id', 3) // Filtros por campaña
        ->where('uu.id_puesto', 2)
        ->groupBy('u.id', 'u.nombre')
        ->orderBy('u.id')
        ->get();

        return response()->json([
            'status' => 'success',
            'msg' => 'Grafica Campaña - Surfmed',
            'data' => $graph
        ]);

    }

    public function getGraphCampaingBancoppel(){
        $graph = DB::table('groups_sysca as g')
        ->select('u.nombre as name_location', DB::raw('COUNT(uu.id) as countAgents'),'uu.id_campania')
        ->join('users as uu', 'g.id', '=', 'uu.id_campania')
        ->leftJoin('ubicaciones as u', 'uu.id_ubicacion', '=', 'u.id')
        ->where('uu.id_estatus', 1)
        ->where('g.id', 4) // Filtros por campaña
        ->where('uu.id_puesto', 1)
        ->groupBy('u.id', 'u.nombre')
        ->orderBy('u.id')
        ->get();

        return response()->json([
            'status' => 'success',
            'msg' => 'Grafica Campaña - Bancoppel',
            'data' => $graph
        ]);

    }

    public function getGraphCampaingMontePiedad(){
        $graph = DB::table('groups_sysca as g')
        ->select('u.nombre as name_location', DB::raw('COUNT(uu.id) as countAgents'),'uu.id_campania')
        ->join('users as uu', 'g.id', '=', 'uu.id_campania')
        ->leftJoin('ubicaciones as u', 'uu.id_ubicacion', '=', 'u.id')
        ->where('uu.id_estatus', 1)
        ->where('g.id', 5) // Filtros por campaña
        ->where('uu.id_puesto', 1)
        ->groupBy('u.id', 'u.nombre')
        ->orderBy('u.id')
        ->get();

        return response()->json([
            'status' => 'success',
            'msg' => 'Grafica Campaña - Monte de Piedad',
            'data' => $graph
        ]);

    }

    public function getGraphCampaingPeddle(){
        $graph = DB::table('groups_sysca as g')
        ->select('u.nombre as name_location', DB::raw('COUNT(uu.id) as countAgents'),'uu.id_campania')
        ->join('users as uu', 'g.id', '=', 'uu.id_campania')
        ->leftJoin('ubicaciones as u', 'uu.id_ubicacion', '=', 'u.id')
        ->where('uu.id_estatus', 1)
        ->where('g.id', 6) // Filtros por campaña
        ->where('uu.id_puesto', 2)
        ->groupBy('u.id', 'u.nombre')
        ->orderBy('u.id')
        ->get();

        return response()->json([
            'status' => 'success',
            'msg' => 'Grafica Campaña - Peddle',
            'data' => $graph
        ]);

    }

    public function getGraphCampaingShriners(){
        $graph = DB::table('groups_sysca as g')
        ->select('u.nombre as name_location', DB::raw('COUNT(uu.id) as countAgents'),'uu.id_campania')
        ->join('users as uu', 'g.id', '=', 'uu.id_campania')
        ->leftJoin('ubicaciones as u', 'uu.id_ubicacion', '=', 'u.id')
        ->where('uu.id_estatus', 1)
        ->where('g.id', 7) // Filtros por campaña
        ->where('uu.id_puesto', 2)
        ->groupBy('u.id', 'u.nombre')
        ->orderBy('u.id')
        ->get();

        return response()->json([
            'status' => 'success',
            'msg' => 'Grafica Campaña - Shriners',
            'data' => $graph
        ]);

    }

    public function getGraphCampaingGarnet(){
        $graph = DB::table('groups_sysca as g')
        ->select('u.nombre as name_location', DB::raw('COUNT(uu.id) as countAgents'),'uu.id_campania')
        ->join('users as uu', 'g.id', '=', 'uu.id_campania')
        ->leftJoin('ubicaciones as u', 'uu.id_ubicacion', '=', 'u.id')
        ->where('uu.id_estatus', 1)
        ->where('g.id', 8) // Filtros por campaña
        ->where('uu.id_puesto', 1)
        ->groupBy('u.id', 'u.nombre')
        ->orderBy('u.id')
        ->get();

        return response()->json([
            'status' => 'success',
            'msg' => 'Grafica Campaña - Garnet',
            'data' => $graph
        ]);

    }

    public function getCampaing(Request $request)
    {
        $id = $request['id']; // Metodo por GET
        $campaingDetail   = DB::table('groups_sysca as gs')
        ->select('id', 'nombre as campaing')
        ->where('id', $id)
        ->get();

        return response()->json([
            'status' => 'success',
            'msg' => 'Campaña a Detalle',
            'data' =>  $campaingDetail
        ]);
    }

    public function getCampaingDetailLeader(Request $request)
    {
        $id = $request['id']; // Metodo por GET
        $campaingDetail  = DB::table('users as u')
        ->select('u.numero_empleado', 'u.nombre_completo', 'u.curp','ccp.id', 'ccp.nombre as position')
        ->join('catalog_company_position as ccp', 'u.id_puesto', '=', 'ccp.id')
        ->where('u.id_estatus', 1)
        ->where('ccp.id', 37) 
        ->where('u.id_campania', $id)
        ->orderBy('ccp.id', 'desc')
        ->get();

        return response()->json([
            'status' => 'success',
            'msg' => 'Campaña a Detalle',
            'data' =>  $campaingDetail
        ]);
    }


    public function getCampaingDetailAgents(Request $request)
    {
        $id = $request['id']; // Metodo por GET
        $campaingDetail  = DB::table('users as u')
        ->select('u.numero_empleado', 'u.nombre_completo', 'u.curp', 'ccp.nombre as position')
        ->join('catalog_company_position as ccp', 'u.id_puesto', '=', 'ccp.id')
        ->where('u.id_estatus', 1)
        ->whereIn('ccp.id', [1, 2]) 
        ->where('u.id_campania', $id)
        ->orderBy('u.nombre_completo', 'asc')
        ->get();

        return response()->json([
            'status' => 'success',
            'msg' => 'Campaña a Detalle',
            'data' =>  $campaingDetail
        ]);
    }

    public function getCampaingDetailAnalyst(Request $request)
    {
        $id = $request['id']; // Metodo por GET
        $campaingDetail  = DB::table('users as u')
        ->select('u.numero_empleado', 'u.nombre_completo', 'u.curp','ccp.id', 'ccp.nombre as position')
        ->join('catalog_company_position as ccp', 'u.id_puesto', '=', 'ccp.id')
        ->where('u.id_estatus', 1)
        ->whereIn('ccp.id', [17, 18]) 
        ->where('u.id_campania', $id)
        ->orderBy('ccp.id', 'desc')
        ->get();

        return response()->json([
            'status' => 'success',
            'msg' => 'Campaña a Detalle',
            'data' =>  $campaingDetail
        ]);
    }


    public function getGraphStructure(){

          $graph = DB::table('users as u')
                    ->select([
                        DB::raw('COUNT(u.id_subcategoria) as countStructure'),
                        'ccs.nombre as nameStructure',
                    ])
                    ->join('catalog_company_subcategories as ccs', 'u.id_subcategoria', '=', 'ccs.id')
                    ->where('u.ejecucion_administrativa', 1)
                    ->where('u.id_estatus', 1)
                    ->groupBy('u.id_subcategoria', 'ccs.nombre')
                    ->get();
                return response()->json([
                    'status' => 'success',
                    'msg' => 'Grafica Estructura',
                    'data' => $graph
                ]);
        }

        public function getCountStructure(){

            $countStructure  = DB::table('users as u')
                                ->join('catalog_company_subcategories as ccs', 'u.id_subcategoria', '=', 'ccs.id')
                                ->where('u.ejecucion_administrativa', 1)
                                ->where('u.id_estatus', 1)
                                ->count('u.id_subcategoria');
        
                  return response()->json([
                      'status' => 'success',
                      'msg' => 'Total por Estructura',
                      'data' => $countStructure
                  ]);
          }


          public function getGraphStructureSalary(){

            $graph = DB::table('users')
                        ->select([
                            'company_structure_type.nombre AS nameStaff',
                            DB::raw("CONCAT(FORMAT((COUNT(users.ejecucion_administrativa) / (SELECT COUNT(*) FROM users WHERE id_estatus = 1)) * 100, 2), '%') AS percentage"),
                            DB::raw('COUNT(users.ejecucion_administrativa) AS countUser'),
                            DB::raw('SUM(users.sueldo) AS totalSalary'),
                        ])
                        ->join('company_structure_type', 'users.ejecucion_administrativa', '=', 'company_structure_type.id')
                        ->where('users.id_estatus', 1)
                        ->groupBy('users.ejecucion_administrativa', 'company_structure_type.nombre')
                        ->get();
                  return response()->json([
                      'status' => 'success',
                      'msg' => 'Grafica Estructura Sueldo',
                      'data' => $graph
                  ]);
          }



}
