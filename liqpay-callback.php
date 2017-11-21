<?php
$data = $_POST['data'];

function wlog( $typelog, $log_text ) {
	$log = fopen( "wp-content/themes/giccanada/public/pdf/$typelog.txt", 'a+' );
	fwrite( $log, "$log_text\r\n" );
	fclose( $log );
}

function send_assessment_user_mail( $to ) {
	$subject = 'Congratulations you on case opened!';
	ob_start();
	require_once( 'wp-content/themes/giccanada/template-parts/emails/assessment-user-mail.phtml' );
	$message = ob_get_contents();
	ob_end_clean();

	$headers = array(
		"From: noreply@giccanadaimmigration.com;",
		"Return-Path: noreply@giccanadaimmigration.com;",
		"MIME-Version: 1.0;",
		"Content-Type: text/html; charset=UTF-8;"
	);

	return mail( $to, $subject, $message, implode("\r\n", $headers) );
}

require_once( 'wp-content/themes/giccanada/LiqPay.php' );

$public_key  = 'i3872387445';
$private_key = 'FEG8q2N6Iv5RocGoLq3xSk58NxwV1cJPLwJSvONw';
$liqpay      = new LiqPay( $public_key, $private_key );
$signature   = $liqpay->str_to_sign( $private_key . $data . $private_key );
$parsed_data = $liqpay->decode_params( $data );
$status = $parsed_data['status'];

if ($status === 'success' || $status === 'sandbox') {
	$to = $parsed_data['info'];
	send_assessment_user_mail( $to );
}

wlog( 'status', print_r( $parsed_data, true ) );
