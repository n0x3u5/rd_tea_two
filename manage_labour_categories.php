<?php
  require_once('includes/sessions.php');
  require_once('includes/functions.php');

  if(!isset($_SESSION['user'])) {
    redirect_to("index.php");
  }
?>

<?php

  $connection = make_connection();

  if(isset($_POST["add_submit"])) {

    $labour_cat = mysqli_real_escape_string($connection, $_POST["labour_cat"]);
    $lcsn = mysqli_real_escape_string($connection, $_POST["lcsn"]);

    $q_in = "INSERT INTO labour_categories ";
    $q_in .= "(labour_cat, lcsn)";
    $q_in .= " VALUES ('{$labour_cat}', '{$lcsn}')";


    $r_in = mysqli_query($connection, $q_in);
    confirm_query($r_in);
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
  }




  //an effort to run the update
  if(isset($_POST["edit_submit"])) {
    //var_dump($_POST);
    $req_lcsn = $_SESSION['rnm_lcsn'];

    $q_req_lcsn = "SELECT * FROM labour_categories WHERE lcsn = '{$req_lcsn}'";
    //var_dump($q_req_lcsn);

    $req_result = mysqli_query($connection, $q_req_lcsn);
    confirm_query($req_result);
    $req_lab_cat = mysqli_fetch_assoc($req_result);
    //var_dump($req_lab_cat);
    $req_ID = $req_lab_cat['id'];

    $labour_cat = mysqli_real_escape_string($connection, $_POST["labour_cat"]);
    $lcsn = mysqli_real_escape_string($connection, $_POST["lcsn"]);

    $q_up = "UPDATE labour_categories SET ";
    $q_up .= "labour_cat = '{$labour_cat}', lcsn = '{$lcsn}'";
    $q_up .= " WHERE id = $req_ID";

    $r_up = mysqli_query($connection, $q_up);
    //var_dump($q_up);
    //var_dump($r_up);

    confirm_query($r_up);
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
    // mysqli_free_result($req_result);
    //
    // mysqli_free_result($result_up);
    $_SESSION['rnm_lcsn'] = NULL;
  }

 if(isset($_POST['del_entry'])) {
    $lcsn = mysqli_real_escape_string($connection, $_POST['cat_rmv']);

    $q_del = "DELETE FROM labour_categories WHERE lcsn = '{$lcsn}'";
    $r_del = mysqli_query($connection, $q_del);

    confirm_query($r_del);
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
  }
  else {
    $lcsn = NULL;
  }

