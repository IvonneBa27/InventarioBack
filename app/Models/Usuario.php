<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;
    protected $table = "users";
    protected $fillable = [
        'id_tipo_usuario',
        'usuario',
        'nombre',
        'apellido_pat',
        'apellido_mat',
        'id_ubicacion',
        'id_empresa_rh',
        'email_personal',
        'email',
        'password',
        'numero_empleado',
        'nombre_completo',
        'curp',
        'rfc',
        'nss',
        'id_sexo',
        'id_subcategoria',
        /*'id_domicilo',*/
        'ejecucion_administrativa',
        /*'id_compania',*/
        /*'ola',*/
        'id_puesto',
        'sueldo',
        'id_banco',
        'numero_cuenta_bancaria',
        'clabe_inter_bancaria',
        'fecha_ingreso',
        /*'fecha_contrato',*/
        'fecha_nacimiento',
        'id_estatus',
        'id_departamento_empresa',
        'id_turno',
        'fecha_baja',
        'motivo_baja',
        'mes_baja',
        /*'fecha_inicio_capacitacion',
        'fecha_fin_capacitacion',*/
        'img_profile',
        'referencia',
        'colonia',
        'no_int',
        'cp',
        'tel_laboral',
        'nacionalidad',
        'id_estado_civil',
        'id_pais',
        'id_estado',
        'calle',
        'no_ext',
        'id_municipio',
        'tel_personal',
        'cause_id',
   
    ];


    public function puesto()
    {
        return $this->hasOne('App\Models\Puesto', 'id', 'id_puesto');
    }


}
