<?php
	
	function make_connection() {
		define("DB_SERVER","localhost");
		define("DB_USER","root");
		define("DB_PASS","joydipnox");
		define("DB_NAME","rd_tea");
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
?>