<?php
/**
 * @param string $table table name
 * @param array $data
 *
 * @return int
 * @throws Exception
 */
function insert_into( $table, array $data ) {
	if ( ! isset( $wpdb ) ) {
		global $wpdb;
	}

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
 * @return null|string
 * @throws Exception
 */
function format_date( $year, $month, $day ) {
	if ( ! ( strlen( $year ) && strlen( $month ) && strlen( $day ) ) ) {
		return null;
	}

	$date = date_create_from_format( 'd-n-Y', "$day-$month-$year" );

	if ( ! $date ) {
		throw new Exception( date_get_last_errors()['errors'][0] );
	}

	$date = date_format( $date, 'Y-m-d' );

	if ( ! $date ) {
		throw new Exception( date_get_last_errors()['errors'][0] );
	}

	return $date;
}


/**
 * @param $form
 *
 * @return bool
 * @throws Exception
 */
function save_user( $form ) {
	global $wpdb;
	try {
		$wpdb->query( 'START TRANSACTION' );

		$id = save_user_meta( $form );

		save_user_common_info( $id, $form );
		save_user_lang( $id, $form );
		save_user_relatives( $id, $form );
		save_user_education( $id, $form );
		save_user_work( $id, $form );
		$partner_id = save_user_partner_info( $id, $form );
		save_partner_education( $partner_id, $form );
		save_partner_work( $partner_id, $form );
		save_user_child( $id, $form );
		save_user_payment( $id, $form );

		$wpdb->query( 'COMMIT' );

	} catch ( Exception $e ) {
		$wpdb->query( 'ROLLBACK' );
		throw $e;
	}

	return is_numeric( $id );
}


/**
 * @param $form
 *
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
 * @param int $user_id
 * @param $form
 *
 * @throws Exception
 */
function save_user_common_info( $user_id, $form ) {
	$data = [
		'uci_userid'                    => $user_id,
		'uci_birth_date'                => format_date( $form['birth-date-y'], $form['birth-date-m'], $form['birth-date-d'] ),
		'uci_sex'                       => $form['ass-sex-m'],
		'uci_family_status'             => $form['ass-family'],
		'uci_citizenship'               => $form['citizenship'],
		'uci_country_residence'         => $form['country-residence'],
		'uci_country_residence_from'    => $form['country-residence-from'],
		'uci_status_residence'          => $form['status-residence'],
		'uci_native_lang'               => $form['native-lang'],
		'uci_passport_num'              => $form['passport-num'],
		'uci_passport_exp_date'         => format_date( $form['passport-exp-y'], $form['passport-exp-m'], $form['passport-exp-d'] ),
		'uci_passport_country'          => $form['passport-country'],
		'uci_ass_phone'                 => $form['ass-phone'],

		//step 10
		'uci_future_province'           => $form['ass-future-province'],
		'uci_future_city'               => $form['ass-future-city'],

		//step 12
		'uci_studied_at_canada'         => $form['ass-studied-at-canada'],
		'uci_partner_studied_at_canada' => $form['ass-partner-studied-at-canada'],

		//step 14
		'uci_worked_at_canada'          => $form['ass-worked-at-canada'],
		'uci_partner_worked_at_canada'  => $form['ass-partner-worked-at-canada']
	];
	try {
		insert_into( 'wp_user_common_info', $data );
	} catch ( Exception $e ) {
		throw $e;
	}
}

/**
 * @param int $user_id
 * @param $form
 *
 * @throws Exception
 */
function save_user_lang( $user_id, $form ) {
	$en_lang = $form['en_lang'];
	$fr_lang = $form['fr_lang'];

	$data = [
		'ul_user_id' => $user_id,

		'ul_fr_listening' => $fr_lang['listening'],
		'ul_fr_writing'   => $fr_lang['writing'],
		'ul_fr_reading'   => $fr_lang['reading'],
		'ul_fr_speaking'  => $fr_lang['speaking'],

		'ul_en_listening' => $en_lang['listening'],
		'ul_en_writing'   => $en_lang['writing'],
		'ul_en_reading'   => $en_lang['reading'],
		'ul_en_speaking'  => $en_lang['speaking']
	];
	try {
		insert_into( 'wp_user_lang', $data );
	} catch ( Exception $e ) {
		throw $e;
	}
}

/**
 * @param int $user_id
 * @param $form
 *
 * @throws Exception
 */
function save_user_relatives( $user_id, $form ) {

	foreach ( $form['relative'] as $item ) {
		$data = [
			'ur_user_id'    => $user_id,
			'ur_last_name'  => $item['ass-rel-last-name'],
			'ur_first_name' => $item['ass-rel-first-name'],
			'ur_rel_with'   => $item['ass-rel-with'],
			'ur_status'     => $item['ass-rel-status'],
			'ur_province'   => $item['ass-rel-province']
		];
		try {
			insert_into( 'wp_user_relatives', $data );
		} catch ( Exception $e ) {
			throw $e;
		}
	}
}

/**
 * @param int $user_id
 * @param $form
 *
 * @throws Exception
 */
function save_user_education( $user_id, $form ) {

	foreach ( $form['education'] as $item ) {
		$date_from = format_date( $item['ass-study-from-y'], $item['ass-study-from-m'], '1' );
		$date_to   = format_date( $item['ass-study-to-y'], $item['ass-study-to-m'], '1' );

		$data = [
			'ued_user_id'          => $user_id,
			'ued_education_name'   => $item['education-name'],
			'ued_speciality'       => $item['education-specialty'],
			'ued_country'          => $item['education-country'],
			'ued_level'            => $item['education-level'],
			'ued_certificate_type' => $item['education-certificate-type'],
			'ued_type'             => $item['education-type'],
			'ued_from'             => $date_from,
			'ued_to'               => $date_to
		];
		try {
			insert_into( 'wp_user_education', $data );
		} catch ( Exception $e ) {
			throw $e;
		}
	}
}

/**
 * @param int $user_id
 * @param $form
 *
 * @throws Exception
 */
function save_user_work( $user_id, $form ) {

	foreach ( $form['work'] as $item ) {
		$date_from = format_date( $item['ass-company-from-y'], $item['ass-company-from-m'], '1' );
		$date_to   = format_date( $item['ass-company-to-y'], $item['ass-company-to-m'], '1' );

		$data = [
			'uw_user_id'             => $user_id,
			'uw_company_name'        => $item['company-name'],
			'uw_company_country'     => $item['company-country'],
			'uw_company_position'    => $item['company-position'],
			'uw_company_from'        => $date_from,
			'uw_company_to'          => $date_to,
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
 * @param int $user_id
 * @param $form
 *
 * @return int
 * @throws Exception
 */
function save_user_partner_info( $user_id, $form ) {

	$item = $form['partner'];

	$relation_from = format_date( $item['member-relation-from-y'], $item['member-relation-from-m'], '1' );
	$relation_to   = format_date( $item['member-relation-to-y'], $item['member-relation-to-m'], '1' );

	$data = [
		'upi_user_id'       => $user_id,
		'upi_last_name'     => $item['member-last-name'],
		'upi_first_name'    => $item['member-first-name'],
		'upi_birthday'      => format_date( $item['member-birth-year'], $item['member-birth-month'], $item['member-birth-day'] ),
		'upi_sex'           => $item['member-sex'],
		'upi_status'        => $item['member-status'],
		'upi_relation_type' => $item['member-relation-type'],
		'upi_relation_from' => $relation_from,
		'upi_relation_to'   => $relation_to
	];

	try {
		return insert_into( 'wp_user_partner_info', $data );
	} catch ( Exception $e ) {
		throw $e;
	}
}

/**
 * @param int $partner_id
 * @param $form
 *
 * @throws Exception
 */
function save_partner_education( $partner_id, $form ) {
	foreach ( $form['part-educ'] as $item ) {
		$from = format_date( $item['part-educ-from-y'], $item['part-educ-from-m'], '1' );
		$to   = format_date( $item['part-educ-to-y'], $item['part-educ-to-m'], '1' );

		$data = [
			'ped_partner_id'       => $partner_id,
			'ped_education_name'   => $item['part-educ-name'],
			'ped_speciality'       => $item['part-educ-specialty'],
			'ped_country'          => $item['part-educ-country'],
			'ped_level'            => $item['part-educ-level'],
			'ped_certificate_type' => $item['part-educ-certificate-type'],
			'ped_type'             => $item['part-educ-type'],
			'ped_from'             => $from,
			'ped_to'               => $to
		];

		try {
			insert_into( 'wp_partner_education', $data );
		} catch ( Exception $e ) {
			throw $e;
		}
	}
}

/**
 * @param int $partner_id
 * @param $form
 *
 * @throws Exception
 */
function save_partner_work( $partner_id, $form ) {

	foreach ( $form['part-work'] as $item ) {
		$from = format_date( $item['ass-part-work-from-y'], $item['ass-part-work-from-m'], '1' );
		$to   = format_date( $item['ass-part-work-to-y'], $item['ass-part-work-to-m'], '1' );

		$data = [
			'pw_partner_id'          => $partner_id,
			'pw_company_name'        => $item['part-work-name'],
			'pw_company_country'     => $item['part-work-country'],
			'pw_company_position'    => $item['part-work-position'],
			'pw_company_from'        => $from,
			'pw_company_to'          => $to,
			'pw_company_requirement' => $item['part-work-requirement']
		];

		try {
			insert_into( 'wp_partner_work', $data );
		} catch ( Exception $e ) {
			throw $e;
		}
	}
}

/**
 * @param int $user_id
 * @param $form
 *
 * @throws Exception
 */
function save_user_child( $user_id, $form ) {

	foreach ( $form['child'] as $item ) {
		$data = [
			'uc_user_id'  => $user_id,
			'uc_surname'  => $item['child-surname'],
			'uc_name'     => $item['child-name'],
			'uc_birthday' => format_date( $item['child-birth-year'], $item['child-birth-month'], $item['child-birth-day'] )
		];

		try {

			insert_into( 'wp_user_child', $data );

		} catch ( Exception $e ) {
			throw $e;
		}
	}
}

/**
 * @param int $user_id
 * @param $form
 *
 * @throws Exception
 */
function save_user_payment( $user_id, $form ) {

	$data = [
		'usp_user_id' => $user_id,
		'usp_type'    => $form['ass-payment-type']
	];

	try {
		insert_into( 'wp_user_payment', $data );
	} catch ( Exception $e ) {
		throw $e;
	}
}