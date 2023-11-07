<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StoresExit;
use App\Models\StoresExitDetails;
use App\Models\transferStore;
use App\Models\transferStoreDetail;
use App\Models\stores;
use App\Models\secctions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ReportsInventoryController extends Controller
{
    //

    public function getReportsInventoryAll(){
 
         $reports = DB::SELECT('CALL get_list_inventory_all()');
 
            return response()->json([
             'status' => 'success',
             'msg' => 'Reporte de Inventario',
             'data' => $reports
         ]);
     }

     public function getReportsInventory(Request $request){
        $inventory = $request->get('inventory');

        $reports  = DB::SELECT('CALL get_list_inventory(?)', [$inventory]);
        return response()->json([
            'status' => 'success',
            'msg' => 'Reporte de Inventarios por Inventario',
            'data' =>  $reports
        ]); 
    }

    public function getInventoryDetailAll(Request $request){
        $type_movement_id = $request->get('type_movement_id');
        $secction_id = $request->get('secction_id');
 
        $reports = DB::SELECT('CALL get_list_detail_all(?,?)', [$type_movement_id, $secction_id]);

           return response()->json([
            'status' => 'success',
            'msg' => 'Reporte de Inventario',
            'data' => $reports
        ]);
    }

    public function getInventoryDetail(Request $request){
        $inventory = $request->get('inventory');

        $reports  = DB::SELECT('CALL get_list_detail(?)', [$inventory]);
           return response()->json([
            'status' => 'success',
            'msg' => 'Reporte de Inventario',
            'data' => $reports
        ]);
    }


    public function getListProductDetail(Request $request){

        $type_movement_id = $request->get('type_movement_id');
        $secction_id = $request->get('secction_id');
        $product_id = $request->get('product_id');

        $reports  = DB::SELECT('CALL get_list_productDetail(?,?,?)', [$type_movement_id, $secction_id, $product_id]);
           return response()->json([
            'status' => 'success',
            'msg' => 'Reporte de Inventario',
            'data' => $reports
        ]);
    }
}
