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

		$plucked_area = (int) mysqli_real_escape_string($connection, $_POST['plucked_area']);
		$leaf_plucked = (int) mysqli_real_escape_string($connection, $_POST['leaf_plucked']);
		$hz_area = (int) mysqli_real_escape_string($connection, $_POST['hz_area']);
		$db_area = (int) mysqli_real_escape_string($connection, $_POST['db_area']);
		$hz_qty = (int) mysqli_real_escape_string($connection, $_POST['hz_qty']);
		$db_qty = (int) mysqli_real_escape_string($connection, $_POST['db_qty']);
		$mandays = (int) mysqli_real_escape_string($connection, $_POST['mandays']);
		$wrk_grp = mysqli_real_escape_string($connection, $_POST['wrk_grp']);
		$grp_leaf = mysqli_real_escape_string($connection, $_POST['grp_leaf']);
		$grp_hz_ar = mysqli_real_escape_string($connection, $_POST['grp_hz_ar']);
		$grp_md = mysqli_real_escape_string($connection, $_POST['grp_md']);

		$wrk_grp_exp = explode(", ", $wrk_grp);
		$wrk_grp = implode("¥", $wrk_grp_exp);
		$grp_leaf_exp = explode(", ", $grp_leaf);
		$grp_leaf = implode("¥", $grp_leaf_exp);
		$grp_hz_ar_exp = explode(", ", $grp_hz_ar);
		$grp_hz_ar = implode("¥", $grp_hz_ar_exp);
		$grp_md_exp = explode(", ", $grp_md);
		$grp_md = implode("¥", $grp_md_exp);

		$query = "INSERT INTO daily_plucking (short_sec_name, record_date,";
		$query .= " plucked_area, leaf_plucked, hz_area, hz_qty,";
		$query .= " db_area, db_qty, mandays, groups_worked, groups_leaves, groups_area, groups_mandays)";
		$query .= " VALUES (";
		$query .= "'{$short_sec_name}', '{$record_date}', {$plucked_area},";
		$query .= " {$leaf_plucked}, {$hz_area}, {$hz_qty}, {$db_area}, {$db_qty},";
		$query .= " {$mandays}, '{$wrk_grp}', '{$grp_leaf}', '{$grp_hz_ar}', '{$grp_md}')";
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

		//var_dump($_SESSION);

		$plucked_area = (int) mysqli_real_escape_string($connection, $_POST['plucked_area']);
		$leaf_plucked = (int) mysqli_real_escape_string($connection, $_POST['leaf_plucked']);
		$hz_area = (int) mysqli_real_escape_string($connection, $_POST['hz_area']);
		$db_area = (int) mysqli_real_escape_string($connection, $_POST['db_area']);
		$hz_qty = (int) mysqli_real_escape_string($connection, $_POST['hz_qty']);
		$db_qty = (int) mysqli_real_escape_string($connection, $_POST['db_qty']);
		$mandays = mysqli_real_escape_string($connection, $_POST['mandays']);
		$wrk_grp = mysqli_real_escape_string($connection, $_POST['wrk_grp']);
		$grp_leaf = mysqli_real_escape_string($connection, $_POST['grp_leaf']);
		$grp_hz_ar = mysqli_real_escape_string($connection, $_POST['grp_hz_ar']);
		$grp_md = mysqli_real_escape_string($connection, $_POST['grp_md']);

		$wrk_grp_exp = explode(", ", $wrk_grp);
		$wrk_grp = implode("¥", $wrk_grp_exp);
		$grp_leaf_exp = explode(", ", $grp_leaf);
		$grp_leaf = implode("¥", $grp_leaf_exp);
		$grp_hz_ar_exp = explode(", ", $grp_hz_ar);
		$grp_hz_ar = implode("¥", $grp_hz_ar_exp);
		$grp_md_exp = explode(", ", $grp_md);
		$grp_md = implode("¥", $grp_md_exp);

		$query = "UPDATE daily_plucking SET short_sec_name = '{$short_sec_name}', record_date = '{$record_date}',";
		$query .= " plucked_area = {$plucked_area}, leaf_plucked = {$leaf_plucked},";
		$query .= " hz_area = {$hz_area}, hz_qty = {$hz_qty},";
		$query .= " db_area = {$db_area}, db_qty = {$db_qty}, mandays = {$mandays}, groups_worked = '{$wrk_grp}', groups_leaves = '{$grp_leaf}', groups_area = '{$grp_hz_ar}', groups_mandays = '{$grp_md}' WHERE id ={$req_id}";

		//var_dump($query);

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
                <form action="input_daily.php" method="post" class="form form-group form-inline" style="margin-top: 30px;">
									<select id="division" name ="short_sec_name" class="form-control">
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
						<form class="form-horizontal" action="input_daily.php" method="post">


							<div class="form-group" style="margin-top:30px">
								<label for="wrkgrp1" class="col-sm-3 control-label">Labour Category:</label>
								<div class="col-sm-4">
									<input type="text" name="labour_cat" class="form-control" id="wrkgrp1" placeholder="Select Labour Category">
								</div>
							</div>
							<div class="form-group">
								<label for="lb_area" class="col-sm-3 control-label">Area Plucked:</label>
								<div class="col-sm-4">
									<input type="text" name="lab_cat_area" class="form-control" id="lb_area" placeholder="Area Plucked by each Category">
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
									<input type="text" class="form-control" id="cp_leaf_qty" name="cp_leaf_qty" placeholder="Cash Plucked Leaf">
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
						<form class="form-horizontal" action="input_daily.php" method="post">
							<div class="form-group" style="margin-top:30px">
								<label for="wrkgrp1" class="col-sm-3 control-label">Labour Category:</label>
								<div class="col-sm-4">
									<input type="text" name="labour_cat" class="form-control" id="wrkgrp1" placeholder="Select Labour Category">
								</div>
							</div>
							<div class="form-group">
								<label for="lb_area" class="col-sm-3 control-label">Area Plucked:</label>
								<div class="col-sm-4">
									<input type="text" name="lab_cat_area" class="form-control" id="lb_area" placeholder="Area Plucked by each Category">
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
									<input type="text" class="form-control" id="cp_leaf_qty" name="cp_leaf_qty" placeholder="Cash Plucked Leaf">
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
