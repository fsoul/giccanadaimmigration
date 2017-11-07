<?php
function send_open_case_form() {

	global $wpdb;

	$form = $_POST['form'];
	foreach ( $form as $key => $value ) {
		$form[ $key ] = htmlspecialchars( strip_tags( stripcslashes( trim( $value ) ) ) );
	}


	$is_email_sent = $wpdb->get_var( $wpdb->prepare( "
												SELECT COUNT(*) 
												FROM wp_open_case 
												WHERE open_case_email = %s",
			$form['email']
		) ) > 0;
	//Проверка была ли подписка
	if ( $is_email_sent ) {
		$ans_msg   = 'This email is already subscribed!';
		$isSuccess = false;
	} else {
		$wpdb->insert( 'wp_open_case', array(
			'open_case_name'    => $form['first_name'],
			'open_case_phone'   => $form['phone'],
			'open_case_email'   => $form['email'],
			'open_case_country' => $form['country'],
			'open_case_lang'    => $form['lang']
		) );

		if ( $wpdb->insert_id ) {
			require_once( get_template_directory() . '/inc/mails.php' );
			$isSuccess = send_open_case_admin_mail( $form ) && send_open_case_user_mail( $form );
		} else {
			$isSuccess = false;
		}

		$ans_msg = $isSuccess ? 'Form sent successfully!' : 'Failed to send your message!';
	}

	echo json_encode( array(
		'isSuccess' => $isSuccess,
		'message'   => $ans_msg
	) );
	wp_die();
}

add_action( 'wp_ajax_send_open_case_form', 'send_open_case_form' );
add_action( 'wp_ajax_nopriv_send_open_case_form', 'send_open_case_form' );


function send_assessment_form() {

	$form = $_POST['form'];
	foreach ( $form as $key => $value ) {
		$form[ $key ] = htmlspecialchars( strip_tags( stripcslashes( trim( $value ) ) ) );
	}

	require_once( get_template_directory() . '/inc/mails.php' );
	$isSuccess = send_assessment_user_mail( $form );
	$ans_msg   = $isSuccess ? 'Form sent successfully!' : 'Failed to send your message!';

	echo json_encode( array(
		'isSuccess' => $isSuccess,
		'message'   => $ans_msg
	) );
	wp_die();
}

add_action( 'wp_ajax_send_assessment_form', 'send_assessment_form' );
add_action( 'wp_ajax_nopriv_send_assessment_form', 'send_assessment_form' );

function send_start_work_mail() {

	$form = $_POST['form'];
	foreach ( $form as $key => $value ) {
		$form[ $key ] = htmlspecialchars( strip_tags( stripcslashes( trim( $value ) ) ) );
	}

	require_once( get_template_directory() . '/inc/mails.php' );
	$isSuccess = send_start_work_user_mail( $form );
	$ans_msg   = $isSuccess ? 'Form sent successfully!' : 'Failed to send your message!';

	echo json_encode( array(
		'isSuccess' => $isSuccess,
		'message'   => $ans_msg
	) );
	wp_die();
}

add_action( 'wp_ajax_send_start_work_mail', 'send_start_work_mail' );
add_action( 'wp_ajax_nopriv_send_start_work_mail', 'send_start_work_mail' );

function get_feedback_timer() {
	echo intval( get_option( 'feedback_timer' ) ? get_option( 'feedback_timer' ) : 10 );
	wp_die();
}

add_action( 'wp_ajax_get_feedback_timer', 'get_feedback_timer' );
add_action( 'wp_ajax_nopriv_get_feedback_timer', 'get_feedback_timer' );


function get_step_by_index() {
	$index = $_POST['index'];
	ob_start();
	require_once( get_template_directory() . '/inc/get-select-options.php' );
	require_once( get_template_directory() . "/template-parts/assessment-form/form-step-$index.php" );
	$message = ob_get_contents();
	ob_end_clean();
	echo $message;
	wp_die();
}

add_action( 'wp_ajax_get_step_by_index', 'get_step_by_index' );
add_action( 'wp_ajax_nopriv_get_step_by_index', 'get_step_by_index' );

function get_cities_list_by_province() {
	$code = $_POST['code'];
	require_once get_template_directory() . '/inc/provinces.php';
	$cities = getCitiesByProvince( $code );
	echo json_encode( $cities );
	wp_die();
}

add_action( 'wp_ajax_get_cities_list_by_province', 'get_cities_list_by_province' );
add_action( 'wp_ajax_nopriv_get_cities_list_by_province', 'get_cities_list_by_province' );

/**
 *  Save file to current session
 */
function upload_file() {
	if (isset($_FILES['file'])) {
		require_once get_template_directory() . '/inc/upload.php';

		try {
			$file =  new FileLoader($_FILES['file'], false);
			$file->upload_to_session();
			$response = json_encode( array( 'success' => 'OK!' ) );

			FileLoader::upload_files_from_session('test@email.com');//TEMP!!!!!!!!!!!!!!!!!
			echo $response;
			wp_die();

		} catch (Exception $e) {
			echo json_encode( array( 'error' => $e->getMessage() ) );
			wp_die();
		}
	}
}
add_action( 'wp_ajax_upload_file', 'upload_file' );
add_action( 'wp_ajax_nopriv_upload_file', 'upload_file' );

/**
 *  Remove file from current session by `filename` passed in POST
 */
function remove_file_from_session() {
	$filename = $_POST['filename'];

	if (isset($filename)) {
		require_once get_template_directory() . '/inc/upload.php';

		try {
			$response = '';
			if (FileLoader::remove_file_from_session($filename))
				$response = json_encode( array( 'success' => 'OK!' ) );
			echo $response;
			wp_die();

		} catch (Exception $e) {
			echo json_encode( array( 'error' => $e->getMessage() ) );
			wp_die();
		}
	}
}

add_action( 'wp_ajax_remove_file_from_session', 'remove_file_from_session' );
add_action( 'wp_ajax_nopriv_remove_file_from_session', 'remove_file_from_session' );


/**
 *  Save files from current session to server
 */
function save_session_files() {

	if (isset($_SESSION['upload_files']) && count($_SESSION['upload_files']) > 0 ) {
		require_once get_template_directory() . '/inc/upload.php';

		try {
			FileLoader::upload_files_from_session('test@email.com'); //TODO pass email from form
			$response = json_encode( array( 'success' => 'OK!' ) );
			echo $response;
			wp_die();

		} catch (Exception $e) {
			echo json_encode( array( 'error' => $e->getMessage() ) );
			wp_die();
		}
	}
}

add_action( 'wp_ajax_save_session_files', 'save_session_files' );
add_action( 'wp_ajax_nopriv_save_session_files', 'save_session_files' );
