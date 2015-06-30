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
	if(isset($_POST['div_date_submit'])) {
		//$req_div_name = $_POST['div_name'];
		//$req_year = $_POST['year_value'];
		$req_start_date = $_POST['start_date_value'];
		$req_end_date = $_POST['end_date_value'];

		$from = date('Y-m-d', strtotime($req_start_date));
	  $to = date('Y-m-d', strtotime($req_end_date));
	  $query = "select * from daily_weather where division = 'Hansqua' and record_date between '$from' and '$to'";


	  //var_dump($query);

	  $result = mysqli_query($connection, $query);
	  confirm_query($result);

	   //echo "<br>"; var_dump($result); echo "<br>";

	  // while($weather = mysqli_fetch_assoc($result))
	  // {
	  //  echo "<br>"; var_dump($weather);  echo "<br>";
	  // }

		// $query = "SELECT * FROM daily_weather WHERE division='{$req_div_name}' and date('Y',strtotime('record_date')='{req_year}')";
		//
		// $result = mysqli_query($connection, $query);
    // confirm_query($result);
		//
		// $_SESSION['daily_weather'] = mysqli_fetch_assoc($result);

		//$db_year = date('Y', strtotime($_SESSION['daily_weather']['record_date']));

		//echo "<br> year form db:".$db_year."<br>";
		//echo "<br> div name : ".$req_div_name."<br> req year : ".$req_year ."<br>";
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
        <title>R.D. Tea | Manage Sections</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/stylesheet.css">
		<style>
			.btn-default{
				margin-top:10px;
			}
			.dataTables_length{
				padding-top:10px;
			}
			.input-group{
				margin-top:10px;
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
            <div class="jumbotron" style="background:#2A47A3;margin-left:-15px;margin-right: -15px;">
                <h1>Divisional Weather Details </h1>
                <p></p>
                <p></p>
                <!-- <h3 style="color:#fff">Division</h3> -->

                <form style="" action="weather.php" method="post">
                    <!-- <select id="division" name="div_name" class="form-control input-group" style="height:60%;">
                    <option></option>
									  <option <?php //if($req_div_name == 'Balasan') { echo "selected"; }  ?> >Balasan</option>
									  <option <?php //if($req_div_name == 'Bidhannagar') { echo "selected"; }  ?> >Bidhannagar</option>
									  <option <?php //if($req_div_name == 'Hansqua') { echo "selected"; }  ?> >Hansqua</option>
									  <option <?php //if($req_div_name == 'Kishoribag') { echo "selected"; }  ?> >Kishoribag</option>
			              </select> -->

			              <div>
										<!-- <select id="start_year" name="year_value" class="form-control input-group">
												<option>Select year</option>
												<option <?php //if($req_year == 2015) { echo "selected"; }  ?> >2015</option>
												<option <?php //if($req_year == 2016) { echo "selected"; }  ?> >2016</option>
												<option <?php //if($req_year == 2017) { echo "selected"; }  ?> >2017</option>
												<option <?php //if($req_year == 2018) { echo "selected"; }  ?> >2018</option>
												<option <?php //if($req_year == 2019) { echo "selected"; }  ?> >2019</option>
										</select> -->
										<div class="form-group">
											<p>Start date</p>
											<div class="input-group">
												<input type="text" name="start_date_value" class="form-control" id="datepicker1" <?php if($req_start_date !=NULL) { ?>value="<?php echo date('d-m-Y', strtotime($req_start_date));?>" <?php } else { ?>placeholder="Date (dd-mm-yyyy)"<?php } ?> onChange="enable_add()">
												<span class="input-group-addon">
														<i class="glyphicon glyphicon-calendar"></i>
												</span>
											</div>
										</div>
										<p></p>
										<p></p>
										<div class="form-group">
											<p>End date</p>
											<div class="input-group">
												<input type="text" name="end_date_value" class="form-control" id="datepicker2" <?php if($req_end_date !=NULL) { ?>value="<?php echo date('d-m-Y', strtotime($req_end_date));?>" <?php } else { ?>placeholder="Date (dd-mm-yyyy)"<?php } ?> onChange="enable_add()">
												<span class="input-group-addon">
														<i class="glyphicon glyphicon-calendar"></i>
												</span>
											</div>
										</div>

			              </div>

                  <button type="submit" name="div_date_submit" class="btn btn-default">Get Data</button>
                </form>

            </div>

            <div class="row" style="background-color:#FFF">
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
																		<td><?php echo $weather['rain_max']; ?></td>
																		<td><?php echo $weather['rain_min']; ?></td>
																		<td><?php echo $weather['temp_max']; ?></td>
																		<td><?php echo $weather['temp_min']; ?></td>
																		<td><?php echo $weather['sun_shine_hr']; ?></td>
																		<td><?php echo $weather['weather_cond']; ?></td>
																	</tr>
														<?php
																}
															}
														?>
                            <!-- <tr>
                                <td>10-06-2015</td>
                                <td>0</td>
                                <td>90</td>
                                <td>25</td>
                                <td>20</td>
                                <td>8</td>
                                <td>9</td>
                            </tr>
                            <tr>
                                <td>11-06-2015</td>
                                <td>00</td>
                                <td>00</td>
                                <td>31</td>
                                <td>29</td>
                                <td>10</td>
                                <td>11</td>
                            </tr>
                            <tr>
                                <td>12-06-2015</td>
                                <td>80</td>
                                <td>100</td>
                                <td>35</td>
                                <td>29</td>
                                <td>7</td>
                                <td>11</td>
                            </tr>
                            <tr>
                                <td>13-06-2015</td>
                                <td>80</td>
                                <td>100</td>
                                <td>35</td>
                                <td>29</td>
                                <td>12</td>
                                <td>10</td>
                            </tr>
                            <tr>
                                <td>11-07-2015</td>
                                <td>0</td>
                                <td>90</td>
                                <td>25</td>
                                <td>20</td>
                                <td>8</td>
                                <td>9</td>
                            </tr>
                            <tr>
                                <td>11-07-2016</td>
                                <td>00</td>
                                <td>00</td>
                                <td>31</td>
                                <td>29</td>
                                <td>10</td>
                                <td>11</td>
                            </tr>
                            <tr>
                                <td>09-06-2016</td>
                                <td>80</td>
                                <td>100</td>
                                <td>35</td>
                                <td>29</td>
                                <td>7</td>
                                <td>11</td>
                            </tr>
                            <tr>
                                <td>10-09-2016</td>
                                <td>80</td>
                                <td>100</td>
                                <td>35</td>
                                <td>29</td>
                                <td>12</td>
                                <td>10</td>
                            </tr>
                            <tr>
                                <td>10-06-2017</td>
                                <td>0</td>
                                <td>90</td>
                                <td>25</td>
                                <td>20</td>
                                <td>8</td>
                                <td>9</td>
                            </tr>
                            <tr>
                                <td>13-07-2015</td>
                                <td>00</td>
                                <td>00</td>
                                <td>31</td>
                                <td>29</td>
                                <td>10</td>
                                <td>11</td>
                            </tr>
                            <tr>
                                <td>14-06-2015</td>
                                <td>80</td>
                                <td>100</td>
                                <td>35</td>
                                <td>29</td>
                                <td>7</td>
                                <td>11</td>
                            </tr>
                            <tr>
                                <td>27-06-2015</td>
                                <td>80</td>
                                <td>100</td>
                                <td>35</td>
                                <td>29</td>
                                <td>12</td>
                                <td>10</td>
                            </tr>
                            <tr>
                                <td>18-06-2015</td>
                                <td>0</td>
                                <td>90</td>
                                <td>25</td>
                                <td>20</td>
                                <td>8</td>
                                <td>9</td>
                            </tr>
                            <tr>
                                <td>18-07-2015</td>
                                <td>00</td>
                                <td>00</td>
                                <td>31</td>
                                <td>29</td>
                                <td>10</td>
                                <td>11</td>
                            </tr>
                            <tr>
                                <td>10-08-2016</td>
                                <td>80</td>
                                <td>100</td>
                                <td>35</td>
                                <td>29</td>
                                <td>7</td>
                                <td>11</td>
                            </tr> -->

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
	    <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js">
		</script>
		<script src="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready(function() {
                    $('#weather').dataTable({"scrollX": true});
            });
        </script>
				<script type="text/javascript">
						$(function() {
							$( "#datepicker1, #datepicker2" ).datepicker({dateFormat: 'dd-mm-yy'});
						});
				</script>
    </body>
</html>
