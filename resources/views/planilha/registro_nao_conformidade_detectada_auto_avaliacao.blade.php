@extends('adminlte::page')

@section('meta_tags')
    <link rel="icon" href="/img/building.png" type="image/png">
@stop

@section('title', 'Registro de Não Conformidades Detectadas da Auto Avaliação')

@section('content_header')
    <h1><i class="fas fa-file"></i> &nbsp;Registro de Não Conformidades Detectadas da Auto Avaliação</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-header border-0">
            @if(auth()->user()->id_unit)
                <h3 class="card-title"> </h3>
                <div class="card-tools">
                    <a href="#" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modalStoreregistro_nao_conformidade_detectada_auto_avaliacao">
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
                            <th>Não Conformidade</th>
                            <th>Possíveis Causas</th>
                            <th>Tratamento do Produto</th>
                            <th>Ação corretiva</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="list"></tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalStoreregistro_nao_conformidade_detectada_auto_avaliacao">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastrar: Registro de Não Conformidades Detectadas da Auto Avaliação</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formStoreregistro_nao_conformidade_detectada_auto_avaliacao">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="data">Data</label>
                                <input type="date" required name="data" id="data" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nao_conformidade">Não Conformidade</label>
                                <input type="text" required name="nao_conformidade" id="nao_conformidade" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="possiveis_causas">Possíveis Causas</label>
                                <input type="text" required name="possiveis_causas" id="possiveis_causas" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tratamento_produto">Tratamento do Produto</label>
                                <input type="text" required name="tratamento_produto" id="tratamento_produto" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="acoes_corretivas">Ação corretiva para evitar novas ocorrências</label>
                                <input type="text" required name="acoes_corretivas" id="acoes_corretivas" class="form-control">
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
                <button type="submit" class="btn btn-primary" form="formStoreregistro_nao_conformidade_detectada_auto_avaliacao">Salvar</button>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalEditregistro_nao_conformidade_detectada_auto_avaliacao">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar: Registro de Não Conformidades Detectadas da Auto Avaliação</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formEditregistro_nao_conformidade_detectada_auto_avaliacao">
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
                                <label for="nao_conformidade_edit">Não Conformidade</label>
                                <input type="text" required name="nao_conformidade_edit" id="nao_conformidade_edit" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="possiveis_causas_edit">Possíveis Causas</label>
                                <input type="text" required name="possiveis_causas_edit" id="possiveis_causas_edit" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tratamento_produto_edit">Tratamento do Produto</label>
                                <input type="text" required name="tratamento_produto_edit" id="tratamento_produto_edit" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="acoes_corretivas_edit">Ação corretiva para evitar novas ocorrências</label>
                                <input type="text" required name="acoes_corretivas_edit" id="acoes_corretivas_edit" class="form-control">
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
                <button type="submit" class="btn btn-primary" form="formEditregistro_nao_conformidade_detectada_auto_avaliacao">Salvar</button>
            </div>
            </div>
        </div>
    </div>

@stop

@section('js')
    <script src="/js/planilha/registro_nao_conformidade_detectada_auto_avaliacao.js"></script>
@stop