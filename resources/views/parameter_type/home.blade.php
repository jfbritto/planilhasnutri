@extends('adminlte::page')

@section('meta_tags')
    <link rel="icon" href="/img/building.png" type="image/png">
@stop

@section('title', 'Parâmetros')

@section('content_header')
    <h1><i class="fas fa-cog"></i> &nbsp;Parâmetros</h1>
@stop

@section('content')

    <div class="card">
        <input type="hidden" id="isAdmin" value="{{auth()->user()->is_admin}}">
        @if(!auth()->user()->id_unit)
        <div class="card-header border-0">
                <h3 class="card-title"> </h3>
                <div class="card-tools">
                    <a href="#" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modalStoreParameterType" title="Cadastrar Novo Parâmetro">
                        <i class="fa-solid fa-square-plus fa-2xl color-green"></i>
                    </a>
                </div>
            </div>
        @endif
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-valign-middle table-hover table-sm">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="list"></tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalStoreParameterType">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastrar tipo de parâmetro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formStoreParameterType">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Nome</label>
                                <input type="text" required name="name" id="name" class="form-control" placeholder="Informe o nome do tipo do parâmetro">
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="formStoreParameterType">Salvar</button>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalEditParameterType">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar parâmetros</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formEditParameterType">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name_edit">Nome</label>
                                <input type="hidden" required name="id_edit" id="id_edit" class="form-control">
                                <input type="text" required name="name_edit" id="name_edit" class="form-control" placeholder="Informe o nome do parâmetros">
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="formEditParameterType">Salvar</button>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalCreateParameters">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Itens de: <strong><span id="title-parametro"></span></strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="card">
                        <div class="card-header border-0">
                            <h3 class="card-title"> </h3>
                            <div class="card-tools">
                                <a href="#" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modalStoreParameter" title="Cadastrar Novo Item">
                                    <i class="fa-solid fa-square-plus fa-2xl color-green"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped table-valign-middle table-hover table-sm">
                                    <thead>
                                        <tr>
                                            <th>Item</th>
                                            <th>Unidade</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="list2">
                                        <tr>
                                            <td colspan="3" class="text-center">
                                                <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalStoreParameter">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Novo item de: <strong><span id="title-novo-iten"></span></strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formStoreParameter">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name_parameter">Nome</label>
                                <input type="hidden" required name="id_parameter_type" id="id_parameter_type">
                                <input type="text" required name="name_parameter" id="name_parameter" class="form-control" placeholder="Nome do novo item">
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
                <h5 class="modal-title">Editar Item: <strong><span id="title-edit-item"></span></strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formEditParameter">
                    <div class="row">
                        <input type="hidden" required name="id_parameter_edit" id="id_parameter_edit">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name_parameter_edit">Nome</label>
                                <input type="text" required name="name_parameter_edit" id="name_parameter_edit" class="form-control" placeholder="Nome do parâmetro">
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
    <script src="/js/parameter_type/home.js"></script>
    {{-- <script src="/js/parameter/home.js"></script> --}}
@stop
