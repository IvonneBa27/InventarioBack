<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vacationSettings extends Model
{
    use HasFactory;
    protected $table="vacation_settings";
    protected $fillable=[
        "antiquity",
        "days_year",
        "registration_year",
        "status_id",
     
    ];
}

