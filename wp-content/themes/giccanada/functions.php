<?php

remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

/**
 * Enqueue scripts and styles.
 */

function setOpenCaseCountry() {
	$pathToLib = get_stylesheet_directory() . "/SxGeo.php";
	$pathToDB = get_stylesheet_directory() . "/SxGeo.dat";

	require_once($pathToLib);

	$SxGeo = new SxGeo($pathToDB);
	$ip = $_SERVER['REMOTE_ADDR'] === '127.0.0.1' ? '89.252.56.204' : $_SERVER['REMOTE_ADDR'];

	$cookieCountryName = $_COOKIE['countryName'];
	$cookieUserIp = $_COOKIE['userIp'];

	if(isset($cookieUserIp) && $cookieUserIp === $ip){
		$countryName = $cookieCountryName;
	}else{

		$isoCode = $SxGeo->getCountry($ip);

		setcookie('userIp', $ip);
		setcookie('iso', $isoCode);
	}
	unset($SxGeo);
}
add_action('send_headers', 'setOpenCaseCountry');


function giccanada_footer_scripts() {
	wp_enqueue_script( 'giccanada',  get_theme_file_uri('/public/giccanada.js'));
	wp_localize_script( 'giccanada', 'gic',
		array(
			'ajaxurl' => admin_url( 'admin-ajax.php' )
		)
	);

	wp_enqueue_style( 'style', get_theme_file_uri('/style.css'));
}

add_action('wp_footer', 'giccanada_footer_scripts');


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
	$to = 'rogovoyalexandr94@gmail.com';
	$form = $_POST['form'];
	require_once get_template_directory() . '/inc/countries.php';
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
	wp_mail( $to, $subject, $message, $headers);
	echo ($_POST['form']);
	wp_die();
}

add_action( 'wp_ajax_send_open_case_form', 'send_open_case_form' );
add_action( 'wp_ajax_nopriv_send_open_case_form', 'send_open_case_form' );

function register_wp_sidebars() {

	/* В боковой колонке - первый сайдбар */
	register_sidebar(
		array(
			'id' => 'contact-sidebar', // уникальный id
			'name' => 'Contact Sidebar', // название сайдбара
			'description' => 'Fixed widgets'// описание
		)
	);
}

add_action( 'widgets_init', 'register_wp_sidebars' );


function register_wp_widgets() {

	require get_template_directory() . '/inc/widgets.php';
	/* В боковой колонке - первый сайдбар */
	register_widget('OpenCaseWidget');
}

add_action( 'widgets_init', 'register_wp_widgets' );