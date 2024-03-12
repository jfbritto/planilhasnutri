// mascara de dinheiro
$('.money').mask('#.##0,00', {reverse: true});
// mascara de cep
$('.zip_code').mask('00000-000');
// mascara de cpf
$('.cpf').mask('000.000.000-00');

// mascara de porcentagem
$('.percent').on('input', function(event) {
    var inputValue = $(this).val();

    // Remove caracteres não permitidos (exceto números, vírgula, ponto e sinal de menos)
    var sanitizedValue = inputValue.replace(/[^0-9,\.\-]/g, '');

    // Atualiza o valor do campo com os caracteres permitidos
    $(this).val(sanitizedValue);
});

atualizarDataAtual()
function atualizarDataAtual(dataParametro) {
    let dataParaAtualizar = dataParametro ? new Date(dataParametro) : new Date();
    let dataFormatada = dataParaAtualizar.toISOString().slice(0, 10);

    let inputDate = document.getElementById("data");
    if (inputDate != null) {
        inputDate.value = dataFormatada;
    }

    let dataCongelamento = document.getElementById("data_congelamento");
    if (dataCongelamento != null) {
        dataCongelamento.value = dataFormatada;
    }

    let dataCalibracao = document.getElementById("data_calibracao");
    if (dataCalibracao != null) {
        dataCalibracao.value = dataFormatada;
    }
}



// retorna o nome do dia da semana pelo seu numero referente enviado
function weekDayDescription(val)
{
    const week_day_description = {1:'Segunda',2:'Terça',3:'Quarta',4:'Quinta',5:'Sexta',6:'Sábado',7:'Domingo'};

    if(val > 0 && val < 8){
        return `${week_day_description[val]}`
    }else{
        return `Dia não identificado`
    }
}

// retorna o nome do status do equipamento
function descricaoStatusEquipamento(val, color = false)
{
    const descricao = {1:'Desligado',2:'Limpeza',3:'Manutenção'};
    const cores = {1:'danger',2:'info',3:'warning'};

    if(val > 0 && val < 4){

        if (color) {
            return `table-${cores[val]}`
        } else {
            return `${descricao[val]}`
        }

    }else{
        return `Status não identificado`
    }
}

function detectarExtensaoArquivo(nomeArquivo) {
    // Dividir o nome do arquivo usando o ponto como separador
    var partes = nomeArquivo.split('.');
    // Obter a última parte (a extensão)
    var extensao = partes[partes.length - 1];

    if (extensao == 'pdf') {
        return 'pdf'
    } else if (extensao == 'xls') {
        return 'excel'
    } else if (extensao == 'png' || extensao == 'jpg' || extensao == 'jpeg') {
        return 'image'
    }

    return 'file';
}

// retorna a cor da classe de acordo com a temperatura
function configTemperaturaEquipamento(maiorQueTxt, menorQueTxt, temperaturaTxt, texto = false)
{
    let classe = 'danger'
    let descricao = ''
    let maiorQue = null;
    let menorQue = null;
    let temperatura = null;

    if (maiorQueTxt != null)
        maiorQue = parseFloat(maiorQueTxt.replace(',', '.'));

    if (menorQueTxt != null)
        menorQue = parseFloat(menorQueTxt.replace(',', '.'));

    if (temperaturaTxt != null)
        temperatura = parseFloat(temperaturaTxt.replace(',', '.'));

    if (maiorQue !== null && menorQue !== null) {
        descricao = `Deve estar entre ${maiorQue}ºC e ${menorQue}ºC`

        if (temperatura >= maiorQue && temperatura <= menorQue) {
            classe = 'success'
        }
    } else if (maiorQue !== null && menorQue === null) {
        descricao = `Deve ser maior que ${maiorQue}ºC`

        if (temperatura >= maiorQue) {
            classe = 'success'
        }
    } else if (maiorQue === null && menorQue !== null) {
        descricao = `Deve ser menor que ${menorQue}ºC`

        if (temperatura <= menorQue) {
            classe = 'success'
        }
    }

    if (texto) {
        return descricao
    }

    return classe
}

