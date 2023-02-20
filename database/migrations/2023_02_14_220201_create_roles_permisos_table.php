<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesPermisosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles_permisos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idtipoUsuario');
            $table->unsignedBigInteger('idpermiso');
            $table->foreign('idtipoUsuario')
                  ->references('id')->on('cat_tipo_usuarios')
                  ->onDelete('cascade');
            $table->foreign('idPermiso')
                  ->references('id')->on('cat_permisos')
                  ->onDelete('cascade');
           $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles_permisos');
    }
}
