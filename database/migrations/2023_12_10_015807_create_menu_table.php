<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuTable extends Migration
{
    public function up()
    {
        Schema::create('Menu', function (Blueprint $table) {
            $table->bigIncrements('MenuID');
            $table->string('Titulo');
            $table->string('Descripcion');
            $table->string('Url');
            $table->string('Permiso');
            $table->integer('PadreID');
            $table->boolean('Hijos');
            $table->string('Icon')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('Menu');
    }
};
