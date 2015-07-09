<?php
	require_once('includes/sessions.php');
	require_once('includes/functions.php');

	if(!isset($_SESSION['user'])) {
		redirect_to("index.php");
	}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>R.D. Tea |Daily Leaf Chit</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.css">
    <link rel="stylesheet" href="css/stylesheet.css">
    <link rel="icon" href="images/logo_rdtea.png"/>
    <?php $page_id = 11;?>
    <style>
			.jumbotron {
				background:#520808;
			}
			.jumbotron h1,h3 {
				color:#EDD2D2;
			}
      .jumbotron form input[type="submit"] {
				background: #FFC107;
				color: #000000;
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
        <h1>Leaf Chit</h1>
  			<h3>Hansqua Division</h3>
        <form class="form-inline" action="leaf_chit.php" method="post">
          <div class="form-group">
            <label class="sr-only" for="sectionPicker">Email address</label>
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
				<div class=row>
					<div class="col-sm-6">
							<h1>Unpruned</h1>
							<table id="leaf_chit_table" class="table display" cellspacing="0" width="100%" border="1">
								<thead>
									<tr>
										<th>Date<br/> Last<br/>Plucked</th>
										<th>Round<br/>Days</th>
										<th>Section</th>
										<th>Area<br/>Plucked<br/>(Hec.)</th>
										<th>Pluckers</th>
										<th>Pluckers<br/>per<br/>Hec.</th>
										<th>Leaf<br/>Plucked</th>
										<th>Average<br/>Productivity</th>
										<th>Task</th>
									</thead>
								<tbody>
									<tr>
										<td>Perm. Men</td>
										<td>27-06-2015</td>
										<td>1EXTA</td>
										<td>5</td>
										<td>112</td>
										<td>22</td>
										<td>2330</td>
										<td>21</td>
										<td>7</td>
									</tr>
									<tr>
										<td>Perm. Men</td>
										<td>27-06-2015</td>
										<td>1EXTA</td>
										<td>5</td>
										<td>112</td>
										<td>22</td>
										<td>2330</td>
										<td>21</td>
										<td>7</td>
									</tr>
									<tr>
										<td>Perm. Men</td>
										<td>27-06-2015</td>
										<td>1EXTA</td>
										<td>5</td>
										<td>112</td>
										<td>22</td>
										<td>2330</td>
										<td>21</td>
										<td>7</td>
									</tr>
									<tr>
										<td>Perm. Men</td>
										<td>27-06-2015</td>
										<td>1EXTA</td>
										<td>5</td>
										<td>112</td>
										<td>22</td>
										<td>2330</td>
										<td>21</td>
										<td>7</td>
									</tr>
									<tr>
										<td>Perm. Men</td>
										<td>27-06-2015</td>
										<td>1EXTA</td>
										<td>5</td>
										<td>112</td>
										<td>22</td>
										<td>2330</td>
										<td>21</td>
										<td>7</td>
									</tr>

								</tbody>
					</div>
				</div>
			</div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="http://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js"></script>
		<script>
			$(function() {
				$("#datepicker").datepicker({
					dateFormat: "dd-mm-yy"
				});
				$('#leaf_chit_table').dataTable({
					scrollX: true
				});
			});
		</script>
  </body>
</html>
<?php
	end_connection($connection);
?>
