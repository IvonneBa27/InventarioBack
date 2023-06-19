<?php

namespace App\Http\Controllers;
use App\Models\Suppliers;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\SuppliersPostRequest;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class SuppliersController extends Controller
{
    public function create(SuppliersPostRequest $request){

     
        $suppliers = Suppliers::create([
            //'no_proveedor'=>$request['id'],
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
             'msg' => 'Proveedor agregado',
             'data' => $suppliers
         ]);


     }

     public function get()
     {
        $suppliers = Suppliers::all();
         return response()->json([
             'status' => 'success',
             'msg' => 'Proveedores obtenidos correctamente',
             'data' => $suppliers
         ]);
 
     }

     //Lista de Proveedores
     public function getListSuplier(){
        $suppliers = DB::SELECT('CALL get_list_suppliers()');
        return response()->json([
            'status' => 'success',
            'msg' => 'Lista de Proveedores',
            'data' => $suppliers
        ]);
     }



     public function getById(Request $request){  
        $id = $request->get('id'); // Metodo por GET
        $suppliers = Suppliers::where('id','=', $id)->get();
        return response()->json([
            'status' => 'success',
            'msg' => 'Usuario por id obtenido correctamente',
            'data' => $suppliers
        ]);
    }


     public function update(Request $request){
        $suppliers = Suppliers::find($request['id']);  //Get parametro por metodo post    
        $suppliers->no_proveedor=$request['no_proveedor'];
        $suppliers->razon_social=$request['razon_social'];
        $suppliers->rfc=$request['rfc'];
        $suppliers->idPais=$request['idPais'];
        $suppliers->idCiudad=$request['idCiudad'];
        $suppliers->idMunicipio=$request['idMunicipio'];
        $suppliers->calle=$request['calle'];
        $suppliers->no_ext=$request['no_ext'];
        $suppliers->no_int=$request['no_int'];
        $suppliers->colonia=$request['colonia'];
        $suppliers->cp=$request['cp'];
        $suppliers->sitio_web=$request['sitio_web'];
        $suppliers->url_map=$request['url_map'];
        $suppliers->observaciones=$request['observaciones'];
        $suppliers->dias_credito=$request['dias_credito'];
        $suppliers->idBanco=$request['idBanco'];
        $suppliers->no_cuenta=$request['no_cuenta'];
        $suppliers->clabe_intenbancaria=$request['clabe_intenbancaria'];
        $suppliers->nombre_completo=$request['nombre_completo'];
        $suppliers->email=$request['email'];
        $suppliers->tel_movil=$request['tel_movil'];
        $suppliers->tel_trabajo=$request['tel_trabajo'];
        $suppliers->ext=$request['ext'];
        $suppliers->puesto=$request['puesto'];
       
        $suppliers->save();
        return response()->json([
            'status' => 'success',
            'msg' => 'Proveedor actualizado',
            'data' => $suppliers
        ]);
    }

    public function delete(Request $request){
        $id = $request->get('id');
        $suppliers=Suppliers::find($id);
        $suppliers->idestatus=2;
        $suppliers->save();
        /*$usuario->delete();*/
         return response()->json([
             'status' => 'success',
             'msg' => 'Proveedor eliminado',
             'data' => $suppliers
         ]);
     }






}
