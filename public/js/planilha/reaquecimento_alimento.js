$(document).ready(function () {

    loadPrincipal();
    loadGlobalParameters(8, 'id_parameter_produto', null, false, true, `modalStorereaquecimento_alimento`);
    loadGlobalParameters(3, 'id_parameter_responsavel', null, false, true, `modalStorereaquecimento_alimento`);

    // Carregar filtros
    loadGlobalParameters(8, 'id_parameter_produto_filter', null, true, false);

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
                    $.get(window.location.origin + "/planilha/reaquecimento-alimento/listar", {
                        data_ini_filter : $("#data_ini_filter").val(),
                        data_fim_filter : $("#data_fim_filter").val(),
                        id_parameter_produto_filter : $("#id_parameter_produto_filter option:selected").val(),
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
                                            <td class="align-middle" style="text-align: right; min-width: 120px">
                                                <a title="Histórico" data-id="${item.id}" data-id_planilha="${item.id_planilha}" href="#" class="btn btn-info abrirHistorico"><i style="color: white" class="fas fa-clock"></i></a>
                                                <a title="Editar"
                                                data-id="${item.id}"
                                                data-usuario="${item.usuario}"
                                                data-unidade="${item.unidade}"
                                                data-data="${item.data}"
                                                data-id_parameter_produto="${item.id_parameter_produto}"
                                                data-hora_temperatura_antes="${item.hora_temperatura_antes}"
                                                data-temperatura_antes="${item.temperatura_antes}"
                                                data-hora_temperatura_depois="${item.hora_temperatura_depois}"
                                                data-temperatura_depois="${item.temperatura_depois}"
                                                data-tempo_aquecimento="${item.tempo_aquecimento}"
                                                data-conforme_naoconforme="${item.conforme_naoconforme}"
                                                data-id_parameter_responsavel="${item.id_parameter_responsavel}" href="#" class="btn btn-warning edit-reaquecimento_alimento"><i style="color: white" class="fas fa-edit"></i></a>
                                                <a title="Deletar" data-id="${item.id}" href="#" class="btn btn-danger delete-reaquecimento_alimento"><i class="fas fa-trash-alt"></i></a>
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
    $("#formStorereaquecimento_alimento").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();

                    $.post(window.location.origin + "/planilha/reaquecimento-alimento/cadastrar", {
                        data: $("#data").val(),
                        id_parameter_produto: $("#id_parameter_produto option:selected").val(),
                        hora_temperatura_antes: $("#hora_temperatura_antes").val(),
                        temperatura_antes: $("#temperatura_antes").val(),
                        hora_temperatura_depois: $("#hora_temperatura_depois").val(),
                        temperatura_depois: $("#temperatura_depois").val(),
                        tempo_aquecimento: $("#tempo_aquecimento").val(),
                        conforme_naoconforme: $("#conforme_naoconforme").val(),
                        id_parameter_responsavel: $("#id_parameter_responsavel option:selected").val(),
                    })
                    .then(function (data) {
                        if (data.status == "success") {

                            $("#formStorereaquecimento_alimento").each(function () {
                                this.reset();
                            });

                            $("#modalStorereaquecimento_alimento").modal("hide");

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
    $("#list").on("click", ".edit-reaquecimento_alimento", function(){

        let id = $(this).data('id');
        let usuario = $(this).data('usuario');
        let unidade = $(this).data('unidade');
        let data = $(this).data('data');
        let id_parameter_produto = $(this).data('id_parameter_produto');
        let hora_temperatura_antes = $(this).data('hora_temperatura_antes');
        let temperatura_antes = $(this).data('temperatura_antes');
        let hora_temperatura_depois = $(this).data('hora_temperatura_depois');
        let temperatura_depois = $(this).data('temperatura_depois');
        let tempo_aquecimento = $(this).data('tempo_aquecimento');
        let conforme_naoconforme = $(this).data('conforme_naoconforme');
        let id_parameter_responsavel = $(this).data('id_parameter_responsavel');

        loadGlobalParameters(8, 'id_parameter_produto_edit', id_parameter_produto, false, true, `modalEditreaquecimento_alimento`);
        loadGlobalParameters(3, 'id_parameter_responsavel_edit', id_parameter_responsavel, false, true, `modalEditreaquecimento_alimento`);

        $("#id_edit").val(id);
        $("#usuario").val(usuario);
        $("#unidade").val(unidade);
        $("#data_edit").val(data);
        $("#hora_temperatura_antes_edit").val(hora_temperatura_antes);
        $("#temperatura_antes_edit").val(temperatura_antes);
        $("#hora_temperatura_depois_edit").val(hora_temperatura_depois);
        $("#temperatura_depois_edit").val(temperatura_depois);
        $("#tempo_aquecimento_edit").val(tempo_aquecimento);
        $("#conforme_naoconforme_edit").val(conforme_naoconforme);

        $("#modalEditreaquecimento_alimento").modal("show");
    });

    $("#formEditreaquecimento_alimento").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.ajax({
                        url: window.location.origin + "/planilha/reaquecimento-alimento/editar",
                        type: 'PUT',
                        data:{
                            id: $("#id_edit").val(),
                            data: $("#data_edit").val(),
                            id_parameter_produto: $("#id_parameter_produto_edit option:selected").val(),
                            hora_temperatura_antes: $("#hora_temperatura_antes_edit").val(),
                            temperatura_antes: $("#temperatura_antes_edit").val(),
                            hora_temperatura_depois: $("#hora_temperatura_depois_edit").val(),
                            temperatura_depois: $("#temperatura_depois_edit").val(),
                            tempo_aquecimento: $("#tempo_aquecimento_edit").val(),
                            conforme_naoconforme: $("#conforme_naoconforme_edit").val(),
                            id_parameter_responsavel: $("#id_parameter_responsavel_edit option:selected").val(),
                        }
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formEditreaquecimento_alimento").each(function () {
                                    this.reset();
                                });

                                $("#modalEditreaquecimento_alimento").modal("hide");

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
    $("#list").on("click", ".delete-reaquecimento_alimento", function(){

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
                                    url: window.location.origin + "/planilha/reaquecimento-alimento/deletar",
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

});
