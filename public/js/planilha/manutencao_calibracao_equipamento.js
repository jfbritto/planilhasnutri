$(document).ready(function () {

    loadPrincipal();
    loadGlobalParameters(4, 'id_parameter_equipamento', null, false, true, `modalStoremanutencao_calibracao_equipamento`);

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
                    $.get(window.location.origin + "/planilha/manutencao-calibracao-equipamento/listar", {
                        data_ini_filter : $("#data_ini_filter").val(),
                        data_fim_filter : $("#data_fim_filter").val(),
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
                                            <td class="align-middle">${item.equipamento}</td>
                                            <td class="align-middle">${item.calibracao_foi_feita==1?'Sim':'Não'}</td>
                                            <td class="align-middle">${dateFormat(item.data_calibracao)}</td>
                                            <td class="align-middle">${item.equipamento_com_problema==1?'Sim':'Não'}</td>
                                            <td class="align-middle">${item.qual_problema??'-'}</td>
                                            <td class="align-middle">${item.providencias_tomadas}</td>
                                            <td class="align-middle">${item.problema_foi_solucionado==1?'Sim':'Não'}</td>
                                            <td class="align-middle" style="text-align: right; min-width: 160px">
                                                <a title="Editar"
                                                data-id="${item.id}"
                                                data-usuario="${item.usuario}"
                                                data-unidade="${item.unidade}"
                                                data-id_parameter_equipamento="${item.id_parameter_equipamento}"
                                                data-calibracao_foi_feita="${item.calibracao_foi_feita}"
                                                data-data_calibracao="${item.data_calibracao}"
                                                data-equipamento_com_problema="${item.equipamento_com_problema}"
                                                data-qual_problema="${item.qual_problema}"
                                                data-providencias_tomadas="${item.providencias_tomadas}"
                                                data-problema_foi_solucionado="${item.problema_foi_solucionado}"
                                                data-observacoes="${item.observacoes}"
                                                href="#" class="btn btn-warning edit-manutencao_calibracao_equipamento"><i style="color: white" class="fas fa-edit"></i></a>

                                                <a title="Deletar" data-id="${item.id}" href="#" class="btn btn-danger delete-manutencao_calibracao_equipamento"><i class="fas fa-trash-alt"></i></a>
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
    $("#formStoremanutencao_calibracao_equipamento").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();

                    $.post(window.location.origin + "/planilha/manutencao-calibracao-equipamento/cadastrar", {
                        id_parameter_equipamento: $("#id_parameter_equipamento option:selected").val(),
                        calibracao_foi_feita: $("#calibracao_foi_feita option:selected").val(),
                        data_calibracao: $("#data_calibracao").val(),
                        equipamento_com_problema: $("#equipamento_com_problema option:selected").val(),
                        qual_problema: $("#qual_problema").val(),
                        providencias_tomadas: $("#providencias_tomadas").val(),
                        problema_foi_solucionado: $("#problema_foi_solucionado option:selected").val(),
                        observacoes: $("#observacoes").val(),
                    })
                    .then(function (data) {
                        if (data.status == "success") {

                            $("#formStoremanutencao_calibracao_equipamento").each(function () {
                                this.reset();
                            });

                            $("#modalStoremanutencao_calibracao_equipamento").modal("hide");

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
    $("#list").on("click", ".edit-manutencao_calibracao_equipamento", function(){

        let id = $(this).data('id');
        let usuario = $(this).data('usuario');
        let unidade = $(this).data('unidade');

        let id_parameter_equipamento = $(this).data('id_parameter_equipamento');
        let calibracao_foi_feita = $(this).data('calibracao_foi_feita');
        let data_calibracao = $(this).data('data_calibracao');
        let equipamento_com_problema = $(this).data('equipamento_com_problema');
        let qual_problema = $(this).data('qual_problema');
        let providencias_tomadas = $(this).data('providencias_tomadas');
        let problema_foi_solucionado = $(this).data('problema_foi_solucionado');
        let observacoes = $(this).data('observacoes');

        loadGlobalParameters(4, 'id_parameter_equipamento_edit', id_parameter_equipamento, false, true, `modalEditmanutencao_calibracao_equipamento`);

        $("#id_edit").val(id);
        $("#usuario").val(usuario);
        $("#unidade").val(unidade);
        $("#calibracao_foi_feita_edit").val(calibracao_foi_feita);
        $("#data_calibracao_edit").val(data_calibracao);
        $("#equipamento_com_problema_edit").val(equipamento_com_problema);
        $("#qual_problema_edit").val(qual_problema);
        $("#providencias_tomadas_edit").val(providencias_tomadas);
        $("#problema_foi_solucionado_edit").val(problema_foi_solucionado);
        $("#observacoes_edit").val(observacoes);

        $("#modalEditmanutencao_calibracao_equipamento").modal("show");
    });

    $("#formEditmanutencao_calibracao_equipamento").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.ajax({
                        url: window.location.origin + "/planilha/manutencao-calibracao-equipamento/editar",
                        type: 'PUT',
                        data:{
                            id: $("#id_edit").val(),
                            id_parameter_equipamento: $("#id_parameter_equipamento_edit option:selected").val(),
                            calibracao_foi_feita: $("#calibracao_foi_feita_edit option:selected").val(),
                            data_calibracao: $("#data_calibracao_edit").val(),
                            equipamento_com_problema: $("#equipamento_com_problema_edit option:selected").val(),
                            qual_problema: $("#qual_problema_edit").val(),
                            providencias_tomadas: $("#providencias_tomadas_edit").val(),
                            problema_foi_solucionado: $("#problema_foi_solucionado_edit option:selected").val(),
                            observacoes: $("#observacoes_edit").val(),
                        }
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formEditmanutencao_calibracao_equipamento").each(function () {
                                    this.reset();
                                });

                                $("#modalEditmanutencao_calibracao_equipamento").modal("hide");

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
    $("#list").on("click", ".delete-manutencao_calibracao_equipamento", function(){

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
                                    url: window.location.origin + "/planilha/manutencao-calibracao-equipamento/deletar",
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
