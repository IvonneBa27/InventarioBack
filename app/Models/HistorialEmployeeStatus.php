<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialEmployeeStatus extends Model
{
    use HasFactory;
    protected $table = "historical_employee_status";
    protected $fillable = [
        'user_id',
        'employeed_id',
        'status_id',
        'reason_id',
        'cause_id',
        'date',
    ];
}
