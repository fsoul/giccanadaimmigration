<?php

remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

/**
 * Enqueue scripts and styles.
 */

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
