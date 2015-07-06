<?php
	require_once('/includes/sessions.php');
	require_once('/includes/functions.php');

	if(!isset($_SESSION['user'])) {
		redirect_to("index.php");
	}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>R.D. Tea | leaf Chit Entry</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
				<link rel="stylesheet" href="css/bootstrap-tokenfield.css" type="text/css">
				<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
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
					.bootstrap-datetimepicker-widget-dropdown-menu.top {
						background: #FFFFFF;
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
												<option> Select a Group</option>
											</select>
										</div>
										<label for="prune" class="col-sm-3">Select Prune Status:</label>
										<div class="col-sm-3">
											<select id="prune" name ="prune_stats" class="form-control" onchange="enable_add()" required>
												<option>Unpruned</option>
												<option>Pruned</option>
											</select>
										</div>
									</div>
									<div class="col-sm-12">
											<label for="datepicker" class="col-sm-2">Select Date:</label>
											<div class="input-group">
												<span class="input-group-addon">
														<i class="glyphicon glyphicon-calendar"></i>
												</span>
	                        <input type="text" name="date_value" class="form-control" id="datepicker" onChange="enable_add()" required>

	                    </div>
									</div>
									<label for="datepicker" class="col-sm-2"></label>
									<input type="submit" style="margin-left:10px" id="selct_sec" name="dt_sec_submit" value="Submit" class="btn btn-default" onclick="enable_tab()">
                </form>
            </div>
			<div class="tab-container">
	            <ul class="nav nav-tabs nav-justified">
	                <li class="active" id="actv_one"><a href="#tab1" data-toggle="tab" id="link_one">Edit Entry</a></li>
	                <li id="actv_two"><a href="#tab2" data-toggle="tab" id="link_two">Add Entry</a></li>
	            </ul>
				<div class="tab-content" style="background-color:#FFFFFF">
					<div class="tab-pane active" id="tab1">
						<form class="form-horizontal" action="daily_plucking_entry.php" method="post">
							<div class="form-group">
								<label for="short_sec_name" class="col-sm-3 control-label">Short Section Name:</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" id="short_sec_name1" name="short_sec_name">
								</div>
							</div>
							<div class="form-group">
								<label for="plkd_area" class="col-sm-3 control-label">Area Plucked:</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" id="plkd_area1" name="plkd_area">
								</div>
							</div>
							<div class="form-group">
								<label for="grpleaf1" class="col-sm-3 control-label">Leaf Plucked:</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" id="leaf1" name="leaf">
								</div>
							</div>
							<div class="form-group">
								<label for="mandays" class="col-sm-3 control-label">Mandays:</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" id="mandays1" name="mandays">
								</div>
							</div>
							<div class="form-group">
								<label for="task" class="col-sm-3 control-label">Task:</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" id="task1" name="task">
								</div>
							</div>
							<div class="form-group">
								<label for="ballo_count" class="col-sm-3 control-label">Ballometer Count:</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" id="ballo_count1" name="ballo_count">
								</div>
							</div>
							<div class="form-group">
								<label for="cp_hr_from" class="col-sm-3 control-label timepicker">Start Time (CashPlucking):</label>
								<div class="col-sm-2">
									<input type="text" class="form-control" id="cp_hr_from1" name="cp_hr_from">
								</div>
							</div>
							<div class="form-group">
								<label for="cp_hr_to" class="col-sm-3 control-label">Start Time (CashPlucking):</label>
								<div class="col-sm-2">
									<input type="text" class="form-control" id="cp_hr_to1" name="cp_hr_to">
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
							</div>
							<div class="form-group">
								<label for="plkd_area" class="col-sm-3 control-label">Area Plucked:</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" id="plkd_area2" name="plkd_area">
								</div>
							</div>
							<div class="form-group">
								<label for="leaf" class="col-sm-3 control-label">Leaf Plucked:</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" id="leaf2" name="leaf">
								</div>
							</div>
							<div class="form-group">
								<label for="mandays" class="col-sm-3 control-label">Mandays:</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" id="mandays2" name="mandays">
								</div>
							</div>
							<div class="form-group">
								<label for="task" class="col-sm-3 control-label">Task:</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" id="task2" name="task">
								</div>
							</div>
							<div class="form-group">
								<label for="ballo_count" class="col-sm-3 control-label">Ballometer Count:</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" id="ballo_count2" name="ballo_count">
								</div>
							</div>
							<div class="form-group">
								<label for="cp_qty" class="col-sm-3 control-label">Cash Plucking Quantity:</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" id="cp_qty2" name="cp_qty">
								</div>
							</div>
							<div class="form-group">
								<label for="cp_hr_from" class="col-sm-3 control-label">Start Time (CashPlucking):</label>
								<div class="col-sm-2">
									<input type="text" class="form-control" id="cp_hr_from2" name="cp_hr_from">
								</div>
							</div>
							<div class="form-group">
								<label for="cp_hr_to" class="col-sm-3 control-label">Start Time (CashPlucking):</label>
								<div class="col-sm-2">
									<input type="text" class="form-control" id="cp_hr_to2" name="cp_hr_to">
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
		<script type="text/javascript">

				$(function() {
					$( "#datepicker, #datepicker_edit, #datepicker_add" ).datepicker({dateFormat: 'dd-mm-yy'});
					$('#cp_hr_from1, #cp_hr_from2, #cp_hr_to1, #cp_hr_to2 ').datetimepicker({
						locale:'en',
						format:'LT'
					});
					$('#short_sec_name1,#short_sec_name2').tokenfield({
					  autocomplete: {
					    source: ['P Men I','P Men II','P Women I','P Women II','P Women III','P Women IV','T Women I','T Women II','T Women III','T Women IV','T Men I','T Men II','Incentive I','Incentive II','Gariwala'],
					    delay: 100
					  },
					  showAutocompleteOnFocus: true
					});
				});

		</script>

	  </body>
</html>
