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
        $users = Employees::where('nombre_completo', 'like', '%' . $param . '%')->with('gender', 'company', 'administrative_execution')
            ->orWhere('numero_empleado', 'like', '%' . $param . '%')
            ->orWhere('curp', 'like', '%' . $param . '%');

        if ($company > 0) {
            $users->where('id_compania', '=', $company);
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


        $usuario = Employees::create([
            'id_tipo_usuario' => 3,
            'usuario' => $request['usuario'],
            'nombre' => $request['nombre'],
            'apellido_pat' => $request['apellido_pat'],
            'apellido_mat' => (isset($request['apellido_mat'])) ? $request['apellido_mat'] : '',
            'id_ubicacion' => $request['id_ubicacion'],
            'id_empresa_rh' => $request['id_empresa_rh'],
            'email_personal' => $request['email_personal'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'numero_empleado' => $request['numero_empleado'],
            'nombre_completo' =>  $request['nombre'] . ' ' . $request['apellido_pat'] . ' ' . $request['apellido_mat'],
            'curp' => $request['curp'],
            'rfc' => $request['rfc'],
            'nss' => $request['nss'],
            'id_sexo' => $request['id_sexo'],
            'id_subcategoria' => $request['id_subcategoria'],
            'ejecucion_administrativa' => $request['ejecucion_administrativa'],

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

            'img_profile' => '-',


            'contacto_emergencia_nombre' => $request['contacto_emergencia_nombre'],
            'contacto_emergencia_parentesco' => $request['contacto_emergencia_parentesco'],
            'contacto_emergencia_telefono' => $request['contacto_emergencia_telefono'],
            'contacto_emergencia_tip_sangre' => $request['contacto_emergencia_tip_sangre'],
            'contacto_emergencia_padecimientos' => $request['contacto_emergencia_padecimientos'],
            'contacto_emergencia_movil' => $request['contacto_emergencia_movil'],
            'fecha_pago' => $request['fecha_pago'],


        ]);
        return response()->json([
            'status' => 'success',
            'msg' => 'Empleado agregado correctamente.',
            'data' => $usuario
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
    public function destroy($id)
    {
        //
    }
}
