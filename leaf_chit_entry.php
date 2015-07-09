<?php
	require_once('includes/sessions.php');
	require_once('includes/functions.php');
?>
<?php
	//var_dump($_SESSION);
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

	$connection = make_connection();
	if(isset($_POST['dt_cat_submit'])) {
		$req_lcsn = $_POST['lab_cat'];
		$_SESSION['lcsn'] = $req_lcsn;
		$_SESSION['prune_stats'] = $_POST['prune_stats'];
		$req_date = date('Y-m-d', strtotime($_POST['date_value']));
		$_SESSION['date'] = $req_date;

		if($_SESSION["user_div"] == "ALL") {
			$req_div = $_SESSION["current_div"];
		}
		else {
			$req_div = $_SESSION["user_div"];
		}
		$_SESSION['div_name'] = $req_div;

		$query = "SELECT * FROM leaf_chit_table WHERE lab_cat ='{$req_lcsn}' and rec_dt='{$req_date}' and division ='{$_SESSION['div_name']}'";

		$result = mysqli_query($connection, $query);
		confirm_query($result);

		$_SESSION['leaf_chit'] = mysqli_fetch_assoc($result);


		// var_dump($_SESSION['lcsn']);
		// var_dump($_SESSION['prune_stats']);
		// var_dump($req_date);


		//var_dump($query);
		//
		// $result = mysqli_query($connection, $query);
		// confirm_query($result);
		$set = 1;

	}
	else {
		$req_date = NULL;
		$result = NULL;
		$set = 0;
	}

	if(isset($_POST['add_submit'])) {

	$lab_cat = $_SESSION['lcsn'];
	$rec_dt = $_SESSION['date'];
	$prune_stats = $_SESSION['prune_stats'];

	$short_sec_name = mysqli_real_escape_string($connection, $_POST['short_sec_name']);
	$short_sec_name = explode_implode($short_sec_name);
	$dt_lst_plkd = mysqli_real_escape_string($connection, $_POST['dt_lst_plkd']);
	$dt_lst_plkd = explode_implode($dt_lst_plkd);
	$plkd_area = (float) mysqli_real_escape_string($connection, $_POST['plkd_area']);
	$plkd_leaf = (float) mysqli_real_escape_string($connection, $_POST['plkd_leaf']);
	$mandays = (int) mysqli_real_escape_string($connection, $_POST['mandays']);
	$task = mysqli_real_escape_string($connection, $_POST['task']);
	$task = explode_implode($task);
	$ballo_count = (int) mysqli_real_escape_string($connection, $_POST['ballo_count']);
	// $cp_qty = (float) mysqli_real_escape_string($connection, $_POST['cp_qty']);
	// $cp_hr_from = mysqli_real_escape_string($connection, $_POST['cp_hr_from']);
	// $cp_hr_to = mysqli_real_escape_string($connection, $_POST['cp_hr_to']);

	$q_in = "INSERT INTO leaf_chit_table (division, prune_stats, lab_cat, rec_dt, short_sec_name, dt_lst_plkd, plkd_area, plkd_leaf, mandays, task, ballo_count) VALUES ('{$_SESSION['div_name']}', '{$prune_stats}', '{$lab_cat}', '{$rec_dt}',  '{$short_sec_name}', '{$dt_lst_plkd}', {$plkd_area}, {$plkd_leaf}, {$mandays}, '{$task}', {$ballo_count}) ";

	$r_in = mysqli_query($connection, $q_in);
	confirm_query($r_in);

	if(mysqli_affected_rows($connection) > 0) { ?>
		<div class=" container alert alert-success alert-dismissible" style="border-color:green" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
			<strong>Success!</strong> Inserted Successfully!
		</div>
	<?php }
	else { ?>
		<div class=" container alert alert-warning alert-dismissible" role="alert" style="border-color:yellow">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
			<strong>Sorry!</strong> No row affected!
		</div>


	<?php }

	$_SESSION['lcsn'] = $_SESSION['prune_stats'] = $_SESSION['date'] = $_SESSION['leaf_chit'] = NULL;
	$_SESSION['div_name'] = NULL;

 }


 if(isset($_POST['edit_submit'])) {

	$lab_cat = $_SESSION['lcsn'];
	$rec_dt = $_SESSION['date'];
	$req_id = $_SESSION['leaf_chit']['id'];
	$prune_stats = $_SESSION['prune_stats'];

	$short_sec_name = mysqli_real_escape_string($connection, $_POST['short_sec_name']);
	$short_sec_name = explode_implode($short_sec_name);
	$dt_lst_plkd = mysqli_real_escape_string($connection, $_POST['dt_lst_plkd']);
	$dt_lst_plkd = explode_implode($dt_lst_plkd);
	$plkd_area = (float) mysqli_real_escape_string($connection, $_POST['plkd_area']);
	$plkd_leaf = (float) mysqli_real_escape_string($connection, $_POST['plkd_leaf']);
	$mandays = (int) mysqli_real_escape_string($connection, $_POST['mandays']);
	$task = mysqli_real_escape_string($connection, $_POST['task']);
	$task = explode_implode($task);
	$ballo_count = (int) mysqli_real_escape_string($connection, $_POST['ballo_count']);
	// $cp_qty = (float) mysqli_real_escape_string($connection, $_POST['cp_qty']);
	// $cp_hr_from = mysqli_real_escape_string($connection, $_POST['cp_hr_from']);
	// $cp_hr_to = mysqli_real_escape_string($connection, $_POST['cp_hr_to']);

	$q_up = "UPDATE leaf_chit_table SET division='{$_SESSION['div_name']}', prune_stats='{$prune_stats}', lab_cat='{$lab_cat}', rec_dt='{$rec_dt}', short_sec_name = '{$short_sec_name}', dt_lst_plkd = '{$dt_lst_plkd}', plkd_area={$plkd_area}, plkd_leaf={$plkd_leaf}, mandays = {$mandays}, task = '{$task}', ballo_count = {$ballo_count} where id = $req_id ";
	$r_up = mysqli_query($connection, $q_up);
	confirm_query($r_up);

	if(mysqli_affected_rows($connection) > 0) { ?>
		<div class=" container alert alert-success alert-dismissible" style="border-color:green" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
			<strong>Success!</strong> Edited Successfully!
		</div>
	<?php }
	else { ?>
		<div class=" container alert alert-warning alert-dismissible" role="alert" style="border-color:yellow">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
			<strong>Sorry!</strong> No row affected!
		</div>
	<?php }
	$_SESSION['lcsn'] = $_SESSION['prune_stats'] = $_SESSION['date'] = $_SESSION['leaf_chit'] = NULL;
	$_SESSION['div_name'] = NULL;

 }

 if(isset($_POST['del_entry'])) {
	$lab_cat = $_SESSION['lcsn'];
	$rec_dt = $_SESSION['date'];

	$q_del = "DELETE FROM leaf_chit_table WHERE lab_cat ='{$lab_cat}' and rec_dt='{$rec_dt}' and division='{$_SESSION['div_name']}'";
	//var_dump($q_del);

	$r_del = mysqli_query($connection, $q_del);
	confirm_query($r_del);

	if(mysqli_affected_rows($connection) > 0) { ?>
		<div class=" container alert alert-success alert-dismissible" style="border-color:green" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
			<strong>Success!</strong> Deleted Successfully!
		</div>
	<?php }
	else { ?>
		<div class=" container alert alert-warning alert-dismissible" role="alert" style="border-color:yellow">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
			<strong>Sorry!</strong> No row affected!
		</div>
<?php }

	$_SESSION['lcsn'] = $_SESSION['prune_stats'] = $_SESSION['date'] = $_SESSION['leaf_chit'] = NULL;
	$_SESSION['div_name'] = NULL;
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>R.D. Tea | Leaf Chit Entry</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
				<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css">
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
        <?php $page_id = 14;?>
    </head>
    <body>
         <?php
            include("nav_bar.php");
            nav_echoer($page_id);
        ?>

    <div class="container">
            <div class="jumbotron">
                <h1>Leaf Chit Entry</h1>
                <form action="" method="post" class="form form-horizontal" style="margin-top: 30px;">
									<div class="col-sm-12 form-group">
										<label for="group" class="col-sm-2">Select a group:</label>
										<div class="col-sm-3">
											<select id="group" name ="lab_cat" class="form-control" onchange="enable_add()" required>
												<?php
													$lab_cat_q = "SELECT * FROM labour_categories";
													$lab_cat_r = mysqli_query($connection, $lab_cat_q);
													confirm_query($lab_cat_r);

													echo "<option id=\"opt0\" value=\"Select a group...\">Select a group...</option>";

													while($lab_cats = mysqli_fetch_assoc($lab_cat_r))
													{
												?>
													<option value="<?php echo htmlentities($lab_cats['lcsn']) ?>" <?php if(isset($_POST["dt_cat_submit"]) && ($_SESSION['lcsn'] == $lab_cats['lcsn'])) { echo "selected";} ?> ><?php echo htmlentities($lab_cats['lcsn']); ?></option>
												<?php
													}
												?>
											</select>
										</div>
										<label for="prune" class="col-sm-3">Select Prune Status:</label>
										<div class="col-sm-3">
											<select id="prune" name ="prune_stats" class="form-control" onchange="enable_add()" required>
												<option>Select Prune Type</option>
												<option <?php if(isset($_POST["dt_cat_submit"]) && ($_SESSION['prune_stats'] == 'UNPRUNED')) { echo "selected";} ?> >UNPRUNED</option>
												<option <?php if(isset($_POST["dt_cat_submit"]) && ($_SESSION['prune_stats'] == 'PRUNED')) { echo "selected";} ?> >PRUNED</option>
											</select>
										</div>
									</div>
									<div class="col-sm-12">
											<label for="datepicker" class="col-sm-2">Select Date:</label>
											<div class="input-group">
												<span class="input-group-addon">
														<i class="glyphicon glyphicon-calendar"></i>
												</span>
												<input type="text" name="date_value" class="form-control" id="datepicker" <?php if($req_date !=NULL) { ?>value="<?php echo date('d-m-Y', strtotime($req_date));?>" <?php } else { ?>placeholder="Date (dd-mm-yyyy)"<?php } ?> onChange="enable_add()" required>
											</div>
									</div>
									<label for="datepicker" class="col-sm-2"></label>
									<input type="submit" style="margin-left:10px" id="selct_sec" name="dt_cat_submit" value="Submit" class="btn btn-default" onclick="enable_tab()">
                </form>
            </div>
			<div class="tab-container">
	            <ul class="nav nav-tabs nav-justified">
	                <li id="actv_one"><a href="#tab1" data-toggle="tab" id="link_one">Edit Entry</a></li>
	                <li id="actv_two"><a href="#tab2" data-toggle="tab" id="link_two">Add Entry</a></li>
	            </ul>
				<div class="tab-content" style="background-color:#FFFFFF">

					<div class="tab-pane" id="tab1">
						<form class="form-horizontal" action="leaf_chit_entry.php" method="post">
							<?php if(isset($_SESSION['leaf_chit'])) { $daily = $_SESSION['leaf_chit']; } else { $daily = NULL; }?>
							<div class="form-group">
								<label for="short_sec_name" class="col-sm-3 control-label">Short Section Name:</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" id="short_sec_name1" name="short_sec_name" <?php if (isset($daily)) { $csv = comma_sep_val($daily['short_sec_name']); $set2 = 1;?> value="<?php echo $csv; ?>" <?php } else { ?>placeholder=<?php $set2 = 2; echo "\"Select section name.\""; ?><?php } //comma separeted value?>  >

								</div>
								<p class="text-danger"> * Use commas or tabs</p>
							</div>
							<div class="form-group">

								<label for="dt_lst_plkd" class="col-sm-3 control-label">Dates Last Plucked:</label>

								<div class="col-sm-4">
									<input type="text" class="form-control" id="dt_lst_plkd1" name="dt_lst_plkd" <?php if (isset($daily)) { $csv = comma_sep_val($daily['dt_lst_plkd']); ?> value="<?php echo $csv; ?>" <?php } else { ?>placeholder=<?php echo "\"Date (dd-mm-yyyy)\""; ?><?php } //comma separeted value ?> >
								</div>
								<p class="text-danger"> * Use commas or tabs</p>
							</div>
							<div class="form-group">
								<label for="plkd_area" class="col-sm-3 control-label">Area Plucked:</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" id="plkd_area1" name="plkd_area" <?php if(isset($daily)) {?>value="<?php echo $daily['plkd_area']; ?>" <?php } else {?>placeholder=<?php  echo "\"Area Plucked\""?> <?php } ?> >
								</div>
							</div>
							<div class="form-group">
								<label for="grpleaf1" class="col-sm-3 control-label">Leaf Plucked:</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" id="leaf1" name="plkd_leaf" <?php if(isset($daily)) {?>value="<?php echo $daily['plkd_leaf']; ?>" <?php } else {?>placeholder=<?php  echo "\"Leaf Plucked\""?> <?php } ?>  >
								</div>
							</div>
							<div class="form-group">
								<label for="mandays" class="col-sm-3 control-label">Mandays:</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" id="mandays1" name="mandays" <?php if(isset($daily)) {?>value="<?php echo $daily['mandays']; ?>" <?php } else {?>placeholder=<?php  echo "\"Mandays\""?> <?php } ?>  >
								</div>
							</div>
							<div class="form-group">
								<label for="task" class="col-sm-3 control-label">Task:</label>
								<div class="col-sm-4">

									<input type="text" class="form-control" id="task1" name="task" <?php if(isset($daily)) { $csv = comma_sep_val($daily['task']); ?>value="<?php echo $csv; ?>" <?php } else {?>placeholder=<?php  echo "\"Task\""?> <?php } ?>  >
								</div>
								<p class="text-danger"> * Use commas or tabs</p>
							</div>
							<div class="form-group">
							  <label for="ballo_count" class="col-sm-3 control-label">Ballometer Count:</label>
							  <div class="col-sm-4 input">
							    <input type="text" class="form-control" id="ballo_count1" name="ballo_count" <?php if(isset($daily)) {?>value="<?php echo $daily['ballo_count']; ?>" <?php } else {?>placeholder=<?php  echo "\"Ballometer Count in %\""?> <?php } ?>  >
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
						<form class="form-horizontal" action="" method="post">
							<div class="form-group">
								<label for="short_sec_name" class="col-sm-3 control-label">Short Section Name:</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" id="short_sec_name2" name="short_sec_name">
								</div>
								<p class="text-danger"> * Use commas or tabs</p>
							</div>
							<div class="form-group">

								<label for="dt_lst_plkd" class="col-sm-3 control-label">Date Last Plucked:</label>

								<div class="col-sm-4">
									<input type="text" class="form-control" id="dt_lst_plkd2" name="dt_lst_plkd" required>
								</div>
								<p class="text-danger"> * Use commas or tabs</p>
							</div>
							<div class="form-group">
								<label for="plkd_area" class="col-sm-3 control-label">Area Plucked:</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" id="plkd_area2" name="plkd_area" required>
								</div>
							</div>
							<div class="form-group">
								<label for="leaf" class="col-sm-3 control-label">Leaf Plucked:</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" id="leaf2" name="plkd_leaf" required>
								</div>
							</div>
							<div class="form-group">
								<label for="mandays" class="col-sm-3 control-label">Mandays:</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" id="mandays2" name="mandays" required>
								</div>
							</div>
							<div class="form-group">
								<label for="task" class="col-sm-3 control-label">Task:</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" id="task2" name="task" required>
								</div>
								<p class="text-danger"> * Use commas or tabs</p>
							</div>
							<div class="form-group">
							  <label for="ballo_count" class="col-sm-3 control-label">Ballometer Count:</label>
							  <div class="col-sm-4">
							    <input type="text" class="form-control" id="ballo_count2" name="ballo_count" required>
							  </div>
							</div>


          		<input type="submit" id="add_entry" name="add_submit" value="Add Entry" class="btn btn-success"style="margin-top:20px">
		    		</form>
					</div>
				</div>
			</div>
    </div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment-with-locales.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
		<script src="scripts/bootstrap-tokenfield.min.js"></script>
		<script src="scripts/bootstrap-datetimepicker.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
		<script src="scripts/jquery-ui.multidatespicker.js">

		</script>
		<script type="text/javascript">

				$(function() {
					$('#task1,#task2').tokenfield({});
					$( "#datepicker,#datepicker_edit, #datepicker_add" ).datepicker({dateFormat: 'dd-mm-yy'});
					$('#cp_hr_from1, #cp_hr_from2, #cp_hr_to1, #cp_hr_to2 ').datetimepicker({
						locale:'en',
						format:'LT'
					});
					$('#dt_lst_plkd1, #dt_lst_plkd2').tokenfield();
					// $('#dt_lst_plkd1, #dt_lst_plkd2').multiDatesPicker({
					// 	separator: ', ',
					// 	dateFormat: 'dd-mm-yy'
					// });
					$('#short_sec_name1,#short_sec_name2').tokenfield({
					  autocomplete: {
					    source: [ <?php
													if(isset($_POST['dt_cat_submit'])){
														if($_SESSION['prune_stats'] == "UNPRUNED") {
															$q_pstat= "select short_sec_name from sections where prune_style in (select prune_style from prune_style_stats where prune_stat = 'UNPRUNED')";

															$r_pstat = mysqli_query($connection, $q_pstat);
															confirm_query($r_pstat);

															$prefix = '';
															while($pstat = mysqli_fetch_assoc($r_pstat)) {
																echo $prefix ."'{$pstat['short_sec_name']}'";
																$prefix = ',';
															}

														}
														else if($_SESSION['prune_stats'] == "PRUNED") {
															$q_pstat= "select short_sec_name from sections where prune_style in (select prune_style from prune_style_stats where prune_stat = 'PRUNED')";

															$r_pstat = mysqli_query($connection, $q_pstat);
															confirm_query($r_pstat);

															$prefix = '';
															while($pstat = mysqli_fetch_assoc($r_pstat)) {
																echo $prefix ."'{$pstat['short_sec_name']}'";
																$prefix = ',';
															}
														}

														// 	echo "'P Men I','P Men II','P Women I','P Women II','P Women III','P Women IV','T Women I','T Women II','T Women III','T Women IV','T Men I','T Men II','Incentive I','Incentive II','Gariwala'";
													}
												?> ],
					    delay: 100
					  },
					  showAutocompleteOnFocus: true
					});
				});

		</script>
		<script>
			document.getElementById('selct_sec').disabled=true;
			document.getElementById('link_one').disabled=true;
			document.getElementById('link_two').disabled=true;
			if((document.getElementById('group').value!='Select a group...')&& (document.getElementById('prune').value!='Select Prune Type'))
			{
				document.getElementById('selct_sec').disabled=false;
			}
			function enable_add(){
					if((document.getElementById('group').value!='Select a group...')&& (document.getElementById('prune').value!='Select Prune Type'))
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
	end_connection($connection);
?>
