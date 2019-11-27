<?php
require('correlacao.php');


function quedaSegundoMes($mes1, $mes2)
{
    return 100 - $mes2 / $mes1 * 100;
}

class QuedaFilme
{
    public $valor;
    public $nome;
}

function maiorEmenorQueda($filmes)
{
    //var_dump((float)$filmes[0]->amostra[1][1]);

    $maior = new QuedaFilme();
    $menor = new QuedaFilme();
    $maior->valor = quedaSegundoMes($filmes[0]->amostra[1][1], $filmes[0]->amostra[2][1]);
    $maior->nome = $filmes[0]->nome;
    $menor->valor = $filmes[0]->amostra[1][1];
    $menor->nome = $filmes[0]->nome;
    foreach ($filmes as $filme) {
        $queda = quedaSegundoMes($filme->amostra[1][1], $filme->amostra[2][1]);
        if ($queda > $maior->valor) {
            $maior->valor = $queda;
            $maior->nome = $filme->nome;
        }
        if ($queda < $menor->valor) {
            $menor->valor = $queda;
            $menor->nome = $filme->nome;
        }
    }
    $maior->valor = number_format($maior->valor, 2);
    $menor->valor = number_format($menor->valor, 2);
    return ["maior" => $maior, "menor" => $menor];
}

$dados = [];

if (isset($_GET["dados"]))
    $dados = json_decode($_GET["dados"]);
// foreach($dados as $filme){
//     echo "<pre>";
//     var_dump($filme);
//     echo "<pre>";
// }
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="../css/pagina.css">
    <style>
        p{
            text-indent: 4em;
        }
        body{
            font-family: 'Times New Roman', Times, serif;
            text-align: justify;
        }
    </style>
</head>

