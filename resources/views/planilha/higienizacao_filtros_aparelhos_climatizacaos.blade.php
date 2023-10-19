@extends('adminlte::page')

@section('meta_tags')
    <link rel="icon" href="/img/building.png" type="image/png">
@stop

@section('title', 'Higienização dos Filtros e Aparelhos de Climatização')

@section('content_header')
    <h1><i class="fas fa-file"></i> &nbsp;Higienização dos Filtros e Aparelhos de Climatização</h1>
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
                    <a href="#" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modalStorehigienizacao_filtro_aparelho_climatizacao">
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
                            <th>Área</th>
                            <th>Equipamento</th>
                            <th>Higienização</th>
                            <th>Próxima Higienização</th>
                            <th>Responsável</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="list"></tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalStorehigienizacao_filtro_aparelho_climatizacao">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastrar: Higienização dos Filtros e Aparelhos de Climatização</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formStorehigienizacao_filtro_aparelho_climatizacao">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="id_parameter_area">Área</label>
                                <select type="text" required name="id_parameter_area" id="id_parameter_area" class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="id_parameter_equipamento">Equipamento</label>
                                <select type="text" required name="id_parameter_equipamento" id="id_parameter_equipamento" class="form-control"></select>
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
                                <label for="data_higienizacao">Data da Higienização</label>
                                <input type="date" required name="data_higienizacao" id="data_higienizacao" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="data_proxima_higienizacao">Data da Próxima Higienização</label>
                                <input type="date" required name="data_proxima_higienizacao" id="data_proxima_higienizacao" class="form-control">
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="formStorehigienizacao_filtro_aparelho_climatizacao">Salvar</button>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalEdithigienizacao_filtro_aparelho_climatizacao">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar: Higienização dos Filtros e Aparelhos de Climatização</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formEdithigienizacao_filtro_aparelho_climatizacao">
                    <input type="hidden" required name="id_edit" id="id_edit">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="id_parameter_area_edit">Área</label>
                                <select type="text" required name="id_parameter_area_edit" id="id_parameter_area_edit" class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="id_parameter_equipamento_edit">Equipamento</label>
                                <select type="text" required name="id_parameter_equipamento_edit" id="id_parameter_equipamento_edit" class="form-control"></select>
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
                                <label for="data_higienizacao_edit">Data da Higienização</label>
                                <input type="date" required name="data_higienizacao_edit" id="data_higienizacao_edit" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="data_proxima_higienizacao_edit">Data da Próxima Higienização</label>
                                <input type="date" required name="data_proxima_higienizacao_edit" id="data_proxima_higienizacao_edit" class="form-control">
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
                <button type="submit" class="btn btn-primary" form="formEdithigienizacao_filtro_aparelho_climatizacao">Salvar</button>
            </div>
            </div>
        </div>
    </div>

@stop

@section('js')
    <script src="/js/planilha/higienizacao_filtro_aparelho_climatizacao.js"></script>
@stop
