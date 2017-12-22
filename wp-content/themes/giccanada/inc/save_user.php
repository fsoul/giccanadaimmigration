<?php
/**
 * @param string $table table name
 * @param array $data
 *
 * @return int
 * @throws Exception
 */
function insert_into( $table, array $data ) {
	global $wpdb;

	$wpdb->insert( $table, $data );

	if ( ! $wpdb->insert_id ) {
		throw new Exception( $wpdb->last_error );
	}

	return $wpdb->insert_id;
}

/**
 * @param string $year
 * @param string $month
 * @param string $day
 *
 * @return false|string
 */
function format_date( $year, $month, $day ) {
	$date = date_create_from_format( 'j-M-Y', "$day-$month-$year" );

	return date_format( $date, 'Y-m-d' );
}


/**
 * @param $form
 * @return bool
 * @throws Exception
 */
function save_user( $form ) {
	try {
		$id = save_user_meta( $form );
	} catch ( Exception $e ) {
		throw new Exception($e);
	}

	return is_numeric( $id );
}


/**
 * @param $form
 * @return int|WP_Error
 * @throws Exception
 */
function save_user_meta( $form ) {
	$email = $form['ass-email'];
//	$email = 'rogovoyalexandr94@gmail.com';
	$id = register_new_user( $email, $email );

	if ( is_wp_error( $id ) ) {
		throw new Exception( $id->get_error_message() );
	}

	wp_update_user( array(
		'ID'           => $id,
		'display_name' => $form['first-name'] . ' ' . $form['last-name'],
		'first_name'   => $form['first-name'],
		'last_name'    => $form['last-name'],
	) );
	$_SESSION['user_id'] = $id;

	return $id;
}

/**
 * @param $user_id
 * @param $form
 *
 * @throws Exception
 */
function save_user_common_info( $user_id, $form ) {
	$data = [
		'uci_userid'                 => $user_id,
		'uci_birth_date'             => format_date( $form['birth-date-y'], $form['birth-date-m'], $form['birth-date-d'] ),
		'uci_sex'                    => $form['ass-sex-m'],
		'uci_family_status'          => $form['ass-family'],
		'uci_citizenship'            => $form['citizenship'],
		'uci_country_residence'      => $form['country-residence'],
		'uci_country_residence_from' => $form['country-residence-from'],
		'uci_status_residence'       => $form['status-residence'],
		'uci_native_lang'            => $form['native-lang'],
		'uci_passport_num'           => $form['passport-num'],
		'uci_passport_exp_date'      => format_date( $form['passport-exp-date-y'], $form['passport-exp-date-m'], $form['passport-exp-date-d'] ),
		'uci_passport_country'       => $form['passport-country'],
		'uci_ass_phone'              => $form['ass-phone'],

		//step 10
		'uci_future_province' => $form['ass-future-province'],
		'uci_future_city' => $form['ass-future-city'],

		//step 12
		'uci_studied_at_canada' => $form['ass-studied-at-canada'],
		'uci_partner_studied_at_canada' => $form['ass-partner-studied-at-canada'],

		//step 14
		'uci_worked_at_canada' => $form['ass-worked-at-canada'],
		'uci_partner_worked_at_canada' => $form['ass-partner-worked-at-canada']
	];
	try {
		insert_into( 'wp_user_common_info', $data );
	} catch ( Exception $e ) {
		throw $e;
	}
}

/**
 * @param $user_id
 * @param $form
 *
 * @throws Exception
 */
function save_user_lang( $user_id, $form ) {
	$data = [
		'ul_user_id'      => $user_id,
		'ul_fr_listening' => $form['ass-phone'],
		'ul_fr_writing'   => $form['ass-phone'],
		'ul_fr_reading'   => $form['ass-phone'],
		'ul_fr_speaking'  => $form['ass-phone'],
		'ul_en_listening' => $form['en_listening'],
		'ul_en_writing'   => $form['en_writing'],
		'ul_en_reading'   => $form['en_reading'],
		'ul_en_speaking'  => $form['en_speaking']
	];
	try {
		insert_into( 'wp_user_lang', $data );
	} catch ( Exception $e ) {
		throw $e;
	}
}

/**
 * @param $user_id
 * @param $form
 *
 * @throws Exception
 */
