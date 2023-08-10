<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class catalogJobExperience extends Model
{
    use HasFactory;
    protected $table="catalog_job_experience";
    protected $fillable=[
        "name_job",
        "id_status",
    ];

}
