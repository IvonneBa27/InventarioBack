<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_detail_temporary_warehouse_entry1~ extends Model
{
    use HasFactory;
    protected $table = "product_detail_temporary_warehouse_entry";
    protected $fillable = [
        'warehouse_entry_product_id',
        'serial_number',
    ];
}