<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoresExit extends Model
{
    use HasFactory;
    protected $table ="store_exits";
    protected $fillable =[
        'store_origin_id',
        'section_origin_id',
        'id_type_exit',
        'user_id',
        'authorized_id',
        'person_who_receives',
        'category_id',
        'subcategory_id',
        'brand_id',
        'observations',
        'amount',
        'total_received',
        'id_status',

    ];
}
