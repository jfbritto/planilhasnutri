$(document).ready(function () {

    loadPrincipal();
    loadGlobalParameters(1, 'id_parameter_area', null, false, true, `modalStorehigienizacao_filtro_aparelho_climatizacao`);
    loadGlobalParameters(4, 'id_parameter_equipamento', null, false, true, `modalStorehigienizacao_filtro_aparelho_climatizacao`);
    loadGlobalParameters(3, 'id_parameter_responsavel', null, false, true, `modalStorehigienizacao_filtro_aparelho_climatizacao`);

    // Carregar filtros
    loadGlobalParameters(1, 'id_parameter_area_filter', null, true);
    loadGlobalParameters(4, 'id_parameter_equipamento_filter', null, true, false);
    loadGlobalParameters(3, 'id_parameter_responsavel_filter', null, true, false);

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
                    $.get(window.location.origin + "/planilha/higienizacao-filtro-aparelho-climatizacao/listar", {
                        data_ini_filter : $("#data_ini_filter").val(),
                        data_fim_filter : $("#data_fim_filter").val(),
                        mes_proxima_higienizacao_filter : $("#mes_proxima_higienizacao_filter").val(),
                        id_parameter_area_filter : $("#id_parameter_area_filter option:selected").val(),
                        id_parameter_equipamento_filter : $("#id_parameter_equipamento_filter option:selected").val(),
                        id_parameter_responsavel_filter : $("#id_parameter_responsavel_filter option:selected").val(),
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
                                            <td class="align-middle">${item.equipamento}</td>
                                            <td class="align-middle">${dateFormat(item.data_higienizacao)}</td>
                                            <td class="align-middle">${dateFormat(item.data_proxima_higienizacao)}</td>
                                            <td class="align-middle">${item.responsavel}</td>
                                            <td class="align-middle" style="text-align: right; min-width: 120px">
                                                <a title="Histórico" data-id="${item.id}" data-id_planilha="${item.id_planilha}" href="#" class="btn btn-info abrirHistorico"><i style="color: white" class="fas fa-clock"></i></a>
                                                <a title="Editar" data-id="${item.id}" data-usuario="${item.usuario}" data-unidade="${item.unidade}" data-id_parameter_area="${item.id_parameter_area}" data-id_parameter_equipamento="${item.id_parameter_equipamento}" data-id_parameter_responsavel="${item.id_parameter_responsavel}" data-data_higienizacao="${item.data_higienizacao}" data-data_proxima_higienizacao="${item.data_proxima_higienizacao}" href="#" class="btn btn-warning edit-higienizacao_filtro_aparelho_climatizacao"><i style="color: white" class="fas fa-edit"></i></a>
                                                <a title="Deletar" data-id="${item.id}" href="#" class="btn btn-danger delete-higienizacao_filtro_aparelho_climatizacao"><i class="fas fa-trash-alt"></i></a>
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
    $("#formStorehigienizacao_filtro_aparelho_climatizacao").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();

                    $.post(window.location.origin + "/planilha/higienizacao-filtro-aparelho-climatizacao/cadastrar", {
                        id_parameter_area: $("#id_parameter_area option:selected").val(),
                        id_parameter_equipamento: $("#id_parameter_equipamento option:selected").val(),
                        id_parameter_responsavel: $("#id_parameter_responsavel option:selected").val(),
                        data_higienizacao: $("#data_higienizacao").val(),
                        data_proxima_higienizacao: $("#data_proxima_higienizacao").val(),
                    })
                    .then(function (data) {
                        if (data.status == "success") {

                            $("#formStorehigienizacao_filtro_aparelho_climatizacao").each(function () {
                                this.reset();
                            });

                            $("#modalStorehigienizacao_filtro_aparelho_climatizacao").modal("hide");

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
    $("#list").on("click", ".edit-higienizacao_filtro_aparelho_climatizacao", function(){

        let id = $(this).data('id');
        let usuario = $(this).data('usuario');
        let unidade = $(this).data('unidade');
        let id_parameter_area = $(this).data('id_parameter_area');
        let id_parameter_equipamento = $(this).data('id_parameter_equipamento');
        let id_parameter_responsavel = $(this).data('id_parameter_responsavel');
        let data_higienizacao = $(this).data('data_higienizacao');
        let data_proxima_higienizacao = $(this).data('data_proxima_higienizacao');

        loadGlobalParameters(1, 'id_parameter_area_edit', id_parameter_area, false, true, `modalEdithigienizacao_filtro_aparelho_climatizacao`);
        loadGlobalParameters(4, 'id_parameter_equipamento_edit', id_parameter_equipamento, false, true, `modalEdithigienizacao_filtro_aparelho_climatizacao`);
        loadGlobalParameters(3, 'id_parameter_responsavel_edit', id_parameter_responsavel, false, true, `modalEdithigienizacao_filtro_aparelho_climatizacao`);

        $("#id_edit").val(id);
        $("#usuario").val(usuario);
        $("#unidade").val(unidade);
        $("#data_higienizacao_edit").val(data_higienizacao);
        $("#data_proxima_higienizacao_edit").val(data_proxima_higienizacao);

        $("#modalEdithigienizacao_filtro_aparelho_climatizacao").modal("show");
    });

    $("#formEdithigienizacao_filtro_aparelho_climatizacao").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.ajax({
                        url: window.location.origin + "/planilha/higienizacao-filtro-aparelho-climatizacao/editar",
                        type: 'PUT',
                        data:{
                            id: $("#id_edit").val(),
                            id_parameter_area: $("#id_parameter_area_edit option:selected").val(),
                            id_parameter_equipamento: $("#id_parameter_equipamento_edit option:selected").val(),
                            id_parameter_responsavel: $("#id_parameter_responsavel_edit option:selected").val(),
                            data_higienizacao: $("#data_higienizacao_edit").val(),
                            data_proxima_higienizacao: $("#data_proxima_higienizacao_edit").val(),
                        }
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formEdithigienizacao_filtro_aparelho_climatizacao").each(function () {
                                    this.reset();
                                });

                                $("#modalEdithigienizacao_filtro_aparelho_climatizacao").modal("hide");

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
    $("#list").on("click", ".delete-higienizacao_filtro_aparelho_climatizacao", function(){

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
                                    url: window.location.origin + "/planilha/higienizacao-filtro-aparelho-climatizacao/deletar",
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

    $("#data_higienizacao").change(function (e) {
        e.preventDefault();
        preencherProximaData('data_higienizacao', 'data_proxima_higienizacao')
    });

});
