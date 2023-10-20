@extends('adminlte::page')

@section('meta_tags')
    <link rel="icon" href="/img/building.png" type="image/png">
@stop

@section('title', 'Chack-list de Avaliação do Manejo dos Resíduos')

@section('content_header')
    <h1><i class="fas fa-file"></i> &nbsp;Chack-list de Avaliação do Manejo dos Resíduos</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body border-0">
            <form id="formFiltroPrincipal">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="data_ini_filter">Data inicial</label>
                            <input type="date" value="{{now()->format('Y-m-01')}}" required name="data_ini_filter" id="data_ini_filter" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="data_fim_filter">Data final</label>
                            <input type="date" value="{{now()->format('Y-m-t')}}" required name="data_fim_filter" id="data_fim_filter" class="form-control">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header border-0">
            <div class="card-tools">
                <a href="#" class="btn btn-tool btn-sm" id="abrirPDF" title="Visualizar planilha">
                    <i class="fas fa-file-pdf"></i>
                </a>
                @if(auth()->user()->id_unit)
                <a href="#" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modalStoreavaliacao_manejo_residuo" title="Adicionar novo item">
                    <i class="fas fa-plus"></i>
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
                            <th>Armazenados em lixeiras apropriadas?</th>
                            <th>A retirada é realizada conforme descrito?</th>
                            <th>Manipuladores são treinados para executar o procedimento?</th>
                            <th>A área externa é apropriada para o armazenamento dos resíduos?</th>
                            <th>Os resíduos orgânicos são retirados na periodicidade devida?</th>
                            <th>A área externa está sendo higienizada após a coleta de resíduo? </th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="list"></tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalStoreavaliacao_manejo_residuo">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastrar: Chack-list de Avaliação do Manejo dos Resíduos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formStoreavaliacao_manejo_residuo">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="data">Data</label>
                                <input type="date" required name="data" id="data" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lixeira_apropriada">Os resíduos são armazenados em lixeiras apropriadas?</label>
                                <select required name="lixeira_apropriada" id="lixeira_apropriada" class="form-control">
                                    <option value="">-- Selecione --</option>
                                    <option value="1">Sim</option>
                                    <option value="0">Não</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="retirada_conforme">A retirada dos resíduos é realizada conforme descrito?</label>
                                <select required name="retirada_conforme" id="retirada_conforme" class="form-control">
                                    <option value="">-- Selecione --</option>
                                    <option value="1">Sim</option>
                                    <option value="0">Não</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="manipuladores_treinados">Os manipuladores são treinados para executar o procedimento?</label>
                                <select required name="manipuladores_treinados" id="manipuladores_treinados" class="form-control">
                                    <option value="">-- Selecione --</option>
                                    <option value="1">Sim</option>
                                    <option value="0">Não</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="area_externa_apropriada">A área externa é apropriada para o armazenamento dos resíduos?</label>
                                <select required name="area_externa_apropriada" id="area_externa_apropriada" class="form-control">
                                    <option value="">-- Selecione --</option>
                                    <option value="1">Sim</option>
                                    <option value="0">Não</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="residuos_organicos_retirados">Os resíduos orgânicos são retirados na periodicidade devida?</label>
                                <select required name="residuos_organicos_retirados" id="residuos_organicos_retirados" class="form-control">
                                    <option value="">-- Selecione --</option>
                                    <option value="1">Sim</option>
                                    <option value="0">Não</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="area_externa_higienizada">A área externa está sendo higienizada após a coleta de resíduo? </label>
                                <select required name="area_externa_higienizada" id="area_externa_higienizada" class="form-control">
                                    <option value="">-- Selecione --</option>
                                    <option value="1">Sim</option>
                                    <option value="0">Não</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="observacoes">Observações</label>
                                <input type="text" required name="observacoes" id="observacoes" class="form-control" placeholder="">
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="formStoreavaliacao_manejo_residuo">Salvar</button>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalEditavaliacao_manejo_residuo">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar: Chack-list de Avaliação do Manejo dos Resíduos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formEditavaliacao_manejo_residuo">
                    <input type="hidden" required name="id_edit" id="id_edit">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="data_edit">Data</label>
                                <input type="date" required name="data_edit" id="data_edit" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lixeira_apropriada_edit">Os resíduos são armazenados em lixeiras apropriadas?</label>
                                <select required name="lixeira_apropriada_edit" id="lixeira_apropriada_edit" class="form-control">
                                    <option value="">-- Selecione --</option>
                                    <option value="1">Sim</option>
                                    <option value="0">Não</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="retirada_conforme_edit">A retirada dos resíduos é realizada conforme descrito?</label>
                                <select required name="retirada_conforme_edit" id="retirada_conforme_edit" class="form-control">
                                    <option value="">-- Selecione --</option>
                                    <option value="1">Sim</option>
                                    <option value="0">Não</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="manipuladores_treinados_edit">Os manipuladores são treinados para executar o procedimento?</label>
                                <select required name="manipuladores_treinados_edit" id="manipuladores_treinados_edit" class="form-control">
                                    <option value="">-- Selecione --</option>
                                    <option value="1">Sim</option>
                                    <option value="0">Não</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="area_externa_apropriada_edit">A área externa é apropriada para o armazenamento dos resíduos?</label>
                                <select required name="area_externa_apropriada_edit" id="area_externa_apropriada_edit" class="form-control">
                                    <option value="">-- Selecione --</option>
                                    <option value="1">Sim</option>
                                    <option value="0">Não</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="residuos_organicos_retirados_edit">Os resíduos orgânicos são retirados na periodicidade devida?</label>
                                <select required name="residuos_organicos_retirados_edit" id="residuos_organicos_retirados_edit" class="form-control">
                                    <option value="">-- Selecione --</option>
                                    <option value="1">Sim</option>
                                    <option value="0">Não</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="area_externa_higienizada_edit">A área externa está sendo higienizada após a coleta de resíduo? </label>
                                <select required name="area_externa_higienizada_edit" id="area_externa_higienizada_edit" class="form-control">
                                    <option value="">-- Selecione --</option>
                                    <option value="1">Sim</option>
                                    <option value="0">Não</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="observacoes_edit">Observações</label>
                                <input type="text" required name="observacoes_edit" id="observacoes_edit" class="form-control" placeholder="">
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
                <button type="submit" class="btn btn-primary" form="formEditavaliacao_manejo_residuo">Salvar</button>
            </div>
            </div>
        </div>
    </div>

@stop

@section('js')
    <script src="/js/planilha/avaliacao_manejo_residuo.js"></script>
@stop
