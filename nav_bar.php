<?php
    function nav_echoer($page_id) { ?>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#" style="padding: 2px; padding-right:20px;">
                        <img src="images/logo_rdtea.png" alt="R.D. Tea" height="45px" width="45px">
                    </a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <?php if ($_SESSION['user_lvl'] < 3) { ?><li <?php if($page_id == 1) {?> class="active"><a href="manage_users.php"> <?php } else { ?> ><a href="manage_users.php"> <?php } ?> Manage Users</a></li> <?php } ?>
                        <li <?php if($page_id == 2 || $page_id == 13) { ?> class="dropdown dropdown-active"> <?php } else { ?> class="dropdown"> <?php } ?>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Garden Management<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                              <!-- <li class="navbar-text">Plucking</li> -->
                              <li><a href="manage_sections.php">Manage Sections</a></li>
                              <li><a href="manage_labour_categories.php">Manage Labour Categories</a></li>
                            </ul>
                        </li>
                        <li <?php if($page_id == 7 || $page_id == 8 || $page_id == 9 || $page_id == 15) { ?> class="dropdown dropdown-active"> <?php } else { ?> class="dropdown"> <?php } ?>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Data Entry<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <!-- <li class="navbar-text">Plucking</li> -->
                                <li><a href="daily_plucking_entry.php">Daily Plucking Entry</a></li>
                                <li><a href="leaf_chit_entry.php">Leaf Chit Entry</a></li>
                                <li><a href="cash_plucking_entry.php">Daily Cash Plucking Entry</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="daily_spraying_entry.php">Spraying Entry</a></li>
                                <li role="separator" class="divider"></li>
                                <!-- <li class="navbar-text">Weather</li> -->
                                <li><a href="weather_input.php">Weather Entry</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="yearly_sectional_entry.php">Yearly Sectional Entry</a></li>
                            </ul>
                        </li>
                        <li <?php if($page_id == 4 || $page_id == 5 || $page_id == 6 || $page_id == 10 || $page_id == 11) { ?> class="dropdown dropdown-active"> <?php } else { ?> class="dropdown"> <?php } ?>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Reports <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="sectional_yearly_review.php">Yearly Report</a></li>
                                <li><a href="sectional_daily_review.php">Daily Report</a></li>
                                <li><a href="weather.php">Weather Report</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="leaf_chit.php">Leaf Chit</a></li>
                                <!-- <li><a href="spray_chit.php">Spraying Chit</a></li> -->
                            </ul>
                        </li>
                        <?php if ($_SESSION['user_lvl'] < 3) { ?><li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Action Logs<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li class="navbar-text">Coming Soon!</a></li>
                                <!-- <li><a href="spray_chit.php">Spraying Chit</a></li> -->
                            </ul>
                        </li><?php } ?>
                    </ul>
                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="navbar-form navbar-left" role="search">
                      <?php
                        //var_dump($_POST);
                        if(isset($_SESSION["login"])){
                          if($_SESSION['user_div'] == "ALL") {
                            $_SESSION['current_div'] = 'Hansqua';
                          }
                          else {
                            $_SESSION['current_div'] = $_SESSION['user_div'];
                          }
                          $_SESSION['login'] = NULL;
                        }
                        else if(isset($_POST["div_submit"])) {
                          $_SESSION['current_div'] = $_POST['select_div'];
                        }
                      ?>
                      <div class="form-group">
                        <select class="form-control" name="select_div">
                          <option <?php if($_SESSION['current_div'] == 'Hansqua') { echo "selected"; } ?> >Hansqua</option>
                          <option <?php if($_SESSION['current_div'] == 'Bidhannagar') { echo "selected"; } ?> >Bidhannagar</option>
                          <option <?php if($_SESSION['current_div'] == 'Kishoribag') { echo "selected"; } ?> >Kishoribag</option>
                          <option <?php if($_SESSION['current_div'] == 'Balasan') { echo "selected"; } ?> >Balasan</option>
                        </select>
                      </div>
                      <button type="submit" class="btn btn-default" id="crnt_div_sbmt" name="div_submit">Submit</button>
                    </form>
                    <ul class="nav navbar-nav navbar-right">
                        <li <?php if($page_id == 3) { ?> class="dropdown dropdown-active"> <?php } else { ?> class="dropdown"> <?php } ?>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Signed in as <?php if(isset($_SESSION)) { echo $_SESSION['user']; } else { echo "Invalid User!"; } ?> <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="form_process_logout.php">Log Out</a></li>
                            <li><a href="update_profile.php">Your Profile</a></li>
                        </ul>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
<?php
    } ?>
