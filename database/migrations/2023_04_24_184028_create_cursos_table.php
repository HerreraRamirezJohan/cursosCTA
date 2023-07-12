<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateCursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cursos', function (Blueprint $table) {
            $table->id();
            $table->string('nrc', 10);
            $table->string('curso_nombre', 100);
            $table->string('ciclo', 6);
            $table->text('observaciones')->default('Ninguna');
            $table->string('departamento', 250)->nullable();
            $table->integer('alumnos_registrados');
            $table->integer('cupo');
            $table->boolean('activo')->default(1);
            $table->enum('nivel', ['licenciatura', 'maestria', 'doctorado'])->nullable();
            $table->string('profesor', 150)->nullable();
            $table->string('codigo', 20)->nullable();

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cursos');
    }
}
