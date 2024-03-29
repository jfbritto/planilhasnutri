@extends('adminlte::page')

@section('meta_tags')
    <link rel="icon" href="/img/building.png" type="image/png">
@stop

@section('title', 'Controle de Recebimento de Matéria Prima')

@section('content_header')
    <div class="row">
        <div class="col-sm-9">
            <h1 class="d-none d-md-block"><i class="fa-solid fa-people-carry-box"></i> &nbsp;Controle de Recebimento de Matéria Prima</h1>
            <h4 class="d-block d-sm-block d-md-none"><i class="fa-solid fa-people-carry-box"></i> &nbsp;Controle de Recebimento de Matéria Prima</h4>
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
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="id_parameter_fornecedor_filter">Fornecedor</label>
                            <select required name="id_parameter_fornecedor_filter" id="id_parameter_fornecedor_filter" class="form-control"></select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="id_parameter_produto_filter">Produto</label>
                            <select required name="id_parameter_produto_filter" id="id_parameter_produto_filter" class="form-control"></select>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header border-0">

            <i class="fa-regular fa-circle-question" style="cursor: pointer" data-toggle="popover_question"
                title="Descrição" data-content="
                    <p>A temperatura de veículo deve ser compatível com a temperaturta esperada no recebimento do alimento, conforme tabela ao lado (CVS5)</p>
                    <p>Atentar-se as embalagens dos forcedores e respeitar as indicações de conservação</p>
                ">
            </i>

            <div class="card-tools">
                <a href="#" class="btn btn-tool btn-sm" id="abrirPDF" title="Visualizar planilha">
                    <i class="fa-regular fa-file-pdf fa-2xl"></i>
                </a>
                @if(auth()->user()->id_unit)
                <a href="#" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modalStorerecebimento_materia_prima" title="Adicionar novo item">
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
                            <th class="elemento-esconder-celular">Fornecedor</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="list"></tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade"  role="dialog" id="modalStorerecebimento_materia_prima">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastrar: Controle de Recebimento de Matéria Prima</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formStorerecebimento_materia_prima">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="data">Data</label>
                                <input type="date" required name="data" id="data" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="id_parameter_produto">
                                    Produto
                                    <i class="fa fa-plus-circle color-green" aria-hidden="true" style="cursor: pointer"
                                    data-toggle="modal" data-target="#modalStoreParameterProduto" title="Cadastrar novo item"></i>
                                </label>
                                <select type="text" required name="id_parameter_produto" id="id_parameter_produto" class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="id_parameter_fornecedor">
                                    Fornecedor
                                    <i class="fa fa-plus-circle color-green" aria-hidden="true" style="cursor: pointer"
                                    data-toggle="modal" data-target="#modalStoreParameterFornecedor" title="Cadastrar novo item"></i>
                                </label>
                                <select type="text" required name="id_parameter_fornecedor" id="id_parameter_fornecedor" class="form-control"></select>
                            </div>
                        </div>
                        {{-- <div class="col-md-4">
                            <div class="form-group">
                                <label for="ordem_de_compra">Ordem de Compra</label>
                                <input type="text" name="ordem_de_compra" id="ordem_de_compra" class="form-control" placeholder="Informe a ordem de compra">
                            </div>
                        </div> --}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nota_fiscal">Nota Fiscal</label>
                                <input type="text" name="nota_fiscal" id="nota_fiscal" class="form-control" placeholder="Informe o nº da nota">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="sif_lote">Sif</label>
                                <input type="text" name="sif_lote" id="sif_lote" class="form-control" placeholder="Nº">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="lote">Lote</label>
                                <input type="text" name="lote" id="lote" class="form-control" placeholder="Nº">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="data_validade">Data Validade</label>
                                <input type="date" name="data_validade" id="data_validade" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="temperatura_alimento">Temperatura Alimento</label>
                                <input type="text" name="temperatura_alimento" id="temperatura_alimento" class="form-control percent" placeholder="Informe a temperatura">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="temperatura_veiculo">Temperatura Veículo</label>
                                <input type="text" name="temperatura_veiculo" id="temperatura_veiculo" class="form-control percent" placeholder="Informe a temperatura">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nao_conformidade">
                                    Não Conformidade&nbsp;

                                    <i class="fa-regular fa-circle-question" style="cursor: pointer" data-toggle="popover_question"
                                        title="Legendas não conformidades" data-content="
                                            <ol class='list-group'>
                                                <li class='list-group-item'>Características sensoriais impróprias para consumo</li>
                                                <li class='list-group-item'>Embalagem danificada</li>
                                                <li class='list-group-item'>Produto sem registro</li>
                                                <li class='list-group-item'>Transporte inadequado</li>
                                                <li class='list-group-item'>Dados incompletos no rótulo</li>
                                                <li class='list-group-item'>Temperatura inadequada do alimento e/ou veículo</li>
                                                <li class='list-group-item'>Uniforme inadequado</li>
                                                <li class='list-group-item'>Outro</li>
                                            </ol>
                                        ">
                                    </i>
                                </label>
                                <input type="text" name="nao_conformidade" id="nao_conformidade" class="form-control" placeholder="Informe a não conformidade">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="acao_corretiva">
                                    Ação Corretiva&nbsp;

                                    <i class="fa-regular fa-circle-question" style="cursor: pointer" data-toggle="popover_question"
                                        title="Legendas ação corretiva" data-content="
                                            <ol class='list-group'>
                                                <li class='list-group-item'>Devoulção do produto</li>
                                                <li class='list-group-item'>Notificação ao fornecedor</li>
                                                <li class='list-group-item'>Outro</li>
                                            </ol>
                                        ">
                                    </i>
                                </label>
                                <input type="text" name="acao_corretiva" id="acao_corretiva" class="form-control" placeholder="Informe a ação">
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
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="formStorerecebimento_materia_prima">Salvar</button>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade"  role="dialog" id="modalEditrecebimento_materia_prima">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar: Controle de Recebimento de Matéria Prima</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formEditrecebimento_materia_prima">
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
                                <label for="id_parameter_produto_edit">Produto</label>
                                <select type="text" required name="id_parameter_produto_edit" id="id_parameter_produto_edit" class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="id_parameter_fornecedor_edit">Fornecedor</label>
                                <select type="text" required name="id_parameter_fornecedor_edit" id="id_parameter_fornecedor_edit" class="form-control"></select>
                            </div>
                        </div>
                        {{-- <div class="col-md-4">
                            <div class="form-group">
                                <label for="ordem_de_compra_edit">Ordem de Compra</label>
                                <input type="text" name="ordem_de_compra_edit" id="ordem_de_compra_edit" class="form-control" placeholder="Informe a ordem de compra">
                            </div>
                        </div> --}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nota_fiscal_edit">Nota Fiscal</label>
                                <input type="text" name="nota_fiscal_edit" id="nota_fiscal_edit" class="form-control" placeholder="Informe o nº da nota">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="sif_lote_edit">Sif</label>
                                <input type="text" name="sif_lote_edit" id="sif_lote_edit" class="form-control" placeholder="Nº">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="lote_edit">Lote</label>
                                <input type="text" name="lote_edit" id="lote_edit" class="form-control" placeholder="Nº">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="data_validade_edit">Data Validade</label>
                                <input type="date" name="data_validade_edit" id="data_validade_edit" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="temperatura_alimento_edit">Temperatura Alimento</label>
                                <input type="text" name="temperatura_alimento_edit" id="temperatura_alimento_edit" class="form-control percent" placeholder="Informe a temperatura">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="temperatura_veiculo_edit">Temperatura Veículo</label>
                                <input type="text" name="temperatura_veiculo_edit" id="temperatura_veiculo_edit" class="form-control percent" placeholder="Informe a temperatura">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nao_conformidade_edit">
                                    Não Conformidade&nbsp;

                                    <i class="fa-regular fa-circle-question" style="cursor: pointer" data-toggle="popover_question"
                                        title="Legendas não conformidades" data-content="
                                            <ol class='list-group'>
                                                <li class='list-group-item'>Características sensoriais impróprias para consumo</li>
                                                <li class='list-group-item'>Embalagem danificada</li>
                                                <li class='list-group-item'>Produto sem registro</li>
                                                <li class='list-group-item'>Transporte inadequado</li>
                                                <li class='list-group-item'>Dados incompletos no rótulo</li>
                                                <li class='list-group-item'>Temperatura inadequada do alimento e/ou veículo</li>
                                                <li class='list-group-item'>Uniforme inadequado</li>
                                                <li class='list-group-item'>Outro</li>
                                            </ol>
                                        ">
                                    </i>
                                </label>
                                <input type="text" name="nao_conformidade_edit" id="nao_conformidade_edit" class="form-control" placeholder="Informe a não conformidade">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="acao_corretiva_edit">
                                    Ação Corretiva&nbsp;

                                    <i class="fa-regular fa-circle-question" style="cursor: pointer" data-toggle="popover_question"
                                        title="Legendas ação corretiva" data-content="
                                            <ol class='list-group'>
                                                <li class='list-group-item'>Devoulção do produto</li>
                                                <li class='list-group-item'>Notificação ao fornecedor</li>
                                                <li class='list-group-item'>Outro</li>
                                            </ol>
                                        ">
                                    </i>
                                </label>
                                <input type="text" name="acao_corretiva_edit" id="acao_corretiva_edit" class="form-control" placeholder="Informe a ação">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="id_parameter_responsavel_edit">Responsável</label>
                                <select type="text" required name="id_parameter_responsavel_edit" id="id_parameter_responsavel_edit" class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="usuario_edit">Usuário</label>
                                <input type="text" name="usuario" id="usuario" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="unidade_edit">Unidade</label>
                                <input type="text" name="unidade" id="unidade" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="formEditrecebimento_materia_prima">Salvar</button>
            </div>
            </div>
        </div>
    </div>

@stop

@section('js')
    <script src="/js/planilha/recebimento_materia_prima.js"></script>
@stop
