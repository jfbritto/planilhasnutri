$(document).ready(function () {

    loadtroca_elemento_filtrante();
    loadGlobalParameters(1, 'id_parameter_area');
    loadGlobalParameters(2, 'id_parameter_filtro');
    loadGlobalParameters(3, 'id_parameter_responsavel');

    // LISTAGEM
    function loadtroca_elemento_filtrante()
    {
        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.get(window.location.origin + "/planilha/troca-elemento-filtrante/listar", {

                    })
                    .then(function (data) {
                        if (data.status == "success") {

                            Swal.close();
                            $("#list").html(``);

                            if(data.data.length > 0){

                                data.data.forEach(item => {

                                    $("#list").append(`
                                        <tr>
                                            <td class="align-middle">${item.area}</td>
                                            <td class="align-middle">${item.filtro}</td>
                                            <td class="align-middle">${dateFormat(item.data_troca)}</td>
                                            <td class="align-middle">${dateFormat(item.data_proxima_troca)}</td>
                                            <td class="align-middle">${item.responsavel}</td>
                                            <td class="align-middle" style="text-align: right">
                                                <a title="Editar" data-id="${item.id}" data-usuario="${item.usuario}" data-unidade="${item.unidade}" data-id_parameter_area="${item.id_parameter_area}" data-id_parameter_filtro="${item.id_parameter_filtro}" data-id_parameter_responsavel="${item.id_parameter_responsavel}" data-data_troca="${item.data_troca}" data-data_proxima_troca="${item.data_proxima_troca}" href="#" class="btn btn-warning edit-troca_elemento_filtrante"><i style="color: white" class="fas fa-edit"></i></a>
                                                <a title="Deletar" data-id="${item.id}" href="#" class="btn btn-danger delete-troca_elemento_filtrante"><i class="fas fa-trash-alt"></i></a>
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
    $("#formStoretroca_elemento_filtrante").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();

                    $.post(window.location.origin + "/planilha/troca-elemento-filtrante/cadastrar", {
                        id_parameter_area: $("#id_parameter_area option:selected").val(),
                        id_parameter_filtro: $("#id_parameter_filtro option:selected").val(),
                        id_parameter_responsavel: $("#id_parameter_responsavel option:selected").val(),
                        data_troca: $("#data_troca").val(),
                        data_proxima_troca: $("#data_proxima_troca").val(),
                    })
                    .then(function (data) {
                        if (data.status == "success") {

                            $("#formStoretroca_elemento_filtrante").each(function () {
                                this.reset();
                            });

                            $("#modalStoretroca_elemento_filtrante").modal("hide");

                            showSuccess("Cadastro efetuado!", null, loadtroca_elemento_filtrante)
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
    $("#list").on("click", ".edit-troca_elemento_filtrante", function(){

        let id = $(this).data('id');
        let usuario = $(this).data('usuario');
        let unidade = $(this).data('unidade');
        let id_parameter_area = $(this).data('id_parameter_area');
        let id_parameter_filtro = $(this).data('id_parameter_filtro');
        let id_parameter_responsavel = $(this).data('id_parameter_responsavel');
        let data_troca = $(this).data('data_troca');
        let data_proxima_troca = $(this).data('data_proxima_troca');

        loadGlobalParameters(1, 'id_parameter_area_edit', id_parameter_area);
        loadGlobalParameters(2, 'id_parameter_filtro_edit', id_parameter_filtro);
        loadGlobalParameters(3, 'id_parameter_responsavel_edit', id_parameter_responsavel);

        $("#id_edit").val(id);
        $("#usuario").val(usuario);
        $("#unidade").val(unidade);
        $("#data_troca_edit").val(data_troca);
        $("#data_proxima_troca_edit").val(data_proxima_troca);

        $("#modalEdittroca_elemento_filtrante").modal("show");
    });

    $("#formEdittroca_elemento_filtrante").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.ajax({
                        url: window.location.origin + "/planilha/troca-elemento-filtrante/editar",
                        type: 'PUT',
                        data:{
                            id: $("#id_edit").val(),
                            id_parameter_area: $("#id_parameter_area_edit option:selected").val(),
                            id_parameter_filtro: $("#id_parameter_filtro_edit option:selected").val(),
                            id_parameter_responsavel: $("#id_parameter_responsavel_edit option:selected").val(),
                            data_troca: $("#data_troca_edit").val(),
                            data_proxima_troca: $("#data_proxima_troca_edit").val(),
                        }
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formEdittroca_elemento_filtrante").each(function () {
                                    this.reset();
                                });

                                $("#modalEdittroca_elemento_filtrante").modal("hide");

                                showSuccess("Edição efetuada!", null, loadtroca_elemento_filtrante)
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
    $("#list").on("click", ".delete-troca_elemento_filtrante", function(){

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
                                    url: window.location.origin + "/planilha/troca-elemento-filtrante/deletar",
                                    type: 'DELETE',
                                    data: {id}
                                })
                                    .then(function (data) {
                                        if (data.status == "success") {

                                            showSuccess("Deletado com sucesso!", null, loadtroca_elemento_filtrante)
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