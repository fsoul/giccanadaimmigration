<?php

require_once get_template_directory() . '/inc/provinces.php';

function getDateOptions() {
	$options = '';
	for ( $i = 1; $i <= 31; ++ $i ) {
		$date    = $i < 10 ? '0' . $i : $i;
		$options .= '<option value = "' . $date . '">' . $date . '</option>';
	}

	return $options;
}

function getMonthOptions() {

	$months = array(
		'1' => 'January',
		'2' => 'February',
		'3' => 'March',
		'4' => 'April',
		'5' => 'May',
		'6' => 'June',
		'7' => 'July',
		'8' => 'August',
		'9' => 'September',
		'10' => 'October',
		'11' => 'November',
		'12' => 'December'
	);

	$options = '';
	foreach ( $months as $key => $value ) {
		$options .= '<option value="' . $key . '">' . $value . '</option>';
	}

	return $options;
}

function getYearOptions() {

	$options = '';
	for ( $year = date( 'Y' ); $year >= 1930; -- $year ) {
		$options .= '<option value = "' . $year . '">' . $year . '</option>';
	}

	return $options;

}

function getProvinceOptions() {
	$provinces = getProvinces();
	$options = '';
	foreach ( $provinces as $key => $value ) {
		$options .= '<option value="' . $key . '">' . $value . '</option>';
	}

	return $options;
}
