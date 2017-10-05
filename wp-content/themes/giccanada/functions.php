<?php

remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

/**
 * Enqueue scripts and styles.
 */

function lead_initialize_options() {
	add_settings_section(
		'general_settings_section',
		'Настройка лид генерации',
		'lead_callback',
		'general'
	);

	add_settings_field(
		'show_email',                      // ID used to identify the field throughout the theme
		'Email',                           // The label to the left of the option interface element
		'email_callback',   // The name of the function responsible for rendering the option interface
		'general',                          // The page on which this option will be displayed
		'general_settings_section',         // The name of the section to which this field belongs
		array(                              // The array of arguments to pass to the callback. In this case, just a description.
			'Add all emails by comma'
		)
	);

	register_setting(
		'general',
		'show_email'
	);
}

function lead_callback() {
	echo '<p>Адреса можно вводить через запятую</p>';
}

function email_callback($args) {
	$html = '<input class="regular-text" title="'.$args[0].'" type="text" name="show_email" id="show_email" value="'.get_option('show_email').'"/>';
	$html .= '<p class="description" id="lead-email-description">Email адреса для лид рассылки</p>';
	echo $html;
}
add_action('admin_init', 'lead_initialize_options');


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