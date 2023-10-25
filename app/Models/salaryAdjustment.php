<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class salaryAdjustment extends Model
{
    use HasFactory;
    protected $table="salary_adjustment";
    protected $fillable=[
        "user_id",
        "previous_departament_id",
        "previous_subcategory_id",
        "previous_position_id",
        "previous_campania_id",
        "previous_salary",
        "admission_date",
        "salary_adjustment",
        "updated_departament_id",
        "updated_subcategory_id",
        "updated_position_id",
        "updated_campania_id",
        "updated_salary",
        "authorized_user_id",
        "observations",
    ];
}
