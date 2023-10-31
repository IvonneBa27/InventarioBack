<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usersVacationsDetails extends Model
{
    use HasFactory;
    protected $table="users_vacations_details";
    protected $fillable=[
        "vacation_id",
        "application_date",
        "days_requested",
        "start_date",
        "end_date";
        "observations",
    ];
}
