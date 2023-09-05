<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\creditors;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\creditorsRequest;
use Illuminate\Support\Facades\DB;

class creditorsController extends Controller
{
    public function create(creditorsRequest $request){

     
        $creditors = creditors::create([
            'razon_social'=>$request['razon_social'],
            'rfc'=>$request['rfc'],
            'idPais'=>$request['idPais'],
            'idCiudad'=>$request['idCiudad'],
            'idMunicipio'=>$request['idMunicipio'],
            'calle'=>$request['calle'],
            'no_ext'=>$request['no_ext'],
            'no_int'=>$request['no_int'],
            'colonia'=>$request['colonia'],
            'cp'=>$request['cp'],
            'sitio_web'=>$request['sitio_web'],
            'url_map'=>$request['url_map'],
            'observaciones'=>$request['observaciones'],
            'dias_credito'=>$request['dias_credito'],
            'idBanco'=>$request['idBanco'],
            'no_cuenta'=>$request['no_cuenta'],
            'clabe_intenbancaria'=>$request['clabe_intenbancaria'],
            'nombre_completo'=>$request['nombre_completo'],
            'email'=>$request['email'],
            'tel_movil'=>$request['tel_movil'],
            'tel_trabajo'=>$request['tel_trabajo'],
            'ext'=>$request['ext'],
            'puesto'=>$request['puesto'],
            'idestatus'=>$request['idestatus'],
        ]);
         return response()->json([
             'status' => 'success',
             'msg' => 'Acreedor agregado',
             'data' => $creditors
         ]);
        }

        public function get()
        {
           $creditors = creditors::all();
            return response()->json([
                'status' => 'success',
                'msg' => 'Acreedores obtenidos correctamente',
                'data' => $creditors
            ]);
    
        }
   
        //Lista de Acreedores
        public function getListCreditors(){
           $creditors = DB::SELECT('CALL get_list_creditors()');
           return response()->json([
               'status' => 'success',
               'msg' => 'Lista de Acreedores',
               'data' => $creditors
           ]);
        }

        
     public function getById(Request $request){  
        $id = $request->get('id'); // Metodo por GET
        $creditors = creditors::where('id','=', $id)->get();
        return response()->json([
            'status' => 'success',
            'msg' => 'Usuario por id obtenido correctamente',
            'data' => $creditors
        ]);
    }


     public function update(Request $request){
        $creditors = creditors::find($request['id']);  //Get parametro por metodo post    
        $creditors->no_acreedor=$request['no_acreedor'];
        $creditors->razon_social=$request['razon_social'];
        $creditors->rfc=$request['rfc'];
        $creditors->idPais=$request['idPais'];
        $creditors->idCiudad=$request['idCiudad'];
        $creditors->idMunicipio=$request['idMunicipio'];
        $creditors->calle=$request['calle'];
        $creditors->no_ext=$request['no_ext'];
        $creditors->no_int=$request['no_int'];
        $creditors->colonia=$request['colonia'];
        $creditors->cp=$request['cp'];
        $creditors->sitio_web=$request['sitio_web'];
        $creditors->url_map=$request['url_map'];
        $creditors->observaciones=$request['observaciones'];
        $creditors->dias_credito=$request['dias_credito'];
        $creditors->idBanco=$request['idBanco'];
        $creditors->no_cuenta=$request['no_cuenta'];
        $creditors->clabe_intenbancaria=$request['clabe_intenbancaria'];
        $creditors->nombre_completo=$request['nombre_completo'];
        $creditors->email=$request['email'];
        $creditors->tel_movil=$request['tel_movil'];
        $creditors->tel_trabajo=$request['tel_trabajo'];
        $creditors->ext=$request['ext'];
        $creditors->puesto=$request['puesto'];
       
        $creditors->save();
        return response()->json([
            'status' => 'success',
            'msg' => 'Acreedor actualizado',
            'data' => $creditors
        ]);
    }

    public function delete(Request $request){
        $id = $request->get('id');
        $creditors=creditors::find($id);
        $creditors->idestatus=2;
        $creditors->save();
        /*$usuario->delete();*/
         return response()->json([
             'status' => 'success',
             'msg' => 'Acreedor eliminado',
             'data' => $creditors
         ]);
     }


     public function searchCreditors(Request $request){
        $param = $request->get('param');

        $creditors = creditors::where('razon_social', 'like', '%'.$param.'%')->orwhere('id', 'like', '%'.$param.'%')->orwhere('observaciones', 'like', '%'.$param.'%')->get();
        return response()->json([
            'status' => 'success',
            'message' => 'Acreedores obtenidos correctamente',
            'data' => $creditors
        ]);
    }

}
