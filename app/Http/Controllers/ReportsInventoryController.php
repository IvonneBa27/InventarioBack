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

    public function getInventoryDetailAll(){
 
        $reports = DB::SELECT('CALL get_list_detail_all()');

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
        $idcategory = $request->get('idcategory');

        $reports  = DB::SELECT('CALL get_list_productDetail(?)', [$idcategory]);
           return response()->json([
            'status' => 'success',
            'msg' => 'Reporte de Inventario',
            'data' => $reports
        ]);
    }
}
