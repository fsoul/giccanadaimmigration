<?php

// Function to get the client IP address
function get_client_ip() {
	$ip = '';
	if (isset($_SERVER['HTTP_CLIENT_IP']))
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	else if(isset($_SERVER['HTTP_X_FORWARDED']))
		$ip = $_SERVER['HTTP_X_FORWARDED'];
	else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
		$ip = $_SERVER['HTTP_FORWARDED_FOR'];
	else if(isset($_SERVER['HTTP_FORWARDED']))
		$ip = $_SERVER['HTTP_FORWARDED'];
	else if(isset($_SERVER['REMOTE_ADDR']))
		$ip = $_SERVER['REMOTE_ADDR'];
	else
		$ip = '127.0.0.1';
	return $ip == '127.0.0.1' ? '89.252.56.204' : $ip;
}

function getCountryByIp() {
	$pathToLib = get_template_directory() . "/SxGeo.php";
	$pathToDB = get_template_directory() . "/SxGeo.dat";
	require_once($pathToLib);
	$SxGeo = new SxGeo($pathToDB);
	$ip = get_client_ip();
	$isoCode = $SxGeo->getCountry($ip);
	unset($SxGeo);
	return $isoCode;
}

function getLiqPay() {
	$public_key = 'i3872387445';
	$private_key = 'FEG8q2N6Iv5RocGoLq3xSk58NxwV1cJPLwJSvONw';

	$micro = sprintf("%06d", (microtime(true) - floor(microtime(true))) * 1000000); // Ну раз что-то нужно добавить для полной уникализации то ..
	$number = date("YmdHis"); //Все вместе будет первой частью номера ордера
	$order_id = $number . $micro; //Будем формировать номер ордера таким образом...
	require_once(get_template_directory() . '/LiqPay.php');
	$liqpay = new LiqPay($public_key, $private_key);
	$server = ( isset( $_SERVER['HTTPS'] ) ? "https" : "http" ) . "://$_SERVER[HTTP_HOST]";
	$lang = strtolower( getCountryByIp() );
	$data = array(
		'sandbox' => 1, //Включает тестовый режим. Средства с карты плательщика не списываются.
		//Для включения тестового режима необходимо передать значение 1.
		//Все тестовые платежи будут иметь статус sandbox - успешный тестовый платеж.
		'version' => 3,
		'public_key' => $public_key,
		'action' => 'pay',
		'amount' => 10,
		'currency' => 'ua' == $lang ? LiqPay::CURRENCY_UAH: LiqPay::CURRENCY_RUB,
		'description' => 'Оплата за регистрацию иммиграционного файла',
		'order_id' => $order_id,
		'language' => 'ua' == $lang ? $lang: 'ru',
		'server_url' => "$server/liqpay-callback.php",
		'result_url' => $server
	);
	echo $liqpay->cnb_form('ass-liqpay', $data);
}

$country = getCountryByIp();

switch ($country) {
	case 'UA':
	case 'AZ':
	case 'AM':
	case 'BY':
	case 'KZ':
	case 'KG':
	case 'MD':
	case 'RU':
	case 'TJ':
	case 'TM':
	case 'UZ':
		getLiqPay();
		break;
}
?>
