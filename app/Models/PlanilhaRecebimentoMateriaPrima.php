<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanilhaRecebimentoMateriaPrima extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'data',
        'id_parameter_produto',
        'id_parameter_fornecedor',
        'ordem_de_compra',
        'nota_fiscal',
        'sif_lote',
        'lote',
        'data_validade',
        'temperatura_alimento',
        'temperatura_veiculo',
        'nao_conformidade',
        'acao_corretiva',
        'id_parameter_responsavel',
        'id_user',
        'status'
    ];
}
