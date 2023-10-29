<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanilhaTemperaturaAlimentoDistribuicaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planilha_temperatura_alimento_distribuicaos', function (Blueprint $table) {
            $table->id();
            $table->integer('id_planilha')->default(14);
            $table->date('data');
            $table->string('periodo');
            $table->integer('id_parameter_evento')->nullable();
            $table->integer('id_parameter_responsavel');
            $table->string('acao_corretiva')->nullable();
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
        Schema::dropIfExists('planilha_temperatura_alimento_distribuicaos');
    }
}
