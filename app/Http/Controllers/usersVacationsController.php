<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\usersVacationsRequest;
use App\Models\usersVacations;

class usersVacationsController extends Controller
{
    //

    public function create(usersVacationsRequest $request){

            $usersVacations = usersVacations::create([
            'user_id' => $request['user_id'],
            'admission_date' => $request['admission_date'],
            'period' => $request['period'],
            'total_days' => $request['total_days'],
            'status_id' => $request['status_id'],
            'admin_user_id' => $request['admin_user_id'],
        ]);
    

        return response()->json([
            'status' => 'success',
            'msg' => 'Registro de Vacaciones',
            'data' => $usersVacations
        ]);
    }
}
