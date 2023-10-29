<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanilhaHigienizacaoFiltrosAparelhosClimatizacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planilha_higienizacao_filtros_aparelhos_climatizacaos', function (Blueprint $table) {
            $table->id();
            $table->integer('id_planilha')->default(2);
            $table->integer('id_parameter_area');
            $table->integer('id_parameter_equipamento');
            $table->integer('id_parameter_responsavel');
            $table->date('data_higienizacao');
            $table->date('data_proxima_higienizacao');
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
        Schema::dropIfExists('planilha_higienizacao_filtros_aparelhos_climatizacaos');
    }
}
