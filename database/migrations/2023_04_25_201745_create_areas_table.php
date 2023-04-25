<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('areas', function (Blueprint $table) {
            $table->id();
            $table->string('ultimo_inventario', 50)->default('Nunca');
            $table->string('tipo_espacio', 30);
            $table->string('equipamiento', 100)->default('No especificado');
            $table->string('sede');
            $table->string('edificio', 100);
            $table->string('piso', 50);
            $table->string('division', 200);
            $table->string('coordinacion', 250);
            $table->string('area', 300);
            $table->string('imagen_1', 250)->default('Sin imagen');
            $table->string('imagen_2', 100)->default('Sin imagen');
            $table->boolean('activo')->nullable()->default(1);

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
        Schema::dropIfExists('areas');
    }
}
