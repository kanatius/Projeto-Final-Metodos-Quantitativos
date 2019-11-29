<?php 
    if(isset($_GET["matrizAmostra"])){
        require('../phplot-6.2.0/phplot.php');
        $grafico = new PHPlot(800,400); //cria um gráfico com tamanho 800x600 pixels
        
        #Indicamos o título do gráfico e o título dos dados no eixo X e Y do mesmo
        $grafico->SetTitle(utf8_decode("(em Dólares)"));
        $grafico->SetXTitle("Meses");
        $grafico->SetYTitle(utf8_decode("Receita do Mes"));
        // $grafico->SetPlotType("bars");
        #Definimos os dados do gráfico
        $dados = json_decode($_GET["matrizAmostra"]);
        
        $grafico->SetDataValues($dados);
        
        #Exibimos o gráfico
        $grafico->DrawGraph();
        return;
    }
?>