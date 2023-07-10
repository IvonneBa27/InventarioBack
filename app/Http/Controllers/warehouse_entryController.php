<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\warehouse_entry;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\warehouse_entryPostRequest;
use Illuminate\Support\Facades\DB;

class warehouse_entryController extends Controller
{
    public function create(warehouse_entryPostRequest $request){

        $incomeStore = warehouse_entry::create([
            'warehouse_id'=>$request['warehouse_id'],
            'section_id'=>$request['section_id'],
            'warehouse_entry_type_id'=>$request['warehouse_entry_type_id'],
            'purchase_order_number'=>$request['purchase_order_number'],
            'invoice'=>$request['invoice'],
            'invoice_date'=>$request['invoice_date'],
            'provider_id'=>$request['provider_id'],
        ]);
         return response()->json([
             'status' => 'success',
             'msg' => 'Registro agregado',
             'data' => $incomeStore
         ]);
     }

     public function dataIncome(Request $request){
        //devuelve la información del ingreso de almacen
        return $request->warehouse_entry();
    }



     public function get(){
        $incomeStore= warehouse_entry::all();
            return response()->json([
             'status' => 'success',
             'msg' => 'Registros obtenidos correctamente',
             'data' =>  $incomeStore
         ]);
     }

     public function getListIncomeStore(){
        $incomeStore = DB::SELECT('CALL get_list_income_store()');
        return response()->json([
            'status' => 'success',
            'msg' => 'Lista de Ingresos de Almacen',
            'data' => $incomeStore
        ]);
     }
 

    public function getById(Request $request){  
        $id = $request->get('id'); 
        $incomeStore = warehouse_entry::find($id);    
        return response()->json([
            'status' => 'success',
            'msg' => 'Registro obtenido por Id',
            'data' => $incomeStore
        ]);
    } 
    
    
    public function update(Request $request){
        $incomeStore = warehouse_entry::find($request['id']);
        $incomeStore->observation=$request['observation'];
        $incomeStore->id_status=$request['id_status'];
        $incomeStore->user_id=$request['user_id'];
        $incomeStore->save();
        return response()->json([
            'status' => 'success',
            'msg'    => 'Registro detallado actualizado',
            'data'   =>  $incomeStore
        ]);

    }
    
}
   