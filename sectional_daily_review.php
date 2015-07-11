<?php
	require_once('includes/sessions.php');
	require_once('includes/functions.php');

	if(!isset($_SESSION['user'])) {
		redirect_to("index.php");
	}
?>

<?php
	$connection = make_connection();

	//var_dump($_POST); echo "<br>";
	if(isset($_POST['sec_date_submit'])) {
		$req_div = $_SESSION['current_div'];
		$req_start_date = $_POST['start_date_value'];
		$req_end_date = $_POST['end_date_value'];
		$req_ssn = $_POST['short_sec_name'];

		$from = date('Y-m-d', strtotime($req_start_date));
	  $to = date('Y-m-d', strtotime($req_end_date));

		//var_dump($req_day_spray);

		$query_pluck = "select * from blue_bk_plk where short_sec_name ='$req_ssn' and division='{$req_div}' and rec_dt between '$from' and '$to'";

		$result_pluck = mysqli_query($connection, $query_pluck);
		confirm_query($result_pluck);

		$query_spray = "select * from blue_bk_spray_chit where short_sec_name ='$req_ssn' and division='{$req_div}' and rec_dt between '$from' and '$to'";

		$result_spray = mysqli_query($connection, $query_spray);
		confirm_query($result_spray);
		// echo "<br> header processing ends. <hr>";

	}
	else {
		//$req_div_name = NULL;
		//$req_year = NULL;
		$req_start_date = NULL;
		$req_end_date = NULL;
		$result_spray = NULL;
	}
?>



