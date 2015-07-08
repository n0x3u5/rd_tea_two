<?php
	require_once('includes/sessions.php');
	require_once('includes/functions.php');

	if(!isset($_SESSION['user'])) {
    redirect_to("index.php");
  }
	if(isset($_SESSION['user_lvl']) && $_SESSION['user_lvl'] == 3) {
		redirect_to("update_profile.php");
	}
	$connection = make_connection();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/stylesheet.css">
        <link rel="icon" href="images/logo_rdtea.png"/>
        <title>R.D. Tea | Manage Users</title>
				<?php $page_id = 1;?>
    </head>
    <body>
        <?php
            include("nav_bar.php");
             nav_echoer($page_id);
        ?>
        <div class="container">
					<div class="alert alert-danger alert-dismissible" role="alert" style="border-color:red">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>Success</strong> Deleted sucessfully.
					</div>
				    <div class="jumbotron">
                <h1>Manage Users</h1>
                <p>Perform administrative actions to moderate access to the Information Network</p>
            </div>


						<div class="tab-container">
                <ul class="nav nav-tabs nav-justified">
                    <li class="active"><a href="#tab1" data-toggle="tab">Add User</a></li>
                    <li><a href="#tab2" data-toggle="tab">Remove User</a></li>
                    <!-- <li class="special">Some something here. Show something here.</li> -->
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab1">
                        <h4>Enter the following details and hit submit to add a new user to the Information Network.</h4>
                        <div>
                            <form action="form_process_insert.php" class="form-horizontal" method="post">
															<div class="form-group" style="margin-top:30px;">
																<label for="desig" class="col-sm-3 control-label">Designation:</label>
																<div class="input-group">
																    <input class="form-control" name="desig" type="text" placeholder="Designation" required>
																    <span class="input-group-addon"><i class="glyphicon glyphicon-star-empty" ></i></span>
																</div>
															</div>
															<div class="form-group">
																<label for="f_name" class="col-sm-3 control-label">First Name:</label>
																<div class="input-group">
																    <input class="form-control" name="f_name" type="text" placeholder="First Name" required>
																    <span class="input-group-addon"><i class="glyphicon glyphicon-user" ></i></span>
																</div>
															</div>
															<div class="form-group">
																<label for="m_name" class="col-sm-3 control-label">Middle name:</label>
																<div class="input-group">
																    <input class="form-control" name="m_name" type="text" placeholder="Middle Name">
																    <span class="input-group-addon"><i class="glyphicon glyphicon-user" ></i></span>
																</div>
														</div>
														<div class="form-group">
															<label for="l_name" class="col-sm-3 control-label">Last name:</label>
															<div class="input-group">
																	<input class="form-control" name="l_name" type="text" placeholder="Last Name" required>
																	<span class="input-group-addon"><i class="glyphicon glyphicon-user" ></i></span>
															</div>
														</div>
														<div class="form-group">
															<label for="level" class="col-sm-3 control-label">Level:</label>
															<div class="input-group">
																<select class="form-control">
																	<option value="NULL">Select level</option>
																	<option>1</option>
																	<option>2</option>
																	<option>3</option>
																</select>
																	<span class="input-group-addon"><i class="glyphicon glyphicon-user" ></i></span>
															</div>
														</div>
															<div class="form-group">
																<label for="email" class="col-sm-3 control-label">Email-id:</label>
																<div class="input-group">
																		<input class="form-control" name="email" type="email" placeholder="Email" required>
																		<span class="input-group-addon"><i class="glyphicon glyphicon-envelope" ></i></span>
																</div>

															</div>
															<div class="form-group">
																<label for="pwd" class="col-sm-3 control-label">Password:</label>
																<div class="input-group">
																    <input class="form-control"  id="pwd1" name="pwd" type="Password" placeholder="Password" required>
																    <span class="input-group-addon"><i class="glyphicon glyphicon-asterisk" ></i></span>
																</div>
															</div>
															<div class="form-group">
																<label for="cnfpwd" class="col-sm-3 control-label">Retype Password:</label>
																<div class="input-group">
																    <input class="form-control" id="pwd2" name="cnfpwd" type="Password" placeholder="Confirm Password" required>
																    <span class="input-group-addon" ><i class="glyphicon glyphicon-asterisk" ></i></span>
																</div>
															</div>
															<div class="form-group">
																<label for="sbm" class="col-sm-3 control-label"></label>
																<div class="input-group">
																	<input type="submit" id="sbm" value="Submit" class="btn btn-primary" onclick="chk()">
																</div>
															</div>
														</form>
                         </div>
                    </div>
                    <div class="tab-pane" id="tab2">
                        <h4>Enter the email id of the user to remove from the Information Network.</h4>
                        <div>
                            <form action="form_process_delete.php" method="post">
                                <div class="input-group">
																		<select  id="emailid" name ="emailid" class="form-control" required>
																			<option value="NULL">Select email-id</option>
																			<?php
																					$q = "SELECT * FROM users";
																					$r = mysqli_query($connection, $q);

																					confirm_query($r);
																					while($user_values = mysqli_fetch_assoc($r)) {
																			?>
																						<option value="<?php echo htmlentities($user_values['e_mail']); ?>"><?php echo htmlentities($user_values['e_mail']); ?></option>
																			<?php
																					}
																			?>
																		</select>
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope" ></i></span>
                                </div>
                                <button type="button" name="email_submit" class="btn btn-danger" data-toggle="modal" data-target="#confirmModal">Remove</button>
                                <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">Are you sure?</h4>
                                            </div>
                                            <div class="modal-body">
                                                <h6>Are you sure you want to delete this user from the database? <strong>This action cannot be undone.</strong></h6>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <input type="submit" name="submit_del" value="Yes, I'm sure." class="btn btn-danger"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

    </body>
</html>
