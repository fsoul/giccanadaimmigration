<?php

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

function init_feedback_timer_option() {
	add_settings_section(
		'general_timer_section',
		'Установка таймера для формы обратной связи',
		'',
		'general'
	);

	add_settings_field(
		'feedback_timer',                      // ID used to identify the field throughout the theme
		'Время срабатывания таймера',                           // The label to the left of the option interface element
		'timer_callback',   // The name of the function responsible for rendering the option interface
		'general',                          // The page on which this option will be displayed
		'general_timer_section',         // The name of the section to which this field belongs
		array(                              // The array of arguments to pass to the callback. In this case, just a description.
			'text' => 'Вводить время в секундах'
		)
	);

	register_setting(
		'general',
		'feedback_timer'
	);
}

function timer_callback($args) {
	$html = '<input class="regular-text" type="number" name="feedback_timer" id="feedback_timer" value="'.get_option('feedback_timer').'"/>';
	$html .= '<p class="description" id="feedback-timer-description">' . $args['text'] .'</p>';
	echo $html;
}


add_action('admin_init', 'init_feedback_timer_option');