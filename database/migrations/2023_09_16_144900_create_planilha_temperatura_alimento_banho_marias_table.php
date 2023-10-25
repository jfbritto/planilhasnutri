<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanilhaTemperaturaAlimentoBanhoMariasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planilha_temperatura_alimento_banho_marias', function (Blueprint $table) {
            $table->id();
            $table->date('data');
            $table->string('periodo');
            $table->integer('id_parameter_produto');
            $table->string('primeira_hora');
            $table->string('primeira_tremperatura');
            $table->string('segunda_hora')->nullable();
            $table->string('segunda_tremperatura')->nullable();
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
        Schema::dropIfExists('planilha_temperatura_alimento_banho_marias');
    }
}
