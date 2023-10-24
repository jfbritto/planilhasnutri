@extends('adminlte::page')

@section('meta_tags')
    <link rel="icon" href="/img/building.png" type="image/png">
@stop

@section('title', 'PlanilhasNUTRI')

@section('content_header')
    <h1 class="m-0 text-dark">Home</h1>
@stop

@section('content')

@if(!auth()->user()->id_unit)

<div class="row" id="listaPendencias">
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
            <span class="info-box-icon bg-success"><i class="far fa-copy"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Royal Tulip Brasília</span>
                <span class="info-box-text">Cadastrou <b>23</b> planilhas essa semana</span>
                <span class="info-box-number"><a href="/unidades" class="" style="color: black">Conferir <i class="fas fa-arrow-circle-right"></i></a></span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
            <span class="info-box-icon bg-success"><i class="far fa-copy"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Golden Tulip Gravatá</span>
                <span class="info-box-text">Cadastrou <b>18</b> planilhas essa semana</span>
                <span class="info-box-number"><a href="/unidades" class="" style="color: black">Conferir <i class="fas fa-arrow-circle-right"></i></a></span>
            </div>
        </div>
    </div>
</div>

@else

<div class="row" id="listaPendencias">
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
            <span class="info-box-icon bg-danger"><i class="far fa-copy"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Controle de Troca do Elemento Filtrante</span>
                <span class="info-box-text">Vence em <b>2</b> dias</span>
                <span class="info-box-number"><a href="/planilha/troca-elemento-filtrante" class="" style="color: black">Preencher planilha <i class="fas fa-arrow-circle-right"></i></a></span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
            <span class="info-box-icon bg-danger"><i class="far fa-copy"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Higienização dos Filtros e Aparelhos de Climatização</span>
                <span class="info-box-text">Vence em <b>4</b> dias</span>
                <span class="info-box-number"><a href="/planilha/higienizacao-filtro-aparelho-climatizacao" class="" style="color: black">Preencher planilha <i class="fas fa-arrow-circle-right"></i></a></span>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
            <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Controle de Saturação de Óleos e Gorduras</span>
                <span class="info-box-text">Vence em <b>15</b> dias</span>
                <span class="info-box-number"><a href="/planilha/saturacao-oleo-gordura" class="" style="color: black">Preencher planilha <i class="fas fa-arrow-circle-right"></i></a></span>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
            <span class="info-box-icon bg-info"><i class="far fa-copy"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Registro de Limpeza de Caixa de Gordura</span>
                <span class="info-box-text">Vence em <b>23</b> dias</span>
                <span class="info-box-number"><a href="/planilha/limpeza-caixa-gordura" class="" style="color: black">Preencher planilha <i class="fas fa-arrow-circle-right"></i></a></span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
            <span class="info-box-icon bg-info"><i class="far fa-copy"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Registro de Congelamento</span>
                <span class="info-box-text">Vence em <b>28</b> dias</span>
                <span class="info-box-number"><a href="/planilha/registro-congelamento" class="" style="color: black">Preencher planilha <i class="fas fa-arrow-circle-right"></i></a></span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
            <span class="info-box-icon bg-info"><i class="far fa-copy"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Controle de Verificação do Procedimento de Higienização de Hortifrutis</span>
                <span class="info-box-text">Vence em <b>30</b> dias</span>
                <span class="info-box-number"><a href="/planilha/verificacao-procedimento-higienizacao-hortifruti" class="" style="color: black">Preencher planilha <i class="fas fa-arrow-circle-right"></i></a></span>
            </div>
        </div>
    </div>
</div>

@endif

@stop

@section('js')
    <script src="/js/home.js"></script>
@stop
