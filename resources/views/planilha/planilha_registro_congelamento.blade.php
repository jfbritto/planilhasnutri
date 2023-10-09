@extends('adminlte::page')

@section('meta_tags')
    <link rel="icon" href="/img/building.png" type="image/png">
@stop

@section('title', 'Registro Congelamento')

@section('content_header')
    <h1><i class="fas fa-file"></i> &nbsp;Registro Congelamento</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-header border-0">
            @if(auth()->user()->id_unit)
                <h3 class="card-title"> </h3>
                <div class="card-tools">
                    <a href="#" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modalStoreplanilha_registro_congelamento">
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
                            <th>Data Congelamento</th>
                            <th>Produto</th>
                            <th>Quantidade</th>
                            <th>Data Recebimento</th>
                            <th>Data Fabricação</th>
                            <th>Alérgeno</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="list"></tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalStoreplanilha_registro_congelamento">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastrar: Registro Congelamento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formStoreplanilha_registro_congelamento">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="data_congelamento">Data Congelamento</label>
                                <input type="date" required name="data_congelamento" id="data_congelamento" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="id_parameter_produto">Produto</label>
                                <select required name="id_parameter_produto" id="id_parameter_produto" class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="quantidade">Quantidade</label>
                                <input type="text" required name="quantidade" id="quantidade" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="data_recebimento">Data Recebimento</label>
                                <input type="date" name="data_recebimento" id="data_recebimento" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="data_fabricacao">Data Fabricação</label>
                                <input type="date" name="data_fabricacao" id="data_fabricacao" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="alergeno">Alérgeno</label>
                                <input type="text" required name="alergeno" id="alergeno" class="form-control">
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="formStoreplanilha_registro_congelamento">Salvar</button>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalEditplanilha_registro_congelamento">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar: Registro Congelamento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formEditplanilha_registro_congelamento">
                    <input type="hidden" required name="id_edit" id="id_edit">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="data_congelamento_edit">Data Congelamento</label>
                                <input type="date" required name="data_congelamento_edit" id="data_congelamento_edit" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="id_parameter_produto_edit">Produto</label>
                                <select required name="id_parameter_produto_edit" id="id_parameter_produto_edit" class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="quantidade_edit">Quantidade</label>
                                <input type="text" required name="quantidade_edit" id="quantidade_edit" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="data_recebimento_edit">Data Recebimento</label>
                                <input type="date" name="data_recebimento_edit" id="data_recebimento_edit" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="data_fabricacao_edit">Data Fabricação</label>
                                <input type="date" name="data_fabricacao_edit" id="data_fabricacao_edit" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="alergeno_edit">Alérgeno</label>
                                <input type="text" required name="alergeno_edit" id="alergeno_edit" class="form-control">
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
                <button type="submit" class="btn btn-primary" form="formEditplanilha_registro_congelamento">Salvar</button>
            </div>
            </div>
        </div>
    </div>

@stop

@section('js')
    <script src="/js/planilha/planilha_registro_congelamento.js"></script>
@stop
