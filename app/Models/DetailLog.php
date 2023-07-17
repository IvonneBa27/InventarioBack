<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailLog extends Model
{
    use HasFactory;
    protected $table="detail_log";
    protected $fillable=[
        "id_log",
        "message",
        "movement_type",
        "observations",
    ];
}
