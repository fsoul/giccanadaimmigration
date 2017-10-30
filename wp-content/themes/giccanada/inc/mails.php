<?php

add_filter( 'wp_mail_from', 'open_case_wp_mail_from' );
function open_case_wp_mail_from( $email_address ){
	return 'noreply@giccanadaimmigration.com';
}

add_filter( 'wp_mail_from_name', 'open_case_wp_mail_from_name' );
function open_case_wp_mail_from_name( $email_from ){
	return 'giccanadaimmigration.com';
}

add_filter( 'wp_mail_content_type', 'open_case_wp_mail_content_type' );
function open_case_wp_mail_content_type( $content_type ){
	return 'text/html';
}


function send_open_case_admin_mail($form) {
	$subject = "New feedback";
	$to = get_option('show_email');
	require_once get_template_directory() . '/inc/countries.php';
	$form['country'] = getCountryByIso($form['country']) ? getCountryByIso($form['country']) : $form['country'];
	ob_start();
	require_once(get_template_directory() . '/template-parts/emails/open-case-admin-mail.phtml');
	$message = ob_get_contents();
	ob_end_clean();

	$headers = array(
		"From: noreply@giccanadaimmigration.com;",
		"Return-Path: noreply@giccanadaimmigration.com;",
		"MIME-Version: 1.0;",
		"Content-Type: text/html; charset=UTF-8;"
	);

	return wp_mail( $to, $subject, $message, $headers);
}

function send_assessment_user_mail($form) {
	$subject = 'Congratulations you on case opened!';
	$to = $form['ass-email'];
	ob_start();
	require_once(get_template_directory() . '/template-parts/emails/assessment-user-mail.phtml');
	$message = ob_get_contents();
	ob_end_clean();

	$headers = array(
		"From: noreply@giccanadaimmigration.com;",
		"Return-Path: noreply@giccanadaimmigration.com;",
		"MIME-Version: 1.0;",
		"Content-Type: text/html; charset=UTF-8;"
	);

	return wp_mail( $to, $subject, $message, $headers);
}

function send_open_case_user_mail($form) {
	$subject = 'Вас приветствует GIC Canada Global immigration corp';
	$to = $form['email'];
	ob_start();
	require_once(get_template_directory() . '/template-parts/emails/open-case-user-mail.phtml');
	$message = ob_get_contents();
	ob_end_clean();

	$headers = array(
		"From: noreply@giccanadaimmigration.com;",
		"Return-Path: noreply@giccanadaimmigration.com;",
		"MIME-Version: 1.0;",
		"Content-Type: text/html; charset=UTF-8;"
	);

	return wp_mail( $to, $subject, $message, $headers);
}