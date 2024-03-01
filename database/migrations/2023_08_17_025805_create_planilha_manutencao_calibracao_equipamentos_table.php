<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanilhaManutencaoCalibracaoEquipamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planilha_manutencao_calibracao_equipamentos', function (Blueprint $table) {
            $table->id();
            $table->integer('id_planilha')->default(7);
            $table->integer('id_parameter_equipamento');
            $table->integer('calibracao_foi_feita');
            $table->date('data_calibracao')->nullable();
            $table->integer('equipamento_com_problema');
            $table->string('qual_problema')->nullable();
            $table->string('providencias_tomadas')->nullable();
            $table->integer('problema_foi_solucionado')->nullable();
            $table->string('observacoes')->nullable();
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
        Schema::dropIfExists('planilha_manutencao_calibracao_equipamentos');
    }
}
