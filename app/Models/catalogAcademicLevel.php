<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class catalogAcademicLevel extends Model
{
    use HasFactory;
    protected $table="catalog_academic_level";
    protected $fillable=[
        "name_academic_level",
        "id_status",
    ];
}
