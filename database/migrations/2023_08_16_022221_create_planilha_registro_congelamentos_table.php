<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanilhaRegistroCongelamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planilha_registro_congelamentos', function (Blueprint $table) {
            $table->id();
            $table->date('data_congelamento');
            $table->integer('id_parameter_produto');
            $table->string('quantidade');
            $table->date('data_recebimento')->nullable();
            $table->date('data_fabricacao')->nullable();
            $table->string('alergeno')->nullable();
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
        Schema::dropIfExists('planilha_registro_congelamentos');
    }
}
