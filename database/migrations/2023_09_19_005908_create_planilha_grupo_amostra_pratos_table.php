<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanilhaGrupoAmostraPratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planilha_grupo_amostra_pratos', function (Blueprint $table) {
            $table->id();
            $table->date('data');
            $table->string('nome_grupo');
            $table->integer('numero_pessoas');
            $table->string('cardapio');
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
        Schema::dropIfExists('planilha_grupo_amostra_pratos');
    }
}
