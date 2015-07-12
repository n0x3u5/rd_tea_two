<?php
	require_once('includes/sessions.php');
	require_once('includes/functions.php');

	if(!isset($_SESSION['user'])) {
		redirect_to("index.php");
	}

	if(($_SESSION['user_div'] != "ALL") && ($_SESSION['user_div'] != $_SESSION['current_div'])) {
		$_SESSION['flag_div_chk'] = 1;
		redirect_to("update_profile.php");
	}
	else {
		$_SESSION['flag_div_chk'] = 0;
	}
?>

<?php
	$connection = make_connection();
	// var_dump($_POST);echo "<br><hr>";
	if(isset($_POST["dt_sec_submit"])) {
		$req_yr = (int) $_POST["year"];
		$req_ssn = $_POST["short_sec_name"];
		$_SESSION['ssn'] = $req_ssn;
		$_SESSION['yr'] = $req_yr;

		// if($_SESSION["user_div"] == "ALL") {
		// 	$req_div = $_SESSION["current_div"];
		// }
		// else {
		// 	$req_div = $_SESSION["user_div"];
		// }
		// $_SESSION['div_name'] = $req_div;

		// echo "<br>got year =".$req_yr."<br>";
		// echo "<br>got ssn =" .$req_ssn."<br>";

		$q_soil = "SELECT * FROM yearly_soil_manuring WHERE short_sec_name='{$req_ssn}' and year='{$req_yr}'and division = '{$_SESSION['current_div']}'";
		// var_dump($q_soil);
		$r_soil = mysqli_query($connection, $q_soil);
    confirm_query($r_soil);

		$_SESSION['soil_manure'] = mysqli_fetch_assoc($r_soil);
		// var_dump($_SESSION['soil_manure']);


		$q_prune = "SELECT * FROM yearly_prune_infilling WHERE short_sec_name='{$req_ssn}' and year='{$req_yr}' and division = '{$_SESSION['current_div']}'";
		// var_dump($q_prune);
		$r_prune = mysqli_query($connection, $q_prune);
    confirm_query($r_prune);

		$_SESSION['prune_infill'] = mysqli_fetch_assoc($r_prune);
		// var_dump($_SESSION['prune_infill']);
		$set = 1;
	}
	else {
		$req_date = NULL;
		$req_ssn = NULL;
		$r_soil = NULL;
		$r_prune = NULL;
		$set = 0;
	}
?>

