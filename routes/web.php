<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlanilhasController;
use App\Http\Controllers\Planilhas\PlanilhaTrocaElementoFiltranteController;
use App\Http\Controllers\Planilhas\PlanilhaHigienizacaoFiltrosAparelhosClimatizacaoController;
use App\Http\Controllers\Planilhas\PlanilhaSaturacaoOleoGorduraController;
use App\Http\Controllers\Planilhas\PlanilhaLimpezaCaixaGorduraController;
use App\Http\Controllers\Planilhas\PlanilhaRegistroCongelamentoController;
use App\Http\Controllers\Planilhas\PlanilhaVerificacaoProcedimentoHigienizacaoHortifrutiController;
use App\Http\Controllers\Planilhas\PlanilhaManutencaoCalibracaoEquipamentoController;
use App\Http\Controllers\Planilhas\PlanilhaRegistroLimpezaController;
use App\Http\Controllers\Planilhas\PlanilhaRecebimentoMateriaPrimaController;
use App\Http\Controllers\Planilhas\PlanilhaResfriamentoRapidoAlimentoController;
use App\Http\Controllers\Planilhas\PlanilhaReaquecimentoAlimentoController;
use App\Http\Controllers\Planilhas\PlanilhaRegistroNaoConformidadeDetectadaAutoAvaliacaoController;
use App\Http\Controllers\Planilhas\PlanilhaTemperaturaAlimentoBanhoMariaController;
use App\Http\Controllers\Planilhas\PlanilhaTemperaturaAlimentoDistribuicaoController;
use App\Http\Controllers\Planilhas\PlanilhaTemperaturaAlimentoDistribuicaoProdutoController;
use App\Http\Controllers\Planilhas\PlanilhaTemperaturaAlimentoDistribuicaoConfigController;
use App\Http\Controllers\Planilhas\PlanilhaGrupoAmostraPratoController;
use App\Http\Controllers\Planilhas\PlanilhaAvaliacaoManejoResiduoController;
use App\Http\Controllers\Planilhas\PlanilhaOcorrenciaPragaController;
use App\Http\Controllers\Planilhas\PlanilhaTemperaturaEquipamentoAreaClimatizadaController;
use App\Http\Controllers\ParameterController;
use App\Http\Controllers\ParameterTypeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\HistoricoController;
use App\Http\Controllers\ServicoController;

