$(document).ready(function(){
    $("#btnEnviar").on("click", function(){

        let camposFilmes= $(".campoFilme");
        let dados = [];

        for(value of camposFilmes){
            let filme = {};
            filme.nome = value.children[0].value;

            let valores = queBom(value.children[1].value).split(" ");
            let matrizDados = [];
            let cont = 1;
            matrizDados.push(["Lancamento", 0]);
            for(valor of valores){
                matrizDados.push([("Mes " + cont++), valor]);
            }
            filme.amostra = matrizDados;
            dados.push(filme);
            // dados.amostras.push(value.value);
        }
        window.location.href = "pages/gerarDoc.php?dados="+JSON.stringify(dados);
    });

    $("#btnAddFilme").on("click", function(){
        $("#filmes").append("<div class='campoFilme' id='menu'> <input type='text' class='nomeFilme' class='fadeIn second' placeholder='Nome do Filme'> <input type='text' class='amostra' class='fadeIn second' placeholder='Insira a amostra separada por espaço (\" \")'></div>");
    });


    








});

function queBom(string){

    while(string.indexOf(" ") >= 0 || string.indexOf(".") > 0 || string.indexOf(",00") >= 0){
        
        string = string.replace(".", "");
        string = string.replace(",00", "");
        string = string.replace(" ", "");
    }

    while(string.indexOf("R$") >= 0){
        string = string.replace("R$", " ");
    }
    string = string.trim();
    return string;
}