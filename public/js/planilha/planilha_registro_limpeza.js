$(document).ready(function () {

    loadplanilha_registro_limpeza();
    loadGlobalParameters(7, 'id_parameter_local');
    loadGlobalParameters(3, 'id_parameter_responsavel');

    // LISTAGEM
    function loadplanilha_registro_limpeza()
    {
        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.get(window.location.origin + "/planilha/registro-limpeza/listar", {

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
                                            <td class="align-middle">${item.nome_local}</td>
                                            <td class="align-middle">${item.superficie_limpa}</td>
                                            <td class="align-middle">${item.frequencia}</td>
                                            <td class="align-middle">${item.conforme_naoconforme==1?'Sim':'Não'}</td>
                                            <td class="align-middle">${item.comentarios}</td>
                                            <td class="align-middle">${item.responsavel}</td>
                                            <td class="align-middle" style="text-align: right">
                                                <a title="Editar"
                                                data-id="${item.id}"
                                                data-usuario="${item.usuario}"
                                                data-unidade="${item.unidade}"
                                                data-data="${item.data}"
                                                data-id_parameter_responsavel="${item.id_parameter_responsavel}"
                                                data-id_parameter_local="${item.id_parameter_local}"
                                                data-superficie_limpa="${item.superficie_limpa}"
                                                data-frequencia="${item.frequencia}"
                                                data-conforme_naoconforme="${item.conforme_naoconforme}"
                                                data-comentarios="${item.comentarios}" href="#" class="btn btn-warning edit-planilha_registro_limpeza"><i style="color: white" class="fas fa-edit"></i></a>
                                                <a title="Deletar" data-id="${item.id}" href="#" class="btn btn-danger delete-planilha_registro_limpeza"><i class="fas fa-trash-alt"></i></a>
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
    $("#formStoreplanilha_registro_limpeza").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();

                    $.post(window.location.origin + "/planilha/registro-limpeza/cadastrar", {
                        data: $("#data").val(),
                        id_parameter_responsavel: $("#id_parameter_responsavel option:selected").val(),
                        id_parameter_local: $("#id_parameter_local option:selected").val(),
                        superficie_limpa: $("#superficie_limpa").val(),
                        frequencia: $("#frequencia").val(),
                        conforme_naoconforme: $("#conforme_naoconforme option:selected").val(),
                        comentarios: $("#comentarios").val(),
                    })
                    .then(function (data) {
                        if (data.status == "success") {

                            $("#formStoreplanilha_registro_limpeza").each(function () {
                                this.reset();
                            });

                            $("#modalStoreplanilha_registro_limpeza").modal("hide");

                            showSuccess("Cadastro efetuado!", null, loadplanilha_registro_limpeza)
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
    $("#list").on("click", ".edit-planilha_registro_limpeza", function(){

        let id = $(this).data('id');
        let usuario = $(this).data('usuario');
        let unidade = $(this).data('unidade');
        let data = $(this).data('data');
        let id_parameter_responsavel = $(this).data('id_parameter_responsavel');
        let id_parameter_local = $(this).data('id_parameter_local');
        let superficie_limpa = $(this).data('superficie_limpa');
        let frequencia = $(this).data('frequencia');
        let conforme_naoconforme = $(this).data('conforme_naoconforme');
        let comentarios = $(this).data('comentarios');

        loadGlobalParameters(7, 'id_parameter_local_edit', id_parameter_local);
        loadGlobalParameters(3, 'id_parameter_responsavel_edit', id_parameter_responsavel);

        $("#id_edit").val(id);
        $("#usuario").val(usuario);
        $("#unidade").val(unidade);
        $("#data_edit").val(data);
        $("#superficie_limpa_edit").val(superficie_limpa);
        $("#frequencia_edit").val(frequencia);
        $("#conforme_naoconforme_edit").val(conforme_naoconforme);
        $("#comentarios_edit").val(comentarios);

        $("#modalEditplanilha_registro_limpeza").modal("show");
    });

    $("#formEditplanilha_registro_limpeza").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.ajax({
                        url: window.location.origin + "/planilha/registro-limpeza/editar",
                        type: 'PUT',
                        data:{
                            id: $("#id_edit").val(),
                            data: $("#data_edit").val(),
                            id_parameter_responsavel: $("#id_parameter_responsavel_edit option:selected").val(),
                            id_parameter_local: $("#id_parameter_local_edit option:selected").val(),
                            superficie_limpa: $("#superficie_limpa_edit").val(),
                            frequencia: $("#frequencia_edit").val(),
                            conforme_naoconforme: $("#conforme_naoconforme_edit option:selected").val(),
                            comentarios: $("#comentarios_edit").val(),
                        }
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formEditplanilha_registro_limpeza").each(function () {
                                    this.reset();
                                });

                                $("#modalEditplanilha_registro_limpeza").modal("hide");

                                showSuccess("Edição efetuada!", null, loadplanilha_registro_limpeza)
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
    $("#list").on("click", ".delete-planilha_registro_limpeza", function(){

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
                                    url: window.location.origin + "/planilha/registro-limpeza/deletar",
                                    type: 'DELETE',
                                    data: {id}
                                })
                                    .then(function (data) {
                                        if (data.status == "success") {

                                            showSuccess("Deletado com sucesso!", null, loadplanilha_registro_limpeza)
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
