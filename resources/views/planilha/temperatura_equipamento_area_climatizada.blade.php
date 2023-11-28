@extends('adminlte::page')

@section('meta_tags')
    <link rel="icon" href="/img/building.png" type="image/png">
@stop

@section('title', 'Controle de Temperatura de Equipamentos e Áreas Climatizadas')

@section('content_header')
    <h1><i class="fa-solid fa-temperature-low"></i> &nbsp;Controle de Temperatura de Equipamentos e Áreas Climatizadas</h1>
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
                            <input type="date" value="{{now()->format('Y-m-d')}}" name="data_ini_filter" id="data_ini_filter" class="form-control">
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
                            <label for="id_parameter_equipamento_filter">Equipamento</label>
                            <select name="id_parameter_equipamento_filter" id="id_parameter_equipamento_filter" class="form-control"></select>
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
                <a href="#" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modalStoretemperatura_equipamento_area_climatizada" title="Adicionar novo item">
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
                            <th>Responsável</th>
                            <th>Equipamento</th>
                            <th>Temperatura 10hrs</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="list"></tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade"  role="dialog" id="modalStoretemperatura_equipamento_area_climatizada">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastrar: Controle de Temperatura de Equipamentos e Áreas Climatizadas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formStoretemperatura_equipamento_area_climatizada">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="data">Data</label>
                                <input type="date" required name="data" id="data" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id_parameter_equipamento">
                                    Equipamento
                                    <i class="fa fa-plus-circle color-green" aria-hidden="true" style="cursor: pointer"
                                    data-toggle="modal" data-target="#modalStoreParameterEquipamento" title="Cadastrar novo item"></i>
                                </label>
                                <select required name="id_parameter_equipamento" id="id_parameter_equipamento" class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="temperatura_1">Temperatura 10:00</label>
                                <input type="text" required name="temperatura_1" id="temperatura_1" class="form-control percent" placeholder="Informe a temperatura">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="temperatura_2">Temperatura 16:00</label>
                                <input type="text" name="temperatura_2" id="temperatura_2" class="form-control percent" placeholder="Informe a temperatura">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="id_parameter_responsavel">
                                    Responsável
                                    <i class="fa fa-plus-circle color-green" aria-hidden="true" style="cursor: pointer"
                                    data-toggle="modal" data-target="#modalStoreParameterResponsavel" title="Cadastrar novo item"></i>
                                </label>
                                <select required name="id_parameter_responsavel" id="id_parameter_responsavel" class="form-control"></select>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="formStoretemperatura_equipamento_area_climatizada">Salvar</button>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade"  role="dialog" id="modalEdittemperatura_equipamento_area_climatizada">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar: Controle de Temperatura de Equipamentos e Áreas Climatizadas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formEdittemperatura_equipamento_area_climatizada">
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
                                <label for="id_parameter_equipamento_edit">Equipamento</label>
                                <select required name="id_parameter_equipamento_edit" id="id_parameter_equipamento_edit" class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="temperatura_1_edit">Temperatura 10:00</label>
                                <input type="text" required name="temperatura_1_edit" id="temperatura_1_edit" class="form-control percent" placeholder="Informe a temperatura">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="temperatura_2_edit">Temperatura 16:00</label>
                                <input type="text" name="temperatura_2_edit" id="temperatura_2_edit" class="form-control percent" placeholder="Informe a temperatura">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="id_parameter_responsavel_edit">Responsável</label>
                                <select required name="id_parameter_responsavel_edit" id="id_parameter_responsavel_edit" class="form-control"></select>
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
                <button type="submit" class="btn btn-primary" form="formEdittemperatura_equipamento_area_climatizada">Salvar</button>
            </div>
            </div>
        </div>
    </div>

@stop

@section('js')
    <script src="/js/planilha/temperatura_equipamento_area_climatizada.js"></script>
@stop
