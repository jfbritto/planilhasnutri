$(document).ready(function () {

    loadPrincipal();
    loadGlobalParameters(1, 'id_parameter_area');
    loadGlobalParameters(4, 'id_parameter_equipamento');
    loadGlobalParameters(3, 'id_parameter_responsavel');
    loadGlobalParameters(3, 'id_parameter_responsavel_acao');

    // Carregar filtros
    loadGlobalParameters(1, 'id_parameter_area_filter', null, true);
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
                    $.get(window.location.origin + "/planilha/saturacao-oleo-gordura/listar", {
                        data_ini_filter : $("#data_ini_filter").val(),
                        data_fim_filter : $("#data_fim_filter").val(),
                        id_parameter_area_filter : $("#id_parameter_area_filter option:selected").val(),
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
                                            <td class="align-middle">${item.area}/${item.equipamento}</td>
                                            <td class="align-middle">${item.hora_primeira_afericao}</td>
                                            <td class="align-middle">${item.temperatura_primeira_afericao}</td>
                                            <td class="align-middle">${item.leitura_fita}%</td>
                                            <td class="align-middle">${item.situacao_gordura}</td>
                                            <td class="align-middle" style="text-align: right; min-width: 120px">
                                                <a title="Editar"
                                                data-id="${item.id}"
                                                data-usuario="${item.usuario}"
                                                data-unidade="${item.unidade}"
                                                data-data="${item.data}"
                                                data-id_parameter_area="${item.id_parameter_area}"
                                                data-id_parameter_equipamento="${item.id_parameter_equipamento}"
                                                data-hora_primeira_afericao="${item.hora_primeira_afericao}"
                                                data-temperatura_primeira_afericao="${item.temperatura_primeira_afericao}"
                                                data-hora_segunda_afericao="${item.hora_segunda_afericao}"
                                                data-temperatura_segunda_afericao="${item.temperatura_segunda_afericao}"
                                                data-acao_corretiva="${item.acao_corretiva}"
                                                data-id_parameter_responsavel_acao="${item.id_parameter_responsavel_acao}"
                                                data-leitura_fita="${item.leitura_fita}"
                                                data-situacao_gordura="${item.situacao_gordura}"
                                                data-id_parameter_responsavel="${item.id_parameter_responsavel}"
                                                href="#" class="btn btn-warning edit-saturacao_oleo_gordura"><i style="color: white" class="fas fa-edit"></i></a>

                                                <a title="Deletar" data-id="${item.id}" href="#" class="btn btn-danger delete-saturacao_oleo_gordura"><i class="fas fa-trash-alt"></i></a>
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
    $("#formStoresaturacao_oleo_gordura").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();

                    $.post(window.location.origin + "/planilha/saturacao-oleo-gordura/cadastrar", {
                        data: $("#data").val(),
                        id_parameter_area: $("#id_parameter_area option:selected").val(),
                        id_parameter_equipamento: $("#id_parameter_equipamento option:selected").val(),
                        hora_primeira_afericao: $("#hora_primeira_afericao").val(),
                        temperatura_primeira_afericao: $("#temperatura_primeira_afericao").val(),
                        hora_segunda_afericao: $("#hora_segunda_afericao").val(),
                        temperatura_segunda_afericao: $("#temperatura_segunda_afericao").val(),
                        acao_corretiva: $("#acao_corretiva").val(),
                        id_parameter_responsavel_acao: $("#id_parameter_responsavel_acao option:selected").val(),
                        leitura_fita: $("#leitura_fita").val(),
                        situacao_gordura: $("#situacao_gordura option:selected").val(),
                        id_parameter_responsavel: $("#id_parameter_responsavel option:selected").val(),
                    })
                    .then(function (data) {
                        if (data.status == "success") {

                            $("#formStoresaturacao_oleo_gordura").each(function () {
                                this.reset();
                            });

                            $("#modalStoresaturacao_oleo_gordura").modal("hide");

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
    $("#list").on("click", ".edit-saturacao_oleo_gordura", function(){

        let id = $(this).data('id');
        let usuario = $(this).data('usuario');
        let unidade = $(this).data('unidade');

        let data = $(this).data('data');
        let id_parameter_area = $(this).data('id_parameter_area');
        let id_parameter_equipamento = $(this).data('id_parameter_equipamento');
        let hora_primeira_afericao = $(this).data('hora_primeira_afericao');
        let temperatura_primeira_afericao = $(this).data('temperatura_primeira_afericao');
        let hora_segunda_afericao = $(this).data('hora_segunda_afericao');
        let temperatura_segunda_afericao = $(this).data('temperatura_segunda_afericao');
        let acao_corretiva = $(this).data('acao_corretiva');
        let id_parameter_responsavel_acao = $(this).data('id_parameter_responsavel_acao');
        let leitura_fita = $(this).data('leitura_fita');
        let situacao_gordura = $(this).data('situacao_gordura');
        let id_parameter_responsavel = $(this).data('id_parameter_responsavel');

        console.log(temperatura_primeira_afericao)

        loadGlobalParameters(1, 'id_parameter_area_edit', id_parameter_area);
        loadGlobalParameters(4, 'id_parameter_equipamento_edit', id_parameter_equipamento);
        loadGlobalParameters(3, 'id_parameter_responsavel_edit', id_parameter_responsavel);
        loadGlobalParameters(3, 'id_parameter_responsavel_acao_edit', id_parameter_responsavel_acao);

        $("#id_edit").val(id);
        $("#usuario").val(usuario);
        $("#unidade").val(unidade);
        $("#data_edit").val(data);
        $("#hora_primeira_afericao_edit").val(hora_primeira_afericao);
        $("#temperatura_primeira_afericao_edit").val(temperatura_primeira_afericao);
        $("#hora_segunda_afericao_edit").val(hora_segunda_afericao);
        $("#temperatura_segunda_afericao_edit").val(temperatura_segunda_afericao);
        $("#acao_corretiva_edit").val(acao_corretiva);
        $("#leitura_fita_edit").val(leitura_fita);
        $("#situacao_gordura_edit").val(situacao_gordura);

        $("#modalEditsaturacao_oleo_gordura").modal("show");
    });

    $("#formEditsaturacao_oleo_gordura").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.ajax({
                        url: window.location.origin + "/planilha/saturacao-oleo-gordura/editar",
                        type: 'PUT',
                        data:{
                            id: $("#id_edit").val(),
                            data: $("#data_edit").val(),
                            id_parameter_area: $("#id_parameter_area_edit option:selected").val(),
                            id_parameter_equipamento: $("#id_parameter_equipamento_edit option:selected").val(),
                            hora_primeira_afericao: $("#hora_primeira_afericao_edit").val(),
                            temperatura_primeira_afericao: $("#temperatura_primeira_afericao_edit").val(),
                            hora_segunda_afericao: $("#hora_segunda_afericao_edit").val(),
                            temperatura_segunda_afericao: $("#temperatura_segunda_afericao_edit").val(),
                            acao_corretiva: $("#acao_corretiva_edit").val(),
                            id_parameter_responsavel_acao: $("#id_parameter_responsavel_acao_edit option:selected").val(),
                            leitura_fita: $("#leitura_fita_edit").val(),
                            situacao_gordura: $("#situacao_gordura_edit option:selected").val(),
                            id_parameter_responsavel: $("#id_parameter_responsavel_edit option:selected").val(),
                        }
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formEditsaturacao_oleo_gordura").each(function () {
                                    this.reset();
                                });

                                $("#modalEditsaturacao_oleo_gordura").modal("hide");

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
    $("#list").on("click", ".delete-saturacao_oleo_gordura", function(){

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
                                    url: window.location.origin + "/planilha/saturacao-oleo-gordura/deletar",
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
