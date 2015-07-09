<?php
	require_once('includes/sessions.php');
	require_once('includes/functions.php');

	if(!isset($_SESSION['user'])) {
		redirect_to("index.php");
	}
?>
<?php
	$connection = make_connection();

	//var_dump($_POST);echo "<br><hr>";


<!DOCTYPE html>
<html>
    <head>
      <meta charset="utf-8">
      <title>R.D. Tea | Daily Spraying Entry</title>
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
                <button type="submit" name="dt_sec_submit" class="btn btn-success" style="margin-top:-1px;">Submit</button>
            </form>
        </div>
          <div class="col-sm-12 card_style" style="padding-bottom:15px;">
            <ul class="nav nav-tabs nav-justified">
              <li id="ac_one"><a href="#tab1" data-toggle="tab" id="take1">Update or Delete Record</a></li>
              <li id="ac_two"><a href="#tab2" data-toggle="tab" id="take2">Add Record</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane" id="tab1">
                <form class="form-horizontal" action="daily_spraying_entry.php" method="post">
                  <div class="row main-form">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="left_hzar1" class="col-sm-5 control-label">Hazri Area</label>
                        <div class="col-sm-7">
                          <input type="text" name="hz_area" class="form-control" id="left_hzar1" <?php if (isset($daily)) { ?> value=" <?php echo $daily['hz_area']; ?> " <?php } ?> required>
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
                          <input type="text" name="hz_area" class="form-control" id="left_hzar2" required>
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
                        <label for="left_infint2" class="col-sm-5 control-label">Infestation Intensity</label>
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
				<?php
					if(isset($var_chk)){
					echo"<script>		var submit_chk=$var_chk; submit_chk2=$sub_enable_two; </script>";}

					?>
					<script>
							document.getElementById('take1').disabled=true;
							document.getElementById('take2').disabled=true;
										if(submit_chk==1 && submit_chk2)
										{
													var b2=document.getElementById('ac_one');
													b2.style.backgroundColor = '#01579B';
													var c2=document.getElementById('take1');
													var a2=document.getElementById('tab1');
													a2.setAttribute('class', 'active');
													c2.style.color='#FFFFFF';
													document.getElementById('take2').disabled=true;
										}
										if(submit_chk==2 && submit_chk2){
											// document.getElementById('take2').disabled=false;
											var b1=	document.getElementById('ac_two');
											var c1=document.getElementById('take2');
											b1.style.backgroundColor = '#01579B';
											c1.style.color = '#FFFFFF';
											var a1=document.getElementById('tab2');
											a1.setAttribute('class', 'active');
											document.getElementById('take1').disabled=true;

										}


					</script>

        </body>
    </body>
</html>

<?php
  mysqli_free_result($result);
	end_connection($connection);
?>
