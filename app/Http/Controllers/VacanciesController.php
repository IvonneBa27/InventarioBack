<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vacancies;
use App\Http\Requests\VacanciesRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class VacanciesController extends Controller
{
    //
      //Crear datos en la tabla Vacantes
      public function create(VacanciesRequest $request){
        $vacancies = Vacancies::create([
         'date'=>$request['date'],
         'id_position'=>$request['id_position'],
         'id_company'=>$request['id_company'],
         'id_department'=>$request['id_department'],
         'id_type_structure'=>$request['id_type_structure'],
         'id_type_schedule'=>$request['id_type_schedule'],
         'id_campaing'=>$request['id_campaing'], 
         'id_location'=>$request['id_location'],
         'id_age_range'=>$request['id_age_range'],
         'id_academic_level'=>$request['id_academic_level'],
         'id_job_experience'=>$request['id_job_experience'],
         'vacancy_numbers'=>$request['vacancy_numbers'],
         'salary'=>$request['salary'],
         'required_skills'=>$request['required_skills'], 
         'id_asiggned'=>$request['id_asiggned'],
         'user_id'=>$request['user_id'],
         'id_status'=>$request['id_status'],
         'deadline' =>$request['deadline'],

          ]);
         
          return response()->json([
             'status' => 'success',
             'msg' => 'Nueva vacante agregada',
             'data' =>  $vacancies
              ]);
          }


    //Lista de Vacantes
     public function getListVacancies(Request $request){    
        $vacancies =
                DB::table('vacancies_list')
                ->select('vacancies_list.id','vacancies_list.date', 'catalog_company_position.nombre as position', 'groups_sysca.nombre as campaing', 'users.nombre_completo as requester', 'status.nombre as status')
                ->join('status','vacancies_list.id_status','=','status.id')
                ->join('catalog_company_position','vacancies_list.id_position','=','catalog_company_position.id')
                ->leftjoin('groups_sysca','vacancies_list.id_campaing','=','groups_sysca.id')
                ->join('users','vacancies_list.user_id','=','users.id')
                ->get();
     
         return response()->json([
                 'status' => 'success',
                 'msg' => 'Lista de Vacantes',
                 'data' =>  $vacancies
         ]);
     }


     
    public function sendEmail(Request $request)
    {
      $id = $request->id;

     //$email = 'ivonne.baca@dirsamexico.com';
       $email = 'erick.nava@dirsamexico.com';
           $vacancies = DB::table('vacancies_list')
           ->select('catalog_company_position.nombre as position', 'users.nombre_completo as full_name', 'vacancies_list.date', 'vacancies_list.deadline', 'type_schedule.nombre as type_schedule', 'ubicaciones.nombre as location', 'catalog_company_subcategories.nombre as company', 'company_department.nombre as department', 'groups_sysca.nombre as campaing', 'company_structure_type.nombre as type_structure', 'vacancies_list.vacancy_numbers', 'vacancies_list.salary')
                          ->join('catalog_company_position','vacancies_list.id_position','=','catalog_company_position.id')
                          ->join('users','vacancies_list.user_id','=','users.id')
                          ->join('type_schedule','vacancies_list.id_type_schedule','=','type_schedule.id')
                          ->join('ubicaciones','vacancies_list.id_location','=','ubicaciones.id')
                          ->join('catalog_company_subcategories','vacancies_list.id_company','=','catalog_company_subcategories.id')
                          ->join('company_department','vacancies_list.id_department','=','company_department.id')
                          ->leftJoin('groups_sysca','vacancies_list.id_campaing','=','groups_sysca.id')
                          ->join('company_structure_type','vacancies_list.id_type_structure','=','company_structure_type.id')
                          ->where('vacancies_list.id','=',$id)
                          ->get();

                          if (count($vacancies) > 0) {

                            $position = $vacancies[0] -> position;
                            $full_name = $vacancies[0] -> full_name;
                            $date = $vacancies[0] -> date;
                            $deadline = $vacancies[0] -> deadline;
                            $type_schedule = $vacancies[0] -> type_schedule;
                            $location = $vacancies[0] -> location;
                            $company = $vacancies[0] -> company;
                            $department = $vacancies[0] -> department;
                            $campaing = $vacancies[0] -> campaing ;
                            $type_structure = $vacancies[0] -> type_structure;
                            $vacancy_numbers = $vacancies[0] -> vacancy_numbers;
                            $salary = $vacancies[0] -> salary;

                          $emailData = [
                            'to' => $email,
                            'subject' => 'BAVER Do It Right - Solicitud de vacante nueva',
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
                                                          <h1 style="color:#999; font:normal normal 24px/1.2 Arial, Helvetica, sans-serif">Sistema BAVER v1.0</h1>
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
                                                                  <th scope="row" style="font-size: 18px;">Solicitud de vacante nueva para: </th>
                                                              </tr>
                                                              <tr>
                                                                  <th scope="row" style="font-size: 20px; text-align: center;"> ' . $position . '</th>
                                                              </tr>
                                                              <tr style="margin-top: 15px;">
                                                                  <th scope="row" style="font-size: 18px;">Solicitante:  ' . $full_name . '</th>
                                                              </tr>
                                                              <tr style="margin-top: 15px;">
                                                                  <th scope="row" style=" font-size: 18px;">Fecha Solicitud:  '.$date .'</th>
                                                              </tr>
                                                              <tr style="margin-top: 15px;">
                                                                  <th scope="row" style="font-size: 18px;">Limite:  ' . $deadline . '</th>
                                                             </tr>
                                                             <tr style="margin-top: 15px;">
                                                                  <th scope="row" style="font-size: 18px;">Turno:  ' . $type_schedule . '</th>
                                                            </tr>
                                                            <tr style="margin-top: 15px;">
                                                                <th scope="row" style="font-size: 18px;">Ubicación:  ' . $location . '</th>
                                                            </tr>
                                                            <tr style="margin-top: 15px;">
                                                                <th scope="row" style="font-size: 18px;">Área:  ' . $company . '</th>
                                                            </tr>
                                                            <tr style="margin-top: 15px;">
                                                                <th scope="row" style="font-size: 18px;">Departamento:  ' . $department . '</th>
                                                            </tr>
                                                            <tr style="margin-top: 15px;">
                                                                <th scope="row" style="font-size: 18px;">Campaña:  ' . $campaing. '</th>
                                                            </tr>
                                                            <tr style="margin-top: 15px;">
                                                                <th scope="row" style="font-size: 18px;">No. de vacantes:  ' . $vacancy_numbers. '</th>
                                                            </tr>
                                                            <tr style="margin-top: 15px;">
                                                                <th scope="row" style="font-size: 18px;">Salario :  $' . $salary. ' MXN </th>
                                                            </tr>
                                                              <tr style="margin-top: 15px;">
                                                                  <th scope="row" style=" font-size: 18px;">Liga de acceso: <a href="https://10.150.80.252:3200/#/login/">https://10.150.80.252:3200/#/login/</a>
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
                                'message' => 'Se envió vacante nueva por correo', 
                                'data' => $email
                              ]);
                            }

    }
}
