<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanilhaVerificacaoProcedimentoHigienizacaoHortifrutisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planilha_verificacao_procedimento_higienizacao_hortifrutis', function (Blueprint $table) {
            $table->id();
            $table->integer('id_planilha')->default(6);
            $table->date('data');
            $table->integer('id_parameter_produto');
            $table->string('hora_imersao_inicio', 5);
            $table->string('hora_imersao_fim', 5);
            $table->string('concentracao_solucao_clorada')->nullable();
            $table->string('acao_corretiva')->nullable();
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
        Schema::dropIfExists('planilha_verificacao_procedimento_higienizacao_hortifrutis');
    }
}
