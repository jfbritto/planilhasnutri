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
                                            <td class="align-middle text-center">
                                            ${item.files!=''&&item.files!=null?`
                                                <a href="#" title="Exibir documentos" class="exibir-documentos" data-id="${item.id}"><i class="fa-solid fa-file fa-xl"></i></a>
                                            `:`
                                                <a href="#" title="Adicionar documentos" class="adicionar-documentos" data-id="${item.id}"><i class="fa-solid fa-plus fa-xl"></i></a>
                                            `}
                                            </td>
                                            <td class="align-middle" style="text-align: right; min-width: 120px">
                                                <div class="btn-group" role="group" aria-label="...">
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
                                                </div>
                                            </td>
                                        </tr>
                                    `);
                                });

                            }else{

                                $("#list").append(`
                                    <tr>
                                        <td class="align-middle text-center" colspan="4">Nenhum registro encontrado</td>
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
    const form = document.getElementById('formStorerastreabilidade_diaria');
    form.addEventListener('submit', async function (event) {
        event.preventDefault();

        const image = document.getElementById('image');
        const lote = document.getElementById('lote').value;
        const id_parameter_produto = $("#id_parameter_produto option:selected").val()
        const data = document.getElementById('data').value;
        const validade = document.getElementById('validade').value;
        const id_parameter_fabricante = $("#id_parameter_fabricante option:selected").val()

        const file = image.files[0];
        const maxWidth = 1000;
        const maxHeight = 800;
        const qualidade = 0.7; // Qualidade de 0 a 1

        if (file == undefined) {
            await salvarArquivoNoServidor(file, lote, id_parameter_produto, data, validade, id_parameter_fabricante, 3);
        } else {
            try {
                if (file.type.startsWith('image/')) {
                    const novaFoto = await reduzirTamanhoFoto(file, maxWidth, maxHeight, qualidade);
                    await salvarArquivoNoServidor(novaFoto, lote, id_parameter_produto, data, validade, id_parameter_fabricante, 1);
                } else {
                    await salvarArquivoNoServidor(file, lote, id_parameter_produto, data, validade, id_parameter_fabricante, 2);
                }
            } catch (error) {
                showError('Erro ao processar o envio do formulário');
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

    async function salvarArquivoNoServidor(blob, lote = '', id_parameter_produto, data, validade = '', id_parameter_fabricante, tipo) {
        const formData = new FormData();

        console.log(lote, id_parameter_produto, data, validade, id_parameter_fabricante);

        if (tipo == 1) {
            formData.append('image', blob, 'nome_arquivo.jpg');
        } else if (tipo == 2){
            formData.append('image', blob);
        }

        formData.append('lote', lote);
        formData.append('id_parameter_produto', id_parameter_produto);
        formData.append('data', data);
        formData.append('validade', validade);
        formData.append('id_parameter_fabricante', id_parameter_fabricante);

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

            const response = await fetch(window.location.origin + "/planilha/rastreabilidade-diaria/cadastrar", {
                method: 'POST',
                body: formData
            });
            if (!response.ok) {
                showError('Erro ao enviar arquivo para o servidor');
            }

            $("#formStorerastreabilidade_diaria").each(function() {
                this.reset();
            });

            $(".selecao-customizada").val(null).trigger("change");

            atualizarDataAtual()

            if (!$("#checkCadastrarOutro").prop("checked")) {
                $("#modalStorerastreabilidade_diaria").modal("hide");
            }

            loadGlobalParameters(8, 'id_parameter_produto', null, false, true, `modalStorerastreabilidade_diaria`);
            loadGlobalParameters(13, 'id_parameter_fabricante', null, false, true, `modalStorerastreabilidade_diaria`);

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
            id:id, planilha_base:19
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
        formData.append('planilha_base', 19);

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
        let planilha_base = 19

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
