$(document).ready(function () {

    loadPrincipal();
    loadGlobalParameters(3, 'id_parameter_responsavel');
    loadGlobalParameters(8, 'id_parameter_produto');
    loadGlobalParameters(11, 'id_parameter_evento');

    // Carregar filtros
    loadGlobalParameters(8, 'id_parameter_produto_filter', null, true, false);
    loadGlobalParameters(11, 'id_parameter_evento_filter', null, true, false);

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
                    $.get(window.location.origin + "/planilha/temperatura-alimento-distribuicao/listar", {
                        id_parameter_evento_filter : $("#id_parameter_evento_filter option:selected").val(),
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
                                            <td class="align-middle">${item.evento}</td>
                                            <td class="align-middle">${periodo(item.periodo)}</td>
                                            <td class="align-middle">${item.produto}</td>
                                            <td class="align-middle">${item.hora_1}</td>
                                            <td class="align-middle">${item.tremperatura_1}</td>
                                            <td class="align-middle">${item.acao_corretiva}</td>
                                            <td class="align-middle" style="text-align: right; min-width: 120px">
                                                <a title="Editar"
                                                data-id="${item.id}"
                                                data-usuario="${item.usuario}"
                                                data-unidade="${item.unidade}"
                                                data-data="${item.data}"
                                                data-periodo="${item.periodo}"
                                                data-id_parameter_produto="${item.id_parameter_produto}"
                                                data-id_parameter_evento="${item.id_parameter_evento}"
                                                data-id_parameter_responsavel="${item.id_parameter_responsavel}"
                                                data-hora_1="${item.hora_1}"
                                                data-tremperatura_1="${item.tremperatura_1}"
                                                data-hora_2="${item.hora_2}"
                                                data-tremperatura_2="${item.tremperatura_2}"
                                                data-hora_3="${item.hora_3}"
                                                data-tremperatura_3="${item.tremperatura_3}"
                                                data-hora_4="${item.hora_4}"
                                                data-tremperatura_4="${item.tremperatura_4}"
                                                data-hora_5="${item.hora_5}"
                                                data-tremperatura_5="${item.tremperatura_5}"
                                                data-hora_6="${item.hora_6}"
                                                data-tremperatura_6="${item.tremperatura_6}"
                                                data-hora_7="${item.hora_7}"
                                                data-tremperatura_7="${item.tremperatura_7}"
                                                data-acao_corretiva="${item.acao_corretiva}" href="#" class="btn btn-warning edit-temperatura_alimento_distribuicao"><i style="color: white" class="fas fa-edit"></i></a>
                                                <a title="Deletar" data-id="${item.id}" href="#" class="btn btn-danger delete-temperatura_alimento_distribuicao"><i class="fas fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                    `);
                                });

                            }else{

                                $("#list").append(`
                                    <tr>
                                        <td class="align-middle text-center" colspan="8">Nenhum registro encontrado</td>
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
    $("#formStoretemperatura_alimento_distribuicao").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();

                    $.post(window.location.origin + "/planilha/temperatura-alimento-distribuicao/cadastrar", {
                        data: $("#data").val(),
                        periodo: $("#periodo option:selected").val(),
                        id_parameter_produto: $("#id_parameter_produto option:selected").val(),
                        id_parameter_evento: $("#id_parameter_evento option:selected").val(),
                        id_parameter_responsavel: $("#id_parameter_responsavel option:selected").val(),
                        hora_1: $("#hora_1").val(),
                        tremperatura_1: $("#tremperatura_1").val(),
                        hora_2: $("#hora_2").val(),
                        tremperatura_2: $("#tremperatura_2").val(),
                        hora_3: $("#hora_3").val(),
                        tremperatura_3: $("#tremperatura_3").val(),
                        hora_4: $("#hora_4").val(),
                        tremperatura_4: $("#tremperatura_4").val(),
                        hora_5: $("#hora_5").val(),
                        tremperatura_5: $("#tremperatura_5").val(),
                        hora_6: $("#hora_6").val(),
                        tremperatura_6: $("#tremperatura_6").val(),
                        hora_7: $("#hora_7").val(),
                        tremperatura_7: $("#tremperatura_7").val(),
                        acao_corretiva: $("#acao_corretiva").val(),
                    })
                    .then(function (data) {
                        if (data.status == "success") {

                            $("#formStoretemperatura_alimento_distribuicao").each(function () {
                                this.reset();
                            });

                            $("#modalStoretemperatura_alimento_distribuicao").modal("hide");

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
    $("#list").on("click", ".edit-temperatura_alimento_distribuicao", function(){

        let id = $(this).data('id');
        let usuario = $(this).data('usuario');
        let unidade = $(this).data('unidade');
        let data = $(this).data('data');
        let periodo = $(this).data('periodo');
        let id_parameter_produto = $(this).data('id_parameter_produto');
        let id_parameter_evento = $(this).data('id_parameter_evento');
        let id_parameter_responsavel = $(this).data('id_parameter_responsavel');
        let hora_1 = $(this).data('hora_1');
        let tremperatura_1 = $(this).data('tremperatura_1');
        let hora_2 = $(this).data('hora_2');
        let tremperatura_2 = $(this).data('tremperatura_2');
        let hora_3 = $(this).data('hora_3');
        let tremperatura_3 = $(this).data('tremperatura_3');
        let hora_4 = $(this).data('hora_4');
        let tremperatura_4 = $(this).data('tremperatura_4');
        let hora_5 = $(this).data('hora_5');
        let tremperatura_5 = $(this).data('tremperatura_5');
        let hora_6 = $(this).data('hora_6');
        let tremperatura_6 = $(this).data('tremperatura_6');
        let hora_7 = $(this).data('hora_7');
        let tremperatura_7 = $(this).data('tremperatura_7');
        let acao_corretiva = $(this).data('acao_corretiva');

        loadGlobalParameters(3, 'id_parameter_responsavel_edit', id_parameter_responsavel);
        loadGlobalParameters(8, 'id_parameter_produto_edit', id_parameter_produto);
        loadGlobalParameters(11, 'id_parameter_evento_edit', id_parameter_evento);

        $("#id_edit").val(id);
        $("#usuario").val(usuario);
        $("#unidade").val(unidade);
        $("#data_edit").val(data);
        $("#periodo_edit").val(periodo);
        $("#hora_1_edit").val(hora_1);
        $("#tremperatura_1_edit").val(tremperatura_1);
        $("#hora_2_edit").val(hora_2);
        $("#tremperatura_2_edit").val(tremperatura_2);
        $("#hora_3_edit").val(hora_3);
        $("#tremperatura_3_edit").val(tremperatura_3);
        $("#hora_4_edit").val(hora_4);
        $("#tremperatura_4_edit").val(tremperatura_4);
        $("#hora_5_edit").val(hora_5);
        $("#tremperatura_5_edit").val(tremperatura_5);
        $("#hora_6_edit").val(hora_6);
        $("#tremperatura_6_edit").val(tremperatura_6);
        $("#hora_7_edit").val(hora_7);
        $("#tremperatura_7_edit").val(tremperatura_7);
        $("#acao_corretiva_edit").val(acao_corretiva);

        $("#modalEdittemperatura_alimento_distribuicao").modal("show");
    });

    $("#formEdittemperatura_alimento_distribuicao").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.ajax({
                        url: window.location.origin + "/planilha/temperatura-alimento-distribuicao/editar",
                        type: 'PUT',
                        data:{
                            id: $("#id_edit").val(),
                            data: $("#data_edit").val(),
                            periodo: $("#periodo_edit option:selected").val(),
                            id_parameter_produto: $("#id_parameter_produto_edit option:selected").val(),
                            id_parameter_evento: $("#id_parameter_evento_edit option:selected").val(),
                            id_parameter_responsavel: $("#id_parameter_responsavel_edit option:selected").val(),
                            hora_1: $("#hora_1_edit").val(),
                            tremperatura_1: $("#tremperatura_1_edit").val(),
                            hora_2: $("#hora_2_edit").val(),
                            tremperatura_2: $("#tremperatura_2_edit").val(),
                            hora_3: $("#hora_3_edit").val(),
                            tremperatura_3: $("#tremperatura_3_edit").val(),
                            hora_4: $("#hora_4_edit").val(),
                            tremperatura_4: $("#tremperatura_4_edit").val(),
                            hora_5: $("#hora_5_edit").val(),
                            tremperatura_5: $("#tremperatura_5_edit").val(),
                            hora_6: $("#hora_6_edit").val(),
                            tremperatura_6: $("#tremperatura_6_edit").val(),
                            hora_7: $("#hora_7_edit").val(),
                            tremperatura_7: $("#tremperatura_7_edit").val(),
                            acao_corretiva: $("#acao_corretiva_edit").val(),
                        }
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formEdittemperatura_alimento_distribuicao").each(function () {
                                    this.reset();
                                });

                                $("#modalEdittemperatura_alimento_distribuicao").modal("hide");

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
    $("#list").on("click", ".delete-temperatura_alimento_distribuicao", function(){

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
                                    url: window.location.origin + "/planilha/temperatura-alimento-distribuicao/deletar",
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
