<?php
  require_once('includes/sessions.php');
  require_once('includes/functions.php');
?>

<?php

  $connection = make_connection();

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
    $q_in .= "(sec_name, short_sec_name, total_area, jat,";
    $q_in .= " shade_spcs_temp, shade_spcs_perm, frame_height, bush_height,";
    $q_in .= " yr_of_plant, plant_spacing,temp_shd_spcing, perm_shd_spcing,";
    $q_in .= " plant_density, bush_pop, drain_stats, soil_topo, ext_rplnt, sec_status)";
    $q_in .= " VALUES ('{$sec_nm}', '{$sec_shrt_nm}', {$sec_area}, '{$jat}', '{$shd_spcs_tmp}', '{$shd_spcs_perm}',";
    $q_in .= " {$frame_ht}, {$bush_ht}, {$plntng_yr}, {$plnt_spcing}, {$tmp_shd_spcing}, {$prm_shd_spcing},";
    $q_in .= " {$plnt_dens}, {$bsh_popu}, '{$drn_stats}', '{$soil_topo}', {$ext_rplnt}, '{$stats}' )";


    $result = mysqli_query($connection, $q_in);

    confirm_query($result);
    echo "Inserted successfully!";
  }




  //an effort to run the update
  if(isset($_POST["update_submit"])) {
    var_dump($_POST);
    $req_ssn = mysqli_real_escape_string($connection, $_POST['sec_short_name']);
    $q_req_ssn = "SELECT * FROM sections WHERE short_section_name = '{$req_ssn}'";\
    var_dump($q_req_ssn);

    $req_result = mysqli_query($connection, $q_req_ssn);
    confirm_query($req_result);
    $req_sec = mysqli_fetch_assoc($req_result);
    echo "<hr>";
    var_dump($req_sec);
    echo "rec_sec_id=".$req_sec['id'];
    $req_ID = $req_sec['id'];

    $sec_nm = mysqli_real_escape_string($connection, $_POST["sec_nm"]);
    $sec_shrt_nm = mysqli_real_escape_string($connection, $_POST["sec_short_nm"]);
    $sec_area = (float) mysqli_real_escape_string($connection, $_POST["sec_area"]);
    $stats = mysqli_real_escape_string($connection, $_POST["status"]);

    $q_up = "UPDATE sections SET ";
    $q_up .= "section_name = '{$sec_nm}', short_section_name = '{$sec_shrt_nm}', area = {$sec_area} , status = '{$stats}'";
    $q_up .= " WHERE id = {$req_ID}";
    $result_up = mysqli_query($connection, $q_up);
    var_dump($q_up);
    //var_dump($result_up);

    confirm_query($result_up);
    echo "Updated successfully!";
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
    </head>
    <body>
        <?php
            include("nav_bar.php");
            nav_echoer($page_id);
        ?>
        <div class="container">
            <div class="jumbotron" style="background:#006064;margin-left: -15px;margin-right: -15px;">
                <h1>Manage Sections</h1>
                <p style="color:#B2DFDB">Add or remove a new section</p>
            </div>
            <div class="tab-container">
                <ul class="nav nav-tabs nav-justified">
                    <li class="active"><a href="#tab1" data-toggle="tab">View and Update Section</a></li>
                    <li><a href="#tab2" data-toggle="tab">Remove Section</a></li>
                    <li ><a href="#tab3" data-toggle="tab">Add Section</a></li>
                </ul>
                <div class="tab-content"  style="background-color:#0097A7">
                    <div class="tab-pane active" id="tab1">
                        <?php
                            $q = "SELECT * FROM sections";
                            $result = mysqli_query($connection, $q);
                            confirm_query($result);
                            //$_POST['sec_short_nm'] = NULL;
                        ?>
                        <form id="view_update_section" action="manage_sections_two.php" method="post" size="10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-grain"></i></span>
                            <select  id="selectbox" class="form-control" name="sec_short_name" form="view_update_section" required>
                              <?php
                                echo "<option id=\"opt0\" value=NULL> </option>";
                                  while($sec_values = mysqli_fetch_assoc($result)) {
                              ?>
                                    <option value="<?php echo htmlentities($sec_values['short_section_name']) ?>" ><?php echo htmlentities($sec_values['section_name']) ?></option>
                                <?php
                                  }
                                ?>
                            </select>
                        </div>

                                <input type="submit" class="btn btn-info" name="view_submit" value="View a Section">
                                <p></p>

                                <?php
                                    if(isset($_POST['view_submit'])) {
                                        $ssnV = mysqli_real_escape_string($connection, $_POST['sec_short_name']);
                                        //echo "ssnV=".$ssnV;
                                        $q2 = " SELECT * FROM sections WHERE short_section_name = '{$ssnV}'";

                                        $result = mysqli_query($connection, $q2);
                                        confirm_query($result);

                                        $sec = mysqli_fetch_assoc($result);
                                        //var_dump($sec);

                                ?>
                                <div class="input-group">

                                    <input id="textbox1" type="text" class="form-control" name="sec_nm" value="<?php echo $sec['section_name']; ?>"><span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
                                </div>
                                <div class="input-group">
                                    <input id="textbox2" type="text" class="form-control" name="sec_short_nm" value="<?php echo $sec['short_section_name']; ?>"><span class="input-group-addon"><i class="glyphicon glyphicon-certificate"></i></span>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="sec_area" value="<?php echo $sec['area']; ?>"><span class="input-group-addon"><i class="glyphicon glyphicon-tree-conifer"></i></span>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="status" value="<?php echo $sec['status']; ?>"><span class="input-group-addon"><i class="glyphicon glyphicon-chevron-up"></i></span>
                                </div>
                                <input type="submit" class="btn btn-success" name="update_submit" value="Update Section">
                                <?php
                                      }
                                ?>

                            </form>


                    </div>
                    <div class="tab-pane" id="tab2">
                        <form id="remove_section" action="manage_sections_two.php" method="post" size="10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-remove-sign"></i></span>
                            <select class="form-control" name="sec_short_name" form="remove_section" required>

                                <?php
                                  $q = "SELECT * FROM sections";
                                  $result = mysqli_query($connection, $q);

                                  confirm_query($result);
                                  //$_POST['sec_short_nm'] = NULL;

                                  echo "<option value=NULL></option>";
                                  while($sec_values = mysqli_fetch_assoc($result)) {
                                ?>

                                    <option value="<?php echo htmlentities($sec_values['short_sec_name']) ?>" ><?php echo htmlentities($sec_values['sec_name']) ?></option>

                                <?php
                                  }
                                ?>


                            </select>
                        </div>

                                <input type="submit" class="btn btn-danger" name="rmv_sec_submit" value="Remove a Section">

                                <?php if(isset($_POST['rmv_sec_submit'])) {
                                        $ssn = mysqli_real_escape_string($connection, $_POST['sec_short_name']);

                                        $q = "DELETE FROM sections WHERE short_sec_name = '{$ssn}'";
                                        $result = mysqli_query($connection, $q);

                                        confirm_query($result);
                                        echo "Deleted successfully!";

                                      }
                                      else {
                                        $ssn = NULL;
                                      }

                                ?>
                        </form>
                    </div>







                    <div class="tab-pane" id="tab3">
                        <form class="add_section" action="manage_sections_two.php" method="post">
                            <div class="input-group">

                                <input type="text" class="form-control" name="sec_nm" placeholder="Section Name" required><span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
                            </div>
                            <div class="input-group">
                                <input type="text" class="form-control" name="sec_short_nm" placeholder="Section Short Name" required><span class="input-group-addon"><i class="glyphicon glyphicon-certificate"></i></span>
                            </div>
                            <div class="input-group">
                                <input type="text" class="form-control" name="sec_area" placeholder="Section Area" required><span class="input-group-addon"><i class="glyphicon glyphicon-tree-conifer"></i></span>
                            </div>
                            <div class="input-group">
                                <input type="text" class="form-control" name="status" placeholder="Section Status" required><span class="input-group-addon"><i class="glyphicon glyphicon-chevron-up"></i></span>
                            </div>
                            <div class="input-group">
                                <input type="text" class="form-control" name="jat" placeholder="Jat/Clone"> <span class="input-group-addon"><i class="glyphicon glyphicon-grain"></i></span>
                            </div>
                            <div class="input-group">
                                <input type="text" class="form-control" name="shade_species_temp" placeholder="Shade Species Temporary" ><span class="input-group-addon"><i class="glyphicon glyphicon-tree-deciduous"></i></span>
                            </div>
                            <div class="input-group">
                                <input type="text" class="form-control" name="shade_species_perm" placeholder="Shade Species Permanent" ><span class="input-group-addon"><i class="glyphicon glyphicon-tree-deciduous"></i></span>
                            </div>
                            <div class="input-group">
                                <input type="text" class="form-control" name="Frame_Height" placeholder="Frame Height"> <span class="input-group-addon"><i class="glyphicon glyphicon-stats"></i></span>
                            </div>
                            <div class="input-group">
                                <input type="text" class="form-control" name="Bush_Height" placeholder="Bush Height"><span class="input-group-addon"><i class="glyphicon glyphicon-grain"></i></span>
                            </div>
                            <div class="input-group">
                                <input type="number" class="form-control" name="Planting_year" placeholder="Year of planting" required><span class="input-group-addon"><i class="glyphicon glyphicon-jpy"></i></span>
                            </div>
                            <div class="input-group">
                                <input type="text" class="form-control" name="Plant_Spacing" placeholder="Plant Spacing"><span class="input-group-addon"><i class="glyphicon glyphicon-option-horizontal"></i></span>
                            </div>
                            <div class="input-group">
                                <input type="text" class="form-control" name="Temp_Shade_spacing" placeholder="Temporary Shade spacing"><span class="input-group-addon"><i class="glyphicon glyphicon-align-justify"></i></span>
                            </div>
                            <div class="input-group">
                                <input type="text" class="form-control" name="Perm_Shade_spacing" placeholder="Permanent Shade spacing"><span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                            </div>
                            <div class="input-group">
                                <input type="text" class="form-control" name="Plant_Density" placeholder="Plant Density"><span class="input-group-addon"><i class="glyphicon glyphicon-barcode"></i></span>
                            </div>
                            <div class="input-group">
                                <input type="text" class="form-control" name="Bush_Popu" placeholder="Bush Population"><span class="input-group-addon"><i class="glyphicon glyphicon-cloud-upload"></i></span>
                            </div>
                            <div class="input-group">
                                <input type="text" class="form-control" name="Drain_Status" placeholder="Drain Status" ><span class="input-group-addon"><i class="glyphicon glyphicon-road"></i></span>
                            </div>
                            <div class="input-group">
                                <input type="text" class="form-control" name="Soil_Topo" placeholder="Soil Type and Topography" required><span class="input-group-addon"><i class="glyphicon glyphicon-th-large"></i></span>
                            </div>
                            <div class="input-group">
                                <input type="number" class="form-control" name="ext_rplnt" placeholder="Extention/Replantation" ><span class="input-group-addon"><i class="glyphicon glyphicon-th-large"></i></span>
                            </div>


                                <input type="submit" class="btn btn-primary" name="section_submit" value="Add a Section">
                        </form>


                    </div>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <script type="text/javascript">
            var tb1 = document.getElementById('textbox1');
            var tb2 = document.getElementById('textbox2');
            var opt = document.getElementById('opt0');
            if(tb2!=null) {
                opt.text = tb1.value;
                opt.value = tb2.value;
            }
        </script>
    </body>
</html>
