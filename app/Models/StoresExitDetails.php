<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoresExitDetails extends Model
{
    use HasFactory;
    protected $table ="store_exit_details";
    protected $fillable = [
        'id_store_exit',
        'product_income_id',
    ];
}
