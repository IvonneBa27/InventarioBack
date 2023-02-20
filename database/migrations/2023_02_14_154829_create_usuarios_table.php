<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idtipoUsuario');
            $table->string('usuario',15)->nullnable;
            $table->string('nombre',25)->nullnable;
            $table->string('apaterno',25)->nullnable;
            $table->string('amaterno',25)->nullnable;
            $table->text('email')-> unique();
            $table->text('password')->nullnable;  
            $table->foreign('idtipoUsuario')
                   ->references('id')->on('cat_tipo_usuarios')
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
        Schema::dropIfExists('usuarios');
    }
}
