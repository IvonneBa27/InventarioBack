<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class catalogPositionSalary extends Model
{
    use HasFactory;
    protected $table="catalog_position_salary";
    protected $fillable=[
        "id_position",
        "min_salary",
        "max_salary",
        "id_status",
    ];

}
