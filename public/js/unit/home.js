$(document).ready(function () {

    loadUnits();

    // LISTAR UNIDADES
    function loadUnits()
    {
        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.get(window.location.origin + "/unidade/listar", {

                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                Swal.close();
                                $("#list").html(``);

                                if(data.data.length > 0){

                                    data.data.forEach(item => {

                                        $("#list").append(`
                                            <tr>
                                                <td width="150px" class="align-middle"><img style="padding: 5px" width="120" src="/img/logos/${item.sigla}.png"></td>
                                                <td class="align-middle">${item.name}</td>
                                                <td class="align-middle" style="text-align: right">
                                                    <div class="btn-group" role="group" aria-label="...">
                                                        <a title="Editar" data-id="${item.id}" data-name="${item.name}" data-city="${item.city}" data-sigla="${item.sigla}" data-reference="${item.reference}" data-description="${item.description}" href="#" class="btn btn-warning edit-unit"><i style="color: white" class="fas fa-edit"></i></a>
                                                        <a title="Deletar" data-id="${item.id}" href="#" class="btn btn-danger delete-unit"><i class="fas fa-trash-alt"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        `);
                                    });

                                }else{

                                    $("#list").append(`
                                        <tr>
                                            <td class="align-middle text-center" colspan="2">Nenhuma unidade cadastrada</td>
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


    // CADASTRAR UNIDADE
    $("#formStoreUnit").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();

                    $.post(window.location.origin + "/unidade/cadastrar", {
                        name: $("#name").val(),
                        city: $("#city").val(),
                        sigla: $("#sigla option:selected").val(),
                        description: $("#description").val(),
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formStoreUnit").each(function () {
                                    this.reset();
                                });

                                $("#modalStoreUnit").modal("hide");

                                showSuccess("Cadastro efetuado!", null, loadUnits)
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


    // EDITAR UNIDADE
    $("#list").on("click", ".edit-unit", function(){

        let id = $(this).data('id');
        let name = $(this).data('name');
        let city = $(this).data('city');
        let sigla = $(this).data('sigla');
        let description = $(this).data('description');

        $("#id_edit").val(id);
        $("#name_edit").val(name);
        $("#city_edit").val(city);
        $("#sigla_edit").val(sigla);
        $("#description_edit").val(description);

        $("#modalEditUnit").modal("show");
    });

    $("#formEditUnit").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.ajax({
                        url: window.location.origin + "/unidade/editar",
                        type: 'PUT',
                        data:{
                            id: $("#id_edit").val(),
                            name: $("#name_edit").val(),
                            city: $("#city_edit").val(),
                            sigla: $("#sigla_edit option:selected").val(),
                            description: $("#description_edit").val(),
                        }
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formEditUnit").each(function () {
                                    this.reset();
                                });

                                $("#modalEditUnit").modal("hide");

                                showSuccess("Edição efetuada!", null, loadUnits)
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


    // "DELETAR" UNIDADE
    $("#list").on("click", ".delete-unit", function(){

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
                                    url: window.location.origin + "/unidade/deletar",
                                    type: 'DELETE',
                                    data: {id}
                                })
                                    .then(function (data) {
                                        if (data.status == "success") {

                                            showSuccess("Deletado com sucesso!", null, loadUnits)
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
