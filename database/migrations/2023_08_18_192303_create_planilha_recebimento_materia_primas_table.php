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
            $table->date('data');
            $table->integer('id_parameter_produto');
            $table->integer('id_parameter_fornecedor');
            $table->string('ordem_de_compra');
            $table->string('nota_fiscal');
            $table->string('sif_lote');
            $table->date('data_validade');
            $table->string('temperatura_alimento');
            $table->string('temperatura_veiculo');
            $table->string('nao_conformidade');
            $table->string('acao_corretiva');
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
