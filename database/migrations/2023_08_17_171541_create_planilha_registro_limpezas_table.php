<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanilhaRegistroLimpezasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planilha_registro_limpezas', function (Blueprint $table) {
            $table->id();
            $table->integer('id_planilha')->default(8);
            $table->date('data');
            $table->integer('id_parameter_responsavel');
            $table->integer('id_parameter_area');
            $table->string('superficie_limpa');
            $table->string('frequencia');
            $table->integer('conforme_naoconforme');
            $table->string('comentarios');
            $table->integer('id_user');
            $table->string('status', 1)->default('A');
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
        Schema::dropIfExists('planilha_registro_limpezas');
    }
}
