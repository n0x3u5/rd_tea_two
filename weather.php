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
	if(isset($_POST['div_date_submit'])) {
		//$req_year = $_POST['year_value'];
		$req_start_date = $_POST['start_date_value'];
		$req_end_date = $_POST['end_date_value'];

		$from = date('Y-m-d', strtotime($req_start_date));
	  $to = date('Y-m-d', strtotime($req_end_date));
	  $query = "select * from daily_weather where division = '$_SESSION[current_div]' and record_date between '$from' and '$to'";


	  //var_dump($query);

	  $result = mysqli_query($connection, $query);
	  confirm_query($result);
	}
	else {
		//$req_div_name = NULL;
		//$req_year = NULL;
		$req_start_date = NULL;
		$req_end_date = NULL;
		$result = NULL;
	}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>R.D. Tea | Daily Weather Report</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/stylesheet.css">
				<link rel="icon" href="images/logo_rdtea.png"/>
		<style>
			#get_data_btn{
				margin-top:10px;
			}
			.dataTables_length{
			}
			.input-group{
				margin-top:10px;
			}
			.card_style {
				margin-top: 30px;
			}
			.dataTables_filter{
				margin-top: 30px;
			}
			.dataTables_length{
				margin-top: 30px;
			}
		</style>
        <?php $page_id = 6;?>
    </head>
    <body>
        <?php
            include("nav_bar.php");
            nav_echoer($page_id);
        ?>
        <div class="container">
            <div class="jumbotron" style="background:#0277BD;margin-left:-15px;margin-right: -15px;">
                <h1>Divisional Weather Details </h1>
                <p></p>
                <p></p>
                <form style="" action="weather.php" method="post">
			              <div>
										<div class="form-group">
											<p style="color:#B3E5FC">Start date</p>
											<div class="input-group">
												<span class="input-group-addon">
														<i class="glyphicon glyphicon-calendar"></i>
												</span>

												<input type="text" name="start_date_value" class="form-control" id="datepicker1" <?php if($req_start_date !=NULL) { ?>value="<?php echo date('d-m-Y', strtotime($req_start_date));?>" <?php } else { ?>placeholder="Date (dd-mm-yyyy)"<?php } ?> onChange="enable_add()" required>
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
			              </div>
                  <button type="submit" name="div_date_submit" id="get_data_btn" class="btn btn-default">Get Data</button>
                </form>
            </div>

            <div class="card_style" style="background-color:#FFF">
                <div style="width:90%;margin:auto;">
                    <table id="weather" class="table table-hover" border="1">
                        <thead style="border: solid 2px black">
                            <tr>
                                <th rowspan="2">Date</th>
                                <th colspan="2">RainFall</th>
                                <th colspan="2">Temparature</th>
                                <th rowspan="2">Sunshine Hour</th>
                                <th rowspan="2">Weather condition</th>
                            </tr>
                            <tr>
                                <th>Day</th>
                                <th>Night</th>
                                <th>max</th>
                                <th>Min</th>
                            </tr>
                        </thead>
                        <tbody>
														<?php
															if (isset($_POST['div_date_submit'])) {
																while($weather = mysqli_fetch_assoc($result)) {
														?>
																	<tr>
																		<td><?php echo date('d-m-Y', strtotime($weather['record_date'])); ?></td>
																		<td><?php echo $weather['rain_day']; ?></td>
																		<td><?php echo $weather['rain_night']; ?></td>
																		<td><?php echo $weather['temp_max']; ?></td>
																		<td><?php echo $weather['temp_min']; ?></td>
																		<td><?php echo $weather['sun_shine_hr']; ?></td>
																		<td><?php echo $weather['weather_cond']; ?></td>
																	</tr>
														<?php
																}
														?>

                        </tbody>
                    </table>
                </div>
            </div>
      			<div class="card_style col-sm-12">
							<div style="width:90%;margin:auto;">
									<table id="total" class="table table-hover" border="1" style="margin-top:20px;">
											<h3 style="margin-top:40px;margin-bottom:10px;margin-left:40px;color:rgb(175,0,0)"><strong>Total</strong></h3>
											<thead style="border: solid 2px black">
													<tr>

															<th colspan="2">RainFall(Total)</th>
															<th colspan="2">Temparature (Avg.)</th>
															<th rowspan="2">Sunshine Hour</th>
															<th rowspan="2">Todate Railfall</th>
													</tr>
													<tr>
															<th>Day</th>
															<th>Night</th>
															<th>max</th>
															<th>Min</th>
													</tr>
											</thead>
											<tbody>
																<tr>
																	<td>
																		<?php
																				$query_sum= "SELECT SUM(rain_day) as day_sum FROM daily_weather WHERE division='{$_SESSION['current_div']}' AND record_date BETWEEN '$from' AND '$to'";
																				$result = mysqli_query($connection, $query_sum);
																			  confirm_query($result);

																				$sum_rain_day = mysqli_fetch_assoc($result);
																				$day_total = $sum_rain_day['day_sum'];
																				echo $sum_rain_day['day_sum'];
																		?>
																	</td>
																	<td>
																		<?php
																				$query_sum= "SELECT SUM(rain_night) as night_sum FROM daily_weather WHERE division='{$_SESSION['current_div']}' AND record_date BETWEEN '$from' AND '$to'";
																				$result = mysqli_query($connection, $query_sum);
																			  confirm_query($result);

																				$sum_rain_night = mysqli_fetch_assoc($result);
																				$night_total = $sum_rain_night['night_sum'];
																				echo $sum_rain_night['night_sum'];
																		?>
																	</td>
																	<td>
																		<?php
																				$query_avg= "SELECT AVG(temp_max) as max_temp_avg FROM daily_weather WHERE division='{$_SESSION['current_div']}' AND record_date BETWEEN '$from' AND '$to'";
																				$result = mysqli_query($connection, $query_avg);
																			  confirm_query($result);

																				$avg_max_temp = mysqli_fetch_assoc($result);
																				echo round ($avg_max_temp['max_temp_avg'], 2);
																		?>
																	</td>
																	<td>
																		<?php
																				$query_avg= "SELECT AVG(temp_min) as min_temp_avg FROM daily_weather WHERE division='{$_SESSION['current_div']}' AND record_date BETWEEN '$from' AND '$to'";
																				$result = mysqli_query($connection, $query_avg);
																			  confirm_query($result);

																				$avg_min_temp = mysqli_fetch_assoc($result);
																				echo round($avg_min_temp['min_temp_avg'], 2);
																		?>
																	</td>
																	<td>
																		<?php
																				$query_avg= "SELECT AVG(sun_shine_hr) as sunshine_avg FROM daily_weather WHERE division='{$_SESSION['current_div']}' AND record_date BETWEEN '$from' AND '$to'";
																				$result = mysqli_query($connection, $query_avg);
																			  confirm_query($result);

																				$avg_min_temp = mysqli_fetch_assoc($result);
																				echo round($avg_min_temp['sunshine_avg'], 2);
																		?>
																	</td>
																	<td>
																			<?php echo $day_total + $night_total;
																			?>
																	</td>
																</tr>
													<?php
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
        <script src="http://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js"></script>
	    	<script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js"></script>
				<script src="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
        <script>
          $(document).ready(function() {
            $('#weather').dataTable({
							"scrollX": true,
							"aoColumns": [
									{ "sType": "date-uk" },
									null,
									null,
									null,
									null,
									null,
									null,
							]
						});
						$('#total','#weather').dataTable({"scrollX": true});
          });
					jQuery.extend( jQuery.fn.dataTableExt.oSort, {
          "date-uk-pre": function ( a ) {
          var ukDatea = a.split('-');
          return (ukDatea[2] + ukDatea[1] + ukDatea[0]) * 1;
          },

          "date-uk-asc": function ( a, b ) {
          return ((a < b) ? -1 : ((a > b) ? 1 : 0));
          },

          "date-uk-desc": function ( a, b ) {
          return ((a < b) ? 1 : ((a > b) ? -1 : 0));
          }
        } );
        </script>
				<script type="text/javascript">
					$(function() {
						$( "#datepicker1, #datepicker2" ).datepicker({dateFormat: 'dd-mm-yy'});
					});
				</script>
    </body>
</html>
<?php
	end_connection($connection);
?>
