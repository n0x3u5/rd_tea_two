<?php
	require_once('/includes/sessions.php');
	require_once('/includes/functions.php');

	// if(!isset($_SESSION['user'])) {
	// 	redirect_to("index.php");
	// }
?>
<?php
	$connection = make_connection();

	//var_dump($_POST);echo "<br><hr>";
	if(isset($_POST["dt_sec_submit"])){
		$req_date = date('Y-m-d', strtotime($_POST["date_value"]));
		$req_ssn = $_POST["short_sec_name"];
		$_SESSION['ssn'] = $req_ssn;
		$_SESSION['date'] = $req_date;


		// echo "<br>got date =".$req_date."<br>";
		// echo "<br>got ssn =" .$req_ssn."<br>";
		// var_dump($req_date);echo "<br>"; var_dump($req_ssn);

		$query = "SELECT * FROM daily_spraying WHERE short_sec_name='{$req_ssn}' and record_date='{$req_date}'";

		$result = mysqli_query($connection, $query);
    confirm_query($result);

		$_SESSION['daily_spraying'] = mysqli_fetch_assoc($result);
    // echo "<br>Its just a test for session set check <br>";
    // var_dump($_SESSION['daily_spraying']);
    // echo "<br>";
	}
	else {
		$req_date = NULL;
		$req_ssn = NULL;
	}
?>

<?php
  if (isset($_POST['add_submit'])) {
    $short_sec_name = $_SESSION['ssn'];
    $record_date = $_SESSION['date'];

    $hz_area = (float) $_POST['hz_area'];
    $db_area = (float) $_POST['db_area'];
    $hz_mandays = (int) $_POST['hz_mandays'];
    $dr_hz_mix = (int) $_POST['dr_hz_mix'];
    $dr_hz_pani = (int) $_POST['dr_hz_pani'];
    $drum_short = (int) $_POST['drum_short'];
    $mr_db_mnds = (int) $_POST['mr_db_mnds'];
    $dr_db_nl_mnds = (int) $_POST['dr_db_nl_mnds'];
    $dr_db_mnds = (int) $_POST['dr_db_mnds'];
    $mc_db_mnds = (int) $_POST['mc_db_mnds'];
    $dr_db_mix = (int) $_POST['dr_db_mix'];
    $dr_db_pani = (int) $_POST['dr_db_pani'];
    $cocktail =   $_POST['cocktail'];
    $pest_disease =   $_POST['pest_disease'];
    $infctn_intensity =   $_POST['infctn_intensity'];
    $drums_sprayed = (int) $_POST['drums_sprayed'];
    $ins1_nm =   $_POST['ins1_nm'];
    $ins1_dose = (float) $_POST['ins1_dose'];
    $ins1_qty = (float) $_POST['ins1_qty'];
    $ins2_nm =   $_POST['ins2_nm'];
    $ins2_dose = (float) $_POST['ins2_dose'];
    $ins2_qty = (float) $_POST['ins2_qty'];
    $acc3_nm =   $_POST['acc3_nm'];
    $acc3_dose = (float) $_POST['acc3_dose'];
    $acc3_qty = (float) $_POST['acc3_qty'];
    $synth4_nm =   $_POST['synth4_nm'];
    $synth4_dose = (float) $_POST['synth4_dose'];
    $synth4_qty = (float) $_POST['synth4_qty'];
    $str5_nm =   $_POST['str5_nm'];
    $str5_dose = (float) $_POST['str5_dose'];
    $str5_qty = (float) $_POST['str5_qty'];
    $fng6_nm =   $_POST['fng6_nm'];
    $fng6_dose = (float) $_POST['fng6_dose'];
    $fng6_qty = (float) $_POST['fng6_qty'];
    $wdc7_nm =   $_POST['wdc7_nm'];
    $wdc7_dose = (float) $_POST['wdc7_dose'];
    $wdc7_qty = (float) $_POST['wdc7_qty'];
    $wdc8_nm =   $_POST['wdc8_nm'];
    $wdc8_dose = (float) $_POST['wdc8_dose'];
    $wdc8_qty = (float) $_POST['wdc8_qty'];
    $urea =   $_POST['urea'];
    $u_dose = (float) $_POST['u_dose'];
    $ntr9_qty = (float) $_POST['ntr9_qty'];
    $zinc =   $_POST['zinc'];
    $z_dose = (float) $_POST['z_dose'];
    $ntr10_qty = (float) $_POST['ntr10_qty'];
    $boron =   $_POST['boron'];
    $b_dose = (float) $_POST['b_dose'];
    $ntr11_qty = (float) $_POST['ntr11_qty'];
    $othr1_nm =   $_POST['othr1_nm'];
    $othr1_dose = (float) $_POST['othr1_dose'];
    $othr1_qty = (float) $_POST['othr1_qty'];
    $othr2_nm =   $_POST['othr2_nm'];
    $othr2_dose = (float) $_POST['othr2_dose'];
    $othr2_qty = (float) $_POST['othr2_qty'];
    $othr3_nm =   $_POST['othr3_nm'];
    $othr3_dose = (float) $_POST['othr3_dose'];
    $othr3_qty = (float) $_POST['othr3_qty'];


    $query =   "INSERT INTO daily_spraying (";
    $query .=   " short_sec_name, record_date, hz_area, db_area, hz_mandays,";
    $query .=   " dr_hz_mix, dr_hz_pani, drum_short, mr_db_mnds,";
    $query .=   " dr_db_nl_mnds, dr_db_mnds, mc_db_mnds, dr_db_mix, dr_db_pani,";
    $query .=   " cocktail, pest_disease, infctn_intensity, drums_sprayed,";
    $query .=   " ins1_nm, ins1_dose, ins1_qty, ins2_nm, ins2_dose, ins2_qty,";
    $query .=   " acc3_nm, acc3_dose, acc3_qty, synth4_nm, synth4_dose, synth4_qty,";
    $query .=   " str5_nm, str5_dose, str5_qty, fng6_nm, fng6_dose, fng6_qty,";
    $query .=   " wdc7_nm, wdc7_dose, wdc7_qty, wdc8_nm, wdc8_dose, wdc8_qty,";
    $query .=   " urea, u_dose, ntr9_qty, zinc, z_dose, ntr10_qty,";
    $query .=   " boron, b_dose, ntr11_qty, othr1_nm, othr1_dose, othr1_qty,";
    $query .=   " othr2_nm, othr2_dose, othr2_qty, othr3_nm, othr3_dose, othr3_qty )";
    $query .=   " VALUES ('{$short_sec_name}', '{$record_date}', {$hz_area}, {$db_area}, {$hz_mandays},";
    $query .=   " {$dr_hz_mix}, {$dr_hz_pani}, {$drum_short}, {$mr_db_mnds},";
    $query .=   " {$dr_db_nl_mnds}, {$dr_db_mnds}, {$mc_db_mnds}, {$dr_db_mix}, {$dr_db_pani},";
    $query .=   " '{$cocktail}', '{$pest_disease}', '{$infctn_intensity}', {$drums_sprayed},";
    $query .=   " '{$ins1_nm}', {$ins1_dose}, {$ins1_qty}, '{$ins2_nm}', {$ins2_dose}, {$ins2_qty},";
    $query .=   " '{$acc3_nm}', {$acc3_dose}, {$acc3_qty}, '{$synth4_nm}', {$synth4_dose}, {$synth4_qty},";
    $query .=   " '{$str5_nm}', {$str5_dose}, {$str5_qty}, '{$fng6_nm}', {$fng6_dose}, {$fng6_qty},";
    $query .=   " '{$wdc7_nm}', {$wdc7_dose}, {$wdc7_qty}, '{$wdc8_nm}', {$wdc8_dose}, {$wdc8_qty},";
    $query .=   " '{$urea}', {$u_dose}, {$ntr9_qty}, '{$zinc}', {$z_dose}, {$ntr10_qty},";
    $query .=   " '{$boron}', {$b_dose}, {$ntr11_qty}, '{$othr1_nm}', {$othr1_dose}, {$othr1_qty},";
    $query .=   " '{$othr2_nm}', {$othr2_dose}, {$othr2_qty}, '{$othr3_nm}', {$othr3_dose}, {$othr3_qty})";

    $result = mysqli_query($connection, $query);

    confirm_query($result);
    echo "Inserted successfully!";

		$_SESSION['daily_spraying'] = NULL;
  }
