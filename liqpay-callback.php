<?php
$data = $_POST['data'];

require_once('wp-content/themes/giccanada/LiqPay.php');

$public_key = 'i3872387445';
$private_key = 'FEG8q2N6Iv5RocGoLq3xSk58NxwV1cJPLwJSvONw';
$liqpay = new LiqPay($public_key, $private_key);
$signature = $liqpay->str_to_sign($private_key.$data.$private_key);
$parsed_data = $liqpay->decode_params($data);
$uzmail = $parsed_data['description'];
$status = $parsed_data['status'];

if ($status === 'success') {

	$admmail = $parsed_data['info'];
	$to = $admmail;
}

function wlog($typelog, $log_text){
	$log = fopen("wp-content/themes/giccanada/public/pdf/$typelog.txt", 'a+');
	fwrite($log, "$log_text\r\n");
	fclose($log);
}

$blockSeparator = "  |  ";
//$blockSeparator = "\t";

wlog('status', $uzmail . $blockSeparator . $status . $blockSeparator . date('d-m-Y'));
