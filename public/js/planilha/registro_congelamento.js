$(document).ready(function () {

    loadPrincipal();
    loadGlobalParameters(8, 'id_parameter_produto', null, false, true, `modalStoreregistro_congelamento`);
    loadGlobalParameters(5, 'id_parameter_alergeno', null, false, true, `modalStoreregistro_congelamento`);

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
                    $.get(window.location.origin + "/planilha/registro-congelamento/listar", {
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
                                            <td class="align-middle">${dateFormat(item.data_congelamento)}</td>
                                            <td class="align-middle">${item.produto}</td>
                                            <td class="align-middle">${dateFormat(item.data_recebimento)}</td>
                                            <td class="align-middle">${item.alergeno}</td>
                                            <td class="align-middle" style="text-align: right; min-width: 120px">
                                                <a title="Editar"
                                                data-id="${item.id}"
                                                data-usuario="${item.usuario}"
                                                data-unidade="${item.unidade}"
                                                data-data_congelamento="${item.data_congelamento}"
                                                data-id_parameter_produto="${item.id_parameter_produto}"
                                                data-quantidade="${item.quantidade}"
                                                data-data_recebimento="${item.data_recebimento}"
                                                data-data_fabricacao="${item.data_fabricacao}"
                                                data-id_parameter_alergeno="${item.id_parameter_alergeno}" href="#" class="btn btn-warning edit-registro_congelamento"><i style="color: white" class="fas fa-edit"></i></a>
                                                <a title="Deletar" data-id="${item.id}" href="#" class="btn btn-danger delete-registro_congelamento"><i class="fas fa-trash-alt"></i></a>
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
    $("#formStoreregistro_congelamento").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();

                    $.post(window.location.origin + "/planilha/registro-congelamento/cadastrar", {
                        data_congelamento: $("#data_congelamento").val(),
                        id_parameter_produto: $("#id_parameter_produto option:selected").val(),
                        quantidade: $("#quantidade").val(),
                        data_recebimento: $("#data_recebimento").val(),
                        data_fabricacao: $("#data_fabricacao").val(),
                        id_parameter_alergeno: $("#id_parameter_alergeno option:selected").val(),
                    })
                    .then(function (data) {
                        if (data.status == "success") {

                            $("#formStoreregistro_congelamento").each(function () {
                                this.reset();
                            });
                            $(".selecao-customizada").val(null).trigger("change");

                            atualizarDataAtual()

                            if (!$("#checkCadastrarOutro").prop("checked")) {
                                $("#modalStoreregistro_congelamento").modal("hide");
                            }

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
    $("#list").on("click", ".edit-registro_congelamento", function(){

        let id = $(this).data('id');
        let usuario = $(this).data('usuario');
        let unidade = $(this).data('unidade');
        let data_congelamento = $(this).data('data_congelamento');
        let id_parameter_produto = $(this).data('id_parameter_produto');
        let quantidade = $(this).data('quantidade');
        let data_recebimento = $(this).data('data_recebimento');
        let data_fabricacao = $(this).data('data_fabricacao');
        let id_parameter_alergeno = $(this).data('id_parameter_alergeno');

        loadGlobalParameters(8, 'id_parameter_produto_edit', id_parameter_produto, false, true, `modalEditregistro_congelamento`);
        loadGlobalParameters(5, 'id_parameter_alergeno_edit', id_parameter_alergeno, false, true, `modalEditregistro_congelamento`);

        $("#id_edit").val(id);
        $("#usuario").val(usuario);
        $("#unidade").val(unidade);
        $("#data_congelamento_edit").val(data_congelamento);
        $("#quantidade_edit").val(quantidade);
        $("#data_recebimento_edit").val(data_recebimento);
        $("#data_fabricacao_edit").val(data_fabricacao);
        $("#id_parameter_alergeno_edit").val(id_parameter_alergeno);

        $("#modalEditregistro_congelamento").modal("show");
    });

    $("#formEditregistro_congelamento").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.ajax({
                        url: window.location.origin + "/planilha/registro-congelamento/editar",
                        type: 'PUT',
                        data:{
                            id: $("#id_edit").val(),
                            data_congelamento: $("#data_congelamento_edit").val(),
                            id_parameter_produto: $("#id_parameter_produto_edit option:selected").val(),
                            quantidade: $("#quantidade_edit").val(),
                            data_recebimento: $("#data_recebimento_edit").val(),
                            data_fabricacao: $("#data_fabricacao_edit").val(),
                            id_parameter_alergeno: $("#id_parameter_alergeno_edit option:selected").val(),
                        }
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formEditregistro_congelamento").each(function () {
                                    this.reset();
                                });

                                $("#modalEditregistro_congelamento").modal("hide");

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
    $("#list").on("click", ".delete-registro_congelamento", function(){

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
                                    url: window.location.origin + "/planilha/registro-congelamento/deletar",
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
