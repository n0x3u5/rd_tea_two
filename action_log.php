	<?php
	require_once('includes/sessions.php');
	require_once('includes/functions.php');

	if(!isset($_SESSION['user'])) {
		redirect_to("index.php");
	}
?>

<?php
	$connection = make_connection();

	//var_dump($_POST); echo "<br>";
	if(isset($_POST['date_rng_submit'])) {
		$req_start_date = $_POST['start_date_value'];
		$req_end_date = $_POST['end_date_value'];
		//$req_ssn = $_POST['short_sec_name'];

		$from = date('Y-m-d', strtotime($req_start_date));
	  $to = date('Y-m-d', strtotime($req_end_date));
	  //var_dump($from); var_dump($to);
		$q_weather = "select * from weather_change where record_date between '$from' and '$to'";
	  //var_dump($q_weather);

	  $r_weather = mysqli_query($connection, $q_weather);
	  confirm_query($r_weather);
		//var_dump($r_weather);


		//$wth_rvw = mysqli_fetch_assoc($r_weather);
		//var_dump($wth_rvw);
		//
		// $query_pluck = "select * from blue_bk_plk where short_sec_name ='$req_ssn' and rec_dt between '$from' and '$to'";
		//
		// $result_pluck = mysqli_query($connection, $query_pluck);
		// confirm_query($result_pluck);

		// echo "<br> header processing ends. <hr>";

	}
	else {
		//$req_div_name = NULL;
		//$req_year = NULL;
		$req_start_date = NULL;		$from = NULL;
		$req_end_date = NULL;			$to = NULL;
		$r_weather = NULL;

	}
