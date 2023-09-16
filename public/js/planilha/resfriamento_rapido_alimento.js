$(document).ready(function () {

    loadresfriamento_rapido_alimento();
    loadGlobalParameters(8, 'id_parameter_produto');
    loadGlobalParameters(3, 'id_parameter_responsavel');

    // LISTAGEM
    function loadresfriamento_rapido_alimento()
    {
        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.get(window.location.origin + "/planilha/resfriamento-rapido-alimento/listar", {

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
                                            <td class="align-middle">${item.produto}</td>
                                            <td class="align-middle">${item.responsavel}</td>
                                            <td class="align-middle">${item.conforme_naoconforme==1?'Sim':'Não'}</td>
                                            <td class="align-middle" style="text-align: right">
                                                <a title="Editar"
                                                data-id="${item.id}"
                                                data-usuario="${item.usuario}"
                                                data-unidade="${item.unidade}"
                                                data-data="${item.data}"
                                                data-id_parameter_produto="${item.id_parameter_produto}"
                                                data-cozimento_hora_final="${item.cozimento_hora_final}"
                                                data-cozimento_temperatura_interna="${item.cozimento_temperatura_interna}"
                                                data-resfriamento_hora_inicio="${item.resfriamento_hora_inicio}"
                                                data-resfriamento_temperatura_central_inicio="${item.resfriamento_temperatura_central_inicio}"
                                                data-resfriamento_hora_fim="${item.resfriamento_hora_fim}"
                                                data-resfriamento_temperatura_central_fim="${item.resfriamento_temperatura_central_fim}"
                                                data-conforme_naoconforme="${item.conforme_naoconforme}"
                                                data-id_parameter_responsavel="${item.id_parameter_responsavel}" href="#" class="btn btn-warning edit-resfriamento_rapido_alimento"><i style="color: white" class="fas fa-edit"></i></a>
                                                <a title="Deletar" data-id="${item.id}" href="#" class="btn btn-danger delete-resfriamento_rapido_alimento"><i class="fas fa-trash-alt"></i></a>
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
    $("#formStoreresfriamento_rapido_alimento").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();

                    $.post(window.location.origin + "/planilha/resfriamento-rapido-alimento/cadastrar", {
                        data: $("#data").val(),
                        id_parameter_produto: $("#id_parameter_produto option:selected").val(),
                        cozimento_hora_final: $("#cozimento_hora_final").val(),
                        cozimento_temperatura_interna: $("#cozimento_temperatura_interna").val(),
                        resfriamento_hora_inicio: $("#resfriamento_hora_inicio").val(),
                        resfriamento_temperatura_central_inicio: $("#resfriamento_temperatura_central_inicio").val(),
                        resfriamento_hora_fim: $("#resfriamento_hora_fim").val(),
                        resfriamento_temperatura_central_fim: $("#resfriamento_temperatura_central_fim").val(),
                        conforme_naoconforme: $("#conforme_naoconforme").val(),
                        id_parameter_responsavel: $("#id_parameter_responsavel option:selected").val(),
                    })
                    .then(function (data) {
                        if (data.status == "success") {

                            $("#formStoreresfriamento_rapido_alimento").each(function () {
                                this.reset();
                            });

                            $("#modalStoreresfriamento_rapido_alimento").modal("hide");

                            showSuccess("Cadastro efetuado!", null, loadresfriamento_rapido_alimento)
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
    $("#list").on("click", ".edit-resfriamento_rapido_alimento", function(){

        let id = $(this).data('id');
        let usuario = $(this).data('usuario');
        let unidade = $(this).data('unidade');
        let data = $(this).data('data');
        let id_parameter_produto = $(this).data('id_parameter_produto');
        let cozimento_hora_final = $(this).data('cozimento_hora_final');
        let cozimento_temperatura_interna = $(this).data('cozimento_temperatura_interna');
        let resfriamento_hora_inicio = $(this).data('resfriamento_hora_inicio');
        let resfriamento_temperatura_central_inicio = $(this).data('resfriamento_temperatura_central_inicio');
        let resfriamento_hora_fim = $(this).data('resfriamento_hora_fim');
        let resfriamento_temperatura_central_fim = $(this).data('resfriamento_temperatura_central_fim');
        let conforme_naoconforme = $(this).data('conforme_naoconforme');
        let id_parameter_responsavel = $(this).data('id_parameter_responsavel');

        loadGlobalParameters(8, 'id_parameter_produto_edit', id_parameter_produto);
        loadGlobalParameters(3, 'id_parameter_responsavel_edit', id_parameter_responsavel);

        $("#id_edit").val(id);
        $("#usuario").val(usuario);
        $("#unidade").val(unidade);
        $("#data_edit").val(data);
        $("#cozimento_hora_final_edit").val(cozimento_hora_final);
        $("#cozimento_temperatura_interna_edit").val(cozimento_temperatura_interna);
        $("#resfriamento_hora_inicio_edit").val(resfriamento_hora_inicio);
        $("#resfriamento_temperatura_central_inicio_edit").val(resfriamento_temperatura_central_inicio);
        $("#resfriamento_hora_fim_edit").val(resfriamento_hora_fim);
        $("#resfriamento_temperatura_central_fim_edit").val(resfriamento_temperatura_central_fim);
        $("#conforme_naoconforme_edit").val(conforme_naoconforme);

        $("#modalEditresfriamento_rapido_alimento").modal("show");
    });

    $("#formEditresfriamento_rapido_alimento").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.ajax({
                        url: window.location.origin + "/planilha/resfriamento-rapido-alimento/editar",
                        type: 'PUT',
                        data:{
                            id: $("#id_edit").val(),
                            data: $("#data_edit").val(),
                            id_parameter_produto: $("#id_parameter_produto_edit option:selected").val(),
                            cozimento_hora_final: $("#cozimento_hora_final_edit").val(),
                            cozimento_temperatura_interna: $("#cozimento_temperatura_interna_edit").val(),
                            resfriamento_hora_inicio: $("#resfriamento_hora_inicio_edit").val(),
                            resfriamento_temperatura_central_inicio: $("#resfriamento_temperatura_central_inicio_edit").val(),
                            resfriamento_hora_fim: $("#resfriamento_hora_fim_edit").val(),
                            resfriamento_temperatura_central_fim: $("#resfriamento_temperatura_central_fim_edit").val(),
                            conforme_naoconforme: $("#conforme_naoconforme_edit").val(),
                            id_parameter_responsavel: $("#id_parameter_responsavel_edit option:selected").val(),
                        }
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formEditresfriamento_rapido_alimento").each(function () {
                                    this.reset();
                                });

                                $("#modalEditresfriamento_rapido_alimento").modal("hide");

                                showSuccess("Edição efetuada!", null, loadresfriamento_rapido_alimento)
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
    $("#list").on("click", ".delete-resfriamento_rapido_alimento", function(){

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
                                    url: window.location.origin + "/planilha/resfriamento-rapido-alimento/deletar",
                                    type: 'DELETE',
                                    data: {id}
                                })
                                    .then(function (data) {
                                        if (data.status == "success") {

                                            showSuccess("Deletado com sucesso!", null, loadresfriamento_rapido_alimento)
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
