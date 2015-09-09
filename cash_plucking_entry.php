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
	if(isset($_POST['dt_submit'])) {
		$req_date = date('Y-m-d', strtotime($_POST['date_value']));
		$_SESSION['date'] = $req_date;

		$query = "SELECT * FROM cp_table WHERE rec_date='{$req_date}' and division='{$_SESSION['current_div']}'";

		$result = mysqli_query($connection, $query);
    confirm_query($result);

		$_SESSION['cp_record'] = mysqli_fetch_assoc($result);
	  // var_dump($_SESSION['cp_record']);
		$set = 1;
	}
	else {
		$req_date = NULL;
		$result = NULL;
		$set =0;
	}

	if(isset($_POST['add_submit'])) {

		$rec_dt = $_SESSION['date'];

		$cpp_qty = (int) mysqli_real_escape_string($connection, $_POST['cpp_qty2']);
		$cpp_bal = (int) mysqli_real_escape_string($connection, $_POST['cpp_bal2']);
		$cpu_qty = (float) mysqli_real_escape_string($connection, $_POST['cpu_qty2']);
		$cpu_bal = (float) mysqli_real_escape_string($connection, $_POST['cpu_bal2']);
		$cp_hr_from = mysqli_real_escape_string($connection, $_POST['start_time2']);
		$cp_hr_to = mysqli_real_escape_string($connection, $_POST['end_time2']);

		$q_in = "INSERT INTO cp_table (division, rec_date, prune_cp_qty, unprune_cp_qty, prune_bm, unprune_bm, time_from, time_to) VALUES ('{$_SESSION['current_div']}', '{$rec_dt}', {$cpp_qty}, {$cpu_qty}, {$cpp_bal}, {$cpu_bal}, '{$cp_hr_from}', '{$cp_hr_to}') ";

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

		$q = "select * from cp_change where id = (select max(id) from cp_change)";
		$r = mysqli_query($connection, $q);
		confirm_query($r);
		$cp_chng = mysqli_fetch_assoc($r);
		//var_dump($cp_chng);
		//echo "<br>user_name".$_SESSION['user'];
		$q = "UPDATE cp_change SET changed_by = '{$_SESSION['user']}' WHERE id = ({$cp_chng['id']})";
		$r = mysqli_query($connection, $q);
		confirm_query($r);

		$_SESSION['date'] = $_SESSION['cp_record'] = NULL;

 }


 if(isset($_POST['edit_submit'])) {
	$rec_dt = $_SESSION['date'];
	$rec_id = $_SESSION['cp_record']['id'];

	$cpp_qty = (int) mysqli_real_escape_string($connection, $_POST['cpp_qty1']);
	$cpp_bal = (int) mysqli_real_escape_string($connection, $_POST['cpp_bal1']);
	$cpu_qty = (float) mysqli_real_escape_string($connection, $_POST['cpu_qty1']);
	$cpu_bal = (float) mysqli_real_escape_string($connection, $_POST['cpu_bal1']);
	$cp_hr_from = mysqli_real_escape_string($connection, $_POST['start_time1']);
	$cp_hr_to = mysqli_real_escape_string($connection, $_POST['end_time1']);

	$q_in = "UPDATE cp_table SET division = '{$_SESSION['current_div']}', prune_cp_qty = {$cpp_qty}, unprune_cp_qty = {$cpu_qty}, prune_bm = {$cpp_bal}, unprune_bm = {$cpu_bal}, time_from = '{$cp_hr_from}', time_to = '{$cp_hr_to}' WHERE id = {$rec_id}";

	$r_in = mysqli_query($connection, $q_in);
	confirm_query($r_in);

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

		$q = "select * from cp_change where id = (select max(id) from cp_change)";
		$r = mysqli_query($connection, $q);
		confirm_query($r);
		$cp_chng = mysqli_fetch_assoc($r);
		//var_dump($cp_chng);
		//echo "<br>user_name".$_SESSION['user'];
		$q = "UPDATE cp_change SET changed_by = '{$_SESSION['user']}' WHERE id = ({$cp_chng['id']})";
		$r = mysqli_query($connection, $q);
		confirm_query($r);

	$_SESSION['date'] = $_SESSION['cp_record'] = NULL;
 }

 if(isset($_POST['del_entry'])) {
	$rec_dt = $_SESSION['date'];

	$q_del = "DELETE FROM cp_table WHERE rec_date='{$rec_dt}' and division = '{$_SESSION['current_div']}'";

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

		$q = "select * from cp_change where id = (select max(id) from cp_change)";
		$r = mysqli_query($connection, $q);
		confirm_query($r);
		$cp_chng = mysqli_fetch_assoc($r);
		//var_dump($cp_chng);
		//echo "<br>user_name".$_SESSION['user'];
		$q = "UPDATE cp_change SET changed_by = '{$_SESSION['user']}' WHERE id = ({$cp_chng['id']})";
		$r = mysqli_query($connection, $q);
		confirm_query($r);

	$_SESSION['date'] = $_SESSION['cp_record'] = NULL;

}

