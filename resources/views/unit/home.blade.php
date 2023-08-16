@extends('adminlte::page')

@section('meta_tags')
    <link rel="icon" href="/img/building.png" type="image/png">
@stop

@section('title', 'Unidades')

@section('content_header')
    <h1><i class="fas fa-building"></i> &nbsp;Unidades</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-header border-0">
            <h3 class="card-title"> </h3>
            <div class="card-tools">
                <a href="#" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modalStoreUnit">
                <i class="fas fa-plus"></i>
                </a>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-valign-middle table-hover table-sm">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Nome</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="list"></tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalStoreUnit">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastrar Unidade</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formStoreUnit">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Nome</label>
                                <input type="text" required name="name" id="name" class="form-control" placeholder="Informe o nome da unidade">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="city">Cidade</label>
                                <input type="text" required name="city" id="city" class="form-control" placeholder="Informe a cidade">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sigla">Rede</label>
                                <select required name="sigla" id="sigla" class="form-control">
                                    <option value="">-- Selecione --</option>
                                    <option value="royal">Royal Tulip</option>
                                    <option value="golden">Golden Tulip</option>
                                    <option value="tulip">Tulip Inn</option>
                                    <option value="soft">Soft Inn</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description">Descrição</label>
                                <input type="text" required name="description" id="description" class="form-control" placeholder="Descreva alguma observação sobre a unidade">
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="formStoreUnit">Salvar</button>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalEditUnit">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Unidade</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formEditUnit">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name_edit">Nome</label>
                                <input type="hidden" required name="id_edit" id="id_edit" class="form-control" placeholder="Informe o nome da unidade">
                                <input type="text" required name="name_edit" id="name_edit" class="form-control" placeholder="Informe o nome da unidade">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="city_edit">Cidade</label>
                                <input type="text" required name="city_edit" id="city_edit" class="form-control" placeholder="Informe a cidade">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sigla_edit">Rede</label>
                                <select required name="sigla_edit" id="sigla_edit" class="form-control">
                                    <option value="">-- Selecione --</option>
                                    <option value="royal">Royal Tulip</option>
                                    <option value="golden">Golden Tulip</option>
                                    <option value="tulip">Tulip Inn</option>
                                    <option value="soft">Soft Inn</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description_edit">Descrição</label>
                                <input type="text" required name="description_edit" id="description_edit" class="form-control" placeholder="Descreva sobre a unidade">
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="formEditUnit">Salvar</button>
            </div>
            </div>
        </div>
    </div>

@stop

@section('js')
    <script src="/js/unit/home.js"></script>
@stop
