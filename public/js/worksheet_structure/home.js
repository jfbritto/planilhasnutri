$(document).ready(function () {

    loadWorksheetStructure();

    // LISTAR ESTRUTURA DE PLANILHAS
    function loadWorksheetStructure()
    {
        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.get(window.location.origin + "/estrutura-planilha/listar", {

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
                                                <td class="align-middle" style="text-align: right">
                                                    <a title="Editar" data-id="${item.id}" data-name="${item.name}" data-city="${item.city}" data-neighborhood="${item.neighborhood}" data-reference="${item.reference}" data-description="${item.description}" href="#" class="btn btn-warning edit-WorksheetStructure"><i style="color: white" class="fas fa-edit"></i></a>
                                                    <a title="Deletar" data-id="${item.id}" href="#" class="btn btn-danger delete-WorksheetStructure"><i class="fas fa-trash-alt"></i></a>
                                                </td>
                                            </tr>
                                        `);
                                    });

                                }else{

                                    $("#list").append(`
                                        <tr>
                                            <td class="align-middle text-center" colspan="2">Nenhuma estrutura de planilha cadastrada</td>
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


    // CADASTRAR ESTRUTURA DE PLANILHA
    $("#formStoreWorksheetStructure").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();

                    $.post(window.location.origin + "/estrutura-planilha/cadastrar", {
                        name: $("#name").val(),
                        description: $("#description").val(),
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formStoreWorksheetStructure").each(function () {
                                    this.reset();
                                });

                                $("#modalStoreWorksheetStructure").modal("hide");

                                showSuccess("Cadastro efetuado!", null, loadWorksheetStructure)
                            } else if (data.status == "error") {
                                showError(data.message)
                            }
                        })
                        .catch();

                },
            },
        ]);

    });


    // EDITAR ESTRUTURA DE PLANILHA
    $("#list").on("click", ".edit-WorksheetStructure", function(){

        let id = $(this).data('id');
        let name = $(this).data('name');
        let city = $(this).data('city');
        let neighborhood = $(this).data('neighborhood');
        let description = $(this).data('description');

        $("#id_edit").val(id);
        $("#name_edit").val(name);
        $("#description_edit").val(description);

        $("#modalEditWorksheetStructure").modal("show");
    });

    $("#formEditWorksheetStructure").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.ajax({
                        url: window.location.origin + "/estrutura-planilha/editar",
                        type: 'PUT',
                        data:{
                            id: $("#id_edit").val(),
                            name: $("#name_edit").val(),
                            description: $("#description_edit").val(),
                        }
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formEditWorksheetStructure").each(function () {
                                    this.reset();
                                });

                                $("#modalEditWorksheetStructure").modal("hide");

                                showSuccess("Edição efetuada!", null, loadWorksheetStructure)
                            } else if (data.status == "error") {
                                showError(data.message)
                            }
                        })
                        .catch();
                },
            },
        ]);
    });


    // "DELETAR" ESTRUTURA DE PLANILHA
    $("#list").on("click", ".delete-WorksheetStructure", function(){

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
                                    url: window.location.origin + "/estrutura-planilha/deletar",
                                    type: 'DELETE',
                                    data: {id}
                                })
                                    .then(function (data) {
                                        if (data.status == "success") {

                                            showSuccess("Deletado com sucesso!", null, loadWorksheetStructure)
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


});
