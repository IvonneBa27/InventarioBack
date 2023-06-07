<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class warehouse_entry extends Model
{
    use HasFactory;
    protected $table = "warehouse_entry";
    protected $fillable = [
        'warehouse_id',
        'section_id',
        'warehouse_entry_type_id',
        'purchase_order_number',
        'invoice',
        'invoice_date',
        'provider_id',
    ];
}

