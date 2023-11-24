$(document).ready(function () {

    loadPrincipal();
    loadGlobalParameters(3, 'id_parameter_responsavel', null, false, true, `modalStoreregistro_nao_conformidade_detectada_auto_avaliacao`);

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
                    $.get(window.location.origin + "/planilha/registro-nao-conformidade-detectada-auto-avaliacao/listar", {
                        data_ini_filter : $("#data_ini_filter").val(),
                        data_fim_filter : $("#data_fim_filter").val(),
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
                                            <td class="align-middle">${item.nao_conformidade}</td>
                                            <td class="align-middle">${item.possiveis_causas}</td>
                                            <td class="align-middle">${item.tratamento_produto}</td>
                                            <td class="align-middle">${item.acoes_corretivas}</td>
                                            <td class="align-middle" style="text-align: right; min-width: 120px">
                                                <a title="Histórico" data-id="${item.id}" data-id_planilha="${item.id_planilha}" href="#" class="btn btn-info abrirHistorico"><i style="color: white" class="fas fa-clock"></i></a>
                                                <a title="Editar"
                                                data-id="${item.id}"
                                                data-usuario="${item.usuario}"
                                                data-unidade="${item.unidade}"
                                                data-data="${item.data}"
                                                data-nao_conformidade="${item.nao_conformidade}"
                                                data-possiveis_causas="${item.possiveis_causas}"
                                                data-tratamento_produto="${item.tratamento_produto}"
                                                data-acoes_corretivas="${item.acoes_corretivas}"
                                                data-id_parameter_responsavel="${item.id_parameter_responsavel}" href="#" class="btn btn-warning edit-registro_nao_conformidade_detectada_auto_avaliacao"><i style="color: white" class="fas fa-edit"></i></a>
                                                <a title="Deletar" data-id="${item.id}" href="#" class="btn btn-danger delete-registro_nao_conformidade_detectada_auto_avaliacao"><i class="fas fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                    `);
                                });

                            }else{

                                $("#list").append(`
                                    <tr>
                                        <td class="align-middle text-center" colspan="6">Nenhum registro encontrado</td>
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
    $("#formStoreregistro_nao_conformidade_detectada_auto_avaliacao").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();

                    $.post(window.location.origin + "/planilha/registro-nao-conformidade-detectada-auto-avaliacao/cadastrar", {
                        data: $("#data").val(),
                        nao_conformidade: $("#nao_conformidade").val(),
                        possiveis_causas: $("#possiveis_causas").val(),
                        tratamento_produto: $("#tratamento_produto").val(),
                        acoes_corretivas: $("#acoes_corretivas").val(),
                        id_parameter_responsavel: $("#id_parameter_responsavel option:selected").val(),
                    })
                    .then(function (data) {
                        if (data.status == "success") {

                            $("#formStoreregistro_nao_conformidade_detectada_auto_avaliacao").each(function () {
                                this.reset();
                            });

                            $("#modalStoreregistro_nao_conformidade_detectada_auto_avaliacao").modal("hide");

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
    $("#list").on("click", ".edit-registro_nao_conformidade_detectada_auto_avaliacao", function(){

        let id = $(this).data('id');
        let usuario = $(this).data('usuario');
        let unidade = $(this).data('unidade');
        let data = $(this).data('data');
        let nao_conformidade = $(this).data('nao_conformidade');
        let possiveis_causas = $(this).data('possiveis_causas');
        let tratamento_produto = $(this).data('tratamento_produto');
        let acoes_corretivas = $(this).data('acoes_corretivas');
        let id_parameter_responsavel = $(this).data('id_parameter_responsavel');

        loadGlobalParameters(3, 'id_parameter_responsavel_edit', id_parameter_responsavel, false, true, `modalEditregistro_nao_conformidade_detectada_auto_avaliacao`);

        $("#id_edit").val(id);
        $("#usuario").val(usuario);
        $("#unidade").val(unidade);
        $("#data_edit").val(data);
        $("#nao_conformidade_edit").val(nao_conformidade);
        $("#possiveis_causas_edit").val(possiveis_causas);
        $("#tratamento_produto_edit").val(tratamento_produto);
        $("#acoes_corretivas_edit").val(acoes_corretivas);

        $("#modalEditregistro_nao_conformidade_detectada_auto_avaliacao").modal("show");
    });

    $("#formEditregistro_nao_conformidade_detectada_auto_avaliacao").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.ajax({
                        url: window.location.origin + "/planilha/registro-nao-conformidade-detectada-auto-avaliacao/editar",
                        type: 'PUT',
                        data:{
                            id: $("#id_edit").val(),
                            data: $("#data_edit").val(),
                            nao_conformidade: $("#nao_conformidade_edit").val(),
                            possiveis_causas: $("#possiveis_causas_edit").val(),
                            tratamento_produto: $("#tratamento_produto_edit").val(),
                            acoes_corretivas: $("#acoes_corretivas_edit").val(),
                            id_parameter_responsavel: $("#id_parameter_responsavel_edit option:selected").val(),
                        }
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formEditregistro_nao_conformidade_detectada_auto_avaliacao").each(function () {
                                    this.reset();
                                });

                                $("#modalEditregistro_nao_conformidade_detectada_auto_avaliacao").modal("hide");

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
    $("#list").on("click", ".delete-registro_nao_conformidade_detectada_auto_avaliacao", function(){

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
                                    url: window.location.origin + "/planilha/registro-nao-conformidade-detectada-auto-avaliacao/deletar",
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
