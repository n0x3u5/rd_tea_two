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
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
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
                <form action="#" method="post" class="form form-group form-inline" style="margin-top: 30px;">
                    <p></p>
                    <p></p>
						<div class="input-group">
	                        <input type="text" name="date_value" class="form-control" id="datepicker" placeholder="Date (dd-mm-yy)" onChange="enable_add()">
	                        <span class="input-group-addon">
	                            <i class="glyphicon glyphicon-calendar"></i>
	                        </span>
	                    </div>
						<input type="submit" placeholder="Entry" class="btn" style="width:auto; margin:  -10px 0 0 5px;">
                </form>
            </div>
			<div class="tab-container">
	            <ul class="nav nav-tabs nav-justified">
	                <li class="active"><a href="#tab1" data-toggle="tab">Edit Entry</a></li>
	                <li><a href="#tab2" data-toggle="tab">Delete Entry</a></li>
					<li><a href="#tab3" data-toggle="tab">Add Entry</a></li>
	            </ul>
				<div class="tab-content" style="background-color:#FFFFFF">
					<div class="tab-pane active" id="tab1">
						<form action="#" method="post">
							<select id="division" class="form-control input-group">
								<option>1w</option>
								<option>7east</option>
								<option>5n</option>
								<option>6w</option>
								<option>20n</option>
							</select>
							<input style="margin-bottom:10px" type="submit" class="btn btn-info" name="view_submit" value="View a Section">
							<div class="input-group">
								<input class="form-control" type="text" placeholder="Section Name">
								<span class="input-group-addon"><i class="glyphicon glyphicon-star-empty" ></i></span>
							</div>
		                    <div class="input-group">
		                        <input class="form-control" type="text" placeholder="Prune Type">
		                        <span class="input-group-addon"><i class="glyphicon glyphicon-user" ></i></span>
		                    </div>
		                    <div class="input-group">
		                        <input class="form-control" type="text" placeholder="Plucked Area">
		                        <span class="input-group-addon"><i class="glyphicon glyphicon-user" ></i></span>
		                    </div>
		                    <div class="input-group">
		                        <input class="form-control" type="text" placeholder="Total Leaf">
		                        <span class="input-group-addon"><i class="glyphicon glyphicon-user" ></i></span>
		                    </div>
			                    <div class="input-group">
			                        <input class="form-control" type="text" placeholder="Hazri Quantity">
			                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope" ></i></span>
		                    	</div>
		                    <div class="input-group">
		                        <input class="form-control" type="text" placeholder="Hazri Area" required>
		                        <span class="input-group-addon"><i class="glyphicon glyphicon-asterisk" ></i></span>
		                    </div>
		                    <div class="input-group">
		                        <input class="form-control" type="text" placeholder="Doubly Quantity" >
		                        <span class="input-group-addon"><i class="glyphicon glyphicon-asterisk" ></i></span>
		                    </div>
		                    <div class="input-group">
		                        <input class="form-control" type="text" placeholder="Doubly Area">
		                        <span class="input-group-addon"><i class="glyphicon glyphicon-asterisk" ></i></span>
		                    </div>
		                    <div class="input-group">
		                        <input class="form-control" type="text" placeholder="Doubly Area">
		                        <span class="input-group-addon"><i class="glyphicon glyphicon-asterisk" ></i></span>
		                    </div>
		                    <input type="submit" name="edit" value="Edit Entry" class="btn btn-default">
		                </form>
					</div>
					<div class="tab-pane" id="tab2">
		                <form action="#" method="post">
							<select id="division" class="form-control input-group">
								<option>1w</option>
								<option>7east</option>
								<option>5n</option>
								<option>6w</option>
								<option>20n</option>
							</select>
		                    <button type="button" name="remove" value="Delete Entry" class="btn btn-default" data-toggle="modal" data-target="#confirmModal">Delete Entry</button>
							<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModallabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="myModalLabel">Modal title</h4>
										</div>
										<div class="modal-body">
											<p>Are you sure you wish to delete this entry?</p>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											<input type="submit" class="btn btn-danger" value="Confirm Delete">
										</div>
									</div>
								</div>
							</div>
		                </form>
					</div>
					<div class="tab-pane" id="tab3">
						<form action="#" method="post">
							<div class="input-group">
								<input class="form-control" type="text" placeholder="Section Name">
								<span class="input-group-addon"><i class="glyphicon glyphicon-star-empty" ></i></span>
							</div>
		                    <div class="input-group">
		                        <input class="form-control" type="text" placeholder="Prune Type">
		                        <span class="input-group-addon"><i class="glyphicon glyphicon-user" ></i></span>
		                    </div>
		                    <div class="input-group">
		                        <input class="form-control" type="text" placeholder="Plucked Area">
		                        <span class="input-group-addon"><i class="glyphicon glyphicon-user" ></i></span>
		                    </div>
		                    <div class="input-group">
		                        <input class="form-control" type="text" placeholder="Total Leaf">
		                        <span class="input-group-addon"><i class="glyphicon glyphicon-user" ></i></span>
		                    </div>
			                    <div class="input-group">
			                        <input class="form-control" type="text" placeholder="Hazri Quantity">
			                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope" ></i></span>
		                    	</div>
		                    <div class="input-group">
		                        <input class="form-control" type="text" placeholder="Hazri Area" required>
		                        <span class="input-group-addon"><i class="glyphicon glyphicon-asterisk" ></i></span>
		                    </div>
		                    <div class="input-group">
		                        <input class="form-control" type="text" placeholder="Doubly Quantity" >
		                        <span class="input-group-addon"><i class="glyphicon glyphicon-asterisk" ></i></span>
		                    </div>
		                    <div class="input-group">
		                        <input class="form-control" type="text" placeholder="Doubly Area">
		                        <span class="input-group-addon"><i class="glyphicon glyphicon-asterisk" ></i></span>
		                    </div>
		                    <div class="input-group">
		                        <input class="form-control" type="text" placeholder="Doubly Area">
		                        <span class="input-group-addon"><i class="glyphicon glyphicon-asterisk" ></i></span>
		                    </div>
		                    <input type="submit" name="add" value="Add Entry" class="btn btn-default">
		                </form>
					</div>
				</div>
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
