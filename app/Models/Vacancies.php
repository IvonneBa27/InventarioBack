<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacancies extends Model
{
    use HasFactory;
    protected $table="vacancies_list";
    protected $fillable=[
         "date", 
        "id_position",
        "id_company",
        "id_department",
        "id_type_structure",
        "id_type_schedule",
        "id_campaing",
        "id_location",
        "id_age_range",
        "id_academic_level",
        "id_job_experience",
        "vacancy_numbers",
        "salary",
        "required_skills",
        'id_asiggned',
        "user_id",
        "id_status",
    ];
}

