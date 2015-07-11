<?php
	require_once('includes/sessions.php');
	require_once('includes/functions.php');

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
		$req_hz_db = $_POST["hz_db"];
		$_SESSION['ssn'] = $req_ssn;
		$_SESSION['date'] = $req_date;
		$_SESSION['hz_db'] = $req_hz_db;

		if($_SESSION["user_div"] == "ALL") {
			$req_div = $_SESSION["current_div"];
		}
		else {
			$req_div = $_SESSION["user_div"];
		}
		$_SESSION['div_name'] = $req_div;


		// echo "<br>got date =".$req_date."<br>";
		// echo "<br>got ssn =" .$req_ssn."<br>";
		// echo "<br>got hz_db =".$req_hz_db."<br>";
		// var_dump($req_date);echo "<br>"; var_dump($req_ssn);

		$query = "SELECT * FROM blue_bk_spray_chit WHERE short_sec_name='{$req_ssn}' and rec_dt='{$req_date}' and hz_db='{$req_hz_db}' and division='{$_SESSION['div_name']}'";
		//var_dump($query);
		$result = mysqli_query($connection, $query);
		confirm_query($result);

		$_SESSION['blue_bk_spray_chit'] = mysqli_fetch_assoc($result);

		 $set = 1;
	}
	else {
		$req_date = NULL;
		$req_ssn = NULL;
		$req_hz_db = NULL;
		 $set = 0;
	}
?>

