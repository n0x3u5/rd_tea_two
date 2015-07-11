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
if(isset($_POST['yr_sec_submit'])) {
	$req_div = $_SESSION['current_div'];
	$req_ssn = $_POST['short_sec_name'];
	$req_start_yr = $_POST['start_yr'];
	$req_end_yr = $_POST['end_yr'];

	// var_dump($req_ssn); var_dump($req_start_yr); var_dump($req_end_yr);

	// $_SESSION['ssn'] = $req_ssn;
	// $_SESSION['yr_1'] = $req_start_yr;
	// $_SESSION['yr_2'] = $req_end_yr;
	$q_header = "select * from sections where short_sec_name = '{$req_ssn}' and division = '{$_SESSION['current_div']}'"; //and division = '{$req_div}'";
	//var_dump($q_header);
	$r_header = mysqli_query($connection, $q_header);
	confirm_query($r_header);

	$header = mysqli_fetch_assoc($r_header);
	//var_dump($header);

	$q_prune = "select * from yearly_prune_infilling where short_sec_name = '{$req_ssn}' and division = '{$req_div}' and year between $req_start_yr and $req_end_yr";
	//var_dump($q_prune);
	$r_prune = mysqli_query($connection, $q_prune);
	confirm_query($r_prune);

	//$prune = mysqli_fetch_assoc($r_prune);
	//var_dump($prune);

	$q_soil = "select * from yearly_soil_manuring where short_sec_name = '{$req_ssn}' and division = '{$req_div}' and year between $req_start_yr and $req_end_yr";
	//var_dump($q_soil);
	$r_soil = mysqli_query($connection, $q_soil);
	confirm_query($r_soil);

	//$soil = mysqli_fetch_assoc($r_soil);
	//var_dump($soil);
}
else {
	$req_ssn = NULL;
	$req_start_yr = NULL;
	$req_end_yr = NULL;
	$result = NULL;

	$soil = NULL;
	$prune = NULL;
	$header = NULL;
}
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>R.D. Tea | Yearly Sectional Review</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
				<link rel="stylesheet" href="https://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.css">
				<link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css">
				<link rel="stylesheet" href="css/stylesheet.css">
				<style rel="stylesheet">
					.card_style{
						margin-left:6%;
						margin-bottom:1%;
						background-color:#FFFFFF;
						border-style: outset;
					}
					.nav-tabs.nav-justified > .active > a, .nav-tabs.nav-justified > .active > a:hover, .nav-tabs.nav-justified > .active > a:active, .nav-tabs.nav-justified > .active > a:enabled {
					background-color: #BF360C !important;
					border-bottom-color: #5D4037;
					color: #FFFFFF;
					}

				</style>
        <link rel="icon" href="images/logo_rdtea.png"/>
        <?php $page_id = 4;?>
    </head>
    <body>
        <?php
            include("nav_bar.php");
            nav_echoer($page_id);
        ?>
        <div class="container">
            <div class="jumbotron" style="background:#FFA000;margin-left:-15px;margin-right: -15px;">
                <h1 style="color:#3A3A3D">Sectional Review </h1>
                <p style="color:#3A3A3D">(Yearly)</p>
								<form action="sectional_yearly_review.php" class="form form-horizotal" method="post">
									<div class="row">
										<div class="form-group col-sm-5">
											<label for="section" style="color:#FFF8E1">Select section:</label>
											<div>
												<select id="section" name ="short_sec_name" class="form-control" onChange="enable_add()" >
													 <?php
															$q = "SELECT short_sec_name FROM sections WHERE division = '{$_SESSION['current_div']}'";
															$result = mysqli_query($connection, $q);

															confirm_query($result);

															echo "<option id=\"opt0\" value=\"Select a section\">Select a section</option>";
															while($sec_values = mysqli_fetch_assoc($result)) {
													?>
																<option value="<?php echo htmlentities($sec_values['short_sec_name']) ?>" <?php if(($req_ssn != NULL) && ($req_ssn == $sec_values['short_sec_name'])) { echo "selected";} ?> ><?php echo htmlentities($sec_values['short_sec_name']); ?></option>
													<?php
															}
													?>
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="form-group col-sm-5" >
											<label for="year1" style="color:#FFF8E1">Start Year:</label>
											<div>
											<input type="text" id="year1" class="form-control" name="start_yr"<?php if($req_start_yr != NULL) { ?> value="<?php echo "$req_start_yr"; ?>"<?php } else {?>  placeholder=<?php echo "\"Select start Year\""; ?><?php } ?> required>

											</div>
										</div>
									</div>

									<div class="row">
										<div class="form-group col-sm-5" >
											<label for="year2" style="color:#FFF8E1">End Year:</label>
											<div>
											<input type="text" id="year1" class="form-control" name="end_yr"<?php if($req_end_yr != NULL) { ?> value="<?php echo "$req_end_yr"; ?>"<?php } else {?>  placeholder=<?php echo "\"Select end Year\""; ?><?php } ?> required>

											</div>
										</div>
									</div>

									<input type="submit" id="hide_me" name="yr_sec_submit" value="Get data" class="btn btn-default">
							</form>
            </div>

						<?php if($header != NULL) {?>
            <div class="row">
              <div class="col-sm-2 card_style"><h4>Section Name</h4><p> <?php echo $header['sec_name']; ?> </p></div>
							<div class="col-sm-2 card_style"><h4>Area</h4>(in Hectare)<p> <?php echo htmlentities($header['total_area']); ?> </p></div>
							<div class="col-sm-2 card_style"><h4>Year of Planting</h4><p> <?php echo htmlentities($header['yr_of_plant']); ?> </p></div>
							<div class="col-sm-2 card_style"><h4>Plant spacing</h4><p> <?php echo htmlentities($header['plant_spacing']); ?> </p></div>
            </div>
            <div class="row">
							<div class="col-sm-2 card_style"><h4>Shade (perm.) Species</h4><p> <?php echo $header['shade_spcs_perm']; ?> </p></div>
							<div class="col-sm-2 card_style"><h4>Permanent Shade Spacing</h4><p> <?php echo htmlentities($header['perm_shd_spcing']); ?> </p></div>
							<div class="col-sm-2 card_style"><h4>Shade(temp) Species</h4><p> <?php echo $header['shade_spcs_temp']; ?> </p></div>
							<div class="col-sm-2 card_style"><h4>Temporary shade spacing</h4><p> <?php echo htmlentities($header['temp_shd_spcing']); ?> </p></div>
						</div>
						<div class="row">
							<div class="col-sm-2 card_style"><h4>Jat/Clone</h4><p> <?php echo $header['jat']; ?> </p></div>
							<div class="col-sm-2 card_style"><h4>Plant Density per Ha.</h4><p> <?php echo htmlentities($header['plant_density']); ?> </p></div>
							<div class="col-sm-2 card_style"><h4>Total Bush<br>popolation</h4><p> <?php echo htmlentities($header['bush_pop']); ?> </p></div>
							<div class="col-sm-2 card_style"><h4>Drain-status</h4><p> <?php echo htmlentities($header['drain_stats']); ?> </p></div>
						</div>
						<div class="row">
							<div class="col-sm-2 card_style"><h4>Frame(in Inch) HEight</h4><p> <?php echo htmlentities($header['frame_height']); ?> </p></div>
							<div class="col-sm-2 card_style"><h4>Bush(in Inch)<br>Height</h4><p> <?php echo htmlentities($header['bush_height']); ?> </p></div>
							<div class="col-sm-2 card_style"><h4>Ext./<br>Replant</h4><p> <?php echo htmlentities($header['ext_rplnt']); ?> </p></div>
							<div class="col-sm-2 card_style"><h4>Soil type and<br>topography</h4><p> <?php echo htmlentities($header['soil_topo']); ?> </p></div>
						</div>

						<?php
						}
						?>

            <div class="tab-container" style="margin-top:10px;">
                <ul class="nav nav-tabs nav-justified">
                    <li class="active"><a href="#tab1" data-toggle="tab">Prune </a></li>
                    <li><a href="#tab2" data-toggle="tab">Soil  </a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab1">
                            <table  id="prune_year" class="display table table-hover" border="1" cellspacing="0" width="100%">
                                <thead >
                                    <tr>
                                        <th rowspan="2"   style="text-align:center padding:2 0 2 0 ">Year</th>
                                        <th rowspan="2"   style="text-align:center">Prune</th>
                                        <th rowspan="2"   style="text-align:center">Tipping</th>
                                        <th rowspan="2"   style="text-align:center">Made Tea<br>(in Kg/Ha)</th>
                                        <th rowspan="2"   style="text-align:center">Vacancy<br>(in %)</th>
                                        <th rowspan="2"   style="text-align:center">Shade<br> Status</th>
                                        <th colspan="2"   style="text-align:center">Infilling
                                        </th>
                                        <th rowspan="2"  style="text-align:center">Remarks</th>
                                    </tr>
                                    <tr>
                                        <th>Tea</th>
                                        <th>Shade</th>
                                    </tr>
                                </thead>
                                <tbody>
																	<?php
																		if(isset($_POST['yr_sec_submit'])) {
																			while($prune = mysqli_fetch_assoc($r_prune)) {

																	?>
                                    <tr>
                                        <td   style="text-align:center"> <?php echo $prune['year']; ?> </td>
                                        <td   style="text-align:center"> <?php echo $prune['prune']; ?> </td>
                                        <td   style="text-align:center"> <?php echo $prune['tipping']; ?> </td>
                                        <td   style="text-align:center"> <?php echo $prune['made_tea']; ?> </td>
                                        <td   style="text-align:center"> <?php echo $prune['vacancy']; ?> </td>
                                        <td   style="text-align:center"> <?php echo $prune['shade_status']; ?> </td>
                                        <td   style="text-align:center"> <?php echo $prune['infill_tea']; ?> </td>
                                        <td   style="text-align:center"> <?php echo $prune['infill_shade']; ?> </td>
                                        <td   style="text-align:center"> <?php echo $prune['remarks']; ?> </td>
                                    </tr>
																	<?php
																			}
																		}
																	?>
                                </tbody>
                            </table>
                    </div>
                    <div class="tab-pane" id="tab2">
                        <table  id="soil_year" class="table table-hover display" border="1" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th rowspan="2">Year</th>
                                    <th colspan="3">Manuring Kg/Ha</th>
                                    <th rowspan="2">Top(in pH)</th>
                                    <th rowspan="2">SUb (in pH)</th>
                                    <th rowspan="2">Org C  (in %)</th>
                                    <th rowspan="2">Avbl P(in ppm)</th>
                                    <th rowspan="2">Avbl k (in ppm)</th>
                                    <th rowspan="2">Avbl N (in %)</th>
                                    <th rowspan="2">Avbl S(in ppm)</th>

                                </tr>
                                <tr>
                                    <th>N</th>
                                    <th>P</th>
                                    <th>k</th>
                                </tr>
                            </thead>
                            <tbody>
															<?php
																if(isset($_POST['yr_sec_submit'])) {
																	while($soil = mysqli_fetch_assoc($r_soil)) {
															?>
                                <tr>
                                    <td   style="text-align:center"> <?php echo $soil['year']; ?> </td>
                                    <td   style="text-align:center"> <?php echo $soil['n']; ?> </td>
                                    <td   style="text-align:center"> <?php echo $soil['p']; ?> </td>
                                    <td   style="text-align:center"> <?php echo $soil['k']; ?> </td>
                                    <td   style="text-align:center"> <?php echo $soil['top_pH']; ?> </td>
                                    <td   style="text-align:center"> <?php echo $soil['sub_pH']; ?> </td>
                                    <td   style="text-align:center"> <?php echo $soil['org_C']; ?> </td>
                                    <td   style="text-align:center"> <?php echo $soil['avbl_P']; ?> </td>
                                    <td   style="text-align:center"> <?php echo $soil['avbl_K']; ?> </td>
                                    <td   style="text-align:center"> <?php echo $soil['avbl_N']; ?> </td>
                                    <td   style="text-align:center"> <?php echo $soil['avbl_S']; ?> </td>
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

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <script src="http://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
        <script src="http://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js">
        </script>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment-with-locales.min.js"></script>
				<script src="scripts/bootstrap-datetimepicker.min.js"></script>

        <script>
            $(document).ready(function() {
							$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
						    e.target // activated tab
						    e.relatedTarget // previous tab
						    var table = $.fn.dataTable.fnTables(true);
						    if (table.length > 0) {
					        $(table).dataTable().fnAdjustColumnSizing();
						    }
							});
               $('#prune_year').dataTable({"scrollX": true});
               $('#soil_year').dataTable({"scrollX": true});
							$('#year1, #year2').datetimepicker({
								locale:'en',
								format:'YYYY'
							});
            });
        </script>
				<script>
				if(document.getElementById('year1').value!='')
				{
					document.getElementById('hide_me').disabled=false;
				}
			else {
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
