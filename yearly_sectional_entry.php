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
                          <select id="year" name ="yr" class="col-sm-3 form-control" style="margin-top:10px;"required>
                            <option>Select year</option>
                          </select>

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
  									<input type="text" name="prn_type" class="form-control" id="prune_type">
  								</div>
  							</div>
  							<div class="form-group">
  								<label for="tipp" class="col-sm-3 control-label">Tipping:</label>
  								<div class="col-sm-4">
  									<input type="text" name="tip_hght" class="form-control" id="tipp">
  								</div>
  							</div>
  							<div class="form-group">
  								<label for="Md_tea" class="col-sm-3 control-label">Made Tea (Kg/Ha):</label>
  								<div class="col-sm-4">
  									<input type="text" name="md_t" class="form-control" id="Md_tea" >
  								</div>
  							</div>
  							<div class="form-group">
  								<label for="vcp" class="col-sm-3 control-label">Vacancy (in %):</label>
  								<div class="col-sm-4">
  									<input type="text" name="vacancy_p" class="form-control" id="vcp">
  								</div>
  							</div>
  							<div class="form-group">
  								<label for="shd_sts" class="col-sm-3 control-label">Shade Status:</label>
  								<div class="col-sm-4">
  									<input type="text" class="form-control" id="shd_sts" name="shade_sts">
  								</div>
  							</div>
  							<div class="form-group">
  								<label for="infill_t" class="col-sm-3 control-label">Infill (Tea):</label>
  								<div class="col-sm-4">
  									<input type="text" class="form-control" id="infill_t" name="inf_t">
  								</div>
  							</div>
                <div class="form-group">
                  <label for="infill_shd" class="col-sm-3 control-label">Infill (Shade):</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="infill_shd" name="infill_shade">
                  </div>
                </div>
                <div class="form-group">
                  <label for="Remarks" class="col-sm-3 control-label">Remarks:</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="Remarks" name="rem">
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
  									<input type="text" name="prn_type" class="form-control" id="prune_type">
  								</div>
  							</div>
  							<div class="form-group">
  								<label for="tipp" class="col-sm-3 control-label">Tipping:</label>
  								<div class="col-sm-4">
  									<input type="text" name="tip_hght" class="form-control" id="tipp">
  								</div>
  							</div>
  							<div class="form-group">
  								<label for="Md_tea" class="col-sm-3 control-label">Made Tea (Kg/Ha):</label>
  								<div class="col-sm-4">
  									<input type="text" name="md_t" class="form-control" id="Md_tea" >
  								</div>
  							</div>
  							<div class="form-group">
  								<label for="vcp" class="col-sm-3 control-label">Vacancy (in %):</label>
  								<div class="col-sm-4">
  									<input type="text" name="vacancy_p" class="form-control" id="vcp">
  								</div>
  							</div>
  							<div class="form-group">
  								<label for="shd_sts" class="col-sm-3 control-label">Shade Status:</label>
  								<div class="col-sm-4">
  									<input type="text" class="form-control" id="shd_sts" name="shade_sts">
  								</div>
  							</div>
  							<div class="form-group">
  								<label for="infill_t" class="col-sm-3 control-label">Infill (Tea):</label>
  								<div class="col-sm-4">
  									<input type="text" class="form-control" id="infill_t" name="inf_t">
  								</div>
  							</div>
                <div class="form-group">
                  <label for="infill_shd" class="col-sm-3 control-label">Infill (Shade):</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="infill_shd" name="infill_shade">
                  </div>
                </div>
                <div class="form-group">
                  <label for="Remarks" class="col-sm-3 control-label">Remarks:</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="Remarks" name="rem">
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
  		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
      <script>
        
      </script>
    </body>
</html>
