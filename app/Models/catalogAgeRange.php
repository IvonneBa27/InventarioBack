<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class catalogAgeRange extends Model
{
    use HasFactory;
    protected $table="catalog_age_range";
    protected $fillable=[
        "name_age_range",
        "id_status",
    ];
}