// retorna o nome do mes pelo seu numero referente enviado
function monthDescription(val)
{
    const month_description = {1:'Janeiro',2:'Fevereiro',3:'Março',4:'Abril',5:'Maio',6:'Junho',7:'Julho',8:'Agosto',9:'Setembro',10:'Outubro',11:'Novembro',12:'Dezembro'};

    if(val > 0 && val <= 12){
        return `${month_description[val]}`
    }else{
        return `Mês não identificado`
    }
}

// retorna o nome do mes pelo seu numero referente enviado
function periodo(val)
{
    const periodo = {'desjejum':'Desjejum','cafe':'Café da manhã','almoco':'Almoço','jantar':'Jantar','ceia':'Ceia'};

    return `${periodo[val]}`

}

// retorna o nome da frequencia
function frequencia(val)
{
    const frequencia = {'1':'Mensal','2':'Bimestral','3':'Trimestral','6':'Semestral','12':'Anual','60':'5 anos'};

    return `${frequencia[val]}`

}

// mascara de telefone
var SPMaskBehavior = function (val) {
    return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
},
spOptions = {
onKeyPress: function(val, e, field, options) {
    field.mask(SPMaskBehavior.apply({}, arguments), options);
    }
};
$('.phone').mask(SPMaskBehavior, spOptions);

// mascara de dinheiro em reais
function moneyFormat(money)
{
    let cash = parseFloat(money).toFixed(2).toString().replace('.', ',')

    if(cash.length >= 7 && cash.length <= 9){
        return `${cash.substr(0, (cash.length-6))}.${cash.substr(-6, 7)}`;
    }else if(cash.length > 9){
        return `${cash.substr(0, (cash.length-9))}.${cash.substr((cash.length-9), (cash.length-7))}.${cash.substr(-6, 7)}`;
    }else{
        return `${cash}`;
    }
}

// formata a data com hora e minuto
function dateFormatFull(date)
{
    if(date == null || date == undefined || date == ''){
        return '';
    }else{

        const dt = date.split(' ');

        const dia = dt[0].split('-')[2];
        const mes = dt[0].split('-')[1];
        const ano = dt[0].split('-')[0];
        const hora = dt[1].split(':')[0];
        const min = dt[1].split(':')[1];

        return `${dia}/${mes}/${ano} ${hora}:${min}`;
    }
}

// formata a data em dia, mes e ano
function dateFormat(date)
{
    if(date == null || date == undefined || date == ''){
        return '';
    }else{

        const dt = date.split(' ');

        const dia = dt[0].split('-')[2];
        const mes = dt[0].split('-')[1];
        const ano = dt[0].split('-')[0];

        return `${dia}/${mes}/${ano}`;
    }
}

// Retorna sim ou não
function simNao(param)
{
    return param==1?'Sim':'Não';
}

// automatização de funções do sweet alert 2
function showError(text = "Ocorreu um erro!")
{
    Swal.fire({ type: 'error', text: text, showConfirmButton: true })
}

function showWarning(text = "Atenção!")
{
    Swal.fire({ type: 'warning', text: text, showConfirmButton: true })
}

function showSuccess(title = null, text = null, functions = null, param = null)
{
    if(functions){
        if(title && text == null)
            Swal.fire({ type: 'success', title: title, showConfirmButton: false, timer: 1000, onClose: () => { functions(param); } })
        else if(title && text)
            Swal.fire({ type: 'success', title: title, text: text, showConfirmButton: false, timer: 1000, onClose: () => { functions(param); } })
    }else{
        if(title && text == null)
            Swal.fire({ type: 'success', title: title, showConfirmButton: false, timer: 1000 })
        else if(title && text)
            Swal.fire({ type: 'success', title: title, text: text, showConfirmButton: false, timer: 1000 })
    }

}

/**
 * Carregar o select na tela
 *
 * @param {int} id
 * @param {*} element
 * @param {*} idSelected
 * @param {*} filtro
 * @param {*} feminino
 */
