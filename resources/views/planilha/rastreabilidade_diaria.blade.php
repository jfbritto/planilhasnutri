@extends('adminlte::page')

@section('meta_tags')
    <link rel="icon" href="/img/building.png" type="image/png">
@stop

@section('title', 'Registro de Rastreabilidade Diária')

@section('content_header')
    <h1><i class="fa-solid fa-pencil"></i> &nbsp;Registro de Rastreabilidade Diária</h1>
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
                            <label for="id_parameter_produto_filter">Produto</label>
                            <select name="id_parameter_produto_filter" id="id_parameter_produto_filter" class="form-control"></select>
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
                <a href="#" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modalStorerastreabilidade_diaria" title="Adicionar novo item">
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
                            <th>Lote</th>
                            <th>Validade</th>
                            <th>Fabricante</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="list"></tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade"  role="dialog" id="modalStorerastreabilidade_diaria">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastrar: Registro de Rastreabilidade Diária</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formStorerastreabilidade_diaria">
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
                                <select required name="id_parameter_produto" id="id_parameter_produto" class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="lote">Lote</label>
                                <input type="text" required name="lote" id="lote" class="form-control" placeholder="Informe o lote">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="validade">Validade</label>
                                <input type="date" required name="validade" id="validade" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="id_parameter_fabricante">
                                    Fabricante
                                    <i class="fa fa-plus-circle color-green" aria-hidden="true" style="cursor: pointer"
                                    data-toggle="modal" data-target="#modalStoreParameterFabricante" title="Cadastrar novo item"></i>
                                </label>
                                <select required name="id_parameter_fabricante" id="id_parameter_fabricante" class="form-control"></select>
                            </div>
                        </div>
                        {{-- <div class="col-md-12">
                            <div class="form-group">
                                <label for="image">Imagem</label>
                                <input type="file" name="image" id="image" class="form-control">
                            </div>
                        </div> --}}
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="formStorerastreabilidade_diaria">Salvar</button>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade"  role="dialog" id="modalEditrastreabilidade_diaria">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar: Registro de Rastreabilidade Diária</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formEditrastreabilidade_diaria">
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
                                <label for="id_parameter_produto_edit">
                                    Produto
                                </label>
                                <select required name="id_parameter_produto_edit" id="id_parameter_produto_edit" class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="lote_edit">Lote</label>
                                <input type="text" required name="lote_edit" id="lote_edit" class="form-control" placeholder="Informe o lote">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="validade_edit">Validade</label>
                                <input type="date" required name="validade_edit" id="validade_edit" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="id_parameter_fabricante_edit">
                                    Fabricante
                                </label>
                                <select required name="id_parameter_fabricante_edit" id="id_parameter_fabricante_edit" class="form-control"></select>
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
                <button type="submit" class="btn btn-primary" form="formEditrastreabilidade_diaria">Salvar</button>
            </div>
            </div>
        </div>
    </div>

@stop

@section('js')
    <script src="/js/planilha/rastreabilidade_diaria.js"></script>
@stop
