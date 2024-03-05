<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanilhaRastreabilidadeDiariasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planilha_rastreabilidade_diarias', function (Blueprint $table) {
            $table->id();
            $table->integer('id_planilha')->default(19);
            $table->integer('id_parameter_produto');
            $table->date('data');
            $table->string('lote')->nullable();
            $table->date('validade');
            $table->integer('id_parameter_fabricante');
            $table->string('image')->nullable();
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
        Schema::dropIfExists('planilha_rastreabilidade_diarias');
    }
}
