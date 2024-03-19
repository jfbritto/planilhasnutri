@extends('adminlte::page')

@section('meta_tags')
    <link rel="icon" href="/img/building.png" type="image/png">
@stop

@section('title', 'Controle de Saturação de Óleos e Gorduras')

@section('content_header')
    <h1><i class="fa-solid fa-droplet"></i> &nbsp;Controle de Saturação de Óleos e Gorduras</h1>
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
                            <label for="data_ini_filter">De</label>
                            <input type="date" value="{{now()->format('Y-m-01')}}" name="data_ini_filter" id="data_ini_filter" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="data_fim_filter">Até</label>
                            <input type="date" name="data_fim_filter" id="data_fim_filter" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="id_parameter_area_filter">Área</label>
                            <select name="id_parameter_area_filter" id="id_parameter_area_filter" class="form-control"></select>
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
                <a href="#" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modalStoresaturacao_oleo_gordura" title="Adicionar novo item">
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
                            <th>Área/Equipamento</th>
                            <th>Hora 1ª aferição</th>
                            <th>Tª 1ª aferição</th>
                            <th>Leitura Fita</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="list"></tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade"  role="dialog" id="modalStoresaturacao_oleo_gordura">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastrar: Controle de Saturação de Óleos e Gorduras</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formStoresaturacao_oleo_gordura">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="data">Data</label>
                                <input type="date" required name="data" id="data" class="form-control" value="{{ now()->toDateString() }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="id_parameter_area">
                                    Área
                                    <i class="fa fa-plus-circle color-green" aria-hidden="true" style="cursor: pointer"
                                    data-toggle="modal" data-target="#modalStoreParameterArea" title="Cadastrar novo item"></i>
                                </label>
                                <select required name="id_parameter_area" id="id_parameter_area" class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="id_parameter_equipamento">
                                    Equipamento
                                    <i class="fa fa-plus-circle color-green" aria-hidden="true" style="cursor: pointer"
                                    data-toggle="modal" data-target="#modalStoreParameterEquipamento" title="Cadastrar novo item"></i>
                                </label>
                                <select required name="id_parameter_equipamento" id="id_parameter_equipamento" class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-md-3">
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
                                <label for="hora_primeira_afericao">Hora 1ª afereição</label>
                                <input type="time" required name="hora_primeira_afericao" id="hora_primeira_afericao" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="temperatura_primeira_afericao">Temperatura 1ª aferição (ºC)</label>
                                <input type="text" required name="temperatura_primeira_afericao" id="temperatura_primeira_afericao" class="form-control percent" placeholder="Somente números">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="hora_segunda_afericao">Hora 2ª afereição</label>
                                <input type="time" name="hora_segunda_afericao" id="hora_segunda_afericao" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="temperatura_segunda_afericao">Temperatura 2ª aferição (ºC)</label>
                                <input type="text" name="temperatura_segunda_afericao" id="temperatura_segunda_afericao" class="form-control percent" placeholder="Somente números">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="acao_corretiva">Ação corretiva</label>
                                <input type="text" name="acao_corretiva" id="acao_corretiva" class="form-control" placeholder="Informe a ação">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="id_parameter_responsavel_acao">Responsável pela ação</label>
                                <select name="id_parameter_responsavel_acao" id="id_parameter_responsavel_acao" class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="leitura_fita">Leitura da fita (%)</label>
                                <input type="text" name="leitura_fita" id="leitura_fita" class="form-control percent" placeholder="Informe a porcentagem">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="situacao_gordura">Situação da gordura</label>
                                <select name="situacao_gordura" id="situacao_gordura" class="form-control">
                                    <option value="">-- Selecione --</option>
                                    <option value="Boa">Boa</option>
                                    <option value="Ruim">Ruim</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="id_parameter_responsavel">Responsável</label>
                                <select required name="id_parameter_responsavel" id="id_parameter_responsavel" class="form-control"></select>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="formStoresaturacao_oleo_gordura">Salvar</button>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade"  role="dialog" id="modalEditsaturacao_oleo_gordura">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar: Controle de Saturação de Óleos e Gorduras</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formEditsaturacao_oleo_gordura">
                    <input type="hidden" required name="id_edit" id="id_edit">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="data_edit">Data</label>
                                <input type="date" required name="data_edit" id="data_edit" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="id_parameter_area_edit">Área</label>
                                <select required name="id_parameter_area_edit" id="id_parameter_area_edit" class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="id_parameter_equipamento_edit">Equipamento</label>
                                <select required name="id_parameter_equipamento_edit" id="id_parameter_equipamento_edit" class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-md-3">
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
                                <label for="hora_primeira_afericao_edit">Hora 1ª afereição</label>
                                <input type="time" required name="hora_primeira_afericao_edit" id="hora_primeira_afericao_edit" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="temperatura_primeira_afericao_edit">Temperatura 1ª aferição (ºC)</label>
                                <input type="text" required name="temperatura_primeira_afericao_edit" id="temperatura_primeira_afericao_edit" class="form-control" placeholder="Informe a temperatura">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="hora_segunda_afericao_edit">Hora 2ª afereição</label>
                                <input type="time" name="hora_segunda_afericao_edit" id="hora_segunda_afericao_edit" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="temperatura_segunda_afericao_edit">Temperatura 2ª aferição (ºC)</label>
                                <input type="text" name="temperatura_segunda_afericao_edit" id="temperatura_segunda_afericao_edit" class="form-control" placeholder="Informe a temperatura">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="acao_corretiva_edit">Ação corretiva</label>
                                <input type="text" name="acao_corretiva_edit" id="acao_corretiva_edit" class="form-control" placeholder="Informe a ação">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="id_parameter_responsavel_acao_edit">Responsável pela ação</label>
                                <select name="id_parameter_responsavel_acao_edit" id="id_parameter_responsavel_acao_edit" class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="leitura_fita_edit">Leitura da fita (%)</label>
                                <input type="text" name="leitura_fita_edit" id="leitura_fita_edit" class="form-control percent" placeholder="Informe a porcentagem">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="situacao_gordura_edit">Situação da gordura</label>
                                <select name="situacao_gordura_edit" id="situacao_gordura_edit" class="form-control">
                                    <option value="">-- Selecione --</option>
                                    <option value="Boa">Boa</option>
                                    <option value="Ruim">Ruim</option>
                                </select>
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
                <button type="submit" class="btn btn-primary" form="formEditsaturacao_oleo_gordura">Salvar</button>
            </div>
            </div>
        </div>
    </div>

@stop

@section('js')
    <script src="/js/planilha/saturacao_oleo_gordura.js"></script>
@stop
