@extends('adminlte::page')

@section('meta_tags')
    <link rel="icon" href="/img/building.png" type="image/png">
@stop

@section('title', 'Relatório de Manutenção e calibrações dos equipamentos')

@section('content_header')
    <h1><i class="fas fa-file"></i> &nbsp;Relatório de Manutenção e calibrações dos equipamentos</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-header border-0">
            @if(auth()->user()->id_unit)
                <h3 class="card-title"> </h3>
                <div class="card-tools">
                    <a href="#" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modalStoremanutencao_calibracao_equipamento">
                    <i class="fas fa-plus"></i>
                    </a>
                </div>
            @endif
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-valign-middle table-hover table-sm">
                    <thead>
                        <tr>
                            <th>Equipamento</th>
                            <th>Calibração foi feita?</th>
                            <th>Data Calibração</th>
                            <th>Equipamento Com Problema?</th>
                            <th>Problema</th>
                            <th>Providencias tomadas</th>
                            <th>Problema Solucionado?</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="list"></tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalStoremanutencao_calibracao_equipamento">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastrar: Relatório de Manutenção e calibrações dos equipamentos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formStoremanutencao_calibracao_equipamento">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="id_parameter_equipamento">Equipamento</label>
                                <select required name="id_parameter_equipamento" id="id_parameter_equipamento" class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="calibracao_foi_feita">Calibração Foi Feita?</label>
                                <select required name="calibracao_foi_feita" id="calibracao_foi_feita" class="form-control">
                                    <option value="">-- Selecione --</option>
                                    <option value="1">Sim</option>
                                    <option value="0">Não</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="data_calibracao">Data Da Calibração</label>
                                <input type="date" name="data_calibracao" id="data_calibracao" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="equipamento_com_problema">Equipamento Com Problema?</label>
                                <select required name="equipamento_com_problema" id="equipamento_com_problema" class="form-control">
                                    <option value="">-- Selecione --</option>
                                    <option value="1">Sim</option>
                                    <option value="0">Não</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="qual_problema">Qual o problema?</label>
                                <input type="text" name="qual_problema" id="qual_problema" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="providencias_tomadas">Providencias Tomadas</label>
                                <input type="text" required name="providencias_tomadas" id="providencias_tomadas" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="problema_foi_solucionado">Problema Foi Solucionado?</label>
                                <select required name="problema_foi_solucionado" id="problema_foi_solucionado" class="form-control">
                                    <option value="">-- Selecione --</option>
                                    <option value="1">Sim</option>
                                    <option value="0">Não</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="observacoes">Observações</label>
                                <input type="text" required name="observacoes" id="observacoes" class="form-control">
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" form="formStoremanutencao_calibracao_equipamento">Salvar</button>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalEditmanutencao_calibracao_equipamento">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar: Relatório de Manutenção e calibrações dos equipamentos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formEditmanutencao_calibracao_equipamento">
                    <input type="hidden" required name="id_edit" id="id_edit">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="id_parameter_equipamento_edit">Equipamento</label>
                                <select required name="id_parameter_equipamento_edit" id="id_parameter_equipamento_edit" class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="calibracao_foi_feita_edit">Calibração Foi Feita?</label>
                                <select required name="calibracao_foi_feita_edit" id="calibracao_foi_feita_edit" class="form-control">
                                    <option value="">-- Selecione --</option>
                                    <option value="1">Sim</option>
                                    <option value="0">Não</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="data_calibracao_edit">Data Da Calibração</label>
                                <input type="date" name="data_calibracao_edit" id="data_calibracao_edit" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="equipamento_com_problema_edit">Equipamento Com Problema?</label>
                                <select required name="equipamento_com_problema_edit" id="equipamento_com_problema_edit" class="form-control">
                                    <option value="">-- Selecione --</option>
                                    <option value="1">Sim</option>
                                    <option value="0">Não</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="qual_problema_edit">Qual o problema?</label>
                                <input type="text" name="qual_problema_edit" id="qual_problema_edit" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="providencias_tomadas_edit">Providencias Tomadas</label>
                                <input type="text" required name="providencias_tomadas_edit" id="providencias_tomadas_edit" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="problema_foi_solucionado_edit">Problema Foi Solucionado?</label>
                                <select required name="problema_foi_solucionado_edit" id="problema_foi_solucionado_edit" class="form-control">
                                    <option value="">-- Selecione --</option>
                                    <option value="1">Sim</option>
                                    <option value="0">Não</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="observacoes_edit">Observações</label>
                                <input type="text" required name="observacoes_edit" id="observacoes_edit" class="form-control">
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
                <button type="submit" class="btn btn-primary" form="formEditmanutencao_calibracao_equipamento">Salvar</button>
            </div>
            </div>
        </div>
    </div>

@stop

@section('js')
    <script src="/js/planilha/manutencao_calibracao_equipamento.js"></script>
@stop