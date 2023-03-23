<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoModulo extends Model
{
    use HasFactory;
    protected $table="type_modules";
    protected $fillable=[
        "name",
        "status",
    ];
}
