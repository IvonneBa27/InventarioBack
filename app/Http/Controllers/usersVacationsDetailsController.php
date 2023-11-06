<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\usersVacationsDetailsRequest;
use App\Models\usersVacationsDetails;

class usersVacationsDetailsController extends Controller
{
    //
    public function create(usersVacationsDetailsRequest $request){

        $usersVacationsDetails= usersVacationsDetails::create([
        'vacation_id' => $request['vacation_id'],
        'application_date' => $request['application_date'],
        'days_requested' => $request['days_requested'],
        'start_date' => $request['start_date'],
        'end_date' => $request['end_date'],
        'observations' => $request['observations'],
    ]);


    return response()->json([
        'status' => 'success',
        'msg' => 'Registro de Detalle de Vacaciones',
        'data' => $usersVacationsDetails
    ]);
}
}
