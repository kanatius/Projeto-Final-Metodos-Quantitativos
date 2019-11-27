<?php

function calcularCorrelacao($vet1, $vet2)
{

    $Amostrax = $vet1;
    $Amostray = $vet2;

    //pega tamanho do array
    $tamanhoAmost = count($Amostrax);


    //declaração do array xy que é a soma do valores com indices iguais
    $Arrxy = array();
    $x2 = array();
    $y2 = array();

    //soma
    for ($i = 0; $i < $tamanhoAmost; $i++) {
        $Arrxy[$i] = $Amostrax[$i] * $Amostray[$i];
    }
    //Potência
    for ($i = 0; $i < $tamanhoAmost; $i++) {
        $x2[$i] = pow($Amostrax[$i], 2);
        $y2[$i] = pow($Amostray[$i], 2);
    }
    $somatoriox = array_sum($Amostrax);
    $somatorioy = array_sum($Amostray);
    $somatorioxy = array_sum($Arrxy);
    $somatoriox2 = array_sum($x2);
    $somatorioy2 = array_sum($y2);


    $r1 = $tamanhoAmost * $somatorioxy - $somatoriox * $somatorioy;
    $r2 = ($tamanhoAmost * $somatoriox2 - pow($somatoriox, 2)) * ($tamanhoAmost * $somatorioy2 - pow($somatorioy, 2));
    $r = $r1 / sqrt($r2);
    //COEFICIENTE DE CORRELAÇÃO = $r;

    return $r;
}

function classificarCorrelacao($valorR)
{
    if($valorR < 0){
        $valorR = $valorR * -1;
    }
    //transforma o valor em positivo
    if ($valorR > 0.9) :
        return 'Ótima';

    elseif ($valorR > 0.8) :
        return 'Boa';

    elseif ($valorR > 0.7) :
        return 'Razoável';

    elseif ($valorR > 0.6) :
        return 'Medíocre';

    elseif ($valorR > 0.5) :
        return 'Péssima';

    elseif ($valorR <= 0.5) :
        return 'Imprópria';
    endif;
}
