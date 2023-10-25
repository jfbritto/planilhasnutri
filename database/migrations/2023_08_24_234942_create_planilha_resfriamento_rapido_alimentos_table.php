<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanilhaResfriamentoRapidoAlimentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planilha_resfriamento_rapido_alimentos', function (Blueprint $table) {
            $table->id();
            $table->date('data');
            $table->integer('id_parameter_produto');
            $table->string('cozimento_hora_final');
            $table->string('cozimento_temperatura_interna');
            $table->string('resfriamento_hora_inicio')->nullable();
            $table->string('resfriamento_temperatura_central_inicio')->nullable();
            $table->string('resfriamento_hora_fim')->nullable();
            $table->string('resfriamento_temperatura_central_fim')->nullable();
            $table->integer('conforme_naoconforme')->nullable();
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
        Schema::dropIfExists('planilha_resfriamento_rapido_alimentos');
    }
}
