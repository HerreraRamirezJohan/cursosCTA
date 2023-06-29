<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHorariosNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horarios_news', function (Blueprint $table) {
            $table->id();
            $table->enum('dia', ['lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado']);

            /* Se añadieron los campos de hora inicio y final de los cursos */
            $table->smallInteger('hora');

            $table->boolean('status')->default(0);

            $table->unsignedBigInteger('id_curso')->nullable();
            $table->unsignedBigInteger('id_area')->nullable();

            $table->foreign('id_curso')->references('id')->on('cursos');
            $table->foreign('id_area')->references('id')->on('areas');


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
        Schema::dropIfExists('horarios_news');
    }
}
