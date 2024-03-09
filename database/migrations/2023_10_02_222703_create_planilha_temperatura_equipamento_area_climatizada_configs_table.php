<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanilhaTemperaturaEquipamentoAreaClimatizadaConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planilha_temperatura_equipamento_area_climatizada_configs', function (Blueprint $table) {
            $table->id();
            $table->integer('id_unit');
            $table->integer('id_parameter_equipamento');
            $table->string('maior_que');
            $table->string('menor_que');
            $table->integer('obrigatorio');
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
        Schema::dropIfExists('planilha_temperatura_equipamento_area_climatizada_configs');
    }
}
