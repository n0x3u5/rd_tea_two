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
        <form class="form-horizontal" action="leaf_chit.php" method="post">
					<div class="head_select">
					<div class="form-group">
						<p style="color:#B3E5FC">Start date</p>
						<div class="input-group">
							<input type="text" name="start_date_value" class="form-control" id="datepicker1" placeholder="Date (dd-mm-yyyy)" required>
							<span class="input-group-addon">
									<i class="glyphicon glyphicon-calendar"></i>
							</span>
						</div>
					</div>
					<p></p>
					<p></p>
					<div class="form-group">
						<p style="color:#B3E5FC">End date</p>
						<div class="input-group">
							<input type="text" name="end_date_value" class="form-control" id="datepicker2"placeholder="Date (dd-mm-yyyy)" required>
							<span class="input-group-addon">
									<i class="glyphicon glyphicon-calendar"></i>
							</span>
						</div>
					</div>
					<button type="submit" name="div_date_submit" class="btn btn-default">Get Data</button>
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
											<tr>
												<td>27-06-2015</td>
												<td>1EXTA </td>
												<td>5</td>
												<td>112</td>
												<td>22</td>
												<td>2330</td>
												<td>21</td>
												<td>7</td>
												<td>10</td>
											</tr>
											<tr>
												<td>28-06-2015</td>
												<td>1EXTA </td>
												<td>5</td>
												<td>112</td>
												<td>22</td>
												<td>2330</td>
												<td>21</td>
												<td>7</td>
												<td>10</td>
											</tr>
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
