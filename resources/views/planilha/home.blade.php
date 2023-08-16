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
        <div class="card-body">

            <div class="row">
                <div class="col-md-3">

                    <div class="card" style="width: 18rem;">
                        <a href="/planilha/troca-elemento-filtrante">
                            <img class="card-img-top" src="https://images.ctfassets.net/lzny33ho1g45/how-to-filter-in-google-sheets-p-img/8e53bc4d79f743320d780744cb60e7a6/file.png?w=1520&fm=jpg&q=30&fit=thumb&h=760" alt="Imagem de capa do card">
                            <div class="card-body">
                                <p class="card-text">Troca do Elemento Filtrante</p>
                            </div>
                        </a>
                    </div>

                </div>
                <div class="col-md-3">

                    <div class="card" style="width: 18rem;">
                        <a href="/planilha/higienizacao-filtro-aparelho-climatizacao">
                            <img class="card-img-top" src="https://images.ctfassets.net/lzny33ho1g45/how-to-filter-in-google-sheets-p-img/8e53bc4d79f743320d780744cb60e7a6/file.png?w=1520&fm=jpg&q=30&fit=thumb&h=760" alt="Imagem de capa do card">
                            <div class="card-body">
                                <p class="card-text">Higienização dos FIltros e Aparelhos de Climatização</p>
                            </div>
                        </a>
                    </div>

                </div>
                <div class="col-md-3">

                    <div class="card" style="width: 18rem;">
                        <a href="/planilha/saturacao-oleo-gordura">
                            <img class="card-img-top" src="https://images.ctfassets.net/lzny33ho1g45/how-to-filter-in-google-sheets-p-img/8e53bc4d79f743320d780744cb60e7a6/file.png?w=1520&fm=jpg&q=30&fit=thumb&h=760" alt="Imagem de capa do card">
                            <div class="card-body">
                                <p class="card-text">Controle de Saturacao de Óleos e Gorduras</p>
                            </div>
                        </a>
                    </div>

                </div>
                <div class="col-md-3">

                    <div class="card" style="width: 18rem;">
                        <a href="/planilha/limpeza-caixa-gordura">
                            <img class="card-img-top" src="https://images.ctfassets.net/lzny33ho1g45/how-to-filter-in-google-sheets-p-img/8e53bc4d79f743320d780744cb60e7a6/file.png?w=1520&fm=jpg&q=30&fit=thumb&h=760" alt="Imagem de capa do card">
                            <div class="card-body">
                                <p class="card-text">Registro de Limpeza de Caixa de Gordura</p>
                            </div>
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>

@stop

@section('js')
    <script src="/js/planilha/home.js"></script>
@stop
