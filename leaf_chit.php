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
    <title>R.D. Tea |Daily Leaf Chit</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/1.0.6/css/dataTables.responsive.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="css/stylesheet.css">
    <link rel="icon" href="images/logo_rdtea.png"/>
    <?php $page_id = 11;?>
    <style>
			.jumbotron {
				background:#D32F2F;
			}
			.jumbotron h3 {
				color:#FFCDD2;
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
        <form class="form-inline">
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
            <label class="sr-only" for="datepicker">Password</label>
            <input type="password" class="form-control" id="datepicker" placeholder="Password">
          </div>
          <input type="submit" class="btn btn-warning" value="Get Data">
        </form>
      </div>
			<div class="main-content">

			</div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="http://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script src="http://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js">
    </script>
  </body>
</html>