function loadGlobalParameters(
    id,
    element,
    idSelected = null,
    filtro = false,
    feminino = true,
    idModal = null,
    elementoPai = ``
) {
    $.get(window.location.origin + "/parametro/encontrar", {
        id_parameter_type:id
    })
    .then(function (data) {
        if (data.status == "success") {

            Swal.close();
            $(`${elementoPai} #${element}`).html(``);

            if(data.data.length > 0){
                if (filtro) {
                    if (feminino) {
                        $(`${elementoPai} #${element}`).append(`<option value="">Todas</option>`);
                    } else {
                        $(`${elementoPai} #${element}`).append(`<option value="">Todos</option>`);
                    }
                } else {
                    $(`${elementoPai} #${element}`).append(`<option value="">-- Selecione --</option>`);
                }

                data.data.forEach(item => {

                    let selected = ``;
                    if (idSelected && idSelected == item.id) {
                        selected = `selected`;
                    }

                    $(`${elementoPai} #${element}`).append(`<option ${selected} value="${item.id}">${item.name}</option>`);
                });

                $(`${elementoPai} #${element}`).select2({
                    dropdownParent: idModal ? $(`#${idModal}`) : null
                });
            } else {
                $(`${elementoPai} #${element}`).append(`<option value="">Nenhum item encontrado</option>`);
            }

        } else if (data.status == "error") {
            showError(data.message)
        }
    })
    .catch();
}

$(document).on('select2:open', () => {

    document.querySelector('.select2-container--open .select2-search__field').focus()

});

