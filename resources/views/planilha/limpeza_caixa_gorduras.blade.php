@extends('adminlte::page')

@section('meta_tags')
    <link rel="icon" href="/img/building.png" type="image/png">
@stop

@section('title', 'Registro de Limpeza de Caixa de Gordura')

@section('content_header')
    <h1><i class="fas fa-file"></i> &nbsp;Registro de Limpeza de Caixa de Gordura</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body border-0">
            <form id="formFiltroPrincipal">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="id_parameter_area_filter">Área</label>
                            <select required name="id_parameter_area_filter" id="id_parameter_area_filter" class="form-control"></select>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header border-0">
            @if(auth()->user()->id_unit)
                <h3 class="card-title"> </h3>
                <div class="card-tools">
                    <a href="#" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modalStorelimpeza_caixa_gorduras">
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
                            <th>Caixa de Gordura</th>
                            <th>Área</th>
                            <th>Limpeza</th>
                            <th>Próxima Limpeza</th>
                            <th>Responsável</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="list"></tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalStorelimpeza_caixa_gorduras">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastrar: Registro de Limpeza de Caixa de Gordura</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formStorelimpeza_caixa_gorduras">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="id_parameter_caixa_gordura">Caixa de Gordura</label>
                                <select type="text" required name="id_parameter_caixa_gordura" id="id_parameter_caixa_gordura" class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="id_parameter_area">Área</label>
                                <select type="text" required name="id_parameter_area" id="id_parameter_area" class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="id_parameter_responsavel">Responsável</label>
                                <select type="text" required name="id_parameter_responsavel" id="id_parameter_responsavel" class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="data_limpeza">Data da Limpeza</label>
                                <input type="date" required name="data_limpeza" id="data_limpeza" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="data_proxima_limpeza">Data da Próxima Limpeza</label>
                                <input type="date" required name="data_proxima_limpeza" id="data_proxima_limpeza" class="form-control">
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="formStorelimpeza_caixa_gorduras">Salvar</button>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalEditlimpeza_caixa_gorduras">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar: Registro de Limpeza de Caixa de Gordura</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formEditlimpeza_caixa_gorduras">
                    <input type="hidden" required name="id_edit" id="id_edit">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="id_parameter_caixa_gordura_edit">Caixa de Gordura</label>
                                <select type="text" required name="id_parameter_caixa_gordura_edit" id="id_parameter_caixa_gordura_edit" class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="id_parameter_area_edit">Área</label>
                                <select type="text" required name="id_parameter_area_edit" id="id_parameter_area_edit" class="form-control"></select>
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
                                <label for="data_limpeza_edit">Data da Limpeza</label>
                                <input type="date" required name="data_limpeza_edit" id="data_limpeza_edit" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="data_proxima_limpeza_edit">Data da Próxima Limpeza</label>
                                <input type="date" required name="data_proxima_limpeza_edit" id="data_proxima_limpeza_edit" class="form-control">
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
                <button type="submit" class="btn btn-primary" form="formEditlimpeza_caixa_gorduras">Salvar</button>
            </div>
            </div>
        </div>
    </div>

@stop

@section('js')
    <script src="/js/planilha/limpeza_caixa_gorduras.js"></script>
@stop
