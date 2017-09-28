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

		$is_bot = preg_match(
			"~(Google|Yahoo|Rambler|Bot|Yandex|Spider|Snoopy|Crawler|Finder|Mail|curl)~i",
			$_SERVER['HTTP_USER_AGENT']
		);

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

add_action('wp_footer', 'giccanada_footer_scripts'); ?>
