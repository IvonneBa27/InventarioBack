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


    public function reasons()
    {
        return $this->hasOne('App\Models\CatalogReasonBlackList', 'id', 'id_reasons');
    }

    public function cause()
    {
        return $this->hasOne('App\Models\CatalogCauseBlackList', 'id', 'id_cause');
    }
}
