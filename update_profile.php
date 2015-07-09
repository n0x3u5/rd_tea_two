<?php
	require_once('includes/sessions.php');
	require_once('includes/functions.php');

	if(!isset($_SESSION['user'])) {
		redirect_to("index.php");
	}
?>

<?php


	$connection = make_connection();
	$check_flag = 0;


	if(isset($_SESSION["user_email"])){
		$email = $_SESSION["user_email"];
	}
	else{
		$email = NULL;
	}
	//2. perform database query

	$query = "SELECT * ";
	$query .= "FROM users ";
	$query .= "WHERE e_mail = '{$email}'";
	$query .= " LIMIT 1";
	$result = mysqli_query($connection, $query);

	confirm_query($result);

	$users = mysqli_fetch_assoc($result);

	//echo "user designation =".$users["designation"]."<br>";

	$_SESSION["user_id"]= $users["id"];

	$old_pwd = $users['password'];

	if(isset($_POST['edit'])){
		if(password_check($_POST['pwd'], $old_pwd) && $_POST['npwd'] == NULL){
				$query = "UPDATE users SET";
				$query .= " designation='{$_POST['desig']}',";
				$query .= " first_name='{$_POST['f_name']}',";
				$query .= " middle_name='{$_POST['m_name']}',";
				$query .= " last_name='{$_POST['l_name']}',";
				$query .= " e_mail='{$_POST['email']}',";
				$query .= " password='{$old_pwd}'";
				$query .= " WHERE id = '{$_SESSION['user_id']}'";
				//var_dump($query);
				$result = mysqli_query($connection, $query);
				confirm_query($result);
				//echo "Updated successfully!";
				$check_flag = 1;


				//mysqli_free_result($result);
		}
		elseif (password_check($_POST['pwd'], $old_pwd) && $_POST['npwd'] != NULL) {
			if($_POST['npwd'] === $_POST['cnfpwd']){
					if(strlen($_POST['npwd']) >= 5 && strlen($_POST['npwd']) <= 15) {
							$hash_passwd = password_encrypt($_POST['npwd']);
							$query = "UPDATE users SET";
							$query .= " designation='{$_POST['desig']}',";
							$query .= " first_name='{$_POST['f_name']}',";
							$query .= " middle_name='{$_POST['m_name']}',";
							$query .= " last_name='{$_POST['l_name']}',";
							$query .= " e_mail='{$_POST['email']}',";
							$query .= " password='{$hash_passwd}'";
							$query .= " WHERE id = '{$_SESSION['user_id']}'";

							//var_dump($query);
							$result = mysqli_query($connection, $query);
							confirm_query($result);
							//echo "Updated successfully!";
							$check_flag = 1;


							//mysqli_free_result($result);
					}
					else { ?>
						<div class=" container alert alert-warning alert-dismissible" role="alert" style="border-color:yellow">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
							<strong>Strengthen your passowrd!</strong> Add a password of length in between 5 to 15 !
						</div>
					<?php	$check_flag = 0;
					}
			}
			else { ?>
				<div class=" container alert alert-warning alert-dismissible" role="alert" style="border-color:yellow">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
					<strong>Password missmatch!</strong> Make sure the passowrd you have retyped is the same!
				</div>

				<?php $check_flag = 0;
			}
		}
		else{ ?>
			<div class=" container alert alert-warning alert-dismissible" role="alert" style="border-color:yellow">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
				<strong>Wrong Password!</strong> Your password is incorrect!
			</div>

			<?php $check_flag = 0;
		}
	}
	if($check_flag==1)
	{
		if(mysqli_affected_rows($connection) > 0) { ?>
			<div class=" container alert alert-success alert-dismissible" style="border-color:green" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
				<strong>Success!</strong> Your Profile is updated, The changes will be shown after the next login.

			</div>
		<?php }
		else { ?>
			<div class=" container alert alert-warning alert-dismissible" role="alert" style="border-color:yellow">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
				<strong>Sorry!</strong> No row affected!
			</div>
			<?php }
	 } ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/stylesheet.css">
        <link rel="icon" href="images/logo_rdtea.png"/>
        <title>R.D. Tea | Edit Profile</title>
        <?php $page_id = 3;?>
    </head>
    <body>
      <?php
              include("nav_bar.php");
              nav_echoer($page_id);
          ?>
        <div class="container">
            <div class="jumbotron" style="background-color:#673ab7">
                    <h1>Your Profile</h1>
                    <p style="color: #b39ddb">View and review information about yourself.</p>
            </div>
            <div class="main-content" style="background-color:#FFFFFF">
                <form action="update_profile.php" method="post">
										<div class="input-group">
											<input class="form-control" name="desig" type="text" value="<?php echo $users['designation'];?>" >
											<span class="input-group-addon"><i class="glyphicon glyphicon-star-empty" ></i></span>
										</div>
                    <div class="input-group">
                        <input class="form-control" name="f_name" type="text" value="<?php echo $users["first_name"]?>" >
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user" ></i></span>
                    </div>
                    <div class="input-group">
                        <input class="form-control" name="m_name" type="text" value="<?php echo $users["middle_name"]?>" >
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user" ></i></span>
                    </div>
                    <div class="input-group">
                        <input class="form-control" name="l_name" type="text" value="<?php echo $users["last_name"]?>" >
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user" ></i></span>
                    </div>

	                    <div class="input-group">
	                        <input class="form-control" name="email" type="email" value="<?php echo $users["e_mail"]?>" >
	                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope" ></i></span>
                    	</div>

                    <div class="input-group">
                        <input class="form-control" name="pwd" type="password" placeholder="Old Password" required>
                        <span class="input-group-addon"><i class="glyphicon glyphicon-asterisk" ></i></span>
                    </div>
                    <div class="input-group">
                        <input class="form-control" name="npwd" type="password" placeholder="New Password" >
                        <span class="input-group-addon"><i class="glyphicon glyphicon-asterisk" ></i></span>
                    </div>
                    <div class="input-group">
                        <input class="form-control" name="cnfpwd" type="password" placeholder="Confirm New Password">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-asterisk" ></i></span>
                    </div>
                    <input type="submit" name="edit" value="Save Changes" class="btn btn-primary" style="background:#673ab7" id="save_change">
                    </div>
                </form>



            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    </body>
</html>

<?php
	//mysqli_free_result($result);
	end_connection($connection);
?>
