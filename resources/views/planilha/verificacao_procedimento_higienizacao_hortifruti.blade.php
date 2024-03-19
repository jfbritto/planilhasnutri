@extends('adminlte::page')

@section('meta_tags')
    <link rel="icon" href="/img/building.png" type="image/png">
@stop

@section('title', 'Controle de Verificação do Procedimento de Higienização de Hortifrutis')

@section('content_header')
    <div class="row">
        <div class="col-sm-9">
            <h1 class="d-none d-md-block"><i class="fa-solid fa-faucet-drip"></i> &nbsp;Controle de Verificação do Procedimento de Higienização de Hortifrutis</h1>
            <h4 class="d-block d-sm-block d-md-none"><i class="fa-solid fa-faucet-drip"></i> &nbsp;Controle de Verificação do Procedimento de Higienização de Hortifrutis</h4>
        </div>
        <div class="col-sm-3">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/planilhas">Planilhas</a></li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    @include('forms.forms')

    <div class="card collapsed-card">
        <div class="card-header" style="cursor: pointer" data-card-widget="collapse">
            <h5 class="card-title"><i class="fa-solid fa-magnifying-glass"></i>&nbsp;&nbsp;Buscar</h5>
            <div class="card-tools">
                <button type="button" class="btn btn-tool">
                    <i class="fas fa-arrow-down"></i>
                </button>
            </div>
        </div>
        <div class="card-body border-0" style="display: none;">
            <form id="formFiltroPrincipal">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="data_ini_filter">De</label>
                            <input type="date" value="{{now()->format('Y-m-01')}}" name="data_ini_filter" id="data_ini_filter" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="data_fim_filter">Até</label>
                            <input type="date" name="data_fim_filter" id="data_fim_filter" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="id_parameter_produto_filter">Produto</label>
                            <select required name="id_parameter_produto_filter" id="id_parameter_produto_filter" class="form-control"></select>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header border-0">
            <div class="card-tools">
                <a href="#" class="btn btn-tool btn-sm" id="abrirPDF" title="Visualizar planilha">
                    <i class="fa-regular fa-file-pdf fa-2xl"></i>
                </a>
                @if(auth()->user()->id_unit)
                <a href="#" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modalStoreverificacao_procedimento_higienizacao_hortifruti" title="Adicionar novo item">
                    <i class="fa-solid fa-square-plus fa-2xl color-green"></i>
                </a>
                @endif
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-valign-middle table-hover table-sm">
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Produto</th>
                            <th>Hora inicio</th>
                            <th>Hora fim</th>
                            <th>Concentração</th>
                            <th>Responsável</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="list"></tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade"  role="dialog" id="modalStoreverificacao_procedimento_higienizacao_hortifruti">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastrar: Controle de Verificação do Procedimento de Higienização de Hortifrutis</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formStoreverificacao_procedimento_higienizacao_hortifruti">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="data">Data</label>
                                <input type="date" required name="data" id="data" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="id_parameter_produto">
                                    Produto
                                    <i class="fa fa-plus-circle color-green" aria-hidden="true" style="cursor: pointer"
                                    data-toggle="modal" data-target="#modalStoreParameterProduto" title="Cadastrar novo item"></i>
                                </label>
                                <select type="text" required name="id_parameter_produto" id="id_parameter_produto" class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="hora_imersao_inicio">Hora Inicio Imersão</label>
                                <input type="time" required name="hora_imersao_inicio" id="hora_imersao_inicio" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="hora_imersao_fim">Hora Final Imersão</label>
                                <input type="time" required name="hora_imersao_fim" id="hora_imersao_fim" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="concentracao_solucao_clorada">Concentração Solução Clorada</label>
                                <input type="text" name="concentracao_solucao_clorada" id="concentracao_solucao_clorada" class="form-control percent" placeholder="(ppm)">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="acao_corretiva">Ação Corretiva</label>
                                <input type="text" name="acao_corretiva" id="acao_corretiva" class="form-control" placeholder="Informe uma ação">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="id_parameter_area">
                                    Responsavel
                                    <i class="fa fa-plus-circle color-green" aria-hidden="true" style="cursor: pointer"
                                    data-toggle="modal" data-target="#modalStoreParameterResponsavel" title="Cadastrar novo item"></i>
                                </label>
                                <select type="text" required name="id_parameter_responsavel" id="id_parameter_responsavel" class="form-control"></select>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="formStoreverificacao_procedimento_higienizacao_hortifruti">Salvar</button>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade"  role="dialog" id="modalEditverificacao_procedimento_higienizacao_hortifruti">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar: Controle de Verificação do Procedimento de Higienização de Hortifrutis</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formEditverificacao_procedimento_higienizacao_hortifruti">
                    <input type="hidden" required name="id_edit" id="id_edit">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="data_edit">Data</label>
                                <input type="date" required name="data_edit" id="data_edit" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="id_parameter_produto_edit">Produto</label>
                                <select type="text" required name="id_parameter_produto_edit" id="id_parameter_produto_edit" class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="hora_imersao_inicio_edit">Hora Inicio Imersão</label>
                                <input type="time" required name="hora_imersao_inicio_edit" id="hora_imersao_inicio_edit" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="hora_imersao_fim_edit">Hora Final Imersão</label>
                                <input type="time" required name="hora_imersao_fim_edit" id="hora_imersao_fim_edit" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="concentracao_solucao_clorada_edit">Concentração Solução Clorada</label>
                                <input type="text" name="concentracao_solucao_clorada_edit" id="concentracao_solucao_clorada_edit" class="form-control percent" placeholder="(ppm)">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="acao_corretiva_edit">Ação Corretiva</label>
                                <input type="text" name="acao_corretiva_edit" id="acao_corretiva_edit" class="form-control" placeholder="Informe uma ação">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="id_parameter_responsavel_edit">Responsável</label>
                                <select type="text" required name="id_parameter_responsavel_edit" id="id_parameter_responsavel_edit" class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="usuario">Usuário</label>
                                <input type="text" name="usuario" id="usuario" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="unidade">Unidade</label>
                                <input type="text" name="unidade" id="unidade" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="formEditverificacao_procedimento_higienizacao_hortifruti">Salvar</button>
            </div>
            </div>
        </div>
    </div>

@stop

@section('js')
    <script src="/js/planilha/verificacao_procedimento_higienizacao_hortifruti.js"></script>
@stop