<body>

    <h1 align="center">Relatório Estatístico de Análise da Variação da Arrecação Bruta de Filmes</h1>
    <!-- INTRODUÇÃO -->
    <h2>Introdução</h2>
    <p>No cinema contemporâneo, diversos filmes geram receitas muito altas e perduram por certo período no topo dos mais assistidos. Porém, não se sabe ao certo quanto tempo estes levam para estabilizar a receita mensal, seja provida de: cinema; serviços de streaming; ou em produtos. Este documento propõe analizar dados sobre a arrecadação destes filmes e disponibilizar dados relevantes para esta problemática.</p>
    <!-- INTRODUÇÃO -->
    <!-- OBJETIVOS -->
    <h2>Objetivos</h2>
    <p>O objetivo deste documento é analizar a variação das receitas obtidas pelos filmes de grande bilheteria, e identificar, se possível, quanto tempo em média, leva para a arrecação mensal se estabilizar</p>
    <!-- OBJETIVOS -->
    <!-- METODOLOGIA -->
    <h2>Metodologia</h2>
    <p>O referido documento realizou uma análise descritiva e quantitativa da arrecadação mensal do filmes: <?php
                                                                                                            $cont = 0;
                                                                                                            foreach ($dados as $filme) {
                                                                                                                echo "$filme->nome";
                                                                                                                if ($cont < count($dados) - 1) {
                                                                                                                    echo "; ";
                                                                                                                    $cont++;
                                                                                                                }
                                                                                                            }
                                                                                                            echo ".";
                                                                                                            ?>
        Os dados analisados se referem à arrecadação de até o primeiro ano desde o lançamento dos filmes citados acima. Os dados foram coletados do vídeo: <a href="https://www.youtube.com/watch?v=oAGdedgvWKI" target="_blank"><b>Marvel vs. DC: Most Money Grossing Movies 1978 - 2019</b></a>
    </p>
    <!-- METODOLOGIA -->
    <!--Resultados -->
    <h2>Resultados</h2>
    <h3>Arrecadação por Mês</h3>
    <?php
    $maiorEMenor = maiorEmenorQueda($dados);
    echo "<p>Assim como consta nos gráficos a seguir, o filme com maior queda de arrecadação foi " . $maiorEMenor["maior"]->nome . " com uma porcentagem de " . $maiorEMenor["maior"]->valor . "%, em contra partida " . $maiorEMenor["menor"]->nome . " teve a menor com " . $maiorEMenor["menor"]->valor . "%.</p>";
    ?>
    <div>A quantia arrecadada pelos filmes no segundo mês em relação ao primeiro (lançamento) decresceu em:</div>
    <ul class="lista">
        <?php
        foreach ($dados as $filme) {
            echo "<li><b>$filme->nome: </b>" .  number_format(quedaSegundoMes($filme->amostra[1][1], $filme->amostra[2][1]), 2) . "%;</li>";
        }
        ?>
    </ul>
    <?php
    foreach ($dados as $filme) {
        echo "<div class='divGrafico'>";
        echo "<h4>Arrecadação por Mês do Filme $filme->nome</h4>";
        echo "<img class='imgGrafico' src='http://localhost/PFMQ/pages/gerarGraficoArrecadacaoMensal.php?matrizAmostra=" . json_encode($filme->amostra) . "'" . "alt=''>";
        echo "</div>";
    }
    ?>
    <h3>Estabilização das vendas</h3>
    <p>Para chegar ao <i>mês-resultado</i> da estabilização da arrecadação, foi relalizado o cálculo da variância das (sub) amostras de <i>i</i> até n, no qual i começa em 0 (incio das vendas). O resultado foi estipulado com um coeficiente abaixo de 1% para a relação entre a variância das subamostras e a variância da amostra completa. O mês-resultado é definido no mês em que a partir dele até o décimo segundo mês, a variância da arrecadação esteja abaixo de 1% da variância total da amostra. A análise dos dados leva em conta que 1 ano é o tempo estipulado no qual a maiorias dos filmes já estabilizaram seus valores de arrecadação mensal.</p>
    <h4>Quantidade de meses para a estabilização das vendas:</h4>
    <ul>
        <?php
        foreach ($dados as $filme) {
            echo "<li>";
            echo "<b>$filme->nome: </b> ";
            for ($i = 1; $i < count($filme->mmm); $i++) {
                if ($filme->mmm[$i]->variancia / $filme->mmm[0]->variancia * 100 < 1) {
                    $filme->tempoEstab = $i;
                    echo "$i</li>";
                    break;
                }
            }
        }
        ?>
    </ul>
    <?php
    $totalMeses = 0;
    foreach ($dados as $filme) {
        $totalMeses += $filme->tempoEstab;
    }
    $tempoMedio = $totalMeses / count($dados);
    echo "<p>O tempo médio para a estabilização das vendas foi de " . number_format($tempoMedio, 1) . " meses!</p>";
    ?>
    <!--Resultados -->

    <h3>Correlação</h3>
    <?php

    foreach ($dados as $filme) {
        $vetx = [];
        $vety = [];
        $vetxAll = [];
        $vetyAll = [];
        $cont = 0;

        //AMOSTRA A PARTIR DO MÊS DE ESTABILIZAÇÃO
        for ($i = $filme->tempoEstab; $i < count($filme->amostra); $i++) {
            $vetx[$cont] = $filme->amostra[$i][0];
            $vety[$cont] = $filme->amostra[$i][1];
            $cont++;
        }
        //AMOSTRA A PARTIR DO MÊS DE ESTABILIZAÇÃO

        //AMOSTRA COMPLETA
        $vetxAll[0] = 0;
        $vetyAll[0] = 0;

        for ($i = 1; $i < count($filme->amostra); $i++){
            $vetxAll[$i] = $filme->amostra[$i][0];
            $vetyAll[$i] = $filme->amostra[$i][1];
        }
        //AMOSTRA COMPLETA

        echo "<h4>$filme->nome:</h4>";
        $filme->correlacao = calcularCorrelacao($vetxAll, $vetyAll);
        echo "<p>";
        echo "Correlação da amostra completa é de " . number_format($filme->correlacao, 2) . " (". classificarCorrelacao($filme->correlacao) .").";
        echo "<br>";
        echo "</p>";
        echo "<p>";
        $correlacao = calcularCorrelacao($vetx, $vety);
        echo "Correlação da subamostra (do mês $filme->tempoEstab até o décimo segundo) " . number_format($correlacao, 2) . " (". classificarCorrelacao($correlacao) .").";
        echo "</p>";
        echo "</pre>";
    }
    ?>
</body>

</html>