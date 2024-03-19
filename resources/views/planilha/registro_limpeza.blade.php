@extends('adminlte::page')

@section('meta_tags')
    <link rel="icon" href="/img/building.png" type="image/png">
@stop

@section('title', 'Registro de Limpeza')

@section('content_header')
    <div class="row">
        <div class="col-sm-9">
            <h1 class="d-none d-md-block"><i class="fa-solid fa-hand-sparkles"></i> &nbsp;Registro de Limpeza</h1>
            <h4 class="d-block d-sm-block d-md-none"><i class="fa-solid fa-hand-sparkles"></i> &nbsp;Registro de Limpeza</h4>
        </div>
        <div class="col-sm-3">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/planilhas">Planilhas</a></li>
            </ol>
        </div>
    </div>
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
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="data_ini_filter">De</label>
                            <input type="date" value="{{now()->format('Y-m-01')}}" name="data_ini_filter" id="data_ini_filter" class="form-control">
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

            <i class="fa-regular fa-circle-question" style="cursor: pointer" data-toggle="popover_question"
                title="Descrição da planilha" data-content="
                    <ol class='list-group'>
                        <li class='list-group-item'>Item 1</li>
                        <li class='list-group-item'>Item 2</li>
                        <li class='list-group-item'>Item 3</li>
                    </ol>
                ">
            </i>

            <div class="card-tools">
                <a href="#" class="btn btn-tool btn-sm" id="abrirPDF" title="Visualizar planilha">
                    <i class="fa-regular fa-file-pdf fa-2xl"></i>
                </a>
                @if(auth()->user()->id_unit)
                <a href="#" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modalStoreregistro_limpeza" title="Adicionar novo item">
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
                            <th>Área</th>
                            <th>Superfície Limpa</th>
                            <th>Responsável</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="list"></tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade"  role="dialog" id="modalStoreregistro_limpeza">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastrar: Registro de Limpeza</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formStoreregistro_limpeza">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="data">Data</label>
                                <input type="date" required name="data" id="data" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="id_parameter_responsavel">
                                    Responsável
                                    <i class="fa fa-plus-circle color-green" aria-hidden="true" style="cursor: pointer"
                                    data-toggle="modal" data-target="#modalStoreParameterResponsavel" title="Cadastrar novo item"></i>
                                </label>
                                <select type="text" required name="id_parameter_responsavel" id="id_parameter_responsavel" class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="id_parameter_area">
                                    Área
                                    <i class="fa fa-plus-circle color-green" aria-hidden="true" style="cursor: pointer"
                                    data-toggle="modal" data-target="#modalStoreParameterArea" title="Cadastrar novo item"></i>
                                </label>
                                <select type="text" required name="id_parameter_area" id="id_parameter_area" class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="superficie_limpa">Superfície a ser Limpa</label>
                                <input type="text" required name="superficie_limpa" id="superficie_limpa" class="form-control" placeholder="Superfície a ser limpa">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="frequencia">Frequência</label>
                                <input type="text" name="frequencia" id="frequencia" class="form-control" placeholder="Informe a frequência">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="conforme_naoconforme">Conforme</label>
                                <select type="date" name="conforme_naoconforme" id="conforme_naoconforme" class="form-control">
                                    <option value="">-- Selecione --</option>
                                    <option value="1">Sim</option>
                                    <option value="0">Não</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="comentarios">Comentários</label>
                                <textarea name="comentarios" id="comentarios" class="form-control" placeholder="Comente sobre a limpeza"></textarea>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="formStoreregistro_limpeza">Salvar</button>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade"  role="dialog" id="modalEditregistro_limpeza">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar: Registro de Limpeza</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formEditregistro_limpeza">
                    <input type="hidden" required name="id_edit" id="id_edit">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="data_edit">Data</label>
                                <input type="date" required name="data_edit" id="data_edit" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="id_parameter_responsavel_edit">Responsável</label>
                                <select type="text" required name="id_parameter_responsavel_edit" id="id_parameter_responsavel_edit" class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="id_parameter_area_edit">Área</label>
                                <select type="text" required name="id_parameter_area_edit" id="id_parameter_area_edit" class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="superficie_limpa_edit">Superfície a ser Limpa</label>
                                <input type="text" required name="superficie_limpa_edit" id="superficie_limpa_edit" class="form-control" placeholder="Superfície a ser limpa">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="frequencia_edit">Frequência</label>
                                <input type="text" name="frequencia_edit" id="frequencia_edit" class="form-control" placeholder="Informe a frequência">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="conforme_naoconforme_edit">Conforme</label>
                                <select type="date" name="conforme_naoconforme_edit" id="conforme_naoconforme_edit" class="form-control">
                                    <option value="">-- Selecione --</option>
                                    <option value="1">Sim</option>
                                    <option value="0">Não</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="comentarios_edit">Comentários</label>
                                <input type="text" name="comentarios_edit" id="comentarios_edit" class="form-control" placeholder="Comente sobre a limpeza">
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
                <button type="submit" class="btn btn-primary" form="formEditregistro_limpeza">Salvar</button>
            </div>
            </div>
        </div>
    </div>

@stop

@section('js')
    <script src="/js/planilha/registro_limpeza.js"></script>
@stop