?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>R.D. Tea | Manage Groups</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/stylesheet.css">
        <link rel="icon" href="images/logo_rdtea.png"/>
        <?php $page_id = 13;?>
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
                <h1>Manage Groups</h1>
                <p style="color:#B2DFDB">Add or remove a Group</p>
            </div>
            <div class="tab-container">
                <ul class="nav nav-tabs nav-justified">
                    <li class="active"><a href="#tab1" data-toggle="tab">View and Update Group</a></li>
                    <li><a href="#tab2" data-toggle="tab">Remove Group</a></li>
                    <li ><a href="#tab3" data-toggle="tab">Add Group</a></li>
                </ul>
                <div class="tab-content"  style="background-color:#0097A7">
                    <div class="tab-pane active" id="tab1">
                        <form id="view_update_group" class="form-horizontal" action="manage_labour_categories.php" method="post" size="10">
                          <?php
                            if(isset($_POST['view_submit'])) {
                              $lcsn_req = mysqli_real_escape_string($connection, $_POST['lab_cat_snm']);
                              $_SESSION['rnm_lcsn'] = $lcsn_req;
                              $q_view = "SELECT * FROM labour_categories where lcsn = '{$lcsn_req}'";
                              $r_view = mysqli_query($connection, $q_view);
                              confirm_query($r_view);

                              $cat_view = mysqli_fetch_assoc($r_view);
                            }
                            else {
                              $cat_view = NULL;
                            }
                          ?>
                            <div class="form-group">
                                <label for="view_grp" class="col-sm-2 col-sm-offset-1">Select a Group: </label>
                                <div class="col-sm-4">
                                  <select class="form-control" id="view_grp" name = "lab_cat_snm" required>
                                      <?php
                                        $q_lab_cat = "SELECT * FROM labour_categories";
                                        $r_lab_cat = mysqli_query($connection, $q_lab_cat);

                                        confirm_query($r_lab_cat);

                                        echo "<option value=\"select a group\">Select a Group</option>";
                                        while($lab_cats = mysqli_fetch_assoc($r_lab_cat)) {
                                      ?>

                                          <option value="<?php echo htmlentities($lab_cats['lcsn']); ?>" <?php if(isset($_POST['view_submit']) && $_SESSION['rnm_lcsn'] == $lab_cats['lcsn']) {echo "selected"; }; ?> ><?php echo htmlentities($lab_cats['lcsn']); ?></option>

                                      <?php
                                        }
                                      ?>
                                  </select>
                                  <p></p>
                                  <input type="submit" class="btn btn-info" name="view_submit" value="Rename" onclick="show()">
                                </div>
                            </div>
                          <?php if(isset($_POST['view_submit'])){ ?>
                            <div class="row">
                              <div class="form-group">
                                <label for="actual_name" class="col-sm-2 col-sm-offset-1">Full Group Name:</label>
                                <div class="col-sm-4">
                                <input type="text" name ="labour_cat" id="actual_name" class="form-control" <?php if($cat_view != NULL) { ?>value="<?php echo $cat_view['labour_cat']; ?>" <?php } else { ?>placeholder=<?php echo "\"labour category\""; ?> <?php } ?> >
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="form-group">
                                <label for="actual_name" class="col-sm-2 col-sm-offset-1">Group name in Short:</label>
                                <div class="col-sm-4">
                                <input type="text" name ="lcsn" id="abbrev_name" class="form-control" <?php if($cat_view != NULL) { ?>value="<?php echo $cat_view['lcsn']; ?>" <?php } else { ?>placeholder=<?php echo "\"labour category short name\""; ?> <?php } ?>>
                                </div>
                              </div>
                              <input type="submit" class="btn btn-success col-sm-offset-3" name="edit_submit" value="Confirm Changes">
                            </div>
                          <?php } ?>
                        </form>


                    </div>

                    <div class="tab-pane" id="tab2">
                        <form id="remove_group" action="manage_labour_categories.php" method="post" size="10">
                        <label for=""> Select Group:</label>
                          <div class="input-group">
                              <span class="input-group-addon"><i class="glyphicon glyphicon-remove-sign"></i></span>
                              <select class="form-control" id="view_grp" name = "cat_rmv" required>
                                  <?php
                                    $q_lab_cat = "SELECT * FROM labour_categories";
                                    $r_lab_cat = mysqli_query($connection, $q_lab_cat);

                                    confirm_query($r_lab_cat);

                                    echo "<option value=\"select a group\">Select a Group</option>";
                                    while($lab_cats = mysqli_fetch_assoc($r_lab_cat)) {
                                  ?>

                                      <option value="<?php echo htmlentities($lab_cats['lcsn']) ?>"  ><?php echo htmlentities($lab_cats['lcsn']) ?></option>

                                  <?php
                                    }
                                  ?>
                              </select>
                          </div>

                                <button type="button" class="btn btn-danger" name="rmv_cat_submit" data-toggle="modal" data-target="#confirmModal" style="margin-top:10px;">Remove a Group</button>
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
                                        <input type="submit" name="del_entry" class="btn btn-danger" value="Yes, I'm sure!">
                                      </div>
                                    </div>
                                  </div>
                                </div>
                      </form>
                    </div>

                    <div class="tab-pane" id="tab3">
                        <form class="add_group form-horizontal" action="manage_labour_categories.php" method="post">
                          <div class="form-group">
                            <label for="actual_name" class="col-sm-2 col-sm-offset-1">Full Group Name:</label>
                            <div class="col-sm-4">
                            <input type="text" id="actual_name" name="labour_cat" class="form-control">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="actual_name" class="col-sm-2 col-sm-offset-1">Group name in Short:</label>
                            <div class="col-sm-4">
                            <input type="text" id="actual_name" name="lcsn" class="form-control">
                            </div>
                          </div>

                          <input type="submit" class="btn btn-primary col-sm-offset-3" name="add_submit" value="Add a Group">
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

<?php
	end_connection($connection);
?>