<?php //insertion
	if (isset($_POST['add_submit'])) {
		$short_sec_name = $_SESSION['ssn'];
		$rec_dt = $_SESSION['date'];
		$hz_db = $_SESSION['hz_db'];



		$chem = mysqli_real_escape_string($connection, $_POST['chem']);
		$chem = explode_implode($chem);
		$cocktail = mysqli_real_escape_string($connection, $_POST['cocktail']);
		$spot_full = mysqli_real_escape_string($connection, $_POST['spot_full']);
		$pest = mysqli_real_escape_string($connection, $_POST['pest']);
		$pest = explode_implode($pest);
		$intensity = mysqli_real_escape_string($connection, $_POST['intensity']);
		$intensity = explode_implode($intensity);
		$qty_unit = mysqli_real_escape_string($connection, $_POST['qty_unit']);
		$qty_unit = explode_implode($qty_unit);
		$area = (float) mysqli_real_escape_string($connection, $_POST['area']);
		$no_drms = (float) mysqli_real_escape_string($connection, $_POST['no_drms']);
		$dr_mnds = (float) mysqli_real_escape_string($connection, $_POST['dr_mnds']);
		$sup_mnds = (float) mysqli_real_escape_string($connection, $_POST['sup_mnds']);


		$q_in = "INSERT INTO blue_bk_spray_chit (division, short_sec_name, rec_dt, hz_db, chem, cocktail, spot_full, pest, intensity, qty_unit, area, no_drms, dr_mnds, sup_mnds)";
		$q_in .= " VALUES ('{$_SESSION['div_name']}', '{$short_sec_name}', '{$rec_dt}', '{$hz_db}', '{$chem}', '{$cocktail}', '{$spot_full}', '{$pest}', '{$intensity}', '{$qty_unit}', {$area}, {$no_drms}, {$dr_mnds}, {$sup_mnds})";

		//var_dump($q_in);
		$r_in = mysqli_query($connection, $q_in);

    confirm_query($r_in);

		if(mysqli_affected_rows($connection) > 0) {
			echo "Inserted Successfully!";
		}
		else {
			echo "No rows effected!";
		}


		$_SESSION['blue_bk_spray_chit'] = NULL;
		$_SESSION['ssn'] = NULL;
		$_SESSION['date'] = NULL;
		$_SESSION['hz_db'] = NULL;
		$_SESSION['div_name'] = NULL;
	}
 ?>
 <?php //updating

	if(isset($_POST['edit_submit'])) {

		$short_sec_name = $_SESSION['ssn'];
		$rec_dt = $_SESSION['date'];
		$hz_db = $_SESSION['hz_db'];
		$req_id = $_SESSION['blue_bk_spray_chit']['id'];

		$chem = mysqli_real_escape_string($connection, $_POST['chem']);
		$chem = explode_implode($chem);
		$cocktail = mysqli_real_escape_string($connection, $_POST['cocktail']);
		$spot_full = mysqli_real_escape_string($connection, $_POST['spot_full']);
		$pest = mysqli_real_escape_string($connection, $_POST['pest']);
		$pest = explode_implode($pest);
		$intensity = mysqli_real_escape_string($connection, $_POST['intensity']);
		$intensity = explode_implode($intensity);
		$qty_unit = mysqli_real_escape_string($connection, $_POST['qty_unit']);
		$qty_unit = explode_implode($qty_unit);
		$area = (float) mysqli_real_escape_string($connection, $_POST['area']);
		$no_drms = (float) mysqli_real_escape_string($connection, $_POST['no_drms']);
		$dr_mnds = (float) mysqli_real_escape_string($connection, $_POST['dr_mnds']);
		$sup_mnds = (float) mysqli_real_escape_string($connection, $_POST['sup_mnds']);

		$q_up = "UPDATE blue_bk_spray_chit SET";
		$q_up .= " division='{$_SESSION['div_name']}', short_sec_name='{$short_sec_name}', rec_dt='{$rec_dt}',";
		$q_up .= " hz_db='{$hz_db}', chem='{$chem}', cocktail='{$cocktail}', spot_full='{$spot_full}',";
		$q_up .= " pest='{$pest}', intensity='{$intensity}', qty_unit='{$qty_unit}', area={$area}, no_drms={$no_drms}, dr_mnds={$dr_mnds}, sup_mnds={$sup_mnds} WHERE id ={$req_id}";

		//var_dump($q_up);
		$r_up = mysqli_query($connection, $q_up);

    confirm_query($r_up);

		if(mysqli_affected_rows($connection) > 0) {
			echo "Updated Successfully!";
		}
		else {
			echo "No rows effected!";
		}

			$_SESSION['blue_bk_spray_chit'] = NULL;
			$_SESSION['ssn'] = NULL;
			$_SESSION['date'] = NULL;
			$_SESSION['hz_db'] = NULL;
			$_SESSION['div_name'] = NULL;
	}
 ?>
 <?php //DELETE
 //var_dump($_POST);
	if(isset($_POST['del_entry'])){
		$short_sec_name = $_SESSION['ssn'];
		$rec_dt = $_SESSION['date'];
		$hz_db = $_SESSION['hz_db'];

		$q_del = "DELETE FROM blue_bk_spray_chit WHERE short_sec_name='{$short_sec_name}' and rec_dt='{$rec_dt}' and hz_db = '{$hz_db}' and division='{$_SESSION['div_name']}'";
		//var_dump($q_del);

		$r_del = mysqli_query($connection, $q_del);
    confirm_query($r_del);

		if(mysqli_affected_rows($connection) > 0) {
			echo "Deleted Successfully!";
		}
		else {
			echo "No rows effected!";
		}


		$_SESSION['blue_bk_spray_chit'] = NULL;
		$_SESSION['ssn'] = NULL;
		$_SESSION['date'] = NULL;
		$_SESSION['hz_db'] = NULL;
		$_SESSION['div_name'] = NULL;
	}

?>


