<?php
	require_once('/includes/sessions.php');
	require_once('/includes/functions.php');

	if(!isset($_SESSION['user'])) {
		redirect_to("index.php");
	}
?>

<?php
	$connection = make_connection();

	//var_dump($_POST); echo "<br>";
	if(isset($_POST['sec_date_submit'])) {
		$req_start_date = $_POST['start_date_value'];
		$req_end_date = $_POST['end_date_value'];
		$req_ssn = $_POST['short_sec_name'];

		$from = date('Y-m-d', strtotime($req_start_date));
	  $to = date('Y-m-d', strtotime($req_end_date));
	  $query_spray = "select * from daily_spraying where short_sec_name ='$req_ssn' and record_date between '$from' and '$to'";
	  //var_dump($query_spray);

	  $result_spray = mysqli_query($connection, $query_spray);
	  confirm_query($result_spray);
		//var_dump($req_day_spray);

		$query_pluck = "select * from daily_plucking where short_sec_name ='$req_ssn' and rec_dt between '$from' and '$to'";

		$result_pluck = mysqli_query($connection, $query_pluck);
		confirm_query($result_pluck);

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
										<select id="division" name ="short_sec_name" class="form-control">
			                <?php
			                    $q = "SELECT * FROM sections";
			                    $r = mysqli_query($connection, $q);

			                    confirm_query($r);
			                    //$_POST['sec_short_nm'] = NULL;

			                    echo "<option id=\"opt0\" value=NULL></option>";
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
											<input type="text" name="start_date_value" class="form-control" id="datepicker1" <?php if($req_start_date !=NULL) { ?>value="<?php echo date('d-m-Y', strtotime($req_start_date));?>" <?php } else { ?>placeholder="Date (dd-mm-yyyy)"<?php } ?> onChange="enable_add()" required>
											<span class="input-group-addon">
													<i class="glyphicon glyphicon-calendar"></i>
											</span>
										</div>
									</div>
									<p></p>
									<p></p>
									<div class="form-group">
										<p style="color:#B3E5FC">End date</p>
										<div class="input-group">
											<input type="text" name="end_date_value" class="form-control" id="datepicker2" <?php if($req_end_date !=NULL) { ?>value="<?php echo date('d-m-Y', strtotime($req_end_date));?>" <?php } else { ?>placeholder="Date (dd-mm-yyyy)"<?php } ?> onChange="enable_add()" required>
											<span class="input-group-addon">
													<i class="glyphicon glyphicon-calendar"></i>
											</span>
										</div>
									</div>
                  <button type="submit" name='sec_date_submit' value="section and date range" class="btn btn-default" style="margin-top:0px;">Get Data</button>
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
																		<th>Pluckers / Ha</th>
																		<th>Leaf / Plucker</th>
                                </tr>
                            </thead>
                            <tbody>
															<?php
																if(isset($_POST['sec_date_submit'])) {
																	while($req_day_pluck = mysqli_fetch_assoc($result_pluck)) {
															?>
	                                <tr>
	                                    <td style="text-align:center;"><?php echo date('d-m-Y', strtotime($req_day_pluck['rec_dt'])); ?></td>
	                                    <td><?php echo $req_day_pluck['short_sec_name']; ?></td>
	                                    <td><?php echo $req_day_pluck['prune_status']; ?></td>
	                                    <td>
																				<?php
																					$exp_arr = explode("¥", $req_day_pluck['lab_cat_plkd_area']);
																					$plkd_area = array_sum($exp_arr);
																					echo $plkd_area;
																				?>
																			</td>
																			<td></td>
																			<td></td>
																			<td></td>
																			<td></td>
																			<td></td>
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
                                    <th>section</th>
                                    <th>Hz Area</th>
                                    <th>D area</th>
                                    <th>Mandays</th>
                                    <th>DR hz<br/>(mixer)</th>
                                    <th>DR Hz<br/>(paniwala)</th>
                                    <th>DRUM<br/>(Short)</th>
                                    <th>Mandays<br/>(MR DBLY)</th>
                                    <th>NL Mandays<br/>(DR DBLY)</th>
                                    <th>Mandays<br/>(DR DUbly)</th>
                                    <th>Mandays<br/>(M/C Dubly)</th>
                                    <th>DR Dbly<br/>(Mixer)</th>
                                    <th>DR dbly<br/>(Paniwala)</th>
                                    <th>Cocktail</th>
                                    <th>Pest and <br/>Disease</th>
                                    <th>Intensity Of<br/>Infection</th>
                                    <th>No Drums<br/>Sprayed</th>
                                    <th>INS 1</th>
                                    <th>DOSE</th>
                                    <th>INS 1<br/> (QTY)</th>
                                    <th>INS 2</th>
                                    <th>DOSE</th>
                                    <th>INS 2<br/>(QTY)</th>
                                    <th>ACC 3</th>
                                    <th>DOSE</th>
                                    <th>ACC 3 <br/>(QTY)</th>
                                    <th>SYTH 4</th>
                                    <th>DOSE</th>
                                    <th>SYTH 4<br/>(QTY)</th>
                                    <th>STR 5</th>
                                    <th>DOSE</th>
                                    <th>STR 5<br/>(QTY)</th>
                                    <th>FNG 6</th>
                                    <th>DOSE</th>
                                    <th>FNG 6<br/>(QTY)</th>
                                    <th>WDC 7</th>
                                    <th>DOSE</th>
                                    <th>WDC 7<br/>(QTY)</th>
                                    <th>WDC 8</th>
                                    <th>DOSE</th>
                                    <th>WDC 8<br/>(QTY)</th>
                                    <th>UREA</th>
                                    <th>DOSE</th>
                                    <th>NTR 9<br/>(QTY)</th>
                                    <th>ZINC</th>
                                    <th>DOSE</th>
                                    <th>NTR 10<br/>(QTY)</th>
                                    <th>BORON</th>
                                    <th>DOSE</th>
                                    <th>NTR 11<br/>(QTY)</th>
																		<th>Other1<br/>Name</th>
                                    <th>Othrer1<br/> DOSE</th>
                                    <th>Other1<br/>(QTY)</th>
																		<th>Other2<br/>Name</th>
                                    <th>Othrer2<br/> DOSE</th>
                                    <th>Other2<br/>(QTY)</th>
																		<th>Other3<br/>Name</th>
                                    <th>Othrer3<br/> DOSE</th>
                                    <th>Other3<br/>(QTY)</th>
                                </tr>
                             </thead>
														<tbody>
															<?php
															 //echo "need some post value to be checked";
																//var_dump($_POST);
																if(isset($_POST['sec_date_submit'])) {
																	while($req_day_spray = mysqli_fetch_assoc($result_spray)) {
																		//var_dump($req_day_spray); echo "<hr>";
															?>
																		<tr>
																			<td><?php echo $req_day_spray['record_date']; ?></td>
																			<td><?php echo $req_day_spray['short_sec_name']; ?></td>
																			<td><?php echo $req_day_spray['hz_area']; ?></td>
																			<td><?php echo $req_day_spray['db_area']; ?></td>
																			<td><?php echo $req_day_spray['hz_mandays']; ?></td>
																			<td><?php echo $req_day_spray['dr_hz_mix']; ?></td>
																			<td><?php echo $req_day_spray['dr_hz_pani']; ?></td>
																			<td><?php echo $req_day_spray['drum_short']; ?></td>
																			<td><?php echo $req_day_spray['mr_db_mnds']; ?></td>
																			<td><?php echo $req_day_spray['dr_db_nl_mnds']; ?></td>
																			<td><?php echo $req_day_spray['dr_db_mnds']; ?></td>
																			<td><?php echo $req_day_spray['mc_db_mnds']; ?></td>
																			<td><?php echo $req_day_spray['dr_db_mix']; ?></td>
																			<td><?php echo $req_day_spray['dr_db_pani']; ?></td>
																			<td><?php echo $req_day_spray['cocktail']; ?></td>
																			<td><?php echo $req_day_spray['pest_disease']; ?></td>
																			<td><?php echo $req_day_spray['infctn_intensity']; ?></td>
																			<td><?php echo $req_day_spray['drums_sprayed']; ?></td>
																			<td><?php echo $req_day_spray['ins1_nm']; ?></td>
																			<td><?php echo $req_day_spray['ins1_dose']; ?></td>
																			<td><?php echo $req_day_spray['ins1_qty']; ?></td>
																			<td><?php echo $req_day_spray['ins2_nm']; ?></td>
																			<td><?php echo $req_day_spray['ins2_dose']; ?></td>
																			<td><?php echo $req_day_spray['ins2_qty']; ?></td>
																			<td><?php echo $req_day_spray['acc3_nm']; ?></td>
																			<td><?php echo $req_day_spray['acc3_dose']; ?></td>
																			<td><?php echo $req_day_spray['acc3_qty']; ?></td>
																			<td><?php echo $req_day_spray['synth4_nm']; ?></td>
																			<td><?php echo $req_day_spray['synth4_dose']; ?></td>
																			<td><?php echo $req_day_spray['synth4_qty']; ?></td>
																			<td><?php echo $req_day_spray['str5_nm']; ?></td>
																			<td><?php echo $req_day_spray['str5_dose']; ?></td>
																			<td><?php echo $req_day_spray['str5_qty']; ?></td>
																			<td><?php echo $req_day_spray['fng6_nm']; ?></td>
																			<td><?php echo $req_day_spray['fng6_dose']; ?></td>
																			<td><?php echo $req_day_spray['fng6_qty']; ?></td>
																			<td><?php echo $req_day_spray['wdc7_nm']; ?></td>
																			<td><?php echo $req_day_spray['wdc7_dose']; ?></td>
																			<td><?php echo $req_day_spray['wdc7_qty']; ?></td>
																			<td><?php echo $req_day_spray['wdc8_nm']; ?></td>
																			<td><?php echo $req_day_spray['wdc8_dose']; ?></td>
																			<td><?php echo $req_day_spray['wdc8_qty']; ?></td>
																			<td><?php echo $req_day_spray['urea']; ?></td>
																			<td><?php echo $req_day_spray['u_dose']; ?></td>
																			<td><?php echo $req_day_spray['ntr9_qty']; ?></td>
																			<td><?php echo $req_day_spray['zinc']; ?></td>
																			<td><?php echo $req_day_spray['z_dose']; ?></td>
																			<td><?php echo $req_day_spray['ntr10_qty']; ?></td>
																			<td><?php echo $req_day_spray['boron']; ?></td>
																			<td><?php echo $req_day_spray['b_dose']; ?></td>
																			<td><?php echo $req_day_spray['ntr11_qty']; ?></td>
																			<td><?php echo $req_day_spray['othr1_nm']; ?></td>
																			<td><?php echo $req_day_spray['othr1_dose']; ?></td>
																			<td><?php echo $req_day_spray['othr1_qty']; ?></td>
																			<td><?php echo $req_day_spray['othr2_nm']; ?></td>
																			<td><?php echo $req_day_spray['othr2_dose']; ?></td>
																			<td><?php echo $req_day_spray['othr2_qty']; ?></td>
																			<td><?php echo $req_day_spray['othr3_nm']; ?></td>
																			<td><?php echo $req_day_spray['othr3_dose']; ?></td>
																			<td><?php echo $req_day_spray['othr3_qty']; ?></td>
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
    </body>
</html>
