<?php
	require_once('/includes/sessions.php');
	require_once('/includes/functions.php');

	if(!isset($_SESSION['user'])) {
		redirect_to("index.php");
	}
?>
<?php
	$connection = make_connection();

	//var_dump($_POST);echo "<br><hr>";
	if(isset($_POST["dt_sec_submit"])){
		$req_date = date('Y-m-d', strtotime($_POST["date_value"]));
		$req_ssn = $_POST["short_sec_name"];
		$_SESSION['ssn'] = $req_ssn;
		$_SESSION['date'] = $req_date;


		// echo "<br>got date =".$req_date."<br>";
		// echo "<br>got ssn =" .$req_ssn."<br>";
		// var_dump($req_date);echo "<br>"; var_dump($req_ssn);

		$query = "SELECT * FROM daily_plucking WHERE short_sec_name='{$req_ssn}' and record_date='{$req_date}'";

		$result = mysqli_query($connection, $query);
    confirm_query($result);

		$_SESSION['daily_plucking'] = mysqli_fetch_assoc($result);
		//$daily =mysqli_fetch_assoc($result);
	}
	else {
		$req_date = NULL;
		$req_ssn = NULL;
	}

	if (isset($_POST['add_submit'])) {
		$short_sec_name = $_SESSION['ssn'];
		$record_date = $_SESSION['date'];

		$prune = mysqli_real_escape_string($connection, $_POST['prune']);
		$plucked_area = mysqli_real_escape_string($connection, $_POST['plucked_area']);
		$leaf_plucked = mysqli_real_escape_string($connection, $_POST['leaf_plucked']);
		$hz_area = mysqli_real_escape_string($connection, $_POST['hz_area']);
		$db_area = mysqli_real_escape_string($connection, $_POST['db_area']);
		$hz_qty = mysqli_real_escape_string($connection, $_POST['hz_qty']);
		$db_qty = mysqli_real_escape_string($connection, $_POST['db_qty']);
		$mandays = mysqli_real_escape_string($connection, $_POST['mandays']);

		$query = "INSERT INTO daily_plucking (short_sec_name, record_date,";
		$query .= " prune, plucked_area, leaf_plucked, hz_area, hz_qty,";
		$query .= " db_area, db_qty, mandays)";
		$query .= " VALUES (";
		$query .= "'{$short_sec_name}', '{$record_date}', '{$prune}', {$plucked_area},";
		$query .= " {$leaf_plucked}, {$hz_area}, {$hz_qty}, {$db_area}, {$db_qty},";
		$query .= " {$mandays})";

		$result = mysqli_query($connection, $query);

    confirm_query($result);
    echo "Inserted successfully!";


		$_SESSION['daily_plucking'] = NULL;
	}


	if(isset($_POST['edit_submit'])) {

		// $query = "SELECT * FROM daily_plucking WHERE short_sec_name='{$req_ssn}' and record_date='{$req_date}'";
		//
		// $result = mysqli_query($connection, $query);
    // confirm_query($result);

		$short_sec_name = $_SESSION['ssn'];
		$record_date = $_SESSION['date'];
		$req_id = $_SESSION['daily_plucking']['id'];

		$prune = mysqli_real_escape_string($connection, $_POST['prune']);
		$plucked_area = mysqli_real_escape_string($connection, $_POST['plucked_area']);
		$leaf_plucked = mysqli_real_escape_string($connection, $_POST['leaf_plucked']);
		$hz_area = mysqli_real_escape_string($connection, $_POST['hz_area']);
		$db_area = mysqli_real_escape_string($connection, $_POST['db_area']);
		$hz_qty = mysqli_real_escape_string($connection, $_POST['hz_qty']);
		$db_qty = mysqli_real_escape_string($connection, $_POST['db_qty']);
		$mandays = mysqli_real_escape_string($connection, $_POST['mandays']);

		$query = "UPDATE daily_plucking SET short_sec_name = '{$short_sec_name}', record_date = '{$record_date}',";
		$query .= " prune = '{$prune}', plucked_area = {$plucked_area}, leaf_plucked = {$leaf_plucked},";
		$query .= " hz_area = {$hz_area}, hz_qty = {$hz_qty},";
		$query .= " db_area = {$db_area}, db_qty = {$db_qty}, mandays = {$mandays} WHERE id ={$req_id}";

		$result = mysqli_query($connection, $query);

		confirm_query($result);
		echo "Updated successfully!";

		$_SESSION['daily_plucking'] = NULL;
	}

	if(isset($_POST['del_entry'])){
		$short_sec_name = $_SESSION['ssn'];
		$record_date = $_SESSION['date'];

		$query = "DELETE FROM daily_plucking WHERE short_sec_name='{$short_sec_name}' and record_date='{$record_date}'";

		$result = mysqli_query($connection, $query);
		confirm_query($result);
		echo "Deleted successfully!";

		$_SESSION['daily_plucking'] = NULL;
	}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>R.D. Tea | Manage Sections</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
        <link rel="stylesheet" href="css/stylesheet.css">
        <link rel="icon" href="images/logo_rdtea.png"/>
        <?php $page_id = 7;?>
    </head>
    <body>
         <?php
            include("nav_bar.php");
            nav_echoer($page_id);
        ?>
        <div class="container">
            <div class="jumbotron" style="background:#BF360C;margin-left:-15px;margin-right: -15px;">
                <h1>Daily Data Entry</h1>
                <form action="input_daily.php" method="post" class="form form-group form-inline" style="margin-top: 30px;">
									<select id="division" name ="short_sec_name" class="form-control">
										<?php
												$q = "SELECT * FROM sections";
												$result = mysqli_query($connection, $q);

												confirm_query($result);
												//$_POST['sec_short_nm'] = NULL;

												echo "<option id=\"opt0\" value=NULL> </option>";
												while($sec_values = mysqli_fetch_assoc($result)) {
										?>
													<option value="<?php echo htmlentities($sec_values['short_sec_name']) ?>"><?php echo htmlentities($sec_values['short_sec_name']); ?></option>
										<?php
												}
										?>
									</select>
											<div class="input-group">
	                        <input type="text" name="date_value" class="form-control" id="datepicker" <?php if($req_date !=NULL) { ?>value="<?php echo date('d-m-Y', strtotime($req_date));?>" <?php } else { ?>placeholder="Date (dd-mm-yyyy)"<?php } ?> onChange="enable_add()">
	                        <span class="input-group-addon">
	                            <i class="glyphicon glyphicon-calendar"></i>
	                        </span>
	                    </div>
											<input type="submit" name="dt_sec_submit" class="btn btn-default">
                </form>
            </div>
				<div class="tab-container">
	            <ul class="nav nav-tabs nav-justified">
	                <li class="active"><a href="#tab1" data-toggle="tab">Edit Entry</a></li>
	                <li><a href="#tab2" data-toggle="tab">Add Entry</a></li>
	            </ul>
				<div class="tab-content" style="background-color:#FFFFFF">
					<div class="tab-pane active" id="tab1">
						<form action="input_daily.php" method="post">
							<?php if(isset($_SESSION['daily_plucking'])) { $daily = $_SESSION['daily_plucking']; } else { $daily = NULL; }?>
									<!-- <div class="input-group">
											<input class="form-control" name="prune"  type="text" <?php if (isset($daily)) { ?> value=" <?php echo $daily['prune']; ?> " <?php } else { ?> placeholder= <?php echo "\"Prune Type\""; ?> <?php } ?> >
											<span class="input-group-addon"><i class="glyphicon glyphicon-user" ></i></span>
									</div> -->
									<div class="input-group">
									    <input class="form-control" name="plucked_area" type="text" <?php if (isset($daily)) { ?> value=" <?php echo $daily['plucked_area']; ?> " <?php } else { ?>placeholder=<?php echo "\"Area Plucked\""; ?><?php } ?> >
									    <span class="input-group-addon"><i class="glyphicon glyphicon-user" ></i></span>
									</div>
									<div class="input-group">
									    <input class="form-control" name="leaf_plucked" type="text" <?php if (isset($daily)) { ?> value=" <?php echo $daily['leaf_plucked']; ?> " <?php } else { ?> placeholder= <?php echo "\"Leaf Plucked\""; ?> <?php } ?> >
									    <span class="input-group-addon"><i class="glyphicon glyphicon-user" ></i></span>
									</div>
									  <div class="input-group">
									      <input class="form-control" name="hz_qty" type="text" <?php if (isset($daily)) { ?> value=" <?php echo $daily['hz_qty']; ?> " <?php } else { ?> placeholder= <?php echo "\"Hazri Quantity\""; ?> <?php } ?> >
									      <span class="input-group-addon"><i class="glyphicon glyphicon-envelope" ></i></span>
									  </div>
									<div class="input-group">
									    <input class="form-control"  name="hz_area" type="text" <?php if (isset($daily)) { ?> value=" <?php echo $daily['hz_area']; ?> " <?php } else { ?> placeholder= <?php echo "\"Hazri Area\""; ?> <?php } ?> >
									    <span class="input-group-addon"><i class="glyphicon glyphicon-asterisk" ></i></span>
									</div>
									<div class="input-group">
									    <input class="form-control" name="db_qty" type="text" <?php if (isset($daily)) { ?> value=" <?php echo $daily['db_qty']; ?> " <?php } else { ?> placeholder= <?php echo "\"Doubly Quantity\""; ?> <?php } ?> >
									    <span class="input-group-addon"><i class="glyphicon glyphicon-asterisk" ></i></span>
									</div>
									<div class="input-group">
									    <input class="form-control" name="db_area" type="text" <?php if (isset($daily)) { ?> value=" <?php echo $daily['db_area']; ?> " <?php } else { ?> placeholder= <?php echo "\"Doubly Area\""; ?> <?php } ?> >
									    <span class="input-group-addon"><i class="glyphicon glyphicon-asterisk" ></i></span>
									</div>
									<div class="input-group">
									    <input class="form-control" name="mandays" type="text" <?php if (isset($daily)) { ?> value=" <?php echo $daily['mandays']; ?> " <?php } else { ?> placeholder= <?php echo "\"Mandays\""; ?> <?php } ?> >
									    <span class="input-group-addon"><i class="glyphicon glyphicon-asterisk" ></i></span>
									</div>
									<button type="button" value="Delete Entry" class="btn btn-default" data-toggle="modal" data-target="#confirmModal">Delete Entry</button>
									<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModallabel">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
													<h4 class="modal-title" id="myModalLabel">Confirm Delete?</h4>
												</div>
												<div class="modal-body">
													<p>Are you sure you wish to delete this entry?</p>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
													<input type="submit" name="del_entry" class="btn btn-danger" value="Confirm Delete">
												</div>
											</div>
										</div>
									</div>
                  <input type="submit" name="edit_submit" value="Edit Entry" class="btn btn-default">
              </form>
					</div>
					<div class="tab-pane" id="tab2">
						<form action="input_daily.php" method="post">
		                    <!-- <div class="input-group">
		                        <input class="form-control" name="prune"  type="text" placeholder="Prune Type">
		                        <span class="input-group-addon"><i class="glyphicon glyphicon-user" ></i></span>
		                    </div> -->
		                    <div class="input-group">
		                        <input class="form-control" name="plucked_area" type="text" placeholder="Plucked Area">
		                        <span class="input-group-addon"><i class="glyphicon glyphicon-user" ></i></span>
		                    </div>
		                    <div class="input-group">
		                        <input class="form-control" name="leaf_plucked" type="text" placeholder="Total Leaf">
		                        <span class="input-group-addon"><i class="glyphicon glyphicon-user" ></i></span>
		                    </div>
			                    <div class="input-group">
			                        <input class="form-control" name="hz_qty" type="text" placeholder="Hazri Quantity">
			                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope" ></i></span>
		                    	</div>
		                    <div class="input-group">
		                        <input class="form-control"  name="hz_area" type="text" placeholder="Hazri Area">
		                        <span class="input-group-addon"><i class="glyphicon glyphicon-asterisk" ></i></span>
		                    </div>
		                    <div class="input-group">
		                        <input class="form-control" name="db_qty" type="text" placeholder="Doubly Quantity" >
		                        <span class="input-group-addon"><i class="glyphicon glyphicon-asterisk" ></i></span>
		                    </div>
		                    <div class="input-group">
		                        <input class="form-control" name="db_area" type="text" placeholder="Doubly Area">
		                        <span class="input-group-addon"><i class="glyphicon glyphicon-asterisk" ></i></span>
		                    </div>
		                    <div class="input-group">
		                        <input class="form-control" name="mandays" type="text" placeholder="Mandays">
		                        <span class="input-group-addon"><i class="glyphicon glyphicon-asterisk" ></i></span>
		                    </div>
		                    <input type="submit" name="add_submit" value="Add Entry" class="btn btn-default">
		                </form>
					</div>
				</div>
				</div>
        </div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
		<script>
				$(function() {
				$( "#datepicker" ).datepicker({dateFormat: 'dd-mm-yy'});
				});
		</script>
    </body>
</html>
<?php
  mysqli_free_result($result);
	end_connection($connection);
?>
