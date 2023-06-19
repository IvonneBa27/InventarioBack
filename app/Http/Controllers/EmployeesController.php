<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Employees;
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
        // $param = $request->get('param');
        // $company = $request->get('company');
        // $users = Employees::where('nombre_completo', 'like', '%' . $param . '%')->orwhere('numero_empleado', 'like', '%' . $param . '%')->orwhere('curp', 'like', '%' . $param . '%')->get();


        // if($company  > 0 ){
        //     $users->where('id_compania', '=', $company );
        // }


        // $users = $users->get();

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
    public function create()
    {
        //
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
    public function update(Request $request, $id)
    {
        //
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
