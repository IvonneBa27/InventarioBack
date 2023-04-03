<?php

namespace App\Http\Controllers;
use App\Models\TipoUsuario;
use App\Models\Ubicaciones;
use App\Models\Empresa;
use App\Models\Sexo;
use App\Models\SubCategoria;
use App\Models\DomicilioUsuario;
use App\Models\EjecucionAdministrativa ;
use App\Models\Compania;
use App\Models\Puesto;
use App\Models\Banco;
use App\Models\Estatus;
use App\Models\Departamento;
use App\Models\Turno;
use App\Models\TipoModulo;
use App\Models\Usuario;






use Illuminate\Http\Request;

class GeneralController extends Controller
{
    //

    public function getTipoUsuario()
    {
       $tipoUsuario = TipoUsuario::where('id','!=',1)->where('id','!=',2)->get();
       return response()->json([
            'status' => 'success',
            'msg' => 'Tipo de Usuario obtenido correctamente',
            'data' => $tipoUsuario
        ]);
    }

    public function getUbicaciones()
    {
        $ubicaciones = Ubicaciones::all();
        return response()->json([
            'status' => 'success',
            'msg' => 'Ubicaciones obtenido correctamente',
            'data' => $ubicaciones
        ]);
    }

    public function getEmpresa()
    {
        $empresa = Empresa::all();
        return response()->json([
            'status' => 'success',
            'msg' => 'Empresa obtenido correctamente',
            'data' => $empresa
        ]);

    }
    public function getSexo()
    {
        $sexo = Sexo::all();
        return response()->json([
            'status' => 'success',
            'msg' => 'Sexo obtenido correctamente',
            'data' => $sexo
        ]);

    }
    public function getSubCategoria()
    {
        $subcategoria = SubCategoria::all();
        return response()->json([
            'status' => 'success',
            'msg' => 'SubCategoria obtenido correctamente',
            'data' => $subcategoria
        ]);
    }


    public function getDomicilioUsuario()
    {
        $domiciliousuario = DomicilioUsuario::all();
        return response()->json([
            'status' => 'success',
            'msg' => 'Domicilio obtenido correctamente',
            'data' => $domiciliousuario
        ]);

    }
    public function getEjecucionAdministrativa()
    {
        $ejecucionadministrativa = EjecucionAdministrativa::all();
        return response()->json([
            'status' => 'success',
            'msg' => 'Ejecucion Administrativa obtenido correctamente',
            'data' => $ejecucionadministrativa
        ]);

    }

    public function getCompania()
    {
        $compania = Compania::all();
        return response()->json([
            'status' => 'success',
            'msg' => 'Compania obtenido correctamente',
            'data' => $compania
        ]);

    }


    public function getPuesto()
    {
        $puesto = Puesto::all();
        return response()->json([
            'status' => 'success',
            'msg' => 'Puesto obtenido correctamente',
            'data' => $puesto
        ]);

    }
    public function getBanco()
    {
        $banco = Banco::all();
        return response()->json([
            'status' => 'success',
            'msg' => 'Banco obtenido correctamente',
            'data' => $banco
        ]);

    }

    public function getEstatus()
    {
       // $estatus = Estatus::where('id','!=',2)->where('id','!=',3)->get();
        $estatus = Estatus::all();
        return response()->json([
            'status' => 'success',
            'msg' => 'Estatus obtenido correctamente',
            'data' => $estatus
        ]);

    }
    public function getDepartamento()
    {
        $departamento = Departamento::all();
        return response()->json([
            'status' => 'success',
            'msg' => 'Departamento obtenido correctamente',
            'data' => $departamento
        ]);

    }
    public function getTurno()
    {
        $turno = Turno::all();
        return response()->json([
            'status' => 'success',
            'msg' => 'Turno obtenido correctamente',
            'data' => $turno
        ]);

    }

    public function getTipoModulo()
    {
        $tipomodulo = TipoModulo::all();
        return response()->json([
            'status' => 'success',
            'msg' => 'Tipo modulo obtenido correctamente',
            'data' => $tipomodulo
        ]);

    }




    public function searchUsers(Request $request){
        $param = $request->get('param');

        $users = Usuario::where('nombre_completo', 'like', '%'.$param.'%')->get();
        return response()->json([
            'status' => 'success',
            'message' => 'Usuarios obtenidos correctamente',
            'data' => $users
        ], 200);


    }







}