<?php //insertion
	if(isset($_POST['add_submit'])) {
		$short_sec_name = $_SESSION['ssn'];
		$year = $_SESSION['yr'];

		$prune = mysqli_real_escape_string($connection, $_POST['prune']);
		$tipping = mysqli_real_escape_string($connection, $_POST['tipping']);
		$made_tea = (float) mysqli_real_escape_string($connection, $_POST['made_tea']);
		$vacancy = (float) mysqli_real_escape_string($connection, $_POST['vacancy']);
		$shade_status = mysqli_real_escape_string($connection, $_POST['shade_status']);
		$infill_tea = (int) mysqli_real_escape_string($connection, $_POST['infill_tea']);
		$infill_shade = (int) mysqli_real_escape_string($connection, $_POST['infill_shade']);
		$remarks = mysqli_real_escape_string($connection, $_POST['remarks']);

		$n = (int) mysqli_real_escape_string($connection, $_POST['n']);
		$p = (int) mysqli_real_escape_string($connection, $_POST['p']);
		$k = (int) mysqli_real_escape_string($connection, $_POST['k']);
		$top_pH = (float) mysqli_real_escape_string($connection, $_POST['top_pH']);
		$sub_pH = (float) mysqli_real_escape_string($connection, $_POST['sub_pH']);
		$org_C = (float) mysqli_real_escape_string($connection, $_POST['org_C']);
		$avbl_P = mysqli_real_escape_string($connection, $_POST['avbl_P']);
		$avbl_K = mysqli_real_escape_string($connection, $_POST['avbl_K']);
		$avbl_N = mysqli_real_escape_string($connection, $_POST['avbl_N']);
		$avbl_S = mysqli_real_escape_string($connection, $_POST['avbl_S']);

		$q_prune_in = "INSERT INTO yearly_prune_infilling (division, short_sec_name, year, prune, tipping, made_tea, vacancy, shade_status, infill_tea, infill_shade, remarks) VALUES ('{$_SESSION['current_div']}', '{$short_sec_name}', {$year}, '{$prune}', '{$tipping}', {$made_tea}, {$vacancy}, '{$shade_status}', {$infill_tea}, {$infill_shade}, '{$remarks}')";

		$r_prune_in = mysqli_query($connection, $q_prune_in);
		confirm_query($r_prune_in);

		if(mysqli_affected_rows($connection) > 0) {
			$flag_prune = 1;
		}
		else {
			$flag_prune = 0;
		}

		$q_soil_in = "INSERT INTO yearly_soil_manuring (division, short_sec_name, year, n, p, k, top_pH, sub_pH, org_C, avbl_P, avbl_K, avbl_N, avbl_S) VALUES ('{$_SESSION['current_div']}', '{$short_sec_name}', {$year}, {$n}, {$p}, {$k}, {$top_pH}, {$sub_pH}, {$org_C}, '{$avbl_P}', '{$avbl_K}', '{$avbl_N}', '{$avbl_S}')";

		$r_soil_in = mysqli_query($connection, $q_soil_in);
		confirm_query($r_soil_in);

		if(mysqli_affected_rows($connection) > 0) {
			$flag_soil = 1;
		}
		else {
			$flag_soil = 0;
		}

		if($flag_soil == 1 || $flag_prune == 1) {?>
			<div class=" container alert alert-success alert-dismissible" style="border-color:green" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
				<strong>Success!</strong> Inserted Successfully!
			</div>
		<?php }
		elseif ($flag_soil == 0 && $flag_prune == 0) { ?>
			<div class=" container alert alert-warning alert-dismissible" role="alert" style="border-color:yellow">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
				<strong>Sorry!</strong> No row affected!
			</div>

		<?php }

		$_SESSION['soil_manure'] = NULL;
		$_SESSION['prune_infill'] = NULL;
		$_SESSION['ssn'] = NULL;
		$_SESSION['yr'] = NULL;
		// $_SESSION['div_name'] = NULL;
	}
?>

