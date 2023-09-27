<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanilhaAvaliacaoManejoResiduosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planilha_avaliacao_manejo_residuos', function (Blueprint $table) {
            $table->id();
            $table->date('data');
            $table->integer('lixeira_apropriada');
            $table->integer('retirada_conforme');
            $table->integer('manipuladores_treinados');
            $table->integer('area_externa_apropriada');
            $table->integer('residuos_organicos_retirados');
            $table->integer('area_externa_higienizada');
            $table->string('observacoes');
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
        Schema::dropIfExists('planilha_avaliacao_manejo_residuos');
    }
}
