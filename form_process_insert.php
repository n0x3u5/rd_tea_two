<?php
	require_once('/includes/sessions.php');
	require_once('/includes/functions.php');
?>

<?php	$connection = make_connection();	?>

<?php

	//$query = "SELECT * FROM users";

	$id = mysqli_insert_id($connection) + 1;
	$designation = $_POST["desig"];
	$first_name = $_POST["f_name"];
	$middle_name = $_POST["m_name"];
	$last_name = $_POST["l_name"];
	$e_mail = $_POST["email"];
	$passwd = $_POST["pwd"];//password_encrypt($_POST["pwd"]);
	$cnfpwd = $_POST["cnfpwd"];//password_encrypt($_POST["cnfpwd"]);

	if( $passwd == $cnfpwd){

		$hash_passwd = password_encrypt($passwd);
		echo "hash password is:".$hash_passwd.", and its length is:".strlen($hash_passwd)."<br>";

		if($designation == "Managing Director" || $designation == "Director") {
			$level = 1;
		}
		else if ($designation == "Manager" || $designation == "Mngr" || $designation == "Man") {
			$level = 2;
		}
		else {
			$level = 3;
		}


		//2. perform database query
		$query = "INSERT INTO users (";
		$query .= "designation, level,";
		$query .= " first_name, middle_name, last_name,";
		$query .= " e_mail, password";
		$query .= ") VALUES (";
		$query .= "'{$designation}', {$level},";
		$query .= " '{$first_name}', '{$middle_name}', '{$last_name}',";
		$query .= " '{$e_mail}', '{$hash_passwd}'";
		$query .= ")";


		$result = mysqli_query($connection, $query);
		confirm_query($result);
		echo "Inserted Successfully!";

	}
	else {
		redirect_to("manage_users.php");

	}
?>
	<?php
		end_connection($connection);
	?>