<!DOCTYPE html>
<html>
    <head>
      <meta charset="utf-8">
      <title>R.D. Tea | Daily Spraying Entry</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
		  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
      <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
			<link rel="stylesheet" href="css/bootstrap-tokenfield.css" type="text/css">
      <link rel="stylesheet" href="css/stylesheet.css">
      <style>
        .card_style {
          background: #EFEBE9;
        }
        .nav-tabs.nav-justified > .active > a, .nav-tabs.nav-justified > .active > a:hover, .nav-tabs.nav-justified > .active > a:active, .nav-tabs.nav-justified > .active > a:enabled {
        background-color: #5D4037 !important;
        border-bottom-color: #5D4037;
        color: #FFFFFF;
        }
        .tab-content {
          background: #EFEBE9;
          padding: 20px;
        }
        .col-sm-4 .btn {
          width: auto;
        }
        .main-form {
          padding: 10px 0 10px 0;
        }
        @media (min-width: 768px) {
          .col-sm-2.col-sm-offset-4 .btn-success {
            float: right;
          }
        }
        @media (max-width: 768px) {
          .col-sm-2.col-sm-offset-4 .btn-success {
            float: right;
          }
        }
        @media (max-width: 500px) {
          .col-sm-2.col-sm-offset-4 .btn-success {
            float: left;
          }
          .btn {
            margin-left: 40px;
          }
        }
        .col-sm-6 .btn {
          margin-top: 15px;
        }
        .col-sm-2 .btn{
          margin-top: 10px;
          margin-bottom: 5px;
        }
      </style>
      <link rel="icon" href="images/logo_rdtea.png"/>
      <?php $page_id = 9;?>
    </head>
    <body>
        <?php
          include("nav_bar.php");
          nav_echoer($page_id);
        ?>
        <div class="container">
          <div class="jumbotron" style="background:#795548;">
            <h1>Spraying Data Entry</h1>
						<p></p><p></p><p></p><p></p>
            <form action="" class="form-horizontal" method="post">
                <div class="row">
									<div class="form-group col-sm-6">
										<label>Select a section:</label>
										<select name="short_sec_name" class="form-control" id="hide_one" onChange="enable_add()">
												<option>Select a section</option>
												<?php
														$q = "SELECT * FROM sections where division = '{$_SESSION['current_div']}'";
														$result = mysqli_query($connection, $q);

														confirm_query($result);
														//$_POST['sec_short_nm'] = NULL;

														//echo "<option id=\"opt0\" value=\"Select a section...\">Select a section...</option>";
														while($sec_values = mysqli_fetch_assoc($result)) {
												?>
															<option value="<?php echo htmlentities($sec_values['short_sec_name']) ?>" <?php if(isset($_POST["dt_sec_submit"]) && ($_SESSION['ssn'] == $sec_values['short_sec_name'])) { echo "selected";} ?> ><?php echo htmlentities($sec_values['short_sec_name']); ?></option>
												<?php
														}
												?>
										</select>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-sm-6">
										<label>Select Hazri / Dubly:</label>
										<select name="hz_db" class="form-control" id="hide_two" onChange="enable_add()">
												<option>Select Hz/Db</option>
												<option <?php if(($req_hz_db != NULL) && ($_POST['hz_db'] == 'HZ')){ echo "selected"; } ?> >HZ</option>
												<option <?php if(($req_hz_db != NULL) && ($_POST['hz_db'] == 'DB')){ echo "selected"; } ?> >DB</option>
										</select>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-sm-6">
										<label>Select a date:</label>
										<input type="text" name="date_value" class="form-control" id="datepicker" <?php if($req_date !=NULL) { ?>value="<?php echo date('d-m-Y', strtotime($req_date));?>" <?php } else { ?>placeholder="Date (dd-mm-yyyy)"<?php } ?> onChange="enable_add()" required>
									</div>
								</div>
								<button type="submit" id="hide_me" name="dt_sec_submit" class="btn btn-success" style="margin-top:-1px;">Submit</button>
            </form>
        	</div>
          <div class="col-sm-12 card_style" style="padding-bottom:15px;">
            <ul class="nav nav-tabs nav-justified">
              <li  id="ac_one"><a href="#tab1" data-toggle="tab" id="take1">Update or Delete Record</a></li>
              <li id="ac_two"><a href="#tab2" data-toggle="tab" id="take2">Add Record</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane" id="tab1">

									<form class="form-horizontal" action="daily_spraying_entry.php" method="post">
										<?php if(isset($_SESSION['blue_bk_spray_chit'])) { $daily = $_SESSION['blue_bk_spray_chit']; } else { $daily = NULL; }?>
										<div class="form-group" style="margin-top:30px">
											<label class="col-sm-2 col-sm-offset-1 control-level">Cocktail:</label>
											<div class="col-sm-4">
												<select  name="cocktail"  class="form-control" id="hide_1" onChange="enable_add_one()">
													<option>Select Yes / No :</option>
													<option <?php if($daily != NULL && $daily['cocktail'] == 'Y') { echo "selected"; } ?> >Y</option>
													<option <?php if($daily != NULL && $daily['cocktail'] == 'N') { echo "selected"; } ?> >N</option>
												</select>
											</div>
										</div>
	                	<div class="form-group" >
											<label class="col-sm-2 col-sm-offset-1 control-level">Select Item(s) :</label>
											<div class="col-sm-4">
												<input name="chem" type="text" class="form-control" id="item1" <?php if (isset($daily)) { $csv = comma_sep_val($daily['chem']);  ?> value="<?php echo $csv; ?>" <?php $set2 = 1; } else { ?>placeholder=<?php echo "\"Select Chemical name.\""; ?><?php $set2 = 2; } //comma separeted value?>  >
											</div>
											<p class="text-danger"> * Use commas or tabs</p>
										</div>

										<div class="form-group">
											<label class="col-sm-2 col-sm-offset-1 control-level">Select Spot / Full:</label>
											<div class="col-sm-4">
												<select name="spot_full"  class="form-control" id="hide_2" onChange="enable_add_one()">
													<option>Select Spot / Full :</option>
													<option <?php if($daily != NULL && $daily['spot_full'] == 'Spot') { echo "selected"; } ?> >Spot</option>
													<option <?php if($daily != NULL && $daily['spot_full'] == 'Full') { echo "selected"; } ?> >Full</option>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 col-sm-offset-1 control-level">Select Pests / Diseases :</label>
											<div class="col-sm-4">
												<input name="pest" type="text" class="form-control" id="paste1" <?php if (isset($daily)) { $csv = comma_sep_val($daily['pest']); ?> value="<?php echo $csv; ?>" <?php } else { ?>placeholder=<?php echo "\"Select Pests/Diseases.\""; ?><?php } //comma separeted value?>  >
											</div>
											<p class="text-danger"> * Use commas or tabs</p>
										</div>
										<div class="form-group">
											<label class="col-sm-2 col-sm-offset-1 control-level">Select Intencity :</label>
											<div class="col-sm-4">
												<input name="intensity"  type="text" class="form-control" id="intsty1" <?php if (isset($daily)) { $csv = comma_sep_val($daily['intensity']); ?> value="<?php echo $csv; ?>" <?php } else { ?>placeholder=<?php echo "\"Select intensity.\""; ?><?php } //comma separeted value?>  >
											</div>
											<p class="text-danger"> * Use commas or tabs</p>
										</div>
										<div class="form-group">
											<label class="col-sm-2 col-sm-offset-1 control-level">Select Quantity :</label>
											<div class="col-sm-4">
												<input name="qty_unit" type="text" class="form-control" id="qty1" <?php if (isset($daily)) { $csv = comma_sep_val($daily['qty_unit']); ?> value="<?php echo $csv; ?>" <?php } else { ?>placeholder=<?php echo "\"Select quantity with unit.\""; ?><?php } //comma separeted value?>  >
											</div>
											<p class="text-danger"> * Use commas or tabs and also mention kg/l</p>
										</div>
										<div class="form-group">
											<label class="col-sm-2 col-sm-offset-1 control-level">Select Area :</label>
											<div class="col-sm-4">
												<input name="area" type="text" class="form-control" <?php if(isset($daily)) {?>value="<?php echo $daily['area']; ?>" <?php } else {?>placeholder=<?php  echo "\"Area sprayed\""?> <?php } ?> >
											</div>
										</div>
										<!-- <div class="form-group">
											<label class="col-sm-2 col-sm-offset-1 control-level">Select Unit (kg/ Lt) :</label>
											<div class="col-sm-4">
												<select class="form-control" id="hide_3" onChange="enable_add_one()">
													<option>Select Kg / Lt :</option>
													<option>K</option>
													<option>L</option>
												</select>
											</div>
										</div> -->
										<!-- <option>Select Low / medium / High </option>
										<option>Low</option>
										<option>Medium</option>
										<option>High</option> -->

										<div class="form-group">
											<label class="col-sm-2 col-sm-offset-1 control-level">No of Drums (sprayed) :</label>
											<div class="col-sm-4">
												<input name="no_drms" type="text" class="form-control" <?php if(isset($daily)) {?>value="<?php echo $daily['no_drms']; ?>" <?php } else {?>placeholder=<?php  echo "\"Number of drums\""?> <?php } ?> >
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 col-sm-offset-1 control-level">Mandays (D Rated):</label>
											<div class="col-sm-4">
												<input name="dr_mnds" type="text" class="form-control" <?php if(isset($daily)) {?>value="<?php echo $daily['dr_mnds']; ?>" <?php } else {?>placeholder=<?php  echo "\"Daily rated Mandays\""?> <?php } ?> >
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 col-sm-offset-1 control-level">Mandays (Supervisory) :</label>
											<div class="col-sm-4">
												<input name="sup_mnds" type="text" class="form-control" <?php if(isset($daily)) {?>value="<?php echo $daily['sup_mnds']; ?>" <?php } else {?>placeholder=<?php  echo "\"Supervisory Mandays\""?> <?php } ?> >
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
                <form class="form-horizontal" action="daily_spraying_entry.php" method="post">
									<div class="form-group" style="margin-top:30px">
										<label class="col-sm-2 col-sm-offset-1 control-level">Cocktail:</label>
										<div class="col-sm-4">
											<select  name="cocktail"class="form-control" onChange="enable_add_two()" id="hide_11">
												<option>Select Yes / No :</option>
												<option>Y</option>
												<option>N</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 col-sm-offset-1 control-level">Select Item / Items :</label>
										<div class="col-sm-4">
											<input name="chem" type="text" class="form-control" id="item2">
										</div>
										<p class="text-danger"> * Use commas or tabs</p>
									</div>

									<div class="form-group">
										<label class="col-sm-2 col-sm-offset-1 control-level">Select Spot / Full:</label>
										<div class="col-sm-4">
											<select name="spot_full" class="form-control" onChange="enable_add_two()" id="hide_12">
												<option>Select Spot / Full :</option>
												<option>Spot</option>
												<option>Full</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 col-sm-offset-1 control-level">Select Pests / Diseases :</label>
										<div class="col-sm-4">
											<input name="pest" type="text" class="form-control" id="paste2">
										</div>
										<p class="text-danger"> * Use commas or tabs</p>
									</div>
									<div class="form-group">
										<label class="col-sm-2 col-sm-offset-1 control-level">Select Intencity :</label>
										<div class="col-sm-4">
											<input name="intensity" type="text" class="form-control" id="intsty2">
											</div>
											<p class="text-danger"> * Use commas or tabs</p>
									</div>
									<div class="form-group">
										<label class="col-sm-2 col-sm-offset-1 control-level">Select Quantity :</label>
										<div class="col-sm-4">
											<input name="qty_unit" type="text" class="form-control" id="qty2">
										</div>
										<p class="text-danger"> * Use commas or tabs</p>
									</div>
									<!-- <div class="form-group">
										<label class="col-sm-2 col-sm-offset-1 control-level">Select Unit (kg/ Lt) :</label>
										<div class="col-sm-4">
											<select class="form-control" onChange="enable_add_two()" id="hide_13">
												<option>Select Kg / Lt :</option>
												<option>K</option>
												<option>L</option>
											</select>
										</div>
									</div> -->
									<div class="form-group">
										<label class="col-sm-2 col-sm-offset-1 control-level">Select Area :</label>
										<div class="col-sm-4">
											<input name="area" type="text" class="form-control">
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 col-sm-offset-1 control-level">No of Drums (sprayed) :</label>
										<div class="col-sm-4">
											<input name="no_drms" type="text" class="form-control">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 col-sm-offset-1 control-level">Mandays (D Rated):</label>
										<div class="col-sm-4">
											<input name="dr_mnds" type="text" class="form-control">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 col-sm-offset-1 control-level">Mandays (Supervisory) :</label>
										<div class="col-sm-4">
											<input name="sup_mnds" type="text" class="form-control">
										</div>
									</div>
									<div class="col-sm-2 col-sm-offset-3">
										<input type="submit" id="add_entry" name="add_submit" value="Add Entry" class="btn btn-success"style="margin-top:20px; margin-left:-10px;">
									</div>
                </form>
              </div>
						</div>
          </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
				<script src="scripts/bootstrap-tokenfield.min.js"></script>
    		<script>
    				$(function() {
    				$( "#datepicker" ).datepicker({dateFormat: 'dd-mm-yy'});
						$('#item1,#item2,#paste1,#qty1,#paste2,#qty2').tokenfield({});

						$('#intsty1,#intsty2').tokenfield({
								autocomplete :{
										source:['L','M','H'],
										delay:100
								},
								showAutocompleteOnFocus: true
						});

    				});

    		</script>

					<script>

						if(document.getElementById('datepicker').value!=''){
							document.getElementById('hide_me').disabled=false;
						}
						else {
							document.getElementById('hide_me').disabled=true;
						}
					if(document.getElementById('item1').value!='')
					{
						document.getElementById('delete_entry').disabled=false;
						document.getElementById('edit_entry').disabled=false;
							document.getElementById('add_entry').disabled=false;

					}
					else{
						document.getElementById('delete_entry').disabled=true;
						document.getElementById('edit_entry').disabled=true;
							document.getElementById('add_entry').disabled=true;

					}
					function enable_add() {


						if(document.getElementById('hide_one').value!='Select a section' && document.getElementById('hide_two').value!='Select Hz/Db')
						{
								document.getElementById('hide_me').disabled=false;
						}
						else {
								document.getElementById('hide_me').disabled=true;
						}

					}


					function enable_add_one() {

						if(document.getElementById('hide_1').value!='Select Yes / No :' && document.getElementById('hide_2').value!='Select Spot / Full :')
						{
							document.getElementById('delete_entry').disabled=false;
							document.getElementById('edit_entry').disabled=false;
						}
						else {
							document.getElementById('delete_entry').disabled=true;
							document.getElementById('edit_entry').disabled=true;
						}


					}
					function enable_add_two() {

						if(document.getElementById('hide_11').value!='Select Yes / No :' && document.getElementById('hide_12').value!='Select Spot / Full :')
						{
							document.getElementById('add_entry').disabled=false;

						}
						else {
							document.getElementById('add_entry').disabled=true;

						}

					}
					</script>
					<?php
					if(isset($set2)){
					echo"<script>		var submit_chk=$set2; submit_chk2=$set; </script>";}
					?>

								<script>
										document.getElementById('take1').disabled=true;
										document.getElementById('take2').disabled=true;
									if(submit_chk==1 && submit_chk2)
										{
											document.getElementById('ac_one').disabled=false;
											var a1=document.getElementById('tab1');
											a1.setAttribute('class','active');
											var b1=document.getElementById('take1');
											b1.style.background='#3E2723' ;
											var c1=document.getElementById('take1');
											c1.style.color='#FFFFFF';


										}
									if(submit_chk==2 && submit_chk2){
											document.getElementById('ac_two').disabled=false;
											var a2=document.getElementById('tab2');
											a2.setAttribute('class','active');
											var b2=document.getElementById('take2');
											b2.style.background='#3E2723';
											var c2=document.getElementById('take2');
											c2.style.color='#FFFFFF';
										}

								</script>


        </body>
    </body>
</html>

<?php
  // mysqli_free_result($result);
	end_connection($connection);
?>
