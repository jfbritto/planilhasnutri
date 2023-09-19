@extends('adminlte::page')

@section('meta_tags')
    <link rel="icon" href="/img/building.png" type="image/png">
@stop

@section('title', 'Controle de Temperatura dos Alimentos na Distribuição')

@section('content_header')
    <h1><i class="fas fa-file"></i> &nbsp;Controle de Temperatura dos Alimentos na Distribuição</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-header border-0">
            @if(auth()->user()->id_unit)
                <h3 class="card-title"> </h3>
                <div class="card-tools">
                    <a href="#" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modalStoretemperatura_alimento_distribuicao">
                    <i class="fas fa-plus"></i>
                    </a>
                </div>
            @endif
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
                                <label for="id_parameter_evento">Evento</label>
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
                                <label for="id_parameter_produto">Produto</label>
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
                                <label for="tremperatura_1">Temperatura 1º aferição</label>
                                <input type="text" required name="tremperatura_1" id="tremperatura_1" class="form-control">
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
                                <label for="tremperatura_2">Temperatura 2º aferição</label>
                                <input type="text" name="tremperatura_2" id="tremperatura_2" class="form-control">
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
                                <label for="tremperatura_3">Temperatura 3º aferição</label>
                                <input type="text" name="tremperatura_3" id="tremperatura_3" class="form-control">
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
                                <label for="tremperatura_4">Temperatura 4º aferição</label>
                                <input type="text" name="tremperatura_4" id="tremperatura_4" class="form-control">
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
                                <label for="tremperatura_5">Temperatura 5º aferição</label>
                                <input type="text" name="tremperatura_5" id="tremperatura_5" class="form-control">
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
                                <label for="tremperatura_6">Temperatura 6º aferição</label>
                                <input type="text" name="tremperatura_6" id="tremperatura_6" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="hora_7">Hora 7º aferição</label>
                                <input type="time" name="hora_7" id="hora_7" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="tremperatura_7">Temperatura 7º aferição</label>
                                <input type="text" name="tremperatura_7" id="tremperatura_7" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="acao_corretiva">Ação Corretiva</label>
                                <input type="text" required name="acao_corretiva" id="acao_corretiva" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id_parameter_responsavel">Responsável</label>
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
                                <label for="tremperatura_1_edit">Temperatura 1º aferição</label>
                                <input type="text" required name="tremperatura_1_edit" id="tremperatura_1_edit" class="form-control">
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
                                <label for="tremperatura_2_edit">Temperatura 2º aferição</label>
                                <input type="text" required name="tremperatura_2_edit" id="tremperatura_2_edit" class="form-control">
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
                                <label for="tremperatura_3_edit">Temperatura 3º aferição</label>
                                <input type="text" required name="tremperatura_3_edit" id="tremperatura_3_edit" class="form-control">
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
                                <label for="tremperatura_4_edit">Temperatura 4º aferição</label>
                                <input type="text" required name="tremperatura_4_edit" id="tremperatura_4_edit" class="form-control">
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
                                <label for="tremperatura_5_edit">Temperatura 5º aferição</label>
                                <input type="text" required name="tremperatura_5_edit" id="tremperatura_5_edit" class="form-control">
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
                                <label for="tremperatura_6_edit">Temperatura 6º aferição</label>
                                <input type="text" required name="tremperatura_6_edit" id="tremperatura_6_edit" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="hora_7_edit">Hora 7º aferição</label>
                                <input type="time" required name="hora_7_edit" id="hora_7_edit" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="tremperatura_7_edit">Temperatura 7º aferição</label>
                                <input type="text" required name="tremperatura_7_edit" id="tremperatura_7_edit" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="acao_corretiva_edit">Ação Corretiva</label>
                                <input type="text" required name="acao_corretiva_edit" id="acao_corretiva_edit" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id_parameter_responsavel_edit">Responsável</label>
                                <select type="text" required name="id_parameter_responsavel_edit" id="id_parameter_responsavel_edit" class="form-control"></select>
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