function save_user_relatives( $user_id, $form ) {

	foreach ($form['relative'] as $item) {
		$data = [
			'ur_user_id'    => $user_id,
			'ur_last_name'  => $item['ass-rel-last-name'],
			'ur_first_name' => $item['ass-rel-first-name'],
			'ur_rel_with'   => $item['ass-rel-with'],
			'ur_status'     => $item['ass-rel-status'],
			'ur_province'   => $item['ass-rel-province']
		];
		try {
			insert_into( 'wp_user_common_info', $data );
		} catch ( Exception $e ) {
			throw $e;
		}
	}
}

/**
 * @param $user_id
 * @param $form
 *
 * @throws Exception
 */
function save_user_education( $user_id, $form ) {

	foreach ($form['education'] as $item) {
		$date_from = format_date( $item['ass-study-from-y'], $item['ass-study-from-m'], '1' ) ;
		$date_to = format_date( $item['ass-study-to-y'], $item['ass-study-to-m'], '1' ) ;

		$data = [
			'ued_user_id' => $user_id,
			'ued_education_name' => $item['education-name'],
			'ued_speciality' => $item['education-specialty'],
			'ued_country' => $item['education-country'],
			'ued_level' => $item['education-level'],
			'ued_certificate_type' => $item['education-certificate-type'],
			'ued_type' => $item['education-type'],
			'ued_from' => $date_from,
			'ued_to' => $date_to
		];
		try {
			insert_into( 'wp_user_education', $data );
		} catch ( Exception $e ) {
			throw $e;
		}
	}
}

/**
 * @param $user_id
 * @param $form
 *
 * @throws Exception
 */
function save_user_work( $user_id, $form ) {

	foreach ($form['work'] as $item) {
		$date_from = format_date( $item['ass-company-from-y'], $item['ass-company-from-m'], '1' ) ;
		$date_to = format_date( $item['ass-company-to-y'], $item['ass-company-to-m'], '1' ) ;

		$data = [
			'uw_user_id' => $user_id,
			'uw_company_name' => $item['company-name'],
			'uw_company_country' => $item['company-country'],
			'uw_company_position' => $item['company-position'],
			'uw_company_from' => $date_from,
			'uw_company_to' => $date_to,
			'uw_company_requirement' => $item['company-requirement']
		];
		try {
			insert_into( 'wp_user_work', $data );
		} catch ( Exception $e ) {
			throw $e;
		}
	}
}

/**
 * @param $user_id
 * @param $form
 *
 * @return int
 * @throws Exception
 */
function save_user_partner_info( $user_id, $form ) {

	$item = $form['partner'];

	$relation_from = format_date( $item['member-relation-from-y'], $item['member-relation-from-m'], '1' ) ;
	$relation_to = format_date( $item['member-relation-to-y'], $item['member-relation-to-m'], '1' ) ;

	$data = [
		'upi_user_id' => $user_id,
		'upi_last_name' => $item['member-last-name'],
		'upi_first_name' => $item['member-first-name'],
		'upi_birthday' => format_date( $item['member-birth-year'], $item['member-birth-month'], $item['member-birth-day'] ),
		'upi_sex' => $item['member-sex'],
		'upi_status' => $item['member-status'],
		'upi_relation_type' => $item['member-relation-type'],
		'upi_relation_from' => $relation_from,
		'upi_relation_to' => $relation_to
	];

	try {
		return insert_into( 'wp_user_work', $data );
	} catch ( Exception $e ) {
		throw $e;
	}
}

/**
 * @param $partner_id
 * @param $form
 *
 * @throws Exception
 */
function save_partner_education( $partner_id, $form ) {

	foreach ($form['part-educ'] as $item) {
		$from = format_date( $item['ass-part-work-from-y'], $item['ass-part-work-from-m'], '1' ) ;
		$to = format_date( $item['ass-part-work-to-y'], $item['ass-part-work-to-m'], '1' ) ;

		$data = [
			'ped_partner_id' => $partner_id,
			'ped_education_name' => $item['part-educ-name'],
			'ped_speciality' => $item['part-educ-specialty'],
			'ped_country' => $item['part-educ-country'],
			'ped_level' => $item['member-sex'],
			'ped_type' => $item['member-status'],
			'ped_from' => $item['member-relation-type'],
			'ped_to' => $from,
			'upi_relation_to' => $to
		];

		try {
			insert_into( 'wp_partner_education', $data );
		} catch ( Exception $e ) {
			throw $e;
		}
	}
}