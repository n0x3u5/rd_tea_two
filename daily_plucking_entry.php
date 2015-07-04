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

		$query = "SELECT * FROM daily_plucking WHERE short_sec_name='{$req_ssn}' and rec_dt='{$req_date}'";

		$result = mysqli_query($connection, $query);
    confirm_query($result);

		$_SESSION['daily_plucking'] = mysqli_fetch_assoc($result);



		$q_prune = "SELECT prune_status from sections where short_sec_name = '$req_ssn'";
		//var_dump($q_prune);

		$r_prune = mysqli_query($connection, $q_prune);
		confirm_query($r_prune);

		$_SESSION['prune_stats'] = mysqli_fetch_assoc($r_prune);
		//var_dump($_SESSION['prune_status']);

		// while($_SESSION['daily_plucking'] = mysqli_fetch_assoc($result))
		// {
		// 	var_dump($_SESSION['daily_plucking']);
		// }
		//$daily =mysqli_fetch_assoc($result);
	}
	else {
		$req_date = NULL;
		$req_ssn = NULL;
	}
?>

<?php //insertion
	if (isset($_POST['add_submit'])) {
		$short_sec_name = $_SESSION['ssn'];
		$rec_dt = $_SESSION['date'];

		$labour_cat = mysqli_real_escape_string($connection, $_POST['labour_cat']);
		$labour_cat = explode_implode($labour_cat);//made function

		$lab_cat_plkd_area = mysqli_real_escape_string($connection, $_POST['lab_cat_plkd_area']);
		$lab_cat_plkd_area = explode_implode($lab_cat_plkd_area);

		$lab_cat_leaf_qty = mysqli_real_escape_string($connection, $_POST['lab_cat_leaf_qty']);
		$lab_cat_leaf_qty = explode_implode($lab_cat_leaf_qty);

		$lab_cat_mandays = mysqli_real_escape_string($connection, $_POST['lab_cat_mandays']);
		$lab_cat_mandays = explode_implode($lab_cat_mandays);

		$cp_leaf_qty = (float) mysqli_real_escape_string($connection, $_POST['cp_leaf_qty']);
		$task = (int) mysqli_real_escape_string($connection, $_POST['task']);
		// var_dump($labour_cat);

		$prune = $_SESSION['prune_stats']['prune_status'];

		$q_in = "INSERT INTO daily_plucking (short_sec_name, rec_dt, prune_status, labour_cat,";
		$q_in .= " lab_cat_plkd_area, lab_cat_leaf_qty, lab_cat_mandays, cp_leaf_qty, task)";
		$q_in .= " VALUES ('$short_sec_name', '$rec_dt', '$prune', '$labour_cat',";
		$q_in .= " '$lab_cat_plkd_area', '$lab_cat_leaf_qty', '$lab_cat_mandays', $cp_leaf_qty, $task)";

		$result_in = mysqli_query($connection, $q_in);

    confirm_query($result_in);
		if(mysqli_affected_rows($connection) > 0) {
			echo "Inserted Successfully!";
		}
		else {
			echo "No record affected! Check your Submission Properly!";
		}

		$_SESSION['daily_plucking'] = NULL;
		$_SESSION['ssn'] = NULL;
		$_SESSION['date'] = NULL;
	}
