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

		$query = "SELECT * FROM blue_bk_plk WHERE short_sec_name='{$req_ssn}' and rec_dt='{$req_date}'";
		//var_dump($query);
		$result = mysqli_query($connection, $query);
    confirm_query($result);

		$_SESSION['blue_bk_plk'] = mysqli_fetch_assoc($result);



		$q_prune = "SELECT prune_style from sections where short_sec_name = '$req_ssn'";
		//var_dump($q_prune);
		$r_prune = mysqli_query($connection, $q_prune);
		confirm_query($r_prune);

		$_SESSION['prune_stats'] = mysqli_fetch_assoc($r_prune);
		//var_dump($_SESSION['prune_status']);

		// while($_SESSION['blue_bk_plk'] = mysqli_fetch_assoc($result))
		// {
		// 	var_dump($_SESSION['blue_bk_plk']);
		// }
		//$daily =mysqli_fetch_assoc($result);
		$set = 1;
	}
	else {
		$req_date = NULL;
		$req_ssn = NULL;
		$set = 0;
	}
?>

<?php //insertion
	if (isset($_POST['add_submit'])) {
		$short_sec_name = $_SESSION['ssn'];
		$rec_dt = $_SESSION['date'];

		$plkd_area = (float) mysqli_real_escape_string($connection, $_POST['plkd_area']);

		$plkd_leaf = (float) mysqli_real_escape_string($connection, $_POST['plkd_leaf']);

		$mandays = (int) mysqli_real_escape_string($connection, $_POST['mandays']);

		$rounddays = (int) mysqli_real_escape_string($connection, $_POST['rounddays']);


		$prune = $_SESSION['prune_stats']['prune_style'];


		$q_in = "INSERT INTO blue_bk_plk (short_sec_name, rec_dt, plkd_area, plkd_leaf, mandays, prune_style, rnd_days)";
		$q_in .= " VALUES ('$short_sec_name', '$rec_dt', $plkd_area, $plkd_leaf, $mandays, '$prune', $rounddays)";

		//var_dump($q_in);
		$result_in = mysqli_query($connection, $q_in);

    confirm_query($result_in);
		if(mysqli_affected_rows($connection) > 0) {
			echo "Inserted Successfully!";
		}
		else {
			echo "No record affected! Check your Submission Properly!";
		}

		$_SESSION['blue_bk_plk'] = NULL;
		$_SESSION['ssn'] = NULL;
		$_SESSION['date'] = NULL;
	}
 ?>
 <?php //updating

	if(isset($_POST['edit_submit'])) {

		// $query = "SELECT * FROM blue_bk_plk WHERE short_sec_name='{$req_ssn}' and rec_dt='{$req_date}'";
		//
		// $result = mysqli_query($connection, $query);
    // confirm_query($result);

		$short_sec_name = $_SESSION['ssn'];
		$rec_dt = $_SESSION['date'];
		$req_id = $_SESSION['blue_bk_plk']['id'];


		$plkd_area = (float) mysqli_real_escape_string($connection, $_POST['plkd_area']);

		$plkd_leaf = (float) mysqli_real_escape_string($connection, $_POST['plkd_leaf']);

		$mandays = (int) mysqli_real_escape_string($connection, $_POST['mandays']);

		$rounddays = (int) mysqli_real_escape_string($connection, $_POST['rounddays']);

		$q_up = "UPDATE blue_bk_plk SET";
		$q_up .= " short_sec_name='{$short_sec_name}', rec_dt='{$rec_dt}',";
		$q_up .= " plkd_area={$plkd_area}, plkd_leaf={$plkd_leaf},";
		$q_up .= " mandays={$mandays}, rnd_days={$rounddays} WHERE id ={$req_id}";

		//var_dump($q_up);
		$result_up = mysqli_query($connection, $q_up);

    confirm_query($result_up);
		if(mysqli_affected_rows($connection) > 0) {
			echo "Updated Successfully!";
		}
		else {
			echo "No record affected! Check your Submission Properly!";
		}


		$_SESSION['blue_bk_plk'] = NULL;
		$_SESSION['ssn'] = NULL;
		$_SESSION['date'] = NULL;
	}
 ?>
 <?php //DELETE
 //var_dump($_POST);
	if(isset($_POST['del_entry'])){
		$short_sec_name = $_SESSION['ssn'];
		$rec_dt = $_SESSION['date'];

		$q_del = "DELETE FROM blue_bk_plk WHERE short_sec_name='{$short_sec_name}' and rec_dt='{$rec_dt}'";
		//var_dump($q_del);

		$r_del = mysqli_query($connection, $q_del);
    confirm_query($r_del);

		if(mysqli_affected_rows($connection) > 0) {
			echo "Deleted Successfully!";
		}
		else {
			echo "No record affected! Check your Submission Properly!";
		}


		$_SESSION['blue_bk_plk'] = NULL;
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
						background: #FFFFFF;
						color:Black;
						border: none;
					}
					.jumbotron{
						 background:#7B1FA2;
						margin-left:-15px;
						margin-right: -15px;
					}
					.jumbotron h1{
						color:#EDD2D2;
					}


				</style>
        <?php $page_id = 7;?>
    </head>
    <body>
         <?php
            include("nav_bar.php");
            nav_echoer($page_id);
        ?>
    <div class="container">
            <div class="jumbotron">
                <h1>Daily Plucking Entry</h1>
                <form action="daily_plucking_entry.php" method="post" class="form form-group form-inline" style="margin-top: 30px;">
									<select id="division" name ="short_sec_name" class="form-control" onchange="enable_add()" required>
										<?php
												$q = "SELECT * FROM sections";
												$result = mysqli_query($connection, $q);

												confirm_query($result);
												//$_POST['sec_short_nm'] = NULL;

												echo "<option id=\"opt0\" value=\"Select a section...\">Select a section...</option>";
												while($sec_values = mysqli_fetch_assoc($result)) {
										?>
													<option value="<?php echo htmlentities($sec_values['short_sec_name']) ?>" <?php if(isset($_POST["dt_sec_submit"]) && ($_SESSION['ssn'] == $sec_values['short_sec_name'])) { echo "selected";} ?> ><?php echo htmlentities($sec_values['short_sec_name']); ?></option>
										<?php
												}

										?>
									</select>
											<div class="input-group">
												<span class="input-group-addon">
														<i class="glyphicon glyphicon-calendar"></i>
												</span>
	                        <input type="text" name="date_value" class="form-control" id="datepicker" <?php if($req_date !=NULL) { ?>value="<?php echo date('d-m-Y', strtotime($req_date));?>" <?php } else { ?>placeholder="Date (dd-mm-yyyy)"<?php } ?> onChange="enable_add()" required>

	                    </div>
											<input type="submit" id="selct_sec" name="dt_sec_submit" value="Submit" class="btn btn-default" onclick="enable_tab()">
                </form>
            </div>
			<div class="tab-container">
	            <ul class="nav nav-tabs nav-justified">
	                <li id="actv_one"><a href="#tab1" data-toggle="tab" id="link_one">Edit Entry</a></li>
	                <li id="actv_two"><a href="#tab2" data-toggle="tab" id="link_two">Add Entry</a></li>
	            </ul>
				<div class="tab-content" style="background-color:#FFFFFF">


					
					<div class="tab-pane" id="tab1">
						<form class="form-horizontal" action="daily_plucking_entry.php" method="post">
							<?php if(isset($_SESSION['blue_bk_plk'])) { $daily = $_SESSION['blue_bk_plk']; } else { $daily = NULL; }?>
							<div class="form-group">
								<label for="lb_area" class="col-sm-3 control-label">Area Plucked:</label>
								<div class="col-sm-4">
									<input type="text" name="plkd_area" class="form-control" id="lb_area" <?php if (isset($daily)) { ?> value="<?php echo $daily['plkd_area']; $set2=1; ?>" <?php } else { ?>placeholder=<?php $set2 = 2; echo "\"Area Plucked by each Category\""; ?><?php } ?> required>
								</div>
							</div>
							<div class="form-group">
								<label for="grpleaf1" class="col-sm-3 control-label">Leaf Plucked:</label>
								<div class="col-sm-4">
									<input type="text" name="plkd_leaf" class="form-control" id="grpleaf1" <?php if (isset($daily)) { ?> value="<?php echo $daily['plkd_leaf']; ?>" <?php } else { ?>placeholder=<?php echo "\"Leaf Plucked by each Category\""; ?><?php } ?> >
								</div>
							</div>
							<div class="form-group">
								<label for="grpmd1" class="col-sm-3 control-label">Mandays:</label>
								<div class="col-sm-4">
									<input type="text" name="mandays" class="form-control" id="grpmd1" <?php if (isset($daily)) { ?> value="<?php echo $daily['mandays']; ?>" <?php } else { ?>placeholder=<?php echo "\"Pluckers for each Category\""; ?><?php } ?> >
								</div>
							</div>
							<div class="form-group">
								<label for="grpmd1" class="col-sm-3 control-label">Round days:</label>
								<div class="col-sm-4">
									<input type="text" name="rounddays" class="form-control" id="grpmd1" <?php if (isset($daily)) { ?> value="<?php echo $daily['rnd_days']; ?>" <?php } else { ?>placeholder=<?php echo "\"Round days\""; ?><?php } ?> >
								</div>
							</div>
							<div class="row">
								<div class="col-sm-1 col-sm-offset-2">
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
								<div class="col-sm-2 col-sm-offset-3">
									  <input type="submit" id="edit_entry" name="edit_submit" value="Edit Entry" class="btn btn-success" style="margin-top:20px;">
								</div>
							</div>
            </form>
					</div>



					<div class="tab-pane" id="tab2">
						<form class="form-horizontal" action="daily_plucking_entry.php" method="post">
							<div class="form-group">
								<label for="lb_area" class="col-sm-3 control-label">Area Plucked:</label>
								<div class="col-sm-4">
									<input type="text" name="plkd_area" class="form-control" id="lb_area" placeholder="Area Plucked " required>
								</div>
							</div>
							<div class="form-group">
								<label for="grpleaf1" class="col-sm-3 control-label">Leaf Plucked:</label>
								<div class="col-sm-4">
									<input type="text" name="plkd_leaf" class="form-control" id="grpleaf1" placeholder="Leaf Plucked " required>
							</div>
							</div>
							<div class="form-group">
								<label for="grpmd1" class="col-sm-3 control-label">Mandays:</label>
								<div class="col-sm-4">
									<input type="text" name="mandays" class="form-control" id="grpmd1" placeholder="Pluckers employed" required>
								</div>
							</div>
							<div class="form-group">
								<label for="grpmd1" class="col-sm-3 control-label">Round days:</label>
								<div class="col-sm-4">
									<input type="text" name="rounddays" class="form-control" id="grpmd1" placeholder="Round days" required>
								</div>
							</div>

          		<input type="submit" id="add_entry" name="add_submit" value="Add Entry" class="btn btn-success"style="margin-top:20px">
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
					$( "#datepicker, #datepicker_edit, #datepicker_add" ).datepicker({dateFormat: 'dd-mm-yy'});
				});
				//
				// function unhide(){
				// 	document.getElementById("add_entry").disabled=false;
				// 	document.getElementById("edit_entry").disabled=false;
				// 	document.getElementById("delete_entry").disabled=false;
				// }

		</script>
		<script>
			document.getElementById('selct_sec').disabled=true;
			document.getElementById('link_one').disabled=true;
			document.getElementById('link_two').disabled=true;
			if(document.getElementById('division').value!='Select a section...')
			{
				document.getElementById('selct_sec').disabled=false;
			}
			function enable_add(){
				if(document.getElementById('division').value!='Select a section...')
				{
					document.getElementById('selct_sec').disabled=false;
				}
				else {
					document.getElementById('selct_sec').disabled=true;
				}
			}

		</script>
		<?php
		if(isset($set2)){
		echo"<script>		var submit_chk=$set2; submit_chk2=$set; </script>";}
		 ?>

					<script>
						if(submit_chk==1 && submit_chk2)
							{

								document.getElementById('link_one').disabled=false;
								var a1=document.getElementById('tab1');
								a1.setAttribute('class','active');
								var b1=document.getElementById('actv_one');
								b1.style.background='#4A148C';
								var c1=document.getElementById('link_one');
								c1.style.color='#FFFFFF';


							}
						 if(submit_chk==2 && submit_chk2){

								document.getElementById('link_two').disabled=false;
								var a2=document.getElementById('tab2');
								a2.setAttribute('class','active');
								var b2=document.getElementById('actv_two');
								b2.style.background='#4A148C';
								var c2=document.getElementById('link_two');
								c2.style.color='#FFFFFF';
							}

					</script>



    </body>
</html>
<?php
  mysqli_free_result($result);
	end_connection($connection);
?>
