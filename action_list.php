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
    <title>R.D. Tea |Last Action Performed</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
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
			.col-head{
				color:#520808;
			}
			.nav-tabs.nav-justified > .active > a, .nav-tabs.nav-justified > .active > a:hover, .nav-tabs.nav-justified > .active > a:active, .nav-tabs.nav-justified > .active > a:enabled {
					background-color: #327640 !important;
					border-bottom-color: #ffffff;
					color: #FFFFFF;
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
        <form class="form-inline" action="leaf_chit.php" method="post">
          <div class="form-group">
            <select class="form-control" id="sectionPicker">
							<option selected>Choose a section...</option>
							<option>1EXTA</option>
							<option>1EXTB</option>
							<option>EXT3</option>
							<option>4W</option>
						</select>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="datepicker" placeholder="dd-mm-yy">
          </div>
          <input type="submit" class="btn btn-warning" name="btn_submit" value="Get Data">
        </form>
      </div>
			<div class="main-content">
					<div class="tab-container">
						<ul class="nav nav-tabs nav-justified">
								<li class="active"><a href="#tab1" data-toggle="tab">Plucking History</a></li>
								<li><a href="#tab2" data-toggle="tab">Spraying History</a></li>
								<li><a href="#tab3" data-toggle="tab">Weather History</a></li>
						</ul>
						<div class="tab-content"  style="background-color:#EFEFEF">
								<div class="tab-pane active" id="tab1">
									<table id="plucking" class="table display" border="1">
										<tr>
											<thead>
												<th>RainFall<br/>Day<br/>(in m.m.)</th>
												<th>RainFall<br/>Night<br/>(in m.m.)</th>
												<th>Temp.<br/>Max.<br/>(in &degC)</th>
												<th>Temp.<br/>Min.<br/>(in &degC)</th>
												<th>Sunshine<br/>Hour</th>
												<th>Weather<br/>Condition</th>
												<th>Changed<br/>On</th>
												<th>Updated<br/>By</th>
												<th>Action</th>
											</thead>
										</tr>
										<tbody>
											<tr>
												<td>1</td>
												<td>2</td>
												<td>3</td>
												<td>4</td>
												<td>5</td>
												<td>7</td>
												<td>8</td>
												<td>9</td>
												<td>0</td>
											</tr>
										</tbody>

									</table>

								</div>
								<div class="tab-pane" id="tab2">
									<table id="spraying" class="table display" border="1">
										<tr>
											<thead>
												<th>RainFall<br/>Day<br/>(in m.m.)</th>
												<th>RainFall<br/>Night<br/>(in m.m.)</th>
												<th>Temp.<br/>Max.<br/>(in &degC)</th>
												<th>Temp.<br/>Min.<br/>(in &degC)</th>
												<th>Sunshine<br/>Hour</th>
												<th>Weather<br/>Condition</th>
												<th>Changed<br/>On</th>
												<th>Updated<br/>By</th>
												<th>Action</th>
											</thead>
										</tr>
										<tbody>
											<tr>
												<td>1</td>
												<td>2</td>
												<td>3</td>
												<td>4</td>
												<td>5</td>
												<td>7</td>
												<td>8</td>
												<td>9</td>
												<td>10</td>
											</tr>
										</tbody>

									</table>



								</div>
								<div class="tab-pane" id="tab3">
									<table id="weather" class="table display" border="1">
										<tr>
											<thead>
												<th>RainFall<br/>Day<br/>(in m.m.)</th>
												<th>RainFall<br/>Night<br/>(in m.m.)</th>
												<th>Temp.<br/>Max.<br/>(in &degC)</th>
												<th>Temp.<br/>Min.<br/>(in &degC)</th>
												<th>Sunshine<br/>Hour</th>
												<th>Weather<br/>Condition</th>
												<th>Changed<br/>On</th>
												<th>Updated<br/>By</th>
												<th>Action</th>
											</thead>
										</tr>
										<tbody>
											<tr>
												<td>1</td>
												<td>2</td>
												<td>3</td>
												<td>4</td>
												<td>5</td>
												<td>7</td>
												<td>8</td>
												<td>9</td>
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
		<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
		<script src="http://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js">
		</script>
		<script src="https://cdn.datatables.net/responsive/1.0.6/js/dataTables.responsive.js"></script>

		<script>
		$(document).ready(function() {
						$('#plucking').dataTable({"scrollX": true});
						$('#spraying').dataTable({"scrollX": true});
						$('#weather').dataTable({"scrollX": true});
			});
		</script>
  </body>
</html>
