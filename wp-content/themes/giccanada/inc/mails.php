<?php

add_filter( 'wp_mail_from', 'open_case_wp_mail_from' );
function open_case_wp_mail_from( $email_address ) {
	return 'noreply@giccanadaimmigration.com';
}

add_filter( 'wp_mail_from_name', 'open_case_wp_mail_from_name' );
function open_case_wp_mail_from_name( $email_from ) {
	return 'giccanadaimmigration.com';
}

add_filter( 'wp_mail_content_type', 'open_case_wp_mail_content_type' );
function open_case_wp_mail_content_type( $content_type ) {
	return 'text/html';
}


function send_open_case_admin_mail( $form ) {
	$subject = "New feedback";
	$to      = get_option( 'show_email' );
	require_once get_template_directory() . '/inc/countries.php';
	$form['country'] = getCountryByIso( $form['country'] ) ? getCountryByIso( $form['country'] ) : $form['country'];
	ob_start();
	require_once( get_template_directory() . '/template-parts/emails/open-case-admin-mail.phtml' );
	$message = ob_get_contents();
	ob_end_clean();

	$headers = array(
		"From: noreply@giccanadaimmigration.com;",
		"Return-Path: noreply@giccanadaimmigration.com;",
		"MIME-Version: 1.0;",
		"Content-Type: text/html; charset=UTF-8;"
	);

	return wp_mail( $to, $subject, $message, $headers );
}

function send_assessment_user_mail( $form ) {
	$subject = 'Congratulations you on case opened!';
	$to      = $form['ass-email'];
	ob_start();
	require_once( get_template_directory() . '/template-parts/emails/assessment-user-mail.phtml' );
	$message = ob_get_contents();
	ob_end_clean();

	$headers = array(
		"From: noreply@giccanadaimmigration.com;",
		"Return-Path: noreply@giccanadaimmigration.com;",
		"MIME-Version: 1.0;",
		"Content-Type: text/html; charset=UTF-8;"
	);

	return wp_mail( $to, $subject, $message, $headers );
}

function send_start_work_user_mail( $form ) {
	$subject = 'Congratulations you on case opened!';
	$to      = $form['sw-email'];
	ob_start();
	require_once( get_template_directory() . '/template-parts/emails/start-work-user-mail.phtml' );
	$message = ob_get_contents();
	ob_end_clean();

	$headers = array(
		"From: noreply@giccanadaimmigration.com;",
		"Return-Path: noreply@giccanadaimmigration.com;",
		"MIME-Version: 1.0;",
		"Content-Type: text/html; charset=UTF-8;"
	);

	return wp_mail( $to, $subject, $message, $headers );
}

function send_open_case_user_mail( $form ) {
	$subject = 'Вас приветствует GIC Canada Global immigration corp';
	$to      = $form['email'];
	ob_start();
	require_once( get_template_directory() . '/template-parts/emails/open-case-user-mail.phtml' );
	$message = ob_get_contents();
	ob_end_clean();

	$headers = array(
		"From: noreply@giccanadaimmigration.com;",
		"Return-Path: noreply@giccanadaimmigration.com;",
		"MIME-Version: 1.0;",
		"Content-Type: text/html; charset=UTF-8;"
	);

	return wp_mail( $to, $subject, $message, $headers );
}

function send_pdf_admin_mail() {
	require get_template_directory() . '/vendor/autoload.php';

	use Dompdf\Dompdf;

	ob_start();
	require_once( get_template_directory() . '/template-parts/emails/pdf-template.php' );
	$html = ob_get_contents();
	ob_end_clean();


	$dompdf = new Dompdf();
	$dompdf->loadHtml( $html );


	$dompdf->setPaper( 'A4', 'landscape' );

	// Render the HTML as PDF
	$dompdf->render();

	$output = $dompdf->output();

	$pdfPath = 'wp-content/themes/giccanada/public/pdf/';

	$pdfFileName = uniqid() . '.pdf';

	$res = file_put_contents( $pdfPath . $pdfFileName, $output );


	$file    = $pdfPath . $pdfFileName;
	$content = file_get_contents( $file );
	$content = chunk_split( base64_encode( $content ) );
	$uid     = md5( uniqid( time() ) );
	$name    = basename( $file );

	$from_name = 'GICCANADA';
	$from_mail = 'noreply@giccanadaimmigration.com';
	$message   = 'New Assesment';
	$mailto    = $_POST['addr'];
	$subject   = 'Assesment Form Pdf';

// header
	$header = "From: " . $from_name . " <" . $from_mail . ">\r\n";
	$header .= "MIME-Version: 1.0\r\n";
	$header .= "Content-Type: multipart/mixed; boundary=\"" . $uid . "\"\r\n\r\n";

// message & attachment
	$nmessage = "--" . $uid . "\r\n";
	$nmessage .= "Content-type:text/plain; charset=iso-8859-1\r\n";
	$nmessage .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
	$nmessage .= $message . "\r\n\r\n";
	$nmessage .= "--" . $uid . "\r\n";
	$nmessage .= "Content-Type: application/octet-stream; name=\"" . $pdfFileName . "\"\r\n";
	$nmessage .= "Content-Transfer-Encoding: base64\r\n";
	$nmessage .= "Content-Disposition: attachment; filename=\"" . $pdfFileName . "\"\r\n\r\n";
	$nmessage .= $content . "\r\n\r\n";
	$nmessage .= "--" . $uid . "--";

	echo json_encode( array( 'mail' => mail( $mailto, $subject, $nmessage, $header ) ) );
}
