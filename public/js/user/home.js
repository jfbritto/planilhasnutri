$(document).ready(function () {

    loadPrincipal();
    loadUnits();

    // LISTAR USUÁRIOS
    function loadPrincipal()
    {
        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.get(window.location.origin + "/usuario/listar", {
                        status_filter : $("#status_filter option:selected").val(),
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                Swal.close();
                                $("#list").html(``);

                                let isAdmin = $("#isAdmin").val() === "1"?'':'d-none';
                                let isEstagiario = $("#isEstagiario").val() === "1"?'d-none':'';

                                let isAdminFlag = $("#isAdmin").val() === "1"?1:0;
                                let isEstagiarioFlag = $("#isEstagiario").val() === "1"?1:0;

                                if(data.data.length > 0){

                                    data.data.forEach(item => {

                                        let txtTittle = item.status == 'A' ? 'Inativar' : 'Ativar'
                                        let valueChange = item.status == 'A' ? 'I' : 'A'
                                        let colorBtn = item.status == 'A' ? 'success' : 'secondary'
                                        let esconderBtn = item.status == 'A' ? '' : 'd-none'

                                        $("#list").append(`
                                            <tr>
                                                <td class="align-middle">${item.name}</td>
                                                <td class="align-middle elemento-esconder-celular">${item.email}</td>
                                                <td class="align-middle ${isAdmin}">${item.unidade}</td>
                                                <td class="align-middle overflow-visible-btn ${isEstagiario}" style="text-align: right">
                                                    <div class="btn-group" role="group" aria-label="...">
                                                        ${item.is_estagiario || isAdminFlag?`
                                                            <a title="${txtTittle}" data-id="${item.id}" data-status="${valueChange}" href="#" class="btn btn-${colorBtn} change-user"><i class="fas fa-power-off"></i></a>
                                                        `:``}

                                                        <a title="Editar" data-id="${item.id}" data-name="${item.name}" data-email="${item.email}" href="#" class="btn btn-warning edit-user ${esconderBtn}"><i style="color: white" class="fas fa-edit"></i></a>

                                                        ${item.is_estagiario || isAdminFlag?`
                                                            <a title="Deletar" data-id="${item.id}" href="#" class="btn btn-danger delete-user ${esconderBtn}"><i class="fas fa-trash-alt"></i></a>
                                                        `:``}
                                                    </div>
                                                </td>
                                            </tr>
                                        `);
                                    });

                                }else{

                                    let colSpan = $("#isAdmin").val() === "1"?'4':'3';

                                    $("#list").append(`
                                        <tr>
                                            <td class="align-middle text-center" colspan="${colSpan}">Nenhum usuário cadastrado</td>
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
                            email: $("#email_edit").val(),
                            password: $("#password_edit").val(),
                            password_confirm: $("#password_confirm_edit").val(),
                        }
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formEditUser").each(function () {
                                    this.reset();
                                });

                                $("#modalEditUser").modal("hide");

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

    // INATIVAR USUÁRIO
    $("#list").on("click", ".change-user", function(){

        let id = $(this).data('id');
        let status = $(this).data('status');

        Swal.fire({
            title: 'Atenção!',
            text: "Deseja realmente mudar o status?",
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
                                    url: window.location.origin + "/usuario/change",
                                    type: 'PUT',
                                    data: {id, status}
                                })
                                    .then(function (data) {
                                        if (data.status == "success") {

                                            showSuccess("Status alterado com sucesso!", null, loadPrincipal)
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
            .catch(function (data) {
                if (data.responseJSON.status == "error") {
                    showError(data.responseJSON.message)
                }
            });

    }

    $("#formFiltroPrincipal").change(function (e) {
        e.preventDefault();
        loadPrincipal()
    });
});
