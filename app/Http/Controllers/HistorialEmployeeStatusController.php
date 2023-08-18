<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HistorialEmployeeStatus;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\HistorialEmployeeStatusRequest;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class HistorialEmployeeStatusController extends Controller
{
    //Crear informacion en el historico
    public function create(HistorialEmployeeStatusRequest $request){
        $historialStatus = HistorialEmployeeStatus::create([
            'user_id'=>$request['user_id'],
            'employeed_id'=>$request['employeed_id'],
            'status_id'=>$request['status_id'],
            'reason_id'=>$request['reason_id'],
            'cause_id'=>$request['cause_id'],
            'date'=>$request['date'],
        ]);
        return response()->json([
            'status' => 'success',
            'msg' => 'Historico agregado',
            'data' => $historialStatus
        ]);

    }

    public function sendEmail(Request $request)
    {
      $id = $request->id;

       $email = 'ivonne.baca@dirsamexico.com';
        $historialStatus  = DB::SELECT('CALL get_list_historical_status_employee(?)', [$id]);
      
                          if (count($historialStatus) > 0) {

    
                            $full_name = $historialStatus[0] -> full_name;
                            $employee_number = $historialStatus[0] -> employee_number;
                            $position = $historialStatus[0] -> position;
                            $responsible = $historialStatus[0] -> responsible;
                            $low_date = $historialStatus[0] -> low_date;
                            $reason = $historialStatus[0] -> reason;
                            $cause = $historialStatus[0] -> cause;
                           
                          $emailData = [
                            'to' => $email,
                            'subject' => 'BAVER Do It Right - Baja de empleado',
                            'message' => '<!DOCTYPE HTML>
                              <html>
                              <head>
                                  <meta charset="utf-8">
                              </head>
                              <body bgcolor="#FFFFFF">
                                  <table width="650" border="0" align="center" cellpadding="0" cellspacing="0"
                                      style="border-collapse: separate; border-spacing: 10px;">
                                      <tr>
                                          <td width="25">&nbsp;</td>
                                          <td>
                                              <table width="100%" align="center" border="0" cellspacing="0" cellpadding="0"
                                                  style="vertical-align: top; font-family: arial; font-size: 12px; color: #7a7a7a; ">
                                                  <tr>
                                                      <td>
                                                          <div style="left: 0;padding: 12px;width: 190px;"><img
                                                                  src="https://intranet.doitright.solutions/admin/img/logotipo_doitright.png"
                                                                  width="160"></div>
                                                      </td>
                                                      <td>&nbsp;</td>
                                                      <td>
                                                          <h1 style="color:#999; font:normal normal 24px/1.2 Arial, Helvetica, sans-serif">Sistema BAVER <br>
                                                                                                                                           Do It Right Solutions</h1>
                                                      </td>
                                                  </tr>
                                                  <tr>
                                                      <td colspan="3">&nbsp;</td>
                                                  </tr>
                                              </table>
                                          </td>
                                          <td width="25">&nbsp;</td>
                                      </tr>
                                      <tr>
                                          <td>&nbsp;</td>
                                          <td>
                                              <table width="600" align="center" border="0" cellspacing="0" cellpadding="0"
                                                  style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#7a7a7a; line-height:1.4;">
                                                  <tr>
                                                      <td>&nbsp;</td>
                                                  </tr>
                                                  <tr style="height:150px; vertical-align:top;">
                                                      <td>&nbsp;</td>
                                                      <td>
                                                          <table width="100%" border="0" cellspacing="0" cellpadding="0"
                                                              style="text-align:left; color:#666;">
                                                              <tr>
                                                                  <th scope="row" style="font-size: 18px;">Baja del empleado: </th>
                                                              </tr>
                                                              <tr>
                                                                  <th scope="row" style="font-size: 20px; text-align: center;"> ' . $full_name . '</th>
                                                              </tr>
                                                              <tr style="margin-top: 15px;">
                                                                  <th scope="row" style="font-size: 18px;">Num. Empleado:  ' . $employee_number . '</th>
                                                              </tr>
                                                              <tr style="margin-top: 15px;">
                                                                  <th scope="row" style=" font-size: 18px;">Puesto:  '.$position .'</th>
                                                              </tr>
                                                              <tr style="margin-top: 15px;">
                                                                  <th scope="row" style="font-size: 18px;"> </th>
                                                             </tr>
                                                             <tr style="margin-top: 15px;">
                                                                  <th scope="row" style="font-size: 18px;">Realizado por:  ' . $responsible . '</th>
                                                            </tr>
                                                            <tr style="margin-top: 15px;">
                                                                <th scope="row" style="font-size: 18px;">Fecha:  ' . $low_date . '</th>
                                                            </tr>
                                                            <tr style="margin-top: 15px;">
                                                                <th scope="row" style="font-size: 18px;">Motivo:  ' . $reason . '</th>
                                                            </tr>
                                                            <tr style="margin-top: 15px;">
                                                                <th scope="row" style="font-size: 18px;">Causa:  ' . $cause . '</th>
                                                            </tr>
                                                
                                                              <tr style="margin-top: 15px;">
                                                                  <th scope="row" style=" font-size: 18px;">Para ingresar al sistema BAVER <a href="http://10.150.80.252:3200/#/login">haz click aquí</a>
                                                                      </th>
                                                              </tr>
                                                          </table>
                                                      </td>
                                                  </tr>
                                                  <tr>
                                                      <td>&nbsp;</td>
                                                      <td><strong>
                                                              <p>Do It Right S.A. de C.V. Av. Gustavo Baz Prada 98-Piso 7, Industrial, Alce Blanco
                                                                  C.P.53370 Naucalpan de Juárez,
                                                                  Estado de México, México. <a
                                                                      href="mailto:desarrollo@dirsamexico.com">desarrollo@dirsamexico.com</a> 01
                                                                  (+52) 5571581257</p>
                                                          </strong>
                                                      </td>
                                                      <td>&nbsp;</td>
                                                  </tr>
                                              </table>
                                          </td>
                                      </tr>
                                      <tr>
                                          <td align="center">&nbsp;</td>
                                          <td style="font-family:Arial, Helvetica, sans-serif; font-size:11px;color:#7a7a7a; line-height:1.4;">
                                              <p>La información transmitida está destinada solo a la persona que se dirige este material o contenido
                                                  el cual es confidencial. Cualquier modificación, difusión u otro uso en base a esta información por
                                                  personas o entidades distintas al destinatario está prohibido. Si recibió este correo por error,
                                                  favor de contactar al remitente y eliminar el material re su equipo de cómputo.</p>
                                          </td>
                                          <td align="center">&nbsp;</td>
                                      </tr>
                                  </table>
                              </body>
                              </html>
                             
                              '];

                              Mail::send([], $emailData, function ($message) use ($emailData) {
                                  $message->to($emailData['to'])
                                      ->subject($emailData['subject'])
                                      ->setBody($emailData['message'], 'text/html');
                              });
                  
                              return response()->json([
                                'status' => 'success', 
                                'message' => 'Se envió baja de empleado por correo', 
                                'data' => $email
                              ]);
                            }

    }




}
