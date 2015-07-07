<?php
	require_once('/includes/sessions.php'); //starting the session
	require_once('/includes/functions.php');//including funtion files
?>

<?php

	$connection = make_connection(); //creating the connection
		if(isset($_POST['login_submit'])){ //-----------------------------------------------------
			//2. perform database query
			$query = "SELECT * ";
			$query .= "FROM users ";
			$result = mysqli_query($connection, $query);

			confirm_query($result);
			//$users = mysqli_fetch_assoc($result);
			//print_r($users);

			//retrieving data from form input or post request that was sent
			$email = mysqli_escape_string($connection, $_POST["email"]);
			$password = mysqli_escape_string($connection, $_POST["password"]);

		}
		else {
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
				// var_dump($users);
				//echo "<hr>";
				//echo "<br>". $email. " ". $users["e_mail"] ."<br>";
				//echo "<br>". $password. " ". $users["password"]."<br>";
				//echo "<hr />";

				if($email === $users["e_mail"]){
					//email exists
					$flagE=1;
					//echo "<br>". $email. "                       ". $users["e_mail"] ."<br>";
					if(password_check($password, $users["password"])) {
						//password matches

						//echo "<br>". $password. "                     ". $users["password"]."<br>";
						$flagP=1;
						break;
					}
				}

			}

			//echo "<br> <br>". $flagP ."              " .$flagE ."<br>";

			if($flagP === 1 && $flagE === 1) {
				$_SESSION["message"] = "Hello! " . $users["first_name"] . ($users["middle_name"] == ""? " " : " " . $users["middle_name"] . " ") . $users["last_name"] . ", you are logged in!";

				$_SESSION["user_lvl"] = $users["level"];
				$_SESSION["user_email"] = $users["e_mail"];
				$_SESSION["user"] = $users["first_name"] . ($users["middle_name"] == ""? " " : " " . $users["middle_name"] . " ") . $users["last_name"];
			}
			else {
				$_SESSION["user_lvl"] = NULL;
				$_SESSION["user_email"] = NULL;
				$_SESSION["user"] = NULL;
				$_SESSION["message"] = "password/email error!";
			}

			//echo "session level = <br> <br>".$_SESSION["user_lvl"]."<br><br>";
			if($_SESSION["user_lvl"]!= NULL && $_SESSION["user_lvl"] != 3 ) {
				 redirect_to("manage_users.php");
				 //echo  session_msg() . "<br>" ;
			}
			else if( $_SESSION["user_lvl"] == 3 ) {
				//echo session_msg() . "<br>"; //. $_SESSION["user_lvl"];
				redirect_to("update_profile.php");
			}
			else {
				echo  session_msg() . "<br>"; //. $_SESSION["user_lvl"];
				 redirect_to("http://localhost/rd_tea_two/login_attempt1.php");
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
