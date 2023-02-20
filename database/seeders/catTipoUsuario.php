<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class catTipoUsuario extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('cat_tipo_usuarios')->insert([
            'tipoUsuario' => 'SuperAdministrador',
          
        ]);
    }
}
