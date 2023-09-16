<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanilhaRegistroNaoConformidadeDetectadaAutoAvaliacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planilha_registro_nao_conformidade_detectada_auto_avaliacaos', function (Blueprint $table) {
            $table->id();
            $table->date('data');
            $table->string('nao_conformidade');
            $table->string('possiveis_causas');
            $table->string('tratamento_produto');
            $table->string('acoes_corretivas');
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
        Schema::dropIfExists('planilha_registro_nao_conformidade_detectada_auto_avaliacaos');
    }
}
