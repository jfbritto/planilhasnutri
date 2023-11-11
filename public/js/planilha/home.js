$(document).ready(function () {


})

function filterPlanilhas() {
    // Obtém o valor digitado pelo usuário
    let searchTerm = document
        .getElementById("searchInput")
        .value.toLowerCase();

    // Obtém todas as divs com a classe 'planilha'
    let planilhas = document.getElementsByClassName("planilha");

    // Itera sobre as divs para mostrar ou ocultar com base no termo de pesquisa
    for (let i = 0; i < planilhas.length; i++) {
        let titulo = planilhas[i].getAttribute("data-titulo").toLowerCase();

        // Verifica se o termo de pesquisa está presente no título da planilha
        if (titulo.includes(searchTerm)) {
            planilhas[i].style.display = "block"; // Mostra a planilha
        } else {
            planilhas[i].style.display = "none"; // Oculta a planilha
        }
    }
}
