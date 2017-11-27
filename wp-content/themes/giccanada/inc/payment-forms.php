<?php

function getLiqPay($lang) {
	$public_key = 'i3872387445';
	$private_key = 'FEG8q2N6Iv5RocGoLq3xSk58NxwV1cJPLwJSvONw';

	$micro = sprintf("%06d", (microtime(true) - floor(microtime(true))) * 1000000); // Ну раз что-то нужно добавить для полной уникализации то ..
	$number = date("YmdHis"); //Все вместе будет первой частью номера ордера
	$order_id = $number . $micro; //Будем формировать номер ордера таким образом...
	require_once(get_template_directory() . '/LiqPay.php');
	$liqpay = new LiqPay($public_key, $private_key);
	$server = ( isset( $_SERVER['HTTPS'] ) ? "https" : "http" ) . "://$_SERVER[HTTP_HOST]";
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
		'result_url' => $server,
		'info' => $server
	);
	return $liqpay->cnb_form('ass-liqpay', $data);
}

