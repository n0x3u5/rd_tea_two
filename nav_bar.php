<?php
    function nav_echoer($page_id) { ?>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse" aria-expanded="false">
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
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li <?php if($page_id == 1) {?> class="active"><a href="#"> <?php } else { ?> ><a href="manage_users.php"> <?php } ?> Manage Users</a></li>
                        <li <?php if($page_id == 2) {?> class="active"><a href="#"> <?php } else { ?> ><a href="daily_leaf_report.php"> <?php } ?> Daily Green Leaf Record</a></li>
                        <li <?php if($page_id == 3) {?> class="active"><a href="#"> <?php } else { ?> ><a href="update_profile.php"> <?php } ?> Your Profile</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#">Link</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Account Actions<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="form_process_logout.php">Log Out</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li><a href="#">Separated link</a></li>
                            </ul>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>
<?php
    } ?>