// LISTAR/CADASTRAR PARAMETRO
$("#editarSenha").on("click", function(){

    Swal.fire({
        title: 'Defina sua nova senha',
        input: 'password',
        inputAttributes: {
          autocapitalize: 'off'
        },
        showCancelButton: true,
        confirmButtonText: 'Salvar',
        showLoaderOnConfirm: true,
        preConfirm: (password) => {
            $.ajax({
                url: window.location.origin + "/usuario/editar-senha",
                type: 'PUT',
                data:{password}
            })
            .then(function (data) {
                if (data.status == "success") {
                    showSuccess("Edição efetuada!")
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
        allowOutsideClick: () => !Swal.isLoading()
      }).then((result) => {

      })

});

function dataTable(table) {
    setTimeout(() => {
        $(`#${table}`).DataTable( {
            language: {
                url: 'http://cdn.datatables.net/plug-ins/1.13.4/i18n/pt-BR.json'
            }
        } );
    }, 100);
}

/**
 * Preenche o campo com a diferença de meses informada
 *
 * @param {string} campo1
 * @param {string} campo2
 * @param {int} meses_add
 */
function preencherProximaData(campo1, campo2, meses_add = 6) {
    // Obtém o valor da data inicial
    let data_inicial = $(`#${campo1}`).val();

    // Verifica se a data inicial é válida
    if (data_inicial) {
        // Adiciona x meses à data inicial usando o jQuery
        let data_final = new Date(data_inicial);
        data_final.setMonth(data_final.getMonth() + meses_add);

        // Formata a data final para o formato "yyyy-MM-dd"
        let ano = data_final.getFullYear();
        let mes = ("0" + (data_final.getMonth() + 1)).slice(-2);
        let dia = ("0" + data_final.getDate()).slice(-2);
        let data_final_formatada = ano + "-" + mes + "-" + dia;

        // Define a data final no campo de entrada de data final usando jQuery
        $(`#${campo2}`).val(data_final_formatada);
    }
}

function colocarHoraAtual(campo) {
    // Obtém a hora atual
    var currentTime = new Date();
    var hours = currentTime.getHours();
    var minutes = currentTime.getMinutes();

    // Formata a hora no formato HH:mm
    var formattedTime = (hours < 10 ? '0' : '') + hours + ':' + (minutes < 10 ? '0' : '') + minutes;

    // Define o valor do campo de input de tempo
    $(`#${campo}`).val(formattedTime);
}

$("#abrirPDF").click(function(event) {
    event.preventDefault();

    montaUrlPdf();
});

function montaUrlPdf() {

    const formulario = document.getElementById("formFiltroPrincipal");
    const formData = new FormData(formulario);
    const params = new URLSearchParams(formData);
    let path_formatado = window.location.href.replace("#","");
    const url = `${path_formatado}/visualizar?${params.toString()}`;

    window.open(url, '_blank');
}

$("#list").on("click", ".abrirHistorico", function(){

    let id = $(this).data('id');
    let id_planilha = $(this).data('id_planilha');

    let itens = ``;

    $.get(window.location.origin + "/historico/listar", {
        id_planilha_registro_filter:id,
        id_planilha_filter:id_planilha
    })
    .then(function (data) {
        if (data.status == "success") {

            if(data.data.length > 0){
                data.data.forEach(item => {
                    itens += `<li class="list-group-item">${dateFormatFull(item.data)} | ${item.acao}</li>`;
                });
            } else {
                itens += `<li class="list-group-item">Nenhum registro encontrado</li>`
            }

            $("#list-historico").html("")

            let html = `
                <ul class="list-group list-group-flush">
                    ${itens}
                </ul>
            `

            $("#list-historico").append(html)

            $("#modalHistorico").modal("show")

        } else if (data.status == "error") {
            showError(data.message)
        }
    })
    .catch();

});

// -------------------------------------------------------- FORMS --------------------------------------------------------

// CADASTRAR RESPONSAVEL
$("#formStoreParameterResponsavel").submit(function (e) {
    e.preventDefault();

    Swal.queue([
        {
            title: "Carregando...",
            allowOutsideClick: false,
            allowEscapeKey: false,
            onOpen: () => {
                Swal.showLoading();

                $.post(window.location.origin + "/parametro/cadastrar", {
                    name: $("#name_parameter_responsavel").val(),
                    id_parameter_type: 3,
                })
                    .then(function (data) {
                        if (data.status == "success") {

                            $("#formStoreParameterResponsavel").each(function () {
                                this.reset();
                            });

                            $("#modalStoreParameterResponsavel").modal("hide");

                            let selected = null;
                            if (data.data.data.id != undefined) {
                                selected = data.data.data.id;
                            }

                            loadGlobalParameters(3, 'id_parameter_responsavel', selected);

                            showSuccess("Cadastro efetuado!", null)
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

// CADASTRAR AREA
$("#formStoreParameterArea").submit(function (e) {
    e.preventDefault();

    Swal.queue([
        {
            title: "Carregando...",
            allowOutsideClick: false,
            allowEscapeKey: false,
            onOpen: () => {
                Swal.showLoading();

                $.post(window.location.origin + "/parametro/cadastrar", {
                    name: $("#name_parameter_area").val(),
                    id_parameter_type: 1,
                })
                    .then(function (data) {
                        if (data.status == "success") {

                            $("#formStoreParameterArea").each(function () {
                                this.reset();
                            });

                            $("#modalStoreParameterArea").modal("hide");

                            let selected = null;
                            if (data.data.data.id != undefined) {
                                selected = data.data.data.id;
                            }

                            loadGlobalParameters(1, 'id_parameter_area', selected);

                            showSuccess("Cadastro efetuado!", null)
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

// CADASTRAR FILTRO
$("#formStoreParameterFiltro").submit(function (e) {
    e.preventDefault();

    Swal.queue([
        {
            title: "Carregando...",
            allowOutsideClick: false,
            allowEscapeKey: false,
            onOpen: () => {
                Swal.showLoading();

                $.post(window.location.origin + "/parametro/cadastrar", {
                    name: $("#name_parameter_filtro").val(),
                    id_parameter_type: 2,
                })
                    .then(function (data) {
                        if (data.status == "success") {

                            $("#formStoreParameterFiltro").each(function () {
                                this.reset();
                            });

                            $("#modalStoreParameterFiltro").modal("hide");

                            let selected = null;
                            if (data.data.data.id != undefined) {
                                selected = data.data.data.id;
                            }

                            loadGlobalParameters(2, 'id_parameter_filtro', selected);

                            showSuccess("Cadastro efetuado!", null)
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

// CADASTRAR FORNECEDOR
$("#formStoreParameterFornecedor").submit(function (e) {
    e.preventDefault();

    Swal.queue([
        {
            title: "Carregando...",
            allowOutsideClick: false,
            allowEscapeKey: false,
            onOpen: () => {
                Swal.showLoading();

                $.post(window.location.origin + "/parametro/cadastrar", {
                    name: $("#name_parameter_fornecedor").val(),
                    id_parameter_type: 10,
                })
                    .then(function (data) {
                        if (data.status == "success") {

                            $("#formStoreParameterFornecedor").each(function () {
                                this.reset();
                            });

                            $("#modalStoreParameterFornecedor").modal("hide");

                            let selected = null;
                            if (data.data.data.id != undefined) {
                                selected = data.data.data.id;
                            }

                            loadGlobalParameters(10, 'id_parameter_fornecedor', selected);

                            showSuccess("Cadastro efetuado!", null)
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

// CADASTRAR PRODUTO
$("#formStoreParameterProduto").submit(function (e) {
    e.preventDefault();

    Swal.queue([
        {
            title: "Carregando...",
            allowOutsideClick: false,
            allowEscapeKey: false,
            onOpen: () => {
                Swal.showLoading();

                $.post(window.location.origin + "/parametro/cadastrar", {
                    name: $("#name_parameter_produto").val(),
                    id_parameter_type: 8,
                })
                    .then(function (data) {
                        if (data.status == "success") {

                            let bloco = $("#bloco_auxiliar_produto").val()

                            $("#formStoreParameterProduto").each(function () {
                                this.reset();
                            });

                            $("#modalStoreParameterProduto").modal("hide");

                            let selected = null;
                            if (data.data.data.id != undefined) {
                                selected = data.data.data.id;
                            }

                            let elemento = `id_parameter_produto`;
                            let elementoPai = ``
                            if (bloco != ``) {
                                elementoPai = `#bloco_${bloco}`;
                                elemento = `id_parameter_produto_${bloco}`;
                            }

                            loadGlobalParameters(8, elemento, selected, false, true, `modalStoreParameterProduto`, elementoPai);

                            showSuccess("Cadastro efetuado!", null)
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

// CADASTRAR EQUIPAMENTO
$("#formStoreParameterEquipamento").submit(function (e) {
    e.preventDefault();

    Swal.queue([
        {
            title: "Carregando...",
            allowOutsideClick: false,
            allowEscapeKey: false,
            onOpen: () => {
                Swal.showLoading();

                $.post(window.location.origin + "/parametro/cadastrar", {
                    name: $("#name_parameter_equipamento").val(),
                    id_parameter_type: 4,
                })
                    .then(function (data) {
                        if (data.status == "success") {

                            $("#formStoreParameterEquipamento").each(function () {
                                this.reset();
                            });

                            $("#modalStoreParameterEquipamento").modal("hide");

                            let selected = null;
                            if (data.data.data.id != undefined) {
                                selected = data.data.data.id;
                            }

                            loadGlobalParameters(4, 'id_parameter_equipamento', selected);

                            showSuccess("Cadastro efetuado!", null)
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

// CADASTRAR CAIXA DE GORDURA
$("#formStoreParameterCaixaGordura").submit(function (e) {
    e.preventDefault();

    Swal.queue([
        {
            title: "Carregando...",
            allowOutsideClick: false,
            allowEscapeKey: false,
            onOpen: () => {
                Swal.showLoading();

                $.post(window.location.origin + "/parametro/cadastrar", {
                    name: $("#name_parameter_caixa_gordura").val(),
                    id_parameter_type: 6,
                })
                    .then(function (data) {
                        if (data.status == "success") {

                            $("#formStoreParameterCaixaGordura").each(function () {
                                this.reset();
                            });

                            $("#modalStoreParameterCaixaGordura").modal("hide");

                            let selected = null;
                            if (data.data.data.id != undefined) {
                                selected = data.data.data.id;
                            }

                            loadGlobalParameters(6, 'id_parameter_caixa_gordura', selected);

                            showSuccess("Cadastro efetuado!", null)
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

// CADASTRAR ALERGENO
$("#formStoreParameterAlergeno").submit(function (e) {
    e.preventDefault();

    Swal.queue([
        {
            title: "Carregando...",
            allowOutsideClick: false,
            allowEscapeKey: false,
            onOpen: () => {
                Swal.showLoading();

                $.post(window.location.origin + "/parametro/cadastrar", {
                    name: $("#name_parameter_alergeno").val(),
                    id_parameter_type: 5,
                })
                    .then(function (data) {
                        if (data.status == "success") {

                            $("#formStoreParameterAlergeno").each(function () {
                                this.reset();
                            });

                            $("#modalStoreParameterAlergeno").modal("hide");

                            let selected = null;
                            if (data.data.data.id != undefined) {
                                selected = data.data.data.id;
                            }

                            loadGlobalParameters(5, 'id_parameter_alergeno', selected);

                            showSuccess("Cadastro efetuado!", null)
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

// CADASTRAR ALIMENTO
$("#formStoreParameterAlimento").submit(function (e) {
    e.preventDefault();

    Swal.queue([
        {
            title: "Carregando...",
            allowOutsideClick: false,
            allowEscapeKey: false,
            onOpen: () => {
                Swal.showLoading();

                $.post(window.location.origin + "/parametro/cadastrar", {
                    name: $("#name_parameter_alimento").val(),
                    id_parameter_type: 9,
                })
                    .then(function (data) {
                        if (data.status == "success") {

                            $("#formStoreParameterAlimento").each(function () {
                                this.reset();
                            });

                            $("#modalStoreParameterAlimento").modal("hide");

                            let selected = null;
                            if (data.data.data.id != undefined) {
                                selected = data.data.data.id;
                            }

                            loadGlobalParameters(9, 'id_parameter_alimento', selected);

                            showSuccess("Cadastro efetuado!", null)
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

// CADASTRAR EVENTO
$("#formStoreParameterEvento").submit(function (e) {
    e.preventDefault();

    Swal.queue([
        {
            title: "Carregando...",
            allowOutsideClick: false,
            allowEscapeKey: false,
            onOpen: () => {
                Swal.showLoading();

                $.post(window.location.origin + "/parametro/cadastrar", {
                    name: $("#name_parameter_evento").val(),
                    id_parameter_type: 11,
                })
                    .then(function (data) {
                        if (data.status == "success") {

                            $("#formStoreParameterEvento").each(function () {
                                this.reset();
                            });

                            $("#modalStoreParameterEvento").modal("hide");

                            let selected = null;
                            if (data.data.data.id != undefined) {
                                selected = data.data.data.id;
                            }

                            loadGlobalParameters(11, 'id_parameter_evento', selected);

                            showSuccess("Cadastro efetuado!", null)
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

// CADASTRAR PRAGA
$("#formStoreParameterPraga").submit(function (e) {
    e.preventDefault();

    Swal.queue([
        {
            title: "Carregando...",
            allowOutsideClick: false,
            allowEscapeKey: false,
            onOpen: () => {
                Swal.showLoading();

                $.post(window.location.origin + "/parametro/cadastrar", {
                    name: $("#name_parameter_praga").val(),
                    id_parameter_type: 12,
                })
                    .then(function (data) {
                        if (data.status == "success") {

                            $("#formStoreParameterPraga").each(function () {
                                this.reset();
                            });

                            $("#modalStoreParameterPraga").modal("hide");

                            let selected = null;
                            if (data.data.data.id != undefined) {
                                selected = data.data.data.id;
                            }

                            loadGlobalParameters(12, 'id_parameter_praga', selected);

                            showSuccess("Cadastro efetuado!", null)
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

// CADASTRAR FABRICANTE
$("#formStoreParameterFabricante").submit(function (e) {
    e.preventDefault();

    Swal.queue([
        {
            title: "Carregando...",
            allowOutsideClick: false,
            allowEscapeKey: false,
            onOpen: () => {
                Swal.showLoading();

                $.post(window.location.origin + "/parametro/cadastrar", {
                    name: $("#name_parameter_fabricante").val(),
                    id_parameter_type: 13,
                })
                    .then(function (data) {
                        if (data.status == "success") {

                            $("#formStoreParameterFabricante").each(function () {
                                this.reset();
                            });

                            $("#modalStoreParameterFabricante").modal("hide");

                            let selected = null;
                            if (data.data.data.id != undefined) {
                                selected = data.data.data.id;
                            }

                            loadGlobalParameters(13, 'id_parameter_fabricante', selected);

                            showSuccess("Cadastro efetuado!", null)
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

// CADASTRAR SERVICO
$("#formStoreParameterServico").submit(function (e) {
    e.preventDefault();

    Swal.queue([
        {
            title: "Carregando...",
            allowOutsideClick: false,
            allowEscapeKey: false,
            onOpen: () => {
                Swal.showLoading();

                $.post(window.location.origin + "/parametro/cadastrar", {
                    name: $("#name_parameter_servico").val(),
                    id_parameter_type: 7,
                })
                    .then(function (data) {
                        if (data.status == "success") {

                            $("#formStoreParameterServico").each(function () {
                                this.reset();
                            });

                            $("#modalStoreParameterServico").modal("hide");

                            let selected = null;
                            if (data.data.data.id != undefined) {
                                selected = data.data.data.id;
                            }

                            loadGlobalParameters(13, 'id_parameter_servico', selected);

                            showSuccess("Cadastro efetuado!", null)
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
