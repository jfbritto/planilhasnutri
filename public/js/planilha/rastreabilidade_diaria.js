$(document).ready(function () {

    loadPrincipal();
    loadGlobalParameters(8, 'id_parameter_produto', null, false, true, `modalStorerastreabilidade_diaria`);
    loadGlobalParameters(13, 'id_parameter_fabricante', null, false, true, `modalStorerastreabilidade_diaria`);

    // Carregar filtros
    loadGlobalParameters(8, 'id_parameter_produto_filter', null, true);

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
                    $.get(window.location.origin + "/planilha/rastreabilidade-diaria/listar", {
                        id_parameter_produto_filter : $("#id_parameter_produto_filter option:selected").val(),
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
                                            <td class="align-middle">${item.produto}</td>
                                            <td class="align-middle">${item.lote}</td>
                                            <td class="align-middle">${dateFormat(item.validade)}</td>
                                            <td class="align-middle">${item.fabricante}</td>
                                            <td class="align-middle" style="text-align: right; min-width: 120px">
                                                <a title="Editar"
                                                data-id="${item.id}"
                                                data-usuario="${item.usuario}"
                                                data-unidade="${item.unidade}"
                                                data-id_parameter_produto="${item.id_parameter_produto}"
                                                data-data="${item.data}"
                                                data-lote="${item.lote}"
                                                data-validade="${item.validade}"
                                                data-id_parameter_fabricante="${item.id_parameter_fabricante}"
                                                href="#" class="btn btn-warning edit-rastreabilidade_diaria"><i style="color: white" class="fas fa-edit"></i></a>

                                                <a title="Deletar" data-id="${item.id}" href="#" class="btn btn-danger delete-rastreabilidade_diaria"><i class="fas fa-trash-alt"></i></a>
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
    $("#formStorerastreabilidade_diaria").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();

                    $.post(window.location.origin + "/planilha/rastreabilidade-diaria/cadastrar", {
                        data: $("#data").val(),
                        id_parameter_produto: $("#id_parameter_produto option:selected").val(),
                        lote: $("#lote").val(),
                        validade: $("#validade").val(),
                        id_parameter_fabricante: $("#id_parameter_fabricante option:selected").val(),
                    })
                    .then(function (data) {
                        if (data.status == "success") {

                            $("#formStorerastreabilidade_diaria").each(function () {
                                this.reset();
                            });

                            $("#modalStorerastreabilidade_diaria").modal("hide");

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
    $("#list").on("click", ".edit-rastreabilidade_diaria", function(){

        let id = $(this).data('id');
        let usuario = $(this).data('usuario');
        let unidade = $(this).data('unidade');

        let data = $(this).data('data');
        let lote = $(this).data('lote');
        let validade = $(this).data('validade');
        let id_parameter_produto = $(this).data('id_parameter_produto');
        let id_parameter_fabricante = $(this).data('id_parameter_fabricante');

        loadGlobalParameters(8, 'id_parameter_produto_edit', id_parameter_produto, false, true, `modalEditrastreabilidade_diaria`);
        loadGlobalParameters(13, 'id_parameter_fabricante_edit', id_parameter_fabricante, false, true, `modalEditrastreabilidade_diaria`);

        $("#id_edit").val(id);
        $("#usuario").val(usuario);
        $("#unidade").val(unidade);
        $("#data_edit").val(data);
        $("#lote_edit").val(lote);
        $("#validade_edit").val(validade);

        $("#modalEditrastreabilidade_diaria").modal("show");
    });

    $("#formEditrastreabilidade_diaria").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.ajax({
                        url: window.location.origin + "/planilha/rastreabilidade-diaria/editar",
                        type: 'PUT',
                        data:{
                            id: $("#id_edit").val(),
                            data: $("#data_edit").val(),
                            id_parameter_produto: $("#id_parameter_produto_edit option:selected").val(),
                            lote: $("#lote_edit").val(),
                            validade: $("#validade_edit").val(),
                            id_parameter_fabricante: $("#id_parameter_fabricante_edit option:selected").val(),
                        }
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formEditrastreabilidade_diaria").each(function () {
                                    this.reset();
                                });

                                $("#modalEditrastreabilidade_diaria").modal("hide");

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
    $("#list").on("click", ".delete-rastreabilidade_diaria", function(){

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
                                    url: window.location.origin + "/planilha/rastreabilidade-diaria/deletar",
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
