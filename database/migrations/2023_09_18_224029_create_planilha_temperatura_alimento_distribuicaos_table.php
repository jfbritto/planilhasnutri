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
            $table->date('data');
            $table->string('periodo');
            $table->integer('id_parameter_produto');
            $table->integer('id_parameter_evento');
            $table->integer('id_parameter_responsavel');
            $table->string('hora_1')->nullable();
            $table->string('tremperatura_1')->nullable();
            $table->string('hora_2')->nullable();
            $table->string('tremperatura_2')->nullable();
            $table->string('hora_3')->nullable();
            $table->string('tremperatura_3')->nullable();
            $table->string('hora_4')->nullable();
            $table->string('tremperatura_4')->nullable();
            $table->string('hora_5')->nullable();
            $table->string('tremperatura_5')->nullable();
            $table->string('hora_6')->nullable();
            $table->string('tremperatura_6')->nullable();
            $table->string('hora_7')->nullable();
            $table->string('tremperatura_7')->nullable();
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
