<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeesBlackList extends Model
{
    use HasFactory;
    protected $fillable = [
        "date",
  "apellido_pat",
  "apellido_mat",
  "name",
  "curp",
  "id_reasons",
  "id_cause",
  "description",
  "id_status",
  "id_user"
    ];
}