<?php //update
	if(isset($_POST['edit_submit'])) {
		$short_sec_name = $_SESSION['ssn'];
		$year = $_SESSION['yr'];
		$soil_id = $_SESSION['soil_manure']['id'];
		$prune_id = $_SESSION['prune_infill']['id'];


		$prune = mysqli_real_escape_string($connection, $_POST['prune']);
		$tipping = mysqli_real_escape_string($connection, $_POST['tipping']);
		$made_tea =(float) mysqli_real_escape_string($connection, $_POST['made_tea']);
		$vacancy = (float) mysqli_real_escape_string($connection, $_POST['vacancy']);
		$shade_status = mysqli_real_escape_string($connection, $_POST['shade_status']);
		$infill_tea = (int) mysqli_real_escape_string($connection, $_POST['infill_tea']);
		$infill_shade = (int) mysqli_real_escape_string($connection, $_POST['infill_shade']);
		$remarks = mysqli_real_escape_string($connection, $_POST['remarks']);

		$n = (int) mysqli_real_escape_string($connection, $_POST['n']);
		$p = (int) mysqli_real_escape_string($connection, $_POST['p']);
		$k = (int) mysqli_real_escape_string($connection, $_POST['k']);
		$top_pH = (float) mysqli_real_escape_string($connection, $_POST['top_pH']);
		$sub_pH = (float) mysqli_real_escape_string($connection, $_POST['sub_pH']);
		$org_C = (float) mysqli_real_escape_string($connection, $_POST['org_C']);
		$avbl_P = mysqli_real_escape_string($connection, $_POST['avbl_P']);
		$avbl_K = mysqli_real_escape_string($connection, $_POST['avbl_K']);
		$avbl_N = mysqli_real_escape_string($connection, $_POST['avbl_N']);
		$avbl_S = mysqli_real_escape_string($connection, $_POST['avbl_S']);

		$q_prune_up = "UPDATE yearly_prune_infilling SET division='{$_SESSION['current_div']}', short_sec_name='{$short_sec_name}', year={$year}, prune='{$prune}', tipping='{$tipping}', made_tea={$made_tea}, vacancy={$vacancy}, shade_status='{$shade_status}', infill_tea={$infill_tea}, infill_shade={$infill_shade}, remarks='{$remarks}' WHERE id = {$prune_id}";

		$r_prune_up = mysqli_query($connection, $q_prune_up);
		confirm_query($r_prune_up);

		if(mysqli_affected_rows($connection) > 0) {
			$flag_prune = 1;
		}
		else {
			$flag_prune = 0;
		}

		$q_soil_up = "UPDATE yearly_soil_manuring SET division='{$_SESSION['current_div']}', short_sec_name='{$short_sec_name}', year={$year}, n={$n}, p={$p}, k={$k}, top_pH={$top_pH}, sub_pH={$sub_pH}, org_C={$org_C}, avbl_P='{$avbl_P}', avbl_K='{$avbl_K}', avbl_N='{$avbl_N}', avbl_S='{$avbl_S}' WHERE id = {$soil_id}";

		$r_soil_up = mysqli_query($connection, $q_soil_up);
		confirm_query($r_soil_up);

		if(mysqli_affected_rows($connection) > 0) {
			$flag_soil = 1;
		}
		else {
			$flag_soil = 0;
		}

		if($flag_soil == 1 || $flag_prune == 1) {?>
			<div class=" container alert alert-success alert-dismissible" style="border-color:green" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
				<strong>Success!</strong> Edited Successfully!
			</div>
		<?php }
		elseif ($flag_soil == 0 && $flag_prune == 0) { ?>
			<div class=" container alert alert-warning alert-dismissible" role="alert" style="border-color:yellow">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
				<strong>Sorry!</strong> No row affected!
			</div>
		<?php }

		$_SESSION['soil_manure'] = NULL;
		$_SESSION['prune_infill'] = NULL;
		$_SESSION['ssn'] = NULL;
		$_SESSION['yr'] = NULL;
		// $_SESSION['div_name'] = NULL;
	}
?>

