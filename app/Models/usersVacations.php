<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usersVacations extends Model
{
    use HasFactory;
    protected $table="users_vacations";
    protected $fillable=[
        "user_id",
        "admission_date",
        "period",
        "total_days",
        "status_id",
        "admin_user_id",
    ];
}

