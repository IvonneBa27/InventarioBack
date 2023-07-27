<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class exchangeRate extends Model
{
    use HasFactory;
    protected $table="exchange_rate";
    protected $fillable=[
        "exchange_rate_sale",
        "exchange_rate_sale_doit",
        "exchange_rate_buy",
        "exchange_rate_buy_doit",
        "date",
        "user_id",
    ];
}
