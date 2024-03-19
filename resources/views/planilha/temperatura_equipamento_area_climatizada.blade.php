@extends('adminlte::page')

@section('meta_tags')
    <link rel="icon" href="/img/building.png" type="image/png">
@stop

@section('title', 'Controle de Temperatura de Equipamentos e Áreas Climatizadas')

@section('content_header')

    <h1><i class="fa-solid fa-temperature-low"></i> &nbsp;Controle de Temperatura de Equipamentos e Áreas Climatizadas</h1>
    {{-- <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-8">
                    <h2><i class="fa-solid fa-temperature-low"></i> &nbsp;Controle de Temperatura de Equipamentos e Áreas Climatizadas</h2>
                </div>
                <div class="col-sm-4">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Planilhas</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </section> --}}

@stop

@section('content')
    @include('forms.forms')

    <div class="card show">
        <div class="card-header" style="cursor: pointer" data-card-widget="collapse">
            <h5 class="card-title">Buscar</h5>
            <div class="card-tools">
                <button type="button" class="btn btn-tool">
                    <i class="fas fa-arrow-down"></i>
                </button>
            </div>
        </div>
        <div class="card-body border-0" style="display: block;">
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

    <div class="card collapsed-card border-danger" id="boxEquipamentosFaltantes" style="display: none">
        <div class="card-header" style="cursor: pointer" data-card-widget="collapse">
            <h5 class="card-title">Equipamentos com temperaturas obrigatórias não preenchidas!</h5>
            <div class="card-tools">
                <button type="button" class="btn btn-tool">
                    <i class="fas fa-arrow-down"></i>
                </button>
            </div>
        </div>
        <div class="card-body border-0" style="display: none;">
            <p id="listaEquipamentosFaltantes"></p>
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
                <a href="#" class="btn btn-tool btn-sm" id="abrirConfig" title="Configurar Alimentos Padrão">
                    <i class="fa-solid fa-gear fa-xl"></i>
                </a>
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
                            <th>Equipamento</th>
                            <th>T 10hrs</th>
                            <th>T 16hrs</th>
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
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="data">Data</label>
                                <input type="date" required name="data" id="data" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="id_parameter_equipamento">
                                    Equipamento
                                    <i class="fa fa-plus-circle color-green" aria-hidden="true" style="cursor: pointer"
                                    data-toggle="modal" data-target="#modalStoreParameterEquipamento" title="Cadastrar novo item"></i>
                                </label>
                                <select required name="id_parameter_equipamento" id="id_parameter_equipamento" class="form-control selecao-customizada"></select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="id_parameter_status_equipamento">Status Equipamento</label>
                                <select name="id_parameter_status_equipamento" id="id_parameter_status_equipamento" class="form-control selecao-customizada">
                                    <option value="">Funcionando normalmente</option>
                                    <option value="1">Desligado</option>
                                    <option value="2">Limpeza</option>
                                    <option value="3">Manutenção</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="temperatura_1">Temperatura 10:00</label>
                                <input type="text" name="temperatura_1" id="temperatura_1" class="form-control percent" placeholder="Informe a temperatura">
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
                                <select required name="id_parameter_responsavel" id="id_parameter_responsavel" class="form-control selecao-customizada"></select>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <!-- Checkbox no canto inferior esquerdo -->
                <div class="form-check" style="position: absolute; left: 15px; bottom: 15px;">
                    <input type="checkbox" class="form-check-input" id="checkCadastrarOutro">
                    <label class="form-check-label" for="checkCadastrarOutro">Após salvar cadastrar outro</label>
                </div>

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
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="data_edit">Data</label>
                                <input type="date" required name="data_edit" id="data_edit" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="id_parameter_equipamento_edit">Equipamento</label>
                                <select required name="id_parameter_equipamento_edit" id="id_parameter_equipamento_edit" class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="id_parameter_status_equipamento_edit">Status Equipamento</label>
                                <select name="id_parameter_status_equipamento_edit" id="id_parameter_status_equipamento_edit" class="form-control selecao-customizada">
                                    <option value="">Funcionando normalmente</option>
                                    <option value="1">Desligado</option>
                                    <option value="2">Limpeza</option>
                                    <option value="3">Manutenção</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="temperatura_1_edit">Temperatura 10:00</label>
                                <input type="text" name="temperatura_1_edit" id="temperatura_1_edit" class="form-control percent" placeholder="Informe a temperatura">
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

    <div class="modal fade"  role="dialog" id="modalEditsegunda_temperatura_equipamento">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Segunda aferição</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formEditsegunda_temperatura_equipamento">
                    <input type="hidden" required name="id_edit_2" id="id_edit_2">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="id_parameter_equipamento_edit_2">Equipamento</label>
                                <select disabled name="id_parameter_equipamento_edit_2" id="id_parameter_equipamento_edit_2" class="form-control"></select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="temperatura_2_edit_2">Temperatura às 16:00</label>
                                <input type="text" name="temperatura_2_edit_2" id="temperatura_2_edit_2" class="form-control percent" placeholder="Informe a temperatura">
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="formEditsegunda_temperatura_equipamento">Salvar</button>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade"  role="dialog" id="modalConfigurarEquipamentosObrigatorios">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Configurações de Equipamentos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formConfigurarEquipamentosObrigatorios">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="id_parameter_equipamento_config">Equipamento</label>
                                <select required name="id_parameter_equipamento_config" id="id_parameter_equipamento_config" class="form-control selecao-customizada"></select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="maior_que">Cº maior que</label>
                                <input type="text" name="maior_que" id="maior_que" class="form-control percent" placeholder="Informe a temperatura">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="menor_que">Cº menor que</label>
                                <input type="text" name="menor_que" id="menor_que" class="form-control percent" placeholder="Informe a temperatura">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check" style="padding-top: 37px;">
                                <input class="form-check-input" type="checkbox" value="1" id="obrigatorio">
                                <label class="form-check-label" for="obrigatorio">
                                    Obrigatório
                                </label>
                            </div>
                        </div>
                        <div class="col-md-2" style="padding-top: 37px;">
                            @if(auth()->user()->id_unit)
                                <button type="submit" class="btn btn-primary" form="formConfigurarEquipamentosObrigatorios">Salvar</button>
                            @endif
                        </div>

                    </div>
                </form>

                <hr>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-valign-middle table-hover table-sm">
                            <thead>
                                <tr>
                                    <th>Equipamento</th>
                                    <th>Maior que</th>
                                    <th>Menor que</th>
                                    <th>Obrigatório</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="list2">
                                <tr>
                                    <td colspan="5" class="text-center">
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

    <div class="modal fade"  role="dialog" id="modalConfigurarEquipamentosObrigatoriosEdit">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar configurações de Equipamentos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formConfigurarEquipamentosObrigatoriosEdit">
                    <input type="hidden" required name="id_config_edit" id="id_config_edit">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="id_parameter_equipamento_config_edit">Equipamento</label>
                                <select disabled name="id_parameter_equipamento_config_edit" id="id_parameter_equipamento_config_edit" class="form-control selecao-customizada"></select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="maior_que_edit">Cº maior que</label>
                                <input type="text" name="maior_que_edit" id="maior_que_edit" class="form-control percent" placeholder="Informe a temperatura">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="menor_que_edit">Cº menor que</label>
                                <input type="text" name="menor_que_edit" id="menor_que_edit" class="form-control percent" placeholder="Informe a temperatura">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check" style="padding-top: 37px;">
                                <input class="form-check-input" type="checkbox" value="1" id="obrigatorio_edit">
                                <label class="form-check-label" for="obrigatorio_edit">
                                    Obrigatório
                                </label>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="formConfigurarEquipamentosObrigatoriosEdit">Salvar</button>
            </div>

            </div>
        </div>
    </div>

@stop

@section('js')
    <script src="/js/planilha/temperatura_equipamento_area_climatizada.js"></script>
@stop
