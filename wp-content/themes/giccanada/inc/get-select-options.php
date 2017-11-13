<?php

require_once get_template_directory() . '/inc/provinces.php';

function getDayOptions() {
	$options = '';
	for ( $i = 1; $i <= 31; ++ $i ) {
		$date    = $i < 10 ? '0' . $i : $i;
		$options .= '<option value = "' . $date . '">' . $date . '</option>';
	}

	return $options;
}

function getMonthOptions() {

	$months = array(
		'0' => 'January',
		'1' => 'February',
		'2' => 'March',
		'3' => 'April',
		'4' => 'May',
		'5' => 'June',
		'6' => 'July',
		'7' => 'August',
		'8' => 'September',
		'9' => 'October',
		'10' => 'November',
		'11' => 'December'
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
