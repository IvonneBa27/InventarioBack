<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Employees;

use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CreateEmployeeRequest;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employeed = Employees::where('id_estatus', '=', 1)->with('gender', 'company', 'administrative_execution')->orderBy('numero_empleado', 'asc')->get();

        return response()->json([
            'status' => 'success',
            'msg' => 'Empleados obtenidos correctamente',
            'data' => $employeed

        ]);
    }

    public function searchEmployees(Request $request)
    {
        $param = $request->get('param');
        $company = $request->get('company');
        $status = $request->get('status');

        if(isset($param)){
            $users = Employees::where('nombre_completo', 'like', '%' . $param . '%')->with('gender', 'company', 'administrative_execution')
                ->orWhere('numero_empleado', 'like', '%' . $param . '%')
                ->orWhere('curp', 'like', '%' . $param . '%');
            if ($company > 0) {
                $users->orWhere('id_compania', '=', $company);
            }

        }else{
            $users = Employees::with('gender', 'company', 'administrative_execution');
            if ($company > 0) {
                $users->where('id_empresa_rh', '=', $company);
            }
        }

        if($status > 0){
            
            $users->where('id_estatus', '=', $status);
        }
        

        $users = $users->orderBy('numero_empleado', 'asc')->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Empleados obtenidos correctamente',
            'data' => $users
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CreateEmployeeRequest $request)
    {


        $usuario =  new Employees();
            $usuario->id_tipo_usuario  = 3;
            $usuario->usuario  = $request['usuario'];
            $usuario->nombre  = $request['nombre'];
            $usuario->apellido_pat  = $request['apellido_pat'];
            $usuario->apellido_mat  = (isset($request['apellido_mat'])) ? $request['apellido_mat'] : '';
            $usuario->id_ubicacion  = $request['id_ubicacion'];
            $usuario->id_empresa_rh  = $request['id_empresa_rh'];
            $usuario->email_personal  = $request['email_personal'];
            $usuario->email  = $request['email'];
            $usuario->password  = Hash::make($request['password']);
            $usuario->numero_empleado  = $request['numero_empleado'];
            $usuario->nombre_completo  =  $request['nombre'] . ' ' . $request['apellido_pat'] . ' ' . $request['apellido_mat'];
            $usuario->curp  = $request['curp'];
            $usuario->rfc  = $request['rfc'];
            $usuario->nss  = $request['nss'];
            $usuario->id_sexo  = $request['id_sexo'];
            $usuario->id_subcategoria  = $request['id_subcategoria'];
            $usuario->ejecucion_administrativa  = $request['ejecucion_administrativa'];

            $usuario->id_puesto  = $request['id_puesto'];
            $usuario->sueldo  = $request['sueldo'];
            $usuario->id_banco  = $request['id_banco'];
            $usuario->numero_cuenta_bancaria  = $request['numero_cuenta_bancaria'];
            $usuario->clabe_inter_bancaria  = $request['clabe_inter_bancaria'];
            $usuario->fecha_ingreso  = $request['fecha_ingreso'];
            $usuario->fecha_nacimiento  = $request['fecha_nacimiento'];
            $usuario->id_departamento_empresa  = $request['id_departamento_empresa'];
            $usuario->id_estatus  = $request['id_estatus'];
            $usuario->id_turno  = $request['id_turno'];

            $usuario->img_profile  = '-';


            $usuario->contacto_emergencia_nombre  = $request['contacto_emergencia_nombre'];
            $usuario->contacto_emergencia_parentesco  = $request['contacto_emergencia_parentesco'];
            $usuario->contacto_emergencia_telefono  = $request['contacto_emergencia_telefono'];
            $usuario->contacto_emergencia_tip_sangre  = $request['contacto_emergencia_tip_sangre'];
            $usuario->contacto_emergencia_padecimientos  = $request['contacto_emergencia_padecimientos'];
            $usuario->contacto_emergencia_movil  = $request['contacto_emergencia_movil'];
            $usuario->fecha_pago  = $request['fecha_pago'];




            $usuario->id_estado_civil  = $request['id_estado_civil'];
            $usuario->nacionalidad  = $request['nacionalidad'];
            $usuario->id_pais  = $request['id_pais'];
            $usuario->id_estado  = $request['id_estado']; 
            $usuario->id_municipio  = $request['id_municipio'];
            $usuario->calle  = $request['calle'];
            $usuario->tel_personal  = $request['tel_personal'];
            $usuario->save();

        return response()->json([
            'status' => 'success',
            'msg' => 'Empleado agregado correctamente.',
            'data' => $usuario,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $employee = Employees::find($request['id']);  //Get parametro por metodo post  

            $employee->usuario = $request['usuario'];
            $employee->nombre = $request['nombre'];
            $employee->apellido_pat = $request['apellido_pat'];
            $employee->apellido_mat =  $request['apellido_mat'];
            $employee->id_ubicacion = $request['id_ubicacion'];
            $employee->id_empresa_rh = $request['id_empresa_rh'];
            $employee->email_personal = $request['email_personal'];
            $employee->email = $request['email'];
            $employee->numero_empleado = $request['numero_empleado'];
            $employee->nombre_completo =  $request['nombre'] . ' ' . $request['apellido_pat'] . ' ' . $request['apellido_mat'];
            $employee->curp = $request['curp'];
            $employee->rfc = $request['rfc'];
            $employee->nss = $request['nss'];
            $employee->id_sexo = $request['id_sexo'];
            $employee->id_subcategoria = $request['id_subcategoria'];
            $employee->ejecucion_administrativa = $request['ejecucion_administrativa'];
            $employee->id_puesto = $request['id_puesto'];
            $employee->sueldo = $request['sueldo'];
            $employee->id_banco = $request['id_banco'];
            $employee->numero_cuenta_bancaria = $request['numero_cuenta_bancaria'];
            $employee->clabe_inter_bancaria = $request['clabe_inter_bancaria'];
            $employee->fecha_ingreso = $request['fecha_ingreso'];
            $employee->fecha_nacimiento = $request['fecha_nacimiento'];
            $employee->id_departamento_empresa = $request['id_departamento_empresa'];
            $employee->id_estatus = $request['id_estatus'];
            $employee->id_turno = $request['id_turno'];
            $employee->contacto_emergencia_nombre = $request['contacto_emergencia_nombre'];
            $employee->contacto_emergencia_parentesco = $request['contacto_emergencia_parentesco'];
            $employee->contacto_emergencia_telefono = $request['contacto_emergencia_telefono'];
            $employee->contacto_emergencia_tip_sangre = $request['contacto_emergencia_tip_sangre'];
            $employee->contacto_emergencia_padecimientos = $request['contacto_emergencia_padecimientos'];
            $employee->contacto_emergencia_movil = $request['contacto_emergencia_movil'];
            $employee->fecha_pago = $request['fecha_pago'];
            $employee->fecha_baja = $request['fecha_baja'];
            $employee->motivo_baja = $request['motivo_baja'];
            $employee->cause_id = $request['cause_id'];



            $employee->referencia = $request['referencia'];
            $employee->colonia = $request['colonia'];
            $employee->no_int = $request['no_int'];
            $employee->cp = $request['cp'];
            $employee->tel_laboral = $request['tel_laboral'];
            $employee->nacionalidad = $request['nacionalidad'];
            $employee->id_estado_civil = $request['id_estado_civil'];
            $employee->id_pais = $request['id_pais'];
            $employee->id_estado = $request['id_estado'];
            $employee->calle = $request['calle'];
            $employee->no_ext = $request['no_ext'];
            $employee->id_municipio = $request['id_municipio'];
            $employee->tel_personal = $request['tel_personal'];
     

            $employee->save();

        return response()->json([
            'status' => 'success',
            'msg' => 'Empleado actualizado correctamente.',
            'data' => $employee
        ]);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //Se cambia el estatus a Eliminado que es 3
    public function destroy(Request $request)
    {
        $id = $request->get('id');
        $employee = Employees::find($id);
        $employee->id_estatus = 3;
        $employee->save();


        return response()->json([
                'status' => 'success',
                'message' => 'Empleados eliminado correctamente',
                'data' => $employee
            ]);
    }
}
