<?php

require __DIR__ . '/vendor/autoload.php';

use Dompdf\Dompdf;

function send_pdf_admin_mail($addr = false, $path, $filename){
    $file = $path.$filename;
    $content = file_get_contents($file);
    $content = chunk_split(base64_encode($content));
    $uid = md5(uniqid(time()));
    $name = basename($file);

    $from_name = 'GICCANADA';
    $from_mail = 'noreply@giccanadaimmigration.com';
    $message = 'New Assesment';
    $mailto = $addr;
    $subject = 'Assesment Form Pdf';

// header
    $header = "From: ".$from_name." <".$from_mail.">\r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";

// message & attachment
    $nmessage = "--".$uid."\r\n";
    $nmessage .= "Content-type:text/plain; charset=iso-8859-1\r\n";
    $nmessage .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    $nmessage .= $message."\r\n\r\n";
    $nmessage .= "--".$uid."\r\n";
    $nmessage .= "Content-Type: application/octet-stream; name=\"".$filename."\"\r\n";
    $nmessage .= "Content-Transfer-Encoding: base64\r\n";
    $nmessage .= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n";
    $nmessage .= $content."\r\n\r\n";
    $nmessage .= "--".$uid."--";

    if (mail($mailto, $subject, $nmessage, $header)) {
        return true; // Or do something here
    } else {
        return false;
    }
}

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

$mail = send_pdf_admin_mail('bilinskyivitalii@gmail.com', $pdfPath, $pdfFileName);

echo json_encode(array('mail'=>$mail));
