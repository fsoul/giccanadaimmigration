<?php

remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

add_action( 'wp_ajax_get_content', 'get_content' );
add_action( 'wp_ajax_nopriv_get_content', 'get_content' );

function get_content() {
	if (isset($_POST['windowWidth'])) {
		$width = $_POST['windowWidth'];
		if ($width <= '375') {
			echo  json_encode( array(
				'header-slider-container'=> file_get_contents(get_stylesheet_directory() . '/template-parts/header/mobile-content.php'),
				'programms'=> file_get_contents(get_stylesheet_directory() . '/template-parts/programms/mobile-content.php'),
				'academy-container'=> file_get_contents(get_stylesheet_directory() . '/template-parts/academy/mobile-content.php'),
				'process-content'=> file_get_contents(get_stylesheet_directory() . '/template-parts/process/mobile-content.php'),
				'reviews'=> file_get_contents(get_stylesheet_directory() . '/template-parts/reviews/mobile-content.php')
			));
		} else {
			echo  json_encode( array(
				'header-slider-container'=> file_get_contents(get_stylesheet_directory() . '/template-parts/header/header-slider.php'),
				'programms'=> file_get_contents(get_stylesheet_directory() . '/template-parts/programms/programms.php'),
				'academy-container'=> file_get_contents(get_stylesheet_directory() . '/template-parts/academy/academy.php'),
				'process-content'=> file_get_contents(get_stylesheet_directory() . '/template-parts/process/desktop-content.php'),
				'reviews'=> file_get_contents(get_stylesheet_directory() . '/template-parts/reviews/reviews.php')
			));
		}
	}
	wp_die();
}





/**
 * Enqueue scripts and styles.
 */
function giccanada_header_scripts() {
	wp_enqueue_script( 'jquery.js',  'https://code.jquery.com/jquery-3.2.1.min.js');
	wp_enqueue_script( 'owl.carousel',  get_theme_file_uri('/public/js/owl.carousel.min.js'));
	wp_enqueue_script( 'popper',  'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js');
	wp_enqueue_script( 'bootstrap',  'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js');
	wp_enqueue_script( 'giccanada',  get_theme_file_uri('/public/giccanada.js'));
	wp_localize_script( 'giccanada', 'gic',
		array(
			'ajaxurl' => admin_url( 'admin-ajax.php' )
		)
	);

	wp_enqueue_style( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css');
	wp_enqueue_style( 'owl.carousel', get_theme_file_uri( '/public/css/owl.carousel.min.css' ));
	wp_enqueue_style( 'owl.theme.carousel', get_theme_file_uri( '/public/css/owl.theme.default.min.css' ));
	wp_enqueue_style( 'style', get_theme_file_uri('/style.css'));
}
add_action( 'wp_enqueue_scripts', 'giccanada_header_scripts' );

function giccanada_footer_scripts() {

}

add_action('wp_footer', 'giccanada_footer_scripts'); ?>
