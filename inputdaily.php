<?php
	require_once('/includes/sessions.php');
	require_once('/includes/functions.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>R.D. Tea | Manage Sections</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
        <link rel="stylesheet" href="http://cdn.datatables.net/1.10.7/css/jquery.dataTables.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/stylesheet.css">
        <link rel="icon" href="images/logo_rdtea.png"/>
        <?php $page_id = 7;?>
    </head>
    <body>
         <?php
            include("nav_bar.php");
            nav_echoer($page_id);
        ?>
        <div class="container">
            <div class="jumbotron" style="background:#BF360C;margin-left:-15px;margin-right: -15px;">
                <h1>Daily Data Entry</h1>
                <form class="form form-group form-inline" style="margin-top: 30px;">
                    <p></p>
                    <p></p>
										<select id="division" class="form-control input-group">
											<option>1w</option>
											<option>7east</option>
											<option>5n</option>
											<option>6w</option>
											<option>20n</option>
										</select>
										<input type="text" name="date_value" class="form-control" id="datepicker" placeholder="Date (dd-mm-yyyy)" onChange="enable_add()">

										<span class="input-group-addon">
												<i class="glyphicon glyphicon-calendar"></i>

										<input type="submit" placeholder="Entry" class="btn" style="width:auto; margin:  -10px 0 0 5px;">
                </form>
            </div>
            <div class="col-sm-12" style="background-color:#FFFFFF">
				<form>
					<input type="text" class="form-control" placeholder="Division" style="margin:25px 5px 5px 5px; width:60%;">
					<input type="text" class="form-control" placeholder="Prune" style="margin:5px 5px 5px 5px; width:60%;">
					<input type="text" class="form-control" placeholder="Plucked Area" style="margin:5px 5px 5px 5px; width:60%;">
					<input type="text" class="form-control" placeholder="Total Leaf" style="margin:5px 5px 5px 5px; width:60%;">
					<input type="text" class="form-control" placeholder="Hz Quantity" style="margin:5px 5px 5px 5px; width:60%;">
					<input type="text" class="form-control" placeholder="Hz Area" style="margin:5px 5px 5px 5px; width:60%;">
					<input type="text" class="form-control" placeholder="DB quantity" style="margin:5px 5px 5px 5px; width:60%;">
					<input type="text" class="form-control" placeholder="DB Area" style="margin:5px 5px 5px 5px; width:60%;">
					<input type="text" class="form-control" placeholder="Mandays" style="margin:5px 5px 5px 5px; width:60%;">
					<input type="submit" class="btn" placeholder="Save" style="margin:5px 5px 5px 5px; width:auto;">
				</form>
			</div>
        </div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
		<script>
				$(function() {
				$( "#datepicker" ).datepicker({dateFormat: 'dd-mm-yy'});
				});
		</script>
    </body>
</html>
