<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="/img/building.png" type="image/png">
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
            margin-top: -20px;
            margin-left: -10px;
            margin-right: -10px;
        }

        .header h2 {
            margin: 5px; /* Remove margens do título para evitar espaços extras */
            font-weight: bold
        }

        hr {
            height: 1px; /* Defina a altura desejada */
            background-color: #ccc; /* Defina a cor da linha */
            border: none; /* Remova a borda para torná-la uma linha sólida */
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <table class="table table-bordered" style="margin-bottom: 7px; color: #666668;">
            <tr>
                <td style="vertical-align: middle; text-align: center;">
                    <img src="img/louvre.jpeg" alt="" width="150px"><hr><span style="font-weight: bold; margin-top: 0.5rem">{{auth()->user()->unit->name}}</span>
                </td>
                <td style="vertical-align: middle; font-weight: bold; text-align: center;">
                    Ano: {{date('Y')}}
                    <hr style="">
                    Mês: {{date('m')}}
                </td>
                <td style="vertical-align: middle; text-align: center; font-weight: bold; font-size: 1.5rem">
                    {{$titulo}}
                </td>
                <td style="vertical-align: middle; text-align: center; font-weight: bold">
                    REG 001
                    <hr style="">
                    Criado em nov/2018<br>
                    Revisado em:  02/2024
                </td>
            </tr>
        </table>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th style="vertical-align: middle">Data</th>
                    <th style="vertical-align: middle">Produto</th>
                    <th style="vertical-align: middle">Fornecedor</th>
                    <th style="vertical-align: middle">N. Fiscal</th>
                    <th style="vertical-align: middle">SIF</th>
                    <th style="vertical-align: middle">Lote</th>
                    <th style="vertical-align: middle">Validade</th>
                    <th style="vertical-align: middle">Alimento (ºC)</th>
                    <th style="vertical-align: middle">Veículo (ºC)</th>
                    <th style="vertical-align: middle">Não Conformidade</th>
                    <th style="vertical-align: middle">Ação Corretiva</th>
                    <th style="vertical-align: middle">Responsável</th>
                </tr>
            </thead>
            <tbody>
                @foreach($itens as $item)
                    <tr>
                        <td style="vertical-align: middle">{{ \Carbon\Carbon::parse($item->data)->format('d/m/Y') }}</td>
                        <td style="vertical-align: middle">{{ $item->produto }}</td>
                        <td style="vertical-align: middle">{{ $item->fornecedor }}</td>
                        <td style="vertical-align: middle">{{ $item->nota_fiscal }}</td>
                        <td style="vertical-align: middle">{{ $item->sif_lote }}</td>
                        <td style="vertical-align: middle">{{ $item->lote }}</td>
                        <td style="vertical-align: middle">{{ \Carbon\Carbon::parse($item->data_validade)->format('d/m/Y') }}</td>
                        <td style="vertical-align: middle">{{ $item->temperatura_alimento }}</td>
                        <td style="vertical-align: middle">{{ $item->temperatura_veiculo }}</td>
                        <td style="vertical-align: middle">{{ $item->nao_conformidade }}</td>
                        <td style="vertical-align: middle">{{ $item->acao_corretiva }}</td>
                        <td style="vertical-align: middle">{{ $item->responsavel }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>