?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>R.D. Tea | Action Logs</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

		<link rel="stylesheet" href="https://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.css">
    <link rel="stylesheet" href="css/stylesheet.css">
    <link rel="icon" href="images/logo_rdtea.png"/>
    <?php $page_id = 12;?>
    <style>
			.jumbotron {
				background:#474A13;
			}
			.jumbotron h1,h3 {
				color:#EDD2D2;
			}
      .jumbotron form input[type="submit"] {
				background: #FFC107;
				color: #000000;
			}
			.container{
				width:88%;
			}
			th{
				text-align: center;
			}
			.head_select{
				width:90%;	margin: auto;
			}
			table{
				width:100%;
			}
    </style>
  </head>
  <body>
    <?php
      include("nav_bar.php");
      nav_echoer($page_id);
    ?>
    <div class="container">
      <div class="jumbotron">
        <h1>Action Logs</h1>
  			<h3>Hansqua Division</h3>
        <form class="form-horizontal" action="action_log.php" method="post">
					<div class="head_select">
						<div class="form-group">
							<p style="color:#B3E5FC">Start date</p>
							<div class="input-group">
								<span class="input-group-addon">
										<i class="glyphicon glyphicon-calendar"></i>
								</span>
								<input type="text" name="start_date_value" class="form-control" id="datepicker1" <?php if($req_start_date !=NULL) { ?>value="<?php echo date('d-m-Y', strtotime($req_start_date));?>" <?php } else { ?>placeholder="Date (dd-mm-yyyy)"<?php } ?> onChange="enable_add()" required>

							</div>
						</div>
						<p></p>
						<p></p>
						<div class="form-group">
							<p style="color:#B3E5FC">End date</p>
							<div class="input-group">
								<span class="input-group-addon">
										<i class="glyphicon glyphicon-calendar"></i>
								</span>
								<input type="text" name="end_date_value" class="form-control" id="datepicker2" <?php if($req_end_date !=NULL) { ?>value="<?php echo date('d-m-Y', strtotime($req_end_date));?>" <?php } else { ?>placeholder="Date (dd-mm-yyyy)"<?php } ?> onChange="enable_add()" required>

							</div>
						</div>
					<button type="submit" name="date_rng_submit" value="Date Range" class="btn btn-default">Get Data</button>
				</div>
				</form>
      </div>

			<div class="main-content">
					<div class="tab-container">
						<ul class="nav nav-tabs nav-justified">
								<li class="active"><a href="#tab1" data-toggle="tab">Plucking History</a></li>
								<li><a href="#tab2" data-toggle="tab">Spraying History</a></li>
								<li><a href="#tab3" data-toggle="tab">Weather History</a></li>
						</ul>
						<div class="tab-content">
								<div class="tab-pane active" id="tab1">
									<table id="plucking" class="display table table-hover table-bordered" cellspacing="0" width="100%">
										<thead>
											<tr>
												<th>Section</th>
												<th>Labour Category</th>
												<th>Area Plucked</th>
												<th>Leaf Plucked</th>
												<th>Mandays :</th>

												<th>Changed On</th>
												<th>Changed By</th>
												<th>Action</th>

											</tr>

										</thead>
										<tbody>
											<tr>
												<td>1 EXA</td>
												<td>P women</td>
												<td>5 </td>
												<td>123</td>
												<td>14</td>


												<td>18-07-2015</td>
												<td>G Mondal</td>
												<td>Added</td>
											</tr>
											<tr>
												<td>3EXT</td>
												<td>P women</td>
												<td>5 </td>
												<td>123</td>
												<td>14</td>
												<td>18-07-2015</td>
												<td>G Mondal</td>
												<td>Added</td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="tab-pane" id="tab2">
									<table id="spraying" class="display table table-hover table-bordered" cellspacing="0" width="100%">
										<thead>
											<tr>
												<th>Labour Category</th>
												<th>Area Plucked</th>
												<th>Leaf Plucked</th>
												<th>Mandays for<br/> each group</th>
												<th>Cash Plucked leaf</th>
												<th>Task</th>
												<th>Changed On</th>
												<th>Changed By</th>
												<th>Action</th>

											</tr>

										</thead>
										<tbody>
											<tr>
												<td>P women</td>
												<td>5 </td>
												<td>123</td>
												<td>14</td>
												<td>22</td>
												<td>18</td>
												<td>18-07-2015</td>
												<td>G Mondal</td>
												<td>Added</td>
											</tr>
											<tr>
												<td>P women</td>
												<td>5 </td>
												<td>123</td>
												<td>14</td>
												<td>22</td>
												<td>18</td>
												<td>18-07-2015</td>
												<td>G Mondal</td>
												<td>Added</td>
											</tr>
										</tbody>
									</table>

								</div>





								<div class="tab-pane" id="tab3">
									<table id="weather" class="display table table-hover table-bordered" cellspacing="0" width="100%">
										<thead>
											<tr>
												<th rowspan="2">Record date</th>
												<th rowspan="2">Division</th>
												<th colspan="2">Rainfall (mm)</th>
												<th colspan="2">Temperature (&degC)</th>
												<th rowspan="2">Sunshine Hours</th>
												<th rowspan="2">Weather Condition</th>
												<th rowspan="2">Changed On</th>
												<th rowspan="2">Changed By</th>
												<th rowspan="2">Action</th>
											</tr>
											<tr>
												<th>Day</th>
												<th>Night</th>
												<th>Maximum</th>
												<th>Minimum</th>
											</tr>
										</thead>
										<tbody>
											<?php
												//var_dump($_POST);
											 	if(isset($_POST['date_rng_submit'])) {
													//var_dump($wth_rvw = mysqli_fetch_assoc($r_weather));
													while($wth_rvw = mysqli_fetch_assoc($r_weather)) {
											?>
														<tr>
															<td><?php echo $wth_rvw['record_date']; ?></td>
															<td><?php echo $wth_rvw['division']; ?></td>
															<td><?php echo $wth_rvw['rain_day']; ?></td>
															<td><?php echo $wth_rvw['rain_night']; ?></td>
															<td><?php echo $wth_rvw['temp_max']; ?></td>
															<td><?php echo $wth_rvw['temp_min']; ?></td>
															<td><?php echo $wth_rvw['sun_shine_hr']; ?></td>
															<td><?php echo $wth_rvw['weather_cond']; ?></td>
															<td><?php echo $wth_rvw['changed_on']; ?></td>
															<td><?php echo $wth_rvw['changed_by']; ?></td>
															<td><?php echo $wth_rvw['action']; ?></td>
														</tr>
											<?php
													}
												}
											?>
										</tbody>
									</table>
								</div>
						</div>
					</div>
			</div>
    </div>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
		<script src="http://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js">
		</script>

		<script>
		$(document).ready(function() {
			$('#plucking').dataTable({"scrollX":true,
				"autoWidth": false
			});
			$('#spraying').dataTable({"scrollX":true,
				"autoWidth": false
			});
			$('#weather').dataTable({"scrollX":true,
				"autoWidth": false
			});
			$( "#datepicker1, #datepicker2" ).datepicker({dateFormat: 'dd-mm-yy'});
		});
		</script>
  </body>
</html>
<?php
	end_connection($connection);
?>
