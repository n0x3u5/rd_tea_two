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
        <title>R.D. Tea |Daily Spray Chit</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
				<link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/3.0.4/css/dataTables.fixedColumns.css">
				<link rel="stylesheet" href="https://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/1.0.6/css/dataTables.responsive.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <style>
					#spray_chit th ,#spray_chit td{
						text-align: center;
					}
        </style>
        <link rel="stylesheet" href="css/stylesheet.css">
        <link rel="icon" href="images/logo_rdtea.png"/>
        <?php $page_id = 10;?>
    </head>
    <body>
        <?php
            include("nav_bar.php");
            nav_echoer($page_id);
        ?>
        <div class="container">
            <div class="jumbotron" style="background:#6D4C41;margin-left:-15px;margin-right: -15px;">
                <h1>Spray Chit</h1>
                <p></p>
								<h4 style="color:#FFFFFF; margin-bottom:25px;">Hansqua Tea Garden</h4>
                <p></p>
								<div class="row">
									<div class="form-group col-sm-6">
										<label for="">Select Hz / DB:</label>
										<select class="form-control" id="hide_one" onChange="enable_add()" required>
											<option>Select Hz/Db</option>
											<option>HZ</option>
											<option>DB</option>
										</select>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-sm-6">
										<label for="">Select date:</label>
										<input type="text" id="datepicker" class="form-control" required>
									</div>
								</div>
								<input type="button" value="Get data" class="btn btn-success" id="hide_me">
            </div>
            <div class="col-sm-12" style="background:#FFFFFF">
              <form class="form-group" style="padding-top:20px;">

                  <table id="spray_chit" class=" display table table-hover table-striped " border="1" cellspacing="0" width="100%">
                    <thead style="2px solid green">

											<th>Item</th>
                      <th>cocktail</th>
                      <th>Section</th>
                      <th>spot/Full</th>
                      <th>Pest/<br/>Disease</th>
                      <th>Intensity</th>
                      <th>Area<br/>( in Ha.)</th>
											<th>Issued Qty</th>
											<th>Unit<br/>(Kg/lt.)</th>
											<th>No of Drums</th>
											<th>Mandays<br/> (DR rated)</th>
											<th>Mandays<br/>(Supervisory)</th>


                    </thead>
                    <tbody>


												<td>abcd</td>
												<td>y</td>
												<td>1EXTA</td>
												<td>full</td>
												<td>xyz</td>
												<td>33</td>
												<td>250</td>
												<td>11</td>
												<td>k</td>
												<td>6</td>
												<td>245</td>
												<td>5</td>

                    </tbody>

                  </table>
              </form>
            </div>

      </div>

			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

        <script src="http://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
        <script src="http://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js"></script>
				<script src="https://cdn.datatables.net/fixedcolumns/3.0.4/js/dataTables.fixedColumns.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/1.0.6/js/dataTables.responsive.js"></script>
        <script>
							document.getElementById('hide_me').disabled=true;
							$(document).ready( function () {
							var table = $('#spray_chit').DataTable( {
									"scrollY": "300px",
									"scrollX": "100%",
									"scrollCollapse": true,
									"paging": false
							} );
							new $.fn.dataTable.FixedColumns( table );
							$("#datepicker").datepicker({
								dateFormat: "dd-mm-yy"
							});
						} );
						function enable_add() {
							if(document.getElementById('hide_one').value!='Select Hz/Db')
							{
								document.getElementById('hide_me').disabled=false;
							}
							else{
									document.getElementById('hide_me').disabled=true;
							}
						}
        </script>

    </body>
</html>
