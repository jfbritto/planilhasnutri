$(document).ready(function () {

    loadPrincipal();
    loadGlobalParameters(4, 'id_parameter_equipamento');
    loadGlobalParameters(3, 'id_parameter_responsavel');

    // Carregar filtros
    loadGlobalParameters(4, 'id_parameter_equipamento_filter', null, true, false);

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
                    $.get(window.location.origin + "/planilha/temperatura-equipamento-area-climatizada/listar", {
                        id_parameter_equipamento_filter : $("#id_parameter_equipamento_filter option:selected").val(),
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
                                            <td class="align-middle">${item.responsavel}</td>
                                            <td class="align-middle">${item.equipamento}</td>
                                            <td class="align-middle">${item.temperatura_1}</td>
                                            <td class="align-middle">${item.temperatura_2}</td>
                                            <td class="align-middle" style="text-align: right">
                                                <a title="Editar"
                                                data-id="${item.id}"
                                                data-usuario="${item.usuario}"
                                                data-unidade="${item.unidade}"
                                                data-data="${item.data}"
                                                data-id_parameter_responsavel="${item.id_parameter_responsavel}"
                                                data-id_parameter_equipamento="${item.id_parameter_equipamento}"
                                                data-temperatura_1="${item.temperatura_1}"
                                                data-temperatura_2="${item.temperatura_2}"
                                                href="#" class="btn btn-warning edit-temperatura_equipamento_area_climatizada"><i style="color: white" class="fas fa-edit"></i></a>

                                                <a title="Deletar" data-id="${item.id}" href="#" class="btn btn-danger delete-temperatura_equipamento_area_climatizada"><i class="fas fa-trash-alt"></i></a>
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
    $("#formStoretemperatura_equipamento_area_climatizada").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();

                    $.post(window.location.origin + "/planilha/temperatura-equipamento-area-climatizada/cadastrar", {
                        data: $("#data").val(),
                        id_parameter_responsavel: $("#id_parameter_responsavel option:selected").val(),
                        id_parameter_equipamento: $("#id_parameter_equipamento option:selected").val(),
                        temperatura_1: $("#temperatura_1").val(),
                        temperatura_2: $("#temperatura_2").val(),
                    })
                    .then(function (data) {
                        if (data.status == "success") {

                            $("#formStoretemperatura_equipamento_area_climatizada").each(function () {
                                this.reset();
                            });

                            $("#modalStoretemperatura_equipamento_area_climatizada").modal("hide");

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
    $("#list").on("click", ".edit-temperatura_equipamento_area_climatizada", function(){

        let id = $(this).data('id');
        let usuario = $(this).data('usuario');
        let unidade = $(this).data('unidade');

        let data = $(this).data('data');
        let id_parameter_responsavel = $(this).data('id_parameter_responsavel');
        let id_parameter_equipamento = $(this).data('id_parameter_equipamento');
        let temperatura_1 = $(this).data('temperatura_1');
        let temperatura_2 = $(this).data('temperatura_2');

        loadGlobalParameters(4, 'id_parameter_equipamento_edit', id_parameter_equipamento);
        loadGlobalParameters(3, 'id_parameter_responsavel_edit', id_parameter_responsavel);

        $("#id_edit").val(id);
        $("#usuario").val(usuario);
        $("#unidade").val(unidade);
        $("#data_edit").val(data);
        $("#temperatura_1_edit").val(temperatura_1);
        $("#temperatura_2_edit").val(temperatura_2);

        $("#modalEdittemperatura_equipamento_area_climatizada").modal("show");
    });

    $("#formEdittemperatura_equipamento_area_climatizada").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.ajax({
                        url: window.location.origin + "/planilha/temperatura-equipamento-area-climatizada/editar",
                        type: 'PUT',
                        data:{
                            id: $("#id_edit").val(),
                            data: $("#data_edit").val(),
                            id_parameter_responsavel: $("#id_parameter_responsavel_edit option:selected").val(),
                            id_parameter_equipamento: $("#id_parameter_equipamento_edit option:selected").val(),
                            temperatura_1: $("#temperatura_1_edit").val(),
                            temperatura_2: $("#temperatura_2_edit").val(),
                        }
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formEdittemperatura_equipamento_area_climatizada").each(function () {
                                    this.reset();
                                });

                                $("#modalEdittemperatura_equipamento_area_climatizada").modal("hide");

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
    $("#list").on("click", ".delete-temperatura_equipamento_area_climatizada", function(){

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
                                    url: window.location.origin + "/planilha/temperatura-equipamento-area-climatizada/deletar",
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
