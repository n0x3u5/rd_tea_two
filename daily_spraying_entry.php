<?php
	require_once('includes/sessions.php');
	require_once('includes/functions.php');

	if(!isset($_SESSION['user'])) {
		redirect_to("index.php");
	}
?>
<?php
	$connection = make_connection();

	//var_dump($_POST);echo "<br><hr>";

?>
<!DOCTYPE html>
<html>
    <head>
      <meta charset="utf-8">
      <title>R.D. Tea | Daily Spraying Entry</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
		  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
      <link rel="stylesheet" href="css/stylesheet.css">
      <style>
        .card_style {
          background: #EFEBE9;
        }
        .nav-tabs.nav-justified > .active > a, .nav-tabs.nav-justified > .active > a:hover, .nav-tabs.nav-justified > .active > a:active, .nav-tabs.nav-justified > .active > a:enabled {
        background-color: #5D4037 !important;
        border-bottom-color: #5D4037;
        color: #FFFFFF;
        }
        .tab-content {
          background: #EFEBE9;
          padding: 20px;
        }
        .col-sm-4 .btn {
          width: auto;
        }
        .main-form {
          padding: 10px 0 10px 0;
        }
        @media (min-width: 768px) {
          .col-sm-2.col-sm-offset-4 .btn-success {
            float: right;
          }
        }
        @media (max-width: 768px) {
          .col-sm-2.col-sm-offset-4 .btn-success {
            float: right;
          }
        }
        @media (max-width: 500px) {
          .col-sm-2.col-sm-offset-4 .btn-success {
            float: left;
          }
          .btn {
            margin-left: 40px;
          }
        }
        .col-sm-6 .btn {
          margin-top: 15px;
        }
        .col-sm-2 .btn{
          margin-top: 10px;
          margin-bottom: 5px;
        }
      </style>
      <link rel="icon" href="images/logo_rdtea.png"/>
      <?php $page_id = 9;?>
    </head>
    <body>
        <?php
          include("nav_bar.php");
          nav_echoer($page_id);
        ?>
        <div class="container">
          <div class="jumbotron" style="background:#795548;">
            <h1>Spraying Data Entry</h1>
            <form action="" class="form-horizontal" method="post">
                <button type="submit" name="dt_sec_submit" class="btn btn-success" style="margin-top:-1px;">Submit</button>
            </form>
        	</div>
          <div class="col-sm-12 card_style" style="padding-bottom:15px;">
            <ul class="nav nav-tabs nav-justified">
              <li  class="active" id="ac_one"><a href="#tab1" data-toggle="tab" id="take1">Update or Delete Record</a></li>
              <li id="ac_two"><a href="#tab2" data-toggle="tab" id="take2">Add Record</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab1">
                <form class="form-horizontal" action="daily_spraying_entry.php" method="post">
                </form>
              </div>
              <div class="tab-pane" id="tab2">
                <form class="form-horizontal" action="daily_spraying_entry.php" method="post">
                </form>
              </div>
            </div>
          </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    		<script>
    				$(function() {
    				$( "#datepicker" ).datepicker({dateFormat: 'dd-mm-yy'});
    				});
    		</script>
				<?php
					// if(isset($var_chk)){
					// echo"<script>		var submit_chk=$var_chk; submit_chk2=$sub_enable_two; </script>";}
					//
					// ?>
					<script>


					</script>

        </body>
    </body>
</html>

<?php
  // mysqli_free_result($result);
	end_connection($connection);
?>
