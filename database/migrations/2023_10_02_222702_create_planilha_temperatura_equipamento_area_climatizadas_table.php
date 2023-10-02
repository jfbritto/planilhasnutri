<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanilhaTemperaturaEquipamentoAreaClimatizadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planilha_temperatura_equipamento_area_climatizadas', function (Blueprint $table) {
            $table->id();
            $table->date('data');
            $table->integer('id_parameter_responsavel');
            $table->integer('id_parameter_equipamento');
            $table->string('temperatura_1');
            $table->string('temperatura_2');
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
        Schema::dropIfExists('planilha_temperatura_equipamento_area_climatizadas');
    }
}
