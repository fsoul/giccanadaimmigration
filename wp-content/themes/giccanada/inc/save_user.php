<?php
/**
 * @param string $table table name
 * @param array $data
 * @throws Exception
 */
function insert_into($table, array $data) {
	global $wpdb;

	$wpdb->insert( $table, $data );

	if ( ! $wpdb->insert_id ) {
		throw new Exception( $wpdb->last_error );
	}

}

/**
 * @param string $year
 * @param string $month
 * @param string $day
 *
 * @return false|string
 */
function format_date($year, $month, $day){
	$date = date_create_from_format('j-M-Y', "$day-$month-$year");
	return date_format($date, 'Y-m-d');
}


function save_user($form) {
	$id = save_user_meta($form);

	return is_numeric($id);
}

function save_user_meta($form) {
	$email = $form['ass-email'];
//	$email = 'rogovoyalexandr94@gmail.com';
	$id = register_new_user($email, $email);

	if (is_wp_error($id))
		throw new Exception($id->get_error_message() );

	wp_update_user(array(
		'ID' => $id,
		'display_name' => $form['first-name'] . ' ' . $form['last-name'],
		'first_name' => $form['first-name'],
		'last_name' => $form['last-name'],
	));
	$_SESSION['user_id'] = $id;
	return $id;
}

function save_user_common_info($user_id, $form) {
	$data = [
		'uci_userid' => $user_id,
		'uci_birth_date' =>  format_date($form['birth-date-y'], $form['birth-date-m'], $form['birth-date-d']),
		'uci_sex' => $form['ass-sex-m'],
		'uci_family_status'  => $form['ass-family'],
		'uci_citizenship'  => $form['citizenship'],
		'uci_country_residence'  => $form['country-residence'],
		'uci_country_residence_from'  => $form['country-residence-from'],
		'uci_status_residence'  => $form['status-residence'],
		'uci_native_lang'  => $form['native-lang'],
		'uci_passport_num'  => $form['passport-num'],
		'uci_passport_exp_date'  => format_date($form['passport-exp-date-y'], $form['passport-exp-date-m'], $form['passport-exp-date-d']),
		'uci_passport_country'  => $form['passport-country'],
		'uci_ass_phone'  => $form['ass-phone']
	];
	insert_into('wp_user_common_info', $data);
}