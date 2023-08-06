$(document).ready(function () {

    loadWorksheet();
    loadWorksheetStructure();

    // LISTAR PLANILHAS
    function loadWorksheet()
    {
        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.get(window.location.origin + "/planilha/listar", {

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
                                                <td class="align-middle">${item.user_name}</td>
                                                <td class="align-middle" style="text-align: right">
                                                    <a title="Editar" data-id="${item.id}" data-description="${item.description}" href="#" class="btn btn-warning edit-Worksheet"><i style="color: white" class="fas fa-edit"></i></a>
                                                    <a title="Deletar" data-id="${item.id}" href="#" class="btn btn-danger delete-Worksheet"><i class="fas fa-trash-alt"></i></a>
                                                </td>
                                            </tr>
                                        `);
                                    });

                                }else{

                                    $("#list").append(`
                                        <tr>
                                            <td class="align-middle text-center" colspan="4">Nenhuma planilha cadastrada</td>
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


    // CADASTRAR PLANILHA
    $("#formStoreWorksheet").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();

                    $.post(window.location.origin + "/planilha/cadastrar", {
                        id_worksheet_structure: $("#id_worksheet_structure option:selected").val(),
                        description: $("#description").val(),
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formStoreWorksheet").each(function () {
                                    this.reset();
                                });

                                $("#modalStoreWorksheet").modal("hide");

                                showSuccess("Cadastro efetuado!", null, loadWorksheet)
                            } else if (data.status == "error") {
                                showError(data.message)
                            }
                        })
                        .catch();

                },
            },
        ]);

    });


    // EDITAR PLANILHA
    $("#list").on("click", ".edit-Worksheet", function(){

        let id = $(this).data('id');
        // let id_worksheet_structure = $("#id_worksheet_structure option:selected").val();
        let description = $(this).data('description');

        $("#id_edit").val(id);
        // $("#id_worksheet_structure_edit").val(id_worksheet_structure);
        $("#description_edit").val(description);

        $("#modalEditWorksheet").modal("show");
    });

    $("#formEditWorksheet").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.ajax({
                        url: window.location.origin + "/planilha/editar",
                        type: 'PUT',
                        data:{
                            id: $("#id_edit").val(),
                            description: $("#description_edit").val(),
                        }
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formEditWorksheet").each(function () {
                                    this.reset();
                                });

                                $("#modalEditWorksheet").modal("hide");

                                showSuccess("Edição efetuada!", null, loadWorksheet)
                            } else if (data.status == "error") {
                                showError(data.message)
                            }
                        })
                        .catch();
                },
            },
        ]);
    });


    // "DELETAR" PLANILHA
    $("#list").on("click", ".delete-Worksheet", function(){

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
                                    url: window.location.origin + "/planilha/deletar",
                                    type: 'DELETE',
                                    data: {id}
                                })
                                    .then(function (data) {
                                        if (data.status == "success") {

                                            showSuccess("Deletado com sucesso!", null, loadWorksheet)
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


    // LISTAR ESTRUTURA DE PLANILHAS
    function loadWorksheetStructure()
    {

        $.get(window.location.origin + "/estrutura-planilha/listar", {

        })
            .then(function (data) {
                if (data.status == "success") {

                    Swal.close();
                    $("#id_worksheet_structure").html(``);

                    if(data.data.length > 0){
                        $("#id_worksheet_structure").append(`<option>-- Selecione --</option>`);
                        data.data.forEach(item => {
                            $("#id_worksheet_structure").append(`<option value="${item.id}">${item.name}</option>`);
                        });
                    } else {
                        $("#id_worksheet_structure").append(`<option>Nenhuma estrutura de planilha encontrada</option>`);
                    }

                } else if (data.status == "error") {
                    showError(data.message)
                }
            })
            .catch();

    }



});
