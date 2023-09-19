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

            <div class="card-deck mb-3">
                <div class="card">
                    <a href="/planilha/troca-elemento-filtrante">
                        <img class="card-img-top" src="https://images.ctfassets.net/lzny33ho1g45/how-to-filter-in-google-sheets-p-img/8e53bc4d79f743320d780744cb60e7a6/file.png?w=1520&fm=jpg&q=30&fit=thumb&h=760" alt="Imagem de capa do card">
                    </a>
                    <div class="card-body">
                    <h5 class="card-title">Troca do Elemento Filtrante</h5>
                    {{-- <p class="card-text">Este é um card mais longo com suporte a texto embaixo, que funciona como uma introdução a um conteúdo adicional. Este conteúdo é um pouco maior.</p> --}}
                    {{-- <p class="card-text"><small class="text-muted">Atualizados 3 minutos atrás</small></p> --}}
                    </div>
                </div>
                <div class="card">
                    <a href="/planilha/higienizacao-filtro-aparelho-climatizacao">
                        <img class="card-img-top" src="https://images.ctfassets.net/lzny33ho1g45/how-to-filter-in-google-sheets-p-img/8e53bc4d79f743320d780744cb60e7a6/file.png?w=1520&fm=jpg&q=30&fit=thumb&h=760" alt="Imagem de capa do card">
                    </a>
                    <div class="card-body">
                    <h5 class="card-title">Higienização dos Filtros e Aparelhos de Climatização</h5>
                    {{-- <p class="card-text">Este é um card com suporte a texto embaixo, que funciona como uma introdução a um conteúdo adicional.</p> --}}
                    {{-- <p class="card-text"><small class="text-muted">Atualizados 3 minutos atrás</small></p> --}}
                    </div>
                </div>
                <div class="card">
                    <a href="/planilha/saturacao-oleo-gordura">
                        <img class="card-img-top" src="https://images.ctfassets.net/lzny33ho1g45/how-to-filter-in-google-sheets-p-img/8e53bc4d79f743320d780744cb60e7a6/file.png?w=1520&fm=jpg&q=30&fit=thumb&h=760" alt="Imagem de capa do card">
                    </a>
                    <div class="card-body">
                    <h5 class="card-title">Controle de Saturação de Óleos e Gorduras</h5>
                    {{-- <p class="card-text">Este é um card maior com suporte a texto embaixo, que funciona como uma introdução a um conteúdo adicional. Este card tem o conteúdo ainda maior que o primeiro, para mostrar a altura igual, em ação.</p> --}}
                    {{-- <p class="card-text"><small class="text-muted">Atualizados 3 minutos atrás</small></p> --}}
                    </div>
                </div>
                <div class="card">
                    <a href="/planilha/limpeza-caixa-gordura">
                        <img class="card-img-top" src="https://images.ctfassets.net/lzny33ho1g45/how-to-filter-in-google-sheets-p-img/8e53bc4d79f743320d780744cb60e7a6/file.png?w=1520&fm=jpg&q=30&fit=thumb&h=760" alt="Imagem de capa do card">
                    </a>
                    <div class="card-body">
                    <h5 class="card-title">Registro de Limpeza de Caixa de Gordura</h5>
                    {{-- <p class="card-text">Este é um card maior com suporte a texto embaixo, que funciona como uma introdução a um conteúdo adicional. Este card tem o conteúdo ainda maior que o primeiro, para mostrar a altura igual, em ação.</p> --}}
                    {{-- <p class="card-text"><small class="text-muted">Atualizados 3 minutos atrás</small></p> --}}
                    </div>
                </div>
            </div>
            <div class="card-deck mb-3">
                <div class="card">
                    <a href="/planilha/registro-congelamento">
                        <img class="card-img-top" src="https://images.ctfassets.net/lzny33ho1g45/how-to-filter-in-google-sheets-p-img/8e53bc4d79f743320d780744cb60e7a6/file.png?w=1520&fm=jpg&q=30&fit=thumb&h=760" alt="Imagem de capa do card">
                    </a>
                    <div class="card-body">
                    <h5 class="card-title">Registro de Congelamento</h5>
                    {{-- <p class="card-text">Este é um card maior com suporte a texto embaixo, que funciona como uma introdução a um conteúdo adicional. Este card tem o conteúdo ainda maior que o primeiro, para mostrar a altura igual, em ação.</p> --}}
                    {{-- <p class="card-text"><small class="text-muted">Atualizados 3 minutos atrás</small></p> --}}
                    </div>
                </div>
                <div class="card">
                    <a href="/planilha/verificacao-procedimento-higienizacao-hortifruti">
                        <img class="card-img-top" src="https://images.ctfassets.net/lzny33ho1g45/how-to-filter-in-google-sheets-p-img/8e53bc4d79f743320d780744cb60e7a6/file.png?w=1520&fm=jpg&q=30&fit=thumb&h=760" alt="Imagem de capa do card">
                    </a>
                    <div class="card-body">
                    <h5 class="card-title">Controle de Verificação do Procedimento de Higienização de Hortifrutis</h5>
                    {{-- <p class="card-text">Este é um card maior com suporte a texto embaixo, que funciona como uma introdução a um conteúdo adicional. Este card tem o conteúdo ainda maior que o primeiro, para mostrar a altura igual, em ação.</p> --}}
                    {{-- <p class="card-text"><small class="text-muted">Atualizados 3 minutos atrás</small></p> --}}
                    </div>
                </div>
                <div class="card">
                    <a href="/planilha/manutencao-calibracao-equipamento">
                        <img class="card-img-top" src="https://images.ctfassets.net/lzny33ho1g45/how-to-filter-in-google-sheets-p-img/8e53bc4d79f743320d780744cb60e7a6/file.png?w=1520&fm=jpg&q=30&fit=thumb&h=760" alt="Imagem de capa do card">
                    </a>
                    <div class="card-body">
                    <h5 class="card-title">Relatório de Manutenção e calibrações dos equipamentos</h5>
                    {{-- <p class="card-text">Este é um card maior com suporte a texto embaixo, que funciona como uma introdução a um conteúdo adicional. Este card tem o conteúdo ainda maior que o primeiro, para mostrar a altura igual, em ação.</p> --}}
                    {{-- <p class="card-text"><small class="text-muted">Atualizados 3 minutos atrás</small></p> --}}
                    </div>
                </div>
                <div class="card">
                    <a href="/planilha/registro-limpeza">
                        <img class="card-img-top" src="https://images.ctfassets.net/lzny33ho1g45/how-to-filter-in-google-sheets-p-img/8e53bc4d79f743320d780744cb60e7a6/file.png?w=1520&fm=jpg&q=30&fit=thumb&h=760" alt="Imagem de capa do card">
                    </a>
                    <div class="card-body">
                    <h5 class="card-title">Registro de Limpeza</h5>
                    {{-- <p class="card-text">Este é um card maior com suporte a texto embaixo, que funciona como uma introdução a um conteúdo adicional. Este card tem o conteúdo ainda maior que o primeiro, para mostrar a altura igual, em ação.</p> --}}
                    {{-- <p class="card-text"><small class="text-muted">Atualizados 3 minutos atrás</small></p> --}}
                    </div>
                </div>
            </div>
            <div class="card-deck mb-3">
                <div class="card">
                    <a href="/planilha/recebimento-materia-prima">
                        <img class="card-img-top" src="https://images.ctfassets.net/lzny33ho1g45/how-to-filter-in-google-sheets-p-img/8e53bc4d79f743320d780744cb60e7a6/file.png?w=1520&fm=jpg&q=30&fit=thumb&h=760" alt="Imagem de capa do card">
                    </a>
                    <div class="card-body">
                    <h5 class="card-title">Controle de Recebimento de Matéria Prima</h5>
                    {{-- <p class="card-text">Este é um card maior com suporte a texto embaixo, que funciona como uma introdução a um conteúdo adicional. Este card tem o conteúdo ainda maior que o primeiro, para mostrar a altura igual, em ação.</p> --}}
                    {{-- <p class="card-text"><small class="text-muted">Atualizados 3 minutos atrás</small></p> --}}
                    </div>
                </div>
                <div class="card">
                    <a href="/planilha/resfriamento-rapido-alimento">
                        <img class="card-img-top" src="https://images.ctfassets.net/lzny33ho1g45/how-to-filter-in-google-sheets-p-img/8e53bc4d79f743320d780744cb60e7a6/file.png?w=1520&fm=jpg&q=30&fit=thumb&h=760" alt="Imagem de capa do card">
                    </a>
                    <div class="card-body">
                    <h5 class="card-title">Controle de Resfriamento Rápido de Alimentos</h5>
                    {{-- <p class="card-text">Este é um card maior com suporte a texto embaixo, que funciona como uma introdução a um conteúdo adicional. Este card tem o conteúdo ainda maior que o primeiro, para mostrar a altura igual, em ação.</p> --}}
                    {{-- <p class="card-text"><small class="text-muted">Atualizados 3 minutos atrás</small></p> --}}
                    </div>
                </div>
                <div class="card">
                    <a href="/planilha/reaquecimento-alimento">
                        <img class="card-img-top" src="https://images.ctfassets.net/lzny33ho1g45/how-to-filter-in-google-sheets-p-img/8e53bc4d79f743320d780744cb60e7a6/file.png?w=1520&fm=jpg&q=30&fit=thumb&h=760" alt="Imagem de capa do card">
                    </a>
                    <div class="card-body">
                    <h5 class="card-title">Controle de Reaquecimento dos Alimentos</h5>
                    {{-- <p class="card-text">Este é um card maior com suporte a texto embaixo, que funciona como uma introdução a um conteúdo adicional. Este card tem o conteúdo ainda maior que o primeiro, para mostrar a altura igual, em ação.</p> --}}
                    {{-- <p class="card-text"><small class="text-muted">Atualizados 3 minutos atrás</small></p> --}}
                    </div>
                </div>
                <div class="card">
                    <a href="/planilha/registro-nao-conformidade-detectada-auto-avaliacao">
                        <img class="card-img-top" src="https://images.ctfassets.net/lzny33ho1g45/how-to-filter-in-google-sheets-p-img/8e53bc4d79f743320d780744cb60e7a6/file.png?w=1520&fm=jpg&q=30&fit=thumb&h=760" alt="Imagem de capa do card">
                    </a>
                    <div class="card-body">
                    <h5 class="card-title">Registro de Não Conformidades Detectadas da Auto Avaliação</h5>
                    {{-- <p class="card-text">Este é um card maior com suporte a texto embaixo, que funciona como uma introdução a um conteúdo adicional. Este card tem o conteúdo ainda maior que o primeiro, para mostrar a altura igual, em ação.</p> --}}
                    {{-- <p class="card-text"><small class="text-muted">Atualizados 3 minutos atrás</small></p> --}}
                    </div>
                </div>
            </div>
            <div class="card-deck mb-3">
                <div class="card">
                    <a href="/planilha/temperatura-alimento-banho-maria">
                        <img class="card-img-top" src="https://images.ctfassets.net/lzny33ho1g45/how-to-filter-in-google-sheets-p-img/8e53bc4d79f743320d780744cb60e7a6/file.png?w=1520&fm=jpg&q=30&fit=thumb&h=760" alt="Imagem de capa do card">
                    </a>
                    <div class="card-body">
                    <h5 class="card-title">Controle de Temperatura dos Alimentos no Banho-Maria</h5>
                    {{-- <p class="card-text">Este é um card maior com suporte a texto embaixo, que funciona como uma introdução a um conteúdo adicional. Este card tem o conteúdo ainda maior que o primeiro, para mostrar a altura igual, em ação.</p> --}}
                    {{-- <p class="card-text"><small class="text-muted">Atualizados 3 minutos atrás</small></p> --}}
                    </div>
                </div>
                <div class="card">
                    <a href="/planilha/temperatura-alimento-distribuicao">
                        <img class="card-img-top" src="https://images.ctfassets.net/lzny33ho1g45/how-to-filter-in-google-sheets-p-img/8e53bc4d79f743320d780744cb60e7a6/file.png?w=1520&fm=jpg&q=30&fit=thumb&h=760" alt="Imagem de capa do card">
                    </a>
                    <div class="card-body">
                    <h5 class="card-title">Controle de Temperatura dos Alimentos na Distribuição</h5>
                    {{-- <p class="card-text">Este é um card maior com suporte a texto embaixo, que funciona como uma introdução a um conteúdo adicional. Este card tem o conteúdo ainda maior que o primeiro, para mostrar a altura igual, em ação.</p> --}}
                    {{-- <p class="card-text"><small class="text-muted">Atualizados 3 minutos atrás</small></p> --}}
                    </div>
                </div>
                <div class="card">
                    <a href="/planilha/grupo-amostra-prato">
                        <img class="card-img-top" src="https://images.ctfassets.net/lzny33ho1g45/how-to-filter-in-google-sheets-p-img/8e53bc4d79f743320d780744cb60e7a6/file.png?w=1520&fm=jpg&q=30&fit=thumb&h=760" alt="Imagem de capa do card">
                    </a>
                    <div class="card-body">
                    <h5 class="card-title">Registro de Grupo de Amostras de Pratos</h5>
                    {{-- <p class="card-text">Este é um card maior com suporte a texto embaixo, que funciona como uma introdução a um conteúdo adicional. Este card tem o conteúdo ainda maior que o primeiro, para mostrar a altura igual, em ação.</p> --}}
                    {{-- <p class="card-text"><small class="text-muted">Atualizados 3 minutos atrás</small></p> --}}
                    </div>
                </div>
                <div class="card">

                </div>
            </div>

        </div>
    </div>

@stop

@section('js')
    <script src="/js/planilha/home.js"></script>
@stop
