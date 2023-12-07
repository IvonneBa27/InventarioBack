<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class accountParent extends Model
{
    use HasFactory;

    protected $table = "parent_account";
    protected $fillable = [
        'account',
        'account_description',
        'levelA',
        'levelB',
        'levelC',
        'id_subcategory',
        'id_status',
    ];
}
