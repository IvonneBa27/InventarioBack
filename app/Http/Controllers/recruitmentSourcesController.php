<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\RecritmentProspects;
use App\Models\TrakingRecruitment;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
class recruitmentSourcesController extends Controller
{

    public  function    index(){
        return response()->json([
            'status' => 'success',
            'msg' => 'Recritment obtenidos correctamente',
            'data' => RecritmentProspects::where('status','=', 1)->with('recluter', 'estado', 'seguimiento', 'traking')->get()
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
        $data = json_decode($request['payload'], true, 512, JSON_THROW_ON_ERROR) ;
        $url = '';
       
        if ($request->hasFile('pdf')) {
            // $archivo = $request->file('pdf');
            // $nombreArchivo = $archivo->getClientOriginalName();
            // $rutaAlmacenamiento = 'pdfs'; // Carpeta donde deseas almacenar los archivos

            // // Guardar el archivo en el sistema de archivos (por ejemplo, en storage/app/public/pdfs)
            // $archivo->storeAs($rutaAlmacenamiento, $nombreArchivo, 'public');

            // // Generar una URL para el archivo
            // $urlDescarga = Storage::url("public/{$rutaAlmacenamiento}/{$nombreArchivo}");

            // Realizar cualquier otra acción necesaria, como guardar la URL en la base de datos, etc.

            $pdf = $request->file('pdf');
            $pdf->store('pdfs', 'public'); // Almacena el PDF en el directorio "storage/app/public/pdfs"

            // Genera la URL de descarga
            $url = asset('storage/pdfs/' . $pdf->hashName());
        }

        $recruitment = RecritmentProspects::findOrFail($data['id']); // Usamos findOrFail para lanzar una excepción si no se encuentra el registro



            $recruitment->name = $data['name'];
            $recruitment->fecha_registro = $data['fecha_registro'];
            $recruitment->apellido_pat = $data['apellido_pat'];
            $recruitment->apellido_mat = $data['apellido_mat'];
            $recruitment->tipo_reclutamiento = $data['tipo_reclutamiento'];
            $recruitment->curp = $data['curp'];
            $recruitment->id_sexo = $data['id_sexo'];
            $recruitment->estado_civil = $data['estado_civil'];
            $recruitment->nacionalidad = $data['nacionalidad'];
            $recruitment->fuente_reclutamiento = $data['fuente_reclutamiento'];
            $recruitment->referido = $data['referido'];
            $recruitment->nombre_referido = $data['nombre_referido'];
            $recruitment->id_pais = $data['id_pais'];
            $recruitment->id_estado = $data['id_estado'];
            $recruitment->calle = $data['calle'];
            $recruitment->no_ext = $data['no_ext'];
            $recruitment->no_int = $data['no_int'];
            $recruitment->id_municipio = $data['id_municipio'];
            $recruitment->colonia = $data['colonia'];
            $recruitment->cp = $data['cp'];
            $recruitment->referencia = $data['referencia'];
            $recruitment->tel_personal = $data['tel_personal'];
            $recruitment->email_personal = $data['email_personal'];
            $recruitment->id_giro_industria = $data['id_giro_industria'];
            $recruitment->id_tiempo_experiencia = $data['id_tiempo_experiencia'];
            $recruitment->id_nivel_ingles = $data['id_nivel_ingles'];
            $recruitment->facilidad_palabra = $data['facilidad_palabra'];
            $recruitment->id_campaigns_sysca = $data['id_campaigns_sysca'];
            $recruitment->id_company_department = $data['id_company_department'];
            $recruitment->id_ubicaciones = $data['id_ubicaciones'];
            $recruitment->id_type_schedules = $data['id_type_schedules'];
            $recruitment->comentarios = $data['comentarios'];
            $recruitment->id_nivel_estudio = $data['id_nivel_estudio'];
            $recruitment->id_recluter = $data['id_recluter'];
            $recruitment->cv = $url;
        

            $recruitment->save();

        return response()->json([
            'status' => 'success',
            'msg' => 'Prospecto editado correctamente',
            'data' => $recruitment
        ]);

    }



    public function cargarPDF(Request $request)
    {

        
        if ($request->hasFile('pdf')) {
            $pdf = $request->file('pdf');
            $pdf->store('pdfs', 'public'); // Almacena el PDF en el directorio "storage/app/public/pdfs"

            // Genera la URL de descarga
            $url = asset('storage/pdfs/' . $pdf->hashName());


            return response()->json([
                'status' => 'success',
                'msg' => 'Prospecto editado correctamente',
                'data' => [],
                'url' => $url
            ]);
        }

        return response()->json(['error' => 'No se proporcionó un archivo PDF'], 400);
    }



    public function createTraking(Request $request)
    {
        $TrakingProspects = TrakingRecruitment::create($request->all());
        return response()->json([
            'status' => 'success',
            'msg' => 'Seguimiento agregado correctamente.',
            'data' => $TrakingProspects
        ]);
    }

    
}
