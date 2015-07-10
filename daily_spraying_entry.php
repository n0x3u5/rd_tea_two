<?php
	require_once('includes/sessions.php');
	require_once('includes/functions.php');

	if(!isset($_SESSION['user'])) {
		redirect_to("index.php");
	}
?>
<?php
	$connection = make_connection();

	//var_dump($_POST);echo "<br><hr>";

//echo "5 l + 5";
?>
<!DOCTYPE html>
<html>
    <head>
      <meta charset="utf-8">
      <title>R.D. Tea | Daily Spraying Entry</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
		  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
			<link rel="stylesheet" href="css/bootstrap-tokenfield.css" type="text/css">
      <link rel="stylesheet" href="css/stylesheet.css">
      <style>
        .card_style {
          background: #EFEBE9;
        }
        .nav-tabs.nav-justified > .active > a, .nav-tabs.nav-justified > .active > a:hover, .nav-tabs.nav-justified > .active > a:active, .nav-tabs.nav-justified > .active > a:enabled {
        background-color: #5D4037 !important;
        border-bottom-color: #5D4037;
        color: #FFFFFF;
        }
        .tab-content {
          background: #EFEBE9;
          padding: 20px;
        }
        .col-sm-4 .btn {
          width: auto;
        }
        .main-form {
          padding: 10px 0 10px 0;
        }
        @media (min-width: 768px) {
          .col-sm-2.col-sm-offset-4 .btn-success {
            float: right;
          }
        }
        @media (max-width: 768px) {
          .col-sm-2.col-sm-offset-4 .btn-success {
            float: right;
          }
        }
        @media (max-width: 500px) {
          .col-sm-2.col-sm-offset-4 .btn-success {
            float: left;
          }
          .btn {
            margin-left: 40px;
          }
        }
        .col-sm-6 .btn {
          margin-top: 15px;
        }
        .col-sm-2 .btn{
          margin-top: 10px;
          margin-bottom: 5px;
        }
      </style>
      <link rel="icon" href="images/logo_rdtea.png"/>
      <?php $page_id = 9;?>
    </head>
    <body>
        <?php
          include("nav_bar.php");
          nav_echoer($page_id);
        ?>
        <div class="container">
          <div class="jumbotron" style="background:#795548;">
            <h1>Spraying Data Entry</h1>
						<p></p><p></p><p></p><p></p>
            <form action="" class="form-horizontal" method="post">
                <div class="row">
									<div class="form-group col-sm-6">
										<label>Select a section:</label>
										<select name="sec_short_name" class="form-control" id="hide_one" onChange="enable_add()">
												<option>Select a section</option>
												<option>1EXT A</option>
												<option>4W</option>
												<option>3EXT</option>
										</select>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-sm-6">
										<label>Select Hazri / Dubly:</label>
										<select name="hz_db" class="form-control" id="hide_two" onChange="enable_add()">
												<option>Select Hz/Db</option>
												<option>HZ</option>
												<option>DB</option>
										</select>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-sm-6">
										<label>Select a date:</label>
										<input type=text class="form-control" id="datepicker" required>
									</div>
								</div>
								<button type="submit" id="hide_me" name="dt_sec_submit" class="btn btn-success" style="margin-top:-1px;">Submit</button>
            </form>
        	</div>
          <div class="col-sm-12 card_style" style="padding-bottom:15px;">
            <ul class="nav nav-tabs nav-justified">
              <li  class="active" id="ac_one"><a href="#tab1" data-toggle="tab" id="take1">Update or Delete Record</a></li>
              <li id="ac_two"><a href="#tab2" data-toggle="tab" id="take2">Add Record</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab1">
	                <form class="form-horizontal" action="daily_spraying_entry.php" method="post">
										<div class="form-group" style="margin-top:30px">
											<label class="col-sm-2 col-sm-offset-1 control-level">Cocktail:</label>
											<div class="col-sm-4">
												<select  name="cocktail"  class="form-control" id="hide_1" onChange="enable_add_one()">
													<option>Select Yes / No :</option>
													<option>Y</option>
													<option>N</option>
												</select>
											</div>
										</div>
	                	<div class="form-group" >
											<label class="col-sm-2 col-sm-offset-1 control-level">Select Item / Items :</label>
											<div class="col-sm-4">
												<input name="chem" type="text" class="form-control" id="item1">
											</div>
											<p class="text-danger"> * Use commas or tabs</p>
										</div>

										<div class="form-group">
											<label class="col-sm-2 col-sm-offset-1 control-level">Select Spot / Full:</label>
											<div class="col-sm-4">
												<select name="spot_full"  class="form-control" id="hide_2" onChange="enable_add_one()">
													<option>Select Spot / Full :</option>
													<option>Spot</option>
													<option>Full</option>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 col-sm-offset-1 control-level">Select Pests / Diseases :</label>
											<div class="col-sm-4">
												<input name="pest" type="text" class="form-control" id="paste1">
											</div>
											<p class="text-danger"> * Use commas or tabs</p>
										</div>
										<div class="form-group">
											<label class="col-sm-2 col-sm-offset-1 control-level">Select Intencity :</label>
											<div class="col-sm-4">
												<input name="intencity"  type="text" class="form-control" id="intcty1">
											</div>
											<p class="text-danger"> * Use commas or tabs</p>
										</div>
										<div class="form-group">
											<label class="col-sm-2 col-sm-offset-1 control-level">Select Quantity :</label>
											<div class="col-sm-4">
												<input name="qty_unit" type="text" class="form-control" id="qty1">
											</div>
											<p class="text-danger"> * Use commas or tabs</p>
										</div>
										<div class="form-group">
											<label class="col-sm-2 col-sm-offset-1 control-level">Select Area :</label>
											<div class="col-sm-4">
												<input name="area" type="text" class="form-control">
											</div>
										</div>
										<!-- <div class="form-group">
											<label class="col-sm-2 col-sm-offset-1 control-level">Select Unit (kg/ Lt) :</label>
											<div class="col-sm-4">
												<select class="form-control" id="hide_3" onChange="enable_add_one()">
													<option>Select Kg / Lt :</option>
													<option>K</option>
													<option>L</option>
												</select>
											</div>
										</div> -->
										<!-- <option>Select Low / medium / High </option>
										<option>Low</option>
										<option>Medium</option>
										<option>High</option> -->

										<div class="form-group">
											<label class="col-sm-2 col-sm-offset-1 control-level">No of Drums (sprayed) :</label>
											<div class="col-sm-4">
												<input name="no_drums" type="text" class="form-control">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 col-sm-offset-1 control-level">Mandays (D Rated):</label>
											<div class="col-sm-4">
												<input name="dr__mnds" type="text" class="form-control">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 col-sm-offset-1 control-level">Mandays (Supervisory) :</label>
											<div class="col-sm-4">
												<input name="sup_mnds" type="text" class="form-control">
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
                <form class="form-horizontal" action="daily_spraying_entry.php" method="post">
									<div class="form-group" style="margin-top:30px">
										<label class="col-sm-2 col-sm-offset-1 control-level">Cocktail:</label>
										<div class="col-sm-4">
											<select  name="cocktail"class="form-control" onChange="enable_add_two()" id="hide_11">
												<option>Select Yes / No :</option>
												<option>Y</option>
												<option>N</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 col-sm-offset-1 control-level">Select Item / Items :</label>
										<div class="col-sm-4">
											<input name="chem" type="text" class="form-control" id="item2">
										</div>
										<p class="text-danger"> * Use commas or tabs</p>
									</div>

									<div class="form-group">
										<label class="col-sm-2 col-sm-offset-1 control-level">Select Spot / Full:</label>
										<div class="col-sm-4">
											<select name="spot_full" class="form-control" onChange="enable_add_two()" id="hide_12">
												<option>Select Spot / Full :</option>
												<option>Spot</option>
												<option>Full</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 col-sm-offset-1 control-level">Select Pests / Diseases :</label>
										<div class="col-sm-4">
											<input name="pest" type="text" class="form-control" id="paste2">
										</div>
										<p class="text-danger"> * Use commas or tabs</p>
									</div>
									<div class="form-group">
										<label class="col-sm-2 col-sm-offset-1 control-level">Select Intencity :</label>
										<div class="col-sm-4">
											<input name="intensity" type="text" class="form-control" id="paste2">
											</div>
											<p class="text-danger"> * Use commas or tabs</p>
									</div>
									<div class="form-group">
										<label class="col-sm-2 col-sm-offset-1 control-level">Select Quantity :</label>
										<div class="col-sm-4">
											<input name="qty_unit" type="text" class="form-control" id="qty2">
										</div>
										<p class="text-danger"> * Use commas or tabs</p>
									</div>
									<!-- <div class="form-group">
										<label class="col-sm-2 col-sm-offset-1 control-level">Select Unit (kg/ Lt) :</label>
										<div class="col-sm-4">
											<select class="form-control" onChange="enable_add_two()" id="hide_13">
												<option>Select Kg / Lt :</option>
												<option>K</option>
												<option>L</option>
											</select>
										</div>
									</div> -->
									<div class="form-group">
										<label class="col-sm-2 col-sm-offset-1 control-level">Select Area :</label>
										<div class="col-sm-4">
											<input name="area" type="text" class="form-control">
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 col-sm-offset-1 control-level">No of Drums (sprayed) :</label>
										<div class="col-sm-4">
											<input name="no_drums" type="text" class="form-control">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 col-sm-offset-1 control-level">Mandays (D Rated):</label>
										<div class="col-sm-4">
											<input name="dr_mnds" type="text" class="form-control">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 col-sm-offset-1 control-level">Mandays (Supervisory) :</label>
										<div class="col-sm-4">
											<input name="sup_mnds" type="text" class="form-control">
										</div>
									</div>
									<div class="col-sm-2 col-sm-offset-3">
										<input type="submit" id="add_entry" name="add_submit" value="Add Entry" class="btn btn-success"style="margin-top:20px; margin-left:-10px;">
									</div>
                </form>
              </div>
						</div>
          </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
				<script src="scripts/bootstrap-tokenfield.min.js"></script>
    		<script>
    				$(function() {
    				$( "#datepicker" ).datepicker({dateFormat: 'dd-mm-yy'});
						$('#item1,#item2,#paste1,#qty1,#paste2,#qty2').tokenfield({});




						$('#intcty1,#intcty2').tokenfield({
								autocomplete :{
										source:['Low','Medium','High'],
										delay:100
								},
								showAutocompleteOnFocus: true
						});

    				});

    		</script>

					<script>
					document.getElementById('hide_me').disabled=true;
					function enable_add() {


						if(document.getElementById('hide_one')!='Select a section' && document.getElementById('hide_two').value!='Select Hz/Db')
						{
								document.getElementById('hide_me').disabled=false;
						}
						else {
								document.getElementById('hide_me').disabled=true;
						}

					}
					document.getElementById('delete_entry').disabled=true;
					document.getElementById('edit_entry').disabled=true;
						document.getElementById('add_entry').disabled=true;

					function enable_add_one() {

						if(document.getElementById('hide_1').value!='Select Yes / No :' && document.getElementById('hide_2').value!='Select Spot / Full :')
						{
							document.getElementById('delete_entry').disabled=false;
							document.getElementById('edit_entry').disabled=false;
						}
						else {
							document.getElementById('delete_entry').disabled=true;
							document.getElementById('edit_entry').disabled=true;
						}


					}
					function enable_add_two() {

						if(document.getElementById('hide_11').value!='Select Yes / No :' && document.getElementById('hide_12').value!='Select Spot / Full :')
						{
							document.getElementById('add_entry').disabled=false;

						}
						else {
							document.getElementById('add_entry').disabled=true;

						}
						// $('#item2').on('tokenfield:createtoken',function (e)	{
						//
						// 	if(document.getElementById('hide_11').value=='N')
						// 	{
						// 		event.preventDefault()
						// 	}
						// 	else{
						// 		// $('#item2').tokenfield({})
						// 	}
						// }).tokenfield();

					}
					</script>

        </body>
    </body>
</html>

<?php
  // mysqli_free_result($result);
	end_connection($connection);
?>
