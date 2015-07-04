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
                        <li <?php if($page_id == 1) {?> class="active"><a href="#"> <?php } else { ?> ><a href="manage_users.php"> <?php } ?> Manage Users</a></li>
                        <li <?php if($page_id == 2) {?> class="active"><a href="#"> <?php } else { ?> ><a href="manage_sections.php"> <?php } ?> Manage Sections</a></li>
                        <li <?php if($page_id == 7 || $page_id == 8 || $page_id == 9) { ?> class="dropdown dropdown-active"> <?php } else { ?> class="dropdown"> <?php } ?>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Data Entry <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="daily_plucking_entry.php">Plucking Entry</a></li>
                                <li><a href="daily_spraying_entry.php">Spraying Entry</a></li>
                                <li><a href="weather_input.php">Weather Entry</a></li>
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
                                <li><a href="spray_chit.php">Spraying Chit</a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li <?php if($page_id == 3) { ?> class="dropdown dropdown-active"> <?php } else { ?> class="dropdown"> <?php } ?>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Signed in as <?php if(isset($_SESSION)) { echo $_SESSION['user']; } else { echo "Invalid User!"; } ?> <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="form_process_logout.php">Log Out</a></li>
                            <li><a href="update_profile.php">Your Profile</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#">Separated link</a></li>
                        </ul>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
<?php
    } ?>
