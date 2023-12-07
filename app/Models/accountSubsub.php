<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class accountSubsub extends Model
{
    use HasFactory;
    protected $table = "sub_subaccount";
    protected $fillable = [
        'id_parent',
        'id_sub',
        'account',
        'account_description',
        'levelA',
        'levelB',
        'levelC',
        'id_subcategory',
        'id_status',
    ];
}
