@extends('adminlte::page')

@section('meta_tags')
    <link rel="icon" href="/img/building.png" type="image/png">
@stop

@section('title', 'Planilhas')

@section('content_header')
    <h1><i class="fa-solid fa-file-lines"></i> &nbsp;Planilhas</h1>
@stop

@section('content')

<section class="pt-5">
    <div class="container-fluid px-lg-5">
        <!-- Page Features-->
        <div class="row gx-lg-5">
            <div class="col-lg-6 col-sm-6 col-xxl-3 mb-5">
                <a href="/planilha/troca-elemento-filtrante">
                <div class="card bg-light border-0 h-100">
                    <div class="card-body text-center p-4 p-lg-3 pt-0 pt-lg-0">
                        <div class="feature bg-success bg-gradient text-white rounded-3 mb-4 mt-n4"><i class="fa-solid fa-filter-circle-xmark"></i></div>
                        <h2 class="fs-4 fw-bold">Troca do Elemento Filtrante</h2>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-lg-6 col-sm-6 col-xxl-3 mb-5">
                <a href="/planilha/higienizacao-filtro-aparelho-climatizacao">
                <div class="card bg-light border-0 h-100">
                    <div class="card-body text-center p-4 p-lg-3 pt-0 pt-lg-0">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4"><i class="fa-solid fa-soap"></i></div>
                        <h2 class="fs-4 fw-bold">Higienização dos Filtros e Aparelhos de Climatização</h2>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-lg-6 col-sm-6 col-xxl-3 mb-5">
                <a href="/planilha/saturacao-oleo-gordura">
                <div class="card bg-light border-0 h-100">
                    <div class="card-body text-center p-4 p-lg-3 pt-0 pt-lg-0">
                        <div class="feature bg-warning bg-gradient text-white rounded-3 mb-4 mt-n4"><i class="fa-solid fa-droplet"></i></div>
                        <h2 class="fs-4 fw-bold">Saturação de Óleos e Gorduras</h2>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-lg-6 col-sm-6 col-xxl-3 mb-5">
                <a href="/planilha/limpeza-caixa-gordura">
                <div class="card bg-light border-0 h-100">
                    <div class="card-body text-center p-4 p-lg-3 pt-0 pt-lg-0">
                        <div class="feature bg-secondary bg-gradient text-white rounded-3 mb-4 mt-n4"><i class="fa-solid fa-box-archive"></i></div>
                        <h2 class="fs-4 fw-bold">Limpeza de Caixa de Gordura</h2>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-lg-6 col-sm-6 col-xxl-3 mb-5">
                <a href="/planilha/registro-congelamento">
                <div class="card bg-light border-0 h-100">
                    <div class="card-body text-center p-4 p-lg-3 pt-0 pt-lg-0">
                        <div class="feature bg-info bg-gradient text-white rounded-3 mb-4 mt-n4"><i class="fa-solid fa-snowflake"></i></div>
                        <h2 class="fs-4 fw-bold">Registro de Congelamento</h2>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-lg-6 col-sm-6 col-xxl-3 mb-5">
                <a href="/planilha/verificacao-procedimento-higienizacao-hortifruti">
                <div class="card bg-light border-0 h-100">
                    <div class="card-body text-center p-4 p-lg-3 pt-0 pt-lg-0">
                        <div class="feature bg-secondary bg-gradient text-white rounded-3 mb-4 mt-n4"><i class="fa-solid fa-faucet-drip"></i></div>
                        <h2 class="fs-4 fw-bold">Higienização de Hortifrutis</h2>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-lg-6 col-sm-6 col-xxl-3 mb-5">
                <a href="/planilha/manutencao-calibracao-equipamento">
                <div class="card bg-light border-0 h-100">
                    <div class="card-body text-center p-4 p-lg-3 pt-0 pt-lg-0">
                        <div class="feature bg-secondary bg-gradient text-white rounded-3 mb-4 mt-n4"><i class="fa-solid fa-screwdriver-wrench"></i></div>
                        <h2 class="fs-4 fw-bold">Manutenção e calibrações dos equipamentos</h2>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-lg-6 col-sm-6 col-xxl-3 mb-5">
                <a href="/planilha/registro-limpeza">
                <div class="card bg-light border-0 h-100">
                    <div class="card-body text-center p-4 p-lg-3 pt-0 pt-lg-0">
                        <div class="feature bg-info bg-gradient text-white rounded-3 mb-4 mt-n4"><i class="fa-solid fa-hand-sparkles"></i></div>
                        <h2 class="fs-4 fw-bold">Registro de Limpeza</h2>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-lg-6 col-sm-6 col-xxl-3 mb-5">
                <a href="/planilha/recebimento-materia-prima">
                <div class="card bg-light border-0 h-100">
                    <div class="card-body text-center p-4 p-lg-3 pt-0 pt-lg-0">
                        <div class="feature bg-secondary bg-gradient text-white rounded-3 mb-4 mt-n4"><i class="fa-solid fa-people-carry-box"></i></div>
                        <h2 class="fs-4 fw-bold">Recebimento de Matéria Prima</h2>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-lg-6 col-sm-6 col-xxl-3 mb-5">
                <a href="/planilha/resfriamento-rapido-alimento">
                <div class="card bg-light border-0 h-100">
                    <div class="card-body text-center p-4 p-lg-3 pt-0 pt-lg-0">
                        <div class="feature bg-info bg-gradient text-white rounded-3 mb-4 mt-n4"><i class="fa-solid fa-temperature-arrow-down"></i></div>
                        <h2 class="fs-4 fw-bold">Resfriamento Rápido de Alimentos</h2>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-lg-6 col-sm-6 col-xxl-3 mb-5">
                <a href="/planilha/reaquecimento-alimento">
                <div class="card bg-light border-0 h-100">
                    <div class="card-body text-center p-4 p-lg-3 pt-0 pt-lg-0">
                        <div class="feature bg-danger bg-gradient text-white rounded-3 mb-4 mt-n4"><i class="fa-solid fa-temperature-arrow-up"></i></div>
                        <h2 class="fs-4 fw-bold">Reaquecimento dos Alimentos</h2>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-lg-6 col-sm-6 col-xxl-3 mb-5">
                <a href="/planilha/registro-nao-conformidade-detectada-auto-avaliacao">
                <div class="card bg-light border-0 h-100">
                    <div class="card-body text-center p-4 p-lg-3 pt-0 pt-lg-0">
                        <div class="feature bg-warning bg-gradient text-white rounded-3 mb-4 mt-n4"><i class="fa-solid fa-triangle-exclamation"></i></div>
                        <h2 class="fs-4 fw-bold">Não Conformidades Detectadas na Auto Avaliação</h2>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-lg-6 col-sm-6 col-xxl-3 mb-5">
                <a href="/planilha/temperatura-alimento-banho-maria">
                <div class="card bg-light border-0 h-100">
                    <div class="card-body text-center p-4 p-lg-3 pt-0 pt-lg-0">
                        <div class="feature bg-danger bg-gradient text-white rounded-3 mb-4 mt-n4"><i class="fa-solid fa-mug-hot"></i></div>
                        <h2 class="fs-4 fw-bold">Temperatura dos Alimentos no Banho-Maria</h2>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-lg-6 col-sm-6 col-xxl-3 mb-5">
                <a href="/planilha/temperatura-alimento-distribuicao">
                <div class="card bg-light border-0 h-100">
                    <div class="card-body text-center p-4 p-lg-3 pt-0 pt-lg-0">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4"><i class="fa-solid fa-bell-concierge"></i></div>
                        <h2 class="fs-4 fw-bold">Temperatura dos Alimentos na Distribuição</h2>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-lg-6 col-sm-6 col-xxl-3 mb-5">
                <a href="/planilha/grupo-amostra-prato">
                <div class="card bg-light border-0 h-100">
                    <div class="card-body text-center p-4 p-lg-3 pt-0 pt-lg-0">
                        <div class="feature bg-secondary bg-gradient text-white rounded-3 mb-4 mt-n4"><i class="fa-solid fa-plate-wheat"></i></div>
                        <h2 class="fs-4 fw-bold">Grupo de Amostras de Pratos</h2>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-lg-6 col-sm-6 col-xxl-3 mb-5">
                <a href="/planilha/avaliacao-manejo-residuo">
                <div class="card bg-light border-0 h-100">
                    <div class="card-body text-center p-4 p-lg-3 pt-0 pt-lg-0">
                        <div class="feature bg-success bg-gradient text-white rounded-3 mb-4 mt-n4"><i class="fa-solid fa-list-check"></i></div>
                        <h2 class="fs-4 fw-bold">Check-list de Avaliação do Manejo dos Resíduos</h2>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-lg-6 col-sm-6 col-xxl-3 mb-5">
                <a href="/planilha/ocorrencia-praga">
                <div class="card bg-light border-0 h-100">
                    <div class="card-body text-center p-4 p-lg-3 pt-0 pt-lg-0">
                        <div class="feature bg-secondary bg-gradient text-white rounded-3 mb-4 mt-n4"><i class="fa-solid fa-mosquito"></i></div>
                        <h2 class="fs-4 fw-bold">Ocorrência de Pragas</h2>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-lg-6 col-sm-6 col-xxl-3 mb-5">
                <a href="/planilha/temperatura-equipamento-area-climatizada">
                <div class="card bg-light border-0 h-100">
                    <div class="card-body text-center p-4 p-lg-3 pt-0 pt-lg-0">
                        <div class="feature bg-info bg-gradient text-white rounded-3 mb-4 mt-n4"><i class="fa-solid fa-temperature-low"></i></div>
                        <h2 class="fs-4 fw-bold">Temperatura de Equipamentos e Áreas Climatizadas</h2>
                    </div>
                </div>
                </a>
            </div>
        </div>
    </div>
</section>

@stop

@section('js')
    <script src="/js/planilha/home.js"></script>
@stop
