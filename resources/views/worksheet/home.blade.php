@extends('adminlte::page')

@section('meta_tags')
    <link rel="icon" href="/img/building.png" type="image/png">
@stop

@section('title', 'Planilhas')

@section('content_header')
    <h1><i class="fas fa-file"></i> &nbsp;Planilhas</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-header border-0">
            <h3 class="card-title"> </h3>
            <div class="card-tools">
                <a href="#" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modalStoreWorksheet">
                <i class="fas fa-plus"></i>
                </a>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-valign-middle table-hover table-sm">
                    <thead>
                        <tr>
                            <th>Planilha</th>
                            <th>Unidade</th>
                            <th>Nutricionista</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="list"></tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalStoreWorksheet">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastrar Planilha</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formStoreWorksheet">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="id_worksheet_structure">Planilha</label>
                                <select type="text" required name="id_worksheet_structure" id="id_worksheet_structure" class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description">Descrição</label>
                                <input type="text" required name="description" id="description" class="form-control" placeholder="Descreva alguma observação sobre a planilha">
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="formStoreWorksheet">Salvar</button>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalEditWorksheet">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Planilha</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formEditWorksheet">
                    <div class="row">
                        {{-- <div class="col-md-12">
                            <div class="form-group">
                                <label for="id_worksheet_structure_edit">Planilha</label>
                                <select type="text" required name="id_worksheet_structure_edit" id="id_worksheet_structure_edit" class="form-control"></select> --}}
                                <input type="hidden" required name="id_edit" id="id_edit" class="form-control" placeholder="Informe o nome da quadra">
                            {{-- </div>
                        </div> --}}
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description_edit">Descrição</label>
                                <input type="text" required name="description_edit" id="description_edit" class="form-control" placeholder="Descreva sobre a quadra">
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="formEditWorksheet">Salvar</button>
            </div>
            </div>
        </div>
    </div>

@stop

@section('js')
    <script src="/js/worksheet/home.js"></script>
@stop
