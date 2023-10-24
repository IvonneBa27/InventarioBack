<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\RecritmentProspects;
use Carbon\Carbon;

class recruitmentSourcesController extends Controller
{

    public  function    index(){
        return response()->json([
            'status' => 'success',
            'msg' => 'Recritment obtenidos correctamente',
            'data' => RecritmentProspects::where('status','=', 1)->with('recluter', 'estado', 'seguimiento')->get()
        ]);
    }


    public function create(Request $request) {
        $RecritmentProspects = RecritmentProspects::create($request->all());
        return response()->json([
            'status' => 'success',
            'msg' => 'Prospecto agregado correctamente.',
            'data' => $RecritmentProspects
        ]);


    }

    public function filterParams(Request $request)
    {
        $param =
        $request->get('param');

        $result = RecritmentProspects::where('status','=', 1)->where('name', 'like', '%' . $param . '%')->orWhere('tel_personal', 'like', '%' . $param . '%')->orWhere('email_personal', 'like', '%' . $param . '%')->with('recluter', 'estado')->get();
        return response()->json([
            'status' => 'success',
            'msg' => 'Recritment obtenidos correctamente',
            'data' => $result
        ]);

    }


    public function filterDates(Request $request)
    {
        $inicio =
            $request->get('inicio');

        $fin =
            $request->get('fin');

        $result = RecritmentProspects::where('status','=', 1)->whereBetween('fecha_registro', [$inicio, $fin])->with('recluter', 'estado')->get();

        return response()->json([
            'status' => 'success',
            'msg' => 'Recritment obtenidos correctamente',
            'data' => $result
        ]);
    }

    public function delete( Request $request){
        $param =
            $request->get('param');

        $prospect = RecritmentProspects::find($param);

        $prospect->status = 2;
        $prospect->save();
        return response()->json([
            'status' => 'success',
            'msg' => 'Prospecto eliminado correctamente',
            'data' => $prospect
        ]);
    }

    public function getDetail( Request $request) {
        $id = $request->get('id');

        

        return response()->json([
            'status' => 'success',
            'msg' => 'Prospecto eliminado correctamente',
            'data' => RecritmentProspects::find($id)
        ]);
    }


    public function update( Request $request){



        $recruitment = RecritmentProspects::findOrFail($request->id); // Usamos findOrFail para lanzar una excepción si no se encuentra el registro

        $recruitment->update($request->only([
            "name",
            "fecha_registro",
            "apellido_pat",
            "apellido_mat",
            "tipo_reclutamiento",
            "curp",
            "id_sexo",
            "estado_civil",
            "nacionalidad",
            "fuente_reclutamiento",
            "referido",
            "nombre_referido",
            "id_pais",
            "id_estado",
            "calle",
            "no_ext",
            "no_int",
            "id_municipio",
            "colonia",
            "cp",
            "referencia",
            "tel_personal",
            "email_personal",
            "id_giro_industria",
            "id_tiempo_experiencia",
            "id_nivel_ingles",
            "facilidad_palabra",
            "id_campaigns_sysca",
            "id_company_department",
            "id_ubicaciones",
            "id_type_schedules",
            "comentarios",
            "id_nivel_estudio",
            "id_recluter"]));


        return response()->json([
            'status' => 'success',
            'msg' => 'Prospecto editado correctamente',
            'data' => $request->id_nivel_estudio
        ]);

    }





  

    
}
