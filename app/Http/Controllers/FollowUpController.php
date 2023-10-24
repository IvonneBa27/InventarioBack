<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FollowUp;

class FollowUpController extends Controller
{

    public function index(Request $request) {

        $param =
            $request->get('param');
            
        $folloups = FollowUp::where('id_prospect', '=', $param)->get();
        return response()->json([
            'status' => 'success',
            'msg' => 'Seguimientos obtenidos correctamente.',
            'data' => $folloups
        ]);
    }
    public function create( Request $request) {

        $FollowUp = FollowUp::create($request->all());
        return response()->json([
            'status' => 'success',
            'msg' => 'Seguimiento agregado correctamente.',
            'data' => $FollowUp
        ]);

    }
}
