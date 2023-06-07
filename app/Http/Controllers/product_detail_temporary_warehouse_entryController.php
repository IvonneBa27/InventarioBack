<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product_detail_temporary_warehouse_entry;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\product_detail_temporary_warehouse_entry;
use Illuminate\Support\Facades\DB;

class product_detail_temporary_warehouse_entryController extends Controller
    { 
    
    public function create(product_detail_temporary_warehouse_entryPostRequest $request){

        $product_detail_temporary_warehouse_entry = product_detail_temporary_warehouse_entry::create([
            'warehouse_entry_product_id'=>$request['warehouse_entry_product_id'],
            'serial_number'=>$request['serial_number'],
        ]);
        return response()->json([
            'status' => 'success',
            'msg' => 'Registro detallado agregado',
            'data' => $product_detail_temporary_warehouse_entry
        ]);
    }

    public function get(){
        $product_detail_temporary_warehouse_entry = product_detail_temporary_warehouse_entry::all();
            return response()->json([
            'status' => 'success',
            'msg' => 'Registros detallado obtenidos correctamente',
            'data' => $product_detail_temporary_warehouse_entry
        ]);
    }


    public function getById(Request $request){  
        $id = $request->get('id'); 
        $product_detail_temporary_warehouse_entry = product_detail_temporary_warehouse_entry::find($id);    
        return response()->json([
            'status' => 'success',
            'msg' => 'Registro detallado obtenido por Id',
            'data' =>  $product_detail_temporary_warehouse_entry
        ]);
    }  
}