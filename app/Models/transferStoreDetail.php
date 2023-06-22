<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transferStoreDetail extends Model
{
    use HasFactory;
    protected $table ="transfer_store_detail";
    protected $fillable = [
        'id_transfer_store',
        'product_id',
        'product_name',
        'brand_name',
        'model_name',
        'sku',
        'serial_number',
        'idDet',

    ]
}
