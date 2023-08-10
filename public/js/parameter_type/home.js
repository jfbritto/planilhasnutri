$(document).ready(function () {

    loadParameterTypes();

    // LISTAR TIPOS DE PARAMETROS
    function loadParameterTypes()
    {
        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.get(window.location.origin + "/tipo-parametro/listar", {

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
                                                <td class="align-middle">${item.unidade}</td>
                                                <td class="align-middle" style="text-align: right">
                                                    <a title="Cadastrar Parâmetros" data-id="${item.id}" data-name="${item.name}" href="#" class="btn btn-info create-Parameter"><i style="color: white" class="fas fa-plus"></i></a>
                                                    <a title="Editar" data-id="${item.id}" data-name="${item.name}" href="#" class="btn btn-warning edit-ParameterType"><i style="color: white" class="fas fa-edit"></i></a>
                                                    <a title="Deletar" data-id="${item.id}" href="#" class="btn btn-danger delete-ParameterType"><i class="fas fa-trash-alt"></i></a>
                                                </td>
                                            </tr>
                                        `);
                                    });

                                }else{

                                    $("#list").append(`
                                        <tr>
                                            <td class="align-middle text-center" colspan="3">Nenhum parâmetro cadastrado</td>
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


    // CADASTRAR TIPOS DE PARAMETRO
    $("#formStoreParameterType").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();

                    $.post(window.location.origin + "/tipo-parametro/cadastrar", {
                        name: $("#name").val(),
                        description: $("#description").val(),
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formStoreParameterType").each(function () {
                                    this.reset();
                                });

                                $("#modalStoreParameterType").modal("hide");

                                showSuccess("Cadastro efetuado!", null, loadParameterTypes)
                            } else if (data.status == "error") {
                                showError(data.message)
                            }
                        })
                        .catch();

                },
            },
        ]);

    });


    // EDITAR TIPOS DE PARAMETRO
    $("#list").on("click", ".edit-ParameterType", function(){

        let id = $(this).data('id');
        let name = $(this).data('name');

        $("#id_edit").val(id);
        $("#name_edit").val(name);

        $("#modalEditParameterType").modal("show");
    });

    $("#formEditParameterType").submit(function (e) {
        e.preventDefault();

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.ajax({
                        url: window.location.origin + "/tipo-parametro/editar",
                        type: 'PUT',
                        data:{
                            id: $("#id_edit").val(),
                            name: $("#name_edit").val()
                        }
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formEditParameterType").each(function () {
                                    this.reset();
                                });

                                $("#modalEditParameterType").modal("hide");

                                showSuccess("Edição efetuada!", null, loadParameterTypes)
                            } else if (data.status == "error") {
                                showError(data.message)
                            }
                        })
                        .catch();
                },
            },
        ]);
    });


    // "DELETAR" TIPOS DE PARAMETRO
    $("#list").on("click", ".delete-ParameterType", function(){

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
                                    url: window.location.origin + "/tipo-parametro/deletar",
                                    type: 'DELETE',
                                    data: {id}
                                })
                                    .then(function (data) {
                                        if (data.status == "success") {

                                            showSuccess("Deletado com sucesso!", null, loadParameterTypes)
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

    // LISTAR/CADASTRAR PARAMETRO
    $("#list").on("click", ".create-Parameter", function(){

        let id = $(this).data('id');
        let name = $(this).data('name');

        console.log(id, name)

        $("#title-parametro").html(name);

        $("#id_parameter_type").val(id)
        $("#title-novo-iten").html(name)

        loadParameters(id);

        $("#modalCreateParameters").modal("show");
    });

    // LISTAR PARAMETROS
    function loadParameters(id)
    {
        $.get(window.location.origin + "/parametro/encontrar", {
            id_parameter_type:id
        })
        .then(function (data) {
            if (data.status == "success") {

                Swal.close();
                $("#list2").html(``);

                if(data.data.length > 0){

                    data.data.forEach(item => {

                        $("#list2").append(`
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

                    $("#list2").append(`
                        <tr>
                            <td class="align-middle text-center" colspan="4">Nenhum item cadastrado</td>
                        </tr>
                    `);
                }

            } else if (data.status == "error") {
                showError(data.message)
            }
        })
        .catch();
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
                        name: $("#name_parameter").val(),
                        id_parameter_type: $("#id_parameter_type").val(),
                    })
                        .then(function (data) {
                            if (data.status == "success") {

                                $("#formStoreParameter").each(function () {
                                    this.reset();
                                });

                                $("#modalStoreParameter").modal("hide");

                                showSuccess("Cadastro efetuado!", null, loadParameters, $("#id_parameter_type").val())
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
    $("#list2").on("click", ".edit-Parameter", function(){

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
    $("#list2").on("click", ".delete-Parameter", function(){

        var id = $(this).data('id');

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

                                            showSuccess("Deletado com sucesso!", null, loadParameters, $("#id_parameter_type").val())
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
