<?php

remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

/**
 * Enqueue scripts and styles.
 */

require_once get_template_directory() . '/inc/admin_settings.php';
require get_template_directory() . '/inc/widgets.php';


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
	/* В боковой колонке - первый сайдбар */
	register_widget('OpenCaseWidget');
}
add_action( 'widgets_init', 'register_wp_widgets' );

function start_session() {
	if(!session_id()) {
		session_start();
	}
}
add_action('init', 'start_session', 1);

function setOpenCaseCountry() {
	$pathToLib = get_template_directory() . "/SxGeo.php";
	$pathToDB = get_template_directory() . "/SxGeo.dat";

	require_once($pathToLib);

	$SxGeo = new SxGeo($pathToDB);
	$ip = $_SERVER['REMOTE_ADDR'] === '127.0.0.1' ? '89.252.56.204' : $_SERVER['REMOTE_ADDR'];

	$cookieUserIp = $_COOKIE['userIp'];

	if( !(isset($cookieUserIp) && $cookieUserIp === $ip )){
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

require_once get_template_directory() . '/inc/ajax_scripts.php';


// This theme uses wp_nav_menu() in two locations.
register_nav_menus( array(
	'top'    => __( 'Top Menu', 'gicanada' ),
	'footer' => __( 'Footer Menu', 'gicanada' ),
) );