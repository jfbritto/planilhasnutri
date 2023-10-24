$(document).ready(function () {

    loadPrincipal();
    loadGlobalParameters(8, 'id_parameter_produto');

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
                    $.get(window.location.origin + "/planilha/temperatura-alimento-banho-maria/listar", {
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
                                            <td class="align-middle">${periodo(item.periodo)}</td>
                                            <td class="align-middle">${item.produto}</td>
                                            <td class="align-middle">${item.primeira_hora}</td>
                                            <td class="align-middle">${item.primeira_tremperatura}</td>
                                            <td class="align-middle">${item.acao_corretiva}</td>
                                            <td class="align-middle" style="text-align: right">
                                                <a title="Editar"
                                                data-id="${item.id}"
                                                data-usuario="${item.usuario}"
                                                data-unidade="${item.unidade}"
                                                data-data="${item.data}"
                                                data-periodo="${item.periodo}"
                                                data-id_parameter_produto="${item.id_parameter_produto}"
                                                data-primeira_hora="${item.primeira_hora}"
                                                data-primeira_tremperatura="${item.primeira_tremperatura}"
                                                data-segunda_hora="${item.segunda_hora}"
                                                data-segunda_tremperatura="${item.segunda_tremperatura}"
                                                data-acao_corretiva="${item.acao_corretiva}" href="#" class="btn btn-warning edit-temperatura_alimento_banho_maria"><i style="color: white" class="fas fa-edit"></i></a>
                                                <a title="Deletar" data-id="${item.id}" href="#" class="btn btn-danger delete-temperatura_alimento_banho_maria"><i class="fas fa-trash-alt"></i></a>
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
    $("#formStoretemperatura_alimento_banho_maria").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();

                    $.post(window.location.origin + "/planilha/temperatura-alimento-banho-maria/cadastrar", {
                        data: $("#data").val(),
                        periodo: $("#periodo option:selected").val(),
                        id_parameter_produto: $("#id_parameter_produto option:selected").val(),
                        primeira_hora: $("#primeira_hora").val(),
                        primeira_tremperatura: $("#primeira_tremperatura").val(),
                        segunda_hora: $("#segunda_hora").val(),
                        segunda_tremperatura: $("#segunda_tremperatura").val(),
                        acao_corretiva: $("#acao_corretiva").val(),
                    })
                    .then(function (data) {
                        if (data.status == "success") {

                            $("#formStoretemperatura_alimento_banho_maria").each(function () {
                                this.reset();
                            });

                            $("#modalStoretemperatura_alimento_banho_maria").modal("hide");

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
    $("#list").on("click", ".edit-temperatura_alimento_banho_maria", function(){

        let id = $(this).data('id');
        let usuario = $(this).data('usuario');
        let unidade = $(this).data('unidade');
        let data = $(this).data('data');
        let periodo = $(this).data('periodo');
        let id_parameter_produto = $(this).data('id_parameter_produto');
        let primeira_hora = $(this).data('primeira_hora');
        let primeira_tremperatura = $(this).data('primeira_tremperatura');
        let segunda_hora = $(this).data('segunda_hora');
        let segunda_tremperatura = $(this).data('segunda_tremperatura');
        let acao_corretiva = $(this).data('acao_corretiva');

        loadGlobalParameters(8, 'id_parameter_produto_edit', id_parameter_produto);

        $("#id_edit").val(id);
        $("#usuario").val(usuario);
        $("#unidade").val(unidade);
        $("#periodo_edit").val(periodo);
        $("#data_edit").val(data);
        $("#primeira_hora_edit").val(primeira_hora);
        $("#primeira_tremperatura_edit").val(primeira_tremperatura);
        $("#segunda_hora_edit").val(segunda_hora);
        $("#segunda_tremperatura_edit").val(segunda_tremperatura);
        $("#acao_corretiva_edit").val(acao_corretiva);

        $("#modalEdittemperatura_alimento_banho_maria").modal("show");
    });

    $("#formEdittemperatura_alimento_banho_maria").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.ajax({
                        url: window.location.origin + "/planilha/temperatura-alimento-banho-maria/editar",
                        type: 'PUT',
                        data:{
                            id: $("#id_edit").val(),
                            data: $("#data_edit").val(),
                            periodo: $("#periodo_edit option:selected").val(),
                            id_parameter_produto: $("#id_parameter_produto_edit option:selected").val(),
                            primeira_hora: $("#primeira_hora_edit").val(),
                            primeira_tremperatura: $("#primeira_tremperatura_edit").val(),
                            segunda_hora: $("#segunda_hora_edit").val(),
                            segunda_tremperatura: $("#segunda_tremperatura_edit").val(),
                            acao_corretiva: $("#acao_corretiva_edit").val(),
                        }
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formEdittemperatura_alimento_banho_maria").each(function () {
                                    this.reset();
                                });

                                $("#modalEdittemperatura_alimento_banho_maria").modal("hide");

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
    $("#list").on("click", ".delete-temperatura_alimento_banho_maria", function(){

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
                                    url: window.location.origin + "/planilha/temperatura-alimento-banho-maria/deletar",
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
