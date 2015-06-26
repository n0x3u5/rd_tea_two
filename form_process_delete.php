<?php
	require_once('/includes/sessions.php');
	require_once('/includes/functions.php');
?>

<?php
	$connection = make_connection();

	if(isset($_POST["submit_del"])) {
			//2. perform database query
			$query = "SELECT * ";
			$query .= "FROM users ";
			$result = mysqli_query($connection, $query);

			confirm_query($result);


			//retrieving data from form input and session

			$email = $_POST["email"];
			//echo "email =".$email."<br>";

			//echo "session user=". $_SESSION["user"];
			if(isset($_SESSION["user"]))
			{

				$lvl = $_SESSION["user_lvl"];
				//echo "level =" . $lvl;
			}
			else {
				$lvl = NULL;
				//$email = NULL;
			}
	}
	else {
		  $result = NULL;
			$email = NULL;
			$lvl = NULL;
	}

?>


<html lang="en">
	<head>
		<title>form_processor</title>
	</head>
	<body>

		<ul>
		<?php
			$flagE = 0;//flag to check email match
			$flagLvl = 0;
			//3. use returned data(if any)
			while($users = mysqli_fetch_assoc($result)) {
				//print_r($users);
				//echo "<br>".$email." <hr/> <br>";
				if($email == $users["e_mail"]){
					//email exists
					$flagE=1;
					if($lvl <= $users["level"]) {	$flagLvl = 1;	}
					break;
				}
			}

			if($flagE === 1 && $flagLvl === 1) {

				$query = "DELETE FROM users";
				$query .= " WHERE e_mail = '{$email}'";
				$query .= " LIMIT 1";

				$result = mysqli_query($connection, $query);
				confirm_query($result);
				echo "Deleted Successfully!";
				//echo "	level" .$lvl. " and delted lvl = ".$users['level'];

			}
			else if ($flagE ===1 && $flagLvl ===0 ){
				echo "<br>" . "You aren't permited to delete your supirior's records!	level =". $lvl." and delted lvl =". $users['level'];
			}
			else {
				echo "No Match Found!";
			}
		?>
		</ul>

	</body>
</html>

<?php
	mysqli_free_result($result);
	end_connection($connection);
?>
