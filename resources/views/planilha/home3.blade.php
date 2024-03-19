@extends('adminlte::page')

@section('meta_tags')
    <link rel="icon" href="/img/building.png" type="image/png">
@stop

@section('title', 'Planilhas')

@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h1 class="d-none d-md-block"><i class="fa-solid fa-file-lines"></i> &nbsp;Planilhas</h1>
            <h3 class="d-block d-sm-block d-md-none"><i class="fa-solid fa-file-lines"></i> &nbsp;Planilhas</h3>
        </div>
        <div class="col-sm-6">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></div>
                </div>
                <input type="text" id="searchInput" class="form-control" placeholder="Digite o nome da planilha" onkeyup="filterPlanilhas()">
            </div>
        </div>
    </div>
@stop

@section('content')

<div class="row">
    <div class="col-sm-6 planilha" data-titulo="REG 001 - Recebimento de Matéria Prima">
        <div class="info-box">
            <span class="info-box-icon bg-secondary"><i class="fa-solid fa-people-carry-box"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Recebimento de Matéria Prima</span>
                <span class="info-box-text">REG 001</span>
                <span class="info-box-number"><a href="/planilha/recebimento-materia-prima" class="" style="color: black">Preencher planilha <i class="fas fa-arrow-circle-right"></i></a></span>
            </div>
        </div>
    </div>
    <div class="col-sm-6 planilha" data-titulo="REG 002 - Temperatura de Equipamentos e Áreas Climatizadas">
        <div class="info-box">
            <span class="info-box-icon bg-info"><i class="fa-solid fa-temperature-low"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Temperatura de Equipamentos e Áreas Climatizadas</span>
                <span class="info-box-text">REG 002</span>
                <span class="info-box-number"><a href="/planilha/temperatura-equipamento-area-climatizada" class="" style="color: black">Preencher planilha <i class="fas fa-arrow-circle-right"></i></a></span>
            </div>
        </div>
    </div>
    <div class="col-sm-6 planilha" data-titulo="REG 003 - Registro de Rastreabilidade Diária">
        <div class="info-box">
            <span class="info-box-icon bg-secondary"><i class="fa-solid fa-pencil"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Registro de Rastreabilidade Diária</span>
                <span class="info-box-text">REG 003</span>
                <span class="info-box-number"><a href="/planilha/rastreabilidade-diaria" class="" style="color: black">Preencher planilha <i class="fas fa-arrow-circle-right"></i></a></span>
            </div>
        </div>
    </div>
    <div class="col-sm-6 planilha" data-titulo="REG 004 - Resfriamento Rápido de Alimentos">
        <div class="info-box">
            <span class="info-box-icon bg-info"><i class="fa-solid fa-temperature-arrow-down"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Resfriamento Rápido de Alimentos</span>
                <span class="info-box-text">REG 004</span>
                <span class="info-box-number"><a href="/planilha/resfriamento-rapido-alimento" class="" style="color: black">Preencher planilha <i class="fas fa-arrow-circle-right"></i></a></span>
            </div>
        </div>
    </div>
    <div class="col-sm-6 planilha" data-titulo="REG 005 - Reaquecimento dos Alimentos">
        <div class="info-box">
            <span class="info-box-icon bg-danger"><i class="fa-solid fa-temperature-arrow-up"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Reaquecimento dos Alimentos</span>
                <span class="info-box-text">REG 005</span>
                <span class="info-box-number"><a href="/planilha/reaquecimento-alimento" class="" style="color: black">Preencher planilha <i class="fas fa-arrow-circle-right"></i></a></span>
            </div>
        </div>
    </div>
    <div class="col-sm-6 planilha" data-titulo="REG 006 - Temperatura dos Alimentos na Distribuição">
        <div class="info-box">
            <span class="info-box-icon bg-primary"><i class="fa-solid fa-bell-concierge"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Temperatura dos Alimentos na Distribuição</span>
                <span class="info-box-text">REG 006</span>
                <span class="info-box-number"><a href="/planilha/temperatura-alimento-distribuicao" class="" style="color: black">Preencher planilha <i class="fas fa-arrow-circle-right"></i></a></span>
            </div>
        </div>
    </div>
    <div class="col-sm-6 planilha" data-titulo="REG 007 - Registro de Limpeza">
        <div class="info-box">
            <span class="info-box-icon bg-info"><i class="fa-solid fa-hand-sparkles"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Registro de Limpeza</span>
                <span class="info-box-text">REG 007</span>
                <span class="info-box-number"><a href="/planilha/registro-limpeza" class="" style="color: black">Preencher planilha <i class="fas fa-arrow-circle-right"></i></a></span>
            </div>
        </div>
    </div>
    <div class="col-sm-6 planilha" data-titulo="REG 008 - Saturação de Óleos e Gorduras">
        <div class="info-box">
            <span class="info-box-icon bg-warning text-white"><i class="fa-solid fa-droplet"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Saturação de Óleos e Gorduras</span>
                <span class="info-box-text">REG 008</span>
                <span class="info-box-number"><a href="/planilha/saturacao-oleo-gordura" class="" style="color: black">Preencher planilha <i class="fas fa-arrow-circle-right"></i></a></span>
            </div>
        </div>
    </div>
</div>

@stop

@section('js')
    <script src="/js/planilha/home.js"></script>
@stop
