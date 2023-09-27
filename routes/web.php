<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('login', [AuthenticatedSessionController::class, 'store']);

Route::group(['middleware' => ['auth']], function () {

    // Deslogar
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // Dashboard
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Planilhas
    Route::get('/planilhas', [App\Http\Controllers\PlanilhasController::class, 'index']);

    // Planilha troca-elemento-filtrante
    Route::get('/planilha/troca-elemento-filtrante', [App\Http\Controllers\Planilhas\PlanilhaTrocaElementoFiltranteController::class, 'index']);
    Route::get('/planilha/troca-elemento-filtrante/listar', [App\Http\Controllers\Planilhas\PlanilhaTrocaElementoFiltranteController::class, 'list']);
    Route::get('/planilha/troca-elemento-filtrante/encontrar', [App\Http\Controllers\Planilhas\PlanilhaTrocaElementoFiltranteController::class, 'find']);
    Route::post('/planilha/troca-elemento-filtrante/cadastrar', [App\Http\Controllers\Planilhas\PlanilhaTrocaElementoFiltranteController::class, 'store']);
    Route::put('/planilha/troca-elemento-filtrante/editar', [App\Http\Controllers\Planilhas\PlanilhaTrocaElementoFiltranteController::class, 'update']);
    Route::delete('/planilha/troca-elemento-filtrante/deletar', [App\Http\Controllers\Planilhas\PlanilhaTrocaElementoFiltranteController::class, 'destroy']);

    // Planilha higienizacao-filtro-aparelho-climatizacao
    Route::get('/planilha/higienizacao-filtro-aparelho-climatizacao', [App\Http\Controllers\Planilhas\PlanilhaHigienizacaoFiltrosAparelhosClimatizacaoController::class, 'index']);
    Route::get('/planilha/higienizacao-filtro-aparelho-climatizacao/listar', [App\Http\Controllers\Planilhas\PlanilhaHigienizacaoFiltrosAparelhosClimatizacaoController::class, 'list']);
    Route::get('/planilha/higienizacao-filtro-aparelho-climatizacao/encontrar', [App\Http\Controllers\Planilhas\PlanilhaHigienizacaoFiltrosAparelhosClimatizacaoController::class, 'find']);
    Route::post('/planilha/higienizacao-filtro-aparelho-climatizacao/cadastrar', [App\Http\Controllers\Planilhas\PlanilhaHigienizacaoFiltrosAparelhosClimatizacaoController::class, 'store']);
    Route::put('/planilha/higienizacao-filtro-aparelho-climatizacao/editar', [App\Http\Controllers\Planilhas\PlanilhaHigienizacaoFiltrosAparelhosClimatizacaoController::class, 'update']);
    Route::delete('/planilha/higienizacao-filtro-aparelho-climatizacao/deletar', [App\Http\Controllers\Planilhas\PlanilhaHigienizacaoFiltrosAparelhosClimatizacaoController::class, 'destroy']);

    // Planilha saturacao-oleo-gordura
    Route::get('/planilha/saturacao-oleo-gordura', [App\Http\Controllers\Planilhas\PlanilhaSaturacaoOleoGorduraController::class, 'index']);
    Route::get('/planilha/saturacao-oleo-gordura/listar', [App\Http\Controllers\Planilhas\PlanilhaSaturacaoOleoGorduraController::class, 'list']);
    Route::get('/planilha/saturacao-oleo-gordura/encontrar', [App\Http\Controllers\Planilhas\PlanilhaSaturacaoOleoGorduraController::class, 'find']);
    Route::post('/planilha/saturacao-oleo-gordura/cadastrar', [App\Http\Controllers\Planilhas\PlanilhaSaturacaoOleoGorduraController::class, 'store']);
    Route::put('/planilha/saturacao-oleo-gordura/editar', [App\Http\Controllers\Planilhas\PlanilhaSaturacaoOleoGorduraController::class, 'update']);
    Route::delete('/planilha/saturacao-oleo-gordura/deletar', [App\Http\Controllers\Planilhas\PlanilhaSaturacaoOleoGorduraController::class, 'destroy']);

    // Planilha limpeza-caixa-gorduras
    Route::get('/planilha/limpeza-caixa-gordura', [App\Http\Controllers\Planilhas\PlanilhaLimpezaCaixaGorduraController::class, 'index']);
    Route::get('/planilha/limpeza-caixa-gordura/listar', [App\Http\Controllers\Planilhas\PlanilhaLimpezaCaixaGorduraController::class, 'list']);
    Route::get('/planilha/limpeza-caixa-gordura/encontrar', [App\Http\Controllers\Planilhas\PlanilhaLimpezaCaixaGorduraController::class, 'find']);
    Route::post('/planilha/limpeza-caixa-gordura/cadastrar', [App\Http\Controllers\Planilhas\PlanilhaLimpezaCaixaGorduraController::class, 'store']);
    Route::put('/planilha/limpeza-caixa-gordura/editar', [App\Http\Controllers\Planilhas\PlanilhaLimpezaCaixaGorduraController::class, 'update']);
    Route::delete('/planilha/limpeza-caixa-gordura/deletar', [App\Http\Controllers\Planilhas\PlanilhaLimpezaCaixaGorduraController::class, 'destroy']);

    // Planilha registro-congelamento
    Route::get('/planilha/registro-congelamento', [App\Http\Controllers\Planilhas\PlanilhaRegistroCongelamentoController::class, 'index']);
    Route::get('/planilha/registro-congelamento/listar', [App\Http\Controllers\Planilhas\PlanilhaRegistroCongelamentoController::class, 'list']);
    Route::get('/planilha/registro-congelamento/encontrar', [App\Http\Controllers\Planilhas\PlanilhaRegistroCongelamentoController::class, 'find']);
    Route::post('/planilha/registro-congelamento/cadastrar', [App\Http\Controllers\Planilhas\PlanilhaRegistroCongelamentoController::class, 'store']);
    Route::put('/planilha/registro-congelamento/editar', [App\Http\Controllers\Planilhas\PlanilhaRegistroCongelamentoController::class, 'update']);
    Route::delete('/planilha/registro-congelamento/deletar', [App\Http\Controllers\Planilhas\PlanilhaRegistroCongelamentoController::class, 'destroy']);

    // Planilha verificacao-procedimento-higienizacao-hortifruti
    Route::get('/planilha/verificacao-procedimento-higienizacao-hortifruti', [App\Http\Controllers\Planilhas\PlanilhaVerificacaoProcedimentoHigienizacaoHortifrutiController::class, 'index']);
    Route::get('/planilha/verificacao-procedimento-higienizacao-hortifruti/listar', [App\Http\Controllers\Planilhas\PlanilhaVerificacaoProcedimentoHigienizacaoHortifrutiController::class, 'list']);
    Route::get('/planilha/verificacao-procedimento-higienizacao-hortifruti/encontrar', [App\Http\Controllers\Planilhas\PlanilhaVerificacaoProcedimentoHigienizacaoHortifrutiController::class, 'find']);
    Route::post('/planilha/verificacao-procedimento-higienizacao-hortifruti/cadastrar', [App\Http\Controllers\Planilhas\PlanilhaVerificacaoProcedimentoHigienizacaoHortifrutiController::class, 'store']);
    Route::put('/planilha/verificacao-procedimento-higienizacao-hortifruti/editar', [App\Http\Controllers\Planilhas\PlanilhaVerificacaoProcedimentoHigienizacaoHortifrutiController::class, 'update']);
    Route::delete('/planilha/verificacao-procedimento-higienizacao-hortifruti/deletar', [App\Http\Controllers\Planilhas\PlanilhaVerificacaoProcedimentoHigienizacaoHortifrutiController::class, 'destroy']);

    // Planilha manutencao-calibracao-equipamento
    Route::get('/planilha/manutencao-calibracao-equipamento', [App\Http\Controllers\Planilhas\PlanilhaManutencaoCalibracaoEquipamentoController::class, 'index']);
    Route::get('/planilha/manutencao-calibracao-equipamento/listar', [App\Http\Controllers\Planilhas\PlanilhaManutencaoCalibracaoEquipamentoController::class, 'list']);
    Route::get('/planilha/manutencao-calibracao-equipamento/encontrar', [App\Http\Controllers\Planilhas\PlanilhaManutencaoCalibracaoEquipamentoController::class, 'find']);
    Route::post('/planilha/manutencao-calibracao-equipamento/cadastrar', [App\Http\Controllers\Planilhas\PlanilhaManutencaoCalibracaoEquipamentoController::class, 'store']);
    Route::put('/planilha/manutencao-calibracao-equipamento/editar', [App\Http\Controllers\Planilhas\PlanilhaManutencaoCalibracaoEquipamentoController::class, 'update']);
    Route::delete('/planilha/manutencao-calibracao-equipamento/deletar', [App\Http\Controllers\Planilhas\PlanilhaManutencaoCalibracaoEquipamentoController::class, 'destroy']);

    // Planilha registro-limpeza
    Route::get('/planilha/registro-limpeza', [App\Http\Controllers\Planilhas\PlanilhaRegistroLimpezaController::class, 'index']);
    Route::get('/planilha/registro-limpeza/listar', [App\Http\Controllers\Planilhas\PlanilhaRegistroLimpezaController::class, 'list']);
    Route::get('/planilha/registro-limpeza/encontrar', [App\Http\Controllers\Planilhas\PlanilhaRegistroLimpezaController::class, 'find']);
    Route::post('/planilha/registro-limpeza/cadastrar', [App\Http\Controllers\Planilhas\PlanilhaRegistroLimpezaController::class, 'store']);
    Route::put('/planilha/registro-limpeza/editar', [App\Http\Controllers\Planilhas\PlanilhaRegistroLimpezaController::class, 'update']);
    Route::delete('/planilha/registro-limpeza/deletar', [App\Http\Controllers\Planilhas\PlanilhaRegistroLimpezaController::class, 'destroy']);

    // Planilha recebimento-materia-prima
    Route::get('/planilha/recebimento-materia-prima', [App\Http\Controllers\Planilhas\PlanilhaRecebimentoMateriaPrimaController::class, 'index']);
    Route::get('/planilha/recebimento-materia-prima/listar', [App\Http\Controllers\Planilhas\PlanilhaRecebimentoMateriaPrimaController::class, 'list']);
    Route::get('/planilha/recebimento-materia-prima/encontrar', [App\Http\Controllers\Planilhas\PlanilhaRecebimentoMateriaPrimaController::class, 'find']);
    Route::post('/planilha/recebimento-materia-prima/cadastrar', [App\Http\Controllers\Planilhas\PlanilhaRecebimentoMateriaPrimaController::class, 'store']);
    Route::put('/planilha/recebimento-materia-prima/editar', [App\Http\Controllers\Planilhas\PlanilhaRecebimentoMateriaPrimaController::class, 'update']);
    Route::delete('/planilha/recebimento-materia-prima/deletar', [App\Http\Controllers\Planilhas\PlanilhaRecebimentoMateriaPrimaController::class, 'destroy']);

    // Planilha resfriamento-rapido-alimento
    Route::get('/planilha/resfriamento-rapido-alimento', [App\Http\Controllers\Planilhas\PlanilhaResfriamentoRapidoAlimentoController::class, 'index']);
    Route::get('/planilha/resfriamento-rapido-alimento/listar', [App\Http\Controllers\Planilhas\PlanilhaResfriamentoRapidoAlimentoController::class, 'list']);
    Route::get('/planilha/resfriamento-rapido-alimento/encontrar', [App\Http\Controllers\Planilhas\PlanilhaResfriamentoRapidoAlimentoController::class, 'find']);
    Route::post('/planilha/resfriamento-rapido-alimento/cadastrar', [App\Http\Controllers\Planilhas\PlanilhaResfriamentoRapidoAlimentoController::class, 'store']);
    Route::put('/planilha/resfriamento-rapido-alimento/editar', [App\Http\Controllers\Planilhas\PlanilhaResfriamentoRapidoAlimentoController::class, 'update']);
    Route::delete('/planilha/resfriamento-rapido-alimento/deletar', [App\Http\Controllers\Planilhas\PlanilhaResfriamentoRapidoAlimentoController::class, 'destroy']);

    // Planilha reaquecimento-alimento
    Route::get('/planilha/reaquecimento-alimento', [App\Http\Controllers\Planilhas\PlanilhaReaquecimentoAlimentoController::class, 'index']);
    Route::get('/planilha/reaquecimento-alimento/listar', [App\Http\Controllers\Planilhas\PlanilhaReaquecimentoAlimentoController::class, 'list']);
    Route::get('/planilha/reaquecimento-alimento/encontrar', [App\Http\Controllers\Planilhas\PlanilhaReaquecimentoAlimentoController::class, 'find']);
    Route::post('/planilha/reaquecimento-alimento/cadastrar', [App\Http\Controllers\Planilhas\PlanilhaReaquecimentoAlimentoController::class, 'store']);
    Route::put('/planilha/reaquecimento-alimento/editar', [App\Http\Controllers\Planilhas\PlanilhaReaquecimentoAlimentoController::class, 'update']);
    Route::delete('/planilha/reaquecimento-alimento/deletar', [App\Http\Controllers\Planilhas\PlanilhaReaquecimentoAlimentoController::class, 'destroy']);

    // Planilha registro-nao-conformidade-detectada-auto-avaliacao
    Route::get('/planilha/registro-nao-conformidade-detectada-auto-avaliacao', [App\Http\Controllers\Planilhas\PlanilhaRegistroNaoConformidadeDetectadaAutoAvaliacaoController::class, 'index']);
    Route::get('/planilha/registro-nao-conformidade-detectada-auto-avaliacao/listar', [App\Http\Controllers\Planilhas\PlanilhaRegistroNaoConformidadeDetectadaAutoAvaliacaoController::class, 'list']);
    Route::get('/planilha/registro-nao-conformidade-detectada-auto-avaliacao/encontrar', [App\Http\Controllers\Planilhas\PlanilhaRegistroNaoConformidadeDetectadaAutoAvaliacaoController::class, 'find']);
    Route::post('/planilha/registro-nao-conformidade-detectada-auto-avaliacao/cadastrar', [App\Http\Controllers\Planilhas\PlanilhaRegistroNaoConformidadeDetectadaAutoAvaliacaoController::class, 'store']);
    Route::put('/planilha/registro-nao-conformidade-detectada-auto-avaliacao/editar', [App\Http\Controllers\Planilhas\PlanilhaRegistroNaoConformidadeDetectadaAutoAvaliacaoController::class, 'update']);
    Route::delete('/planilha/registro-nao-conformidade-detectada-auto-avaliacao/deletar', [App\Http\Controllers\Planilhas\PlanilhaRegistroNaoConformidadeDetectadaAutoAvaliacaoController::class, 'destroy']);

    // Planilha temperatura_alimento_banho_maria
    Route::get('/planilha/temperatura-alimento-banho-maria', [App\Http\Controllers\Planilhas\PlanilhaTemperaturaAlimentoBanhoMariaController::class, 'index']);
    Route::get('/planilha/temperatura-alimento-banho-maria/listar', [App\Http\Controllers\Planilhas\PlanilhaTemperaturaAlimentoBanhoMariaController::class, 'list']);
    Route::get('/planilha/temperatura-alimento-banho-maria/encontrar', [App\Http\Controllers\Planilhas\PlanilhaTemperaturaAlimentoBanhoMariaController::class, 'find']);
    Route::post('/planilha/temperatura-alimento-banho-maria/cadastrar', [App\Http\Controllers\Planilhas\PlanilhaTemperaturaAlimentoBanhoMariaController::class, 'store']);
    Route::put('/planilha/temperatura-alimento-banho-maria/editar', [App\Http\Controllers\Planilhas\PlanilhaTemperaturaAlimentoBanhoMariaController::class, 'update']);
    Route::delete('/planilha/temperatura-alimento-banho-maria/deletar', [App\Http\Controllers\Planilhas\PlanilhaTemperaturaAlimentoBanhoMariaController::class, 'destroy']);

    // Planilha temperatura_alimento_distribuicao
    Route::get('/planilha/temperatura-alimento-distribuicao', [App\Http\Controllers\Planilhas\PlanilhaTemperaturaAlimentoDistribuicaoController::class, 'index']);
    Route::get('/planilha/temperatura-alimento-distribuicao/listar', [App\Http\Controllers\Planilhas\PlanilhaTemperaturaAlimentoDistribuicaoController::class, 'list']);
    Route::get('/planilha/temperatura-alimento-distribuicao/encontrar', [App\Http\Controllers\Planilhas\PlanilhaTemperaturaAlimentoDistribuicaoController::class, 'find']);
    Route::post('/planilha/temperatura-alimento-distribuicao/cadastrar', [App\Http\Controllers\Planilhas\PlanilhaTemperaturaAlimentoDistribuicaoController::class, 'store']);
    Route::put('/planilha/temperatura-alimento-distribuicao/editar', [App\Http\Controllers\Planilhas\PlanilhaTemperaturaAlimentoDistribuicaoController::class, 'update']);
    Route::delete('/planilha/temperatura-alimento-distribuicao/deletar', [App\Http\Controllers\Planilhas\PlanilhaTemperaturaAlimentoDistribuicaoController::class, 'destroy']);

    // Planilha grupo_amostra_prato
    Route::get('/planilha/grupo-amostra-prato', [App\Http\Controllers\Planilhas\PlanilhaGrupoAmostraPratoController::class, 'index']);
    Route::get('/planilha/grupo-amostra-prato/listar', [App\Http\Controllers\Planilhas\PlanilhaGrupoAmostraPratoController::class, 'list']);
    Route::get('/planilha/grupo-amostra-prato/encontrar', [App\Http\Controllers\Planilhas\PlanilhaGrupoAmostraPratoController::class, 'find']);
    Route::post('/planilha/grupo-amostra-prato/cadastrar', [App\Http\Controllers\Planilhas\PlanilhaGrupoAmostraPratoController::class, 'store']);
    Route::put('/planilha/grupo-amostra-prato/editar', [App\Http\Controllers\Planilhas\PlanilhaGrupoAmostraPratoController::class, 'update']);
    Route::delete('/planilha/grupo-amostra-prato/deletar', [App\Http\Controllers\Planilhas\PlanilhaGrupoAmostraPratoController::class, 'destroy']);

    // Planilha avaliacao_manejo_residuo
    Route::get('/planilha/avaliacao-manejo-residuo', [App\Http\Controllers\Planilhas\PlanilhaAvaliacaoManejoResiduoController::class, 'index']);
    Route::get('/planilha/avaliacao-manejo-residuo/listar', [App\Http\Controllers\Planilhas\PlanilhaAvaliacaoManejoResiduoController::class, 'list']);
    Route::get('/planilha/avaliacao-manejo-residuo/encontrar', [App\Http\Controllers\Planilhas\PlanilhaAvaliacaoManejoResiduoController::class, 'find']);
    Route::post('/planilha/avaliacao-manejo-residuo/cadastrar', [App\Http\Controllers\Planilhas\PlanilhaAvaliacaoManejoResiduoController::class, 'store']);
    Route::put('/planilha/avaliacao-manejo-residuo/editar', [App\Http\Controllers\Planilhas\PlanilhaAvaliacaoManejoResiduoController::class, 'update']);
    Route::delete('/planilha/avaliacao-manejo-residuo/deletar', [App\Http\Controllers\Planilhas\PlanilhaAvaliacaoManejoResiduoController::class, 'destroy']);

    // Parametros
    Route::get('/parametros', [App\Http\Controllers\ParameterController::class, 'index']);
    Route::get('/parametro/listar', [App\Http\Controllers\ParameterController::class, 'list']);
    Route::get('/parametro/encontrar', [App\Http\Controllers\ParameterController::class, 'find']);
    Route::post('/parametro/cadastrar', [App\Http\Controllers\ParameterController::class, 'store']);
    Route::put('/parametro/editar', [App\Http\Controllers\ParameterController::class, 'update']);
    Route::delete('/parametro/deletar', [App\Http\Controllers\ParameterController::class, 'destroy']);

    // Tipos de parametros
    Route::get('/tipo-parametros', [App\Http\Controllers\ParameterTypeController::class, 'index']);
    Route::get('/tipo-parametro/listar', [App\Http\Controllers\ParameterTypeController::class, 'list']);
    Route::post('/tipo-parametro/cadastrar', [App\Http\Controllers\ParameterTypeController::class, 'store']);
    Route::put('/tipo-parametro/editar', [App\Http\Controllers\ParameterTypeController::class, 'update']);
    Route::delete('/tipo-parametro/deletar', [App\Http\Controllers\ParameterTypeController::class, 'destroy']);

    // Usuários
    Route::get('/usuarios', [App\Http\Controllers\UserController::class, 'index']);
    Route::get('/usuario/listar', [App\Http\Controllers\UserController::class, 'list']);
    Route::post('/usuario/cadastrar', [App\Http\Controllers\UserController::class, 'store']);
    Route::put('/usuario/editar', [App\Http\Controllers\UserController::class, 'update']);
    Route::put('/usuario/editar-senha', [App\Http\Controllers\UserController::class, 'updatePassword']);
    Route::delete('/usuario/deletar', [App\Http\Controllers\UserController::class, 'destroy']);

    Route::group(['middleware' => ['admin']], function () {

        // Unidades
        Route::get('/unidades', [App\Http\Controllers\UnitController::class, 'index']);
        Route::get('/unidade/listar', [App\Http\Controllers\UnitController::class, 'list']);
        Route::post('/unidade/cadastrar', [App\Http\Controllers\UnitController::class, 'store']);
        Route::put('/unidade/editar', [App\Http\Controllers\UnitController::class, 'update']);
        Route::delete('/unidade/deletar', [App\Http\Controllers\UnitController::class, 'destroy']);

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
