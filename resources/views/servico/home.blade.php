@extends('adminlte::page')

@section('meta_tags')
    <link rel="icon" href="/img/building.png" type="image/png">
@stop

@section('title', 'Serviços')

@section('content_header')
    <h1 class="d-none d-md-block"><i class="fas fa-calendar"></i> &nbsp;Serviços</h1>
    <h3 class="d-block d-sm-block d-md-none"><i class="fas fa-calendar"></i> &nbsp;Serviços</h3>
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
                            <label for="status_filter">Status</label>
                            <select name="status_filter" id="status_filter" class="form-control">
                                <option value="A">Ativos</option>
                                <option value="C">Concluídos</option>
                            </select>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header border-0">
            <div class="card-tools">
                @if(auth()->user()->id_unit)
                <a href="#" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modalStoreservicos" title="Adicionar novo item">
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
                            <th>Serviço</th>
                            <th class="elemento-esconder-celular">Frequência</th>
                            <th class="elemento-esconder-celular">Data</th>
                            <th class="elemento-esconder-celular">Próxima Data</th>
                            <th>Documento</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="list"></tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade"  role="dialog" id="modalStoreservicos">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastrar: Serviços</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formStoreservicos">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id_parameter_servico">
                                    Serviço
                                    <i class="fa fa-plus-circle color-green" aria-hidden="true" style="cursor: pointer"
                                    data-toggle="modal" data-target="#modalStoreParameterServico" title="Cadastrar novo item"></i>
                                </label>
                                <select type="text" required name="id_parameter_servico" id="id_parameter_servico" class="form-control selecao-customizada"></select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="frequencia_meses">Frequencia</label>
                                <select type="text" required name="frequencia_meses" id="frequencia_meses" class="form-control">
                                    <option value="">-- Selecione --</option>
                                    <option value="1">Mensal</option>
                                    <option value="2">Bimestral</option>
                                    <option value="3">Trimestral</option>
                                    <option value="6">Semestral</option>
                                    <option value="12">Anual</option>
                                    <option value="60">5 anos</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="data">Data</label>
                                <input type="date" required name="data" id="data" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="proxima_data">Próxima Data</label>
                                <input type="date" required name="proxima_data" id="proxima_data" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="documento">Documento</label>
                                <input required type="file" name="documento" id="documento" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="observacoes">Observações</label>
                                <textarea name="observacoes" id="observacoes" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="formStoreservicos">Salvar</button>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade"  role="dialog" id="modalEditservicos">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar: Serviços</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formEditservicos">
                    <input type="hidden" required name="id_edit" id="id_edit">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id_parameter_servico_edit">Serviço</label>
                                <select type="text" required name="id_parameter_servico_edit" id="id_parameter_servico_edit" class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="frequencia_meses_edit">Frequencia</label>
                                <select type="text" required name="frequencia_meses_edit" id="frequencia_meses_edit" class="form-control">
                                    <option value="">-- Selecione --</option>
                                    <option value="1">Mensal</option>
                                    <option value="2">Bimestral</option>
                                    <option value="3">Trimestral</option>
                                    <option value="6">Semestral</option>
                                    <option value="12">Anual</option>
                                    <option value="60">5 anos</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="data_edit">Data</label>
                                <input type="date" required name="data_edit" id="data_edit" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="proxima_data_edit">Próxima Data</label>
                                <input type="date" required name="proxima_data_edit" id="proxima_data_edit" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="observacoes_edit">Observações</label>
                                <textarea name="observacoes_edit" id="observacoes_edit" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="formEditservicos">Salvar</button>
            </div>
            </div>
        </div>
    </div>

@stop

@section('js')
    <script src="/js/servico/home.js"></script>
@stop
