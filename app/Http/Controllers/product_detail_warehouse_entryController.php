<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product_detail_warehouse_entry;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\product_detail_warehouse_entryPostRequest;
use Illuminate\Support\Facades\DB;

class product_detail_warehouse_entryController extends Controller
{
    public function create(product_detail_warehouse_entryPostRequest $request){

        $productDetail= product_detail_warehouse_entry::create([
            'warehouse_entry_detail_id'=>$request['warehouse_entry_detail_id'],
            'product_id'=>$request['product_id'],
            'product_name'=>$request['product_name'],
            'brand_name'=>$request['brand_name'],
            'sku'=>$request['sku'],
            'id_movement'=>$request['id_movement'],
        ]);
        return response()->json([
            'status' => 'success',
            'msg' => 'Registro detallado agregado',
            'data' => $productDetail
        ]);
    }

    public function get(){
        $productDetail = product_detail_warehouse_entry::all();
            return response()->json([
            'status' => 'success',
            'msg' => 'Registros detallado obtenidos correctamente',
            'data' => $productDetail
        ]);
    }

    public function getById(Request $request){  
        $warehouse_entry_detail_id = $request->get('warehouse_entry_detail_id');  
       $productDetail= 
       DB::table('product_income_store_detail')
            ->select('*')
            ->where('warehouse_entry_detail_id','=', $warehouse_entry_detail_id)
            ->get();

        return response()->json([
            'status' => 'success',
            'msg'  => 'Registro detallado obtenido por Id',
            'data' => $productDetail
        ]);
    } 
    
    public function getListIncomeProduct(Request $request)
    {
        $idIncome = $request->get('id'); 
        $productDetail= 
        DB::table('product_income_store_detail')
             ->select('product_income_store_detail.id as idDet', 'product_income_store_detail.*')
            ->where('product_income_store_detail.warehouse_entry_detail_id','=', $idIncome)
            ->get();

        return response()->json([
                'status' => 'success',
                'msg'  => 'Registro detallado por Almacen y Seccion',
                'data' => $productDetail
            ]);
    }

    public function update(Request $request){
        $productDetail = product_detail_warehouse_entry::find($request['id']);
        $productDetail->serial_number=$request['serial_number'];
        $productDetail->save();
        return response()->json([
            'status' => 'success',
            'msg'    => 'Registro detallado actualizado',
            'data'   =>  $productDetail
        ]);

    }
    
    
   


}