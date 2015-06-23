<?php
  require_once('includes/sessions.php');
  require_once('includes/functions.php');
?>

<?php

  $connection = make_connection();

  if(isset($_POST["section_submit"])) {
    $sec_nm = mysqli_real_escape_string($connection, $_POST["section_name"]);
    $sec_shrt_nm = mysqli_real_escape_string($connection, $_POST["section_short_name"]);
    $sec_area = (float) mysqli_real_escape_string($connection, $_POST["section_area"]);
    $stats = mysqli_real_escape_string($connection, $_POST["status"]);

    $query = " INSERT INTO sections ";
    $query .= "(section_name, short_section_name, area, status )";
    $query .= "VALUES ('{$sec_nm}', '{$sec_shrt_nm}', {$sec_area}, '{$stats}')" ;

    $result = mysqli_query($connection, $query);

    confirm_query($result);
    echo "Inserted successfully!";
  }
  else {
    $sec_nm = NULL;
    $sec_shrt_nm = NULL;
    $sec_area = NULL;
    $stats = NULL;
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
                    <li class="active"><a href="#tab1" data-toggle="tab">Add Section</a></li>
                    <li><a href="#tab2" data-toggle="tab">Remove Section</a></li>
                    <li><a href="#tab3" data-toggle="tab">Update Section</a></li>
                </ul>
                <div class="tab-content"  style="background-color:#0097A7">
                    <div class="tab-pane active" id="tab1">
                        <form class="add_section" action="manage_sections.php" method="post">
                            <div class="input-group">

                                <input type="text" class="form-control" name="section_name" placeholder="Section Name" required><span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
                            </div>
                            <div class="input-group">
                                <input type="text" class="form-control" name="section_short_name" placeholder="Section Short Name" required><span class="input-group-addon"><i class="glyphicon glyphicon-certificate"></i></span>
                            </div>
                            <div class="input-group">
                                <input type="text" class="form-control" name="section_area" placeholder="Section Area" required><span class="input-group-addon"><i class="glyphicon glyphicon-tree-conifer"></i></span>
                            </div>
                            <div class="input-group">
                                <input type="text" class="form-control" name="status" placeholder="Section Status" required><span class="input-group-addon"><i class="glyphicon glyphicon-chevron-up"></i></span>
                            </div>
                            <div class="input-group">
                                <input type="text" class="form-control" name="jat/clone" placeholder="Jat/Clone" required><span class="input-group-addon"><i class="glyphicon glyphicon-grain"></i></span>
                            </div>
                            <div class="input-group">
                                <input type="text" class="form-control" name="shade species" placeholder="Shade Species" required><span class="input-group-addon"><i class="glyphicon glyphicon-tree-deciduous"></i></span>
                            </div>
                            <div class="input-group">
                                <input type="number" class="form-control" name="Frame Height" placeholder="Frame Height" required><span class="input-group-addon"><i class="glyphicon glyphicon-stats"></i></span>
                            </div>
                            <div class="input-group">
                                <input type="number" class="form-control" name="Bush Height" placeholder="Bush Height" required><span class="input-group-addon"><i class="glyphicon glyphicon-grain"></i></span>
                            </div>
                            <div class="input-group">
                                <input type="number" class="form-control" name="Year of planting" placeholder="Year of planting" required><span class="input-group-addon"><i class="glyphicon glyphicon-jpy"></i></span>
                            </div>
                            <div class="input-group">
                                <input type="text" class="form-control" name="Plant Spacing" placeholder="Plant Spacing" required><span class="input-group-addon"><i class="glyphicon glyphicon-option-horizontal"></i></span>
                            </div>
                            <div class="input-group">
                                <input type="text" class="form-control" name="Temporary Shade spacing" placeholder="Temporary Shade spacing" required><span class="input-group-addon"><i class="glyphicon glyphicon-align-justify"></i></span>
                            </div>
                            <div class="input-group">
                                <input type="text" class="form-control" name="Permanent Shade spacing" placeholder="Permanent Shade spacing" required><span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                            </div>
                            <div class="input-group">
                                <input type="text" class="form-control" name="Plant Density" placeholder="Plant Density" required><span class="input-group-addon"><i class="glyphicon glyphicon-barcode"></i></span>
                            </div>
                            <div class="input-group">
                                <input type="text" class="form-control" name="Bush Population" placeholder="Bush Population" required><span class="input-group-addon"><i class="glyphicon glyphicon-cloud-upload"></i></span>
                            </div>
                            <div class="input-group">
                                <input type="text" class="form-control" name="Drain Status" placeholder="Drain Status" required><span class="input-group-addon"><i class="glyphicon glyphicon-road"></i></span>
                            </div>
                            <div class="input-group">
                                <input type="text" class="form-control" name="Soil Type and Topography" placeholder="Soil Type and Topography" required><span class="input-group-addon"><i class="glyphicon glyphicon-th-large"></i></span>
                            </div>


                                <input type="submit" class="btn btn-primary" name="section_submit" value="Add a Section">
                        </form>
                    </div>
                    <div class="tab-pane" id="tab2">
                        <form id="remove_section" action="manage_sections.php" method="post" size="10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-remove-sign"></i></span>
                            <select class="form-control" name="sec_shrt_nm" form="remove_section" required>

                                <?php
                                  $q = "SELECT * FROM sections";
                                  $result = mysqli_query($connection, $q);

                                  confirm_query($result);
                                  //$_POST['sec_short_nm'] = NULL;

                                  echo "<option value=NULL> </option>";
                                  while($sec_values = mysqli_fetch_assoc($result)) {
                                ?>

                                    <option value="<?php echo htmlentities($sec_values['short_section_name']) ?>" ><?php echo htmlentities($sec_values['section_name']) ?></option>

                                <?php
                                  }
                                ?>


                            </select>
                        </div>

                                <input type="submit" class="btn btn-danger" name="rmv_sec_submit" value="Remove a Section">

                                <?php if(isset($_POST['rmv_sec_submit'])) {
                                        $ssn = mysqli_real_escape_string($connection, $_POST['sec_shrt_nm']);

                                        $q = "DELETE FROM sections WHERE short_section_name = '{$ssn}'";
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
                        <form id="view_update_section" action="manage_sections.php" method="post" size="10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-grain"></i></span>
                            <select  class="form-control" name="shrt_sec_nm" form="view_update_section" required>

                                <?php
                                  $q = "SELECT * FROM sections";
                                  $result = mysqli_query($connection, $q);

                                  confirm_query($result);
                                  //$_POST['sec_short_nm'] = NULL;

                                  echo "<option value=NULL> </option>";
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

                                <?php if(isset($_POST['view_submit'])) {
                                        $ssn2 = mysqli_real_escape_string($connection, $_POST['shrt_sec_nm']);
                                        //echo "ssn2=".$ssn2;
                                        $q2 = " SELECT * FROM sections WHERE short_section_name = '{$ssn2}'";

                                        $result = mysqli_query($connection, $q2);
                                        confirm_query($result);

                                        $sec = mysqli_fetch_assoc($result);

                                ?>


                                    <div class="input-group">
                                        <input class="form-control" type="text" name="section_name" value="<?php echo $sec['section_name'];?>" ><span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
                                    </div>
                                    <div class="input-group">
                                        <input type="text"  class="form-control" name="section_short_name" value="<?php echo $sec['short_section_name']; ?>" ><span class="input-group-addon"><i class="glyphicon glyphicon-certificate"></i></span>
                                    </div>
                                    <div class="input-group">
                                        <input type="text" name="section_area"  class="form-control" value="<?php echo $sec['area']; ?>" ><span class="input-group-addon"><i class="glyphicon glyphicon-tree-conifer"></i></span>
                                    </div>
                                    <div class="input-group">
                                        <input type="text"  class="form-control" name="status" value="<?php echo $sec['status']; ?>" ><span class="input-group-addon"><i class="glyphicon glyphicon-chevron-up"></i></span>
                                    </div>
                                        <!-- $sec_nm = mysqli_real_escape_string($connection, $_POST["section_name"]);
                                        $sec_shrt_nm = mysqli_real_escape_string($connection, $_POST["section_short_name"]);
                                        $sec_area = (float) mysqli_real_escape_string($connection, $_POST["section_area"]);
                                        $stats = mysqli_real_escape_string($connection, $_POST["status"]); -->


                                <?php
                                      }




                                ?>
                                <input type="submit" class="btn btn-success" name="update_submit" value="Update Section">

                            </form>

                    </div>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    </body>
</html>
