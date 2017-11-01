<?php

class UploadException extends Exception
{
	public function __construct($code) {
		$message = $this->codeToMessage($code);
		parent::__construct($message, $code);
	}

	private function codeToMessage($code)
	{
		switch ($code) {
			case UPLOAD_ERR_INI_SIZE:
				$message = "The uploaded file exceeds the upload_max_filesize directive in php.ini";
				break;
			case UPLOAD_ERR_FORM_SIZE:
				$message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form";
				break;
			case UPLOAD_ERR_PARTIAL:
				$message = "The uploaded file was only partially uploaded";
				break;
			case UPLOAD_ERR_NO_FILE:
				$message = "No file was uploaded";
				break;
			case UPLOAD_ERR_NO_TMP_DIR:
				$message = "Missing a temporary folder";
				break;
			case UPLOAD_ERR_CANT_WRITE:
				$message = "Failed to write file to disk";
				break;
			case UPLOAD_ERR_EXTENSION:
				$message = "File upload stopped by extension";
				break;
			default:
				$message = "Unknown upload error";
				break;
		}
		return $message;
	}
}

function upload($name) {
	if ($_FILES[$name]['error'] == UPLOAD_ERR_OK) {
//		$type = $_FILES[$name]['type'];
//		$size = $_FILES[$name]['size'];
		$file_ext = pathinfo($_FILES[$name]['name'])['extension'];
		$file_name = pathinfo($_FILES[$name]['name'])['filename'];
		$hash_file_name = md5($file_name) . ".$file_ext";
		$tmp_name = $_FILES[$name]["tmp_name"];

		$hex_year = bin2hex( date("Y") );
		$hex_month = bin2hex( date("m") );
		$hex_day =  bin2hex( date("d") );

		$new_path = get_stylesheet_directory() . "/public/uploads/$hex_year";

		if ( !is_dir( $new_path ) ) {
			mkdir($new_path, 0775);
			chmod($new_path, 0775);
			$new_path .= "/$hex_month";
			mkdir($new_path, 0775);
			chmod($new_path, 0775);
			$new_path .= "/$hex_day";
			mkdir($new_path, 0775);
			chmod($new_path, 0775);
		} else {
			$new_path = get_stylesheet_directory() . "/public/uploads/$hex_year/$hex_month/$hex_day";
		}

	} else {
		throw new UploadException($_FILES[$name]['error']);
	}
	$res = move_uploaded_file($tmp_name, "$new_path/$hash_file_name") ? $new_path : error_get_last();
	return $res;
}


function remove_file($fileName) {
	//TODO
}