@extends('adminlte::page')

@section('meta_tags')
    <link rel="icon" href="/img/building.png" type="image/png">
@stop

@section('title', 'Controle de Temperatura dos Alimentos na Distribuição')

@section('content_header')
    <div class="row">
        <div class="col-sm-9">
            <h1 class="d-none d-md-block"><i class="fa-solid fa-bell-concierge"></i> &nbsp;Controle de Temperatura dos Alimentos na Distribuição</h1>
            <h4 class="d-block d-sm-block d-md-none"><i class="fa-solid fa-bell-concierge"></i> &nbsp;Controle de Temperatura dos Alimentos na Distribuição</h4>
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
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="data_ini_filter">Data inicial</label>
                            <input type="date" value="{{now()->format('Y-m-01')}}" name="data_ini_filter" id="data_ini_filter" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="data_fim_filter">Data final</label>
                            <input type="date" name="data_fim_filter" id="data_fim_filter" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="periodo_filter">Período</label>
                            <select name="periodo_filter" id="periodo_filter" class="form-control">
                                <option value="">-- Selecione --</option>
                                <option value="desjejum">Desjejum</option>
                                <option value="cafe">Café da manhã</option>
                                <option value="almoco">Almoço</option>
                                <option value="jantar">Jantar</option>
                                <option value="ceia">Ceia</option>
                            </select>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header border-0">

            <i class="fa-regular fa-circle-question" style="cursor: pointer" data-toggle="popover_question"
                title="Descrição da planilha" data-content="
                    <ol class='list-group'>
                        <li class='list-group-item'>Item 1</li>
                        <li class='list-group-item'>Item 2</li>
                        <li class='list-group-item'>Item 3</li>
                    </ol>
                ">
            </i>

            <div class="card-tools">
                <a href="#" class="btn btn-tool btn-sm" id="abrirConfig" title="Configurar Alimentos Padrão">
                    <i class="fa-solid fa-gear fa-xl"></i>
                </a>
                @if(auth()->user()->id_unit)
                <a href="#" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modalStoretemperatura_alimento_distribuicao" id="openModalDistribuicao" title="Adicionar novo item">
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
                            <th>Período</th>
                            <th class="elemento-esconder-celular">Itens</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="list"></tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade"  role="dialog" id="modalStoretemperatura_alimento_distribuicao" data-backdrop="static">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastrar: Controle de Temperatura dos Alimentos na Distribuição</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formStoretemperatura_alimento_distribuicao">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="data">Data</label>
                                <input type="date" required name="data" id="data" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="id_parameter_evento">
                                    Evento
                                    <i class="fa fa-plus-circle color-green" aria-hidden="true" style="cursor: pointer"
                                    data-toggle="modal" data-target="#modalStoreParameterEvento" title="Cadastrar novo item"></i>
                                </label>
                                <select type="text" name="id_parameter_evento" id="id_parameter_evento" class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="periodo">Período</label>
                                <select required name="periodo" id="periodo" class="form-control">
                                    <option value="">-- Selecione --</option>
                                    <option value="desjejum">Desjejum</option>
                                    <option value="cafe">Café da manhã</option>
                                    <option value="almoco">Almoço</option>
                                    <option value="jantar">Jantar</option>
                                    <option value="ceia">Ceia</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="id_parameter_responsavel">
                                    Responsável
                                    <i class="fa fa-plus-circle color-green" aria-hidden="true" style="cursor: pointer"
                                    data-toggle="modal" data-target="#modalStoreParameterResponsavel" title="Cadastrar novo item"></i>
                                </label>

                                <select type="text" required name="id_parameter_responsavel" id="id_parameter_responsavel" class="form-control"></select>
                            </div>
                        </div>
                    </div>
                    <div id="dolly"></div>
                    <span class="badge bg-success mb-3" style="cursor: pointer" title="Inserir mais um produto" id="maisUmItem">Mais um</span>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="acao_corretiva">Ação Corretiva</label>
                                <textarea type="text" name="acao_corretiva" id="acao_corretiva" class="form-control" placeholder="Informe a ação"></textarea>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="formStoretemperatura_alimento_distribuicao">Salvar</button>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade"  role="dialog" id="modalEdittemperatura_alimento_distribuicao" data-backdrop="static">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar: Controle de Temperatura dos Alimentos na Distribuição</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formEdittemperatura_alimento_distribuicao">
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
                                <label for="id_parameter_evento_edit">Evento</label>
                                <select type="text" name="id_parameter_evento_edit" id="id_parameter_evento_edit" class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="periodo_edit">Período</label>
                                <select required name="periodo_edit" id="periodo_edit" class="form-control">
                                    <option value="">-- Selecione --</option>
                                    <option value="desjejum">Desjejum</option>
                                    <option value="cafe">Café da manhã</option>
                                    <option value="almoco">Almoço</option>
                                    <option value="jantar">Jantar</option>
                                    <option value="ceia">Ceia</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="id_parameter_responsavel_edit">Responsável</label>
                                <select type="text" required name="id_parameter_responsavel_edit" id="id_parameter_responsavel_edit" class="form-control"></select>
                            </div>
                        </div>
                    </div>
                    <div id="dolly-edit"></div>
                    @if(auth()->user()->id_unit)
                    <span class="badge bg-success mb-3" style="cursor: pointer" title="Inserir mais um produto" id="maisUmItemEdit">Mais um</span>
                    @endif
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="acao_corretiva_edit">Ação Corretiva</label>
                                <textarea name="acao_corretiva_edit" id="acao_corretiva_edit" class="form-control" placeholder="Informe a ação"></textarea>
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
            @if(auth()->user()->id_unit)
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="formEdittemperatura_alimento_distribuicao">Salvar</button>
            </div>
            @endif
            </div>
        </div>
    </div>

    <div class="modal fade"  role="dialog" id="modalConfigurarAlimentosPadrao">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Configurar Alimentos Padrão</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formConfigurarAlimentosPadrao">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="periodo_config">Período</label>
                                <select required name="periodo_config" id="periodo_config" class="form-control">
                                    <option value="">-- Selecione --</option>
                                    <option value="desjejum">Desjejum</option>
                                    <option value="cafe">Café da manhã</option>
                                    <option value="almoco">Almoço</option>
                                    <option value="jantar">Jantar</option>
                                    <option value="ceia">Ceia</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="checkbox-list"></div>
                </form>

            </div>
            @if(auth()->user()->id_unit)
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="formConfigurarAlimentosPadrao">Salvar</button>
            </div>
            @endif
            </div>
        </div>
    </div>

@stop

@section('js')
    <script src="/js/planilha/temperatura_alimento_distribuicao.js"></script>
@stop
