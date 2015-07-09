<?php
	require_once('includes/sessions.php');
	require_once('includes/functions.php');

	if(!isset($_SESSION['user'])) {
		redirect_to("index.php");
	}

	// var_dump($_SESSION['user_div']);
	// var_dump($_SESSION['current_div']);
	//var_dump($_POST['current_div']);
	if(($_SESSION['user_div'] != "ALL") && ($_SESSION['user_div'] != $_SESSION['current_div'])) {
		$_SESSION['flag_div_chk'] = 1;
		redirect_to("update_profile.php");
	}
	else {
		$_SESSION['flag_div_chk'] = 0;
	}
?>
<?php
	$connection = make_connection();

	//var_dump($_POST);echo "<br><hr>";
	if(isset($_POST["dt_sec_submit"])){
		$req_date = date('Y-m-d', strtotime($_POST["date_value"]));
		// var_dump($_SESSION['user_div']);
		if($_SESSION["user_div"] == "ALL") {
			$req_div = $_SESSION["current_div"];
		}
		else {
			$req_div = $_SESSION["user_div"];
		}
		$_SESSION['div_name'] = $req_div;
		$_SESSION['date'] = $req_date;


		// echo "<br>got date =".$req_date."<br>";
		// echo "<br>got div_name =" .$req_div_name."<br>";
		// var_dump($req_date);echo "<br>"; var_dump($req_div_name);

		$query = "SELECT * FROM daily_weather WHERE division='{$_SESSION['div_name']}' and record_date='{$req_date}' and division = '{$_SESSION['div_name']}'";
		// var_dump($query);
		$result = mysqli_query($connection, $query);
		confirm_query($result);

		$_SESSION['daily_weather'] = mysqli_fetch_assoc($result);
		$sub_enable=1;
		//$daily =mysqli_fetch_assoc($result);
	}
	else {
		$req_date = NULL;
		$req_div_name = NULL;
		$sub_enable=0;
	}
?>

