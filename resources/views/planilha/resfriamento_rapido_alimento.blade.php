@extends('adminlte::page')

@section('meta_tags')
    <link rel="icon" href="/img/building.png" type="image/png">
@stop

@section('title', 'Controle de Resfriamento Rápido de Alimentos')

@section('content_header')
    <h1><i class="fa-solid fa-temperature-arrow-down"></i> &nbsp;Controle de Resfriamento Rápido de Alimentos</h1>
@stop

@section('content')
    @include('forms.forms')

    <div class="card collapsed-card">
        <div class="card-header" style="cursor: pointer" data-card-widget="collapse">
            <h5 class="card-title">Buscar</h5>
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
                <a href="#" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modalStoreresfriamento_rapido_alimento" title="Adicionar novo item">
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
                            <th>Responsável</th>
                            <th>Conforme?</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="list"></tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade"  role="dialog" id="modalStoreresfriamento_rapido_alimento">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastrar: Controle de Resfriamento Rápido de Alimentos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formStoreresfriamento_rapido_alimento">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="data">Data</label>
                                <input type="date" required name="data" id="data" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id_parameter_produto">
                                    Produto
                                    <i class="fa fa-plus-circle color-green" aria-hidden="true" style="cursor: pointer"
                                    data-toggle="modal" data-target="#modalStoreParameterProduto" title="Cadastrar novo item"></i>
                                </label>
                                <select type="text" required name="id_parameter_produto" id="id_parameter_produto" class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cozimento_hora_final">Cozimento Hora Final</label>
                                <input type="time" required name="cozimento_hora_final" id="cozimento_hora_final" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cozimento_temperatura_interna">Cozimento Temperatura Interna</label>
                                <input type="text" required name="cozimento_temperatura_interna" id="cozimento_temperatura_interna" class="form-control" placeholder="Informe a temperatura">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="resfriamento_hora_inicio">Resfriamento Hora Início</label>
                                <input type="time" required name="resfriamento_hora_inicio" id="resfriamento_hora_inicio" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="resfriamento_temperatura_central_inicio">Resfriamento Temperatura Central Início</label>
                                <input type="text" required name="resfriamento_temperatura_central_inicio" id="resfriamento_temperatura_central_inicio" class="form-control" placeholder="Informe a temperatura">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="resfriamento_hora_fim">Resfriamento Hora Fim</label>
                                <input type="time" required name="resfriamento_hora_fim" id="resfriamento_hora_fim" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="resfriamento_temperatura_central_fim">Resfriamento Temperatura Central Fim</label>
                                <input type="text" required name="resfriamento_temperatura_central_fim" id="resfriamento_temperatura_central_fim" class="form-control" placeholder="Informe a temperatura">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="conforme_naoconforme">Conforme</label>
                                <select type="date" required name="conforme_naoconforme" id="conforme_naoconforme" class="form-control">
                                    <option value="">-- Selecione --</option>
                                    <option value="1">Sim</option>
                                    <option value="0">Não</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
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
                </form>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="formStoreresfriamento_rapido_alimento">Salvar</button>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade"  role="dialog" id="modalEditresfriamento_rapido_alimento">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar: Controle de Resfriamento Rápido de Alimentos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formEditresfriamento_rapido_alimento">
                    <input type="hidden" required name="id_edit" id="id_edit">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="data_edit">Data</label>
                                <input type="date" required name="data_edit" id="data_edit" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id_parameter_produto_edit">Produto</label>
                                <select type="text" required name="id_parameter_produto_edit" id="id_parameter_produto_edit" class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cozimento_hora_final_edit">Cozimento Hora Final</label>
                                <input type="time" required name="cozimento_hora_final_edit" id="cozimento_hora_final_edit" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cozimento_temperatura_interna_edit">Cozimento Temperatura Interna</label>
                                <input type="text" required name="cozimento_temperatura_interna_edit" id="cozimento_temperatura_interna_edit" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="resfriamento_hora_inicio_edit">Resfriamento Hora Início</label>
                                <input type="time" required name="resfriamento_hora_inicio_edit" id="resfriamento_hora_inicio_edit" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="resfriamento_temperatura_central_inicio_edit">Resfriamento Temperatura Central Início</label>
                                <input type="text" required name="resfriamento_temperatura_central_inicio_edit" id="resfriamento_temperatura_central_inicio_edit" class="form-control" placeholder="Informe a temperatura">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="resfriamento_hora_fim_edit">Resfriamento Hora Fim</label>
                                <input type="time" required name="resfriamento_hora_fim_edit" id="resfriamento_hora_fim_edit" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="resfriamento_temperatura_central_fim_edit">Resfriamento Temperatura Central Fim</label>
                                <input type="text" required name="resfriamento_temperatura_central_fim_edit" id="resfriamento_temperatura_central_fim_edit" class="form-control" placeholder="Informe a temperatura">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="conforme_naoconforme_edit">Conforme</label>
                                <select type="date" required name="conforme_naoconforme_edit" id="conforme_naoconforme_edit" class="form-control">
                                    <option value="">-- Selecione --</option>
                                    <option value="1">Sim</option>
                                    <option value="0">Não</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
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
                <button type="submit" class="btn btn-primary" form="formEditresfriamento_rapido_alimento">Salvar</button>
            </div>
            </div>
        </div>
    </div>

@stop

@section('js')
    <script src="/js/planilha/resfriamento_rapido_alimento.js"></script>
@stop