<?php
	if(isset($_POST['del_entry'])) {
		$short_sec_name = $_SESSION['ssn'];
		$year = $_SESSION['yr'];

		$q_prune_del = "DELETE FROM yearly_prune_infilling WHERE short_sec_name='{$short_sec_name}' and year='{$year}' and division = '{$_SESSION['current_div']}'";
		//var_dump($q_prune_del);
		$r_prune_del = mysqli_query($connection, $q_prune_del);
    confirm_query($r_prune_del);

		if(mysqli_affected_rows($connection) > 0) {
			$flag_prune = 1;
		}
		else {
			$flag_prune = 0;
		}

		$q_soil_del = "DELETE FROM yearly_soil_manuring WHERE short_sec_name='{$short_sec_name}' and year='{$year}' and division = '{$_SESSION['current_div']}'";
		//var_dump($q_soil_del);
		$r_soil_del = mysqli_query($connection, $q_soil_del);
    confirm_query($r_soil_del);

		if(mysqli_affected_rows($connection) > 0) {
			$flag_soil = 1;
		}
		else {
			$flag_soil = 0;
		}

		if($flag_soil == 1 || $flag_prune == 1) { ?>
			<div class=" container alert alert-success alert-dismissible" style="border-color:green" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
				<strong>Success!</strong> Deleted Successfully!
			</div>
		<?php }
		elseif ($flag_soil == 0 && $flag_prune == 0) {?>
			<div class=" container alert alert-warning alert-dismissible" role="alert" style="border-color:yellow">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
				<strong>Sorry!</strong> No row affected!
			</div>
		<?php }

		$_SESSION['soil_manure'] = NULL;
		$_SESSION['prune_infill'] = NULL;
		$_SESSION['ssn'] = NULL;
		$_SESSION['yr'] = NULL;
		// $_SESSION['div_name'] = NULL;
	}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>R.D. Tea | Yearly Sectional Entry</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
				<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
				<link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css">
        <link rel="stylesheet" href="css/stylesheet.css">
        <link rel="icon" href="images/logo_rdtea.png"/>
				<style>
					.btn-default {
						background: #FFFFFF;
						color:Black;
						border: none;
            margin-left:15px;
					}
          @media screen and (min-width: 770px) {
              .jumbotron{
                  margin-left:-15px;
						      margin-right: -15px;
                }

          }

					.jumbotron{
						 background:#3F51B5;
					   padding-bottom: 25px;
					}
					.jumbotron h1{
						color:#E6E8F9;
            padding-bottom: 10px;
					}
          .nav-tabs.nav-justified > .active > a, .nav-tabs.nav-justified > .active > a:hover, .nav-tabs.nav-justified > .active > a:active, .nav-tabs.nav-justified > .active > a:enabled {
          background-color: #1A237E !important;
          border-bottom-color: #5D4037;
          color: #FFFFFF;
          }

	      </style>
        <?php $page_id = 12;?>
    </head>
    <body>
         <?php
            include("nav_bar.php");
            nav_echoer($page_id);
        ?>
      <div class="container">
              <div class="jumbotron">
                  <h1>Yearly Sectional Entry</h1>
                  <form action="yearly_sectional_entry.php" method="post" class="form-horizontal" style="margin-top: 30px;">
                    <div class="row col-sm-12">
                      <div class="form-group col-sm-6">
                        <label for="section">Select section:</label>
                        <div>
													<select id="section" name ="short_sec_name" class="form-control" onchange="enable_add()" >
														<?php
																$q = "SELECT * FROM sections WHERE division = '{$_SESSION['current_div']}'";
																$result = mysqli_query($connection, $q);

																confirm_query($result);
																//$_POST['sec_short_nm'] = NULL;

																echo "<option id=\"opt0\" value=\"Select a section\">Select a section</option>";
																while($sec_values = mysqli_fetch_assoc($result)) {
														?>
																	<option value="<?php echo htmlentities($sec_values['short_sec_name']) ?>" <?php if(isset($_POST["dt_sec_submit"]) && ($_SESSION['ssn'] == $sec_values['short_sec_name'])) { echo "selected";} ?> ><?php echo htmlentities($sec_values['short_sec_name']); ?></option>
														<?php
																}
														?>
													</select>
                        </div>
                      </div>
                    </div>
                    <div class="row col-sm-12">
                      <div class="form-group col-sm-6">
                        <label for="year">Select Year:</label>
                        <div>
                        <input type="text" id="year" name="year" class="form-control" <?php if(isset($_POST['dt_sec_submit']) && isset($_SESSION['yr'])) { ?> value="<?php echo $_SESSION['yr']; ?>"<?php } else {?>  placeholder=<?php echo "\"Select a Year\""; ?><?php } ?> required>
                        </div>
                      </div>
                    </div>
                       <div class="form-group">
    									    <input type="submit" id="select_sec_date" name="dt_sec_submit" value="Submit" class="btn btn-default" style="margin-top:10px;">
                       </div>

                  </form>

              </div>
  			<div class="tab-container">
  	            <ul class="nav nav-tabs nav-justified">
  	                <li id="actv_one"><a href="#tab1" data-toggle="tab" id="link_one">Edit Entry</a></li>
  	                <li id="actv_two"><a href="#tab2" data-toggle="tab" id="link_two">Add Entry</a></li>
  	            </ul>
  				<div class="tab-content" style="background-color:#FFFFFF">



  					<div class="tab-pane" id="tab1">
  						<form class="form-horizontal" action="yearly_sectional_entry.php" method="post">
								<?php
									if(isset($_SESSION['prune_infill']) && isset($_SESSION['soil_manure'])) {
										$man_soil = $_SESSION['soil_manure']; $fill_prune = $_SESSION['prune_infill'];
									}
									else { $man_soil = NULL; $fill_prune = NULL; }
								?>

								<div class="form-group">
  								<label for="prune1" class="col-sm-3 control-label">Prune style:</label>
  								<div class="col-sm-4">
  									<input type="text" name="prune" class="form-control" id="prune1" <?php if(isset($fill_prune)) { ?> value="<?php echo htmlentities($fill_prune['prune']); ?>"<?php } else { ?>placeholder=<?php echo "\"Tipping\""; ?> <?php } ?> >
  								</div>
  							</div>
  							<div class="form-group">
  								<label for="tipp1" class="col-sm-3 control-label">Tipping:</label>
  								<div class="col-sm-4">
  									<input type="text" name="tipping" class="form-control" id="tipp1" <?php if(isset($fill_prune)) { ?> value="<?php  $set2 = 1; echo htmlentities($fill_prune['tipping']); ?>"<?php } else { ?>placeholder=<?php $set2 = 2; echo "\"Tipping\""; ?> <?php } ?> >
  								</div>
  							</div>
  							<div class="form-group">
  								<label for="Md_tea1" class="col-sm-3 control-label">Made Tea (Kg/Ha):</label>
  								<div class="col-sm-4">
  									<input type="text" name="made_tea" class="form-control" id="Md_tea1" <?php if(isset($fill_prune)) { ?> value="<?php echo htmlentities($fill_prune['made_tea']); ?>"<?php } else { ?>placeholder=<?php echo "\"Made tea (kg/ha)\""; ?> <?php } ?> >
  								</div>
  							</div>
  							<div class="form-group">
  								<label for="vcp1" class="col-sm-3 control-label">Vacancy (in %):</label>
  								<div class="col-sm-4">
  									<input type="text" name="vacancy" class="form-control" id="vcp1" <?php if(isset($fill_prune)) { ?> value="<?php echo htmlentities($fill_prune['vacancy']); ?>"<?php } else { ?>placeholder=<?php echo "\"Vacancy (in %)\""; ?> <?php } ?> >
  								</div>
  							</div>
  							<div class="form-group">
  								<label for="shd_sts1" class="col-sm-3 control-label">Shade Status:</label>
  								<div class="col-sm-4">
  									<input type="text" class="form-control" id="shd_sts1" name="shade_status" <?php if(isset($fill_prune)) { ?> value="<?php echo htmlentities($fill_prune['shade_status']); ?>"<?php } else { ?>placeholder=<?php echo "\"Shade Status\""; ?> <?php } ?> >
  								</div>
  							</div>
  							<div class="form-group">
  								<label for="infill_t1" class="col-sm-3 control-label">Infill (Tea):</label>
  								<div class="col-sm-4">
  									<input type="text" class="form-control" id="infill_t1" name="infill_tea" <?php if(isset($fill_prune)) { ?> value="<?php echo htmlentities($fill_prune['infill_tea']); ?>"<?php } else { ?>placeholder=<?php echo "\"Infill (Tea)\""; ?> <?php } ?> >
  								</div>
  							</div>
                <div class="form-group">
                  <label for="infill_shd1" class="col-sm-3 control-label">Infill (Shade):</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="infill_shd1" placeholder="Infill (Shade)" name="infill_shade" <?php if(isset($fill_prune)) { ?> value="<?php echo htmlentities($fill_prune['infill_shade']); ?>"<?php } else { ?>placeholder=<?php echo "\"Infill (Shade)\""; ?> <?php } ?> >
                  </div>
                </div>
								<div class="form-group">
									<label for="man_n1" class="col-sm-3 control-label">N Dose (Manuring):</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" id="man_n1" name="n" <?php if(isset($man_soil)) { ?> value="<?php echo htmlentities($man_soil['n']); ?>"<?php } else { ?>placeholder=<?php echo "\"N (Manuring)\""; ?> <?php } ?> >
									</div>
								</div>
								<div class="form-group">
									<label for="man_p1" class="col-sm-3 control-label">P Dose (Manuring):</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" id="man_p1" name="p" <?php if(isset($man_soil)) { ?> value="<?php echo htmlentities($man_soil['p']); ?>"<?php } else { ?>placeholder=<?php echo "\"P (Manuring)\""; ?> <?php } ?> >
									</div>
								</div>
								<div class="form-group">
									<label for="man_k1" class="col-sm-3 control-label">K Dose (Manuring):</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" id="man_k1" name="k" <?php if(isset($man_soil)) { ?> value="<?php echo htmlentities($man_soil['k']); ?>"<?php } else { ?>placeholder=<?php echo "\"K (Manuring)\""; ?> <?php } ?> >
									</div>
								</div>
								<div class="form-group">
									<label for="top1" class="col-sm-3 control-label">Top (in pH):</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" id="top1" name="top_pH" <?php if(isset($man_soil)) { ?> value="<?php echo htmlentities($man_soil['top_pH']); ?>"<?php } else { ?>placeholder=<?php echo "\"Top pH\""; ?> <?php } ?> >
									</div>
								</div>
								<div class="form-group">
									<label for="sub1" class="col-sm-3 control-label">Sub (in pH):</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" id="sub1" name="sub_pH"  <?php if(isset($man_soil)) { ?> value="<?php echo htmlentities($man_soil['sub_pH']); ?>"<?php } else { ?>placeholder=<?php echo "\"Sub pH\""; ?> <?php } ?> >
									</div>
								</div>
								<div class="form-group">
									<label for="orgc1" class="col-sm-3 control-label">Org C (in %):</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" id="orgc1" name="org_C" <?php if(isset($man_soil)) { ?> value="<?php echo htmlentities($man_soil['org_C']); ?>"<?php } else { ?>placeholder=<?php echo "\"Org C\""; ?> <?php } ?> >
									</div>
								</div>
								<div class="form-group">
									<label for="avp1" class="col-sm-3 control-label">Avbl P (in ppm):</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" id="avp1" name="avbl_P" <?php if(isset($man_soil)) { ?> value="<?php echo htmlentities($man_soil['avbl_P']); ?>"<?php } else { ?>placeholder=<?php echo "\"Avbl P\""; ?> <?php } ?> >
									</div>
								</div>
								<div class="form-group">
									<label for="Avk1" class="col-sm-3 control-label">Avbl K (in ppm):</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" id="avk1" name="avbl_K" <?php if(isset($man_soil)) { ?> value="<?php echo htmlentities($man_soil['avbl_K']); ?>"<?php } else { ?>placeholder=<?php echo "\"Avbl K\""; ?> <?php } ?> >
									</div>
								</div>
								<div class="form-group">
									<label for="avbln1" class="col-sm-3 control-label">Avbl N (in ppm):</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" id="avbln1" name="avbl_N" <?php if(isset($man_soil)) { ?> value="<?php echo htmlentities($man_soil['avbl_N']); ?>"<?php } else { ?>placeholder=<?php echo "\"Avbl N\""; ?> <?php } ?> >
									</div>
								</div>
								<div class="form-group">
									<label for="avbls1" class="col-sm-3 control-label">Avbl S (in ppm):</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" id="avbls1" name="avbl_S" <?php if(isset($man_soil)) { ?> value="<?php echo htmlentities($man_soil['avbl_S']); ?>"<?php } else { ?>placeholder=<?php echo "\"Avbl S\""; ?> <?php } ?> >
									</div>
								</div>
                <div class="form-group">
                  <label for="Remarks1" class="col-sm-3 control-label">Remarks:</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="Remarks1" name="remarks" <?php if(isset($fill_prune)) { ?> value="<?php echo htmlentities($fill_prune['remarks']); ?>"<?php } else { ?>placeholder=<?php echo "\"Remarks\""; ?> <?php } ?> >
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
  						<form class="form-horizontal" action="yearly_sectional_entry.php" method="post">
								<div class="form-group">
  								<label for="prune2" class="col-sm-3 control-label">Prune style:</label>
  								<div class="col-sm-4">
  									<input type="text" name="prune" placeholder="Prune" class="form-control" id="prune2" required>
  								</div>
  							</div>
  							<div class="form-group">
  								<label for="tipp" class="col-sm-3 control-label">Tipping:</label>
  								<div class="col-sm-4">
  									<input type="text" name="tipping" placeholder="Tipping" class="form-control" id="tipp" required>
  								</div>
  							</div>
  							<div class="form-group">
  								<label for="Md_tea" class="col-sm-3 control-label">Made Tea (Kg/Ha):</label>
  								<div class="col-sm-4">
  									<input type="text" name="made_tea" placeholder="Made Tea (Kg/Ha)" class="form-control" id="Md_tea" required>
  								</div>
  							</div>
  							<div class="form-group">
  								<label for="vcp" class="col-sm-3 control-label">Vacancy (in %):</label>
  								<div class="col-sm-4">
  									<input type="text" name="vacancy" placeholder="Vacancy (in %)" class="form-control" id="vcp">
  								</div>
  							</div>
  							<div class="form-group">
  								<label for="shd_sts" class="col-sm-3 control-label">Shade Status:</label>
  								<div class="col-sm-4">
  									<input type="text" class="form-control" placeholder="Shade Status" id="shd_sts" name="shade_status" required>
  								</div>
  							</div>
  							<div class="form-group">
  								<label for="infill_t" class="col-sm-3 control-label">Infill (Tea):</label>
  								<div class="col-sm-4">
  									<input type="text" class="form-control" placeholder="Infill (Tea)" id="infill_t" name="infill_tea">
  								</div>
  							</div>
                <div class="form-group">
                  <label for="infill_shd" class="col-sm-3 control-label">Infill (Shade):</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="infill_shd" placeholder="Infill (Shade)" name="infill_shade">
                  </div>
                </div>
								<div class="form-group">
									<label for="man_n2" class="col-sm-3 control-label">N Dose (Manuring):</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" placeholder="N (Manuring)" id="man_n2" name="n" >
									</div>
								</div>
								<div class="form-group">
									<label for="man_p2" class="col-sm-3 control-label">P Dose (Manuring):</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" id="man_p2" placeholder="P (Manuring)" name="p" required>
									</div>
								</div>
								<div class="form-group">
									<label for="man_k2" class="col-sm-3 control-label">K Dose (Manuring):</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" id="man_k2" placeholder="K (Manuring)" name="k" >
									</div>
								</div>
								<div class="form-group">
									<label for="top2" class="col-sm-3 control-label">Top (in pH):</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" id="top2" placeholder="Top (in pH)" name="top_pH" >
									</div>
								</div>
								<div class="form-group">
									<label for="sub2" class="col-sm-3 control-label">Sub (in pH):</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" id="sub2" placeholder="Sub (in pH)" name="sub_pH" >
									</div>
								</div>
								<div class="form-group">
									<label for="orgc2" class="col-sm-3 control-label">Org C (in %):</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" id="orgc2" placeholder="Org C" name="org_C" >
									</div>
								</div>
								<div class="form-group">
									<label for="avp2" class="col-sm-3 control-label">Avbl P (in ppm):</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" id="avp2" placeholder="Av P" name="avbl_P">
									</div>
								</div>
								<div class="form-group">
									<label for="Avk2" class="col-sm-3 control-label">Avbl K (in ppm):</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" id="avk2"  placeholder="Av K" name="avbl_K">
									</div>
								</div>
								<div class="form-group">
									<label for="avbln2" class="col-sm-3 control-label">Avbl N (in ppm):</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" id="avbln2" placeholder="Avbl N" name="avbl_N" >
									</div>
								</div>
								<div class="form-group">
									<label for="avbls2" class="col-sm-3 control-label">Avbl S (in ppm):</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" id="avbls2" placeholder="Avbl S" name="avbl_S" >
									</div>
								</div>
                <div class="form-group">
                  <label for="Remarks2" class="col-sm-3 control-label">Remarks:</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="Remarks_prn_2" placeholder="Remarks" name="remarks">
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
			<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment-with-locales.min.js"></script>
  		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
			<script src="scripts/bootstrap-datetimepicker.min.js"></script>
      <script>
			$(function() {
				$('#year').datetimepicker({
					locale:'en',
					format:'YYYY'
				});
			});
      </script>
			<script>
				document.getElementById('select_sec_date').disabled=true;
				document.getElementById('link_one').disabled=true;
				document.getElementById('link_two').disabled=true;
				if(document.getElementById('section').value!='Select a section')
				{
					document.getElementById('select_sec_date').disabled=false;
				}
				function enable_add(){
						if(document.getElementById('section').value!='Select a section')
					{
						document.getElementById('select_sec_date').disabled=false;
					}
					else {
						document.getElementById('select_sec_date').disabled=true;
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
	end_connection($connection);
?>