Route::get('/', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('login', [AuthenticatedSessionController::class, 'store']);

Route::group(['middleware' => ['auth']], function () {

    // Deslogar
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // Dashboard
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Planilhas
    Route::get('/planilhas', [PlanilhasController::class, 'index']);
    Route::get('/planilhas-2', [PlanilhasController::class, 'index2']);

    // Planilha troca-elemento-filtrante
    Route::get('/planilha/troca-elemento-filtrante', [PlanilhaTrocaElementoFiltranteController::class, 'index']);
    Route::get('/planilha/troca-elemento-filtrante/listar', [PlanilhaTrocaElementoFiltranteController::class, 'list']);
    Route::get('/planilha/troca-elemento-filtrante/encontrar', [PlanilhaTrocaElementoFiltranteController::class, 'find']);
    Route::post('/planilha/troca-elemento-filtrante/cadastrar', [PlanilhaTrocaElementoFiltranteController::class, 'store']);
    Route::put('/planilha/troca-elemento-filtrante/editar', [PlanilhaTrocaElementoFiltranteController::class, 'update']);
    Route::delete('/planilha/troca-elemento-filtrante/deletar', [PlanilhaTrocaElementoFiltranteController::class, 'destroy']);
    Route::get('/planilha/troca-elemento-filtrante/visualizar', [PlanilhaTrocaElementoFiltranteController::class, 'gerarPDF']);

    // Planilha higienizacao-filtro-aparelho-climatizacao
    Route::get('/planilha/higienizacao-filtro-aparelho-climatizacao', [PlanilhaHigienizacaoFiltrosAparelhosClimatizacaoController::class, 'index']);
    Route::get('/planilha/higienizacao-filtro-aparelho-climatizacao/listar', [PlanilhaHigienizacaoFiltrosAparelhosClimatizacaoController::class, 'list']);
    Route::get('/planilha/higienizacao-filtro-aparelho-climatizacao/encontrar', [PlanilhaHigienizacaoFiltrosAparelhosClimatizacaoController::class, 'find']);
    Route::post('/planilha/higienizacao-filtro-aparelho-climatizacao/cadastrar', [PlanilhaHigienizacaoFiltrosAparelhosClimatizacaoController::class, 'store']);
    Route::put('/planilha/higienizacao-filtro-aparelho-climatizacao/editar', [PlanilhaHigienizacaoFiltrosAparelhosClimatizacaoController::class, 'update']);
    Route::delete('/planilha/higienizacao-filtro-aparelho-climatizacao/deletar', [PlanilhaHigienizacaoFiltrosAparelhosClimatizacaoController::class, 'destroy']);
    Route::get('/planilha/higienizacao-filtro-aparelho-climatizacao/visualizar', [PlanilhaHigienizacaoFiltrosAparelhosClimatizacaoController::class, 'gerarPDF']);

    // Planilha saturacao-oleo-gordura
    Route::get('/planilha/saturacao-oleo-gordura', [PlanilhaSaturacaoOleoGorduraController::class, 'index']);
    Route::get('/planilha/saturacao-oleo-gordura/listar', [PlanilhaSaturacaoOleoGorduraController::class, 'list']);
    Route::get('/planilha/saturacao-oleo-gordura/encontrar', [PlanilhaSaturacaoOleoGorduraController::class, 'find']);
    Route::post('/planilha/saturacao-oleo-gordura/cadastrar', [PlanilhaSaturacaoOleoGorduraController::class, 'store']);
    Route::put('/planilha/saturacao-oleo-gordura/editar', [PlanilhaSaturacaoOleoGorduraController::class, 'update']);
    Route::delete('/planilha/saturacao-oleo-gordura/deletar', [PlanilhaSaturacaoOleoGorduraController::class, 'destroy']);
    Route::get('/planilha/saturacao-oleo-gordura/visualizar', [PlanilhaSaturacaoOleoGorduraController::class, 'gerarPDF']);

    // Planilha limpeza-caixa-gorduras
    Route::get('/planilha/limpeza-caixa-gordura', [PlanilhaLimpezaCaixaGorduraController::class, 'index']);
    Route::get('/planilha/limpeza-caixa-gordura/listar', [PlanilhaLimpezaCaixaGorduraController::class, 'list']);
    Route::get('/planilha/limpeza-caixa-gordura/encontrar', [PlanilhaLimpezaCaixaGorduraController::class, 'find']);
    Route::post('/planilha/limpeza-caixa-gordura/cadastrar', [PlanilhaLimpezaCaixaGorduraController::class, 'store']);
    Route::put('/planilha/limpeza-caixa-gordura/editar', [PlanilhaLimpezaCaixaGorduraController::class, 'update']);
    Route::delete('/planilha/limpeza-caixa-gordura/deletar', [PlanilhaLimpezaCaixaGorduraController::class, 'destroy']);
    Route::get('/planilha/limpeza-caixa-gordura/visualizar', [PlanilhaLimpezaCaixaGorduraController::class, 'gerarPDF']);

    // Planilha registro-congelamento
    Route::get('/planilha/registro-congelamento', [PlanilhaRegistroCongelamentoController::class, 'index']);
    Route::get('/planilha/registro-congelamento/listar', [PlanilhaRegistroCongelamentoController::class, 'list']);
    Route::get('/planilha/registro-congelamento/encontrar', [PlanilhaRegistroCongelamentoController::class, 'find']);
    Route::post('/planilha/registro-congelamento/cadastrar', [PlanilhaRegistroCongelamentoController::class, 'store']);
    Route::put('/planilha/registro-congelamento/editar', [PlanilhaRegistroCongelamentoController::class, 'update']);
    Route::delete('/planilha/registro-congelamento/deletar', [PlanilhaRegistroCongelamentoController::class, 'destroy']);
    Route::get('/planilha/registro-congelamento/visualizar', [PlanilhaRegistroCongelamentoController::class, 'gerarPDF']);

    // Planilha verificacao-procedimento-higienizacao-hortifruti
    Route::get('/planilha/verificacao-procedimento-higienizacao-hortifruti', [PlanilhaVerificacaoProcedimentoHigienizacaoHortifrutiController::class, 'index']);
    Route::get('/planilha/verificacao-procedimento-higienizacao-hortifruti/listar', [PlanilhaVerificacaoProcedimentoHigienizacaoHortifrutiController::class, 'list']);
    Route::get('/planilha/verificacao-procedimento-higienizacao-hortifruti/encontrar', [PlanilhaVerificacaoProcedimentoHigienizacaoHortifrutiController::class, 'find']);
    Route::post('/planilha/verificacao-procedimento-higienizacao-hortifruti/cadastrar', [PlanilhaVerificacaoProcedimentoHigienizacaoHortifrutiController::class, 'store']);
    Route::put('/planilha/verificacao-procedimento-higienizacao-hortifruti/editar', [PlanilhaVerificacaoProcedimentoHigienizacaoHortifrutiController::class, 'update']);
    Route::delete('/planilha/verificacao-procedimento-higienizacao-hortifruti/deletar', [PlanilhaVerificacaoProcedimentoHigienizacaoHortifrutiController::class, 'destroy']);
    Route::get('/planilha/verificacao-procedimento-higienizacao-hortifruti/visualizar', [PlanilhaVerificacaoProcedimentoHigienizacaoHortifrutiController::class, 'gerarPDF']);

    // Planilha manutencao-calibracao-equipamento
    Route::get('/planilha/manutencao-calibracao-equipamento', [PlanilhaManutencaoCalibracaoEquipamentoController::class, 'index']);
    Route::get('/planilha/manutencao-calibracao-equipamento/listar', [PlanilhaManutencaoCalibracaoEquipamentoController::class, 'list']);
    Route::get('/planilha/manutencao-calibracao-equipamento/encontrar', [PlanilhaManutencaoCalibracaoEquipamentoController::class, 'find']);
    Route::post('/planilha/manutencao-calibracao-equipamento/cadastrar', [PlanilhaManutencaoCalibracaoEquipamentoController::class, 'store']);
    Route::put('/planilha/manutencao-calibracao-equipamento/editar', [PlanilhaManutencaoCalibracaoEquipamentoController::class, 'update']);
    Route::delete('/planilha/manutencao-calibracao-equipamento/deletar', [PlanilhaManutencaoCalibracaoEquipamentoController::class, 'destroy']);
    Route::get('/planilha/manutencao-calibracao-equipamento/visualizar', [PlanilhaManutencaoCalibracaoEquipamentoController::class, 'gerarPDF']);

    // Planilha registro-limpeza
    Route::get('/planilha/registro-limpeza', [PlanilhaRegistroLimpezaController::class, 'index']);
    Route::get('/planilha/registro-limpeza/listar', [PlanilhaRegistroLimpezaController::class, 'list']);
    Route::get('/planilha/registro-limpeza/encontrar', [PlanilhaRegistroLimpezaController::class, 'find']);
    Route::post('/planilha/registro-limpeza/cadastrar', [PlanilhaRegistroLimpezaController::class, 'store']);
    Route::put('/planilha/registro-limpeza/editar', [PlanilhaRegistroLimpezaController::class, 'update']);
    Route::delete('/planilha/registro-limpeza/deletar', [PlanilhaRegistroLimpezaController::class, 'destroy']);
    Route::get('/planilha/registro-limpeza/visualizar', [PlanilhaRegistroLimpezaController::class, 'gerarPDF']);

    // Planilha recebimento-materia-prima
    Route::get('/planilha/recebimento-materia-prima', [PlanilhaRecebimentoMateriaPrimaController::class, 'index']);
    Route::get('/planilha/recebimento-materia-prima/listar', [PlanilhaRecebimentoMateriaPrimaController::class, 'list']);
    Route::get('/planilha/recebimento-materia-prima/encontrar', [PlanilhaRecebimentoMateriaPrimaController::class, 'find']);
    Route::post('/planilha/recebimento-materia-prima/cadastrar', [PlanilhaRecebimentoMateriaPrimaController::class, 'store']);
    Route::put('/planilha/recebimento-materia-prima/editar', [PlanilhaRecebimentoMateriaPrimaController::class, 'update']);
    Route::delete('/planilha/recebimento-materia-prima/deletar', [PlanilhaRecebimentoMateriaPrimaController::class, 'destroy']);
    Route::get('/planilha/recebimento-materia-prima/visualizar', [PlanilhaRecebimentoMateriaPrimaController::class, 'gerarPDF']);

    // Planilha resfriamento-rapido-alimento
    Route::get('/planilha/resfriamento-rapido-alimento', [PlanilhaResfriamentoRapidoAlimentoController::class, 'index']);
    Route::get('/planilha/resfriamento-rapido-alimento/listar', [PlanilhaResfriamentoRapidoAlimentoController::class, 'list']);
    Route::get('/planilha/resfriamento-rapido-alimento/encontrar', [PlanilhaResfriamentoRapidoAlimentoController::class, 'find']);
    Route::post('/planilha/resfriamento-rapido-alimento/cadastrar', [PlanilhaResfriamentoRapidoAlimentoController::class, 'store']);
    Route::put('/planilha/resfriamento-rapido-alimento/editar', [PlanilhaResfriamentoRapidoAlimentoController::class, 'update']);
    Route::delete('/planilha/resfriamento-rapido-alimento/deletar', [PlanilhaResfriamentoRapidoAlimentoController::class, 'destroy']);
    Route::get('/planilha/resfriamento-rapido-alimento/visualizar', [PlanilhaResfriamentoRapidoAlimentoController::class, 'gerarPDF']);

    // Planilha reaquecimento-alimento
    Route::get('/planilha/reaquecimento-alimento', [PlanilhaReaquecimentoAlimentoController::class, 'index']);
    Route::get('/planilha/reaquecimento-alimento/listar', [PlanilhaReaquecimentoAlimentoController::class, 'list']);
    Route::get('/planilha/reaquecimento-alimento/encontrar', [PlanilhaReaquecimentoAlimentoController::class, 'find']);
    Route::post('/planilha/reaquecimento-alimento/cadastrar', [PlanilhaReaquecimentoAlimentoController::class, 'store']);
    Route::put('/planilha/reaquecimento-alimento/editar', [PlanilhaReaquecimentoAlimentoController::class, 'update']);
    Route::delete('/planilha/reaquecimento-alimento/deletar', [PlanilhaReaquecimentoAlimentoController::class, 'destroy']);
    Route::get('/planilha/reaquecimento-alimento/visualizar', [PlanilhaReaquecimentoAlimentoController::class, 'gerarPDF']);

    // Planilha registro-nao-conformidade-detectada-auto-avaliacao
    Route::get('/planilha/registro-nao-conformidade-detectada-auto-avaliacao', [PlanilhaRegistroNaoConformidadeDetectadaAutoAvaliacaoController::class, 'index']);
    Route::get('/planilha/registro-nao-conformidade-detectada-auto-avaliacao/listar', [PlanilhaRegistroNaoConformidadeDetectadaAutoAvaliacaoController::class, 'list']);
    Route::get('/planilha/registro-nao-conformidade-detectada-auto-avaliacao/encontrar', [PlanilhaRegistroNaoConformidadeDetectadaAutoAvaliacaoController::class, 'find']);
    Route::post('/planilha/registro-nao-conformidade-detectada-auto-avaliacao/cadastrar', [PlanilhaRegistroNaoConformidadeDetectadaAutoAvaliacaoController::class, 'store']);
    Route::put('/planilha/registro-nao-conformidade-detectada-auto-avaliacao/editar', [PlanilhaRegistroNaoConformidadeDetectadaAutoAvaliacaoController::class, 'update']);
    Route::delete('/planilha/registro-nao-conformidade-detectada-auto-avaliacao/deletar', [PlanilhaRegistroNaoConformidadeDetectadaAutoAvaliacaoController::class, 'destroy']);
    Route::get('/planilha/registro-nao-conformidade-detectada-auto-avaliacao/visualizar', [PlanilhaRegistroNaoConformidadeDetectadaAutoAvaliacaoController::class, 'gerarPDF']);

    // Planilha temperatura_alimento_banho_maria
    Route::get('/planilha/temperatura-alimento-banho-maria', [PlanilhaTemperaturaAlimentoBanhoMariaController::class, 'index']);
    Route::get('/planilha/temperatura-alimento-banho-maria/listar', [PlanilhaTemperaturaAlimentoBanhoMariaController::class, 'list']);
    Route::get('/planilha/temperatura-alimento-banho-maria/encontrar', [PlanilhaTemperaturaAlimentoBanhoMariaController::class, 'find']);
    Route::post('/planilha/temperatura-alimento-banho-maria/cadastrar', [PlanilhaTemperaturaAlimentoBanhoMariaController::class, 'store']);
    Route::put('/planilha/temperatura-alimento-banho-maria/editar', [PlanilhaTemperaturaAlimentoBanhoMariaController::class, 'update']);
    Route::delete('/planilha/temperatura-alimento-banho-maria/deletar', [PlanilhaTemperaturaAlimentoBanhoMariaController::class, 'destroy']);
    Route::get('/planilha/temperatura-alimento-banho-maria/visualizar', [PlanilhaTemperaturaAlimentoBanhoMariaController::class, 'gerarPDF']);

    // Planilha temperatura_alimento_distribuicao
    Route::get('/planilha/temperatura-alimento-distribuicao', [PlanilhaTemperaturaAlimentoDistribuicaoController::class, 'index']);
    Route::get('/planilha/temperatura-alimento-distribuicao/listar', [PlanilhaTemperaturaAlimentoDistribuicaoController::class, 'list']);
    Route::get('/planilha/temperatura-alimento-distribuicao/encontrar', [PlanilhaTemperaturaAlimentoDistribuicaoController::class, 'find']);
    Route::post('/planilha/temperatura-alimento-distribuicao/cadastrar', [PlanilhaTemperaturaAlimentoDistribuicaoController::class, 'store']);
    Route::put('/planilha/temperatura-alimento-distribuicao/editar', [PlanilhaTemperaturaAlimentoDistribuicaoController::class, 'update']);
    Route::delete('/planilha/temperatura-alimento-distribuicao/deletar', [PlanilhaTemperaturaAlimentoDistribuicaoController::class, 'destroy']);
    Route::get('/planilha/temperatura-alimento-distribuicao/visualizar', [PlanilhaTemperaturaAlimentoDistribuicaoController::class, 'gerarPDF']);

    // Planilha temperatura_alimento_distribuicao_produto
    Route::get('/planilha/temperatura-alimento-distribuicao-produto/listar', [PlanilhaTemperaturaAlimentoDistribuicaoProdutoController::class, 'list']);

    // Planilha temperatura_alimento_distribuicao_config
    Route::get('/planilha/temperatura-alimento-distribuicao-config/listar', [PlanilhaTemperaturaAlimentoDistribuicaoConfigController::class, 'list']);
    Route::post('/planilha/temperatura-alimento-distribuicao-config/cadastrar', [PlanilhaTemperaturaAlimentoDistribuicaoConfigController::class, 'store']);

    // Planilha grupo_amostra_prato
    Route::get('/planilha/grupo-amostra-prato', [PlanilhaGrupoAmostraPratoController::class, 'index']);
    Route::get('/planilha/grupo-amostra-prato/listar', [PlanilhaGrupoAmostraPratoController::class, 'list']);
    Route::get('/planilha/grupo-amostra-prato/encontrar', [PlanilhaGrupoAmostraPratoController::class, 'find']);
    Route::post('/planilha/grupo-amostra-prato/cadastrar', [PlanilhaGrupoAmostraPratoController::class, 'store']);
    Route::put('/planilha/grupo-amostra-prato/editar', [PlanilhaGrupoAmostraPratoController::class, 'update']);
    Route::delete('/planilha/grupo-amostra-prato/deletar', [PlanilhaGrupoAmostraPratoController::class, 'destroy']);
    Route::get('/planilha/grupo-amostra-prato/visualizar', [PlanilhaGrupoAmostraPratoController::class, 'gerarPDF']);

    // Planilha avaliacao_manejo_residuo
    Route::get('/planilha/avaliacao-manejo-residuo', [PlanilhaAvaliacaoManejoResiduoController::class, 'index']);
    Route::get('/planilha/avaliacao-manejo-residuo/listar', [PlanilhaAvaliacaoManejoResiduoController::class, 'list']);
    Route::get('/planilha/avaliacao-manejo-residuo/encontrar', [PlanilhaAvaliacaoManejoResiduoController::class, 'find']);
    Route::post('/planilha/avaliacao-manejo-residuo/cadastrar', [PlanilhaAvaliacaoManejoResiduoController::class, 'store']);
    Route::put('/planilha/avaliacao-manejo-residuo/editar', [PlanilhaAvaliacaoManejoResiduoController::class, 'update']);
    Route::delete('/planilha/avaliacao-manejo-residuo/deletar', [PlanilhaAvaliacaoManejoResiduoController::class, 'destroy']);
    Route::get('/planilha/avaliacao-manejo-residuo/visualizar', [PlanilhaAvaliacaoManejoResiduoController::class, 'gerarPDF']);

    // Planilha ocorrencia_praga
    Route::get('/planilha/ocorrencia-praga', [PlanilhaOcorrenciaPragaController::class, 'index']);
    Route::get('/planilha/ocorrencia-praga/listar', [PlanilhaOcorrenciaPragaController::class, 'list']);
    Route::get('/planilha/ocorrencia-praga/encontrar', [PlanilhaOcorrenciaPragaController::class, 'find']);
    Route::post('/planilha/ocorrencia-praga/cadastrar', [PlanilhaOcorrenciaPragaController::class, 'store']);
    Route::put('/planilha/ocorrencia-praga/editar', [PlanilhaOcorrenciaPragaController::class, 'update']);
    Route::delete('/planilha/ocorrencia-praga/deletar', [PlanilhaOcorrenciaPragaController::class, 'destroy']);
    Route::get('/planilha/ocorrencia-praga/visualizar', [PlanilhaOcorrenciaPragaController::class, 'gerarPDF']);

    // Planilha temperatura_equipamento_area_climatizada
    Route::get('/planilha/temperatura-equipamento-area-climatizada', [PlanilhaTemperaturaEquipamentoAreaClimatizadaController::class, 'index']);
    Route::get('/planilha/temperatura-equipamento-area-climatizada/listar', [PlanilhaTemperaturaEquipamentoAreaClimatizadaController::class, 'list']);
    Route::get('/planilha/temperatura-equipamento-area-climatizada/encontrar', [PlanilhaTemperaturaEquipamentoAreaClimatizadaController::class, 'find']);
    Route::post('/planilha/temperatura-equipamento-area-climatizada/cadastrar', [PlanilhaTemperaturaEquipamentoAreaClimatizadaController::class, 'store']);
    Route::put('/planilha/temperatura-equipamento-area-climatizada/editar', [PlanilhaTemperaturaEquipamentoAreaClimatizadaController::class, 'update']);
    Route::delete('/planilha/temperatura-equipamento-area-climatizada/deletar', [PlanilhaTemperaturaEquipamentoAreaClimatizadaController::class, 'destroy']);
    Route::get('/planilha/temperatura-equipamento-area-climatizada/visualizar', [PlanilhaTemperaturaEquipamentoAreaClimatizadaController::class, 'gerarPDF']);

    // Parametros
    Route::get('/parametros', [ParameterController::class, 'index']);
    Route::get('/parametro/listar', [ParameterController::class, 'list']);
    Route::get('/parametro/encontrar', [ParameterController::class, 'find']);
    Route::post('/parametro/cadastrar', [ParameterController::class, 'store']);
    Route::put('/parametro/editar', [ParameterController::class, 'update']);
    Route::delete('/parametro/deletar', [ParameterController::class, 'destroy']);

    // Tipos de parametros
    Route::get('/tipo-parametros', [ParameterTypeController::class, 'index']);
    Route::get('/tipo-parametro/listar', [ParameterTypeController::class, 'list']);
    Route::post('/tipo-parametro/cadastrar', [ParameterTypeController::class, 'store']);
    Route::put('/tipo-parametro/editar', [ParameterTypeController::class, 'update']);
    Route::delete('/tipo-parametro/deletar', [ParameterTypeController::class, 'destroy']);

    // Serviços
    Route::get('/servicos', [ServicoController::class, 'index']);
    Route::get('/servico/listar', [ServicoController::class, 'list']);
    Route::post('/servico/cadastrar', [ServicoController::class, 'store']);
    Route::put('/servico/editar', [ServicoController::class, 'update']);
    Route::delete('/servico/deletar', [ServicoController::class, 'destroy']);
    Route::get('/servico/download/{fileName}', [ServicoController::class, 'downloadArquivo']);

    // Usuários
    Route::get('/usuarios', [UserController::class, 'index']);
    Route::get('/usuario/listar', [UserController::class, 'list']);
    Route::post('/usuario/cadastrar', [UserController::class, 'store']);
    Route::put('/usuario/editar', [UserController::class, 'update']);
    Route::put('/usuario/editar-senha', [UserController::class, 'updatePassword']);
    Route::delete('/usuario/deletar', [UserController::class, 'destroy']);

    // Histórico
    Route::get('/historico', [HistoricoController::class, 'index']);
    Route::get('/historico/listar', [HistoricoController::class, 'list']);

    Route::group(['middleware' => ['admin']], function () {

        // Unidades
        Route::get('/unidades', [UnitController::class, 'index']);
        Route::get('/unidade/listar', [UnitController::class, 'list']);
        Route::post('/unidade/cadastrar', [UnitController::class, 'store']);
        Route::put('/unidade/editar', [UnitController::class, 'update']);
        Route::delete('/unidade/deletar', [UnitController::class, 'destroy']);

    });

});

// Autentication
// Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])->name('verification.notice');
// Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])->middleware(['signed', 'throttle:6,1'])->name('verification.verify');
// Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->middleware('throttle:6,1')->name('verification.send');
// Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
// Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);
// Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
// Route::post('register', [RegisteredUserController::class, 'store']);
// Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
// Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
// Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
// Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.update');
