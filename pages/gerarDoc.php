<?php
#$options = new Options();
#$options->set('isRemoteEnabled',true);      
#$dompdf = new Dompdf( $options );
use Dompdf\Dompdf;
require_once '../dompdf/autoload.inc.php';

// header('Location:http://localhost/PFMQ/pages/paginaPDF.php?dados=' . $_GET["dados"]);

#$dompdf = new DOMPDF();
$dompdf = new Dompdf(array('enable_remote' => true));#habilitar o uso de imagens

$dados = json_decode($_GET["dados"]);

if(isset($_GET["dados"]))
    $dompdf->loadHtml(file_get_contents("http://localhost/PFMQ/pages/paginaPDF.php?dados=".json_encode($dados)));


$dompdf->setPaper('A4', 'portrait');

// // Render the HTML as PDF
$dompdf->render();

// // Output the generated PDF to Browser
$dompdf->stream("pdp.pdf",array("Attachment"=>false));

?>
