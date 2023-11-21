<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class catalogs extends Model
{
    protected $table="catalogs";
    
    protected $fillable = [
        'name',
        'status',
    ];
}
