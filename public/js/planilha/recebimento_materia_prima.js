$(document).ready(function () {

    loadPrincipal();
    loadGlobalParameters(8, 'id_parameter_produto');
    loadGlobalParameters(3, 'id_parameter_responsavel');
    loadGlobalParameters(10, 'id_parameter_fornecedor');

    // Carregar filtros
    loadGlobalParameters(8, 'id_parameter_produto_filter', null, true, false);
    loadGlobalParameters(10, 'id_parameter_fornecedor_filter', null, true, false);

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
                    $.get(window.location.origin + "/planilha/recebimento-materia-prima/listar", {
                        id_parameter_produto_filter : $("#id_parameter_produto_filter option:selected").val(),
                        id_parameter_fornecedor_filter : $("#id_parameter_fornecedor_filter option:selected").val(),
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
                                            <td class="align-middle">${item.fornecedor}</td>
                                            <td class="align-middle">${item.nota_fiscal}</td>
                                            <td class="align-middle">${dateFormat(item.data_validade)}</td>
                                            <td class="align-middle">${item.responsavel}</td>
                                            <td class="align-middle" style="text-align: right; min-width: 120px">
                                                <a title="Editar"
                                                data-id="${item.id}"
                                                data-usuario="${item.usuario}"
                                                data-unidade="${item.unidade}"
                                                data-data="${item.data}"
                                                data-id_parameter_produto="${item.id_parameter_produto}"
                                                data-id_parameter_fornecedor="${item.id_parameter_fornecedor}"
                                                data-ordem_de_compra="${item.ordem_de_compra}"
                                                data-nota_fiscal="${item.nota_fiscal}"
                                                data-sif_lote="${item.sif_lote}"
                                                data-data_validade="${item.data_validade}"
                                                data-temperatura_alimento="${item.temperatura_alimento}"
                                                data-temperatura_veiculo="${item.temperatura_veiculo}"
                                                data-nao_conformidade="${item.nao_conformidade}"
                                                data-acao_corretiva="${item.acao_corretiva}"
                                                data-id_parameter_responsavel="${item.id_parameter_responsavel}" href="#" class="btn btn-warning edit-recebimento_materia_prima"><i style="color: white" class="fas fa-edit"></i></a>
                                                <a title="Deletar" data-id="${item.id}" href="#" class="btn btn-danger delete-recebimento_materia_prima"><i class="fas fa-trash-alt"></i></a>
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
    $("#formStorerecebimento_materia_prima").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();

                    $.post(window.location.origin + "/planilha/recebimento-materia-prima/cadastrar", {
                        data: $("#data").val(),
                        id_parameter_produto: $("#id_parameter_produto option:selected").val(),
                        id_parameter_fornecedor: $("#id_parameter_fornecedor option:selected").val(),
                        ordem_de_compra: $("#ordem_de_compra").val(),
                        nota_fiscal: $("#nota_fiscal").val(),
                        sif_lote: $("#sif_lote").val(),
                        data_validade: $("#data_validade").val(),
                        temperatura_alimento: $("#temperatura_alimento").val(),
                        temperatura_veiculo: $("#temperatura_veiculo").val(),
                        nao_conformidade: $("#nao_conformidade").val(),
                        acao_corretiva: $("#acao_corretiva").val(),
                        id_parameter_responsavel: $("#id_parameter_responsavel option:selected").val(),
                    })
                    .then(function (data) {
                        if (data.status == "success") {

                            $("#formStorerecebimento_materia_prima").each(function () {
                                this.reset();
                            });

                            $("#modalStorerecebimento_materia_prima").modal("hide");

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
    $("#list").on("click", ".edit-recebimento_materia_prima", function(){

        let id = $(this).data('id');
        let usuario = $(this).data('usuario');
        let unidade = $(this).data('unidade');
        let data = $(this).data('data');
        let id_parameter_produto = $(this).data('id_parameter_produto');
        let id_parameter_fornecedor = $(this).data('id_parameter_fornecedor');
        let ordem_de_compra = $(this).data('ordem_de_compra');
        let nota_fiscal = $(this).data('nota_fiscal');
        let sif_lote = $(this).data('sif_lote');
        let data_validade = $(this).data('data_validade');
        let temperatura_alimento = $(this).data('temperatura_alimento');
        let temperatura_veiculo = $(this).data('temperatura_veiculo');
        let nao_conformidade = $(this).data('nao_conformidade');
        let acao_corretiva = $(this).data('acao_corretiva');
        let id_parameter_responsavel = $(this).data('id_parameter_responsavel');

        loadGlobalParameters(8, 'id_parameter_produto_edit', id_parameter_produto);
        loadGlobalParameters(10, 'id_parameter_fornecedor_edit', id_parameter_fornecedor);
        loadGlobalParameters(3, 'id_parameter_responsavel_edit', id_parameter_responsavel);

        $("#id_edit").val(id);
        $("#usuario").val(usuario);
        $("#unidade").val(unidade);
        $("#data_edit").val(data);
        $("#ordem_de_compra_edit").val(ordem_de_compra);
        $("#nota_fiscal_edit").val(nota_fiscal);
        $("#sif_lote_edit").val(sif_lote);
        $("#data_validade_edit").val(data_validade);
        $("#temperatura_alimento_edit").val(temperatura_alimento);
        $("#temperatura_veiculo_edit").val(temperatura_veiculo);
        $("#nao_conformidade_edit").val(nao_conformidade);
        $("#acao_corretiva_edit").val(acao_corretiva);

        $("#modalEditrecebimento_materia_prima").modal("show");
    });

    $("#formEditrecebimento_materia_prima").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.ajax({
                        url: window.location.origin + "/planilha/recebimento-materia-prima/editar",
                        type: 'PUT',
                        data:{
                            id: $("#id_edit").val(),
                            data: $("#data_edit").val(),
                            id_parameter_produto: $("#id_parameter_produto_edit option:selected").val(),
                            id_parameter_fornecedor: $("#id_parameter_fornecedor_edit option:selected").val(),
                            ordem_de_compra: $("#ordem_de_compra_edit").val(),
                            nota_fiscal: $("#nota_fiscal_edit").val(),
                            sif_lote: $("#sif_lote_edit").val(),
                            data_validade: $("#data_validade_edit").val(),
                            temperatura_alimento: $("#temperatura_alimento_edit").val(),
                            temperatura_veiculo: $("#temperatura_veiculo_edit").val(),
                            nao_conformidade: $("#nao_conformidade_edit").val(),
                            acao_corretiva: $("#acao_corretiva_edit").val(),
                            id_parameter_responsavel: $("#id_parameter_responsavel_edit option:selected").val(),
                        }
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formEditrecebimento_materia_prima").each(function () {
                                    this.reset();
                                });

                                $("#modalEditrecebimento_materia_prima").modal("hide");

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
    $("#list").on("click", ".delete-recebimento_materia_prima", function(){

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
                                    url: window.location.origin + "/planilha/recebimento-materia-prima/deletar",
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
