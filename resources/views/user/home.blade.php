@extends('adminlte::page')

@section('meta_tags')
    <link rel="icon" href="/img/building.png" type="image/png">
@stop

@section('title', 'Usuários')

@section('content_header')
    <h1><i class="fas fa-users"></i> &nbsp;Usuários</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-header border-0">
            <h3 class="card-title"> </h3>
            <div class="card-tools">
                <a href="#" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modalStoreUser">
                <i class="fas fa-plus"></i>
                </a>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-valign-middle table-hover table-sm">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Unidade</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="list"></tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalStoreUser">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastrar Usuário</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formStoreUser">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nome</label>
                                <input type="text" required name="name" id="name" class="form-control" placeholder="Informe o nome do usuário">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" required name="email" id="email" class="form-control" placeholder="Informe o email">
                            </div>
                        </div>
                        @if(!auth()->user()->id_unit)
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="id_unit">Unidade</label>
                                <select type="text" required name="id_unit" id="id_unit" class="form-control"></select>
                            </div>
                        </div>
                        @endif
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="formStoreUser">Salvar</button>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalEditUser">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Usuário</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formEditUser">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name_edit">Nome</label>
                                <input type="hidden" required name="id_edit" id="id_edit" class="form-control" placeholder="Informe o nome do usuário">
                                <input type="text" required name="name_edit" id="name_edit" class="form-control" placeholder="Informe o nome do usuário">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email_edit">Email</label>
                                <input type="email" required name="email_edit" id="email_edit" class="form-control" placeholder="Informe o email">
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="formEditUser">Salvar</button>
            </div>
            </div>
        </div>
    </div>

@stop

@section('js')
    <script src="/js/user/home.js"></script>
@stop
