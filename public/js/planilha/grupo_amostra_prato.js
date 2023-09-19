$(document).ready(function () {

    loadgrupo_amostra_prato();

    // LISTAGEM
    function loadgrupo_amostra_prato()
    {
        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.get(window.location.origin + "/planilha/grupo-amostra-prato/listar", {

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
                                            <td class="align-middle">${item.nome_grupo}</td>
                                            <td class="align-middle">${item.numero_pessoas}</td>
                                            <td class="align-middle">${item.cardapio}</td>
                                            <td class="align-middle" style="text-align: right">
                                                <a title="Editar"
                                                data-id="${item.id}"
                                                data-usuario="${item.usuario}"
                                                data-unidade="${item.unidade}"
                                                data-data="${item.data}"
                                                data-nome_grupo="${item.nome_grupo}"
                                                data-numero_pessoas="${item.numero_pessoas}"
                                                data-cardapio="${item.cardapio}" href="#" class="btn btn-warning edit-grupo_amostra_prato"><i style="color: white" class="fas fa-edit"></i></a>
                                                <a title="Deletar" data-id="${item.id}" href="#" class="btn btn-danger delete-grupo_amostra_prato"><i class="fas fa-trash-alt"></i></a>
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
    $("#formStoregrupo_amostra_prato").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();

                    $.post(window.location.origin + "/planilha/grupo-amostra-prato/cadastrar", {
                        data: $("#data").val(),
                        nome_grupo: $("#nome_grupo").val(),
                        numero_pessoas: $("#numero_pessoas").val(),
                        cardapio: $("#cardapio").val(),
                    })
                    .then(function (data) {
                        if (data.status == "success") {

                            $("#formStoregrupo_amostra_prato").each(function () {
                                this.reset();
                            });

                            $("#modalStoregrupo_amostra_prato").modal("hide");

                            showSuccess("Cadastro efetuado!", null, loadgrupo_amostra_prato)
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
    $("#list").on("click", ".edit-grupo_amostra_prato", function(){

        let id = $(this).data('id');
        let usuario = $(this).data('usuario');
        let unidade = $(this).data('unidade');
        let data = $(this).data('data');
        let nome_grupo = $(this).data('nome_grupo');
        let numero_pessoas = $(this).data('numero_pessoas');
        let cardapio = $(this).data('cardapio');

        $("#id_edit").val(id);
        $("#usuario").val(usuario);
        $("#unidade").val(unidade);
        $("#data_edit").val(data);
        $("#nome_grupo_edit").val(nome_grupo);
        $("#numero_pessoas_edit").val(numero_pessoas);
        $("#cardapio_edit").val(cardapio);

        $("#modalEditgrupo_amostra_prato").modal("show");
    });

    $("#formEditgrupo_amostra_prato").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.ajax({
                        url: window.location.origin + "/planilha/grupo-amostra-prato/editar",
                        type: 'PUT',
                        data:{
                            id: $("#id_edit").val(),
                            data: $("#data_edit").val(),
                            nome_grupo: $("#nome_grupo_edit").val(),
                            numero_pessoas: $("#numero_pessoas_edit").val(),
                            cardapio: $("#cardapio_edit").val(),
                        }
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formEditgrupo_amostra_prato").each(function () {
                                    this.reset();
                                });

                                $("#modalEditgrupo_amostra_prato").modal("hide");

                                showSuccess("Edição efetuada!", null, loadgrupo_amostra_prato)
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
    $("#list").on("click", ".delete-grupo_amostra_prato", function(){

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
                                    url: window.location.origin + "/planilha/grupo-amostra-prato/deletar",
                                    type: 'DELETE',
                                    data: {id}
                                })
                                    .then(function (data) {
                                        if (data.status == "success") {

                                            showSuccess("Deletado com sucesso!", null, loadgrupo_amostra_prato)
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
