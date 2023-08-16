$(document).ready(function () {

    loadverificacao_procedimento_higienizacao_hortifruti();
    loadGlobalParameters(9, 'id_parameter_alimento');
    loadGlobalParameters(3, 'id_parameter_responsavel');

    // LISTAGEM
    function loadverificacao_procedimento_higienizacao_hortifruti()
    {
        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.get(window.location.origin + "/planilha/verificacao-procedimento-higienizacao-hortifruti/listar", {

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
                                            <td class="align-middle">${item.alimento}</td>
                                            <td class="align-middle">${item.hora_imersao_inicio}</td>
                                            <td class="align-middle">${item.hora_imersao_fim}</td>
                                            <td class="align-middle">${item.concentracao_solucao_clorada}</td>
                                            <td class="align-middle">${item.responsavel}</td>
                                            <td class="align-middle" style="text-align: right">
                                                <a title="Editar"
                                                data-id="${item.id}"
                                                data-usuario="${item.usuario}"
                                                data-unidade="${item.unidade}"
                                                data-data="${item.data}"
                                                data-id_parameter_alimento="${item.id_parameter_alimento}"
                                                data-hora_imersao_inicio="${item.hora_imersao_inicio}"
                                                data-hora_imersao_fim="${item.hora_imersao_fim}"
                                                data-concentracao_solucao_clorada="${item.concentracao_solucao_clorada}"
                                                data-acao_corretiva="${item.acao_corretiva}"
                                                data-id_parameter_responsavel="${item.id_parameter_responsavel}" href="#" class="btn btn-warning edit-verificacao_procedimento_higienizacao_hortifruti"><i style="color: white" class="fas fa-edit"></i></a>
                                                <a title="Deletar" data-id="${item.id}" href="#" class="btn btn-danger delete-verificacao_procedimento_higienizacao_hortifruti"><i class="fas fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                    `);
                                });

                            }else{

                                $("#list").append(`
                                    <tr>
                                        <td class="align-middle text-center" colspan="7">Nenhum registro encontrado</td>
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
    $("#formStoreverificacao_procedimento_higienizacao_hortifruti").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();

                    $.post(window.location.origin + "/planilha/verificacao-procedimento-higienizacao-hortifruti/cadastrar", {
                        data: $("#data").val(),
                        id_parameter_alimento: $("#id_parameter_alimento option:selected").val(),
                        hora_imersao_inicio: $("#hora_imersao_inicio").val(),
                        hora_imersao_fim: $("#hora_imersao_fim").val(),
                        concentracao_solucao_clorada: $("#concentracao_solucao_clorada").val(),
                        acao_corretiva: $("#acao_corretiva").val(),
                        id_parameter_responsavel: $("#id_parameter_responsavel option:selected").val(),
                    })
                    .then(function (data) {
                        if (data.status == "success") {

                            $("#formStoreverificacao_procedimento_higienizacao_hortifruti").each(function () {
                                this.reset();
                            });

                            $("#modalStoreverificacao_procedimento_higienizacao_hortifruti").modal("hide");

                            showSuccess("Cadastro efetuado!", null, loadverificacao_procedimento_higienizacao_hortifruti)
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
    $("#list").on("click", ".edit-verificacao_procedimento_higienizacao_hortifruti", function(){

        let id = $(this).data('id');
        let usuario = $(this).data('usuario');
        let unidade = $(this).data('unidade');
        let data = $(this).data('data');
        let id_parameter_alimento = $(this).data('id_parameter_alimento');
        let hora_imersao_inicio = $(this).data('hora_imersao_inicio');
        let hora_imersao_fim = $(this).data('hora_imersao_fim');
        let concentracao_solucao_clorada = $(this).data('concentracao_solucao_clorada');
        let acao_corretiva = $(this).data('acao_corretiva');
        let id_parameter_responsavel = $(this).data('id_parameter_responsavel');

        loadGlobalParameters(9, 'id_parameter_alimento_edit', id_parameter_alimento);
        loadGlobalParameters(3, 'id_parameter_responsavel_edit', id_parameter_responsavel);

        $("#id_edit").val(id);
        $("#usuario").val(usuario);
        $("#unidade").val(unidade);
        $("#data_edit").val(data);
        $("#hora_imersao_inicio_edit").val(hora_imersao_inicio);
        $("#hora_imersao_fim_edit").val(hora_imersao_fim);
        $("#concentracao_solucao_clorada_edit").val(concentracao_solucao_clorada);
        $("#acao_corretiva_edit").val(acao_corretiva);

        $("#modalEditverificacao_procedimento_higienizacao_hortifruti").modal("show");
    });

    $("#formEditverificacao_procedimento_higienizacao_hortifruti").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.ajax({
                        url: window.location.origin + "/planilha/verificacao-procedimento-higienizacao-hortifruti/editar",
                        type: 'PUT',
                        data:{
                            id: $("#id_edit").val(),
                            data: $("#data_edit").val(),
                            id_parameter_alimento: $("#id_parameter_alimento_edit option:selected").val(),
                            hora_imersao_inicio: $("#hora_imersao_inicio_edit").val(),
                            hora_imersao_fim: $("#hora_imersao_fim_edit").val(),
                            concentracao_solucao_clorada: $("#concentracao_solucao_clorada_edit").val(),
                            acao_corretiva: $("#acao_corretiva_edit").val(),
                            id_parameter_responsavel: $("#id_parameter_responsavel_edit option:selected").val(),
                        }
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formEditverificacao_procedimento_higienizacao_hortifruti").each(function () {
                                    this.reset();
                                });

                                $("#modalEditverificacao_procedimento_higienizacao_hortifruti").modal("hide");

                                showSuccess("Edição efetuada!", null, loadverificacao_procedimento_higienizacao_hortifruti)
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
    $("#list").on("click", ".delete-verificacao_procedimento_higienizacao_hortifruti", function(){

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
                                    url: window.location.origin + "/planilha/verificacao-procedimento-higienizacao-hortifruti/deletar",
                                    type: 'DELETE',
                                    data: {id}
                                })
                                    .then(function (data) {
                                        if (data.status == "success") {

                                            showSuccess("Deletado com sucesso!", null, loadverificacao_procedimento_higienizacao_hortifruti)
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

});
