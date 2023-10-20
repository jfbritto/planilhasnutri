// mascara de dinheiro
$('.money').mask('#.##0,00', {reverse: true});
// mascara de cep
$('.zip_code').mask('00000-000');
// mascara de cpf
$('.cpf').mask('000.000.000-00');


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
    const periodo = {'desjejum':'Desjejum','almoco':'Almoço','jantar':'Jantar','ceia':'Ceia'};

    return `${periodo[val]}`

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
    feminino = true
) {
    $.get(window.location.origin + "/parametro/encontrar", {
        id_parameter_type:id
    })
    .then(function (data) {
        if (data.status == "success") {

            Swal.close();
            $(`#${element}`).html(``);

            if(data.data.length > 0){
                if (filtro) {
                    if (feminino) {
                        $(`#${element}`).append(`<option value="">Todas</option>`);
                    } else {
                        $(`#${element}`).append(`<option value="">Todos</option>`);
                    }
                } else {
                    $(`#${element}`).append(`<option value="">-- Selecione --</option>`);
                }

                data.data.forEach(item => {

                    let selected = ``;
                    if (idSelected && idSelected == item.id) {
                        selected = `selected`;
                    }

                    $(`#${element}`).append(`<option ${selected} value="${item.id}">${item.name}</option>`);
                    // $(`#${element}`).select2();
                });
            } else {
                $(`#${element}`).append(`<option>Nenhum item encontrado</option>`);
            }

        } else if (data.status == "error") {
            showError(data.message)
        }
    })
    .catch();
}

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





/**
 * CADASTROS DIVERSOS
 */

function cadastrarPlanilha(
    rota = '',
    funcao,
    objParams
) {
    console.log(rota)
    console.log(objParams)
    let nome_referencia = rota.replace(/-/g, "_");
    console.log(nome_referencia)
    console.log(funcao)

    Swal.queue([
        {
            title: "Carregando...",
            allowOutsideClick: false,
            allowEscapeKey: false,
            onOpen: () => {
                Swal.showLoading();

                $.post(window.location.origin + `/planilha/${rota}/cadastrar`, objParams)
                .then(function (data) {
                    if (data.status == "success") {

                        $(`#formStore${nome_referencia}`).each(function () {
                            this.reset();
                        });

                        $(`#modalStore${nome_referencia}`).modal("hide");

                        showSuccess("Cadastro efetuado!", null, funcao)
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

$("#abrirPDF").click(function(event) {
    event.preventDefault();

    montaUrlPdf();
});

function montaUrlPdf() {

    const formulario = document.getElementById("formFiltroPrincipal");
    const formData = new FormData(formulario);
    const params = new URLSearchParams(formData);
    const url = `${window.location.href}/visualizar?${params.toString()}`;

    window.open(url, '_blank');
}
