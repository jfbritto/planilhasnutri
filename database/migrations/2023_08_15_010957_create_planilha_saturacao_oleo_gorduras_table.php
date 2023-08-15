<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanilhaSaturacaoOleoGordurasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planilha_saturacao_oleo_gorduras', function (Blueprint $table) {
            $table->id();
            $table->date('data');
            $table->integer('id_parameter_area');
            $table->integer('id_parameter_equipamento');
            $table->string('hora_primeira_afericao', 5);
            $table->string('temperatura_primeira_afericao', 10);
            $table->string('hora_segunda_afericao', 5);
            $table->string('temperatura_segunda_afericao', 10);
            $table->string('acao_corretiva', 300);
            $table->integer('id_parameter_responsavel_acao');
            $table->string('leitura_fita', 10);
            $table->integer('id_parameter_situacao_gordura');
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
        Schema::dropIfExists('planilha_saturacao_oleo_gorduras');
    }
}
