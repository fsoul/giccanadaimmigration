<?php
function send_open_case_form () {

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

	$subject = "New feedback";
	$to = get_option('show_email');
	$form = $_POST['form'];
	require_once get_template_directory() . '/inc/countries.php';
	foreach ($form as $key => $value) {
		$form[$key] = htmlspecialchars (strip_tags( stripcslashes( trim( $value ) ) ) );
	}
	$form['country'] = getCountryByIso($form['country']) ? getCountryByIso($form['country']) : $form['country'];
	ob_start();
	include(get_template_directory() . '/inc/open-case-mail.phtml');
	$message = ob_get_contents();
	ob_end_clean();

	$headers = array(
		"From: noreply@giccanadaimmigration.com;",
		"Return-Path: noreply@giccanadaimmigration.com;",
		"MIME-Version: 1.0;",
		"Content-Type: text/html; charset=UTF-8;"
	);

	$isSuccess = wp_mail( $to, $subject, $message, $headers);

	echo json_encode(array(
		'isSuccess' => $isSuccess,
		'message' => $isSuccess ? 'Form was sent successfully!' : 'Failed to send your message!'
	));
	wp_die();
}

add_action( 'wp_ajax_send_open_case_form', 'send_open_case_form' );
add_action( 'wp_ajax_nopriv_send_open_case_form', 'send_open_case_form' );

function get_feedback_timer() {
	echo intval(get_option('feedback_timer') ? get_option('feedback_timer') : 10);
	wp_die();
}

add_action( 'wp_ajax_get_feedback_timer', 'get_feedback_timer' );
add_action( 'wp_ajax_nopriv_get_feedback_timer', 'get_feedback_timer' );


function get_step_by_index() {
	$index = $_POST['index'];
	ob_start();
	include(get_template_directory() . '/inc/get-select-options.php');
	include(get_template_directory() . "/template-parts/assessment-form/form-step-$index.php");
	$message = ob_get_contents();
	ob_end_clean();
	echo $message;
	wp_die();
}

add_action( 'wp_ajax_get_step_by_index', 'get_step_by_index' );
add_action( 'wp_ajax_nopriv_get_step_by_index', 'get_step_by_index' );

function get_cities_list_by_province() {
	$code = $_POST['code'];
	require_once get_template_directory() . '/inc/provinces.php';
	$cities = getCitiesByProvince($code);
	echo json_encode($cities);
	wp_die();
}

add_action( 'wp_ajax_get_cities_list_by_province', 'get_cities_list_by_province' );
add_action( 'wp_ajax_nopriv_get_cities_list_by_province', 'get_cities_list_by_province' );

