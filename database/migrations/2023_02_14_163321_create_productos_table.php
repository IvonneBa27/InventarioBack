<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idtipoProducto');
            $table->string('sku',25)->unique();
            $table->string('serial',35)->nullnable;
            $table->unsignedBigInteger('idMarca');
            $table->text('modelo')->nullnable;
            $table->string('skunum')->unique;
            $table->text('descripcion')->nullnable;
            $table->text('foto')->nullnable;
            $table->string('inventariable',5)->nullnable;
            $table->foreign('idtipoProducto')
                   ->references('id')->on('cat_tipo_productos')
                   ->onDelete('cascade');
            $table->foreign('idMarca')
                   ->references('id')->on('cat_marcas')
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
        Schema::dropIfExists('productos');
    }
}