?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>R.D. Tea | Cash Plucking Entry</title>
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
        <?php $page_id = 15;?>
    </head>
    <body>
         <?php
            include("nav_bar.php");
            nav_echoer($page_id);
        ?>
    <div class="container">
            <div class="jumbotron">
              <h1>Cash Plucking Entry</h1>
              <form action="" method="post" class="form form-horizontal" style="margin-top: 30px;">
								<div class="col-sm-12">
									<label for="datepicker" class="col-sm-2">Select Date:</label>
										<div class="input-group">
											<span class="input-group-addon">
													<i class="glyphicon glyphicon-calendar"></i>
											</span>
											<input type="text" name="date_value" class="form-control" id="datepicker"  onChange="enable_add()" <?php if(isset($_POST['dt_submit'])) { ?> value="<?php echo $_POST['date_value']; ?>"<?php } else { ?>placeholder="Date (dd-mm-yyyy)" <?php } ?> required>
										</div>
								</div>
									<label for="selct_sec" class="col-sm-2"></label>
									<input type="submit" style="margin-left:10px" id="selct_sec" name="dt_submit" value="Submit" class="btn btn-default" onclick="enable_tab()">
              </form>
            </div>
			<div class="tab-container">
	            <ul class="nav nav-tabs nav-justified">
	                <li id="actv_one"><a href="#tab1" data-toggle="tab" id="link_one">Edit Entry</a></li>
	                <li id="actv_two"><a href="#tab2" data-toggle="tab" id="link_two">Add Entry</a></li>
	            </ul>
				<div class="tab-content" style="background-color:#FFFFFF">

					<div class="tab-pane" id="tab1">
						<form class="form-horizontal" action="cash_plucking_entry.php" method="post">
							<?php if(isset($_SESSION['cp_record'])) { $rec = $_SESSION['cp_record']; } else { $rec = NULL; }?>
							<div class="form-group">
								<label for="cp_qty_prn1" class="col-sm-3 control-label">Cash Plucking Quantity(Pruned):</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" name="cpp_qty1" id="cp_qty_prn1" name="cp_qty_prn" <?php if(isset($rec)) {?>value="<?php echo $rec['prune_cp_qty']; ?>" <?php } else {?>placeholder=<?php  echo "\"Cash Plucking Quantity\""?> <?php } ?>>
								</div>
							</div>

							<div class="form-group">
								<label for="ballo_count_prn1" class="col-sm-3 control-label">Ballometer Count(Pruned):</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" name="cpp_bal1" id="ballo_count_prn1" name="ballo_count_prn" <?php if(isset($rec)) {?>value="<?php echo $rec['prune_bm']; ?>" <?php } else {?>placeholder=<?php  echo "\"Ballometer Count\""?> <?php } ?>>
								</div>
							</div>
							<div class="form-group">
								<label for="cp_qty_unprune1" class="col-sm-3 control-label">Cash Plucking Quantity (Unpruned):</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" name="cpu_qty1" id="cp_qty_unprune1" name="cp_qty_unprn" <?php if(isset($rec)) {?>value="<?php echo $rec['unprune_cp_qty']; ?>" <?php } else {?>placeholder=<?php  echo "\"Cash Plucking Quantity\""?> <?php } ?>>
								</div>
							</div>

							<div class="form-group">
								<label for="ballo_count_unprune1" class="col-sm-3 control-label">Ballometer Count(Unpruned):</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" name="cpu_bal1" id="ballo_count_unprune1" name="ballo_count_unprune" <?php if(isset($rec)) {?>value="<?php echo $rec['unprune_bm']; ?>" <?php } else {?>placeholder=<?php  echo "\"Ballometer Count\""?> <?php } ?>>
								</div>
							</div>
							<!-- <?php // var_dump($rec['time_from']); ?> -->
							<div class="form-group">
								<label for="cp_hr_from" class="col-sm-3 control-label timepicker">Start Time (CashPlucking):</label>
								<div class="col-sm-2">
									<input type="text" class="form-control" name="start_time1" id="cp_hr_from1" name="cp_hr_from1" <?php if(isset($rec)) {?>value="<?php $set2 = 1; echo $rec['time_from']; ?>" <?php } else {?>placeholder=<?php $set2 = 2; echo "\"hh:mm P\""?> <?php } ?> required>
								</div>
							</div>
							<!-- <?php // var_dump($rec['time_to']); ?> -->
							<div class="form-group">
								<label for="cp_hr_to" class="col-sm-3 control-label">End Time (CashPlucking):</label>
								<div class="col-sm-2">
									<input type="text" class="form-control" name="end_time1" id="cp_hr_to1" name="cp_hr_to1" <?php if(isset($rec)) {?>value="<?php echo $rec['time_to']; ?>" <?php } else {?>placeholder=<?php  echo "\"hh:mm P\""?> <?php } ?> required>
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
						<form class="form-horizontal" action="cash_plucking_entry.php" method="post">
							<div class="form-group">
								<label for="cp_qty_prn2" class="col-sm-3 control-label">Cash Plucking Quantity (Pruned):</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" name="cpp_qty2" id="cp_qty_prn2" placeholder="Cash Plucking Quantity">
								</div>
							</div>

							<div class="form-group">
								<label for="ballo_count_prn2" class="col-sm-3 control-label">Ballometer Count(Pruned):</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" name="cpp_bal2" id="ballo_count_prn2" placeholder="Ballometer Count">
								</div>
							</div>
							<div class="form-group">
								<label for="cp_qty_unprune2" class="col-sm-3 control-label">Cash Plucking Quantity (Unpruned):</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" name="cpu_qty2" id="cp_qty_unprune2" placeholder="Cash Plucking Quantity">
								</div>
							</div>

							<div class="form-group">
								<label for="ballo_count_unprune2" class="col-sm-3 control-label">Ballometer Count(Unpruned):</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" name="cpu_bal2" id="ballo_count_unprune2" placeholder="Ballometer Count">
								</div>
							</div>
							<div class="form-group">
								<label for="cp_hr_from" class="col-sm-3 control-label">Start Time (CashPlucking):</label>
								<div class="col-sm-2">
									<input type="text" class="form-control" name="start_time2" id="cp_hr_from2" placeholder="hh:mm P" required>
								</div>
							</div>
							<div class="form-group">
								<label for="cp_hr_to" class="col-sm-3 control-label">End Time (CashPlucking):</label>
								<div class="col-sm-2">
									<input type="text" class="form-control" name="end_time2" id="cp_hr_to2" placeholder="hh:mm P" required>
								</div>
							</div>

          		<input type="submit" id="add_entry" name="add_submit" value="Add Entry" class="btn btn-success"style="margin-top:20px">
		    		</form>
					</div>
				</div>
			</div>
    </div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="scripts/moment-with-locales.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
		<script src="scripts/bootstrap-datetimepicker.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
		<script type="text/javascript">

				$(function() {
					$( "#datepicker,#datepicker_edit, #datepicker_add" ).datepicker({dateFormat: 'dd-mm-yy'});
					$('#cp_hr_from1, #cp_hr_from2, #cp_hr_to1, #cp_hr_to2 ').datetimepicker({
						locale:'en',
						format:'LT'
					});
					$('#dt_lst_plkd1,#dt_lst_plkd2,#task1,#task2').tokenfield({});
					$('#short_sec_name1,#short_sec_name2').tokenfield({
					  autocomplete: {
					    source: [ <?php
													if(isset($_POST['dt_cat_submit'])){
														$current_division = $_SESSION['current_div'];
														if($_SESSION['prune_stats'] == "UNPRUNED") {
															$q_pstat= "select short_sec_name from sections where division = '$current_division' and prune_style in (select prune_style from prune_style_stats where prune_stat = 'UNPRUNED')";

															$r_pstat = mysqli_query($connection, $q_pstat);
															confirm_query($r_pstat);

															$prefix = '';
															while($pstat = mysqli_fetch_assoc($r_pstat)) {
																echo $prefix ."'{$pstat['short_sec_name']}'";
																$prefix = ',';
															}

														}
														else if($_SESSION['prune_stats'] == "PRUNED") {
															$q_pstat= "select short_sec_name from sections where division = '$current_division' and prune_style in (select prune_style from prune_style_stats where prune_stat = 'PRUNED')";

															$r_pstat = mysqli_query($connection, $q_pstat);
															confirm_query($r_pstat);

															$prefix = '';
															while($pstat = mysqli_fetch_assoc($r_pstat)) {
																echo $prefix ."'{$pstat['short_sec_name']}'";
																$prefix = ',';
															}
														}
													}
												?> ],
					    delay: 100
					  },
					  showAutocompleteOnFocus: true
					});
				});

		</script>
		<script>

			document.getElementById('link_one').disabled=true;
			document.getElementById('link_two').disabled=true;

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
