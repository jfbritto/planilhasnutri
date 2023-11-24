$(document).ready(function () {

    loadPrincipal();
    loadGlobalParameters(6, 'id_parameter_caixa_gordura', null, false, true, `modalStorelimpeza_caixa_gorduras`);
    loadGlobalParameters(1, 'id_parameter_area', null, false, true, `modalStorelimpeza_caixa_gorduras`);
    loadGlobalParameters(3, 'id_parameter_responsavel', null, false, true, `modalStorelimpeza_caixa_gorduras`);

    // Carregar filtros
    loadGlobalParameters(1, 'id_parameter_area_filter', null, true);
    loadGlobalParameters(6, 'id_parameter_caixa_gordura_filter', null, true);

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
                    $.get(window.location.origin + "/planilha/limpeza-caixa-gordura/listar", {
                        data_ini_filter : $("#data_ini_filter").val(),
                        data_fim_filter : $("#data_fim_filter").val(),
                        mes_proxima_limpeza_filter : $("#mes_proxima_limpeza_filter").val(),
                        id_parameter_caixa_gordura_filter : $("#id_parameter_caixa_gordura_filter option:selected").val(),
                        id_parameter_area_filter : $("#id_parameter_area_filter option:selected").val(),
                    })
                    .then(function (data) {
                        if (data.status == "success") {

                            Swal.close();
                            $("#list").html(``);

                            if(data.data.length > 0){

                                data.data.forEach(item => {

                                    $("#list").append(`
                                        <tr>
                                            <td class="align-middle">${item.caixa_gordura}</td>
                                            <td class="align-middle">${item.area}</td>
                                            <td class="align-middle">${dateFormat(item.data_limpeza)}</td>
                                            <td class="align-middle">${dateFormat(item.data_proxima_limpeza)}</td>
                                            <td class="align-middle">${item.responsavel}</td>
                                            <td class="align-middle" style="text-align: right; min-width: 120px">
                                                <a title="Histórico" data-id="${item.id}" data-id_planilha="${item.id_planilha}" href="#" class="btn btn-info abrirHistorico"><i style="color: white" class="fas fa-clock"></i></a>
                                                <a title="Editar"
                                                data-id="${item.id}"
                                                data-usuario="${item.usuario}"
                                                data-unidade="${item.unidade}"
                                                data-id_parameter_caixa_gordura="${item.id_parameter_caixa_gordura}"
                                                data-id_parameter_area="${item.id_parameter_area}"
                                                data-id_parameter_responsavel="${item.id_parameter_responsavel}"
                                                data-data_limpeza="${item.data_limpeza}"
                                                data-data_proxima_limpeza="${item.data_proxima_limpeza}" href="#" class="btn btn-warning edit-limpeza_caixa_gorduras"><i style="color: white" class="fas fa-edit"></i></a>
                                                <a title="Deletar" data-id="${item.id}" href="#" class="btn btn-danger delete-limpeza_caixa_gorduras"><i class="fas fa-trash-alt"></i></a>
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
    $("#formStorelimpeza_caixa_gorduras").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();

                    $.post(window.location.origin + "/planilha/limpeza-caixa-gordura/cadastrar", {
                        id_parameter_caixa_gordura: $("#id_parameter_caixa_gordura option:selected").val(),
                        id_parameter_area: $("#id_parameter_area option:selected").val(),
                        id_parameter_responsavel: $("#id_parameter_responsavel option:selected").val(),
                        data_limpeza: $("#data_limpeza").val(),
                        data_proxima_limpeza: $("#data_proxima_limpeza").val(),
                    })
                    .then(function (data) {
                        if (data.status == "success") {

                            $("#formStorelimpeza_caixa_gorduras").each(function () {
                                this.reset();
                            });

                            $("#modalStorelimpeza_caixa_gorduras").modal("hide");

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
    $("#list").on("click", ".edit-limpeza_caixa_gorduras", function(){

        let id = $(this).data('id');
        let usuario = $(this).data('usuario');
        let unidade = $(this).data('unidade');
        let id_parameter_caixa_gordura = $(this).data('id_parameter_caixa_gordura');
        let id_parameter_area = $(this).data('id_parameter_area');
        let id_parameter_responsavel = $(this).data('id_parameter_responsavel');
        let data_limpeza = $(this).data('data_limpeza');
        let data_proxima_limpeza = $(this).data('data_proxima_limpeza');

        loadGlobalParameters(6, 'id_parameter_caixa_gordura_edit', id_parameter_caixa_gordura, false, true, `modalEditlimpeza_caixa_gorduras`);
        loadGlobalParameters(1, 'id_parameter_area_edit', id_parameter_area, false, true, `modalEditlimpeza_caixa_gorduras`);
        loadGlobalParameters(3, 'id_parameter_responsavel_edit', id_parameter_responsavel, false, true, `modalEditlimpeza_caixa_gorduras`);

        $("#id_edit").val(id);
        $("#usuario").val(usuario);
        $("#unidade").val(unidade);
        $("#data_limpeza_edit").val(data_limpeza);
        $("#data_proxima_limpeza_edit").val(data_proxima_limpeza);

        $("#modalEditlimpeza_caixa_gorduras").modal("show");
    });

    $("#formEditlimpeza_caixa_gorduras").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.ajax({
                        url: window.location.origin + "/planilha/limpeza-caixa-gordura/editar",
                        type: 'PUT',
                        data:{
                            id: $("#id_edit").val(),
                            id_parameter_caixa_gordura: $("#id_parameter_caixa_gordura_edit option:selected").val(),
                            id_parameter_area: $("#id_parameter_area_edit option:selected").val(),
                            id_parameter_responsavel: $("#id_parameter_responsavel_edit option:selected").val(),
                            data_limpeza: $("#data_limpeza_edit").val(),
                            data_proxima_limpeza: $("#data_proxima_limpeza_edit").val(),
                        }
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formEditlimpeza_caixa_gorduras").each(function () {
                                    this.reset();
                                });

                                $("#modalEditlimpeza_caixa_gorduras").modal("hide");

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
    $("#list").on("click", ".delete-limpeza_caixa_gorduras", function(){

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
                                    url: window.location.origin + "/planilha/limpeza-caixa-gordura/deletar",
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

    $("#data_limpeza").change(function (e) {
        e.preventDefault();
        preencherProximaData('data_limpeza', 'data_proxima_limpeza')
    });

});
