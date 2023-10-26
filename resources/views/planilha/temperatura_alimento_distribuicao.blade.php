@extends('adminlte::page')

@section('meta_tags')
    <link rel="icon" href="/img/building.png" type="image/png">
@stop

@section('title', 'Controle de Temperatura dos Alimentos na Distribuição')

@section('content_header')
    <h1><i class="fa-solid fa-bell-concierge"></i> &nbsp;Controle de Temperatura dos Alimentos na Distribuição</h1>
@stop

@section('content')
    @include('forms.forms')

    <div class="card collapsed-card">
        <div class="card-header" style="cursor: pointer" data-card-widget="collapse">
            <h5 class="card-title">Filtros</h5>
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
                            <label for="id_parameter_evento_filter">Evento</label>
                            <select required name="id_parameter_evento_filter" id="id_parameter_evento_filter" class="form-control"></select>
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
                <a href="#" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modalStoretemperatura_alimento_distribuicao" title="Adicionar novo item">
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
                            <th>Evento</th>
                            <th>Período</th>
                            <th>Produto</th>
                            <th>Hora</th>
                            <th>Temperatura</th>
                            <th>Ação Corretiva</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="list"></tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalStoretemperatura_alimento_distribuicao">
        <div class="modal-dialog modal-lg" role="document">
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="data">Data</label>
                                <input type="date" required name="data" id="data" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id_parameter_evento">
                                    Evento
                                    <i class="fa fa-plus-circle color-green" aria-hidden="true" style="cursor: pointer"
                                    data-toggle="modal" data-target="#modalStoreParameterEvento" title="Cadastrar novo item"></i>
                                </label>
                                <select type="text" required name="id_parameter_evento" id="id_parameter_evento" class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="periodo">Período</label>
                                <select required name="periodo" id="periodo" class="form-control">
                                    <option value="">-- Selecione --</option>
                                    <option value="desjejum">Desjejum</option>
                                    <option value="almoco">Almoço</option>
                                    <option value="jantar">Jantar</option>
                                    <option value="ceia">Ceia</option>
                                </select>
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
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="hora_1">Hora 1º aferição</label>
                                <input type="time" required name="hora_1" id="hora_1" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="tremperatura_1">Tª 1º aferição</label>
                                <input type="text" required name="tremperatura_1" id="tremperatura_1" class="form-control" placeholder="Informe a temperatura">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="hora_2">Hora 2º aferição</label>
                                <input type="time" name="hora_2" id="hora_2" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="tremperatura_2">Tª 2º aferição</label>
                                <input type="text" name="tremperatura_2" id="tremperatura_2" class="form-control" placeholder="Informe a temperatura">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="hora_3">Hora 3º aferição</label>
                                <input type="time" name="hora_3" id="hora_3" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="tremperatura_3">Tª 3º aferição</label>
                                <input type="text" name="tremperatura_3" id="tremperatura_3" class="form-control" placeholder="Informe a temperatura">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="hora_4">Hora 4º aferição</label>
                                <input type="time" name="hora_4" id="hora_4" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="tremperatura_4">Tª 4º aferição</label>
                                <input type="text" name="tremperatura_4" id="tremperatura_4" class="form-control" placeholder="Informe a temperatura">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="hora_5">Hora 5º aferição</label>
                                <input type="time" name="hora_5" id="hora_5" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="tremperatura_5">Tª 5º aferição</label>
                                <input type="text" name="tremperatura_5" id="tremperatura_5" class="form-control" placeholder="Informe a temperatura">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="hora_6">Hora 6º aferição</label>
                                <input type="time" name="hora_6" id="hora_6" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="tremperatura_6">Tª 6º aferição</label>
                                <input type="text" name="tremperatura_6" id="tremperatura_6" class="form-control" placeholder="Informe a temperatura">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="acao_corretiva">Ação Corretiva</label>
                                <input type="text" required name="acao_corretiva" id="acao_corretiva" class="form-control" placeholder="Informe a ação">
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
                <button type="submit" class="btn btn-primary" form="formStoretemperatura_alimento_distribuicao">Salvar</button>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalEdittemperatura_alimento_distribuicao">
        <div class="modal-dialog modal-lg" role="document">
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="data_edit">Data</label>
                                <input type="date" required name="data_edit" id="data_edit" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id_parameter_evento_edit">Evento</label>
                                <select type="text" required name="id_parameter_evento_edit" id="id_parameter_evento_edit" class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="periodo_edit">Período</label>
                                <select required name="periodo_edit" id="periodo_edit" class="form-control">
                                    <option value="">-- Selecione --</option>
                                    <option value="desjejum">Desjejum</option>
                                    <option value="almoco">Almoço</option>
                                    <option value="jantar">Jantar</option>
                                    <option value="ceia">Ceia</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id_parameter_produto_edit">Produto</label>
                                <select type="text" required name="id_parameter_produto_edit" id="id_parameter_produto_edit" class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="hora_1_edit">Hora 1º aferição</label>
                                <input type="time" required name="hora_1_edit" id="hora_1_edit" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="tremperatura_1_edit">Tª 1º aferição</label>
                                <input type="text" required name="tremperatura_1_edit" id="tremperatura_1_edit" class="form-control" placeholder="Informe a temperatura">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="hora_2_edit">Hora 2º aferição</label>
                                <input type="time" required name="hora_2_edit" id="hora_2_edit" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="tremperatura_2_edit">Tª 2º aferição</label>
                                <input type="text" required name="tremperatura_2_edit" id="tremperatura_2_edit" class="form-control" placeholder="Informe a temperatura">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="hora_3_edit">Hora 3º aferição</label>
                                <input type="time" required name="hora_3_edit" id="hora_3_edit" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="tremperatura_3_edit">Tª 3º aferição</label>
                                <input type="text" required name="tremperatura_3_edit" id="tremperatura_3_edit" class="form-control" placeholder="Informe a temperatura">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="hora_4_edit">Hora 4º aferição</label>
                                <input type="time" required name="hora_4_edit" id="hora_4_edit" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="tremperatura_4_edit">Tª 4º aferição</label>
                                <input type="text" required name="tremperatura_4_edit" id="tremperatura_4_edit" class="form-control" placeholder="Informe a temperatura">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="hora_5_edit">Hora 5º aferição</label>
                                <input type="time" required name="hora_5_edit" id="hora_5_edit" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="tremperatura_5_edit">Tª 5º aferição</label>
                                <input type="text" required name="tremperatura_5_edit" id="tremperatura_5_edit" class="form-control" placeholder="Informe a temperatura">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="hora_6_edit">Hora 6º aferição</label>
                                <input type="time" required name="hora_6_edit" id="hora_6_edit" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="tremperatura_6_edit">Tª 6º aferição</label>
                                <input type="text" required name="tremperatura_6_edit" id="tremperatura_6_edit" class="form-control" placeholder="Informe a temperatura">
                            </div>
                        </div>
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="acao_corretiva_edit">Ação Corretiva</label>
                                <input type="text" required name="acao_corretiva_edit" id="acao_corretiva_edit" class="form-control" placeholder="Informe a ação">
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
                <button type="submit" class="btn btn-primary" form="formEdittemperatura_alimento_distribuicao">Salvar</button>
            </div>
            </div>
        </div>
    </div>

@stop

@section('js')
    <script src="/js/planilha/temperatura_alimento_distribuicao.js"></script>
@stop