?>
<?php
    if (isset($_POST['edit_submit'])) {
      $req_id = $_SESSION['daily_spraying']['id'];
      $short_sec_name = $_SESSION['ssn'];
      $record_date = $_SESSION['date'];

      $hz_area = (float) $_POST['hz_area'];
      $db_area = (float) $_POST['db_area'];
      $hz_mandays = (int) $_POST['hz_mandays'];
      $dr_hz_mix = (int) $_POST['dr_hz_mix'];
      $dr_hz_pani = (int) $_POST['dr_hz_pani'];
      $drum_short = (int) $_POST['drum_short'];
      $mr_db_mnds = (int) $_POST['mr_db_mnds'];
      $dr_db_nl_mnds = (int) $_POST['dr_db_nl_mnds'];
      $dr_db_mnds = (int) $_POST['dr_db_mnds'];
      $mc_db_mnds = (int) $_POST['mc_db_mnds'];
      $dr_db_mix = (int) $_POST['dr_db_mix'];
      $dr_db_pani = (int) $_POST['dr_db_pani'];
      $cocktail =   $_POST['cocktail'];
      $pest_disease =   $_POST['pest_disease'];
      $infctn_intensity =   $_POST['infctn_intensity'];
      $drums_sprayed = (int) $_POST['drums_sprayed'];
      $ins1_nm =   $_POST['ins1_nm'];
      $ins1_dose = (float) $_POST['ins1_dose'];
      $ins1_qty = (float) $_POST['ins1_qty'];
      $ins2_nm =   $_POST['ins2_nm'];
      $ins2_dose = (float) $_POST['ins2_dose'];
      $ins2_qty = (float) $_POST['ins2_qty'];
      $acc3_nm =   $_POST['acc3_nm'];
      $acc3_dose = (float) $_POST['acc3_dose'];
      $acc3_qty = (float) $_POST['acc3_qty'];
      $synth4_nm =   $_POST['synth4_nm'];
      $synth4_dose = (float) $_POST['synth4_dose'];
      $synth4_qty = (float) $_POST['synth4_qty'];
      $str5_nm =   $_POST['str5_nm'];
      $str5_dose = (float) $_POST['str5_dose'];
      $str5_qty = (float) $_POST['str5_qty'];
      $fng6_nm =   $_POST['fng6_nm'];
      $fng6_dose = (float) $_POST['fng6_dose'];
      $fng6_qty = (float) $_POST['fng6_qty'];
      $wdc7_nm =   $_POST['wdc7_nm'];
      $wdc7_dose = (float) $_POST['wdc7_dose'];
      $wdc7_qty = (float) $_POST['wdc7_qty'];
      $wdc8_nm =   $_POST['wdc8_nm'];
      $wdc8_dose = (float) $_POST['wdc8_dose'];
      $wdc8_qty = (float) $_POST['wdc8_qty'];
      $urea =   $_POST['urea'];
      $u_dose = (float) $_POST['u_dose'];
      $ntr9_qty = (float) $_POST['ntr9_qty'];
      $zinc =   $_POST['zinc'];
      $z_dose = (float) $_POST['z_dose'];
      $ntr10_qty = (float) $_POST['ntr10_qty'];
      $boron =   $_POST['boron'];
      $b_dose = (float) $_POST['b_dose'];
      $ntr11_qty = (float) $_POST['ntr11_qty'];
      $othr1_nm =   $_POST['othr1_nm'];
      $othr1_dose = (float) $_POST['othr1_dose'];
      $othr1_qty = (float) $_POST['othr1_qty'];
      $othr2_nm =   $_POST['othr2_nm'];
      $othr2_dose = (float) $_POST['othr2_dose'];
      $othr2_qty = (float) $_POST['othr2_qty'];
      $othr3_nm =   $_POST['othr3_nm'];
      $othr3_dose = (float) $_POST['othr3_dose'];
      $othr3_qty = (float) $_POST['othr3_qty'];


      $query =   "UPDATE daily_spraying SET";
      $query .=   " short_sec_name='{$short_sec_name}', record_date='{$record_date}', hz_area={$hz_area}, db_area={$db_area}, hz_mandays={$hz_mandays},";
      $query .=   " dr_hz_mix={$dr_hz_mix}, dr_hz_pani={$dr_hz_pani}, drum_short={$drum_short}, mr_db_mnds={$mr_db_mnds},";
      $query .=   " dr_db_nl_mnds={$dr_db_nl_mnds}, dr_db_mnds={$dr_db_mnds}, mc_db_mnds={$mc_db_mnds}, dr_db_mix={$dr_db_mix}, dr_db_pani={$dr_db_pani},";
      $query .=   " cocktail='{$cocktail}', pest_disease='{$pest_disease}', infctn_intensity='{$infctn_intensity}', drums_sprayed={$drums_sprayed},";
      $query .=   " ins1_nm='{$ins1_nm}', ins1_dose={$ins1_dose}, ins1_qty={$ins1_qty}, ins2_nm='{$ins2_nm}', ins2_dose={$ins2_dose}, ins2_qty={$ins2_qty},";
      $query .=   " acc3_nm='{$acc3_nm}', acc3_dose={$acc3_dose}, acc3_qty={$acc3_qty}, synth4_nm='{$synth4_nm}', synth4_dose={$synth4_dose}, synth4_qty={$synth4_qty},";
      $query .=   " str5_nm='{$str5_nm}', str5_dose={$str5_dose}, str5_qty={$str5_qty}, fng6_nm='{$fng6_nm}', fng6_dose={$fng6_dose}, fng6_qty={$fng6_qty},";
      $query .=   " wdc7_nm='{$wdc7_nm}', wdc7_dose={$wdc7_dose}, wdc7_qty={$wdc7_qty}, wdc8_nm='{$wdc8_nm}', wdc8_dose={$wdc8_dose}, wdc8_qty={$wdc8_qty},";
      $query .=   " urea='{$urea}', u_dose={$u_dose}, ntr9_qty={$ntr9_qty}, zinc='{$zinc}', z_dose={$z_dose}, ntr10_qty={$ntr10_qty},";
      $query .=   " boron='{$boron}', b_dose={$b_dose}, ntr11_qty={$ntr11_qty}, othr1_nm='{$othr1_nm}', othr1_dose={$othr1_dose}, othr1_qty={$othr1_qty},";
      $query .=   " othr2_nm='{$othr2_nm}', othr2_dose={$othr2_dose}, othr2_qty={$othr2_qty}, othr3_nm='{$othr3_nm}', othr3_dose={$othr3_dose}, othr3_qty={$othr3_qty} WHERE id ={$req_id}";

      $result = mysqli_query($connection, $query);

      confirm_query($result);
      echo "Updated successfully!";

      $_SESSION['daily_spraying'] = NULL;
    }
