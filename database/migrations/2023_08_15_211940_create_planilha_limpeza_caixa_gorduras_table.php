<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanilhaLimpezaCaixaGordurasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planilha_limpeza_caixa_gorduras', function (Blueprint $table) {
            $table->id();
            $table->integer('id_parameter_caixa_gordura');
            $table->integer('id_parameter_local');
            $table->integer('id_parameter_responsavel');
            $table->date('data_limpeza');
            $table->date('data_proxima_limpeza');
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
        Schema::dropIfExists('planilha_limpeza_caixa_gorduras');
    }
}
