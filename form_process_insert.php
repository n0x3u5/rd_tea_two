<?php
	require_once('includes/sessions.php');
	require_once('includes/functions.php');

?>

<?php	$connection = make_connection();	?>

<?php

	//$query = "SELECT * FROM users";

	//$id = mysqli_insert_id($connection) + 1;
	$division = mysqli_real_escape_string($connection, $_POST["division"]);
	$designation = mysqli_real_escape_string($connection, $_POST["desig"]);
	$first_name = mysqli_real_escape_string($connection, $_POST["f_name"]);
	$middle_name = mysqli_real_escape_string($connection, $_POST["m_name"]);
	$last_name = mysqli_real_escape_string($connection, $_POST["l_name"]);
	$level = (int) mysqli_real_escape_string($connection, $_POST["level"]);
	$e_mail = mysqli_real_escape_string($connection, $_POST["email"]);
	$passwd = mysqli_real_escape_string($connection, $_POST["pwd"]);//password_encrypt($_POST["pwd"]);
	$cnfpwd = mysqli_real_escape_string($connection, $_POST["cnfpwd"]);//password_encrypt($_POST["cnfpwd"]);

	if( $passwd == $cnfpwd){
		if(strlen($passwd) >= 5 && strlen($passwd) <= 15) {

				$hash_passwd = password_encrypt($passwd);
				//echo "hash password is:".$hash_passwd.", and its length is:".strlen($hash_passwd)."<br>";

				//2. perform database query
				$query = "INSERT INTO users (";
				$query .= "division, designation, level,";
				$query .= " first_name, middle_name, last_name,";
				$query .= " e_mail, password";
				$query .= ") VALUES (";
				$query .= "'{$division}', '{$designation}', {$level},";
				$query .= " '{$first_name}', '{$middle_name}', '{$last_name}',";
				$query .= " '{$e_mail}', '{$hash_passwd}'";
				$query .= ")";


				$result = mysqli_query($connection, $query);
				confirm_query($result);
				echo "Inserted Successfully!";

				redirect_to("on_success_manage_user.php");
				//mysqli_free_result($result);
			}
			else {
				echo "Your password lengthe must be of 5 to 15 charecters!";
			}
	}
	else {
		redirect_to("manage_users.php");

	}
?>
	<?php
		//mysqli_free_result($result);
		end_connection($connection);
	?>
