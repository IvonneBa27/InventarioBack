<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class catModulo extends Model
{
    use HasFactory;
   protected $table="cat_modues";
    protected $fillable = [
        'name',
        'id_type',
        'order',
        'status',
    ];
}
