<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecritmentProspects extends Model
{
    use HasFactory;
    protected $table = "recritment_prospects";
    protected $fillable = [
        'name',
        'fecha_registro',
        'apellido_pat',
        'apellido_mat',
        'tipo_reclutamiento',
        'curp',
        'id_sexo',
        'estado_civil',
        'nacionalidad',
        'fuente_reclutamiento',
        'referido',
        'nombre_referido',
        'id_pais',
        'id_estado',
        'calle',
        'no_ext',
        'no_int',
        'id_municipio',
        'colonia',
        'cp',
        'referencia',
        'tel_personal',
        'email_personal',
        'id_giro_industria',
        'id_tiempo_experiencia',
        'id_nivel_ingles',
        'facilidad_palabra',
        'id_campaigns_sysca',
        'id_company_department',
        'id_ubicaciones',
        'id_type_schedules',
        'comentarios',
        'cv',
        'id_recluter',
        'nombre_completo',
        'fecha_nacimiento',
        'id_nivel_estudio',
        'ola',
        'tel_emergencia',
        'ubicacion_trabajo'
    ];


    public function recluter()
    {
        return $this->hasOne('App\Models\Usuario', 'id', 'id_recluter');
    }

    public function estado()
    {
        return $this->hasOne('App\Models\Ciudades', 'idciudad', 'id_estado');
    }

    public function seguimiento()
    {
        return $this->hasMany('App\Models\FollowUp', 'id_prospect', 'id');
    }

    public function traking()
    {
        return $this->hasMany('App\Models\TrakingRecruitment', 'id_prospect', 'id');
    }
}
