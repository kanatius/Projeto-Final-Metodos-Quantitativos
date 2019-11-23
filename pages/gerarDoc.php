<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="../css/pagina.css">
</head>
<body>
    
    <?php 
        if(isset($_GET["dados"])){
            $dados = json_decode($_GET["dados"]);
            foreach($dados as $filme){
                echo "<div class='divGrafico'>";
                echo "<h3>Arrecadação por Mês do Filme $filme->nome</h3>";
                echo "<img class='imgGrafico' src='http://localhost/Projeto-Final-Metodos-Quantitativos/pages/gerarGraficoArrecadacaoMensal.php?matrizAmostra=". json_encode($filme->amostra) . "'" . "alt=''>";
                echo "</div>";
            }  
        ?>
    <?php
        }
    ?>
</body>
</html>