?>
<?php //updating

	if(isset($_POST['edit_submit'])) {

		// $query = "SELECT * FROM daily_plucking WHERE short_sec_name='{$req_ssn}' and rec_dt='{$req_date}'";
		//
		// $result = mysqli_query($connection, $query);
    // confirm_query($result);

		$short_sec_name = $_SESSION['ssn'];
		$rec_dt = $_SESSION['date'];
		$req_id = $_SESSION['daily_plucking']['id'];

		$labour_cat = mysqli_real_escape_string($connection, $_POST['labour_cat']);
		$labour_cat = explode_implode($labour_cat);//made function

		$lab_cat_plkd_area = mysqli_real_escape_string($connection, $_POST['lab_cat_plkd_area']);
		$lab_cat_plkd_area = explode_implode($lab_cat_plkd_area);

		$lab_cat_leaf_qty = mysqli_real_escape_string($connection, $_POST['lab_cat_leaf_qty']);
		$lab_cat_leaf_qty = explode_implode($lab_cat_leaf_qty);

		$lab_cat_mandays = mysqli_real_escape_string($connection, $_POST['lab_cat_mandays']);
		$lab_cat_mandays = explode_implode($lab_cat_mandays);

		$cp_leaf_qty = (float) mysqli_real_escape_string($connection, $_POST['cp_leaf_qty']);
		$task = (int) mysqli_real_escape_string($connection, $_POST['task']);
		// var_dump($labour_cat);

		$q_up = "UPDATE daily_plucking SET";
		$q_up .= " short_sec_name='{$short_sec_name}', rec_dt='{$rec_dt}', labour_cat='{$labour_cat}',";
		$q_up .= " lab_cat_plkd_area='{$lab_cat_plkd_area}', lab_cat_leaf_qty='{$lab_cat_leaf_qty}',";
		$q_up .= " lab_cat_mandays='{$lab_cat_mandays}', cp_leaf_qty={$cp_leaf_qty}, task={$task} WHERE id ={$req_id}";

		//var_dump($q_up);
		$result_up = mysqli_query($connection, $q_up);

    confirm_query($result_up);
		if(mysqli_affected_rows($connection) > 0) {
			echo "Updated Successfully!";
		}
		else {
			echo "No record affected! Check your Submission Properly!";
		}

		$_SESSION['daily_plucking'] = NULL;
		$_SESSION['ssn'] = NULL;
		$_SESSION['date'] = NULL;
	}
