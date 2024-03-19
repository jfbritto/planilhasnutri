@extends('adminlte::page')

@section('meta_tags')
    <link rel="icon" href="/img/building.png" type="image/png">
@stop

@section('title', 'Planilhas')

@section('content_header')
    <div class="row">
        <div class="col-sm-6 mb-2">
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

<section class="pt-2 mb-5">
    <div class="row">

        <div class="col-sm-6 col-lg-4 planilha" data-titulo="REG 001 - Recebimento de Matéria Prima">
            <div class="info-box">
                <span class="info-box-icon bg-secondary"><i class="fa-solid fa-people-carry-box"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Recebimento de Matéria Prima</span>
                    <span class="info-box-text">REG 001</span>
                    <span class="info-box-number"><a href="/planilha/recebimento-materia-prima" class="" style="color: black">Preencher planilha <i class="fas fa-arrow-circle-right"></i></a></span>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-4 planilha" data-titulo="REG 002 - Temperatura de Equipamentos e Áreas Climatizadas">
            <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fa-solid fa-temperature-low"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Temperatura de Equipamentos e Áreas Climatizadas</span>
                    <span class="info-box-text">REG 002</span>
                    <span class="info-box-number"><a href="/planilha/temperatura-equipamento-area-climatizada" class="" style="color: black">Preencher planilha <i class="fas fa-arrow-circle-right"></i></a></span>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-4 planilha" data-titulo="REG 003 - Registro de Rastreabilidade Diária">
            <div class="info-box">
                <span class="info-box-icon bg-secondary"><i class="fa-solid fa-pencil"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Registro de Rastreabilidade Diária</span>
                    <span class="info-box-text">REG 003</span>
                    <span class="info-box-number"><a href="/planilha/rastreabilidade-diaria" class="" style="color: black">Preencher planilha <i class="fas fa-arrow-circle-right"></i></a></span>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-4 planilha" data-titulo="REG 004 - Resfriamento Rápido de Alimentos">
            <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fa-solid fa-temperature-arrow-down"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Resfriamento Rápido de Alimentos</span>
                    <span class="info-box-text">REG 004</span>
                    <span class="info-box-number"><a href="/planilha/resfriamento-rapido-alimento" class="" style="color: black">Preencher planilha <i class="fas fa-arrow-circle-right"></i></a></span>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-4 planilha" data-titulo="REG 005 - Reaquecimento dos Alimentos">
            <div class="info-box">
                <span class="info-box-icon bg-danger"><i class="fa-solid fa-temperature-arrow-up"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Reaquecimento dos Alimentos</span>
                    <span class="info-box-text">REG 005</span>
                    <span class="info-box-number"><a href="/planilha/reaquecimento-alimento" class="" style="color: black">Preencher planilha <i class="fas fa-arrow-circle-right"></i></a></span>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-4 planilha" data-titulo="REG 006 - Temperatura dos Alimentos na Distribuição">
            <div class="info-box">
                <span class="info-box-icon bg-primary"><i class="fa-solid fa-bell-concierge"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Temperatura dos Alimentos na Distribuição</span>
                    <span class="info-box-text">REG 006</span>
                    <span class="info-box-number"><a href="/planilha/temperatura-alimento-distribuicao" class="" style="color: black">Preencher planilha <i class="fas fa-arrow-circle-right"></i></a></span>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-4 planilha" data-titulo="REG 007 - Registro de Limpeza">
            <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fa-solid fa-hand-sparkles"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Registro de Limpeza</span>
                    <span class="info-box-text">REG 007</span>
                    <span class="info-box-number"><a href="/planilha/registro-limpeza" class="" style="color: black">Preencher planilha <i class="fas fa-arrow-circle-right"></i></a></span>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-4 planilha" data-titulo="REG 008 - Saturação de Óleos e Gorduras">
            <div class="info-box">
                <span class="info-box-icon bg-warning text-white"><i class="fa-solid fa-droplet"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Saturação de Óleos e Gorduras</span>
                    <span class="info-box-text">REG 008</span>
                    <span class="info-box-number"><a href="/planilha/saturacao-oleo-gordura" class="" style="color: black">Preencher planilha <i class="fas fa-arrow-circle-right"></i></a></span>
                </div>
            </div>
        </div>


        <h4 class="mt-3 d-none d-md-block"><i class="fa-solid fa-file-lines"></i> &nbsp;Planilhas extras</h4>
        <h6 class="mt-3 d-block d-sm-block d-md-none"><i class="fa-solid fa-file-lines"></i> &nbsp;Planilhas extras</h6>
        <hr class="mb-4">


        <div class="col-sm-6 col-lg-4 planilha" data-titulo="Troca do Elemento Filtrante">
            <div class="info-box">
                <span class="info-box-icon bg-success text-white"><i class="fa-solid fa-filter-circle-xmark"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Troca do Elemento Filtrante</span>
                    <span class="info-box-text"></span>
                    <span class="info-box-number"><a href="/planilha/troca-elemento-filtrante" class="" style="color: black">Preencher planilha <i class="fas fa-arrow-circle-right"></i></a></span>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-4 planilha" data-titulo="Higienização dos Filtros e Aparelhos de Climatização">
            <div class="info-box">
                <span class="info-box-icon bg-primary text-white"><i class="fa-solid fa-soap"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Higienização dos Filtros e Aparelhos de Climatização</span>
                    <span class="info-box-text"></span>
                    <span class="info-box-number"><a href="/planilha/higienizacao-filtro-aparelho-climatizacao" class="" style="color: black">Preencher planilha <i class="fas fa-arrow-circle-right"></i></a></span>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-4 planilha" data-titulo="Limpeza de Caixa de Gordura">
            <div class="info-box">
                <span class="info-box-icon bg-secondary text-white"><i class="fa-solid fa-box-archive"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Limpeza de Caixa de Gordura</span>
                    <span class="info-box-text"></span>
                    <span class="info-box-number"><a href="/planilha/limpeza-caixa-gordura" class="" style="color: black">Preencher planilha <i class="fas fa-arrow-circle-right"></i></a></span>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-4 planilha" data-titulo="Registro de Congelamento">
            <div class="info-box">
                <span class="info-box-icon bg-info text-white"><i class="fa-solid fa-snowflake"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Registro de Congelamento</span>
                    <span class="info-box-text"></span>
                    <span class="info-box-number"><a href="/planilha/registro-congelamento" class="" style="color: black">Preencher planilha <i class="fas fa-arrow-circle-right"></i></a></span>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-4 planilha" data-titulo="Higienização de Hortifrutis">
            <div class="info-box">
                <span class="info-box-icon bg-secondary text-white"><i class="fa-solid fa-faucet-drip"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Higienização de Hortifrutis</span>
                    <span class="info-box-text"></span>
                    <span class="info-box-number"><a href="/planilha/verificacao-procedimento-higienizacao-hortifruti" class="" style="color: black">Preencher planilha <i class="fas fa-arrow-circle-right"></i></a></span>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-4 planilha" data-titulo="Manutenção e calibrações dos equipamentos">
            <div class="info-box">
                <span class="info-box-icon bg-secondary text-white"><i class="fa-solid fa-screwdriver-wrench"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Manutenção e calibrações dos equipamentos</span>
                    <span class="info-box-text"></span>
                    <span class="info-box-number"><a href="/planilha/manutencao-calibracao-equipamento" class="" style="color: black">Preencher planilha <i class="fas fa-arrow-circle-right"></i></a></span>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-4 planilha" data-titulo="Temperatura dos Alimentos no Banho-Maria">
            <div class="info-box">
                <span class="info-box-icon bg-danger text-white"><i class="fa-solid fa-mug-hot"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Temperatura dos Alimentos no Banho-Maria</span>
                    <span class="info-box-text"></span>
                    <span class="info-box-number"><a href="/planilha/temperatura-alimento-banho-maria" class="" style="color: black">Preencher planilha <i class="fas fa-arrow-circle-right"></i></a></span>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-4 planilha" data-titulo="Check-list de Avaliação do Manejo dos Resíduos">
            <div class="info-box">
                <span class="info-box-icon bg-success text-white"><i class="fa-solid fa-list-check"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Check-list de Avaliação do Manejo dos Resíduos</span>
                    <span class="info-box-text"></span>
                    <span class="info-box-number"><a href="/planilha/avaliacao-manejo-residuo" class="" style="color: black">Preencher planilha <i class="fas fa-arrow-circle-right"></i></a></span>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-4 planilha" data-titulo="Ocorrência de Pragas">
            <div class="info-box">
                <span class="info-box-icon bg-secondary text-white"><i class="fa-solid fa-mosquito"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Ocorrência de Pragas</span>
                    <span class="info-box-text"></span>
                    <span class="info-box-number"><a href="/planilha/ocorrencia-praga" class="" style="color: black">Preencher planilha <i class="fas fa-arrow-circle-right"></i></a></span>
                </div>
            </div>
        </div>

    </div>
</section>

@stop

@section('js')
    <script src="/js/planilha/home.js"></script>
@stop
