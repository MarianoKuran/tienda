<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIdiomaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Idioma', function (Blueprint $table) {
            $table->bigIncrements('IdiomaID');
            $table->string('Descripcion')->unique()->required();
            $table->string('Codigo')->unique()->required();
            $table->boolean('Seleccionado')->required();
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Idioma');
    }
};
