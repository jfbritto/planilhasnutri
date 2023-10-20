@extends('adminlte::page')

@section('meta_tags')
    <link rel="icon" href="/img/building.png" type="image/png">
@stop

@section('title', 'Controle de Reaquecimento dos Alimentos')

@section('content_header')
    <h1><i class="fas fa-file"></i> &nbsp;Controle de Reaquecimento dos Alimentos</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body border-0">
            <form id="formFiltroPrincipal">
                <div class="row">
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
                    <i class="fas fa-file-pdf"></i>
                </a>
                @if(auth()->user()->id_unit)
                <a href="#" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modalStorereaquecimento_alimento" title="Adicionar novo item">
                    <i class="fas fa-plus"></i>
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

    <div class="modal fade" tabindex="-1" role="dialog" id="modalStorereaquecimento_alimento">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastrar: Controle de Reaquecimento dos Alimentos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formStorereaquecimento_alimento">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="data">Data</label>
                                <input type="date" required name="data" id="data" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id_parameter_produto">Produto</label>
                                <select type="text" required name="id_parameter_produto" id="id_parameter_produto" class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="hora_temperatura_antes">Hora aferição antes do aquecimento</label>
                                <input type="time" required name="hora_temperatura_antes" id="hora_temperatura_antes" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="temperatura_antes">Temperatura aferição antes do aquecimento</label>
                                <input type="text" required name="temperatura_antes" id="temperatura_antes" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="hora_temperatura_depois">Hora aferição após o aquecimento</label>
                                <input type="time" required name="hora_temperatura_depois" id="hora_temperatura_depois" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="temperatura_depois">Temperatura aferição após o aquecimento</label>
                                <input type="text" required name="temperatura_depois" id="temperatura_depois" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="tempo_aquecimento">Tempo de aquecimento</label>
                                <input type="time" required name="tempo_aquecimento" id="tempo_aquecimento" class="form-control">
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
                                <label for="id_parameter_responsavel">Responsável</label>
                                <select type="text" required name="id_parameter_responsavel" id="id_parameter_responsavel" class="form-control"></select>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="formStorereaquecimento_alimento">Salvar</button>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalEditreaquecimento_alimento">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar: Controle de Reaquecimento dos Alimentos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formEditreaquecimento_alimento">
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
                                <label for="hora_temperatura_antes_edit">Hora aferição antes do aquecimento</label>
                                <input type="time" required name="hora_temperatura_antes_edit" id="hora_temperatura_antes_edit" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="temperatura_antes_edit">Temperatura aferição antes do aquecimento</label>
                                <input type="text" required name="temperatura_antes_edit" id="temperatura_antes_edit" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="hora_temperatura_depois_edit">Hora aferição após o aquecimento</label>
                                <input type="time" required name="hora_temperatura_depois_edit" id="hora_temperatura_depois_edit" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="temperatura_depois_edit">Temperatura aferição após o aquecimento</label>
                                <input type="text" required name="temperatura_depois_edit" id="temperatura_depois_edit" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="tempo_aquecimento_edit">Tempo de aquecimento</label>
                                <input type="time" required name="tempo_aquecimento_edit" id="tempo_aquecimento_edit" class="form-control">
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
                                <label for="usuario">Nutricionista</label>
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
                <button type="submit" class="btn btn-primary" form="formEditreaquecimento_alimento">Salvar</button>
            </div>
            </div>
        </div>
    </div>

@stop

@section('js')
    <script src="/js/planilha/reaquecimento_alimento.js"></script>
@stop
