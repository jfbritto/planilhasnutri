@extends('adminlte::page')

@section('meta_tags')
    <link rel="icon" href="/img/building.png" type="image/png">
@stop

@section('title', 'Parâmetros')

@section('content_header')
    <h1><i class="fas fa-file"></i> &nbsp;Parâmetros</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-header border-0">
            <h3 class="card-title"> </h3>
            <div class="card-tools">
                <a href="#" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modalStoreParameter">
                <i class="fas fa-plus"></i>
                </a>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-valign-middle table-hover table-sm">
                    <thead>
                        <tr>
                            <th>Parâmetro</th>
                            <th>Unidade</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="list"></tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalStoreParameter">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastrar Parâmetro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formStoreParameter">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="id_parameter_type">Parâmetro</label>
                                <select type="text" required name="id_parameter_type" id="id_parameter_type" class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Nome</label>
                                <input type="text" required name="name" id="name" class="form-control" placeholder="Nome do parâmetro">
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="formStoreParameter">Salvar</button>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalEditParameter">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Planilha</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formEditParameter">
                    <div class="row">
                        {{-- <div class="col-md-12">
                            <div class="form-group">
                                <label for="id_parameter_type">Planilha</label>
                                <select type="text" required name="id_parameter_type" id="id_parameter_type" class="form-control"></select> --}}
                                <input type="hidden" required name="id_edit" id="id_edit" class="form-control" placeholder="Informe o nome da planilha">
                            {{-- </div>
                        </div> --}}
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name_edit">Nome</label>
                                <input type="text" required name="name_edit" id="name_edit" class="form-control" placeholder="Nome do parâmetro">
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="formEditParameter">Salvar</button>
            </div>
            </div>
        </div>
    </div>

@stop

@section('js')
    <script src="/js/parameter/home.js"></script>
@stop
