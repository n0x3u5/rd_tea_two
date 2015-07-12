<?php

//connection functions----------------------------------------------------------------
	function make_connection() {
		define("DB_SERVER","localhost");
		define("DB_USER","root");
		define("DB_PASS","joydipnox");
		define("DB_NAME","rd_tea_two");
	// 1. Creating a database connection_aborted
		$connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

		//testing connection error
		if(mysqli_connect_errno()) {
			die("Database connection failed: " . mysqli_connect_error() .
				" (" . mysqli_connect_errno() . ")"
				);
		}
		return $connection;
	}

	function end_connection($connection) {
		// 5. Close database connection
		mysqli_close($connection);
	}
//---------------------------------------------------------------------------------------


	function confirm_query($result_set){
		global $connection;
		if(!$result_set){
			//failure
			//$message = " creation error"
			$err="<div class='container alert alert-warning alert-dismissible' role='alert' style='border-color:black'>
						<button type='button' class='close' data-dismiss='alert' aria-label='Close' ><span aria-hidden='true'>&times;</span></button>
						<strong>Sorry!</strong> No row affected!
					</div>";
			die("database query failed.". mysqli_error($err));
		}
	}

	function redirect_to($new_location) {
		header("Location: " . $new_location);
		exit();
	}


	//password hashing functions ------------------------------
	function password_encrypt($password) {
		$hash_format = "$2y$10$";
		$salt_length = 22;
		$salt = generate_salt($salt_length);
		$format_and_salt = $hash_format . $salt;
		$hash = crypt($password, $format_and_salt);
		return $hash;
	}

	function generate_salt($length) {
		$unique_random_string = md5(uniqid(mt_rand(), true));
		$base64_string = base64_encode($unique_random_string);
		$modified_base64_string = str_replace('+', '.', $base64_string);

		$salt = substr($modified_base64_string, 0, $length);

		return $salt;
	}

	function password_check($password, $existing_hash) {
		$hash = crypt($password, $existing_hash);
		if($hash === $existing_hash) {
			//echo "new hash:".$hash."<br>old hash:".$existing_hash;
			return true;
		}
		else {
			//echo "new hash:".$hash."<br>old hash:".$existing_hash;
			return false;
		}
	}

	function explode_implode($imploded_string) {
		$exploded_string = explode(", ", $imploded_string);
		$imploded_db_str = implode("¥", $exploded_string);

		return $imploded_db_str;
	}
	function comma_sep_val($val_sent) {
		$prep_val = str_replace("¥", ", ", $val_sent);
		return $prep_val;
	}
?>
