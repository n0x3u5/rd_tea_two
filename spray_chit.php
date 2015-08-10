<?php
	require_once('includes/sessions.php');
	require_once('includes/functions.php');

	if(!isset($_SESSION['user'])) {
		redirect_to("index.php");
	}
?>
<?php
	$connection = make_connection();
	if(isset($_POST['date_submit'])) {
		$req_div = $_SESSION['current_div'];
		$req_date = date('Y-m-d', strtotime( $_POST['date_value']));
		$req_hz_db = $_POST['hz_db'];

		$q_chemicals = "SELECT DISTINCT chem from spray_chit_table WHERE hz_db = '{$req_hz_db}'";
		$r_chemicals = mysqli_query($connection, $q_chemicals);
		confirm_query($r_chemicals);
	} else {
		$rec_div = NULL;
		$req_date = NULL;
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
					<form action="spray_chit.php" method="post">
						<div class="row">
							<div class="form-group col-sm-6">
								<label for="">Select Hz / DB:</label>
								<select class="form-control" id="hide_one" name="hz_db" onChange="enable_add()" required>
									<option <?php if(!isset($_POST['date_submit'])) {echo "selected";} ?> >Select Hz/Db</option>
									<option <?php if(isset($_POST['date_submit']) && $req_hz_db == "HZ") {echo "selected";} ?> >HZ</option>
									<option <?php if(isset($_POST['date_submit']) && $req_hz_db == "DB") {echo "selected";} ?> >DB</option>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-sm-6">
								<label for="">Select date:</label>
								<input type="text" id="datepicker" name="date_value" class="form-control" <?php if($req_date !=NULL) { ?>value="<?php echo date('d-m-Y', strtotime($req_date));?>" <?php } else { ?>placeholder="Date (dd-mm-yyyy)"<?php } ?> required>
							</div>
						</div>
						<input type="submit" value="Get data" name="date_submit" class="btn btn-success" id="hide_me">
					</form>
      </div>
      <div class="col-sm-12 card_style" style="margin-right:-15px">
        <form class="form-group" style="padding-top:20px;">
          <table id="spray_chit" class=" display table table-hover table-striped " border="1" cellspacing="0" width="100%">
            <thead style="2px solid green">
							<th>Item</th>
              <th>Section</th>
              <th>spot/Full</th>
              <th>Pest/<br/>Disease</th>
              <th>Area<br/>( in Ha.)</th>
							<th>Dose</th>
							<th>No of Drums</th>
							<th>Issued Qty</th>
							<th>Mandays<br/> (D/rated)</th>
							<th>Mandays<br/>(Supervisory)</th>
            </thead>
            <tbody>
						<?php
							if(isset($_POST['date_submit'])) {
								while($chemical = mysqli_fetch_assoc($r_chemicals)) {
									$printed_chem_arr = array();
									//var_dump($chemical['chem']);
									$q_chit = "select * from spray_chit_table where rec_dt = '{$req_date}' and hz_db = '{$req_hz_db}' and division = '{$req_div}' and chem = '{$chemical['chem']}'";
									$r_chit = mysqli_query($connection, $q_chit);
									confirm_query($r_chit);
									while ($chem_data = mysqli_fetch_assoc($r_chit)) {
										//var_dump($chem_data);
						?>
							<tr>
								<td><?php if(!in_array($chemical['chem'], $printed_chem_arr)) { echo $chemical['chem']; $printed_chem_arr[] = $chemical['chem']; } ?></td>
								<td><?php echo $chem_data['short_sec_name']."<br>"; ?></td>
								<td><?php echo $chem_data['spot_full']."<br>"; ?></td>
								<td><?php echo $chem_data['pest']."<br>"; ?></td>
								<td><?php echo $chem_data['area']."<br>"; ?></td>
								<td><?php echo $chem_data['dose']."<br>"; ?></td>
								<td><?php echo $chem_data['no_drums']."<br>"; ?></td>
								<td><?php echo $chem_data['qty_unit']."<br>"; ?></td>
								<td><?php echo $chem_data['dr_mnds']."<br>"; ?></td>
								<td><?php echo $chem_data['sup_mnds']."<br>"; ?></td>
							</tr>
							<!-- <tr>
								<td>CHEM1</td>
								<td>4W, 1EXTB</td>
								<td>Full, Spot</td>
								<td>Pest1, Pest1</td>
								<td>13.00, 3.12</td>
								<td>12 kg, 4 kg</td>
								<td>45, 32</td>
								<td>32, 23.9</td>
								<td>12.0, 44.1</td>
							</tr> -->
						<?php
									}
								}
							}
						?>
            </tbody>
          </table>
        </form>
      </div>
  	</div>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="http://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script src="http://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js"></script>
		<script src="https://cdn.datatables.net/fixedcolumns/3.0.4/js/dataTables.fixedColumns.min.js"></script>
    <script>
			document.getElementById('hide_me').disabled=true;
			$(document).ready( function () {
				var table = $('#spray_chit').DataTable( {
						"scrollX": "100%",
						"order": [],
						"scrollCollapse": true,
						columnDefs: [
				            { width: '10%', targets: 0 }
				        ]
				} );
				new $.fn.dataTable.FixedColumns( table );
				$("#datepicker").datepicker({
					dateFormat: "dd-mm-yy"
				});
			});
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
