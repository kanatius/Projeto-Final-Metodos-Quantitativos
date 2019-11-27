$(document).ready(function(){
    $("#btnEnviar").on("click", function(){

        let camposFilmes= $(".campoFilme");
        let dados = [];

        for(value of camposFilmes){
            let filme = {};
            filme.nome = value.children[0].value;

            while(filme.nome.indexOf(" ") >= 0){
                filme.nome = filme.nome.replace(" ", "");
            }

            let valores = queBom(value.children[1].value).split(" ");
            // MMM
            let vetorValores = [0];
            vetorValores.push(...valores);
            filme.mmm = new Array(vetorValores.length - 1);

            for(let i=0; i<filme.mmm.length; i++){
                filme.mmm[i] = calcular(vetorValores.slice(i, vetorValores.length));
            }

            // MMM
            let matrizDados = [];
            let cont = 1;
            matrizDados.push(["Lancamento", 0]);
            for(valor of valores){
                matrizDados.push([cont++, valor]);
            }
            filme.amostra = matrizDados;
            dados.push(filme);
            // dados.amostras.push(value.value);
        }
        console.log(dados);
        $("#dados").val(JSON.stringify(dados));
        document.getElementById("formDados").submit();
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


function calcular(valores){
    valores.sort(function(a, b){
        return parseFloat(a)-parseFloat(b);
    });

    console.log(valores);
    var somatorio = parseFloat(0);
    for(valor of valores){
        somatorio +=parseFloat(valor);
    }
    var media = somatorio / valores.length;
    /*FIM MEDIA*/

    var mediana = parseFloat(valores[parseInt((valores.length/2)-1)]);
    //debugger;

    if(valores.length % 2 == 0){
        mediana += parseFloat(parseInt(valores[(valores.length/2)]));
        mediana/=2;
    }
    //debugger;
    /*FIM MEDIANA*/

    var contador = {};

    for(valor of valores){
        if(isNaN(contador[valor]))
            contador[valor] = 1;
        else
            contador[valor]++;
    }

    var moda;
    var primeiro = true;
    for(chave in contador){
        var quantidadeDeVezes = contador[chave];
        if(primeiro){
            moda = chave;
            primeiro = false;
            continue;
        }
        if(quantidadeDeVezes > contador[moda]){
            moda = chave;
        }
        //console.log(chave +" = " + contador[chave] + " vezes");
    }

    var variancia = 0;

    for(valor of valores){
        var x = parseFloat(valor) - parseFloat(media);
        variancia= parseFloat(variancia) + Math.pow(x, 2);
    }
    variancia /= (valores.length - 1);
    /*FIM Variancia*/
    var desvioPadrao = Math.sqrt(variancia);
    var coeficiente = desvioPadrao / media * 100;

    return {"variancia" : variancia};
}