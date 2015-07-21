<?php
	require_once('includes/sessions.php'); //starting the session
	require_once('includes/functions.php');//including funtion files
?>

<?php

	$connection = make_connection(); //creating the connection
		if(isset($_POST['login_submit'])){
			$_SESSION['login'] = "Yes";
			$query = "SELECT * ";
			$query .= "FROM users ";
			$result = mysqli_query($connection, $query);

			confirm_query($result);
			//retrieving data from form input or post request that was sent
			$email = mysqli_escape_string($connection, $_POST["email"]);
			$password = mysqli_escape_string($connection, $_POST["password"]);

		}
		else {
			$_SESSION['login'] = NULL;
			$result = NULL;
			$email = NULL;
			$password = NULL;
		}

	//echo "<br>".$email ."<br>". $password;
?>

<html lang="en">
	<head>
		<title>LOGIN_form_processor</title>
	</head>
	<body>

		<ul>
		<?php
			$flagE = 0;//flag to check email match
			$flagP = 0;//flag to check password match

			//3. use returned data(if any)
			while($users = mysqli_fetch_assoc($result)) {
				if($email === $users["e_mail"]){
					//email exists
					$flagE=1;
					if(password_check($password, $users["password"])) {
						$flagP=1;
						break;
					}
				}

			}

			if($flagP === 1 && $flagE === 1) {
				$_SESSION["message"] = "Hello! " . $users["first_name"] . ($users["middle_name"] == ""? " " : " " . $users["middle_name"] . " ") . $users["last_name"] . ", you are logged in!";

				$_SESSION["user_lvl"] = $users["level"];
				$_SESSION["user_email"] = $users["e_mail"];
				$_SESSION["user_div"] = $users["division"];
				$_SESSION["user"] = $users["first_name"] . ($users["middle_name"] == ""? " " : " " . $users["middle_name"] . " ") . $users["last_name"];
			}
			else {
				$_SESSION["user_lvl"] = 101;
				$_SESSION["user_email"] = NULL;
				$_SESSION["user"] = NULL;
				$_SESSION["user_div"] = NULL;
				$_SESSION["message"] = "password/email error!";
			}

			if( $_SESSION["user_lvl"] == 0) {
				redirect_to("weather.php");
			}
			if( $_SESSION["user_lvl"] == 1 ) {
				redirect_to("leaf_chit.php");
			}
			else if($_SESSION["user_lvl"] == 2 ) {
				redirect_to("manage_users.php");
			}
			else if( $_SESSION["user_lvl"] == 3 ) {
				$_SESSION['entry_flag'] = 1;
				redirect_to("daily_plucking_entry.php");
			}
			else if($_SESSION["user_lvl"] == 101) {
				echo  session_msg() . "<br>";
				 redirect_to("login_attempt1.php");
			}
			else {
				$_SESSION['entry_flag'] = 0;
			}

		?>
		</ul>

		<?php
			//4.release returned data
			mysqli_free_result($result);
		?>

	</body>
</html>

<?php
	end_connection($connection);
?>