?>
<?php //DELETE
 //var_dump($_POST);
	if(isset($_POST['del_entry'])){
		$short_sec_name = $_SESSION['ssn'];
		$rec_dt = $_SESSION['date'];

		$q_del = "DELETE FROM daily_plucking WHERE short_sec_name='{$short_sec_name}' and rec_dt='{$rec_dt}'";
		//var_dump($q_del);

		$r_del = mysqli_query($connection, $q_del);
    confirm_query($r_del);

		if(mysqli_affected_rows($connection) > 0) {
			echo "Deleted Successfully!";
		}
		else {
			echo "No record affected! Check your Submission Properly!";
		}

		$_SESSION['daily_plucking'] = NULL;
		$_SESSION['ssn'] = NULL;
		$_SESSION['date'] = NULL;
	}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>R.D. Tea | Daily Plucking Entry</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
				<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
				<link rel="stylesheet" href="css/bootstrap-tokenfield.css" type="text/css">
        <link rel="stylesheet" href="css/stylesheet.css">
        <link rel="icon" href="images/logo_rdtea.png"/>
				<style>
					.btn-default {
						background: #BF360C;
						color: #FFFFFF;
						border: none;
					}
					/*@media screen and (min-width: 500px) {
						#edit_entry{
							margin-left:27%;
						}
						}
						@media screen and (min-width: 500px) {
							#add_entry{
								margin-left:27%;
							}
							}
						@media screen and (min-width: 500px) {
							#delete_entry{
								margin-left:12%;
							}
							}*/
				</style>
        <?php $page_id = 7;?>
    </head>
    <body>
         <?php
            include("nav_bar.php");
            nav_echoer($page_id);
        ?>
    <div class="container">
            <div class="jumbotron" style="background:#BF360C;margin-left:-15px;margin-right: -15px;">
                <h1>Daily Plucking Entry</h1>
                <form action="daily_plucking_entry.php" method="post" class="form form-group form-inline" style="margin-top: 30px;">
									<select id="division" name ="short_sec_name" class="form-control" required>
										<?php
												$q = "SELECT * FROM sections";
												$result = mysqli_query($connection, $q);

												confirm_query($result);
												//$_POST['sec_short_nm'] = NULL;

												echo "<option id=\"opt0\" value=NULL>Select a section...</option>";
												while($sec_values = mysqli_fetch_assoc($result)) {
										?>
													<option value="<?php echo htmlentities($sec_values['short_sec_name']) ?>" <?php if(isset($_POST["dt_sec_submit"]) && ($_SESSION['ssn'] == $sec_values['short_sec_name'])) { echo "selected";} ?> ><?php echo htmlentities($sec_values['short_sec_name']); ?></option>
										<?php
												}
										?>
									</select>
											<div class="input-group">
	                        <input type="text" name="date_value" class="form-control" id="datepicker" <?php if($req_date !=NULL) { ?>value="<?php echo date('d-m-Y', strtotime($req_date));?>" <?php } else { ?>placeholder="Date (dd-mm-yyyy)"<?php } ?> onChange="enable_add()" required>
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
						<form class="form-horizontal" action="daily_plucking_entry.php" method="post">
							<?php if(isset($_SESSION['daily_plucking'])) { $daily = $_SESSION['daily_plucking']; } else { $daily = NULL; }?>
							<div class="form-group" style="margin-top:30px">
								<label for="wrkgrp1" class="col-sm-3 control-label">Labour Category:</label>
								<div class="col-sm-4">
									<input type="text" name="labour_cat" class="form-control" id="wrkgrp1" <?php if (isset($daily)) { $csv = comma_sep_val($daily['labour_cat']); ?> value="<?php echo $csv; ?>" <?php } else { ?>placeholder=<?php echo "\"Select Labour Category\""; ?><?php } //comma separeted value?> >
								</div>
							</div>
							<div class="form-group">
								<label for="lb_area" class="col-sm-3 control-label">Area Plucked:</label>
								<div class="col-sm-4">
									<input type="text" name="lab_cat_plkd_area" class="form-control" id="lb_area" <?php if (isset($daily)) { $csv = comma_sep_val($daily['lab_cat_plkd_area']); ?> value="<?php echo $csv; ?>" <?php } else { ?>placeholder=<?php echo "\"Area Plucked by each Category\""; ?><?php } ?> >
								</div>
							</div>
							<div class="form-group">
								<label for="grpleaf1" class="col-sm-3 control-label">Leaf Plucked:</label>
								<div class="col-sm-4">
									<input type="text" name="lab_cat_leaf_qty" class="form-control" id="grpleaf1" <?php if (isset($daily)) { $csv = comma_sep_val($daily['lab_cat_leaf_qty']); ?> value="<?php echo $csv; ?>" <?php } else { ?>placeholder=<?php echo "\"Leaf Plucked by each Category\""; ?><?php } ?> >
								</div>
							</div>
							<div class="form-group">
								<label for="grpmd1" class="col-sm-3 control-label">Mandays for each group:</label>
								<div class="col-sm-4">
									<input type="text" name="lab_cat_mandays" class="form-control" id="grpmd1" <?php if (isset($daily)) { $csv = comma_sep_val($daily['lab_cat_mandays']); ?> value="<?php echo $csv; ?>" <?php } else { ?>placeholder=<?php echo "\"Pluckers for each Category\""; ?><?php } ?> >
								</div>
							</div>
							<div class="form-group">
								<label for="cp_leaf_qty" class="col-sm-3 control-label">Cash Plucked Leaf :</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" id="cp_leaf_qty" name="cp_leaf_qty" <?php if (isset($daily)) {  ?> value="<?php echo $daily['cp_leaf_qty']; ?>" <?php } else { ?>placeholder=<?php echo "\"Cash Plucked Leaf\""; ?><?php } ?> >
								</div>
							</div>
							<div class="form-group">
								<label for="task" class="col-sm-3 control-label">Task :</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" id="task" name="task" <?php if (isset($daily)) {  ?> value="<?php echo $daily['task']; ?>" <?php } else { ?>placeholder=<?php echo "\"Task Alloted (kg)\""; ?><?php } ?> >
								</div>
							</div>
							<div class="row">
								<div class="col-sm-3">
									<button type="button" value="Delete Entry" id="delete_entry" class="btn btn-danger" data-toggle="modal" data-target="#confirmModal" style="margin-top:20px;">Delete Entry</button>
								</div>
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
														<input type="submit"  name="del_entry" class="btn btn-danger" value="Confirm Delete">
													</div>
												</div>
											</div>
										</div>
								<div class="col-sm-2 col-sm-offset-2">
									  <input type="submit" id="edit_entry" name="edit_submit" value="Edit Entry" class="btn btn-default" style="margin-top:20px;">
								</div>
							</div>
            </form>
					</div>
					<div class="tab-pane" id="tab2">
						<form class="form-horizontal" action="daily_plucking_entry.php" method="post">
							<div class="form-group" style="margin-top:30px">
								<label for="wrkgrp2" class="col-sm-3 control-label">Labour Category:</label>
								<div class="col-sm-4">
									<input type="text" name="labour_cat" class="form-control" id="wrkgrp2" placeholder="Select Labour Category">
								</div>
							</div>
							<div class="form-group">
								<label for="lb_area" class="col-sm-3 control-label">Area Plucked:</label>
								<div class="col-sm-4">
									<input type="text" name="lab_cat_plkd_area" class="form-control" id="lb_area" placeholder="Area Plucked by each Category">
								</div>
							</div>
							<div class="form-group">
								<label for="grpleaf1" class="col-sm-3 control-label">Leaf Plucked:</label>
								<div class="col-sm-4">
									<input type="text" name="lab_cat_leaf_qty" class="form-control" id="grpleaf1" placeholder="Leaf Plucked by each Category">
								</div>
							</div>
							<div class="form-group">
								<label for="grpmd1" class="col-sm-3 control-label">Mandays for each group:</label>
								<div class="col-sm-4">
									<input type="text" name="lab_cat_mandays" class="form-control" id="grpmd1" placeholder="Pluckers for each Category">
								</div>
							</div>
							<div class="form-group">
								<label for="cp_leaf_qty" class="col-sm-3 control-label">Cash Plucked Leaf :</label>
								<div class="col-sm-4">
									<input type="text" name="cp_leaf_qty" class="form-control" id="cp_leaf_qty" placeholder="Cash Plucked Leaf">
								</div>
							</div>
							<div class="form-group">
								<label for="task" class="col-sm-3 control-label">Task :</label>
								<div class="col-sm-4">
									<input type="text" name="task" class="form-control" id="task" placeholder="Task Alloted (kg)">
								</div>
							</div>
          		<input type="submit" id="add_entry" name="add_submit" value="Add Entry" class="btn btn-default"style="margin-top:20px">
		    		</form>
					</div>
				</div>
			</div>
    </div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
		<script src="scripts/bootstrap-tokenfield.min.js"></script>
		<script type="text/javascript">
				//  document.getElementById("add_entry").disabled=true;
				//  document.getElementById("edit_entry").disabled=true;
				//  document.getElementById("delete_entry").disabled=true;
				$(function() {
					$( "#datepicker" ).datepicker({dateFormat: 'dd-mm-yy'});
					$('#wrkgrp1, #wrkgrp2').tokenfield({
						autocomplete: {
							source: ['P. Men','P. Women','Temp. Men','Temp. Women','Incentives'],
							delay: 100
						},
						showAutocompleteOnFocus: true
					});
					$('#grpleaf1, #grpleaf2, #lb_area, #grphzar2, #grpmd1, #grpmd2').tokenfield();
				 });
				//
				// function unhide(){
				// 	document.getElementById("add_entry").disabled=false;
				// 	document.getElementById("edit_entry").disabled=false;
				// 	document.getElementById("delete_entry").disabled=false;
				// }
		</script>
    </body>
</html>
<?php
  mysqli_free_result($result);
	end_connection($connection);
?>