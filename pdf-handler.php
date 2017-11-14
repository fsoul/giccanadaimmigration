<?php

require __DIR__ . '/vendor/autoload.php';

use Dompdf\Dompdf;

/*test data*/
$label = 'test label';
$section = 'test section';
$value = 'Тестовое значение';

ob_start();
require_once('wp-content/themes/giccanada/template-parts/assessment-form/additional/pdf-template.php');
$html = ob_get_contents();
ob_end_clean();


$dompdf = new Dompdf();
$dompdf->loadHtml($html);


$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

$output = $dompdf->output();

$pdfPath = 'wp-content/themes/giccanada/public/pdf/';

$pdfFileName = uniqid() . '.pdf';

$res = file_put_contents($pdfPath . $pdfFileName, $output);

echo json_encode($_POST);
