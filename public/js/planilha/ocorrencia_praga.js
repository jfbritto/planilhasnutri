$(document).ready(function () {

    loadPrincipal();
    loadGlobalParameters(1, 'id_parameter_area');
    loadGlobalParameters(12, 'id_parameter_praga');

    // Carregar filtros
    loadGlobalParameters(1, 'id_parameter_area_filter', null, true);
    loadGlobalParameters(12, 'id_parameter_praga_filter', null, true);

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
                    $.get(window.location.origin + "/planilha/ocorrencia-praga/listar", {
                        id_parameter_area_filter : $("#id_parameter_area_filter option:selected").val(),
                        id_parameter_praga_filter : $("#id_parameter_praga_filter option:selected").val(),
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
                                            <td class="align-middle">${item.area}</td>
                                            <td class="align-middle">${item.praga}</td>
                                            <td class="align-middle">${item.observacoes}</td>
                                            <td class="align-middle" style="text-align: right; min-width: 120px">
                                                <a title="Histórico" data-id="${item.id}" data-id_planilha="${item.id_planilha}" href="#" class="btn btn-info abrirHistorico"><i style="color: white" class="fas fa-clock"></i></a>
                                                <a title="Editar"
                                                data-id="${item.id}"
                                                data-usuario="${item.usuario}"
                                                data-unidade="${item.unidade}"
                                                data-data="${item.data}"
                                                data-id_parameter_area="${item.id_parameter_area}"
                                                data-id_parameter_praga="${item.id_parameter_praga}"
                                                data-observacoes="${item.observacoes}"
                                                href="#" class="btn btn-warning edit-ocorrencia_praga"><i style="color: white" class="fas fa-edit"></i></a>

                                                <a title="Deletar" data-id="${item.id}" href="#" class="btn btn-danger delete-ocorrencia_praga"><i class="fas fa-trash-alt"></i></a>
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
    $("#formStoreocorrencia_praga").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();

                    $.post(window.location.origin + "/planilha/ocorrencia-praga/cadastrar", {
                        data: $("#data").val(),
                        id_parameter_area: $("#id_parameter_area option:selected").val(),
                        id_parameter_praga: $("#id_parameter_praga option:selected").val(),
                        observacoes: $("#observacoes").val(),
                    })
                    .then(function (data) {
                        if (data.status == "success") {

                            $("#formStoreocorrencia_praga").each(function () {
                                this.reset();
                            });

                            $("#modalStoreocorrencia_praga").modal("hide");

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
    $("#list").on("click", ".edit-ocorrencia_praga", function(){

        let id = $(this).data('id');
        let usuario = $(this).data('usuario');
        let unidade = $(this).data('unidade');

        let data = $(this).data('data');
        let id_parameter_area = $(this).data('id_parameter_area');
        let id_parameter_praga = $(this).data('id_parameter_praga');
        let observacoes = $(this).data('observacoes');

        loadGlobalParameters(1, 'id_parameter_area_edit', id_parameter_area);
        loadGlobalParameters(12, 'id_parameter_praga_edit', id_parameter_praga);

        $("#id_edit").val(id);
        $("#usuario").val(usuario);
        $("#unidade").val(unidade);
        $("#data_edit").val(data);
        $("#observacoes_edit").val(observacoes);

        $("#modalEditocorrencia_praga").modal("show");
    });

    $("#formEditocorrencia_praga").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.ajax({
                        url: window.location.origin + "/planilha/ocorrencia-praga/editar",
                        type: 'PUT',
                        data:{
                            id: $("#id_edit").val(),
                            data: $("#data_edit").val(),
                            id_parameter_area: $("#id_parameter_area_edit option:selected").val(),
                            id_parameter_praga: $("#id_parameter_praga_edit option:selected").val(),
                            observacoes: $("#observacoes_edit").val(),
                        }
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formEditocorrencia_praga").each(function () {
                                    this.reset();
                                });

                                $("#modalEditocorrencia_praga").modal("hide");

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
    $("#list").on("click", ".delete-ocorrencia_praga", function(){

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
                                    url: window.location.origin + "/planilha/ocorrencia-praga/deletar",
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
