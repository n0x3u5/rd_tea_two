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
        <title>R.D. Tea | daily Leaf Chit</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/1.0.6/css/dataTables.responsive.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
        <style>
					.col-sm-12{
						margin-top: 30px;
					}
					#table2_filter{
						display: none;
					}
					#table3_filter{
						display: none;
					}
					#table2_wrapper{
						padding-top: -20px;
					}
        </style>
        <link rel="stylesheet" href="css/stylesheet.css">
        <link rel="icon" href="images/logo_rdtea.png"/>
        <?php $page_id =11;?>
    </head>
    <body>
        <?php
            include("nav_bar.php");
            nav_echoer($page_id);
        ?>
        <div class="container">
            <div class="jumbotron" style="background:#083A00;margin-left:-15px;margin-right: -15px;">
                <h1>Leaf Chit</h1>
                <p></p>
								<h3 style="color:#FFFFFF">Hansqua Tea Garden</h3>
                <p></p>
            </div>
            <div class="card_style col-sm-12" style="background:#FFFFFF">
								<h3 style="position:relative;margin-top:40px;margin-bottom:10px;margin-left:40px;color:rgb(175,175,0)"><strong>Unpruned</strong></h3>

                  <table id="leaf_chit_unpruned" class="table table-hover" border="1">
                    <thead style="2px solid green">
                      <th>Date</th>
											<th>Category</th>
                      <th>Section No.</th>
                      <th>Area Plucked (in Ha.)</th>
                      <th>Total Pluckers</th>
                      <th>Pluckers per Hec.</th>
                      <th>Total G. Leaf Plucked</th>
                      <th>Average</th>
											<th>No. of Round Days</th>
											<th>task</th>
											<th>Ballometer Count</th>
                    </thead>
                    <tbody>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
                    </tbody>

                  </table>
            </div>
						<div class="card_style col-sm-12" style="background:#FFFFFF">
							<h3 style="position:relative;margin-top:40px;margin-bottom:10px;margin-left:40px;color:rgb(175,175,0)"><strong>Total</strong></h3>
									<table id="table2" class="table table-hover" border="1">
										<thead style="2px solid green">
											<th>Date</th>
											<th>Category</th>
											<th>Section No.</th>
											<th>Area Plucked (in Ha.)</th>
											<th>Total Pluckers</th>
											<th>Pluckers per Hec.</th>
											<th>Total G. Leaf Plucked</th>
											<th>Average</th>
											<th>No. of Round Days</th>
											<th>task</th>
											<th>Ballometer Count</th>
										</thead>
										<tbody>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
										</tbody>

									</table>
						</div>
						<div class="card_style col-sm-12" style="background:#FFFFFF">
								<h3 style="position:relative;margin-top:40px;margin-bottom:10px;margin-left:40px;color:rgb(175,175,0)"><strong>Pruned</strong></h3>

                  <table id="leaf_chit_pruned" class="table table-hover" border="1">
                    <thead style="2px solid green">
                      <th>Date</th>
											<th>Category</th>
                      <th>Section No.</th>
                      <th>Area Plucked (in Ha.)</th>
                      <th>Total Pluckers</th>
                      <th>Pluckers per Hec.</th>
                      <th>Total G. Leaf Plucked</th>
                      <th>Average</th>
											<th>No. of Round Days</th>
											<th>task</th>
											<th>Ballometer Count</th>
                    </thead>
                    <tbody>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
                    </tbody>

                  </table>

            </div>
						<div class="card_style col-sm-12" style="background:#FFFFFF">
							<h3 style="position:relative;margin-top:40px;margin-bottom:10px;margin-left:40px;color:rgb(175,175,0)"><strong>Total</strong></h3>
									<table id="table3" class="table table-hover" border="1">
										<thead style="2px solid green">
											<th>Date</th>
											<th>Category</th>
											<th>Section No.</th>
											<th>Area Plucked (in Ha.)</th>
											<th>Total Pluckers</th>
											<th>Pluckers per Hec.</th>
											<th>Total G. Leaf Plucked</th>
											<th>Average</th>
											<th>No. of Round Days</th>
											<th>task</th>
											<th>Ballometer Count</th>
										</thead>
										<tbody>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
										</tbody>

									</table>

						</div>


      </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <script src="http://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
        <script src="http://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js"></script>
        <script src="http://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js">
        </script>
        <script src="https://cdn.datatables.net/responsive/1.0.6/js/dataTables.responsive.js"></script>
        <script>
            $(document).ready(function() {
                    $('#leaf_chit_unpruned').dataTable({"scrollX": true});
										  $('#leaf_chit_pruned').dataTable({"scrollX": true});
										$('#table2').dataTable({"scrollX": true,"paging":   false,
														"ordering": false,
														"info":    true

										});
										$('#table3').dataTable({"scrollX": true,"paging":   false,
														"ordering": false,
														"info":    true

										});

            });
        </script>

    </body>
</html>
