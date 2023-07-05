<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customers;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CustomersPostRequest;
use Illuminate\Support\Facades\DB;


class CustomersController extends Controller
{
    
    public function create(CustomersPostRequest $request){

     
        $customers = Customers::create([
           // 'no_cliente'=>$request['no_cliente'],
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
            'cp_fiscal'=>$request['cp_fiscal'],
            'idUsoCfdi'=>$request['idUsoCfdi'],
            'idRegimenFiscal'=>$request['idRegimenFiscal'],
            'nombre_completo'=>$request['nombre_completo'],
            'email'=>$request['email'],
            'movil'=>$request['movil'],
            'tel_trabajo'=>$request['tel_trabajo'],
            'ext'=>$request['ext'],
            'puesto'=>$request['puesto'],
            'nombre_completo_tecnico'=>$request['nombre_completo_tecnico'],
            'email_tecnico'=>$request['email_tecnico'],
            'movil_tecnico'=>$request['movil_tecnico'],
            'tel_trabajo_tecnico'=>$request['tel_trabajo_tecnico'],
            'ext_tecnico'=>$request['ext_tecnico'],
            'puesto_tecnico'=>$request['puesto_tecnico'],
            'nombre_completo_pago'=>$request['nombre_completo_pago'],
            'email_pago'=>$request['email_pago'],
            'movil_pago'=>$request['movil_pago'],
            'tel_trabajo_pago'=>$request['tel_trabajo_pago'],
            'ext_pago'=>$request['ext_pago'],
            'puesto_pago'=>$request['puesto_pago'],
            'idestatus'=>$request['idestatus'],

        ]);
         return response()->json([
             'status' => 'success',
             'msg' => 'Cliente agregado',
             'data' => $customers
         ]);


     }


     public function get()
     {
         $customers = Customers::all();
         return response()->json([
             'status' => 'success',
             'msg' => 'Clientes obtenidos correctamente',
             'data' => $customers
         ]);
 
     }

     //Lista de Clientes
     public function getListCustomers()
     {
         $customers = DB::SELECT('CALL get_list_customers()');
         return response()->json([
             'status' => 'success',
             'msg' => 'Clientes obtenidos correctamente',
             'data' => $customers
         ]);
 
     }

     public function getById(Request $request){  
        $id = $request->get('id'); // Metodo por GET
        $customers = Customers::where('id','=', $id)->get();
        
        return response()->json([
            'status' => 'success',
            'msg' => 'Usuario por id obtenido correctamente',
            'data' => $customers
        ]);
    }




     public function update(Request $request){
        $customers = Customers::find($request['id']);  //Get parametro por metodo post    
        $customers->no_cliente=$request['no_cliente'];
        $customers->razon_social=$request['razon_social'];
        $customers->rfc=$request['rfc'];
        $customers->idPais=$request['idPais'];
        $customers->idCiudad=$request['idCiudad'];
        $customers->idMunicipio=$request['idMunicipio'];
        $customers->calle=$request['calle'];
        $customers->no_ext=$request['no_ext'];
        $customers->no_int=$request['no_int'];
        $customers->colonia=$request['colonia'];
        $customers->cp=$request['cp'];
        $customers->sitio_web=$request['sitio_web'];
        $customers->url_map=$request['url_map'];
        $customers->observaciones=$request['observaciones'];
        $customers->cp_fiscal=$request['cp_fiscal'];
        $customers->idUsoCfdi=$request['idUsoCfdi'];
        $customers->idRegimenFiscal=$request['idRegimenFiscal'];
        $customers->nombre_completo=$request['nombre_completo'];
        $customers->email=$request['email'];
        $customers->movil=$request['movil'];
        $customers->tel_trabajo=$request['tel_trabajo'];
        $customers->ext=$request['ext'];
        $customers->puesto=$request['puesto'];
        $customers->nombre_completo_tecnico=$request['nombre_completo_tecnico'];
        $customers->email_tecnico=$request['email_tecnico'];
        $customers->movil_tecnico=$request['movil_tecnico'];
        $customers->tel_trabajo_tecnico=$request['tel_trabajo_tecnico'];
        $customers->ext_tecnico=$request['ext_tecnico'];
        $customers->puesto_tecnico=$request['puesto_tecnico'];
        $customers->nombre_completo_pago=$request['nombre_completo_pago'];
        $customers->email_pago=$request['email_pago'];
        $customers->movil_pago=$request['movil_pago'];
        $customers->tel_trabajo_pago=$request['tel_trabajo_pago'];
        $customers->ext_pago=$request['ext_pago'];
        $customers->puesto_pago=$request['puesto_pago'];
       
        $customers->save();
        return response()->json([
            'status' => 'success',
            'msg' => 'Cliente actualizado',
            'data' => $customers
        ]);

     }

     public function delete(Request $request){
        $id = $request->get('id');
        $customers=Customers::find($id);
        $customers->idestatus=2;
        $customers->save();
        /*$usuario->delete();*/
         return response()->json([
             'status' => 'success',
             'msg' => 'Cliente eliminado',
             'data' => $customers
         ]);
     }

    






}
