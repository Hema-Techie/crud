<?php
require_once __DIR__ . '/mpdf/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf();

$csscontent =file_get_contents('lib.css');
$htmlcontent =file_get_contents('index.html');

$mpdf->WriteHTML($csscontent,1);
$mpdf->WriteHTML($htmlcontent,2);


$mpdf->SetDisplayMode('fullpage');
$mpdf->list_indent_first_level = 0; 

//call watermark content and image
$mpdf->SetWatermarkText('RomanSelva_RS');
$mpdf->showWatermarkText = true;
$mpdf->watermarkTextAlpha = 0.1;

//output in browser
$mpdf->Output();

?>