<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>R.D. Tea | Daily Sectional Review</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/1.0.6/css/dataTables.responsive.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/stylesheet.css">
        <link rel="icon" href="images/logo_rdtea.png"/>
				<style>
					.scrollStyle {
						overflow-x: auto;
					}
				</style>
        <?php $page_id = 5;?>
    </head>
    <body>
        <?php
            include("nav_bar.php");
            nav_echoer($page_id);
        ?>
        <div class="container">
            <div class="jumbotron" style="background:#0A6B16;margin-left:-15px;margin-right: -15px;">
                <h1>Sectional Review </h1>
                <p style="color:">(Daily)</p>
                <p></p>
                <p></p>
                <h3 style="color:#fff">Section:</h3>
                <form class=" form-horizontal" action="sectional_daily_review.php" method="post">
									<div class="row">
                  	<div class="form-group col-sm-6">
                    <!-- <label class="sr-only" for="sec_select">Email address</label> -->
											<select id="section" name="short_sec_name" class="form-control" onChange="enable_add()">
												<option>Select a section</option>
				                <?php
				                    $q = "SELECT * FROM sections where division = '{$_SESSION['current_div']}'";
				                    $r = mysqli_query($connection, $q);

				                    confirm_query($r);
				                    //$_POST['sec_short_nm'] = NULL;

				                    while($sec_values = mysqli_fetch_assoc($r)) {
				                ?>
				                      <option value="<?php echo htmlentities($sec_values['short_sec_name']) ?>" <?php if(isset($_POST["sec_date_submit"]) && ($_POST['short_sec_name'] == $sec_values['short_sec_name'])) { echo "selected";} ?> ><?php echo htmlentities($sec_values['short_sec_name']); ?></option>
				                <?php
				                    }
				                ?>
				              </select>
                  	</div>
									</div>
									<div class="form-group">
										<p style="color:#B3E5FC">Start date</p>
										<div class="input-group">
											<span class="input-group-addon">
													<i class="glyphicon glyphicon-calendar"></i>
											</span>
											<input type="text" name="start_date_value" class="form-control" id="datepicker1" <?php if($req_start_date !=NULL) { ?>value="<?php echo date('d-m-Y', strtotime($req_start_date));?>" <?php } else { ?>placeholder="Date (dd-mm-yyyy)"<?php } ?>  required>

										</div>
									</div>
									<p></p>
									<p></p>
									<div class="form-group">
										<p style="color:#B3E5FC">End date</p>
										<div class="input-group">
											<span class="input-group-addon">
													<i class="glyphicon glyphicon-calendar"></i>
											</span>
											<input type="text" name="end_date_value" class="form-control" id="datepicker2" <?php if($req_end_date !=NULL) { ?>value="<?php echo date('d-m-Y', strtotime($req_end_date));?>" <?php } else { ?>placeholder="Date (dd-mm-yyyy)"<?php } ?> onChange="enable_add()" required>

										</div>
									</div>
                  <button type="submit" name='sec_date_submit' value="section and date range" class="btn btn-default" id="hide_me" style="margin-top:0px;">Get Data</button>
                </form>

            </div>


            <div class="tab-container" style="margin-top:10px;">
                <ul class="nav nav-tabs nav-justified">
                    <li class="active"><a href="#tab1" data-toggle="tab"> Plucking</a></li>
                    <li><a href="#tab2" data-toggle="tab">Spraying</a></li>
                </ul>
                <div class="tab-content"  style="background-color:#FFF">
                    <div class="tab-pane active" id="tab1">
                        <table  id="pluck_day" class="table table-hover" border="1">
                            <thead style="border: solid 2px green">
                                <tr>
                                    <th>Date</th>
                                    <th>Section</th>
                                    <th>Prune</th>
                                    <th>Plucked Area</th>
                                    <th>Total Leaf Plucked</th>
                                    <th>Mandays</th>
																		<th>Leaf / Ha.</th>
																		<th>Pluckers / Ha.</th>
																		<th>Leaf / Plucker</th>
																		<th>Round days</th>
                                </tr>
                            </thead>
                            <tbody>
															<?php
																if(isset($_POST['sec_date_submit'])) {
																	while($plk_rev = mysqli_fetch_assoc($result_pluck)) {
															?>
	                                <tr>
	                                    <td style="text-align:center;"><?php echo date('d-m-Y', strtotime($plk_rev['rec_dt'])); ?></td>
	                                    <td><?php echo $plk_rev['short_sec_name']; ?></td>
	                                    <td><?php echo $plk_rev['prune_style']; ?></td>
	                                    <td><?php	echo $plk_rev['plkd_area'];	?></td>
																			<td><?php	echo $plk_rev['plkd_leaf'];	?></td>
																			<td><?php	echo $plk_rev['mandays'];	?></td>
																			<td><?php	echo round($plk_rev['plkd_leaf']/$plk_rev['plkd_area']);	?></td>
																			<td><?php	echo round($plk_rev['mandays']/$plk_rev['plkd_area'], 2);	?></td>
																			<td><?php	echo round($plk_rev['plkd_leaf']/$plk_rev['mandays'], 2);	?></td>
																  		<td><?php	echo $plk_rev['rnd_days'];	?></td>
																	</tr>
															<?php
																  }
																}
															?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="tab2">
                         <table  id="spray_day" class="table table-hover display" border="1" cellspacing="0" width="100%">
                             <thead style="border: solid 2px green">
                                 <tr>
																	 <th>Date</th>
																	 <th>Hz/Db</th>
																	 <th>Item</th>
						                       <th>cocktail</th>
						                       <th>Section</th>
						                       <th>spot/Full</th>
						                       <th>Pest/<br/>Disease</th>
						                       <th>Intensity</th>
						                       <th>Area<br/>( in Ha.)</th>
						 											<th>Issued Qty with Unit<br/>(Kg/lt.)</th>
						 											<th>No of Drums</th>
						 											<th>Mandays<br/> (DR rated)</th>
						 											<th>Mandays<br/>(Supervisory)</th>


                                </tr>
                             </thead>
														<tbody>
															<?php
																if(isset($_POST['sec_date_submit'])) {
																	while($spray_rev = mysqli_fetch_assoc($result_spray)) {
															?>
																		<tr>
																			<td><?php echo date('d-m-Y', strtotime($spray_rev['rec_dt'])); ?></td>
																			<td><?php echo $spray_rev['hz_db']; ?></td>
																			<td><?php $csv = comma_sep_val($spray_rev['chem']); ?> <?php echo $csv; ?></td>
																			<td><?php echo $spray_rev['cocktail']; ?></td>
																			<td><?php echo $spray_rev['short_sec_name']; ?></td>
																			<td><?php echo $spray_rev['spot_full']; ?></td>
																			<td><?php $csv = comma_sep_val($spray_rev['pest']); ?> <?php echo $csv; ?></td>
																			<td><?php $csv = comma_sep_val($spray_rev['intensity']); ?> <?php echo $csv; ?></td>
																			<td><?php echo $spray_rev['area']; ?></td>
																			<td><?php $csv = comma_sep_val($spray_rev['qty_unit']); ?> <?php echo $csv; ?></td>
																			<td><?php echo $spray_rev['no_drms']; ?></td>
																			<td><?php echo $spray_rev['dr_mnds']; ?></td>
																			<td><?php echo $spray_rev['sup_mnds']; ?></td>
																		</tr>
															<?php
																  }
																}
															?>
														</tbody>
                        </table>
                    </div>


                </div>
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
                    $('#pluck_day').dataTable({});
                    var wideTable = $('#spray_day').dataTable({});
										$(window).bind('resize', function () {
											wideTable.fnAdjustColumnSizing();
										});
										jQuery('.dataTable').wrap('<div class="scrollStyle" />');
            });
        </script>
				<script type="text/javascript">
						$(function() {
							$( "#datepicker1, #datepicker2" ).datepicker({dateFormat: 'dd-mm-yy'});
						});
				</script>
				<script>
					if(document.getElementById('datepicker1').value=='')
					{
							document.getElementById('hide_me').disabled=true;
					}
				function enable_add() {
					if(document.getElementById('section').value!='Select a section')
					{
						document.getElementById('hide_me').disabled=false;
					}
					else {
						document.getElementById('hide_me').disabled=true;
					}
				}
				</script>
    </body>
</html>
<?php
	end_connection($connection);
?>
