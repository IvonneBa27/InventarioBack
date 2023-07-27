<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Carbon\Carbon;
use App\Models\exchangeRate;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\exchangeRateRequest;
use Illuminate\Support\Facades\DB;

class ExchangeRateController extends Controller
{
    //

    public function getExchangeRate(){
        $endpoint = "https://www.banxico.org.mx/SieAPIRest/service/v1/series/SF43718/datos";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // deshabilitar la verificación del certificado SSL

        $headers = array();
        $headers[] = "Bmx-Token: 1ce547e50daece9e432a4b55c3dc44f8b7158b207f4f0e40d54422e1abf754b4";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $resultado = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        $json = json_decode($resultado);
        $datos = $json->bmx->series[0]->datos;

        $venta = $datos[count($datos) - 1]->dato; //valor de venta del dólar más reciente
        $compra = $datos[count($datos) - 2]->dato; //valor de compra del dólar más reciente
        $fechaActual = Carbon::now();

        $exchangeRate = exchangeRate::create([
            'exchange_rate_sale'=>$venta,
            'exchange_rate_sale_doit'=>$venta,
            'exchange_rate_buy'=>$compra,
            'exchange_rate_buy_doit'=>$compra,
            'date'=>$fechaActual,
            'user_id'=>1,
        ]);

        return response()->json([
            'status' => 'success',
            'msg' => 'Valores obtenidos correctamente.',
            'data' => $exchangeRate
        ]);
    }


    public function get(){
        $exchangeRate = DB::table('exchange_rate')
                          ->select('*')
                          ->orderBy('date','desc')
                          ->get();
           return response()->json([
            'status' => 'success',
            'msg' => 'Registros de tipo de dato obtenidos correctamente',
            'data' => $exchangeRate
        ]);
    }

    public function getId(Request $request){
        $id = $request->get('id'); 
        $exchangeRate = exchangeRate::find($id);

           return response()->json([
            'status' => 'success',
            'msg' => 'Registro obtenido',
            'data' => $exchangeRate
        ]);
    }

    public function update(Request $request){
        $exchangeRate = exchangeRate::find($request['id']);  //Get parametro por metodo post    
        $exchangeRate->exchange_rate_sale_doit=$request['exchange_rate_sale_doit'];
        $exchangeRate->exchange_rate_buy_doit=$request['exchange_rate_buy_doit'];
        $exchangeRate->user_id=$request['user_id'];
        $exchangeRate->save();
        return response()->json([
            'status' => 'success',
            'msg'    => 'Tipo de cambio actualizado',
            'data'   => $exchangeRate
        ]);
     }

     public function searchExchange(Request $request){
        $startDate = $request->get('startDate');
        $endDate = $request->get('endDate');  
          $exchangeRate =   DB::table('exchange_rate')
                                ->select('*')
                                ->where('date','>=',$startDate)
                                ->where('date','<',$endDate)
                                ->get();
        return response()->json([
            'status' => 'success',
            'msg' => 'Valores obtenidos correctamente.',
            'data Inicio' => $startDate,
            'data Fin' => $endDate,
            'data' => $exchangeRate 
        ]);
    }

}
    

