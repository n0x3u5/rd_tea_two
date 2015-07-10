<?php
  require_once('includes/sessions.php');
  require_once('includes/functions.php');

  if(!isset($_SESSION['user'])) {
    redirect_to("index.php");
  }
?>

<?php

  $connection = make_connection();
  if($_SESSION["user_div"] == "ALL") {
    $req_div = $_SESSION["current_div"];
  }
  else {
    $req_div = $_SESSION["user_div"];
  }
  $_SESSION['div_name'] = $req_div;

  if(isset($_POST["section_submit"])) {

    $sec_nm = mysqli_real_escape_string($connection, $_POST["sec_nm"]);
    $sec_shrt_nm = mysqli_real_escape_string($connection, $_POST["sec_short_nm"]);
    $sec_area = (float) mysqli_real_escape_string($connection, $_POST["sec_area"]);
    $stats = mysqli_real_escape_string($connection, $_POST["status"]);
    $jat = mysqli_real_escape_string($connection, $_POST["jat"]);
    $shd_spcs_tmp = mysqli_real_escape_string($connection, $_POST["shade_species_temp"]);
    $shd_spcs_perm = mysqli_real_escape_string($connection, $_POST["shade_species_perm"]);
    $frame_ht = (float) mysqli_real_escape_string($connection, $_POST["Frame_Height"]);
    $bush_ht = (float) mysqli_real_escape_string($connection, $_POST["Bush_Height"]);
    $plntng_yr = mysqli_real_escape_string($connection, $_POST["Planting_year"]);
    $plnt_spcing = (float) mysqli_real_escape_string($connection, $_POST["Plant_Spacing"]);
    $tmp_shd_spcing = (float) mysqli_real_escape_string($connection, $_POST["Temp_Shade_spacing"]);
    $prm_shd_spcing = (float) mysqli_real_escape_string($connection, $_POST["Perm_Shade_spacing"]);
    $plnt_dens = (float) mysqli_real_escape_string($connection, $_POST["Plant_Density"]);
    $bsh_popu = (int) mysqli_real_escape_string($connection, $_POST["Bush_Popu"]);
    $drn_stats = mysqli_real_escape_string($connection, $_POST["Drain_Status"]);
    $soil_topo = mysqli_real_escape_string($connection, $_POST["Soil_Topo"]);
    $ext_rplnt = (int) mysqli_real_escape_string($connection, $_POST["ext_rplnt"]);

    $q_in = "INSERT INTO sections ";
    $q_in .= "(division, sec_name, short_sec_name, total_area, jat,";
    $q_in .= " shade_spcs_temp, shade_spcs_perm, frame_height, bush_height,";
    $q_in .= " yr_of_plant, plant_spacing,temp_shd_spcing, perm_shd_spcing,";
    $q_in .= " plant_density, bush_pop, drain_stats, soil_topo, ext_rplnt, prune_style)";
    $q_in .= " VALUES ('{$_SESSION['div_name']}', '{$sec_nm}', '{$sec_shrt_nm}', {$sec_area}, '{$jat}', '{$shd_spcs_tmp}', '{$shd_spcs_perm}',";
    $q_in .= " {$frame_ht}, {$bush_ht}, {$plntng_yr}, {$plnt_spcing}, {$tmp_shd_spcing}, {$prm_shd_spcing},";
    $q_in .= " {$plnt_dens}, {$bsh_popu}, '{$drn_stats}', '{$soil_topo}', {$ext_rplnt}, '{$stats}' )";


    $result = mysqli_query($connection, $q_in);

    confirm_query($result);
    if(mysqli_affected_rows($connection) > 0) {

      echo "
      <div class='container'>
      <div class='alert alert-success alert-dismissible' role='alert' style='border: 2px solid #4DB6AC'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong>Success!</strong> Inserted sucessfully!
      </div>
      <div>";

		}
		else {
      echo "
      <div class='container'>
      <div class='alert alert-danger alert-dismissible' role='alert' style='border: 2px solid red'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong>Sorry!</strong> No row affected!
      </div>
      <div>";
		}
    $_SESSION['div_name'] = NULL;
  }




  //an effort to run the update
  if(isset($_POST["update_submit"])) {
    //var_dump($_POST);
    $req_ssn = mysqli_real_escape_string($connection, $_SESSION['upd_ssn']);
    $q_req_ssn = "SELECT * FROM sections WHERE short_sec_name = '{$req_ssn}' AND division = '{$_SESSION['div_name']}'";
    //var_dump($q_req_ssn);

    $req_result = mysqli_query($connection, $q_req_ssn);
    confirm_query($req_result);
    $req_sec = mysqli_fetch_assoc($req_result);
    // echo "<hr>";
    // var_dump($req_sec);
    // echo "rec_sec_id=".$req_sec['id'];
    $req_ID = $req_sec['id'];

    $sec_nm = mysqli_real_escape_string($connection, $_POST["sec_nm"]);
    $sec_shrt_nm = mysqli_real_escape_string($connection, $_POST["sec_short_nm"]);
    $sec_area = (float) mysqli_real_escape_string($connection, $_POST["sec_area"]);
    $stats = mysqli_real_escape_string($connection, $_POST["status"]);
    $jat = mysqli_real_escape_string($connection, $_POST["jat"]);
    $shd_spcs_tmp = mysqli_real_escape_string($connection, $_POST["shade_species_temp"]);
    $shd_spcs_perm = mysqli_real_escape_string($connection, $_POST["shade_species_perm"]);
    $frame_ht = (float) mysqli_real_escape_string($connection, $_POST["Frame_Height"]);
    $bush_ht = (float) mysqli_real_escape_string($connection, $_POST["Bush_Height"]);
    $plntng_yr = mysqli_real_escape_string($connection, $_POST["Planting_year"]);
    $plnt_spcing = (float) mysqli_real_escape_string($connection, $_POST["Plant_Spacing"]);
    $tmp_shd_spcing = (float) mysqli_real_escape_string($connection, $_POST["Temp_Shade_spacing"]);
    $prm_shd_spcing = (float) mysqli_real_escape_string($connection, $_POST["Perm_Shade_spacing"]);
    $plnt_dens = (float) mysqli_real_escape_string($connection, $_POST["Plant_Density"]);
    $bsh_popu = (int) mysqli_real_escape_string($connection, $_POST["Bush_Popu"]);
    $drn_stats = mysqli_real_escape_string($connection, $_POST["Drain_Status"]);
    $soil_topo = mysqli_real_escape_string($connection, $_POST["Soil_Topo"]);
    $ext_rplnt = (int) mysqli_real_escape_string($connection, $_POST["ext_rplnt"]);

    $q_up = "UPDATE sections SET ";
    $q_up .= " division ='{$_SESSION['div_name']}', sec_name = '{$sec_nm}', short_sec_name = '{$sec_shrt_nm}', total_area = {$sec_area} , jat = '{$jat}',";
    $q_up .= " shade_spcs_temp = '{$shd_spcs_tmp}', shade_spcs_perm = '{$shd_spcs_perm}',";
    $q_up .= " frame_height = {$frame_ht}, bush_height = {$bush_ht},";
    $q_up .= " yr_of_plant = {$plntng_yr}, plant_spacing = {$plnt_spcing},";
    $q_up .= " temp_shd_spcing = {$tmp_shd_spcing}, perm_shd_spcing = {$prm_shd_spcing},";
    $q_up .= " plant_density = {$plnt_dens}, bush_pop = {$bsh_popu}, drain_stats ='{$drn_stats}',";
    $q_up .= " soil_topo = '{$soil_topo}', ext_rplnt = {$ext_rplnt}, prune_style = '{$stats}'";
    $q_up .= " WHERE id = $req_ID";

    $result_up = mysqli_query($connection, $q_up);
    //var_dump($q_up);
    //var_dump($result_up);

    confirm_query($result_up);
    if(mysqli_affected_rows($connection) > 0) {
      echo "
      <div class='container'>
      <div class='alert alert-success alert-dismissible' role='alert' style='border: 2px solid #4DB6AC'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong>Success!</strong> Updated sucessfully!
      </div>
      <div>";
		}
		else {
      echo "
      <div class='container'>
      <div class='alert alert-danger alert-dismissible' role='alert' style='border: 2px solid red'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong>Sorry!</strong> No row affected!
      </div>
      <div>";
		}
    // mysqli_free_result($req_result);
    //
    // mysqli_free_result($result_up);
    $_SESSION['upd_ssn'] = NULL;
    $_SESSION['div_name'] = NULL;
  }
