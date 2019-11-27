function calcular(valores){
    valores.sort(function(a, b){
        return a-b;
    });
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

    var contModa = 0;

    for(chave in valores){
        if(contador[moda] == contador[chave])
            contModa++;      
    }
    let mensModa ="";

    if(contModa <=2){
        for(chave in contador){     
            if(contador[moda] == contador[chave])
                mensModa+= "Moda: " + parseFloat(chave).toFixed(2) +" - "+contador[chave]+" vezes| ";
        }
    }else{
        mensModa += "Não tem moda |";
    }
    /*FIM MODA*/

    var variancia = 0;

    for(valor of valores){
        var x = parseFloat(valor) - parseFloat(media);
        variancia= parseFloat(variancia) + Math.pow(x, 2);
    }
    variancia /= (valores.length - 1);
    /*FIM Variancia*/
    var desvioPadrao = Math.sqrt(variancia);
    var coeficiente = desvioPadrao / media * 100;

    return {"media":media, "mediana" : mediana, "moda": mensModa, "variancia" : variancia, "desvioPadrao": desvioPadrao, "coeficiente" : coeficiente};
}