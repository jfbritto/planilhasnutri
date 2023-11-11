$(document).ready(function () {

    // load();

    function load()
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
                        .catch(function (data) {
                            if (data.responseJSON.status == "error") {
                                showError(data.responseJSON.message)
                            }
                        });
                },
            },
        ]);
    }


});


// public/js/chart.js
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line', // tipo do gráfico (bar, line, pie, etc.)
    data: {
        labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio'],
        datasets: [{
            label: 'Planilhas Mensais',
            data: [12, 19, 3, 5, 2], // dados do gráfico
            backgroundColor: 'rgba(75, 192, 192, 0.2)', // cor de fundo das barras
            borderColor: 'rgba(75, 192, 192, 1)', // cor da borda das barras
            borderWidth: 1 // largura da borda das barras
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true // define o início do eixo Y como zero
            }
        }
    }
});
