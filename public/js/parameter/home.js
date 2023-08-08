$(document).ready(function () {

    loadParameters();
    loadParameterTypes();

    // LISTAR PARAMETROS
    function loadParameters()
    {
        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.get(window.location.origin + "/parametro/listar", {

                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                Swal.close();
                                $("#list").html(``);

                                if(data.data.length > 0){

                                    data.data.forEach(item => {

                                        $("#list").append(`
                                            <tr>
                                                <td class="align-middle">${item.name}</td>
                                                <td class="align-middle">${item.unit_name}</td>
                                                <td class="align-middle" style="text-align: right">
                                                    <a title="Editar" data-id="${item.id}" href="#" class="btn btn-warning edit-Parameter"><i style="color: white" class="fas fa-edit"></i></a>
                                                    <a title="Deletar" data-id="${item.id}" href="#" class="btn btn-danger delete-Parameter"><i class="fas fa-trash-alt"></i></a>
                                                </td>
                                            </tr>
                                        `);
                                    });

                                }else{

                                    $("#list").append(`
                                        <tr>
                                            <td class="align-middle text-center" colspan="4">Nenhum parâmetro cadastrado</td>
                                        </tr>
                                    `);
                                }

                            } else if (data.status == "error") {
                                showError(data.message)
                            }
                        })
                        .catch();
                },
            },
        ]);
    }

    // CADASTRAR PARAMETRO
    $("#formStoreParameter").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();

                    $.post(window.location.origin + "/parametro/cadastrar", {
                        name: $("#name").val(),
                        id_parameter_type: $("#id_parameter_type option:selected").val(),
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formStoreParameter").each(function () {
                                    this.reset();
                                });

                                $("#modalStoreParameter").modal("hide");

                                showSuccess("Cadastro efetuado!", null, loadParameters)
                            } else if (data.status == "error") {
                                showError(data.message)
                            }
                        })
                        .catch();

                },
            },
        ]);

    });


    // EDITAR PARAMETRO
    $("#list").on("click", ".edit-Parameter", function(){

        let id = $(this).data('id');
        let name = $(this).data('name');
        // let id_parameter_type = $("#id_parameter_type option:selected").val();

        $("#id_edit").val(id);
        $("#name_edit").val(name);
        // $("#id_parameter_type").val(id_parameter_type);

        $("#modalEditParameter").modal("show");
    });

    $("#formEditParameter").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.ajax({
                        url: window.location.origin + "/parametro/editar",
                        type: 'PUT',
                        data:{
                            id: $("#id_edit").val(),
                            name: $("#name_edit").val(),
                        }
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formEditParameter").each(function () {
                                    this.reset();
                                });

                                $("#modalEditParameter").modal("hide");

                                showSuccess("Edição efetuada!", null, loadParameters)
                            } else if (data.status == "error") {
                                showError(data.message)
                            }
                        })
                        .catch();
                },
            },
        ]);
    });


    // "DELETAR" PARAMETRO
    $("#list").on("click", ".delete-Parameter", function(){

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
                                    url: window.location.origin + "/parametro/deletar",
                                    type: 'DELETE',
                                    data: {id}
                                })
                                    .then(function (data) {
                                        if (data.status == "success") {

                                            showSuccess("Deletado com sucesso!", null, loadParameters)
                                        } else if (data.status == "error") {
                                            showError(data.message)
                                        }
                                    })
                                    .catch();
                            },
                        },
                    ]);

                }
            })

    });


    // LISTAR TIPOS DE PARAMETROS
    function loadParameterTypes()
    {

        $.get(window.location.origin + "/tipo-parametro/listar", {

        })
            .then(function (data) {
                if (data.status == "success") {

                    Swal.close();
                    $("#id_parameter_type").html(``);

                    if(data.data.length > 0){
                        $("#id_parameter_type").append(`<option>-- Selecione --</option>`);
                        data.data.forEach(item => {
                            $("#id_parameter_type").append(`<option value="${item.id}">${item.name}</option>`);
                        });
                    } else {
                        $("#id_parameter_type").append(`<option>Nenhum tipo de parâmetro encontrado</option>`);
                    }

                } else if (data.status == "error") {
                    showError(data.message)
                }
            })
            .catch();

    }



});
