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
                        status_filter : $("#status_filter option:selected").val(),
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
                                            <td class="align-middle elemento-esconder-celular">${frequencia(item.frequencia_meses)}</td>
                                            <td class="align-middle elemento-esconder-celular">${dateFormat(item.data)}</td>
                                            <td class="align-middle elemento-esconder-celular">${dateFormat(item.proxima_data)}</td>
                                            <td class="align-middle text-center">
                                            ${item.files!=''&&item.files!=null?`
                                                <a href="#" title="Exibir documentos" class="exibir-documentos" data-id="${item.id}"><i class="fa-solid fa-file fa-xl"></i></a>
                                            `:`
                                                <a href="#" title="Adicionar documentos" class="adicionar-documentos" data-id="${item.id}"><i class="fa-solid fa-plus fa-xl"></i></a>
                                            `}
                                            </td>
                                            <td class="align-middle overflow-visible-btn" style="text-align: right; min-width: 120px">
                                                <div class="btn-group" role="group" aria-label="...">
                                                    ${item.status == 'C' ?'':`
                                                        <a title="Concluir" data-id="${item.id}" href="#" class="btn btn-success concluir-servicos"><i class="fas fa-check"></i></a>
                                                    `}
                                                    <a title="Editar"
                                                    data-id="${item.id}"
                                                    data-usuario="${item.usuario}"
                                                    data-unidade="${item.unidade}"
                                                    data-id_parameter_servico="${item.id_parameter_servico}"
                                                    data-data="${item.data}"
                                                    data-proxima_data="${item.proxima_data}"
                                                    data-frequencia_meses="${item.frequencia_meses}"
                                                    data-observacoes="${item.observacoes}"
                                                    data-documento="${item.documento}" href="#" class="btn btn-warning edit-servicos"><i style="color: white" class="fas fa-edit"></i></a>
                                                    <a title="Deletar" data-id="${item.id}" href="#" class="btn btn-danger delete-servicos"><i class="fas fa-trash-alt"></i></a>
                                                </div>
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
    const form = document.getElementById('formStoreservicos');
    form.addEventListener('submit', async function (event) {
        event.preventDefault();

        const documento = document.getElementById('documento');
        const id_parameter_servico = $("#id_parameter_servico option:selected").val()
        const frequencia_meses = $("#frequencia_meses option:selected").val()
        const data = document.getElementById('data').value;
        const proxima_data = document.getElementById('proxima_data').value;
        const observacoes = document.getElementById('observacoes').value;

        const file = documento.files[0];
        const maxWidth = 1000;
        const maxHeight = 800;
        const qualidade = 0.7; // Qualidade de 0 a 1

        if (file == undefined) {
            await salvarArquivoNoServidor(file, id_parameter_servico, frequencia_meses, data, proxima_data, observacoes, 3);
        } else {
            try {
                if (file.type.startsWith('image/')) {
                    const novaFoto = await reduzirTamanhoFoto(file, maxWidth, maxHeight, qualidade);
                    await salvarArquivoNoServidor(novaFoto, id_parameter_servico, frequencia_meses, data, proxima_data, observacoes, 1);
                } else {
                    await salvarArquivoNoServidor(file, id_parameter_servico, frequencia_meses, data, proxima_data, observacoes, 2);
                }
            } catch (error) {
                console.error('Erro ao processar o envio do formulário:', error);
            }
        }
    });

    async function reduzirTamanhoFoto(file, maxWidth, maxHeight, qualidade) {
        return new Promise((resolve, reject) => {
            const reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = function (event) {
                const img = new Image();
                img.src = event.target.result;
                img.onload = function () {
                    const canvas = document.createElement('canvas');
                    let width = img.width;
                    let height = img.height;

                    if (width > height) {
                        if (width > maxWidth) {
                            height *= maxWidth / width;
                            width = maxWidth;
                        }
                    } else {
                        if (height > maxHeight) {
                            width *= maxHeight / height;
                            height = maxHeight;
                        }
                    }

                    canvas.width = width;
                    canvas.height = height;

                    const ctx = canvas.getContext('2d');
                    ctx.drawImage(img, 0, 0, width, height);

                    canvas.toBlob((blob) => {
                        resolve(blob);
                    }, file.type, qualidade);
                };
                img.onerror = function (error) {
                    reject(error);
                };
            };
            reader.onerror = function (error) {
                reject(error);
            };
        });
    }

    async function salvarArquivoNoServidor(blob, id_parameter_servico, frequencia_meses, data, proxima_data, observacoes, tipo) {
        const formData = new FormData();

        if (tipo == 1) {
            formData.append('documento', blob, 'nome_arquivo.jpg');
        } else if (tipo == 2){
            formData.append('documento', blob);
        }

        formData.append('id_parameter_servico', id_parameter_servico);
        formData.append('frequencia_meses', frequencia_meses);
        formData.append('data', data);
        formData.append('proxima_data', proxima_data);
        formData.append('observacoes', observacoes);

        try {

            Swal.queue([
                {
                    title: "Carregando...",
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    onOpen: () => {
                        Swal.showLoading();

                    },
                },
            ]);

            const response = await fetch(window.location.origin + "/servico/cadastrar", {
                method: 'POST',
                body: formData
            });
            if (!response.ok) {
                showError('Erro ao enviar arquivo para o servidor');
            }

            $("#formStoreservicos").each(function() {
                this.reset();
            });
            atualizarDataAtual(data)
            $(".selecao-customizada")[0].tomselect.clear();
            $("#modalStoreservicos").modal("hide");
            showSuccess("Cadastro efetuado!", null, loadPrincipal);
        } catch (error) {
            console.error('Erro ao salvar arquivo no servidor:', error);
        }
    }

    // MODAL DOCUMENTOS
    $("#list").on("click", ".exibir-documentos", function(){

        let id = $(this).data('id');

        $("#id_plan").val(id)

        $("#lista_docs").html(``);

        $.get(window.location.origin + "/documentos/listar", {
            id:id, planilha_base:20
        })
        .then(function (data) {
            if (data.status == "success") {

                Swal.close();
                let extensao = ''

                if (data.data.length > 0) {

                    data.data.forEach(item => {
                        extensao = ''
                        extensao = detectarExtensaoArquivo(item.file)

                        $("#lista_docs").append(`
                            <div class="col-sm-4">
                                <div class="alert alert-secondary alert-dismissible fade show" role="alert">
                                    <a href="documento/download/${item.file}" title="Baixar arquivo" target="_blank">
                                        ${extensao == 'image'?`
                                            <img style="width:100vh" src="/storage/documentos/${item.id_unit}/${item.file}" alt="Foto" class="img-thumbnail img-responsive">
                                        `:`
                                            <i class="fa fa-file-${extensao} fa-5x" aria-hidden="true"></i>
                                        `}
                                    </a>
                                    <button type="button" class="close deletar-documento" data-toggle="tooltip" data-placement="top" title="Deletar" data-id="${item.id}">
                                        <span aria-hidden="true">
                                            <i class="fas fa-trash-alt"></i>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        `);
                    });

                } else {

                    $("#lista_docs").append(`
                        Nenhum arquivo cadastrado
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

        $("#modalExibirDocumentos").modal("show");
    });

    $("#list").on("click", ".adicionar-documentos", function(){

        let id = $(this).data('id');
        $("#id_plan").val(id)

        $("#modalCadastrarDocumento").modal("show");

    })

    $("#adicionar-documentos").on("click", function(){

        $("#modalCadastrarDocumento").modal("show");

    })

    // CADASTRO
    const formDoc = document.getElementById('formStoreDoc');
    formDoc.addEventListener('submit', async function (event) {
        event.preventDefault();

        const documento = document.getElementById('documento_avulso');
        const id_plan = document.getElementById('id_plan').value;

        const file = documento.files[0];
        const maxWidth = 1000;
        const maxHeight = 800;
        const qualidade = 0.7; // Qualidade de 0 a 1

        if (file == undefined) {
            await salvarArquivoUnicoNoServidor(file, id_plan, 3);
        } else {
            try {
                if (file.type.startsWith('image/')) {
                    const novaFoto = await reduzirTamanhoFoto(file, maxWidth, maxHeight, qualidade);
                    await salvarArquivoUnicoNoServidor(novaFoto, id_plan, 1);
                } else {
                    await salvarArquivoUnicoNoServidor(file, id_plan, 2);
                }
            } catch (error) {
                console.error('Erro ao processar o envio do formulário:', error);
            }
        }
    });

    async function salvarArquivoUnicoNoServidor(blob, id_plan, tipo) {
        const formData = new FormData();

        if (tipo == 1) {
            formData.append('documento', blob, 'nome_arquivo.jpg');
        } else if (tipo == 2){
            formData.append('documento', blob);
        }

        formData.append('id_planilha', id_plan);
        formData.append('planilha_base', 20);

        try {

            Swal.queue([
                {
                    title: "Carregando...",
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    onOpen: () => {
                        Swal.showLoading();

                    },
                },
            ]);

            const response = await fetch(window.location.origin + "/documento/cadastrar-avulso", {
                method: 'POST',
                body: formData
            });
            if (!response.ok) {
                showError('Erro ao enviar arquivo para o servidor');
            }

            $("#formStoreDoc").each(function() {
                this.reset();
            });
            $("#modalCadastrarDocumento").modal("hide");
            $("#modalExibirDocumentos").modal("hide");
            showSuccess("Cadastro efetuado!", null, loadPrincipal);
        } catch (error) {
            console.error('Erro ao salvar arquivo no servidor:', error);
        }
    }


    // "DELETAR DOCUMENTO"
    $("#lista_docs").on("click", ".deletar-documento", function(){

        let id_especifico = $(this).data('id');
        let planilha_base = 20

        Swal.fire({
            title: 'Atenção!',
            text: "Deseja realmente deletar o documento?",
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
                                    url: window.location.origin + "/documento/deletar",
                                    type: 'DELETE',
                                    data: {id_especifico,planilha_base}
                                })
                                    .then(function (data) {
                                        if (data.status == "success") {

                                            $("#modalExibirDocumentos").modal("hide");

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

    // EDIÇÃO
    $("#list").on("click", ".edit-servicos", function(){

        let id = $(this).data('id');
        let usuario = $(this).data('usuario');
        let unidade = $(this).data('unidade');
        let id_parameter_servico = $(this).data('id_parameter_servico');
        let data = $(this).data('data');
        let proxima_data = $(this).data('proxima_data');
        let frequencia_meses = $(this).data('frequencia_meses');
        let observacoes = $(this).data('observacoes');

        loadGlobalParameters(7, 'id_parameter_servico_edit', id_parameter_servico, false, true, `modalEditservicos`);

        $("#id_edit").val(id);
        $("#usuario").val(usuario);
        $("#unidade").val(unidade);
        $("#data_edit").val(data);
        $("#proxima_data_edit").val(proxima_data);
        $("#frequencia_meses_edit").val(frequencia_meses);
        $("#observacoes_edit").val(observacoes);

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
                            observacoes: $("#observacoes_edit").val(),
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

    // "CONCLUIR"
    $("#list").on("click", ".concluir-servicos", function(){

        let id = $(this).data('id');

        Swal.fire({
            title: 'Atenção!',
            text: "Deseja marcar o serviço como concluído?",
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
                                    url: window.location.origin + "/servico/concluir",
                                    type: 'PUT',
                                    data: {id}
                                })
                                    .then(function (data) {
                                        if (data.status == "success") {

                                            showSuccess("Concluído com sucesso!", null, loadPrincipal)
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
