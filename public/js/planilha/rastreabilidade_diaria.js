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
                                            <td class="align-middle">
                                            ${item.image != '' ? `
                                                <a href="rastreabilidade-diaria/download/${item.image}" title="Baixar arquivo" target="_blank"><i class="fa-solid fa-file-${detectarExtensaoArquivo(item.image)} fa-xl"></i></a>
                                            `:``}
                                            </td>
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
            await salvarArquivoNoServidor('', lote, id_parameter_produto, data, validade, id_parameter_fabricante, 3);
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
