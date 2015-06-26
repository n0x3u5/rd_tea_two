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
			die("database query failed.". mysqli_error($connection));
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
			echo "new hash:".$hash."<br>old hash:".$existing_hash;
			return true;
		}
		else {
			echo "new hash:".$hash."<br>old hash:".$existing_hash;
			return false;
		}
	}
	//--------------------------------------------------------------------------------

?>
