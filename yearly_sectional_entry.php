<?php
	require_once('/includes/sessions.php');
	require_once('/includes/functions.php');

	if(!isset($_SESSION['user'])) {
		redirect_to("index.php");
	}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>R.D. Tea | Yearly Sectional Entry</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
				<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
				<link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css">
        <link rel="stylesheet" href="css/stylesheet.css">
        <link rel="icon" href="images/logo_rdtea.png"/>
				<style>
					.btn-default {
						background: #FFFFFF;
						color:Black;
						border: none;
            margin-left:15px;
					}
          @media screen and (min-width: 770px) {
              .jumbotron{
                  margin-left:-15px;
						      margin-right: -15px;
                }

          }

					.jumbotron{
						 background:#3F51B5;
					   padding-bottom: 25px;
					}
					.jumbotron h1{
						color:#E6E8F9;
            padding-bottom: 10px;
					}
          .nav-tabs.nav-justified > .active > a, .nav-tabs.nav-justified > .active > a:hover, .nav-tabs.nav-justified > .active > a:active, .nav-tabs.nav-justified > .active > a:enabled {
          background-color: #1A237E !important;
          border-bottom-color: #5D4037;
          color: #FFFFFF;
          }

	      </style>
        <?php $page_id = 13;?>
    </head>
    <body>
         <?php
            include("nav_bar.php");
            nav_echoer($page_id);
        ?>
      <div class="container">
              <div class="jumbotron">
                  <h1>Yearly Sectional Entry</h1>
                  <form action="" method="post" class="form-horizontal" style="margin-top: 30px;">
                    <div class="row col-sm-12">
                      <div class="form-group col-sm-6">
                        <label for="section">Select section:</label>
                        <div>
        									<select id="section" name ="short_sec_name" class="col-sm-3 form-control" style="margin-top:10px;"required>
        										<option>Select section</option>
                            <!-- <option>2</option>
                            <option>3</option> -->
        									</select>
                        </div>
                      </div>
                    </div>
                    <div class="row col-sm-12">
                      <div class="form-group col-sm-6">
                        <label for="year">Select Year:</label>
                        <div>
                        <input type="text" id="year" class="form-control">

                        </div>
                      </div>
                    </div>
                       <div class="form-group">
    									    <input type="submit" id="selct_sec" name="dt_sec_submit" value="Add Data" class="btn btn-default" style="margin-top:10px;">
                       </div>

                  </form>

              </div>
  			<div class="tab-container">
  	            <ul class="nav nav-tabs nav-justified">
  	                <li class="active" id="actv_one"><a href="#tab1" data-toggle="tab" id="link_one">Edit Entry</a></li>
  	                <li id="actv_two"><a href="#tab2" data-toggle="tab" id="link_two">Add Entry</a></li>
  	            </ul>
  				<div class="tab-content" style="background-color:#FFFFFF">
  					<div class="tab-pane active" id="tab1">
  						<form class="form-horizontal" action="" method="post">

                <div class="form-group" style="margin-top:30px">
  								<label for="prune_type" class="col-sm-3 control-label">Prune Type:</label>
  								<div class="col-sm-4">
  									<input type="text" placeholder="Prune Type" name="prn_type" class="form-control" id="prune_type">
  								</div>
  							</div>
  							<div class="form-group">
  								<label for="tipp" class="col-sm-3 control-label">Tipping:</label>
  								<div class="col-sm-4">
  									<input type="text" name="tip_hght" placeholder=" Tipping" class="form-control" id="tipp">
  								</div>
  							</div>
  							<div class="form-group">
  								<label for="Md_tea" class="col-sm-3 control-label">Made Tea (Kg/Ha):</label>
  								<div class="col-sm-4">
  									<input type="text" name="md_t" placeholder=" Made Tea (Kg/Ha)" class="form-control" id="Md_tea" >
  								</div>
  							</div>
  							<div class="form-group">
  								<label for="vcp" class="col-sm-3 control-label">Vacancy (in %):</label>
  								<div class="col-sm-4">
  									<input type="text" name="vacancy_p" placeholder="Vacancy (in %)" class="form-control" id="vcp">
  								</div>
  							</div>
  							<div class="form-group">
  								<label for="shd_sts" class="col-sm-3 control-label">Shade Status:</label>
  								<div class="col-sm-4">
  									<input type="text" class="form-control" placeholder="Shade Status" id="shd_sts" name="shade_sts">
  								</div>
  							</div>
  							<div class="form-group">
  								<label for="infill_t" class="col-sm-3 control-label">Infill (Tea):</label>
  								<div class="col-sm-4">
  									<input type="text" placeholder="Infill (Tea)" class="form-control" id="infill_t" name="inf_t">
  								</div>
  							</div>
                <div class="form-group">
                  <label for="infill_shd" class="col-sm-3 control-label">Infill (Shade):</label>
                  <div class="col-sm-4">
                    <input type="text" placeholder=" Infill (Shade):" class="form-control" id="infill_shd" name="infill_shade">
                  </div>
                </div>
                <div class="form-group">
                  <label for="Remarks_prn_1" class="col-sm-3 control-label">Remarks for Pruning:</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" placeholder="Remarks" id="Remarks_prn_1" name="Remarks_prn_1">
                  </div>
                </div>
								<div class="form-group">
									<label for="man_n1" class="col-sm-3 control-label">Na (Manuring):</label>
									<div class="col-sm-4">
										<input type="text" class="form-control"placeholder="Na (Manuring)" id="man_n1" name="man_n1">
									</div>
								</div>
								<div class="form-group">
									<label for="man_p1" class="col-sm-3 control-label">P (Manuring):</label>
									<div class="col-sm-4">
										<input type="text" class="form-control"  placeholder="P (Manuring)" id="man_p1" name="man_p1">
									</div>
								</div>
								<div class="form-group">
									<label for="man_k1" class="col-sm-3 control-label">K (Manuring):</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" id="man_k1" placeholder="K (Manuring)" name="man_k1">
									</div>
								</div>
								<div class="form-group">
									<label for="top1" class="col-sm-3 control-label">Top (in pH):</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" placeholder="Top (in pH)" id="top1" name="top1">
									</div>
								</div>
								<div class="form-group">
									<label for="sub1" class="col-sm-3 control-label">Sub (in pH):</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" id="sub1" placeholder="Sub (in pH)" name="sub1">
									</div>
								</div>
								<div class="form-group">
									<label for="orgc1" class="col-sm-3 control-label">Org C (in %):</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" id="orgc1" placeholder="Org C " name="orgc1">
									</div>
								</div>
								<div class="form-group">
									<label for="avp1" class="col-sm-3 control-label">Av P (in ppm):</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" id="avp1" placeholder="Av P" name="avp1">
									</div>
								</div>
								<div class="form-group">
									<label for="Avk1" class="col-sm-3 control-label">Av K (in ppm):</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" id="avk1" placeholder="Av K " name="avk1">
									</div>
								</div>
								<div class="form-group">
									<label for="avbln1" class="col-sm-3 control-label">Avbl N (in ppm):</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" id="avbln1" placeholder="Avbl N" name="avbln1">
									</div>
								</div>
								<div class="form-group">
									<label for="avbls1" class="col-sm-3 control-label">Avbl S (in ppm):</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" id="avbls1" placeholder="Avbl S" name="avbls1">
									</div>
								</div>
								<div class="form-group">
									<label for="remarks_soil_2" class="col-sm-3 control-label">Remarks for Soil Analysis:</label>
									<div class="col-sm-4">
										<input type="text" class="form-control"placeholder="Remarks" id="remarks_soil_2" name="remarks_soil_2">
									</div>
								</div>
  							<div class="row">
  								<div class="col-sm-1 col-sm-offset-2">
  									<button type="button" value="Delete Entry" id="delete_entry" class="btn btn-danger" data-toggle="modal" data-target="#confirmModal" style="margin-top:20px;">Delete Entry</button>
  								</div>
  										<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModallabel">
  											<div class="modal-dialog" role="document">
  												<div class="modal-content">
  													<div class="modal-header">
  														<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  														<h4 class="modal-title" id="myModalLabel">Confirm Delete?</h4>
  													</div>
  													<div class="modal-body">
  														<p>Are you sure you wish to delete this entry?</p>
  													</div>
  													<div class="modal-footer">
  														<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  														<input type="submit"  name="del_entry" class="btn btn-danger" value="Confirm Delete">
  													</div>
  												</div>
  											</div>
  										</div>
  								<div class="col-sm-2 col-sm-offset-3">
  									  <input type="submit" id="edit_entry" name="edit_submit" value="Edit Entry" class="btn btn-success" style="margin-top:20px;">
  								</div>
  							</div>
              </form>
  					</div>
  					<div class="tab-pane" id="tab2">
  						<form class="form-horizontal" action="daily_plucking_entry.php" method="post">
                <div class="form-group" style="margin-top:30px">
  								<label for="prune_type" class="col-sm-3 control-label">Prune Type:</label>
  								<div class="col-sm-4">
  									<input type="text" name="prn_type" placeholder="Prune Type" class="form-control" id="prune_type">
  								</div>
  							</div>
  							<div class="form-group">
  								<label for="tipp" class="col-sm-3 control-label">Tipping:</label>
  								<div class="col-sm-4">
  									<input type="text" name="tip_hght" placeholder="Tipping" class="form-control" id="tipp">
  								</div>
  							</div>
  							<div class="form-group">
  								<label for="Md_tea" class="col-sm-3 control-label">Made Tea (Kg/Ha):</label>
  								<div class="col-sm-4">
  									<input type="text" name="md_t" placeholder="Made Tea (Kg/Ha)" class="form-control" id="Md_tea" >
  								</div>
  							</div>
  							<div class="form-group">
  								<label for="vcp" class="col-sm-3 control-label">Vacancy (in %):</label>
  								<div class="col-sm-4">
  									<input type="text" name="vacancy_p" placeholder="Vacancy (in %)" class="form-control" id="vcp">
  								</div>
  							</div>
  							<div class="form-group">
  								<label for="shd_sts" class="col-sm-3 control-label">Shade Status:</label>
  								<div class="col-sm-4">
  									<input type="text" class="form-control" placeholder="Shade Status" id="shd_sts" name="shade_sts">
  								</div>
  							</div>
  							<div class="form-group">
  								<label for="infill_t" class="col-sm-3 control-label">Infill (Tea):</label>
  								<div class="col-sm-4">
  									<input type="text" class="form-control" placeholder="Infill (Tea)" id="infill_t" name="inf_t">
  								</div>
  							</div>
                <div class="form-group">
                  <label for="infill_shd" class="col-sm-3 control-label">Infill (Shade):</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="infill_shd" placeholder="Infill (Shade)" name="infill_shade">
                  </div>
                </div>
                <div class="form-group">
                  <label for="Remarks_prn_2" class="col-sm-3 control-label">Remarks for Pruning:</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="Remarks_prn_2" placeholder="Remarks" name="Remarks_prn_2">
                  </div>
                </div>
								<div class="form-group">
									<label for="man_n2" class="col-sm-3 control-label">Na (Manuring):</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" placeholder="Na (Manuring)" id="man_n2" name="man_n2">
									</div>
								</div>
								<div class="form-group">
									<label for="man_p2" class="col-sm-3 control-label">P (Manuring):</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" id="man_p2" placeholder="P (Manuring)" name="man_p2">
									</div>
								</div>
								<div class="form-group">
									<label for="man_k2" class="col-sm-3 control-label">K (Manuring):</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" id="man_k2" placeholder="K (Manuring)" name="man_k2">
									</div>
								</div>
								<div class="form-group">
									<label for="top2" class="col-sm-3 control-label">Top (in pH):</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" id="top2" placeholder="Top (in pH)" name="top2">
									</div>
								</div>
								<div class="form-group">
									<label for="sub2" class="col-sm-3 control-label">Sub (in pH):</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" id="sub2" placeholder="Sub (in pH)" name="sub2">
									</div>
								</div>
								<div class="form-group">
									<label for="orgc2" class="col-sm-3 control-label">Org C (in %):</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" id="orgc2" placeholder="Org C" name="orgc2">
									</div>
								</div>
								<div class="form-group">
									<label for="avp2" class="col-sm-3 control-label">Av P (in ppm):</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" id="avp2" placeholder="Av P" name="avp2">
									</div>
								</div>
								<div class="form-group">
									<label for="Avk2" class="col-sm-3 control-label">Av K (in ppm):</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" id="avk2"  placeholder="Av K" name="avk2">
									</div>
								</div>
								<div class="form-group">
									<label for="avbln2" class="col-sm-3 control-label">Avbl N (in ppm):</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" id="avbln2" placeholder="Avbl N" name="avbln2">
									</div>
								</div>
								<div class="form-group">
									<label for="avbls2" class="col-sm-3 control-label">Avbl S (in ppm):</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" id="avbls2" placeholder="Avbl S" name="avbls2">
									</div>
								</div>
								<div class="form-group">
									<label for="remarks_soil_2" class="col-sm-3 control-label">Remarks for Soil Analysis:</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" placeholder="Remarks" id="remarks_soil_2" name="remarks_soil_2">
									</div>
								</div>

            		<input type="submit" id="add_entry" name="add_submit" value="Add Entry" class="btn btn-success"style="margin-top:20px">
  		    		</form>
  					</div>
  				</div>
  			</div>
      </div>
  		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment-with-locales.min.js"></script>
  		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
			<script src="scripts/bootstrap-datetimepicker.min.js"></script>
      <script>
			$(function() {
				$('#year').datetimepicker({
					locale:'en',
					format:'YYYY'
				});
			});
      </script>
    </body>
</html>
