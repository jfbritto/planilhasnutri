$(document).ready(function () {

    loadavaliacao_manejo_residuo();

    // LISTAGEM
    function loadavaliacao_manejo_residuo()
    {
        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.get(window.location.origin + "/planilha/avaliacao-manejo-residuo/listar", {

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
                                            <td class="align-middle">${simNao(item.lixeira_apropriada)}</td>
                                            <td class="align-middle">${simNao(item.retirada_conforme)}</td>
                                            <td class="align-middle">${simNao(item.manipuladores_treinados)}</td>
                                            <td class="align-middle">${simNao(item.area_externa_apropriada)}</td>
                                            <td class="align-middle">${simNao(item.residuos_organicos_retirados)}</td>
                                            <td class="align-middle">${simNao(item.area_externa_higienizada)}</td>
                                            <td class="align-middle" style="text-align: right">
                                                <a title="Editar"
                                                data-id="${item.id}"
                                                data-usuario="${item.usuario}"
                                                data-unidade="${item.unidade}"
                                                data-data="${item.data}"
                                                data-lixeira_apropriada="${item.lixeira_apropriada}"
                                                data-retirada_conforme="${item.retirada_conforme}"
                                                data-manipuladores_treinados="${item.manipuladores_treinados}"
                                                data-area_externa_apropriada="${item.area_externa_apropriada}"
                                                data-residuos_organicos_retirados="${item.residuos_organicos_retirados}"
                                                data-area_externa_higienizada="${item.area_externa_higienizada}"
                                                data-observacoes="${item.observacoes}" href="#" class="btn btn-warning edit-avaliacao_manejo_residuo"><i style="color: white" class="fas fa-edit"></i></a>
                                                <a title="Deletar" data-id="${item.id}" href="#" class="btn btn-danger delete-avaliacao_manejo_residuo"><i class="fas fa-trash-alt"></i></a>
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
    $("#formStoreavaliacao_manejo_residuo").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();

                    $.post(window.location.origin + "/planilha/avaliacao-manejo-residuo/cadastrar", {
                        data: $("#data").val(),
                        lixeira_apropriada: $("#lixeira_apropriada option:selected").val(),
                        retirada_conforme: $("#retirada_conforme option:selected").val(),
                        manipuladores_treinados: $("#manipuladores_treinados option:selected").val(),
                        area_externa_apropriada: $("#area_externa_apropriada option:selected").val(),
                        residuos_organicos_retirados: $("#residuos_organicos_retirados option:selected").val(),
                        area_externa_higienizada: $("#area_externa_higienizada option:selected").val(),
                        observacoes: $("#observacoes").val(),
                    })
                    .then(function (data) {
                        if (data.status == "success") {

                            $("#formStoreavaliacao_manejo_residuo").each(function () {
                                this.reset();
                            });

                            $("#modalStoreavaliacao_manejo_residuo").modal("hide");

                            showSuccess("Cadastro efetuado!", null, loadavaliacao_manejo_residuo)
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
    $("#list").on("click", ".edit-avaliacao_manejo_residuo", function(){

        let id = $(this).data('id');
        let usuario = $(this).data('usuario');
        let unidade = $(this).data('unidade');
        let data = $(this).data('data');
        let lixeira_apropriada = $(this).data('lixeira_apropriada');
        let retirada_conforme = $(this).data('retirada_conforme');
        let manipuladores_treinados = $(this).data('manipuladores_treinados');
        let area_externa_apropriada = $(this).data('area_externa_apropriada');
        let residuos_organicos_retirados = $(this).data('residuos_organicos_retirados');
        let area_externa_higienizada = $(this).data('area_externa_higienizada');
        let observacoes = $(this).data('observacoes');

        $("#id_edit").val(id);
        $("#usuario").val(usuario);
        $("#unidade").val(unidade);
        $("#data_edit").val(data);
        $("#lixeira_apropriada_edit").val(lixeira_apropriada);
        $("#retirada_conforme_edit").val(retirada_conforme);
        $("#manipuladores_treinados_edit").val(manipuladores_treinados);
        $("#area_externa_apropriada_edit").val(area_externa_apropriada);
        $("#residuos_organicos_retirados_edit").val(residuos_organicos_retirados);
        $("#area_externa_higienizada_edit").val(area_externa_higienizada);
        $("#observacoes_edit").val(observacoes);

        $("#modalEditavaliacao_manejo_residuo").modal("show");
    });

    $("#formEditavaliacao_manejo_residuo").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.ajax({
                        url: window.location.origin + "/planilha/avaliacao-manejo-residuo/editar",
                        type: 'PUT',
                        data:{
                            id: $("#id_edit").val(),
                            data: $("#data_edit").val(),
                            lixeira_apropriada: $("#lixeira_apropriada_edit option:selected").val(),
                            retirada_conforme: $("#retirada_conforme_edit option:selected").val(),
                            manipuladores_treinados: $("#manipuladores_treinados_edit option:selected").val(),
                            area_externa_apropriada: $("#area_externa_apropriada_edit option:selected").val(),
                            residuos_organicos_retirados: $("#residuos_organicos_retirados_edit option:selected").val(),
                            area_externa_higienizada: $("#area_externa_higienizada_edit option:selected").val(),
                            observacoes: $("#observacoes_edit").val(),
                        }
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formEditavaliacao_manejo_residuo").each(function () {
                                    this.reset();
                                });

                                $("#modalEditavaliacao_manejo_residuo").modal("hide");

                                showSuccess("Edição efetuada!", null, loadavaliacao_manejo_residuo)
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
    $("#list").on("click", ".delete-avaliacao_manejo_residuo", function(){

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
                                    url: window.location.origin + "/planilha/avaliacao-manejo-residuo/deletar",
                                    type: 'DELETE',
                                    data: {id}
                                })
                                    .then(function (data) {
                                        if (data.status == "success") {

                                            showSuccess("Deletado com sucesso!", null, loadavaliacao_manejo_residuo)
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
