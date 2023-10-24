<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FollowUp extends Model
{
    use HasFactory;
    protected $table = "follow_up";
    protected $fillable = [
        "fecha",
        "hora",
        "activdad",
        "comentario",
        "id_prospect",

    ];
    
}
