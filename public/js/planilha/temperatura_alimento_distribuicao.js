$(document).ready(function () {

    // Variável para armazenar o cache dos produtos
    var cacheProdutos = null;
    var cacheProdutosSelecionados = null;

    // Variável para armazenar o contator de itens na tela
    var contador = 1;

    loadPrincipal();
    loadGlobalParameters(3, 'id_parameter_responsavel', null, false, true, `modalStoretemperatura_alimento_distribuicao`);
    loadGlobalParameters(11, 'id_parameter_evento', null, false, true, `modalStoretemperatura_alimento_distribuicao`);

    // Carregar filtros
    loadGlobalParameters(11, 'id_parameter_evento_filter', null, true, false);

    // LISTAGEM
    function loadPrincipal()
    {
        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.get(window.location.origin + "/planilha/temperatura-alimento-distribuicao/listar", {
                        data_ini_filter : $("#data_ini_filter").val(),
                        data_fim_filter : $("#data_fim_filter").val(),
                        periodo_filter : $("#periodo_filter option:selected").val(),
                    })
                    .then(function (data) {
                        if (data.status == "success") {

                            Swal.close();
                            $("#list").html(``);

                            if(data.data.length > 0){

                                data.data.forEach(item => {

                                    $("#list").append(`
                                        <tr>
                                            <td class="align-middle">${dateFormat(item.data)}</td>
                                            <td class="align-middle">${periodo(item.periodo)}</td>
                                            <td class="align-middle">${item.evento}</td>
                                            <td class="align-middle">${item.total_produtos}</td>
                                            <td class="align-middle" style="text-align: right; min-width: 120px">
                                                <a title="Imprimir" target="_blank" href="/planilha/temperatura-alimento-distribuicao/visualizar?id_planilha_filter=${item.id}" class="btn btn-primary"><i class="fa-regular fa-file-pdf"></i></a>
                                                <a title="Editar"
                                                data-id="${item.id}"
                                                data-usuario="${item.usuario}"
                                                data-unidade="${item.unidade}"
                                                data-data="${item.data}"
                                                data-periodo="${item.periodo}"
                                                data-id_parameter_evento="${item.id_parameter_evento}"
                                                data-id_parameter_responsavel="${item.id_parameter_responsavel}"
                                                data-acao_corretiva="${item.acao_corretiva}" href="#" class="btn btn-warning edit-temperatura_alimento_distribuicao"><i style="color: white" class="fas fa-edit"></i></a>
                                                <a title="Deletar" data-id="${item.id}" href="#" class="btn btn-danger delete-temperatura_alimento_distribuicao"><i class="fas fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                    `);
                                });

                            }else{

                                $("#list").append(`
                                    <tr>
                                        <td class="align-middle text-center" colspan="5">Nenhum registro encontrado</td>
                                    </tr>
                                `);
                            }

                        } else if (data.status == "error") {
                            showError(data.message)
                        }
                    })
                    .catch(function (data) {
                        if (data.responseJSON.status == "error") {
                            showError(data.responseJSON.message)
                        }
                    });
                },
            },
        ]);
    }

    // CADASTRO
    $("#formStoretemperatura_alimento_distribuicao").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();

                    // Coleta os dados dos campos dinâmicos (produtos e valores)
                    let produtos = document.querySelectorAll(".produto");
                    let primeirasHoras = document.querySelectorAll(".primeiraHora");
                    let primeirasTemperaturas = document.querySelectorAll(".primeiraTemperatura");
                    let segundasHoras = document.querySelectorAll(".segundaHora");
                    let segundasTemperaturas = document.querySelectorAll(".segundaTemperatura");

                    // Armazena os dados em um array de objetos
                    let itens_planilha = [];
                    for (let i = 0; i < produtos.length; i++) {
                        let id_parameter_produto = produtos[i].value;
                        let hora_1 = primeirasHoras[i].value;
                        let temperatura_1 = primeirasTemperaturas[i].value;
                        let hora_2 = segundasHoras[i].value;
                        let temperatura_2 = segundasTemperaturas[i].value;
                        itens_planilha.push({
                            id_parameter_produto: id_parameter_produto,
                            hora_1: hora_1,
                            temperatura_1: temperatura_1,
                            hora_2: hora_2,
                            temperatura_2: temperatura_2
                        });
                    }

                    if (itens_planilha.length === 0) {
                        showError('Informe ao menos um produto!')
                        return false
                    }

                    $.post(window.location.origin + "/planilha/temperatura-alimento-distribuicao/cadastrar", {
                        data: $("#data").val(),
                        periodo: $("#periodo option:selected").val(),
                        id_parameter_evento: $("#id_parameter_evento option:selected").val(),
                        id_parameter_responsavel: $("#id_parameter_responsavel option:selected").val(),
                        acao_corretiva: $("#acao_corretiva").val(),
                        itens_planilha: itens_planilha
                    })
                    .then(function (data) {
                        if (data.status == "success") {

                            $("#formStoretemperatura_alimento_distribuicao").each(function () {
                                this.reset();
                            });

                            $("#modalStoretemperatura_alimento_distribuicao").modal("hide");

                            showSuccess("Cadastro efetuado!", null, loadPrincipal)
                        } else if (data.status == "error") {
                            showError(data.message)
                        }
                    })
                    .catch(function (data) {
                        if (data.responseJSON.status == "error") {
                            showError(data.responseJSON.message)
                        }
                    });

                },
            },
        ]);

    });


    // EDIÇÃO
    $("#list").on("click", ".edit-temperatura_alimento_distribuicao", function(){

        let id = $(this).data('id');
        let usuario = $(this).data('usuario');
        let unidade = $(this).data('unidade');
        let data = $(this).data('data');
        let periodo = $(this).data('periodo');
        let id_parameter_evento = $(this).data('id_parameter_evento');
        let id_parameter_responsavel = $(this).data('id_parameter_responsavel');
        let acao_corretiva = $(this).data('acao_corretiva');

        loadGlobalParameters(3, 'id_parameter_responsavel_edit', id_parameter_responsavel, false, true, `modalEdittemperatura_alimento_distribuicao`);
        loadGlobalParameters(11, 'id_parameter_evento_edit', id_parameter_evento, false, true, `modalEdittemperatura_alimento_distribuicao`);

        preencherItensCadastrados(id)

        $("#id_edit").val(id);
        $("#usuario").val(usuario);
        $("#unidade").val(unidade);
        $("#data_edit").val(data);
        $("#periodo_edit").val(periodo);
        $("#acao_corretiva_edit").val(acao_corretiva);

        $("#modalEdittemperatura_alimento_distribuicao").modal("show");
    });

    $("#formEdittemperatura_alimento_distribuicao").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();

                    // Coleta os dados dos campos dinâmicos (produtos e valores)
                    let produtos = document.querySelectorAll(".produto_edit");
                    let primeirasHoras = document.querySelectorAll(".primeiraHora_edit");
                    let primeirasTemperaturas = document.querySelectorAll(".primeiraTemperatura_edit");
                    let segundasHoras = document.querySelectorAll(".segundaHora_edit");
                    let segundasTemperaturas = document.querySelectorAll(".segundaTemperatura_edit");

                    // Armazena os dados em um array de objetos
                    let itens_planilha = [];
                    for (let i = 0; i < produtos.length; i++) {
                        let id_parameter_produto = produtos[i].value;
                        let hora_1 = primeirasHoras[i].value;
                        let temperatura_1 = primeirasTemperaturas[i].value;
                        let hora_2 = segundasHoras[i].value;
                        let temperatura_2 = segundasTemperaturas[i].value;
                        itens_planilha.push({
                            id_parameter_produto: id_parameter_produto,
                            hora_1: hora_1,
                            temperatura_1: temperatura_1,
                            hora_2: hora_2,
                            temperatura_2: temperatura_2
                        });
                    }

                    if (itens_planilha.length === 0) {
                        showError('Informe ao menos um produto!')
                        return false
                    }

                    $.ajax({
                        url: window.location.origin + "/planilha/temperatura-alimento-distribuicao/editar",
                        type: 'PUT',
                        data:{
                            id: $("#id_edit").val(),
                            data: $("#data_edit").val(),
                            periodo: $("#periodo_edit option:selected").val(),
                            id_parameter_evento: $("#id_parameter_evento_edit option:selected").val(),
                            id_parameter_responsavel: $("#id_parameter_responsavel_edit option:selected").val(),
                            acao_corretiva: $("#acao_corretiva_edit").val(),
                            itens_planilha: itens_planilha
                        }
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formEdittemperatura_alimento_distribuicao").each(function () {
                                    this.reset();
                                });

                                $("#modalEdittemperatura_alimento_distribuicao").modal("hide");

                                showSuccess("Edição efetuada!", null, loadPrincipal)
                            } else if (data.status == "error") {
                                showError(data.message)
                            }
                        })
                        .catch(function (data) {
                            if (data.responseJSON.status == "error") {
                                showError(data.responseJSON.message)
                            }
                        });
                },
            },
        ]);
    });


    // "DELETAR"
    $("#list").on("click", ".delete-temperatura_alimento_distribuicao", function(){

        let id = $(this).data('id');

        Swal.fire({
            title: 'Atenção!',
            text: "Deseja realmente deletar?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Sim',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Não'
            }).then((result) => {
                if (result.value) {

                    Swal.queue([
                        {
                            title: "Carregando...",
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            onOpen: () => {
                                Swal.showLoading();
                                $.ajax({
                                    url: window.location.origin + "/planilha/temperatura-alimento-distribuicao/deletar",
                                    type: 'DELETE',
                                    data: {id}
                                })
                                    .then(function (data) {
                                        if (data.status == "success") {

                                            showSuccess("Deletado com sucesso!", null, loadPrincipal)
                                        } else if (data.status == "error") {
                                            showError(data.message)
                                        }
                                    })
                                    .catch(function (data) {
                                        if (data.responseJSON.status == "error") {
                                            showError(data.responseJSON.message)
                                        }
                                    });
                            },
                        },
                    ]);

                }
            })

    });

    $("#formFiltroPrincipal").change(function (e) {
        e.preventDefault();
        loadPrincipal()
    });

    // ao trocar o select de período faça:
    $("#periodo").change(function () {

        $("#dolly").html("")

        if (this.value) {
            const produtos = preencherTelaComItensAutomaticamente(this.value);
        } else {
            adicionarCamposNaTela()
        }

    });

    async function preencherTelaComItensAutomaticamente(periodo) {

        const objProdutosSelecionados = await buscarProdutosSelecionadosConfig(periodo);

        const produtos = await buscarProdutos();

        $.each(produtos, function(index, produto) {
            $.each(objProdutosSelecionados, function(index, produto_pre_selecionado) {
                // Verifica se os IDs são iguais antes de chamar a função
                if (produto_pre_selecionado.id === produto.id) {
                    adicionarCamposNaTela(true, produto_pre_selecionado);
                }
            });
        });
    }

    // ao abrir o modal
    $("#openModalDistribuicao").click(function(){
        $("#dolly").html("")

        $("#formStoretemperatura_alimento_distribuicao").each(function () {
            this.reset();
        });

        atualizarDataAtual()
        adicionarCamposNaTela()
    })

    // ao clicar no botão de adicionar mais um item
    $("#maisUmItem").click(function(){
        adicionarCamposNaTela()
    })

    // ao clicar no botão de adicionar mais um item no modal de edição
    $("#maisUmItemEdit").click(function(){
        adicionarCamposNaTela(false, null, true)
    })

    // Função para adicionar campos dinâmicos de produto
    async function adicionarCamposNaTela(disabled = false, objProduto = null, modalCadastroEdicao = false) {
        let html = ``;
        const options = await preencherSelectProduto(objProduto);

        let cadastroEdit = modalCadastroEdicao?"_edit":"";

        html = montaHTML(options, disabled, false, null, cadastroEdit);

        if (modalCadastroEdicao) {
            $("#dolly-edit").append(html)
        } else {
            $("#dolly").append(html)
        }
    }

    function montaHTML(options, disabled = false, edicao = false, item = null, complemento_edit = "") {

        contador++

        let h1 = "";
        let t1 = "";
        let h2 = "";
        let t2 = "";

        if (edicao) {
            h1 = item.hora_1 || "";
            t1 = item.temperatura_1 || "";
            h2 = item.hora_2 || "";
            t2 = item.temperatura_2 || "";

        } else {
            // Obtém a hora atual
            let agora = new Date();

            // Obtém a hora e os minutos atuais e formata para o padrão HH:MM
            let horas = agora.getHours().toString().padStart(2, '0'); // adiciona um zero à esquerda, se necessário
            let minutos = agora.getMinutes().toString().padStart(2, '0'); // adiciona um zero à esquerda, se necessário

            // Formata a hora no formato HH:MM
            h1 = horas + ':' + minutos;
        }

        return `
            <div class="alert alert-secondary alert-dismissible fade show" role="alert" id="bloco_${contador}">
                <div class="row">
                    <div class="col-md-4 col-xs-12 col-sm-12 col-12">
                        <div class="form-group">
                            <label for="id_parameter_produto_${contador}">Produto</label>

                            <i class="fa fa-plus-circle color-green botaoAbrirModalStoreParameterProdutoDolly" style="cursor: pointer; ${disabled?"display: none":""}" data-bloco="${contador}" title="Cadastrar novo item"></i>

                            <select type="text" ${disabled?'disabled="true"':''} required name="id_parameter_produto_${contador}" id="id_parameter_produto_${contador}" class="form-control produto${complemento_edit}">${options}</select>
                        </div>
                    </div>
                    <div class="col-md-2 col-xs-6 col-sm-6 col-6">
                        <div class="form-group">
                            <label for="hora_1_${contador}">1º H</label>
                            <input type="time" required name="hora_1_${contador}" id="hora_1_${contador}" class="form-control primeiraHora${complemento_edit}" value="${h1}">
                        </div>
                    </div>
                    <div class="col-md-2 col-xs-6 col-sm-6 col-6">
                        <div class="form-group">
                            <label for="temperatura_1_${contador}">1º Tª</label>
                            <input type="text" required name="temperatura_1_${contador}" id="temperatura_1_${contador}" class="form-control primeiraTemperatura${complemento_edit}" placeholder="Informe a temperatura" value="${t1}">
                        </div>
                    </div>
                    <div class="col-md-2 col-xs-6 col-sm-6 col-6">
                        <div class="form-group">
                            <label for="hora_2_${contador}">2º H</label>
                            <input type="time" name="hora_2_${contador}" id="hora_2_${contador}" class="form-control segundaHora${complemento_edit}" value="${h2}">
                        </div>
                    </div>
                    <div class="col-md-2 col-xs-6 col-sm-6 col-6">
                        <div class="form-group">
                            <label for="temperatura_2_${contador}">2º Tª</label>
                            <input type="text" name="temperatura_2_${contador}" id="temperatura_2_${contador}" class="form-control segundaTemperatura${complemento_edit}" placeholder="Informe a temperatura" value="${t2}">
                        </div>
                    </div>
                </div>
                <button type="button" class="close btn-remover" data-dismiss="alert" aria-label="Close" title="Remover item">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        `;
    }

    // Adiciona um manipulador de eventos para o botão de remoção
    $("#dolly").on("click", ".btn-remover", function() {
        $(this).closest(".row").remove(); // Remove o elemento pai do botão de remoção
    });

    // Função para buscar produtos, com verificação de cache
    function buscarProdutos() {
        return new Promise((resolve, reject) => {
            // Se o cache já foi preenchido, retorna o cache
            if (cacheProdutos !== null) {
                resolve(cacheProdutos);
            } else {
                // Se o cache está vazio, faz a solicitação ao servidor
                $.get(window.location.origin + "/parametro/encontrar", {
                    id_parameter_type: 8
                })
                .then(function (data) {
                    if (data.status === "success") {
                        // Armazena o resultado em cache
                        cacheProdutos = data.data;
                        resolve(cacheProdutos);
                    } else {
                        reject("Nenhum item encontrado");
                    }
                })
                .catch(reject);
            }
        });
    }

    // Preencher o select de produto
    async function preencherSelectProduto(objProduto) {
        try {
            const produtos = await buscarProdutos();
            let options = `<option value="">-- Selecione --</option>`;
            if (produtos.length > 0) {
                produtos.forEach(item => {

                    let selected = ``;
                    if (objProduto && objProduto.id == item.id) {
                        selected = `selected`;
                    }

                    options += `<option ${selected} value="${item.id}">${item.name}</option>`;
                });
            } else {
                options += `<option value="">Nenhum item encontrado</option>`;
            }
            return options;
        } catch (error) {
            return `<option>${error}</option>`;
        }
    }

    async function preencherItensCadastrados(id_planilha) {

        try {
            $("#dolly-edit").html("")
            const produtos = await buscarProdutosDaPlanilha(id_planilha)
            let option = ``;
            if (produtos.length > 0) {
                produtos.forEach(item => {
                    option = `<option value="${item.id_parameter_produto}">${item.produto}</option>`;
                    $("#dolly-edit").append(montaHTML(option, true, true, item, "_edit"))
                });
            }
        } catch (error) {
            console.log(error);
        }
    }

    // Função para buscar produtos já cadastrados na planilha
    function buscarProdutosDaPlanilha(id_planilha) {
        return new Promise((resolve, reject) => {

            $.get(window.location.origin + "/planilha/temperatura-alimento-distribuicao-produto/listar", {
                id_planilha_distribuicao_filter: id_planilha
            })
            .then(function (data) {
                if (data.status === "success") {
                    resolve(data.data);
                } else {
                    reject("Nenhum item encontrado");
                }
            })
            .catch(reject);

        });
    }

    // ao clicar no botão de editar os alimentos padrão
    $("#abrirConfig").click(function(){
        $("#checkbox-list").html("");
        $("#formConfigurarAlimentosPadrao").each(function () {
            this.reset();
        });

        $("#modalConfigurarAlimentosPadrao").modal('show');
    })

    // ao trocar o select de período faça:
    $("#periodo_config").change(function () {

        $("#checkbox-list").html("");
        preencheConfig(this.value);

    });

    // Preencher o select de produto
    async function preencheConfig(periodo) {
        try {
            const produtos = await buscarProdutos();
            const produtos_selecionados = await buscarProdutosSelecionadosConfig(periodo);

            if (produtos.length > 0) {
                // Seletor do elemento onde os checkboxes serão inseridos
                var checkboxList = $("#checkbox-list");

                // Itera sobre o array de objetos e cria checkboxes estilizados
                produtos.forEach(function(item) {
                    var checkboxMarcado = produtos_selecionados.some(function(selecionado) {
                        return selecionado.id === item.id;
                    });

                    var checkbox = `
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="${item.id}" id="checkbox-${item.id}" ${checkboxMarcado ? 'checked' : ''}>
                                <label class="form-check-label" for="checkbox-${item.id}">
                                    ${item.name}
                                </label>
                            </div>
                        </div>
                    `;
                    // Adiciona o checkbox à lista
                    checkboxList.append(checkbox);
                });
            }
        } catch (error) {
            console.log(error);
        }
    }

    // Função para buscar produtos já pré selecionados
    function buscarProdutosSelecionadosConfig(periodo) {
        return new Promise((resolve, reject) => {

            $.get(window.location.origin + "/planilha/temperatura-alimento-distribuicao-config/listar", {
                periodo_filter: periodo
            })
            .then(function (data) {
                if (data.status === "success") {
                    resolve(data.data);
                } else {
                    reject("Nenhum item encontrado");
                }
            })
            .catch(reject);

        });
    }

    // CADASTRO CONFIGURAÇÕES
    $("#formConfigurarAlimentosPadrao").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();

                     // Array para armazenar os IDs dos checkboxes marcados
                    var ids_produtos = [];

                    // Obtém os IDs dos checkboxes marcados
                    $(".form-check-input:checked").each(function() {
                        ids_produtos.push(parseInt($(this).val()));
                    });

                    $.post(window.location.origin + "/planilha/temperatura-alimento-distribuicao-config/cadastrar", {
                        periodo_config: $("#periodo_config option:selected").val(),
                        ids_produtos: ids_produtos
                    })
                    .then(function (data) {
                        if (data.status == "success") {

                            $("#formConfigurarAlimentosPadrao").each(function () {
                                this.reset();
                            });

                            $("#modalConfigurarAlimentosPadrao").modal("hide");

                            showSuccess("Cadastro efetuado!", null, loadPrincipal)
                        } else if (data.status == "error") {
                            showError(data.message)
                        }
                    })
                    .catch(function (data) {
                        if (data.responseJSON.status == "error") {
                            showError(data.responseJSON.message)
                        }
                    });

                },
            },
        ]);

    });
});

$('#dolly').on('input', '.segundaHora', function() {
    // Obtém a nova hora do campo de entrada alterado
    var novaHora = $(this).val();

    // Atualiza a hora em todos os outros campos
    $('.segundaHora').not(this).val(novaHora);
});


$('#dolly-edit').on('input', '.segundaHora_edit', function() {
    // Obtém a nova hora do campo de entrada alterado
    var novaHora = $(this).val();

    // Atualiza a hora em todos os outros campos
    $('.segundaHora_edit').not(this).val(novaHora);
});


$('#dolly').on('click', '.botaoAbrirModalStoreParameterProdutoDolly', function() {
    $("#modalStoreParameterProduto").modal("show");
    let bloco = $(this).data('bloco');
    $("#bloco_auxiliar_produto").val(bloco)
})
