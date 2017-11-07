<?php

class UploadException extends Exception {
	public function __construct( $code ) {
		$message = $this->codeToMessage( $code );
		parent::__construct( $message, $code );
	}

	private function codeToMessage( $code ) {
		switch ( $code ) {
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

/*
 * TODO
 * function load_from_session
 * function load_from_local
 */

class FileLoader {
	public $file_name = '';
	public $ext = '';
	public $size = 0;
	public $error = 0;
	public $path = '';
	public $tmp_name = '';
	public $att_type = 0;

	/**
	 * The `$is_local` has to be 'false' if file is uploaded by agent and 'true' if file is already on a local server.
	 * @var bool
	 */
	private $is_local = false;


	public static function compress( $path ) {
		$handle   = fopen( $path, "r" );
		$contents = fread( $handle, filesize( $path ) );
		fclose( $handle );

		return gzcompress( $contents, 9 );
	}

	public static function create_path() {

		$hex_year  = bin2hex( date( "Y" ) );
		$hex_month = bin2hex( date( "m" ) );
		$hex_day   = bin2hex( date( "d" ) );

		$new_path = get_stylesheet_directory() . "/public/uploads/$hex_year/$hex_month/$hex_day";

		if ( ! is_dir( $new_path ) ) {
			$path = get_stylesheet_directory() . "/public/uploads/$hex_year";
			mkdir( $path, 0775 );
			chmod( $path, 0775 );
			$path .= "/$hex_month";
			mkdir( $path, 0775 );
			chmod( $path, 0775 );
			$path .= "/$hex_day";
			mkdir( $path, 0775 );
			chmod( $path, 0775 );
		}
		if ( ! is_dir( $new_path ) ) {
			throw new Exception( error_get_last()['message'] );
		}

		return "$hex_year/$hex_month/$hex_day";
	}

	/**
	 * @param string $content Compressed file.
	 *
	 * @return string
	 */
	public static function uncompress( $content ) {
		return gzuncompress( $content );
	}

	/**
	 * @param string $email
	 * @param string $fname
	 * @param string $ext
	 * @param string $hname
	 * @param string $path
	 * @param integer $size
	 * @param integer $type
	 *
	 * @throws Exception
	 */
	public static function insert_file_info( $email, $fname, $ext, $hname, $path, $size, $type ) {
		global $wpdb;
		$wpdb->insert( 'wp_attachments',
			array(
				'attach_email'    => $email,
				'attach_filename' => $fname,
				'attach_ext'      => $ext,
				'attach_hashname' => $hname,
				'attach_path'     => $path,
				'attach_size'     => $size,
				'attach_type'     => $type
			) );

		if ( ! $wpdb->insert_id ) {
			throw new Exception( $wpdb->last_error );
		}
	}

	public static function get_type_by_code( $code ) {
		global $wpdb;
		$prepare = $wpdb->prepare('SELECT att_type_id FROM wp_attach_type WHERE att_type_code = %s', $code);
		$type = $wpdb->get_var( $prepare );
		if ( ! $type ) {
			throw new Exception( $wpdb->last_error || 'Unknown attach file' );
		}
		return $type;
	}

	public static function upload_files_from_session( $email ) {
		$path      = self::create_path();
		$full_path = get_stylesheet_directory() . "/public/uploads/$path";

		foreach ( $_SESSION['upload_files'] as $key => $value ) {
			$filename   = pathinfo( $key, PATHINFO_FILENAME );
			$ext        = pathinfo( $key, PATHINFO_EXTENSION );
			$hash       = md5( $filename . ( new DateTime() )->getTimestamp() );
			$h_filename = "$full_path/$hash.$ext";
			$handle     = fopen( $h_filename, "wb" );
			$data = unserialize($value);
			fwrite( $handle, self::uncompress( $data['file']) );
			fclose( $handle );
			if ( error_get_last()['message'] ) {
				throw new Exception( error_get_last()['message'] );
			}
			$size = filesize( $h_filename );
			$type = self::get_type_by_code($data['type']);
			self::insert_file_info( $email, $filename, $ext, $hash, $path, $size, $type );

			if ( error_get_last()['message'] ) {
				throw new Exception( error_get_last()['message'] );
			}

			self::remove_file_from_session( $key );

			if ( error_get_last()['message'] ) {
				throw new Exception( error_get_last()['message'] );
			}

		}
	}

	public static function remove_file_from_session( $name ) {
		if ( isset( $_SESSION['upload_files'][ $name ] ) ) {
			unset( $_SESSION['upload_files'][ $name ] );

			return true;
		}

		return false;
	}

	/**
	 * FileLoader constructor.
	 *
	 * @param array $file_arr array('name' => string, 'type' => string, 'size' => int, 'tmp_name' => string, 'error' => int, 'path' => string)
	 * @param bool $is_local
	 *
	 * @throws UploadException
	 */
	public function __construct( array $file_arr, $is_local = false ) {

		$this->is_local = $is_local;
		$this->error    = $file_arr['error'];

		if ( ! $this->is_local && $this->error != UPLOAD_ERR_OK ) {
			throw new UploadException( $this->error );
		}

		$this->file_name = pathinfo( $_POST['filename'], PATHINFO_FILENAME );
		$this->ext       = pathinfo( $_POST['filename'], PATHINFO_EXTENSION );
		$this->size      = $file_arr['size'];
		$this->att_type  = $file_arr['type'];
		$this->path      = isset( $file_arr['path'] ) ? $file_arr['path'] : '';
		$this->tmp_name  = isset( $file_arr['tmp_name'] ) ? $file_arr['tmp_name'] : '';

		$this->is_local = $is_local;
	}


	/** The function only for files uploaded by agents
	 * @throws Exception
	 */
	public function upload() {
		if ( $this->is_local || count( $_FILES ) === 0 ) {
			throw new Exception( 'The file should be uploaded be agent' );
		}
	}

	/** The function only for files uploaded by agents
	 * @throws Exception
	 */
	public function upload_to_session() {
		if ( $this->is_local || count( $_FILES ) === 0 ) {
			throw new Exception( 'The file should be uploaded be agent' );
		}

		if ( ! strlen( session_id() ) ) {
			session_start();
		}

		$filename = strtolower( pathinfo( $_POST['filename'], PATHINFO_FILENAME ) );
		$ext      = strtolower( pathinfo( $_POST['filename'], PATHINFO_EXTENSION ) );

		$_SESSION['upload_files']["$filename.$ext"] = serialize( array(
			'file' => FileLoader::compress( $this->tmp_name ),
			'type' => $_POST['type']
		) );
	}
}