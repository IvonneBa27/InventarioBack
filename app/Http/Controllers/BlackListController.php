<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CatalogCauseBlackList;
use App\Models\CatalogReasonBlackList;
use App\Models\EmployeesBlackList;
class BlackListController extends Controller
{
    public function index(){
        $blackList = EmployeesBlackList::where('id_status', '=', 1)->with('reasons', 'cause')->orderBy('date', 'DESC')->get();

        return response()->json([
            'status' => 'success',
            'msg' => 'Lista negra obtenida correctamente.',
            'data' => $blackList
        ]);
    }

    public function create(Request $request){
        
        try {
            $blackList = EmployeesBlackList::create($request->all());
            return response()->json([
                'status' => 'success',
                'msg' => 'Registro creado correctamente.',
                'data' => $blackList
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function update(Request $request){
        $employee = EmployeesBlackList::find($request['id']);

            $employee->apellido_pat = $request['apellido_pat'];
    $employee->apellido_mat = $request['apellido_mat'];
    $employee->name = $request['name'];
    $employee->curp = $request['curp'];
    $employee->id_reasons = $request['id_reasons'];
    $employee->id_cause = $request['id_cause'];
    $employee->description = $request['description'];
    $employee->id_status = $request['id_status'];
    $employee->id_user = $request['id_user'];
    $employee->save();

            return response()->json([
                'status' => 'success',
                'msg' => 'Registro actualizado correctamente.',
                'data' => $employee
            ]);
        }

    public function destroy(Request $request)
    {
        $id = $request->get('id');
        $employee = EmployeesBlackList::find($id);
        $employee->id_status = 2;
        $employee->save();


        return response()->json([
            'status' => 'success',
            'message' => 'Registro eliminado correctamente.',
            'data' => $employee
        ]);
    }


    public function search(Request $request)
    {
        $param = $request->get('param');



        if (isset($param)) {
            $users = EmployeesBlackList::where('name', 'like', '%' . $param . '%')
                ->where('id_status', '=', 1)
                ->orWhere('name', 'like', '%' . $param . '%')
                ->orWhere('apellido_pat', 'like', '%' . $param . '%')
                ->orWhere('apellido_mat', 'like', '%' . $param . '%')->with('reasons', 'cause')->orderBy('date', 'DESC')->get();
        } else {
            $users = EmployeesBlackList::where('id_status', '=', 1)->with('reasons', 'cause')->orderBy('date', 'DESC')->get();
        }


  

        return response()->json([
            'status' => 'success',
            'message' => 'Empleados obtenidos correctamente',
            'data' => $users
        ]);
    }

}
