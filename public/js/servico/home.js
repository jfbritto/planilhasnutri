$(document).ready(function () {

    loadPrincipal();
    loadGlobalParameters(7, 'id_parameter_servico', null, false, true, `modalStoreservicos`);

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
                    $.get(window.location.origin + "/servico/listar", {

                    })
                    .then(function (data) {
                        if (data.status == "success") {

                            Swal.close();
                            $("#list").html(``);

                            if(data.data.length > 0){

                                data.data.forEach(item => {

                                    $("#list").append(`
                                        <tr>
                                            <td class="align-middle">${item.servico}</td>
                                            <td class="align-middle">${frequencia(item.frequencia_meses)}</td>
                                            <td class="align-middle">${dateFormat(item.data)}</td>
                                            <td class="align-middle">${dateFormat(item.proxima_data)}</td>
                                            <td class="align-middle">
                                            ${item.documento != '' ? `
                                                <a href="servico/download/${item.documento}" title="Baixar arquivo" target="_blank"><i class="fa-solid fa-file-${detectarExtensaoArquivo(item.documento)} fa-xl"></i></a>
                                            `:``}
                                            </td>
                                            <td class="align-middle" style="text-align: right; min-width: 120px">
                                                <a title="Editar"
                                                data-id="${item.id}"
                                                data-usuario="${item.usuario}"
                                                data-unidade="${item.unidade}"
                                                data-id_parameter_servico="${item.id_parameter_servico}"
                                                data-data="${item.data}"
                                                data-proxima_data="${item.proxima_data}"
                                                data-frequencia_meses="${item.frequencia_meses}"
                                                data-documento="${item.documento}" href="#" class="btn btn-warning edit-servicos"><i style="color: white" class="fas fa-edit"></i></a>
                                                <a title="Deletar" data-id="${item.id}" href="#" class="btn btn-danger delete-servicos"><i class="fas fa-trash-alt"></i></a>
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
    $("#formStoreservicos").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();

                    var formData = new FormData($(this)[0]);

                    $.ajax({
                        url: window.location.origin + "/servico/cadastrar",
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            if (data.status == "success") {
                                $("#formStoreservicos").each(function() {
                                    this.reset();
                                });

                                $("#modalStoreservicos").modal("hide");
                                showSuccess("Cadastro efetuado!", null, loadPrincipal);
                            } else if (data.status == "error") {
                                showError(data.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            if (xhr.responseJSON && xhr.responseJSON.status == "error") {
                                showError(xhr.responseJSON.message);
                            } else {
                                showError("Erro desconhecido durante o upload do arquivo.");
                            }
                        }
                    });

                },
            },
        ]);

    });


    // EDIÇÃO
    $("#list").on("click", ".edit-servicos", function(){

        let id = $(this).data('id');
        let usuario = $(this).data('usuario');
        let unidade = $(this).data('unidade');
        let id_parameter_servico = $(this).data('id_parameter_servico');
        let data = $(this).data('data');
        let proxima_data = $(this).data('proxima_data');
        let frequencia_meses = $(this).data('frequencia_meses');

        loadGlobalParameters(7, 'id_parameter_servico_edit', id_parameter_servico);

        $("#id_edit").val(id);
        $("#usuario").val(usuario);
        $("#unidade").val(unidade);
        $("#data_edit").val(data);
        $("#proxima_data_edit").val(proxima_data);
        $("#frequencia_meses_edit").val(frequencia_meses);

        $("#modalEditservicos").modal("show");
    });

    $("#formEditservicos").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.ajax({
                        url: window.location.origin + "/servico/editar",
                        type: 'PUT',
                        data:{
                            id: $("#id_edit").val(),
                            id_parameter_servico: $("#id_parameter_servico_edit option:selected").val(),
                            data: $("#data_edit").val(),
                            proxima_data: $("#proxima_data_edit").val(),
                            frequencia_meses: $("#frequencia_meses_edit").val(),
                            // documento: $("#documento").val(),
                        }
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formEditservicos").each(function () {
                                    this.reset();
                                });

                                $("#modalEditservicos").modal("hide");

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
    $("#list").on("click", ".delete-servicos", function(){

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
                                    url: window.location.origin + "/servico/deletar",
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

    $("#data, #frequencia_meses").change(function (e) {
        e.preventDefault();

        let frequenciaMeses = $("#frequencia_meses option:selected").val();
        let terceiroParametro = frequenciaMeses ? parseInt(frequenciaMeses) : 6;

        preencherProximaData('data', 'proxima_data', terceiroParametro)
    });

    $("#data_edit, #frequencia_meses_edit").change(function (e) {
        e.preventDefault();

        let frequenciaMeses = $("#frequencia_meses_edit option:selected").val();
        let terceiroParametro = frequenciaMeses ? parseInt(frequenciaMeses) : 6;

        preencherProximaData('data_edit', 'proxima_data_edit', terceiroParametro)
    });

});
