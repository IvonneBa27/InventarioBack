<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class warehouse_income_type extends Model
{
    use HasFactory;
    protected $table = "warehouse_income_type";
    protected $fillable = [
        'name',
    ];
}
