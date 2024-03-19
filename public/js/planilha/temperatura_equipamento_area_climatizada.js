$(document).ready(function () {

    loadPrincipal();
    loadGlobalParameters(4, 'id_parameter_equipamento', null, false, true, `modalStoretemperatura_equipamento_area_climatizada`);
    loadGlobalParameters(3, 'id_parameter_responsavel', null, false, true, `modalStoretemperatura_equipamento_area_climatizada`);

    loadGlobalParameters(4, 'id_parameter_equipamento_config', null, false, true, `modalConfigurarEquipamentosObrigatorios`);

    // Carregar filtros
    loadGlobalParameters(4, 'id_parameter_equipamento_filter', null, true, false);

    // LISTAGEM
    function loadPrincipal()
    {
        loadEquipamentosFaltantes()

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.get(window.location.origin + "/planilha/temperatura-equipamento-area-climatizada/listar", {
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
                                        <tr class="${item.id_parameter_status_equipamento != null?descricaoStatusEquipamento(item.id_parameter_status_equipamento, true):''}">
                                            <td class="align-middle">${dateFormat(item.data)}</td>
                                            <td class="align-middle">${item.equipamento}</td>
                                            ${item.id_parameter_status_equipamento == null?`
                                                <td class="align-middle"><span style="cursor: pointer" data-toggle="popover" data-content="${configTemperaturaEquipamento(item.maior_que, item.menor_que, item.temperatura_1, true)}" data-trigger="hover"
                                                class="badge badge-pill badge-${configTemperaturaEquipamento(item.maior_que, item.menor_que, item.temperatura_1)}">${item.temperatura_1 ?? ''}${item.temperatura_1 ? '°C':''}</span></td>
                                            `:`
                                                <td class="align-middle">${descricaoStatusEquipamento(item.id_parameter_status_equipamento)}</td>
                                            `}
                                            ${item.id_parameter_status_equipamento == null?`
                                                <td class="align-middle"><span style="cursor: pointer" data-toggle="popover" data-content="${configTemperaturaEquipamento(item.maior_que, item.menor_que, item.temperatura_2, true)}" data-trigger="hover"
                                                class="badge badge-pill badge-${configTemperaturaEquipamento(item.maior_que, item.menor_que, item.temperatura_2)}">${item.temperatura_2 ?? ''}${item.temperatura_2 ? '°C':''}</span></td>
                                            `:`
                                                <td class="align-middle">-</td>
                                            `}
                                            <td class="align-middle" style="text-align: right; min-width: 120px">

                                                ${item.temperatura_2 == null?`
                                                    <a title="Atualizar segunda aferição" data-id="${item.id}" data-id_parameter_equipamento="${item.id_parameter_equipamento}" href="#" class="btn btn-info edit-segunda_temperatura_equipamento"><i style="color: white" class="fa-solid fa-arrows-rotate"></i></a>
                                                `:`
                                                `}

                                                <a title="Editar"
                                                data-id="${item.id}"
                                                data-usuario="${item.usuario}"
                                                data-unidade="${item.unidade}"
                                                data-data="${item.data}"
                                                data-id_parameter_responsavel="${item.id_parameter_responsavel}"
                                                data-id_parameter_equipamento="${item.id_parameter_equipamento}"
                                                data-id_parameter_status_equipamento="${item.id_parameter_status_equipamento}"
                                                data-temperatura_1="${item.temperatura_1}"
                                                data-temperatura_2="${item.temperatura_2}"
                                                href="#" class="btn btn-warning edit-temperatura_equipamento_area_climatizada"><i style="color: white" class="fas fa-edit"></i></a>

                                                <a title="Deletar" data-id="${item.id}" href="#" class="btn btn-danger delete-temperatura_equipamento_area_climatizada"><i class="fas fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                    `);
                                });

                                $('[data-toggle="popover"]').popover();

                            }else{

                                $("#list").append(`
                                    <tr>
                                        <td class="align-middle text-center" colspan="5">Nenhum registro encontrado</td>
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
    $("#formStoretemperatura_equipamento_area_climatizada").submit(function (e) {
        e.preventDefault();

        let dataCadastrada = null;
        let responsavelCadastrado = null;

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();

                    dataCadastrada = $("#data").val();
                    responsavelCadastrado = $("#id_parameter_responsavel option:selected").val();

                    $.post(window.location.origin + "/planilha/temperatura-equipamento-area-climatizada/cadastrar", {
                        data: $("#data").val(),
                        id_parameter_responsavel: $("#id_parameter_responsavel option:selected").val(),
                        id_parameter_equipamento: $("#id_parameter_equipamento option:selected").val(),
                        id_parameter_status_equipamento: $("#id_parameter_status_equipamento option:selected").val(),
                        temperatura_1: $("#temperatura_1").val(),
                        temperatura_2: $("#temperatura_2").val(),
                    })
                    .then(function (data) {
                        if (data.status == "success") {

                            $("#formStoretemperatura_equipamento_area_climatizada").each(function () {
                                this.reset();
                            });
                            $(".selecao-customizada").val(null).trigger("change");

                            atualizarDataAtual(dataCadastrada)
                            loadGlobalParameters(3, 'id_parameter_responsavel', responsavelCadastrado, false, true, `modalStoretemperatura_equipamento_area_climatizada`);

                            if (!$("#checkCadastrarOutro").prop("checked")) {
                                $("#modalStoretemperatura_equipamento_area_climatizada").modal("hide");
                            }

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


    // EDIÇÃO SEGUNDA AFERIÇÃO
    $("#list").on("click", ".edit-segunda_temperatura_equipamento", function(){

        let id = $(this).data('id');
        $("#id_edit_2").val(id);

        let id_parameter_equipamento = $(this).data('id_parameter_equipamento');
        loadGlobalParameters(4, 'id_parameter_equipamento_edit_2', id_parameter_equipamento, false, true, `modalEditsegunda_temperatura_equipamento`);

        $("#modalEditsegunda_temperatura_equipamento").modal("show");
    });

    $("#formEditsegunda_temperatura_equipamento").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.ajax({
                        url: window.location.origin + "/planilha/temperatura-equipamento-area-climatizada/editar",
                        type: 'PUT',
                        data:{
                            id: $("#id_edit_2").val(),
                            temperatura_2: $("#temperatura_2_edit_2").val(),
                            only_2: true
                        }
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formEditsegunda_temperatura_equipamento").each(function () {
                                    this.reset();
                                });

                                $("#modalEditsegunda_temperatura_equipamento").modal("hide");

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

    // EDIÇÃO
    $("#list").on("click", ".edit-temperatura_equipamento_area_climatizada", function(){

        let id = $(this).data('id');
        let usuario = $(this).data('usuario');
        let unidade = $(this).data('unidade');

        let data = $(this).data('data');
        let id_parameter_responsavel = $(this).data('id_parameter_responsavel');
        let id_parameter_equipamento = $(this).data('id_parameter_equipamento');
        let id_parameter_status_equipamento = $(this).data('id_parameter_status_equipamento');
        let temperatura_1 = $(this).data('temperatura_1');
        let temperatura_2 = $(this).data('temperatura_2');

        loadGlobalParameters(4, 'id_parameter_equipamento_edit', id_parameter_equipamento, false, true, `modalEdittemperatura_equipamento_area_climatizada`);
        loadGlobalParameters(3, 'id_parameter_responsavel_edit', id_parameter_responsavel, false, true, `modalEdittemperatura_equipamento_area_climatizada`);

        $("#id_edit").val(id);
        $("#usuario").val(usuario);
        $("#unidade").val(unidade);
        $("#data_edit").val(data);
        $("#id_parameter_status_equipamento_edit").val(id_parameter_status_equipamento);
        $("#temperatura_1_edit").val(temperatura_1);
        $("#temperatura_2_edit").val(temperatura_2);

        $("#modalEdittemperatura_equipamento_area_climatizada").modal("show");
    });

    $("#formEdittemperatura_equipamento_area_climatizada").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.ajax({
                        url: window.location.origin + "/planilha/temperatura-equipamento-area-climatizada/editar",
                        type: 'PUT',
                        data:{
                            id: $("#id_edit").val(),
                            data: $("#data_edit").val(),
                            id_parameter_responsavel: $("#id_parameter_responsavel_edit option:selected").val(),
                            id_parameter_equipamento: $("#id_parameter_equipamento_edit option:selected").val(),
                            id_parameter_status_equipamento: $("#id_parameter_status_equipamento_edit option:selected").val(),
                            temperatura_1: $("#temperatura_1_edit").val(),
                            temperatura_2: $("#temperatura_2_edit").val(),
                        }
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formEdittemperatura_equipamento_area_climatizada").each(function () {
                                    this.reset();
                                });

                                $("#modalEdittemperatura_equipamento_area_climatizada").modal("hide");

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
    $("#list").on("click", ".delete-temperatura_equipamento_area_climatizada", function(){

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
                                    url: window.location.origin + "/planilha/temperatura-equipamento-area-climatizada/deletar",
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

    // ao clicar no botão de editar os equipamentos obrigatorios
    $("#abrirConfig").click(function(){
        $(".selecao-customizada").val(null).trigger("change");
        loadConfigs()
        $("#modalConfigurarEquipamentosObrigatorios").modal('show');
    })

    $("#id_parameter_equipamento, #data").change(function(){

        let equipamento = $("#id_parameter_equipamento").val();
        let equipamentoText = $("#id_parameter_equipamento option:selected").text();
        let data_cadastro = $("#data").val();


        if (equipamento != '') {
            $.get(window.location.origin + "/planilha/temperatura-equipamento-area-climatizada/listar", {
                data_ini_filter : data_cadastro,
                data_fim_filter : data_cadastro,
                id_parameter_equipamento_filter : equipamento,
            })
            .then(function (data) {
                if (data.status == "success") {
                    if (data.data.length > 0){
                        showWarning(`Já existe um registro do equipamento ${equipamentoText} em ${dateFormat(data_cadastro)}!`)
                    }
                } else if (data.status == "error") {
                    showError(data.message)
                }
            })
            .catch(function (data) {

            });
        }
    })


    // CADASTRO
    $("#formConfigurarEquipamentosObrigatorios").submit(function (e) {
        e.preventDefault();

        let dataCadastrada = null;
        let responsavelCadastrado = null;

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();

                    dataCadastrada = $("#data").val();
                    responsavelCadastrado = $("#id_parameter_responsavel option:selected").val();

                    $.post(window.location.origin + "/planilha/temperatura-equipamento-area-climatizada-config/cadastrar", {
                        id_parameter_equipamento: $("#id_parameter_equipamento_config option:selected").val(),
                        maior_que: $("#maior_que").val(),
                        menor_que: $("#menor_que").val(),
                        obrigatorio: $("#obrigatorio").is(':checked')?1:0,
                    })
                    .then(function (data) {
                        if (data.status == "success") {

                            $("#formConfigurarEquipamentosObrigatorios").each(function () {
                                this.reset();
                            });
                            $(".selecao-customizada").val(null).trigger("change");

                            loadGlobalParameters(4, 'id_parameter_equipamento_config', null, false, true, `modalConfigurarEquipamentosObrigatorios`);
                            loadConfigs()
                            loadEquipamentosFaltantes()

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

    // LISTAGEM EQUIPAMENTOS OBRIGATÓRIOS
    function loadConfigs()
    {
        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.get(window.location.origin + "/planilha/temperatura-equipamento-area-climatizada-config/listar", {

                    })
                    .then(function (data) {
                        if (data.status == "success") {

                            Swal.close();
                            $("#list2").html(``);

                            if(data.data.length > 0){

                                data.data.forEach(item => {

                                    $("#list2").append(`
                                        <tr>
                                            <td class="align-middle">${item.equipamento}</td>
                                            <td class="align-middle">${item.maior_que ?? ''}</td>
                                            <td class="align-middle">${item.menor_que ?? ''}</td>
                                            <td class="align-middle">${item.obrigatorio==1?'Sim':'Não'}</td>
                                            <td class="align-middle" style="text-align: right; min-width: 120px">
                                                <a title="Deletar" data-id="${item.id}" href="#" class="btn btn-warning edit-config"
                                                    data-id_parameter_equipamento="${item.id_parameter_equipamento}"
                                                    data-menor_que="${item.menor_que}"
                                                    data-maior_que="${item.maior_que}"
                                                    data-obrigatorio="${item.obrigatorio}"
                                                ><i style="color: white" class="fas fa-edit"></i></a>
                                                <a title="Deletar" data-id="${item.id}" href="#" class="btn btn-danger delete-config"><i class="fas fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                    `);
                                });

                            }else{

                                $("#list2").append(`
                                    <tr>
                                        <td class="align-middle text-center" colspan="5">Nenhum registro encontrado</td>
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

    // EDIÇÃO SEGUNDA AFERIÇÃO
    $("#list2").on("click", ".edit-config", function(){

        let id = $(this).data('id');
        let id_parameter_equipamento = $(this).data('id_parameter_equipamento');
        let menor_que = $(this).data('menor_que');
        let maior_que = $(this).data('maior_que');
        let obrigatorio = $(this).data('obrigatorio');

        $("#id_config_edit").val(id);
        $("#menor_que_edit").val(menor_que);
        $("#maior_que_edit").val(maior_que);

        $('#obrigatorio_edit').prop('checked', false);
        if (obrigatorio) {
            $('#obrigatorio_edit').prop('checked', true);
        }

        loadGlobalParameters(4, 'id_parameter_equipamento_config_edit', id_parameter_equipamento, false, true, `modalConfigurarEquipamentosObrigatoriosEdit`);

        $("#modalConfigurarEquipamentosObrigatoriosEdit").modal("show");
    });

    $("#formConfigurarEquipamentosObrigatoriosEdit").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.ajax({
                        url: window.location.origin + "/planilha/temperatura-equipamento-area-climatizada-config/editar",
                        type: 'PUT',
                        data:{
                            id: $("#id_config_edit").val(),
                            maior_que: $("#maior_que_edit").val(),
                            menor_que: $("#menor_que_edit").val(),
                            obrigatorio: $("#obrigatorio_edit").is(':checked')?1:0,
                        }
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formConfigurarEquipamentosObrigatoriosEdit").each(function () {
                                    this.reset();
                                });

                                $("#modalConfigurarEquipamentosObrigatoriosEdit").modal("hide");
                                loadEquipamentosFaltantes()
                                loadPrincipal()
                                showSuccess("Edição efetuada!", null, loadConfigs)
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

    // "DELETAR" CONFIG
    $("#list2").on("click", ".delete-config", function(){

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
                                    url: window.location.origin + "/planilha/temperatura-equipamento-area-climatizada-config/deletar",
                                    type: 'DELETE',
                                    data: {id}
                                })
                                    .then(function (data) {
                                        if (data.status == "success") {

                                            loadEquipamentosFaltantes()
                                            showSuccess("Deletado com sucesso!", null, loadConfigs)
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

    $("#id_parameter_equipamento_config").change(function(){

        let equipamento = $("#id_parameter_equipamento_config").val();
        let equipamentoText = $("#id_parameter_equipamento_config option:selected").text();


        if (equipamento != '') {
            $.get(window.location.origin + "/planilha/temperatura-equipamento-area-climatizada-config/listar", {
                id_parameter_equipamento_filter : equipamento,
            })
            .then(function (data) {
                if (data.status == "success") {
                    if (data.data.length > 0){
                        showWarning(`Já existe um registro de config para o equipamento ${equipamentoText}!`)
                    }
                } else if (data.status == "error") {
                    showError(data.message)
                }
            })
            .catch(function (data) {

            });
        }
    })

    // LISTAGEM EQUIPAMENTOS OBRIGATÓRIOS QUE AINDA ESTÃO PENDENTES DE CADASTRO
    function loadEquipamentosFaltantes()
    {

        $.get(window.location.origin + "/planilha/temperatura-equipamento-area-climatizada-config/obrigatorios-nao-preenchidos", {

        })
        .then(function (data) {

            if (data.status == "success") {
                if(data.data.data){
                    $("#listaEquipamentosFaltantes").html(data.data.data);
                    $("#boxEquipamentosFaltantes").show();
                }else{
                    $("#boxEquipamentosFaltantes").hide();
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

    }



    //VALIDANDO TEMPERATURA IDEAL
    $("#temperatura_1, #temperatura_2, #id_parameter_equipamento").change(function(){

        let temperatura = $(this).val();
        let equipamento = $("#id_parameter_equipamento_config option:selected").val();

        if (equipamento != '') {
            $.get(window.location.origin + "/planilha/temperatura-equipamento-area-climatizada-config/listar", {
                id_parameter_equipamento_filter : equipamento,
            })
            .then(function (data) {
                if (data.status == "success") {
                    if (data.data.length > 0){
                        showWarning(`Já existe um registro de config para o equipamento ${equipamentoText}!`)
                    }
                } else if (data.status == "error") {
                    showError(data.message)
                }
            })
            .catch(function (data) {

            });
        }
    })


});
