<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bankAccounts extends Model
{
    use HasFactory;
    protected $table = "bank_accounts";
    protected $fillable = [
        'account_number',
        'id_bank',
        'branch',
        'account_holder',
        'executive',
        'email',
        'phone',
        'concentrator',
        'accounting_account',
        'id_currency',
        'id_complementary_account',
        'id_status',
    ];
}
