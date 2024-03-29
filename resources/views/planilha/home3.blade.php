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

        <div class="col-sm-6 col-lg-4 planilha" data-titulo="REG 001 - Recebimento de Matéria Prima" title="Recebimento de Matéria Prima">
            <a href="/planilha/recebimento-materia-prima" style="color: black">
                <div class="info-box">
                    <span class="info-box-icon bg-secondary"><i class="fa-solid fa-people-carry-box"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Recebimento de Matéria Prima</span>
                        <span class="info-box-text">REG 001</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-lg-4 planilha" data-titulo="REG 002 - Temperatura de Equipamentos e Áreas Climatizadas" title="Temperatura de Equipamentos e Áreas Climatizadas">
            <a href="/planilha/temperatura-equipamento-area-climatizada" style="color: black">
                <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="fa-solid fa-temperature-low"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Temperatura de Equipamentos e Áreas Climatizadas</span>
                        <span class="info-box-text">REG 002</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-lg-4 planilha" data-titulo="REG 003 - Registro de Rastreabilidade Diária" title="Registro de Rastreabilidade Diária">
            <a href="/planilha/rastreabilidade-diaria" style="color: black">
                <div class="info-box">
                    <span class="info-box-icon bg-secondary"><i class="fa-solid fa-pencil"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Registro de Rastreabilidade Diária</span>
                        <span class="info-box-text">REG 003</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-lg-4 planilha" data-titulo="REG 004 - Resfriamento Rápido de Alimentos" title="Resfriamento Rápido de Alimentos">
            <a href="/planilha/resfriamento-rapido-alimento" style="color: black">
                <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="fa-solid fa-temperature-arrow-down"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Resfriamento Rápido de Alimentos</span>
                        <span class="info-box-text">REG 004</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-lg-4 planilha" data-titulo="REG 005 - Reaquecimento dos Alimentos" title="Reaquecimento dos Alimentos">
            <a href="/planilha/reaquecimento-alimento" style="color: black">
                <div class="info-box">
                    <span class="info-box-icon bg-danger"><i class="fa-solid fa-temperature-arrow-up"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Reaquecimento dos Alimentos</span>
                        <span class="info-box-text">REG 005</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-lg-4 planilha" data-titulo="REG 006 - Temperatura dos Alimentos na Distribuição" title="Temperatura dos Alimentos na Distribuição">
            <a href="/planilha/temperatura-alimento-distribuicao" style="color: black">
                <div class="info-box">
                    <span class="info-box-icon bg-primary"><i class="fa-solid fa-bell-concierge"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Temperatura dos Alimentos na Distribuição</span>
                        <span class="info-box-text">REG 006</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-lg-4 planilha" data-titulo="REG 007 - Registro de Limpeza" title="Registro de Limpeza">
            <a href="/planilha/registro-limpeza" style="color: black">
                <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="fa-solid fa-hand-sparkles"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Registro de Limpeza</span>
                        <span class="info-box-text">REG 007</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-lg-4 planilha" data-titulo="REG 008 - Saturação de Óleos e Gorduras" title="Saturação de Óleos e Gorduras">
            <a href="/planilha/saturacao-oleo-gordura" style="color: black">
                <div class="info-box">
                    <span class="info-box-icon bg-warning text-white"><i class="fa-solid fa-droplet"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Saturação de Óleos e Gorduras</span>
                        <span class="info-box-text">REG 008</span>
                    </div>
                </div>
            </a>
        </div>


        <h3 class="mt-3 d-none d-md-block"><i class="fa-solid fa-file-lines"></i> &nbsp;Planilhas extras</h3>
        <h3 class="mt-3 d-block d-sm-block d-md-none"><i class="fa-solid fa-file-lines"></i> &nbsp;Planilhas extras</h3>
        <hr class="mb-4">


        <div class="col-sm-6 col-lg-4 planilha" data-titulo="Troca do Elemento Filtrante" title="Troca do Elemento Filtrante">
            <a href="/planilha/troca-elemento-filtrante" style="color: black">
                <div class="info-box">
                    <span class="info-box-icon bg-success text-white"><i class="fa-solid fa-filter-circle-xmark"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Troca do Elemento Filtrante</span>
                        <span class="info-box-text"></span>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-lg-4 planilha" data-titulo="Higienização dos Filtros e Aparelhos de Climatização" title="Higienização dos Filtros e Aparelhos de Climatização">
            <a href="/planilha/higienizacao-filtro-aparelho-climatizacao" style="color: black">
                <div class="info-box">
                    <span class="info-box-icon bg-primary text-white"><i class="fa-solid fa-soap"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Higienização dos Filtros e Aparelhos de Climatização</span>
                        <span class="info-box-text"></span>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-lg-4 planilha" data-titulo="Limpeza de Caixa de Gordura" title="Limpeza de Caixa de Gordura">
            <a href="/planilha/limpeza-caixa-gordura" style="color: black">
                <div class="info-box">
                    <span class="info-box-icon bg-secondary text-white"><i class="fa-solid fa-box-archive"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Limpeza de Caixa de Gordura</span>
                        <span class="info-box-text"></span>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-lg-4 planilha" data-titulo="Registro de Congelamento" title="Registro de Congelamento">
            <a href="/planilha/registro-congelamento" style="color: black">
                <div class="info-box">
                    <span class="info-box-icon bg-info text-white"><i class="fa-solid fa-snowflake"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Registro de Congelamento</span>
                        <span class="info-box-text"></span>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-lg-4 planilha" data-titulo="Higienização de Hortifrutis" title="Higienização de Hortifrutis">
            <a href="/planilha/verificacao-procedimento-higienizacao-hortifruti" style="color: black">
                <div class="info-box">
                    <span class="info-box-icon bg-secondary text-white"><i class="fa-solid fa-faucet-drip"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Higienização de Hortifrutis</span>
                        <span class="info-box-text"></span>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-lg-4 planilha" data-titulo="Manutenção e calibrações dos equipamentos" title="Manutenção e calibrações dos equipamentos">
            <a href="/planilha/manutencao-calibracao-equipamento" style="color: black">
                <div class="info-box">
                    <span class="info-box-icon bg-secondary text-white"><i class="fa-solid fa-screwdriver-wrench"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Manutenção e calibrações dos equipamentos</span>
                        <span class="info-box-text"></span>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-lg-4 planilha" data-titulo="Temperatura dos Alimentos no Banho-Maria" title="Temperatura dos Alimentos no Banho-Maria">
            <a href="/planilha/temperatura-alimento-banho-maria" style="color: black">
                <div class="info-box">
                    <span class="info-box-icon bg-danger text-white"><i class="fa-solid fa-mug-hot"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Temperatura dos Alimentos no Banho-Maria</span>
                        <span class="info-box-text"></span>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-lg-4 planilha" data-titulo="Check-list de Avaliação do Manejo dos Resíduos" title="Check-list de Avaliação do Manejo dos Resíduos">
            <a href="/planilha/avaliacao-manejo-residuo" style="color: black">
                <div class="info-box">
                    <span class="info-box-icon bg-success text-white"><i class="fa-solid fa-list-check"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Check-list de Avaliação do Manejo dos Resíduos</span>
                        <span class="info-box-text"></span>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-lg-4 planilha" data-titulo="Ocorrência de Pragas" title="Ocorrência de Pragas">
            <a href="/planilha/ocorrencia-praga" style="color: black">
                <div class="info-box">
                    <span class="info-box-icon bg-secondary text-white"><i class="fa-solid fa-mosquito"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Ocorrência de Pragas</span>
                        <span class="info-box-text"></span>
                    </div>
                </div>
            </a>
        </div>

    </div>
</section>

@stop

@section('js')
    <script src="/js/planilha/home.js"></script>
@stop
