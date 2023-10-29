<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanilhaTrocaElementoFiltrantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planilha_troca_elemento_filtrantes', function (Blueprint $table) {
            $table->id();
            $table->integer('id_planilha')->default(1);
            $table->integer('id_parameter_area');
            $table->integer('id_parameter_filtro');
            $table->integer('id_parameter_responsavel');
            $table->date('data_troca');
            $table->date('data_proxima_troca');
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
        Schema::dropIfExists('planilha_troca_elemento_filtrantes');
    }
}
