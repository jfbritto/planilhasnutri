$(document).ready(function () {

    loadUsers();
    loadUnits();

    // LISTAR USUÁRIOS
    function loadUsers()
    {
        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.get(window.location.origin + "/usuario/listar", {

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
                                                <td class="align-middle">${item.email}</td>
                                                <td class="align-middle">${item.unidade}</td>
                                                <td class="align-middle" style="text-align: right">
                                                    <a title="Editar" data-id="${item.id}" data-name="${item.name}" data-email="${item.email}" href="#" class="btn btn-warning edit-user"><i style="color: white" class="fas fa-edit"></i></a>
                                                    <a title="Deletar" data-id="${item.id}" href="#" class="btn btn-danger delete-user"><i class="fas fa-trash-alt"></i></a>
                                                </td>
                                            </tr>
                                        `);
                                    });

                                }else{

                                    $("#list").append(`
                                        <tr>
                                            <td class="align-middle text-center" colspan="2">Nenhum usuário cadastrado</td>
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


    // CADASTRAR USUÁRIO
    $("#formStoreUser").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();

                    $.post(window.location.origin + "/usuario/cadastrar", {
                        name: $("#name").val(),
                        email: $("#email").val(),
                        id_unit: $("#id_unit option:selected").val(),
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formStoreUser").each(function () {
                                    this.reset();
                                });

                                $("#modalStoreUser").modal("hide");

                                showSuccess("Cadastro efetuado!", null, loadUsers)
                            } else if (data.status == "error") {
                                showError(data.message)
                            }
                        })
                        .catch();

                },
            },
        ]);

    });


    // EDITAR USUÁRIO
    $("#list").on("click", ".edit-user", function(){

        let id = $(this).data('id');
        let name = $(this).data('name');
        let email = $(this).data('email');

        $("#id_edit").val(id);
        $("#name_edit").val(name);
        $("#email_edit").val(email);

        $("#modalEditUser").modal("show");
    });

    $("#formEditUser").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.ajax({
                        url: window.location.origin + "/usuario/editar",
                        type: 'PUT',
                        data:{
                            id: $("#id_edit").val(),
                            name: $("#name_edit").val(),
                            email: $("#email_edit").val()
                        }
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formEditUser").each(function () {
                                    this.reset();
                                });

                                $("#modalEditUser").modal("hide");

                                showSuccess("Edição efetuada!", null, loadUsers)
                            } else if (data.status == "error") {
                                showError(data.message)
                            }
                        })
                        .catch();
                },
            },
        ]);
    });


    // "DELETAR" USUÁRIO
    $("#list").on("click", ".delete-user", function(){

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
                                    url: window.location.origin + "/usuario/deletar",
                                    type: 'DELETE',
                                    data: {id}
                                })
                                    .then(function (data) {
                                        if (data.status == "success") {

                                            showSuccess("Deletado com sucesso!", null, loadUsers)
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

    // LISTAR UNIDADES
    function loadUnits()
    {

        $.get(window.location.origin + "/unidade/listar", {

        })
            .then(function (data) {
                if (data.status == "success") {

                    Swal.close();
                    $("#id_unit").html(``);

                    if(data.data.length > 0){
                        $("#id_unit").append(`<option>-- Selecione --</option>`);
                        data.data.forEach(item => {
                            $("#id_unit").append(`<option value="${item.id}">${item.name}</option>`);
                        });
                    } else {
                        $("#id_unit").append(`<option>Nenhuma unidade encontrada</option>`);
                    }

                } else if (data.status == "error") {
                    showError(data.message)
                }
            })
            .catch();

    }


});
