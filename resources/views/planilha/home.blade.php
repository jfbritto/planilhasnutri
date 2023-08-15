@extends('adminlte::page')

@section('meta_tags')
    <link rel="icon" href="/img/building.png" type="image/png">
@stop

@section('title', 'Planilhas')

@section('content_header')
    <h1><i class="fas fa-file"></i> &nbsp;Planilhas</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-header border-0">

        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-md-3">
                    <div class="card" style="width: 18rem;">
                        <img src="https://images.ctfassets.net/lzny33ho1g45/how-to-filter-in-google-sheets-p-img/8e53bc4d79f743320d780744cb60e7a6/file.png?w=1520&fm=jpg&q=30&fit=thumb&h=760" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Troca do Elemento Filtrante</h5>
                            <a href="/planilha/troca-elemento-filtrante" class="btn btn-secondary">Ver planilha</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card" style="width: 18rem;">
                        <img src="https://images.ctfassets.net/lzny33ho1g45/how-to-filter-in-google-sheets-p-img/8e53bc4d79f743320d780744cb60e7a6/file.png?w=1520&fm=jpg&q=30&fit=thumb&h=760" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Higienização dos FIltros e Aparelhos de Climatização</h5>
                            <a href="/planilha/higienizacao-filtro-aparelho-climatizacao" class="btn btn-secondary">Ver planilha</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card" style="width: 18rem;">
                        <img src="https://images.ctfassets.net/lzny33ho1g45/how-to-filter-in-google-sheets-p-img/8e53bc4d79f743320d780744cb60e7a6/file.png?w=1520&fm=jpg&q=30&fit=thumb&h=760" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Controle de Saturacao de Óleos e Gorduras</h5>
                            <a href="/planilha/saturacao-oleo-gordura" class="btn btn-secondary">Ver planilha</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-3"></div>
            </div>

        </div>
    </div>

@stop

@section('js')
    <script src="/js/planilha/home.js"></script>
@stop