?>
<?php
  if(isset($_POST['rmv_sec_submit'])) {
    $ssn = mysqli_real_escape_string($connection, $_POST['sec_short_name']);

    $q = "DELETE FROM sections WHERE short_sec_name = '{$ssn}' and division = '{$_SESSION['div_name']}'";
    $result = mysqli_query($connection, $q);

    confirm_query($result);
    if(mysqli_affected_rows($connection) > 0) {
      echo "
      <div class='container'>
      <div class='alert alert-success alert-dismissible' role='alert' style='border: 2px solid #4DB6AC'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong>Success!</strong> Deleted sucessfully!
      </div>
      <div>";

    }
    else {
      echo "
      <div class='container'>
      <div class='alert alert-danger alert-dismissible' role='alert' style='border: 2px solid red'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong>Sorry!</strong> No row affected!
      </div>
      <div>";

    }
    $_SESSION['div_name'] = NULL;
  }
  else {
    $ssn = NULL;
  }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>R.D. Tea | Manage Sections</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/stylesheet.css">
        <link rel="icon" href="images/logo_rdtea.png"/>

        <?php $page_id = 2;?>
        <style>
        .nav-tabs.nav-justified > .active > a, .nav-tabs.nav-justified > .active > a:hover, .nav-tabs.nav-justified > .active > a:active, .nav-tabs.nav-justified > .active > a:enabled {
            background-color: #327640 !important;
            border-bottom-color: #ffffff;
            color: #FFFFFF;
        }
        </style>
    </head>
    <body>
        <?php
            include("nav_bar.php");
            nav_echoer($page_id);
        ?>
        <div class="container">
            <div class="jumbotron" style="background:#006064;margin-left: -15px;margin-right: -15px;">
                <h1>Manage Sections</h1>
                <p style="color:#B2DFDB">Add or remove a section</p>
              <form action="manage_sections.php" method="post">
                <input type="submit" class="btn btn-success" id="hide_me" value="Show Fields" name = "hide_me">
              </form>
            </div>

            <?php
              if(isset($_POST['div_submit'])) {
                echo "Please press the \"Show Fields\" button above!";
              }
              elseif(isset($_POST['hide_me'])) {


            ?>

            <div class="tab-container">
                <ul class="nav nav-tabs nav-justified">
                    <li class="active"><a href="#tab1" data-toggle="tab">View and Update Section</a></li>
                    <li><a href="#tab2" data-toggle="tab">Remove Section</a></li>
                    <li ><a href="#tab3" data-toggle="tab">Add Section</a></li>
                </ul>
                <div class="tab-content"  style="background-color:#0097A7">
                    <div class="tab-pane active" id="tab1">
                        <form id="view_update_section" class="form-horizontal" action="manage_sections.php" method="post" size="10">
                          <?php if(isset($_POST['view_submit'])) {
                                  $ssnV = mysqli_real_escape_string($connection, $_POST['sec_short_name']);
                                  $_SESSION['upd_ssn'] = $ssnV;
                                  //echo "ssnV=".$ssnV;
                                  $q2 = " SELECT * FROM sections WHERE short_sec_name = '{$ssnV}' and division='{$_SESSION['div_name']}'";

                                  $result = mysqli_query($connection, $q2);
                                  confirm_query($result);

                                  $sec = mysqli_fetch_assoc($result);

                                }
                                else {
                                  $sec = NULL;
                                }
                          ?>
                          <label for="sec_short_name">Select The Section:</label>
                          <div class="input-group">
                              <span class="input-group-addon"><i class="glyphicon glyphicon-grain"></i></span>
                              <select  class="form-control" name="sec_short_name" form="view_update_section" required>
                                <?php
                                    $q = "SELECT * FROM sections where division = '{$_SESSION['div_name']}'";
                                    $result = mysqli_query($connection, $q);

                                    confirm_query($result);
                                    //$_POST['sec_short_nm'] = NULL;

                                    echo "<option id=\"opt0\" value=\"Select a section...\">Select a section...</option>";
                                    while($sec_values = mysqli_fetch_assoc($result)) {
                                ?>

                                      <option value="<?php echo htmlentities($sec_values['short_sec_name']) ?>" <?php if(isset($_POST['view_submit']) && $_SESSION['upd_ssn'] == $sec_values['short_sec_name']) { echo "selected"; } ?> ><?php echo htmlentities($sec_values['sec_name']) ?></option>
                                  <?php
                                    }
                                  ?>
                              </select>
                          </div>

                                  <input type="submit" class="btn btn-info" name="view_submit" value="View a Section">
                                  <p></p>

                                  <?php
                                    if(isset($_POST['view_submit'])) {
                                  ?>
                                    <div class="form-group">
                                      <label for="textbox1" class="col-sm-2" style="padding-top:15px;">Section Name:</label>
                                      <div class="input-group" class="col-sm-10">
                                        <input id="textbox1" type="text" class="form-control" name="sec_nm" value="<?php echo $sec['sec_name']; ?>"><span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
                                      </div>
                                    </div>
                                      <div class="form-group">
                                        <label for="textbox2" class="col-sm-2" style="padding-top:15px;">Section Name(Short):</label>

                                          <div class="input-group" class="col-sm-10">
                                      <input id="textbox2" type="text" class="form-control" name="sec_short_nm" value="<?php echo $sec['short_sec_name']; ?>"><span class="input-group-addon"><i class="glyphicon glyphicon-certificate"></i></span>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                        <label for="area_plucked" class="col-sm-2" style="padding-top:15px;">Sectional Area:</label>

                                        <div class="input-group" class="col-sm-10">
                                            <input type="text" id="area_plucked" class="form-control" name="sec_area" value="<?php echo $sec['total_area']; ?>"><span class="input-group-addon"><i class="glyphicon glyphicon-tree-conifer"></i></span>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label for="status_" class="col-sm-2" style="padding-top:15px;">Prune style:</label>

                                          <div class="input-group" class="col-sm-10">
                                            <input type="text" class="form-control" id="status_" name="status" value="<?php echo $sec['prune_style']; ?>"><span class="input-group-addon"><i class="glyphicon glyphicon-chevron-up"></i></span>
                                          </div>
                                      </div>
                                  <div class="form-group">
                                    <label for="Jat_" class="col-sm-2" style="padding-top:15px;">Jat/Clone:</label>

                                    <div class="input-group" class="col-sm-10">
                                        <input type="text" class="form-control" name="jat" id="Jat_" value="<?php echo $sec['jat']; ?>"> <span class="input-group-addon"><i class="glyphicon glyphicon-grain"></i></span>
                                    </div>
                                </div>
                                  <div class="form-group">
                                    <label for="shade_species_temp_" class="col-sm-2" style="padding-top:15px;">shade species temporary:</label>

                                    <div class="input-group" class="col-sm-10">
                                        <input type="text" id="shade_species_temp_" class="form-control" name="shade_species_temp" value="<?php echo $sec['shade_spcs_temp']; ?>" ><span class="input-group-addon"><i class="glyphicon glyphicon-tree-deciduous"></i></span>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label for="Temp_Shade_spacing_" class="col-sm-2" style="padding-top:15px;">Temp. Shade spacing:</label>

                                    <div class="input-group" class="col-sm-10">
                                        <input type="text" class="form-control" id="Temp_Shade_spacing_" name="Temp_Shade_spacing" value="<?php echo $sec['perm_shd_spcing']; ?>"><span class="input-group-addon"><i class="glyphicon glyphicon-align-justify"></i></span>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label for="shade_species_perm_" class="col-sm-2" style="padding-top:15px;">shade species permanent:</label>

                                    <div class="input-group" class="col-sm-10">
                                        <input type="text" class="form-control" id="shade_species_perm_" name="shade_species_perm" value="<?php echo $sec['shade_spcs_perm']; ?>" ><span class="input-group-addon"><i class="glyphicon glyphicon-tree-deciduous"></i></span>
                                    </div>
                                  </div>

                                  <div class="form-group">
                                    <label for="Perm_Shade_spacing_" class="col-sm-2" style="padding-top:15px;">Perm Shade spacing:</label>

                                    <div class="input-group" class="col-sm-10">
                                        <input type="text" id="Perm_Shade_spacing_" class="form-control" name="Perm_Shade_spacing" value="<?php echo $sec['perm_shd_spcing']; ?>"><span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label for="Frame_Height_" class="col-sm-2" style="padding-top:15px;">Frame Height:</label>

                                    <div class="input-group" class="col-sm-10">
                                        <input type="text" id="Frame_Height_" class="form-control" name="Frame_Height" value="<?php echo $sec['frame_height']; ?>"> <span class="input-group-addon"><i class="glyphicon glyphicon-stats"></i></span>
                                    </div>
                                  </div>

                                  <div class="form-group">
                                    <label for="Bush_Height_" class="col-sm-2" style="padding-top:15px;">Bush Height:</label>

                                    <div class="input-group" class="col-sm-10">
                                        <input type="text" id="Bush_Height_" class="form-control" name="Bush_Height" value="<?php echo $sec['bush_height']; ?>"><span class="input-group-addon"><i class="glyphicon glyphicon-grain"></i></span>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label for="Planting_year_" class="col-sm-2" style="padding-top:15px;">Planting year:</label>

                                    <div class="input-group" class="col-sm-10">
                                        <input type="number" id="Planting_year_" class="form-control" name="Planting_year" value="<?php echo $sec['yr_of_plant']; ?>"><span class="input-group-addon"><i class="glyphicon glyphicon-jpy"></i></span>
                                    </div>
                                  </div>

                                  <div class="form-group">
                                    <label for="Plant_Spacing_" class="col-sm-2" style="padding-top:15px;">Plant Spacing:</label>

                                    <div class="input-group" class="col-sm-10">
                                        <input type="text" id="Plant_Spacing_" class="form-control" name="Plant_Spacing" value="<?php echo $sec['plant_spacing']; ?>"><span class="input-group-addon"><i class="glyphicon glyphicon-option-horizontal"></i></span>
                                    </div>
                                  </div>

                                  <div class="form-group">
                                    <label for="Plant_Density_" class="col-sm-2" style="padding-top:15px;">Plant Density per Ha. :</label>

                                    <div class="input-group" class="col-sm-10">
                                        <input type="text" class="form-control" id="Plant_Density_" name="Plant_Density" value="<?php echo $sec['plant_density']; ?>"><span class="input-group-addon"><i class="glyphicon glyphicon-barcode"></i></span>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label for="Bush_Popu_" class="col-sm-2" style="padding-top:15px;">Total Bush Population:</label>

                                    <div class="input-group" class="col-sm-10">
                                        <input type="text" class="form-control" id="Bush_Popu_" name="Bush_Popu" value="<?php  echo $sec['bush_pop']; ?>"><span class="input-group-addon"><i class="glyphicon glyphicon-cloud-upload"></i></span>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label for="Drain_Status_" class="col-sm-2" style="padding-top:15px;">Drain Status :</label>

                                    <div class="input-group" class="col-sm-10">
                                        <input type="text" class="form-control" id="Drain_Status_" name="Drain_Status" value="<?php echo $sec['drain_stats']; ?>" ><span class="input-group-addon"><i class="glyphicon glyphicon-road"></i></span>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="Soil_Topo_" class="col-sm-2" style="padding-top:15px;">Soil type and Topography:</label>

                                    <div class="input-group" class="col-sm-10">
                                        <input type="text" class="form-control" id="Soil_Topo_" name="Soil_Topo" value="<?php echo $sec['soil_topo']; ?>"><span class="input-group-addon"><i class="glyphicon glyphicon-th-large"></i></span>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label for="ext_rplnt_" class="col-sm-2" style="padding-top:15px;">Ext. / Replantation :</label>

                                      <div class="input-group" class="col-sm-10">
                                          <input type="number" class="form-control" id="ext_rplnt_" name="ext_rplnt" value="<?php echo $sec['ext_rplnt']; ?>" ><span class="input-group-addon"><i class="glyphicon glyphicon-th-large"></i></span>
                                      </div>
                                  </div>
                                  <input type="submit" class="btn btn-success" name="update_submit" value="Update Section">
                                  <?php
                                        }
                                  ?>

                              </form>


                    </div>

                    <div class="tab-pane" id="tab2">
                      <?php
                        //var_dump($_SESSION['div_name']);
                      ?>
                        <form id="remove_section" action="manage_sections.php" method="post" size="10">
                        <label for="sec_short_name"> Select Section:</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-remove-sign"></i></span>
                            <select class="form-control" name="sec_short_name" form="remove_section" required>

                                <?php
                                  $q = "SELECT * FROM sections where division = '{$_SESSION['div_name']}'";
                                  $result = mysqli_query($connection, $q);

                                  confirm_query($result);
                                  //$_POST['sec_short_nm'] = NULL;

                                  echo "<option id=\"opt0\" value=\"Select a section...\">Select a section...</option>";
                                  while($sec_values = mysqli_fetch_assoc($result)) {
                                ?>

                                    <option value="<?php echo htmlentities($sec_values['short_sec_name']) ?>"><?php echo htmlentities($sec_values['sec_name']) ?></option>

                                <?php
                                  }
                                ?>


                            </select>
                        </div>

                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmModal" style="margin-top:10px;">Remove a Section</button>
                                <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="confirmModalLabel">Are you sure?</h4>
                                      </div>
                                      <div class="modal-body">Are you absolutely sure you want to delete this record?</div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <input type="submit" name="rmv_sec_submit" class="btn btn-danger" value="Yes, I'm sure!">
                                      </div>
                                    </div>
                                  </div>
                                </div>

                        </form>
                    </div>

                    <div class="tab-pane" id="tab3">
                        <form class="add_section form-horizontal" action="manage_sections.php" method="post">
                            <div class=" form-group">
                                <label for="sec_nm" class="col-sm-3" style="padding-top:15px">Section Name:</label>

                                <div class="input-group col-sm-6">
                                    <input type="text" class="form-control" name="sec_nm" placeholder="Section Name" required><span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="sec_short_nm" class="col-sm-3" style="padding-top:15px">Section's short name:</label>
                                <div class="input-group col-sm-6">
                                  <input type="text" class="form-control" name="sec_short_nm" placeholder="Section Short Name" required><span class="input-group-addon"><i class="glyphicon glyphicon-certificate"></i></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="sec_area" class="col-sm-3" style="padding-top:15px">Sectional Area:</label>

                                <div class="input-group col-sm-6">

                                  <input type="text" class="form-control" name="sec_area" placeholder="Section Area" required><span class="input-group-addon"><i class="glyphicon glyphicon-tree-conifer"></i></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="status" class="col-sm-3" style="padding-top:15px">Prune Style :</label>
                                <div class="input-group col-sm-6">

                                  <input type="text" class="form-control" name="status" placeholder="Section Status" required><span class="input-group-addon"><i class="glyphicon glyphicon-chevron-up"></i></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jat" class="col-sm-3" style="padding-top:15px">Jat:</label>
                                <div class="input-group col-sm-6">
                                  <input type="text" class="form-control" name="jat" placeholder="Jat/Clone"> <span class="input-group-addon"><i class="glyphicon glyphicon-grain"></i></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="shade_species_temp" class="col-sm-3" style="padding-top:15px">shade species temp.:</label>
                                <div class="input-group col-sm-6">
                                  <input type="text" class="form-control" name="shade_species_temp" placeholder="Shade Species Temporary" ><span class="input-group-addon"><i class="glyphicon glyphicon-tree-deciduous"></i></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="Temp_Shade_spacing" class="col-sm-3" style="padding-top:15px">Temp. Shade Spacing:</label>
                                <div class="input-group col-sm-6">
                                  <input type="text" class="form-control" name="Temp_Shade_spacing" placeholder="Temporary Shade spacing"><span class="input-group-addon"><i class="glyphicon glyphicon-align-justify"></i></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="shade_species_perm" class="col-sm-3" style="padding-top:15px">Shade species perm.:</label>
                                <div class="input-group col-sm-6">

                                  <input type="text" class="form-control" name="shade_species_perm" placeholder="Shade Species Permanent" ><span class="input-group-addon"><i class="glyphicon glyphicon-tree-deciduous"></i></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Perm_Shade_spacing" class="col-sm-3" style="padding-top:15px">Perm. Shade Spacing:</label>
                                <div class="input-group col-sm-6">
                                  <input type="text" class="form-control" name="Perm_Shade_spacing" placeholder="Permanent Shade spacing"><span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Frame_Height" class="col-sm-3" style="padding-top:15px">frame height:</label>
                                <div class="input-group col-sm-6">
                                  <input type="text" class="form-control" name="Frame_Height" placeholder="Frame Height"> <span class="input-group-addon"><i class="glyphicon glyphicon-stats"></i></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Bush_Height" class="col-sm-3" style="padding-top:15px">bush height:</label>
                                <div class="input-group col-sm-6">
                                  <input type="text" class="form-control" name="Bush_Height" placeholder="Bush Height"><span class="input-group-addon"><i class="glyphicon glyphicon-grain"></i></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Planting_year" class="col-sm-3" style="padding-top:15px">Planting year:</label>
                                <div class="input-group col-sm-6">
                                  <input type="number" class="form-control" name="Planting_year" placeholder="Year of planting" required><span class="input-group-addon"><i class="glyphicon glyphicon-jpy"></i></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Plant_Spacing" class="col-sm-3" style="padding-top:15px">Plant Spacing:</label>
                                <div class="input-group col-sm-6">
                                  <input type="text" class="form-control" name="Plant_Spacing" placeholder="Plant Spacing"><span class="input-group-addon"><i class="glyphicon glyphicon-option-horizontal"></i></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="Plant_Density" class="col-sm-3" style="padding-top:15px">Plant Density per Ha. :</label>
                                <div class="input-group col-sm-6">

                                  <input type="text" class="form-control" name="Plant_Density" placeholder="Plant Density"><span class="input-group-addon"><i class="glyphicon glyphicon-barcode"></i></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Bush_Popu" class="col-sm-3" style="padding-top:15px">Total Bush Population:</label>
                                <div class="input-group col-sm-6">
                                  <input type="text" class="form-control" name="Bush_Popu" placeholder="Bush Population"><span class="input-group-addon"><i class="glyphicon glyphicon-cloud-upload"></i></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Drain_Status" class="col-sm-3" style="padding-top:15px">Drain Status:</label>
                                <div class="input-group col-sm-6">
                                  <input type="text" class="form-control" name="Drain_Status" placeholder="Drain Status" ><span class="input-group-addon"><i class="glyphicon glyphicon-road"></i></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Soil_Topo" class="col-sm-3" style="padding-top:15px">Soil type Topography:</label>
                                <div class="input-group col-sm-6">
                                  <input type="text" class="form-control" name="Soil_Topo" placeholder="Soil Type and Topography" required><span class="input-group-addon"><i class="glyphicon glyphicon-th-large"></i></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="ext_rplnt" class="col-sm-3" style="padding-top:15px">Ext / Replantation:</label>
                                <div class="input-group col-sm-6">
                                  <input type="number" class="form-control" name="ext_rplnt" placeholder="Extention/Replantation" ><span class="input-group-addon"><i class="glyphicon glyphicon-th-large"></i></span>
                                </div>
                            </div>


                                <input type="submit" class="btn btn-primary" name="section_submit" value="Add a Section">
                        </form>


                    </div>

              </div>
            </div>
            <?php
              }
             ?>
          </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <script type="text/javascript">
            // var tb1 = document.getElementById('textbox1');
            // var tb2 = document.getElementById('textbox2');
            // var opt = document.getElementById('opt0');
            // if(tb2!=null) {
            //     opt.text = tb1.value;
            //     opt.value = tb2.value;
            // }
        </script>
    </body>
</html>

<?php
  //mysqli_free_result($result);
	end_connection($connection);
?>
