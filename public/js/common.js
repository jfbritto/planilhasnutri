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

// LISTAR PARAMETROS
function loadGlobalParameters(id, element, idSelected = null)
{
    $.get(window.location.origin + "/parametro/encontrar", {
        id_parameter_type:id
    })
    .then(function (data) {
        if (data.status == "success") {

            Swal.close();
            $(`#${element}`).html(``);

            if(data.data.length > 0){
                $(`#${element}`).append(`<option>-- Selecione --</option>`);
                data.data.forEach(item => {

                    let selected = ``;
                    if (idSelected && idSelected == item.id) {
                        selected = `selected`;
                    }

                    $(`#${element}`).append(`<option ${selected} value="${item.id}">${item.name}</option>`);
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
