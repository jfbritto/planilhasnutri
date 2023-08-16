$(document).ready(function () {

    loadplanilha_registro_congelamento();
    loadGlobalParameters(8, 'id_parameter_produto');

    // LISTAGEM
    function loadplanilha_registro_congelamento()
    {
        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.get(window.location.origin + "/planilha/registro-congelamento/listar", {

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
                                            <td class="align-middle">${item.quantidade}</td>
                                            <td class="align-middle">${dateFormat(item.data_recebimento)}</td>
                                            <td class="align-middle">${dateFormat(item.data_fabricacao)}</td>
                                            <td class="align-middle">${item.alergeno}</td>
                                            <td class="align-middle" style="text-align: right">
                                                <a title="Editar"
                                                data-id="${item.id}"
                                                data-usuario="${item.usuario}"
                                                data-unidade="${item.unidade}"
                                                data-data_congelamento="${item.data_congelamento}"
                                                data-id_parameter_produto="${item.id_parameter_produto}"
                                                data-quantidade="${item.quantidade}"
                                                data-data_recebimento="${item.data_recebimento}"
                                                data-data_fabricacao="${item.data_fabricacao}"
                                                data-alergeno="${item.alergeno}" href="#" class="btn btn-warning edit-planilha_registro_congelamento"><i style="color: white" class="fas fa-edit"></i></a>
                                                <a title="Deletar" data-id="${item.id}" href="#" class="btn btn-danger delete-planilha_registro_congelamento"><i class="fas fa-trash-alt"></i></a>
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
    $("#formStoreplanilha_registro_congelamento").submit(function (e) {
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
                        alergeno: $("#alergeno").val(),
                    })
                    .then(function (data) {
                        if (data.status == "success") {

                            $("#formStoreplanilha_registro_congelamento").each(function () {
                                this.reset();
                            });

                            $("#modalStoreplanilha_registro_congelamento").modal("hide");

                            showSuccess("Cadastro efetuado!", null, loadplanilha_registro_congelamento)
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
    $("#list").on("click", ".edit-planilha_registro_congelamento", function(){

        let id = $(this).data('id');
        let usuario = $(this).data('usuario');
        let unidade = $(this).data('unidade');
        let data_congelamento = $(this).data('data_congelamento');
        let id_parameter_produto = $(this).data('id_parameter_produto');
        let quantidade = $(this).data('quantidade');
        let data_recebimento = $(this).data('data_recebimento');
        let data_fabricacao = $(this).data('data_fabricacao');
        let alergeno = $(this).data('alergeno');

        loadGlobalParameters(8, 'id_parameter_produto_edit', id_parameter_produto);

        $("#id_edit").val(id);
        $("#usuario").val(usuario);
        $("#unidade").val(unidade);
        $("#data_congelamento_edit").val(data_congelamento);
        $("#quantidade_edit").val(quantidade);
        $("#data_recebimento_edit").val(data_recebimento);
        $("#data_fabricacao_edit").val(data_fabricacao);
        $("#alergeno_edit").val(alergeno);

        $("#modalEditplanilha_registro_congelamento").modal("show");
    });

    $("#formEditplanilha_registro_congelamento").submit(function (e) {
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
                            alergeno: $("#alergeno_edit").val(),
                        }
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formEditplanilha_registro_congelamento").each(function () {
                                    this.reset();
                                });

                                $("#modalEditplanilha_registro_congelamento").modal("hide");

                                showSuccess("Edição efetuada!", null, loadplanilha_registro_congelamento)
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
    $("#list").on("click", ".delete-planilha_registro_congelamento", function(){

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

                                            showSuccess("Deletado com sucesso!", null, loadplanilha_registro_congelamento)
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