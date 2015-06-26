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
                    <input type="text" placeholder="Enter Section" class=" form-control input group" style="width:auto; margin:5px 0 0 5px;">
                    <input type="date" placeholder="Enter Date" class=" form-control input group" style="width:auto;margin:5px 0 0 5px;">

                    <input type="submit" placeholder="Entry" class="btn" style="width:auto; margin:5px 0 0 5px;">
                </form>
            </div>
            <div class="col-sm-12" style="background-color:#FFFFFF">
				<form>
					<input type="" class="form-control" placeholder="" style="margin:5px 5px 5px 5px;">
					<input type="" class="form-control" placeholder="" style="margin:5px 5px 5px 5px;">
					<input type="" class="form-control" placeholder="" style="margin:5px 5px 5px 5px;">
					<input type="" class="form-control" placeholder="" style="margin:5px 5px 5px 5px;">
					<input type="" class="form-control" placeholder="" style="margin:5px 5px 5px 5px;">
					<input type="" class="form-control" placeholder="" style="margin:5px 5px 5px 5px;">
					<input type="" class="form-control" placeholder="" style="margin:5px 5px 5px 5px;">
					<input type="" class="form-control" placeholder="" style="margin:5px 5px 5px 5px;">
					<input type="" class="form-control" placeholder="" style="margin:5px 5px 5px 5px;">
					<input type="" class="form-control" placeholder="" style="margin:5px 5px 5px 5px;">

				</form>
			</div>
        </div>
    </body>
</html>
