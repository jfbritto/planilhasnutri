<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanilhaReaquecimentoAlimentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planilha_reaquecimento_alimentos', function (Blueprint $table) {
            $table->id();
            $table->date('data');
            $table->integer('id_parameter_produto');
            $table->string('hora_temperatura_antes');
            $table->string('temperatura_antes');
            $table->string('hora_temperatura_depois');
            $table->string('temperatura_depois');
            $table->string('tempo_aquecimento');
            $table->integer('conforme_naoconforme');
            $table->integer('id_parameter_responsavel');
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
        Schema::dropIfExists('planilha_reaquecimento_alimentos');
    }
}
