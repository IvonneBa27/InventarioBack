<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class accountSub extends Model
{
    use HasFactory;
    protected $table = "sub_account";
    protected $fillable = [
        'id_parent',
        'account',
        'account_description',
        'levelA',
        'levelB',
        'levelC',
        'id_subcategory',
        'id_status',
    ];
}