?>
<?php
    if(isset($_POST['del_entry'])){
      $short_sec_name = $_SESSION['ssn'];
      $record_date = $_SESSION['date'];

      $query = "DELETE FROM daily_spraying WHERE short_sec_name='{$short_sec_name}' and record_date='{$record_date}'";

      $result = mysqli_query($connection, $query);
      confirm_query($result);
      echo "Deleted successfully!";

      $_SESSION['daily_spraying'] = NULL;
    }
?>

<!DOCTYPE html>
<html>
    <head>
      <meta charset="utf-8">
      <title>R.D. Tea | Manage Sections</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
		  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
      <link rel="stylesheet" href="css/stylesheet.css">
      <style>
        .card_style {
          background: #EFEBE9;
        }
        .nav-tabs.nav-justified > .active > a, .nav-tabs.nav-justified > .active > a:hover, .nav-tabs.nav-justified > .active > a:active, .nav-tabs.nav-justified > .active > a:enabled {
        background-color: #5D4037 !important;
        border-bottom-color: #5D4037;
        color: #FFFFFF;
        }
        .tab-content {
          background: #EFEBE9;
          padding: 20px;
        }
        .col-sm-4 .btn {
          width: auto;
        }
        .main-form {
          padding: 10px 0 10px 0;
        }
        @media (min-width: 768px) {
          .col-sm-2.col-sm-offset-4 .btn-success {
            float: right;
          }
        }
        @media (max-width: 768px) {
          .col-sm-2.col-sm-offset-4 .btn-success {
            float: right;
          }
        }
        @media (max-width: 500px) {
          .col-sm-2.col-sm-offset-4 .btn-success {
            float: left;
          }
          .btn {
            margin-left: 40px;
          }
        }
        .col-sm-6 .btn {
          margin-top: 15px;
        }
        .col-sm-2 .btn{
          margin-top: 10px;
          margin-bottom: 5px;
        }
      </style>
      <link rel="icon" href="images/logo_rdtea.png"/>
      <?php $page_id = 9;?>
    </head>
    <body>
        <?php
          include("nav_bar.php");
          nav_echoer($page_id);
        ?>
        <div class="container">
          <div class="jumbotron" style="background:#795548;">
            <h1>Spraying Data Entry</h1>
            <form action="daily_spraying_entry.php" class="form-inline" method="post">
              <select id="division" name ="short_sec_name" class="form-control">
                <?php
                    $q = "SELECT * FROM sections";
                    $result = mysqli_query($connection, $q);

                    confirm_query($result);
                    //$_POST['sec_short_nm'] = NULL;

                    echo "<option id=\"opt0\" value=NULL></option>";
                    while($sec_values = mysqli_fetch_assoc($result)) {
                ?>
                      <option value="<?php echo htmlentities($sec_values['short_sec_name']) ?>"><?php echo htmlentities($sec_values['short_sec_name']); ?></option>
                <?php
                    }
                ?>
              </select>
              <div class="form-group">
                <div class="input-group" style="width:100%">
                  <input type="text" name="date_value" class="form-control" id="datepicker" <?php if($req_date !=NULL) { ?>value="<?php echo date('d-m-Y', strtotime($req_date));?>" <?php } else { ?>placeholder="Date (dd-mm-yyyy)"<?php } ?> onChange="enable_add()">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                </div>
              </div>
                <button type="submit" name="dt_sec_submit" class="btn btn-success" style="margin-top:-1px;">Submit</button>
            </form>
        </div>
          <div class="col-sm-12 card_style" style="padding-bottom:15px;">
            <ul class="nav nav-tabs nav-justified">
              <li class="active"><a href="#tab1" data-toggle="tab">Update or Delete Record</a></li>
              <li><a href="#tab2" data-toggle="tab">Add Record</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab1">
                <form class="form-horizontal" action="daily_spraying_entry.php" method="post">
                  <?php if(isset($_SESSION['daily_spraying'])) { $daily = $_SESSION['daily_spraying']; } else { $daily = NULL; }  //var_dump($daily); ?>
                  <div class="row">
                    <div class="col-sm-6">
                      <button type="button" class="btn btn-danger pull-left" data-toggle="modal" data-target="#confirmModal">Delete Record</button>
                    </div>
                    <div class="col-sm-2 col-sm-offset-4">
                      <button type="submit" name="edit_submit" class="btn btn-success btn-lg">Edit Record</button>
                    </div>
                  </div>
                  <div class="row main-form">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="left_hzar1" class="col-sm-5 control-label">Hazri Area</label>
                        <div class="col-sm-7">
                          <input type="text" name="hz_area" class="form-control" id="left_hzar1" <?php if (isset($daily)) { ?> value=" <?php echo $daily['hz_area']; ?> " <?php } ?> >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_dbar1" class="col-sm-5 control-label">Doubly Area</label>
                        <div class="col-sm-7">
                          <input type="text" name="db_area" class="form-control" id="left_dbar1" <?php if (isset($daily)) { ?> value=" <?php echo $daily['db_area']; ?> " <?php } ?> >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_hzmd1" class="col-sm-5 control-label">Hazri Mandays</label>
                        <div class="col-sm-7">
                          <input type="text" name="hz_mandays" class="form-control" id="left_hzmd1" <?php if (isset($daily)) { ?> value=" <?php echo $daily['hz_mandays']; ?> " <?php } ?> >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_hzmx1" class="col-sm-5 control-label">DR Hazri (mixer)</label>
                        <div class="col-sm-7">
                          <input type="text" name="dr_hz_mix" class="form-control" id="left_hzmx1" <?php if (isset($daily)) { ?> value=" <?php echo $daily['dr_hz_mix']; ?> " <?php } ?> >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_hzpw1" class="col-sm-5 control-label">DR Hazri (paniwalla)</label>
                        <div class="col-sm-7">
                          <input type="text" name="dr_hz_pani" class="form-control" id="left_hzpw1"  <?php if (isset($daily)) { ?> value=" <?php echo $daily['dr_hz_pani']; ?> " <?php } ?> >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drum1" class="col-sm-5 control-label">Drum (short)</label>
                        <div class="col-sm-7">
                          <input type="text" name="drum_short" class="form-control" id="left_drum1" <?php if (isset($daily)) { ?> value=" <?php echo $daily['drum_short']; ?> " <?php } ?> >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_mrmd1" class="col-sm-5 control-label">MR Doubly Mandays</label>
                        <div class="col-sm-7">
                          <input type="text" name="mr_db_mnds" class="form-control" id="left_mrmd1" <?php if (isset($daily)) { ?> value=" <?php echo $daily['mr_db_mnds']; ?> " <?php } ?> >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_nlmd1" class="col-sm-5 control-label">DR Doubly NL Mandays</label>
                        <div class="col-sm-7">
                          <input type="text" name="dr_db_nl_mnds" class="form-control" id="left_nlmd1" <?php if (isset($daily)) { ?> value=" <?php echo $daily['dr_db_nl_mnds']; ?> " <?php } ?> >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drmd1" class="col-sm-5 control-label">DR Doubly Mandays</label>
                        <div class="col-sm-7">
                          <input type="text" name="dr_db_mnds" class="form-control" id="left_drmd1" <?php if (isset($daily)) { ?> value=" <?php echo $daily['dr_db_mnds']; ?> " <?php } ?> >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_mcmd1" class="col-sm-5 control-label">MC Doubly Mandays</label>
                        <div class="col-sm-7">
                          <input type="text" name="mc_db_mnds" class="form-control" id="left_mcmd1" <?php if (isset($daily)) { ?> value=" <?php echo $daily['mc_db_mnds']; ?> " <?php } ?> >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_dbmx1" class="col-sm-5 control-label">DR Doubly Mixer</label>
                        <div class="col-sm-7">
                          <input type="text" name="dr_db_mix" class="form-control" id="left_dbmx1" <?php if (isset($daily)) { ?> value=" <?php echo $daily['dr_db_mix']; ?> " <?php } ?> >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_dbpw1" class="col-sm-5 control-label">DR Doubly Paniwalla</label>
                        <div class="col-sm-7">
                          <input type="text" name="dr_db_pani" class="form-control" id="left_dbpw1" <?php if (isset($daily)) { ?> value=" <?php echo $daily['dr_db_pani']; ?> " <?php } ?> >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_cocktail1" class="col-sm-5 control-label">Cocktail</label>
                        <div class="col-sm-7">
                          <select class="form-control" name="cocktail" id="left_cocktail1">
                            <option></option>
                            <option <?php if (isset($daily) && $daily['cocktail'] == 'Y') { echo "selected"; } ?> >Y</option>
                            <option <?php if (isset($daily) && $daily['cocktail'] == 'N') { echo "selected"; } ?> >N</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_pst1" class="col-sm-5 control-label">Pest and Disease</label>
                        <div class="col-sm-7">
                          <input type="text" name="pest_disease" class="form-control" id="left_pst1" <?php if (isset($daily)) { ?> value=" <?php echo $daily['pest_disease']; ?> " <?php } ?> >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_infint1" class="col-sm-5 control-label">Infection Intensity</label>
                        <div class="col-sm-7">
                          <select class="form-control" name="infctn_intensity" id="left_infint1">
                            <option></option>
                            <option <?php if (isset($daily) && $daily['infctn_intensity'] == 'H') { echo "selected"; } ?>  >H</option>
                            <option <?php if (isset($daily) && $daily['infctn_intensity'] == 'M') { echo "selected"; } ?> >M</option>
                            <option <?php if (isset($daily) && $daily['infctn_intensity'] == 'L') { echo "selected"; } ?> >L</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp1" class="col-sm-5 control-label">Drums Sprayed</label>
                        <div class="col-sm-7">
                          <input type="text" name="drums_sprayed" class="form-control" id="left_drsp1" <?php if (isset($daily)) { ?> value=" <?php echo $daily['drums_sprayed']; ?> " <?php } ?> >
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="right_ins1nm1" class="col-sm-4 control-label">INS1 Name</label>
                        <div class="col-sm-8">
                          <input type="text" name="ins1_nm" class="form-control" id="right_ins1nm1" <?php if (isset($daily)) { ?> value=" <?php echo $daily['ins1_nm']; ?> " <?php } ?> >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="right_ins1dose1" class="col-sm-4 control-label">INS1 Dose</label>
                        <div class="col-sm-8">
                          <input type="text" name="ins1_dose" class="form-control" id="right_ins1dose1" <?php if (isset($daily)) { ?> value=" <?php echo $daily['ins1_dose']; ?> " <?php } ?> >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="right_ins1qty1" class="col-sm-4 control-label">INS1 Quantity</label>
                        <div class="col-sm-8">
                          <input type="text" name="ins1_qty" class="form-control" id="right_ins1qty1" <?php if (isset($daily)) { ?> value=" <?php echo $daily['ins1_qty']; ?> " <?php } ?> >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="right_ins2nm1" class="col-sm-4 control-label">INS2 Name</label>
                        <div class="col-sm-8">
                          <input type="text" name="ins2_nm" class="form-control" id="right_ins2nm1" <?php if (isset($daily)) { ?> value=" <?php echo $daily['ins2_nm']; ?> " <?php } ?> >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="right_ins2dose1" class="col-sm-4 control-label">INS2 Dose</label>
                        <div class="col-sm-8">
                          <input type="text" name="ins2_dose" class="form-control" id="right_ins2dose1" <?php if (isset($daily)) { ?> value=" <?php echo $daily['ins2_dose']; ?> " <?php } ?> >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="right_ins2qty1" class="col-sm-4 control-label">INS2 Quantity</label>
                        <div class="col-sm-8">
                          <input type="text" name="ins2_qty" class="form-control" id="right_ins2qty1" <?php if (isset($daily)) { ?> value=" <?php echo $daily['ins2_qty']; ?> " <?php } ?> >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="right_acc3nm1" class="col-sm-4 control-label">ACC3 Name</label>
                        <div class="col-sm-8">
                          <input type="text" name="acc3_nm" class="form-control" id="right_acc3nm1" <?php if (isset($daily)) { ?> value=" <?php echo $daily['acc3_nm']; ?> " <?php } ?> >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="right_acc3dose1" class="col-sm-4 control-label">ACC3 Dose</label>
                        <div class="col-sm-8">
                          <input type="text" name="acc3_dose" class="form-control" id="right_acc3dose1" <?php if (isset($daily)) { ?> value=" <?php echo $daily['acc3_dose']; ?> " <?php } ?> >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="right_acc3qty1" class="col-sm-4 control-label">ACC3 Quantity</label>
                        <div class="col-sm-8">
                          <input type="text" name="acc3_qty" class="form-control" id="right_acc3qty1" <?php if (isset($daily)) { ?> value=" <?php echo $daily['acc3_qty']; ?> " <?php } ?> >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="right_synth4nm1" class="col-sm-4 control-label">SYNTH4 Name</label>
                        <div class="col-sm-8">
                          <input type="text" name="synth4_nm" class="form-control" id="right_synth4nm1" <?php if (isset($daily)) { ?> value=" <?php echo $daily['synth4_nm']; ?> " <?php } ?> >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="right_synth4dose1" class="col-sm-4 control-label">SYNTH4 Dose</label>
                        <div class="col-sm-8">
                          <input type="text" name="synth4_dose" class="form-control" id="right_synth4dose1" <?php if (isset($daily)) { ?> value=" <?php echo $daily['synth4_dose']; ?> " <?php } ?> >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="right_synth4qty1" class="col-sm-4 control-label">SYNTH4 Quantity</label>
                        <div class="col-sm-8">
                          <input type="text" name="synth4_qty" class="form-control" id="right_synth4qty1" <?php if (isset($daily)) { ?> value=" <?php echo $daily['synth4_qty']; ?> " <?php } ?> >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="right_str5nm1" class="col-sm-4 control-label">STR5 Name</label>
                        <div class="col-sm-8">
                          <input type="text" name="str5_nm" class="form-control" id="right_str5nm1" <?php if (isset($daily)) { ?> value=" <?php echo $daily['str5_nm']; ?> " <?php } ?> >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="right_str5dose1" class="col-sm-4 control-label">STR5 Dose</label>
                        <div class="col-sm-8">
                          <input type="text" name="str5_dose" class="form-control" id="right_str5dose1" <?php if (isset($daily)) { ?> value=" <?php echo $daily['str5_dose']; ?> " <?php } ?> >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="right_str5qty1" class="col-sm-4 control-label">STR5 Quantity</label>
                        <div class="col-sm-8">
                          <input type="text" name="str5_qty" class="form-control" id="right_str5qty1" <?php if (isset($daily)) { ?> value=" <?php echo $daily['str5_qty']; ?> " <?php } ?> >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="right_fng6nm1" class="col-sm-4 control-label">FNG6 Name</label>
                        <div class="col-sm-8">
                          <input type="text" name="fng6_nm" class="form-control" id="right_fng6nm1" <?php if (isset($daily)) { ?> value=" <?php echo $daily['fng6_nm']; ?> " <?php } ?> >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="right_fng6dose1" class="col-sm-4 control-label">FNG6 Dose</label>
                        <div class="col-sm-8">
                          <input type="text" name="fng6_dose" class="form-control" id="right_fng6dose1" <?php if (isset($daily)) { ?> value=" <?php echo $daily['fng6_dose']; ?> " <?php } ?> >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="right_fng6qty1" class="col-sm-4 control-label">FNG6 Quantity</label>
                        <div class="col-sm-8">
                          <input type="text" name="fng6_qty" class="form-control" id="right_fng6qty1" <?php if (isset($daily)) { ?> value=" <?php echo $daily['fng6_qty']; ?> " <?php } ?> >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="right_wdc7nm1" class="col-sm-4 control-label">WDC7 Name</label>
                        <div class="col-sm-8">
                          <input type="text" name="wdc7_nm" class="form-control" id="right_wdc7nm1" <?php if (isset($daily)) { ?> value=" <?php echo $daily['wdc7_nm']; ?> " <?php } ?> >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="right_wdc7dose1" class="col-sm-4 control-label">WDC7 Dose</label>
                        <div class="col-sm-8">
                          <input type="text" name="wdc7_dose" class="form-control" id="right_wdc7dose1" <?php if (isset($daily)) { ?> value=" <?php echo $daily['wdc7_dose']; ?> " <?php } ?> >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="right_wdc7qty1" class="col-sm-4 control-label">WDC7 Quantity</label>
                        <div class="col-sm-8">
                          <input type="text" name="wdc7_qty" class="form-control" id="right_wdc7qty1" <?php if (isset($daily)) { ?> value=" <?php echo $daily['wdc7_qty']; ?> " <?php } ?> >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="right_wdc8nm1" class="col-sm-4 control-label">WDC8 Name</label>
                        <div class="col-sm-8">
                          <input type="text" name="wdc8_nm" class="form-control" id="right_wdc8nm1" <?php if (isset($daily)) { ?> value=" <?php echo $daily['wdc8_nm']; ?> " <?php } ?> >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="right_wdc8dose1" class="col-sm-4 control-label">WDC8 Dose</label>
                        <div class="col-sm-8">
                          <input type="text" name="wdc8_dose" class="form-control" id="right_wdc8dose1" <?php if (isset($daily)) { ?> value=" <?php echo $daily['wdc8_dose']; ?> " <?php } ?> >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="right_wdc8qty1" class="col-sm-4 control-label">WDC8 Quantity</label>
                        <div class="col-sm-8">
                          <input type="text" name="wdc8_qty" class="form-control" id="right_wdc8qty1" <?php if (isset($daily)) { ?> value=" <?php echo $daily['wdc8_qty']; ?> " <?php } ?> >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="urea1" class="col-sm-4 control-label">Urea</label>
                        <div class="col-sm-8">
                          <input type="text" name="urea" class="form-control" id="urea1" <?php if (isset($daily)) { ?> value=" <?php echo $daily['urea']; ?> " <?php } ?> >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="u_dose1" class="col-sm-4 control-label">Urea Dose</label>
                        <div class="col-sm-8">
                          <input type="text" name="u_dose" class="form-control" id="u_dose1" <?php if (isset($daily)) { ?> value=" <?php echo $daily['u_dose']; ?> " <?php } ?> >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="ntr9_qty1" class="col-sm-4 control-label">NTR9 Quantity</label>
                        <div class="col-sm-8">
                          <input type="text" name="ntr9_qty" class="form-control" id="ntr9_qty1" <?php if (isset($daily)) { ?> value=" <?php echo $daily['ntr9_qty']; ?> " <?php } ?> >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="zinc1" class="col-sm-4 control-label">Zinc</label>
                        <div class="col-sm-8">
                          <input type="text" name="zinc" class="form-control" id="zinc1" <?php if (isset($daily)) { ?> value=" <?php echo $daily['zinc']; ?> " <?php } ?> >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="z_dose1" class="col-sm-4 control-label">Zinc Dose</label>
                        <div class="col-sm-8">
                          <input type="text" name="z_dose" class="form-control" id="z_dose1" <?php if (isset($daily)) { ?> value=" <?php echo $daily['z_dose']; ?> " <?php } ?> >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="ntr10_qty1" class="col-sm-4 control-label">NTR10 Quantity</label>
                        <div class="col-sm-8">
                          <input type="text" name="ntr10_qty" class="form-control" id="ntr10_qty1" <?php if (isset($daily)) { ?> value=" <?php echo $daily['ntr10_qty']; ?> " <?php } ?> >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="boron" class="col-sm-4 control-label">Boron</label>
                        <div class="col-sm-8">
                          <input type="text" name="boron" class="form-control" id="boron1" <?php if (isset($daily)) { ?> value=" <?php echo $daily['boron']; ?> " <?php } ?> >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="b_dose" class="col-sm-4 control-label">Boron Dose</label>
                        <div class="col-sm-8">
                          <input type="text" name="b_dose" class="form-control" id="b_dose1" <?php if (isset($daily)) { ?> value=" <?php echo $daily['b_dose']; ?> " <?php } ?> >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="ntr11_qty" class="col-sm-4 control-label">NTR11 Quantity</label>
                        <div class="col-sm-8">
                          <input type="text" name="ntr11_qty" class="form-control" id="ntr11_qty1" <?php if (isset($daily)) { ?> value=" <?php echo $daily['ntr11_qty']; ?> " <?php } ?> >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="other1_nm" class="col-sm-4 control-label">Other1 Name</label>
                        <div class="col-sm-8">
                          <input type="text" name="othr1_nm" class="form-control" id="other1_nm1" <?php if (isset($daily)) { ?> value=" <?php echo $daily['othr1_nm']; ?> " <?php } ?> >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="other1_dose" class="col-sm-4 control-label">Other1 Dose</label>
                        <div class="col-sm-8">
                          <input type="text" name="othr1_dose" class="form-control" id="other1_dose1" <?php if (isset($daily)) { ?> value=" <?php echo $daily['othr1_dose']; ?> " <?php } ?> >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="other1_qty1" class="col-sm-4 control-label">Other1 Quantity</label>
                        <div class="col-sm-8">
                          <input type="text" name="othr1_qty" class="form-control" id="other1_qty1" <?php if (isset($daily)) { ?> value=" <?php echo $daily['othr1_qty']; ?> " <?php } ?> >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="other2_nm1" class="col-sm-4 control-label">Other2 Name</label>
                        <div class="col-sm-8">
                          <input type="text" name="othr2_nm" class="form-control" id="other2_nm1" <?php if (isset($daily)) { ?> value=" <?php echo $daily['othr2_nm']; ?> " <?php } ?> >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="other2_dose1" class="col-sm-4 control-label">Other2 Dose</label>
                        <div class="col-sm-8">
                          <input type="text" name="othr2_dose" class="form-control" id="other2_dose1" <?php if (isset($daily)) { ?> value=" <?php echo $daily['othr2_dose']; ?> " <?php } ?> >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="other2_qty" class="col-sm-4 control-label">Other2 Quantity</label>
                        <div class="col-sm-8">
                          <input type="text" name="othr2_qty" class="form-control" id="other2_qty1" <?php if (isset($daily)) { ?> value=" <?php echo $daily['othr2_qty']; ?> " <?php } ?> >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="other3_nm1" class="col-sm-4 control-label">Other3 Name</label>
                        <div class="col-sm-8">
                          <input type="text" name="othr3_nm" class="form-control" id="other3_nm1" <?php if (isset($daily)) { ?> value=" <?php echo $daily['othr3_nm']; ?> " <?php } ?> >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="other3_dose1" class="col-sm-4 control-label">Other3 Dose</label>
                        <div class="col-sm-8">
                          <input type="text" name="othr3_dose" class="form-control" id="other3_dose1" <?php if (isset($daily)) { ?> value=" <?php echo $daily['othr3_dose']; ?> " <?php } ?> >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="other3_qty1" class="col-sm-4 control-label">Other3 Quantity</label>
                        <div class="col-sm-8">
                          <input type="text" name="othr3_qty" class="form-control" id="other3_qty1" <?php if (isset($daily)) { ?> value=" <?php echo $daily['othr3_qty']; ?> " <?php } ?> >
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmModal">Delete Record</button>
                    </div>
                    <div class="col-sm-2 col-sm-offset-4">
                      <button type="submit" name="edit_submit" class="btn btn-success btn-lg">Edit Record</button>
                    </div>
                  </div>
                  <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
                        </div>
                        <div class="modal-body">
                          <p>Are you sure you want to delete this record?</p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="submit" name="del_entry" class="btn btn-danger btn-lg">Confirm Delete</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>



              <div class="tab-pane" id="tab2">
                <form class="form-horizontal" action="daily_spraying_entry.php" method="post">
                  <?php if(isset($_SESSION['daily_plucking'])) { $daily = $_SESSION['daily_plucking']; } else { $daily = NULL; }?>
                  <div class="row">
                    <div class="col-sm-12">
                      <button type="submit" name="add_submit" class="btn btn-success pull-right btn-lg">Add Record</button>
                    </div>
                  </div>
                  <div class="row main-form">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="left_hzar2" class="col-sm-5 control-label">Hazri Area</label>
                        <div class="col-sm-7">
                          <input type="text" name="hz_area" class="form-control" id="left_hzar2">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_dbar2" class="col-sm-5 control-label">Doubly Area</label>
                        <div class="col-sm-7">
                          <input type="text" name="db_area" class="form-control" id="left_dbar2">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_hzmd2" class="col-sm-5 control-label">Hazri Mandays</label>
                        <div class="col-sm-7">
                          <input type="text" name="hz_mandays" class="form-control" id="left_hzmd2">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_hzmx2" class="col-sm-5 control-label">DR Hazri (mixer)</label>
                        <div class="col-sm-7">
                          <input type="text" name="dr_hz_mix" class="form-control" id="left_hzmx2">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_hzpw2" class="col-sm-5 control-label">DR Hazri (paniwalla)</label>
                        <div class="col-sm-7">
                          <input type="text" name="dr_hz_pani" class="form-control" id="left_hzpw2">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drum2" class="col-sm-5 control-label">Drum (short)</label>
                        <div class="col-sm-7">
                          <input type="text" name="drum_short" class="form-control" id="left_drum2">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_mrmd2" class="col-sm-5 control-label">MR Doubly Mandays</label>
                        <div class="col-sm-7">
                          <input type="text" name="mr_db_mnds" class="form-control" id="left_mrmd2">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_nlmd2" class="col-sm-5 control-label">DR Doubly NL Mandays</label>
                        <div class="col-sm-7">
                          <input type="text" name="dr_db_nl_mnds" class="form-control" id="left_nlmd2">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drmd2" class="col-sm-5 control-label">DR Doubly Mandays</label>
                        <div class="col-sm-7">
                          <input type="text" name="dr_db_mnds" class="form-control" id="left_drmd2">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_mcmd2" class="col-sm-5 control-label">MC Doubly Mandays</label>
                        <div class="col-sm-7">
                          <input type="text" name="mc_db_mnds" class="form-control" id="left_mcmd2">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_dbmx2" class="col-sm-5 control-label">DR Doubly Mixer</label>
                        <div class="col-sm-7">
                          <input type="text" name="dr_db_mix" class="form-control" id="left_dbmx2">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_dbpw2" class="col-sm-5 control-label">DR Doubly Paniwalla</label>
                        <div class="col-sm-7">
                          <input type="text" name="dr_db_pani" class="form-control" id="left_dbpw2">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_cocktail2" class="col-sm-5 control-label">Cocktail</label>
                        <div class="col-sm-7">
                          <select class="form-control" name="cocktail" id="left_cocktail2">
                            <option></option>
                            <option>Yes</option>
                            <option>No</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_pst2" class="col-sm-5 control-label">Pest and Disease</label>
                        <div class="col-sm-7">
                          <input type="text" name="pest_disease" class="form-control" id="left_pst2">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_infint2" class="col-sm-5 control-label">Infection Intensity</label>
                        <div class="col-sm-7">
                          <select class="form-control" name="infctn_intensity" id="left_infint2">
                            <option></option>
                            <option>H</option>
                            <option>M</option>
                            <option>L</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp2" class="col-sm-5 control-label">Drums Sprayed</label>
                        <div class="col-sm-7">
                          <input type="text" name="drums_sprayed" class="form-control" id="left_drsp2">
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="right_ins1nm2" class="col-sm-4 control-label">INS1 Name</label>
                        <div class="col-sm-8">
                          <input type="text" name="ins1_nm" class="form-control" id="right_ins1nm2">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="right_ins1dose2" class="col-sm-4 control-label">INS1 Dose</label>
                        <div class="col-sm-8">
                          <input type="text" name="ins1_dose" class="form-control" id="right_ins1dose2">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="right_ins1qty" class="col-sm-4 control-label">INS1 Quantity</label>
                        <div class="col-sm-8">
                          <input type="text" name="ins1_qty" class="form-control" id="right_ins1qty2">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="right_ins2nm2" class="col-sm-4 control-label">INS2 Name</label>
                        <div class="col-sm-8">
                          <input type="text" name="ins2_nm" class="form-control" id="right_ins2nm2">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="right_ins2dose2" class="col-sm-4 control-label">INS2 Dose</label>
                        <div class="col-sm-8">
                          <input type="text" name="ins2_dose" class="form-control" id="right_ins2dose2">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="right_ins2qty2" class="col-sm-4 control-label">INS2 Quantity</label>
                        <div class="col-sm-8">
                          <input type="text" name="ins2_qty" class="form-control" id="right_ins2qty2">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="right_acc3nm2" class="col-sm-4 control-label">ACC3 Name</label>
                        <div class="col-sm-8">
                          <input type="text" name="acc3_nm" class="form-control" id="right_acc3nm2">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="right_acc3dose2" class="col-sm-4 control-label">ACC3 Dose</label>
                        <div class="col-sm-8">
                          <input type="text" name="acc3_dose" class="form-control" id="right_acc3dose2">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="right_acc3qty2" class="col-sm-4 control-label">ACC3 Quantity</label>
                        <div class="col-sm-8">
                          <input type="text" name="acc3_qty" class="form-control" id="right_acc3qty2">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="right_synth4nm2" class="col-sm-4 control-label">SYNTH4 Name</label>
                        <div class="col-sm-8">
                          <input type="text" name="synth4_nm" class="form-control" id="right_synth4nm2">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="right_synth4dose2" class="col-sm-4 control-label">SYNTH4 Dose</label>
                        <div class="col-sm-8">
                          <input type="text" name="synth4_dose" class="form-control" id="right_synth4dose2">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="right_synth4qty2" class="col-sm-4 control-label">SYNTH4 Quantity</label>
                        <div class="col-sm-8">
                          <input type="text" name="synth4_qty" class="form-control" id="right_synth4qty2">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="right_str5nm2" class="col-sm-4 control-label">STR5 Name</label>
                        <div class="col-sm-8">
                          <input type="text" name="str5_nm" class="form-control" id="right_str5nm2">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="right_str5dose2" class="col-sm-4 control-label">STR5 Dose</label>
                        <div class="col-sm-8">
                          <input type="text" name="str5_dose" class="form-control" id="right_str5dose2">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="right_str5qty2" class="col-sm-4 control-label">STR5 Quantity</label>
                        <div class="col-sm-8">
                          <input type="text" name="str5_qty" class="form-control" id="right_str5qty2">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="right_fng6nm2" class="col-sm-4 control-label">FNG6 Name</label>
                        <div class="col-sm-8">
                          <input type="text" name="fng6_nm" class="form-control" id="right_fng6nm2">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="right_fng6dose2" class="col-sm-4 control-label">FNG6 Dose</label>
                        <div class="col-sm-8">
                          <input type="text" name="fng6_dose" class="form-control" id="right_fng6dose2">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="right_fng6qty2" class="col-sm-4 control-label">FNG6 Quantity</label>
                        <div class="col-sm-8">
                          <input type="text" name="fng6_qty" class="form-control" id="right_fng6qty2">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="right_wdc7nm2" class="col-sm-4 control-label">WDC7 Name</label>
                        <div class="col-sm-8">
                          <input type="text" name="wdc7_nm" class="form-control" id="right_wdc7nm2">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="right_wdc7dose2" class="col-sm-4 control-label">WDC7 Dose</label>
                        <div class="col-sm-8">
                          <input type="text" name="wdc7_dose" class="form-control" id="right_wdc7dose2">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="right_wdc7qty2" class="col-sm-4 control-label">WDC7 Quantity</label>
                        <div class="col-sm-8">
                          <input type="text" name="wdc7_qty" class="form-control" id="right_wdc7qty2">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="right_wdc8nm2" class="col-sm-4 control-label">WDC8 Name</label>
                        <div class="col-sm-8">
                          <input type="text" name="wdc8_nm" class="form-control" id="right_wdc8nm2">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="right_wdc8dose2" class="col-sm-4 control-label">WDC8 Dose</label>
                        <div class="col-sm-8">
                          <input type="text" name="wdc8_dose" class="form-control" id="right_wdc8dose2">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="right_wdc8qty2" class="col-sm-4 control-label">WDC8 Quantity</label>
                        <div class="col-sm-8">
                          <input type="text" name="wdc8_qty" class="form-control" id="right_wdc8qty2">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="urea2" class="col-sm-4 control-label">Urea</label>
                        <div class="col-sm-8">
                          <input type="text" name="urea" class="form-control" id="urea2">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="u_dose2" class="col-sm-4 control-label">Urea Dose</label>
                        <div class="col-sm-8">
                          <input type="text" name="u_dose" class="form-control" id="u_dose2">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="ntr9_qty2" class="col-sm-4 control-label">NTR9 Quantity</label>
                        <div class="col-sm-8">
                          <input type="text" name="ntr9_qty" class="form-control" id="ntr9_qty2">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="zinc2" class="col-sm-4 control-label">Zinc</label>
                        <div class="col-sm-8">
                          <input type="text" name="zinc" class="form-control" id="zinc2">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="z_dose2" class="col-sm-4 control-label">Zinc Dose</label>
                        <div class="col-sm-8">
                          <input type="text" name="z_dose" class="form-control" id="z_dose2">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="ntr10_qty2" class="col-sm-4 control-label">NTR10 Quantity</label>
                        <div class="col-sm-8">
                          <input type="text" name="ntr10_qty" class="form-control" id="ntr10_qty2">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="boron2" class="col-sm-4 control-label">Boron</label>
                        <div class="col-sm-8">
                          <input type="text" name="boron" class="form-control" id="boron2">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="b_dose2" class="col-sm-4 control-label">Boron Dose</label>
                        <div class="col-sm-8">
                          <input type="text" name="b_dose" class="form-control" id="b_dose2">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="ntr11_qty2" class="col-sm-4 control-label">NTR11 Quantity</label>
                        <div class="col-sm-8">
                          <input type="text" name="ntr11_qty" class="form-control" id="ntr11_qty2">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="other1_nm2" class="col-sm-4 control-label">Other1 Name</label>
                        <div class="col-sm-8">
                          <input type="text" name="othr1_nm" class="form-control" id="other1_nm2">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="other1_dose2" class="col-sm-4 control-label">Other1 Dose</label>
                        <div class="col-sm-8">
                          <input type="text" name="othr1_dose" class="form-control" id="other1_dose2">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="other1_qty2" class="col-sm-4 control-label">Other1 Quantity</label>
                        <div class="col-sm-8">
                          <input type="text" name="othr1_qty" class="form-control" id="other1_qty2">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="other2_nm2" class="col-sm-4 control-label">Other2 Name</label>
                        <div class="col-sm-8">
                          <input type="text" name="othr2_nm" class="form-control" id="other2_nm2">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="other2_dose2" class="col-sm-4 control-label">Other2 Dose</label>
                        <div class="col-sm-8">
                          <input type="text" name="othr2_dose" class="form-control" id="other2_dose2">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="other2_qty2" class="col-sm-4 control-label">Other2 Quantity</label>
                        <div class="col-sm-8">
                          <input type="text" name="othr2_qty" class="form-control" id="other2_qty2">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="other3_nm2" class="col-sm-4 control-label">Other3 Name</label>
                        <div class="col-sm-8">
                          <input type="text" name="othr3_nm" class="form-control" id="other3_nm2">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="other3_dose2" class="col-sm-4 control-label">Other3 Dose</label>
                        <div class="col-sm-8">
                          <input type="text" name="othr3_dose" class="form-control" id="other3_dose2">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="other3_qty2" class="col-sm-4 control-label">Other3 Quantity</label>
                        <div class="col-sm-8">
                          <input type="text" name="othr3_qty" class="form-control" id="other3_qty2">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <button type="submit" name="add_submit" class="btn btn-success pull-right btn-lg">Add Record</button>
                    </div>
                  </div>
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
    				$( "#datepicker" ).datepicker({dateFormat: 'dd-mm-yy'});
    				});
    		</script>
        </body>
    </body>
</html>

<?php
  mysqli_free_result($result);
	end_connection($connection);
?>
