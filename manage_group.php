<?php
  require_once('includes/sessions.php');
  require_once('includes/functions.php');

  if(!isset($_SESSION['user'])) {
    redirect_to("index.php");
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
                        <form id="view_update_group" class="form-horizontal" action="" method="post" size="10">
                            <div class="form-group">
                                <label for="view_grp" class="col-sm-2 col-sm-offset-1">Select a Group: </label>
                                <div class="col-sm-4">
                                  <select class="form-control" id="view_grp">
                                    <option>Select a Group</option>
                                    <option>G Men I</option>
                                    <option>G Men II</option>
                                  </select>
                                  <p></p>
                                  <input type="submit" class="btn btn-info" name="view_submit" value="Edit a Group">


                                </div>

                            </div>


                              <div class="form-group">
                                <label for="actual_name" class="col-sm-2 col-sm-offset-1">Group name:</label>
                                <div class="col-sm-4">
                                <input type="text" id="actual_name" class="form-control">
                                </div>
                              </div>
                              <input type="submit" class="btn btn-success col-sm-offset-3" name="view_submit" value="Confirm Changes">
                        </form>


                    </div>

                    <div class="tab-pane" id="tab2">
                        <form id="remove_group" action="" method="post" size="10">
                        <label for=""> Select Group:</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-remove-sign"></i></span>
                            <select class="form-control" name="sec_short_name" form="remove_section" required>

                            </select>
                        </div>

                                <button type="button" class="btn btn-danger" name="rmv_sec_submit" data-toggle="modal" data-target="#confirmModal" style="margin-top:10px;">Remove a Group</button>
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
                                        <input type="submit" class="btn btn-danger" value="Yes, I'm sure!">
                                      </div>
                                    </div>
                                  </div>
                                </div>
                      </form>
                    </div>

                    <div class="tab-pane" id="tab3">
                        <form class="add_group form-horizontal" action="" method="post">
                          <div class="form-group">
                            <label for="actual_name" class="col-sm-2 col-sm-offset-1">Group name:</label>
                            <div class="col-sm-4">
                            <input type="text" id="actual_name" class="form-control">
                            </div>
                          </div>

                          <input type="submit" class="btn btn-primary col-sm-offset-3" name="section_submit" value="Add a Section">
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
