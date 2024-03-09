<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanilhaRecebimentoMateriaPrimasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planilha_recebimento_materia_primas', function (Blueprint $table) {
            $table->id();
            $table->integer('id_planilha')->default(9);
            $table->date('data');
            $table->integer('id_parameter_produto');
            $table->integer('id_parameter_fornecedor');
            $table->string('ordem_de_compra')->nullable();
            $table->string('nota_fiscal')->nullable();
            $table->string('sif_lote')->nullable();
            $table->string('lote')->nullable();
            $table->date('data_validade')->nullable();
            $table->string('temperatura_alimento')->nullable();
            $table->string('temperatura_veiculo')->nullable();
            $table->string('nao_conformidade')->nullable();
            $table->string('acao_corretiva')->nullable();
            $table->integer('id_parameter_responsavel');
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
        Schema::dropIfExists('planilha_recebimento_materia_primas');
    }
}
