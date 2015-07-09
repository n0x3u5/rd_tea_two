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
if(isset($_POST['date_submit'])) {
		//$req_div_name = $_POST['div_name'];
		//$req_year = $_POST['year_value'];
		$req_date = date('Y-m-d', strtotime( $_POST['date_value']));

		//echo "got date : ".$req_date."<br>";
		// $q_lab_cat = "select lcsn from labour_categories";
		// $r_lab_cat = mysqli_query($connection, $q_lab_cat);
		// confirm_query($r_lab_cat);
		// $i = 0;
		// while($lab_lcsn = mysqli_fetch_assoc($r_lab_cat)){
		// //var_dump($lab_arr);
		// 	$lcsn_arr[$i++] = $lab_lcsn['lcsn'];
		// }
		//var_dump($lcsn_arr); echo "<br>".count($lcsn_arr)."<br>";

		$q_chit = "select * from leaf_chit_table where  rec_dt = '{$req_date}'";
		$r_chit = mysqli_query($connection, $q_chit);
		confirm_query($r_chit);

		$q_cp = "select * from cp_table where  rec_date = '{$req_date}'";
		$r_cp = mysqli_query($connection, $q_cp);
		confirm_query($r_cp);
		$cp_record = mysqli_fetch_assoc($r_cp);
		//var_dump($cp_record);
		// $day_chit =mysqli_fetch_assoc($r);
		//
		// //var_dump($last_dt);
		//
		// $q_dt = "select rec_dt from daily_plucking where id = (select (max(id)-1) from daily_plucking where short_sec_name = '1EXTB')";
		// $r = mysqli_query($connection, $q_dt);
		// confirm_query($r);
		//
		// $prv_last_dt =mysqli_fetch_assoc($r);
		//
		// //var_dump($prv_last_dt);
		//
		// $last_ts = strtotime($last_dt['rec_dt']);
		// $prv_last_ts = strtotime($prv_last_dt['rec_dt']);

		//var_dump((int)floor((abs($prv_last_ts - $last_ts))/(60 * 60 * 24)));

}
	else {
		//$req_div_name = NULL;
		//$req_year = NULL;
		$req_date = NULL;
		$r_chit = NULL;
	}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>R.D. Tea |Daily Leaf Chit</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
		<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.7/css/jquery.dataTables.css"> -->
		<link rel="stylesheet" href="https://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.css">
    <link rel="stylesheet" href="css/stylesheet.css">
    <link rel="icon" href="images/logo_rdtea.png"/>
    <?php $page_id = 11;?>
    <style>
			.jumbotron {
				background:#520808;
			}
			.jumbotron h1,h3 {
				color:#EDD2D2;
			}
      .jumbotron form input[type="submit"] {
				background: #FFC107;
				color: #000000;
			}
			.container{
				width:88%;
			}
			th{
				text-align: center;
			}
			/*.main-content {
				overflow: scroll;
			}*/
			.main-content .btn {
				box-shadow: none;
			}
			div.DTTT { margin-bottom: 0.5em; float: right; }
    	div.dataTables_wrapper { clear: both; }
			.card_style{
				margin-top:10px;
			}
    </style>
  </head>
  <body>
    <?php
      include("nav_bar.php");
      nav_echoer($page_id);
    ?>
    <div class="container">
      <div class="jumbotron">
        <h1>Leaf Chit</h1>
  			<h3>Hansqua Division</h3>
        <form class="form-inline" action="leaf_chit.php" method="post">
          <!-- <div class="form-group">
            <label class="sr-only" for="sectionPicker">Email address</label>
            <select class="form-control" id="sectionPicker">
							<option selected>Choose a section...</option>
							<option>1EXTA</option>
							<option>1EXTB</option>
							<option>EXT3</option>
							<option>4W</option>
						</select>
          </div> -->
          <div class="form-group">
            <input type="text" name="date_value" class="form-control" id="datepicker" <?php if($req_date !=NULL) { ?>value="<?php echo date('d-m-Y', strtotime($req_date));?>" <?php } else { ?>placeholder="Date (dd-mm-yyyy)"<?php } ?> onChange="enable_add()" required>
          </div>
          <input type="submit" class="btn btn-warning" name="date_submit" value="Get Data">
        </form>
      </div>
			<div class="main-content">
				<table id="leaf_chit_table" class="table table-hover table-striped table-bordered" cellspacing="0" width="100%">
					<thead>
						<tr class="col-head">
								<th rowspan="2">Labour<br/>Category</th>
								<th colspan="10">Unpruned</th>
								<th colspan="10">Pruned</th>
								<th colspan="3">Grand<br/>Total</th>
						</tr>
						<tr>
							<th>Sec.</th>
							<th>Date<br/>Last<br/>Plucked</th>
							<th>Rnd.<br/>Days</th>
							<th>Area<br/>Plkd<br/>(Hec.)</th>
							<th>Plkrs.</th>
							<th>Plkrs<br/>per<br/>Hec.</th>
							<th>Leaf<br/>Plkd</th>
							<th>Leaf<br/>per<br>Plucker</th>
							<th>Task</th>
							<th>Bal.<br>Cnt.</th>
							<!--------------------------------------------------------------------->
							<th>Date<br/>Last<br/>Plucked</th>
							<th>Rnd.<br/>Days</th>
							<th>Sec.</th>
							<th>Area<br/>Plkd.<br/>(Hec.)</th>
							<th>Plkrs.</th>
							<th>Plkrs.<br/>per<br/>Hec.</th>
							<th>Leaf<br/>Plkd</th>
							<th>Leaf<br/>per<br>Plucker</th>
							<th>Task</th>
							<th>Bal.<br>Cnt.</th>
							<!--------------------------------------------------------------------->
							<th>Tot.<br/>Area<br/>Plkd.<br/>(Hec.)</th>
							<th>Tot.<br/>Pluckers</th>
							<th>Tot.<br/>Leaf<br/>Plkd.</th>
						</tr>
					</thead>
					<tbody>
						<?php
							if(isset($_POST['date_submit'])) {
								// for($i=0;$i<count($lcsn_arr);$i++) {
								// 	//echo "<br><br>Iterator i:";var_dump($i);
								// 	$query = "select * from daily_plucking where rec_dt='{$req_date}'";
								// 	//var_dump($query);
								// 	$result = mysqli_query($connection, $query);
								// 	confirm_query($result);
								//
								// 	while($day_chit = mysqli_fetch_assoc($result)){
								// 		//var_dump($day_chit); echo "<hr>";
								// 		$exp_lab_cat = explode("¥", $day_chit['labour_cat']);
								// 		// echo "<br>lcsn :";var_dump($lcsn_arr[$i]);
								// 		//echo "<br>lcsn :".$lcsn_arr[$i]."<br>";
								// 		// echo "<br>exp_lab_cat :";var_dump($exp_lab_cat);
								// 		// echo "<br>in_arr :";var_dump(in_array($lcsn_arr[$i], $exp_lab_cat));
								// 		if(in_array($lcsn_arr[$i], $exp_lab_cat)){
								// 			if($day_chit['prune_status'] == 'U') {
								// 				//echo "<br>This will go to Prune Section <br>";
								// 				$index = array_search($lcsn_arr[$i], $exp_lab_cat);
								// 				//echo $day_chit['short_sec_name']."   ".$day_chit['labour_cat']."  index value :".$index."<br>";
								//
								// 				$exp_plkd_area = explode("¥", $day_chit['lab_cat_plkd_area']);
								// 				$exp_leaf_qty = explode("¥", $day_chit['lab_cat_leaf_qty']);
								// 				$exp_lab_count = explode("¥", $day_chit['lab_cat_mandays']);
								// 				//echo "Other details of '{$lcsn_arr[$i]}' :<br>"."Plucke Area:{$exp_plkd_area[$index]}";
								// 				//echo "  Plucked Leaf: {$exp_leaf_qty[$index]} "." Labour Count: {$exp_lab_count[$index]}";
								$ballo_num1 = $ballo_num2 = 0; $pruned_rows_set = 0; $unpruned_rows_set = 0; $rows_set = 0;
								while($daily_chit = mysqli_fetch_assoc($r_chit)) {
									if($daily_chit['prune_stats'] == 'UNPRUNED') {
										$unpruned_rows_set = $rows_set = 1;
										//$cp_qtyu_arr[] = $daily_chit['cp_qty'];
										?>
												<tr>
													<td><?php echo $daily_chit['lab_cat'];//echo $lcsn_arr[$i]; ?></td>
													<td><?php $bsv=str_replace("¥","<br>",$daily_chit['short_sec_name']); echo $bsv;//echo $day_chit['short_sec_name']; ?></td>
													<td><?php $bsv=str_replace("¥","<br>",$daily_chit['dt_lst_plkd']); echo $bsv; ?></td>
													<td><?php $req_time = strtotime($req_date); $lst_dt_arr = explode('¥',$daily_chit['dt_lst_plkd']); $rnd_time = 0;
													foreach ($lst_dt_arr as $lst_dt) {
														$lst_time = strtotime($lst_dt);
														$rnd_time .= (($req_time - $lst_time)/(24*60*60))."<br>";
													} echo ltrim(rtrim($rnd_time,"<br>"), "0"); ?></td>
													<td><?php $area1 = $daily_chit['plkd_area']; echo $area1; $areau_arr[] = $area1; ?></td>
													<td><?php $pluckers1 = $daily_chit['mandays']; echo $daily_chit['mandays']; $pluckersu_arr[] = $pluckers1; ?></td>
													<td><?php echo round($daily_chit['mandays']/$daily_chit['plkd_area'],2); ?></td>
													<td><?php $leaf1 = $daily_chit['plkd_leaf']; echo $leaf1; $leafu_arr[] = $leaf1; ?></td>
													<td><?php echo round($daily_chit['plkd_leaf']/$daily_chit['mandays'],2); ?></td>
													<td><?php $bsv=str_replace("¥","<br>",$daily_chit['task']); echo $bsv; ?></td>
													<td><?php $ballo_count = $daily_chit['ballo_count']; echo $ballo_count; $ballo_num1 += $leaf1 * $ballo_count; ?></td>
													<!--------------------------------------------------------------------->
													<td></td>
													<td></td>
													<td></td>
													<td><?php $area2 = 0; $areap_arr[] = $area2; ?></td>
													<td><?php $pluckers2 = 0;  $pluckersp_arr[] = $pluckers2; ?></td>
													<td></td>
													<td><?php $leaf2 = 0;  $leafp_arr[] = $leaf2; ?></td>
													<td></td>
													<td></td>
													<td></td>
													<!--------------------------------------------------------------------->
													<td><?php echo $area1 + $area2;?></td>
													<td><?php echo $pluckers1 + $pluckers2; ?></td>
													<td><?php echo $leaf1 +$leaf2; ?></td>
												</tr>
										<?php
											// }
											// elseif($day_chit['prune_status'] != 'U' && $day_chit['prune_status'] != 'UP') {
											// 	// echo "<br> this will go to the Unpruned section!<br>";
											// 	$index = array_search($lcsn_arr[$i], $exp_lab_cat);
											// 	// echo $day_chit['short_sec_name']."   ".$day_chit['labour_cat']."  index value :".$index."<br>";
											//
											// 	$exp_plkd_area = explode("¥", $day_chit['lab_cat_plkd_area']);
											// 	$exp_leaf_qty = explode("¥", $day_chit['lab_cat_leaf_qty']);
											// 	$exp_lab_count = explode("¥", $day_chit['lab_cat_mandays']);
											//
											// 	// echo "Other details of '$lcsn_arr[$i]' :<br>"."Plucke Area:{$exp_plkd_area[$index]}";
											// 	// echo "  Plucked Leaf: {$exp_leaf_qty[$index]} "." Labour Count: {$exp_lab_count[$index]}";
										}
									else {
										//$cp_qtyp_arr[] = $daily_chit['cp_qty'];
										$pruned_rows_set = $rows_set = 1;
										?>
												<tr>
													<td><?php echo $daily_chit['lab_cat'];//echo $lcsn_arr[$i]; ?></td>
													<td></td>
													<td></td>
													<td></td>
													<td><?php $area3 = 0; $areau_arr[] = $area3; ?></td>
													<td><?php $pluckers3 = 0; $pluckersu_arr[] = $pluckers3; ?></td>
													<td></td>
													<td><?php $leaf3 = 0; $leafu_arr[] = $leaf3; ?></td>
													<td></td>
													<td></td>
													<td></td>
													<td><?php $bsv=str_replace("¥","<br>",$daily_chit['dt_lst_plkd']); echo $bsv; ?></td>
													<td><?php $req_time = strtotime($req_date); $lst_dt_arr = explode('¥',$daily_chit['dt_lst_plkd']); $rnd_time = 0;
													foreach ($lst_dt_arr as $lst_dt) {
														$lst_time = strtotime($lst_dt);
														$rnd_time .= (($req_time - $lst_time)/(24*60*60))."<br>";
													} echo ltrim(rtrim($rnd_time,"<br>"), "0"); ?></td>
													<td><?php $bsv=str_replace("¥","<br>",$daily_chit['short_sec_name']); echo $bsv; ?></td>
													<td><?php $area4 = $daily_chit['plkd_area']; echo $area4; $areap_arr[] = $area4; ?></td>
													<td><?php $pluckers4 = $daily_chit['mandays']; echo $pluckers4; $pluckersp_arr[] = $pluckers4; ?></td>
													<td><?php echo round($daily_chit['mandays']/$daily_chit['plkd_area'],2); ?></td>
													<td><?php $leaf4 = $daily_chit['plkd_leaf']; echo $leaf4; $leafp_arr[] = $leaf4; ?></td>
													<td><?php echo round($daily_chit['plkd_leaf']/$daily_chit['mandays'],2); ?></td>
													<td><?php $bsv=str_replace("¥","<br>",$daily_chit['task']); echo $bsv; ?></td>
													<td><?php $ballo_count = $daily_chit['ballo_count']; echo $ballo_count; $ballo_num2 += $leaf4 * $ballo_count; ?></td>
													<!--------------------------------------------------------------------->
													<!--------------------------------------------------------------------->
													<td><?php echo $area3 + $area4;?></td>
													<td><?php echo $pluckers3 + $pluckers4; ?></td>
													<td><?php echo $leaf3 + $leaf4; ?></td>
												</tr>
										<?php
									}
								}
								// 			}
								// 		}
								// 	}
								// }
								if($rows_set) {
									if($cp_record != null) {
						?>
						<tr>
							<td>Cashpluckers</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td><?php $cpu = $cp_record['unprune_cp_qty']; echo $cpu ?></td>
							<td></td>
							<td></td>
							<td><?php $cub = $cp_record['unprune_bm']; echo $cub; $cub_n = $cub * $cpu;?></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td><?php $cpp = $cp_record['prune_cp_qty']; echo $cpp;?></td>
							<td></td>
							<td></td>
							<td><?php $cpb = $cp_record['prune_bm']; echo $cpb; $cpb_n = $cpb * $cpp;?></td>
							<td></td>
							<td></td>
							<td><?php echo $cpp + $cpu; ?></td>
						</tr>
						<?php } ?>
					</tbody>
					<tfoot>
						<tr>
							<td>Total</td>
							<td></td>
							<td></td>
							<td></td>
							<?php if($unpruned_rows_set) { ?>
							<td><?php $areas1 = array_sum($areau_arr); echo $areas1; ?></td>
							<td><?php $pluckerss1 = array_sum($pluckersu_arr); echo $pluckerss1; ?></td>
							<td><?php echo round(($pluckerss1/$areas1), 2); ?></td>
							<td><?php if(isset($cpu)){$leafs1 = array_sum($leafu_arr) + $cpu; echo $leafs1;} else { $leafs1 = array_sum($leafu_arr); echo $leafs1; }?></td>
							<td><?php echo round(($leafs1/$pluckerss1), 2); ?></td>
							<td></td>
							<td><?php if(isset($cub_n)){echo round((($ballo_num1 + $cub_n) / $leafs1), 2);} else { echo round(($ballo_num1 / $leafs1), 2); } ?></td>
							<?php } else {?>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<?php } ?>
							<td></td>
							<td></td>
							<td></td>
							<?php if($pruned_rows_set) { ?>
							<td><?php $areas2 = array_sum($areap_arr); echo $areas2; ?></td>
							<td><?php $pluckerss2 = array_sum($pluckersp_arr); echo $pluckerss2; ?></td>
							<td><?php echo round(($pluckerss2/$areas2), 2); ?></td>
							<td><?php if(isset($cpp)) {$leafs2 = array_sum($leafp_arr) + $cpp; echo $leafs2;} else { $leafs2 = array_sum($leafp_arr); echo $leafs2; } ?></td>
							<td><?php echo round(($leafs2/$pluckerss2), 2); ?></td>
							<td></td>
							<td><?php if(isset($cpb_n)){echo round((($ballo_num2 + $cpb_n) / $leafs2), 2);} else { echo round(($ballo_num2 / $leafs2), 2); } ?></td>
							<?php } else { ?>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<?php } ?>
							<td><?php if(!isset($areas1)) {echo $areas2;} elseif (!isset($areas2)) { echo $areas1; } else { echo $areas1 + $areas2; } ?></td>
							<td><?php if(!isset($pluckerss1)) {echo $pluckerss2;} elseif (!isset($pluckerss2)) { echo $pluckerss1; } else { echo $pluckerss1 + $pluckerss2; }?></td>
							<td><?php if(!isset($leafs1)) {echo $leafs2;} elseif (!isset($leafs2)) { echo $leafs1; } else { echo $leafs1 + $leafs2; }?></td>
						</tr>
					</tfoot>
				<?php }
				}//end of isset $_POST[date_submit] ?>
				</table>
			</div>
			<?php if (isset($cp_record)) {?>
			<div class="card_style" style="padding: 20px;">
					<h4>Cash plucking was done from <?php echo $cp_record['time_from']; ?> to <?php echo $cp_record['time_to']; ?></h4>
			</div>
			<?php } ?>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="http://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/fixedcolumns/3.0.4/js/dataTables.fixedColumns.min.js"></script>
		<script src="https://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js"></script>
		<script>
			$(function() {
				$("#datepicker").datepicker({
					dateFormat: "dd-mm-yy"
				});
				//$('#leaf_chit_table').DataTable({"scrollX":true });
				var table = $('#leaf_chit_table').DataTable({
						"scrollX": true,
						"order": [],
						"aoColumns": [
								null,
								{ "sType": "date-uk" },
								null,
								null,
								null,
								null,
								null,
								null,
								null,
								null,
								null,
								{ "sType": "date-uk" },
								null,
								null,
								null,
								null,
								null,
								null,
								null,
								null,
								null,
								null,
								null,
								null
						]

	    	});
				new $.fn.dataTable.FixedColumns( table );
			// 	var tt = new $.fn.dataTable.TableTools(table);
    	// 	$( tt.fnContainer() ).insertBefore('div.dataTables_wrapper');
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
  </body>
</html>
<?php
	end_connection($connection);
?>
