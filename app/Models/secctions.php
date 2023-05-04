<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class secctions extends Model
{
    use HasFactory;
    protected $table = "secctions";
    protected $fillable = [
        'name',
        'id_status',
        'id_store',
        'nomenclature',
    ];
}
