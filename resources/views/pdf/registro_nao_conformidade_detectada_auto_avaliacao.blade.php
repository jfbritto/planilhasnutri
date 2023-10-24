<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$titulo}}</title>
    <style>
        @font-face {
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 400;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/roboto/v30/KFOmCnqEu92Fr1Mu72xKOzY.woff2) format('woff2');
            unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
        }
        /* Estilos para a tabela */
        html {
            font-family: 'Roboto', sans-serif; /* Aplicando a fonte Roboto à tabela */
        }
        .table {
            width: 100%;
            max-width: 100%;
            margin-bottom: 1rem;
            background-color: transparent;
            border-collapse: collapse;
            font-size: 12px;
        }

        .table-bordered {
            border: 1px solid #dee2e6;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05);
        }

        .table-hover tbody tr:hover {
            background-color: rgba(0, 0, 0, 0.075);
        }

        /* Estilos para as células de cabeçalho */
        .table th,
        .table td {
            padding: 0.5rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }

        /* Estilos para a primeira coluna */
        .table th:first-child,
        .table td:first-child {
            border-left: 1px solid #dee2e6;
        }

        /* Estilos para a última coluna */
        .table th:last-child,
        .table td:last-child {
            border-right: 1px solid #dee2e6;
        }

        /* Estilo para o cabeçalho da tabela (th) */
        .table th {
            background-color: #666668; /* Cinza mais escuro */
            color: #fff; /* Texto branco */
        }

        .container-fluid {
            margin-top: -20px
        }

        .header {
            text-align: center;
            color: #666668;
        }

        .header img {
            float: left; /* Faz a imagem flutuar à esquerda */
        }

        .header h1 {
            margin: 0; /* Remove margens do título para evitar espaços extras */
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="header">
            <img src="img/louvre.jpeg" alt="" width="150px">
            <h2>{{$titulo}}</h2>
        </div>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Não Conformidade</th>
                    <th>Possíveis Causas</th>
                    <th>Tratamento do Produto</th>
                    <th>Ação corretiva para evitar novas ocorrências</th>
                    <th>Responsável</th>
                </tr>
            </thead>
            <tbody>
                @foreach($itens as $item)
                    <tr>
                        <td style="vertical-align: middle">{{ \Carbon\Carbon::parse($item->data)->format('d/m/Y') }}</td>
                        <td style="vertical-align: middle">{{ $item->nao_conformidade }}</td>
                        <td style="vertical-align: middle">{{ $item->possiveis_causas }}</td>
                        <td style="vertical-align: middle">{{ $item->tratamento_produto }}</td>
                        <td style="vertical-align: middle">{{ $item->acoes_corretivas }}</td>
                        <td style="vertical-align: middle">{{ $item->responsavel }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>