<?php
	if (isset($_POST['add_submit'])) {
		$division = $_SESSION['div_name'];
		$record_date = $_SESSION['date'];
		//echo "division :".$division."<br>";
		$rain_day = (float) mysqli_real_escape_string($connection, $_POST["rain_day"]);
		$rain_night = (float) mysqli_real_escape_string($connection, $_POST["rain_night"]);
		$temp_max = (float) mysqli_real_escape_string($connection, $_POST["temp_max"]);
		$temp_min = (float) mysqli_real_escape_string($connection, $_POST["temp_min"]);
		$sun_shine_hr = (float) mysqli_real_escape_string($connection, $_POST["sun_shine_hr"]);
		$weather_cond = mysqli_real_escape_string($connection, $_POST["weather_cond"]);

		$query = "INSERT INTO daily_weather (";
		$query .= " division, record_date, rain_day, rain_night, temp_max, temp_min,";
		$query .= " sun_shine_hr, weather_cond )";
		$query .= " VALUES ('{$division}', '{$record_date}', {$rain_day}, {$rain_night}, {$temp_max}, {$temp_min}, {$sun_shine_hr}, '{$weather_cond}')";
		// var_dump($query);
		$result = mysqli_query($connection, $query);
		confirm_query($result);
		if(mysqli_affected_rows($connection) > 0) { ?>
			<div class=" container alert alert-success alert-dismissible" style="border-color:green" role="alert">
  			<button type="button" class="close" data-dismiss="alert" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
  			<strong>Success!</strong> Inserted Successfully!
			</div>
		<?php }
		else { ?>
			<div class=" container alert alert-warning alert-dismissible" role="alert" style="border-color:yellow">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
				<strong>Sorry!</strong> No row affected!
			</div>


		<?php }

		$q = "select * from weather_change where id = (select max(id) from weather_change)";
		$r = mysqli_query($connection, $q);
		confirm_query($r);
		$wth_chng = mysqli_fetch_assoc($r);
		//var_dump($wth_chng);
		//echo "<br>user_name".$_SESSION['user'];
		$q = "UPDATE weather_change SET changed_by = '{$_SESSION['user']}' WHERE id = ({$wth_chng['id']})";
		$r = mysqli_query($connection, $q);
		confirm_query($r);

		//echo "Inserted Successfully!";

		$_SESSION['daily_weather'] = NULL;
		$_SESSION['date'] = NULL;
		$_SESSION['div_name'] = NULL;
	}

	if(isset($_POST['edit_submit'])) {

		$division = $_SESSION['div_name'];
		$record_date = $_SESSION['date'];
		$req_id = $_SESSION['daily_weather']['id'];

		$rain_day = (float) mysqli_real_escape_string($connection, $_POST["rain_day"]);
		$rain_night = (float) mysqli_real_escape_string($connection, $_POST["rain_night"]);
		$temp_max = (float) mysqli_real_escape_string($connection, $_POST["temp_max"]);
		$temp_min = (float) mysqli_real_escape_string($connection, $_POST["temp_min"]);
		$sun_shine_hr = (float) mysqli_real_escape_string($connection, $_POST["sun_shine_hr"]);
		$weather_cond = mysqli_real_escape_string($connection, $_POST["weather_cond"]);

		$typed_req_id = (int)$req_id;

		$query = "UPDATE daily_weather SET";
		$query .= " division='{$division}', record_date='{$record_date}', rain_day={$rain_day}, rain_night={$rain_night},";
		$query .= " temp_max={$temp_max}, temp_min={$temp_min}, sun_shine_hr={$sun_shine_hr}, weather_cond='{$weather_cond}' WHERE id={$typed_req_id}";

		// var_dump($query);

		$result = mysqli_query($connection, $query);
		confirm_query($result);
		if(mysqli_affected_rows($connection) > 0) { ?>
			<div class=" container alert alert-success alert-dismissible" style="border-color:green" role="alert">
  			<button type="button" class="close" data-dismiss="alert" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
  			<strong>Success!</strong> Edited Successfully!
			</div>
		<?php }
		else { ?>
			<div class=" container alert alert-warning alert-dismissible" role="alert" style="border-color:yellow">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
				<strong>Sorry!</strong> No row affected!
			</div>
<?php }
		$q = "select * from weather_change where id = (select max(id) from weather_change)";
		$r = mysqli_query($connection, $q);
		confirm_query($r);
		$wth_chng = mysqli_fetch_assoc($r);
		//var_dump($wth_chng);
		//echo "<br>user_name".$_SESSION['user'];
		$q = "UPDATE weather_change SET changed_by = '{$_SESSION['user']}' WHERE id = ({$wth_chng['id']})";
		$r = mysqli_query($connection, $q);
		confirm_query($r);

		$_SESSION['daily_weather'] = NULL;
		$_SESSION['date'] = NULL;
		$_SESSION['div_name'] = NULL;
	}

	if(isset($_POST['del_entry'])) {
		$division = $_SESSION['div_name'];
		$record_date = $_SESSION['date'];

		$query = "DELETE FROM daily_weather WHERE division='{$division}' and record_date='{$record_date}'";
		// var_dump($query);
		$result = mysqli_query($connection, $query);
		confirm_query($result);
		if(mysqli_affected_rows($connection) > 0) { ?>
			<div class=" container alert alert-success alert-dismissible" style="border-color:green" role="alert">
  			<button type="button" class="close" data-dismiss="alert" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
  			<strong>Success!</strong> Deleted Successfully!
			</div>
		<?php }
		else { ?>
			<div class=" container alert alert-warning alert-dismissible" role="alert" style="border-color:yellow">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
				<strong>Sorry!</strong> No row affected!
			</div>
<?php }
		$q = "select * from weather_change where id = (select max(id) from weather_change)";
		$r = mysqli_query($connection, $q);
		confirm_query($r);
		$wth_chng = mysqli_fetch_assoc($r);
		//var_dump($wth_chng);
		//echo "<br>user_name".$_SESSION['user'];
		$q = "UPDATE weather_change SET changed_by = '{$_SESSION['user']}' WHERE id = ({$wth_chng['id']})";
		$r = mysqli_query($connection, $q);
		confirm_query($r);

		$_SESSION['daily_weather'] = NULL;
		$_SESSION['date'] = NULL;
		$_SESSION['div_name'] = NULL;
	}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>R.D. Tea | Daily Weather Entry</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
        <link rel="stylesheet" href="css/stylesheet.css">
				<style>
						@media screen and (min-width: 500px) {
							#delete_weather{
								margin-left:27%;
							}
  						}

							.nav-tabs.nav-justified > .active > a, .nav-tabs.nav-justified > .active > a:hover, .nav-tabs.nav-justified > .active > a:active, .nav-tabs.nav-justified > .active > a:enabled {
							background-color: #01579B !important;
							border-bottom-color: #5D4037;
							color: #FFFFFF;
							}
				</style>
				<link rel="icon" href="images/logo_rdtea.png"/>
        <?php $page_id = 8;?>

    </head>
    <body>
        <?php
            include("nav_bar.php");
            nav_echoer($page_id);
        ?>
        <div class="container">
            <div class="jumbotron" style="background:#0288D1;margin-left:-15px;margin-right: -15px;">
                <h1>Divisional Weather Entry</h1>
                <p></p>
                <p></p>
				<form action="weather_input.php" method="post" class="form-horizontal">
					<div class="form-group">
						<!-- <label for="division" class="col-sm-1 control-label" style="margin-right:0;">Division</label>
						<div class="col-sm-4">
							<select id="division" name="div_name" class="form-control">
							  <option></option>
							  <option <?php //if($req_div_name == 'Balasan') { echo "selected"; }  ?> >Balasan</option>
							  <option <?php //if($req_div_name == 'Bidhannagar') { echo "selected"; }  ?> >Bidhannagar</option>
							  <option <?php //if($req_div_name == 'Hansqua') { echo "selected"; }  ?> >Hansqua</option>
							  <option <?php //if($req_div_name == 'Kishoribag') { echo "selected"; }  ?> >Kishoribag</option>
							</select>
						</div> -->
					</div>
					<div class="form-group">
						<label for="datepicker" class="col-sm-1 control-label" style="margin-top:5px;margin-right:0;">Date</label>
						<div class=" input-group col-sm-4">
							<span class="input-group-addon">
									<i class="glyphicon glyphicon-calendar"></i>
							</span>
								<input type="text" name="date_value" class="form-control" id="datepicker" <?php if($req_date !=NULL) { ?>value="<?php echo date('d-m-Y', strtotime($req_date));?>" <?php } else { ?>placeholder="Date (dd-mm-yyyy)"<?php } ?> required>

						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-11 col-sm-offset-1">
							<input type="submit" name="dt_sec_submit" class="btn btn-default" id="unhide" value="Submit" style="width:auto;" onclick="unhide_button()">
						</div>
					</div>
				</form>
            </div>

            <div class="tab-container">
              <ul class="nav nav-tabs nav-justified">
                  <li id="ac_one"><a href="#tab1" id="take1" data-toggle="tab" style="color:#666">Edit Entry</a></li>
                  <li id="ac_two"><a href="#tab2" data-toggle="tab" id="take2" style="color:#666">Add Entry</a></li>
              </ul>
              <div class="tab-content" style="background-color:#FFFFFF">
                <div class="tab-pane" id="tab1">
                    <form class="form group" style="margin-top:15px;" action="weather_input.php" method="post">
										  <?php if(isset($_SESSION['daily_weather'])) { $daily = $_SESSION['daily_weather']; } else { $daily = NULL; }?>
										  <div class="input-group">
                        <label for="max_rain">RainFall during Day (in mm)</label>
                        <input type="text" name="rain_day" <?php if (isset($daily)) { ?> value="<?php echo $daily['rain_day']; ?>" <?php } else { ?> placeholder= <?php echo "\"Max Rainfall (in mm)\""; ?> <?php } ?> class="form form-control max_rain">
                      </div>
                      <div class="input-group">
                          <label for="min_rain">RainFall during Night (in mm)</label>
                          <input type="text" name="rain_night" <?php if (isset($daily)) { ?> value="<?php echo $daily['rain_night']; ?>" <?php } else { ?> placeholder= <?php echo "\"Min Rainfall (in mm)\""; ?> <?php } ?> class="form form-control min_rain">
                      </div>
                      <div class="input-group">
                        <label for="max_temp">Temparature Maximum( in &degC)</label>
                        <input type="text" id="unhide_two" name="temp_max" <?php if (isset($daily)) { ?> value="<?php echo $daily['temp_max']; ?>" <?php } else { ?> placeholder= <?php echo "\"Max Temparature\""; ?> <?php } ?> class="form form-control max_temp" required>
                      </div>
                      <div class="input-group">
                        <label for="min_temp">Temparature Minimum (in &degC)</label>
                        <input type="text" name="temp_min"  <?php if (isset($daily)) { ?> value="<?php echo $daily['temp_min']; ?>" <?php } else { ?> placeholder= <?php echo "\"Min Temparature\""; ?> <?php } ?>  class="form form-control min_temp" required>
                      </div>
                      <div class="input-group">
                        <label for="sun_hour">Sunshine Hour</label>
                        <input type="text" name="sun_shine_hr"  <?php if (isset($daily)) { ?> value="<?php echo $daily['sun_shine_hr']; ?>" <?php } else { ?> placeholder= <?php echo "\"Sunshine Hour (in mm)\""; ?> <?php } ?>  class="form form-control sun_hour">
                      </div>
                      <div class="input-group">
                        <label for="weath_cond">Weather Condition</label>
                        <input type="text" name="weather_cond"  <?php if (isset($daily)) { ?> value="<?php echo $daily['weather_cond']; ?>" <?php } else { ?> placeholder= <?php echo "\"Weather Condition\""; ?> <?php } ?>  class="form form-control weath_cond">
                      </div>
                      <input type="submit" id="edit_weather" name="edit_submit" class="btn btn-success" value="Edit Entry" style="margin:10px 0 10px 0px;position:relative;">
                      <input type="button" id="delete_weather" class="btn btn-danger" value="Delete Entry"  data-toggle="modal" data-target="#deleteModal">
											<!-- Modal -->
												<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
												  <div class="modal-dialog" role="document">
												    <div class="modal-content">
												      <div class="modal-header">
												        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
												        <h4 class="modal-title" id="myModalLabel">Remove Entry</h4>
												      </div>
												      <div class="modal-body">
												        Are really sure?
												      </div>
												      <div class="modal-footer">
												        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
												        <input type="submit" name="del_entry" class="btn btn-danger" value="Yes! Delete it!">
												      </div>
												    </div>
												  </div>
												</div>
                  </form>
                </div>


                <div class="tab-pane" id="tab2">
                    <form class="form group" style="margin-top:15px;" action="weather_input.php" method="post">
                      <div class="input-group">
                        <label for="max_rain">RainFall during Day (in mm)</label>
                        <input type="text" name="rain_day" placeholder="Daytime Rainfall" class="form form-control max_rain">
                      </div>
                      <div class="input-group">
                          <label for="min_rain">RainFall during Night (in mm)</label>
                          <input type="text" name="rain_night" placeholder="Nighttime Rainfall" class="form form-control min_rain">
                      </div>
                      <div class="input-group">
                        <label for="max_temp">Temparature Maximum( in &degC)</label>
                        <input type="text"  name="temp_max" placeholder="Maximum Temparature" class="form form-control max_temp" required>
                      </div>
                      <div class="input-group">
                        <label for="min_temp">Temparature Minimum (in &degC)</label>
                        <input type="text" name="temp_min" placeholder="Minimum Temparature" class="form form-control min_temp" required>
                      </div>
                      <div class="input-group">
                        <label for="sun_hour">Sunshine Hour</label>
                        <input type="text" name="sun_shine_hr" placeholder="Sunshine Hour" class="form form-control sun_hour">
                      </div>
                      <div class="input-group">
                        <label for="weath_cond">Weather Condition</label>
                        <input type="text" name="weather_cond" placeholder="Weather Condition" class="form form-control weath_cond">
                      </div>
                      <input type="submit" id="add_weather"name="add_submit"  class="btn btn-success" value="Add Data" style="margin:10px 0 10px 20px;"><p></p>
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
            $("#datepicker").datepicker({dateFormat: 'dd-mm-yy'});
            });
        </script>
				<script>

						$("#edit_weather").click(	function(event){

							var currentDate = $( "#datepicker" ).datepicker( "getDate" );
							if(currentDate ==null)
									{	event.preventDefault();
										window.alert("Please Select a Date");
								}

							}
						);
						$("#delete_weather").click(	function(event){

								var currentDate = $( "#datepicker" ).datepicker( "getDate" );
								if(currentDate ==null)
									{	event.preventDefault();
										window.alert("Please Select a Date");
								}
							}
						);
						$("#add_weather").click(	function(event){

							var currentDate = $( "#datepicker" ).datepicker( "getDate" );
							if(currentDate ==null)
									{	event.preventDefault();
										window.alert("Please Select a Date");
								}
							}
						);
				</script>

				<?php
					echo"
							<script>
							document.getElementById('add_weather').disabled=true;
							document.getElementById('edit_weather').disabled=true;
							document.getElementById('delete_weather').disabled=true;
								document.getElementById('take1').disabled=true;
									document.getElementById('take2').disabled=true;
							if($sub_enable==1)
								{
									if(document.getElementById('unhide_two').value=='')
									{
												document.getElementById('take2').disabled=false;
											document.getElementById('add_weather').disabled=false;
										var b1=	document.getElementById('ac_two');
										var c1=document.getElementById('take2');
										b1.style.backgroundColor = '#01579B';
										c1.style.color = '#FFFFFF';
										var a1=document.getElementById('tab2');
										a1.setAttribute('class', 'active');
										document.getElementById('take1').disabled=true;
									}
									else{
											document.getElementById('take1').disabled=false;
										document.getElementById('edit_weather').disabled=false;
										document.getElementById('delete_weather').disabled=false;
										var b2=document.getElementById('ac_one');
										b2.style.backgroundColor = '#01579B';
										var c2=document.getElementById('take1');
										var a2=document.getElementById('tab1');
										a2.setAttribute('class', 'active');
										c2.style.color='#FFFFFF';
										document.getElementById('take2').disabled=true;
									}
								}
						</script>"
					?>

    </body>
</html>
<?php
	end_connection($connection);
?>
