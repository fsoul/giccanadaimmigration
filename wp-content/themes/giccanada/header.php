<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php endif; ?>
    <link rel="shortcut icon" href="<?= get_theme_file_uri('/favicon.ico'); ?>" type="image/x-icon"/>
    <link rel="icon" href="<?= get_theme_file_uri('/favicon.ico'); ?> " type="image/x-icon"/>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>