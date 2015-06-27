<?php
	require_once('/includes/sessions.php');
	require_once('/includes/functions.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>R.D. Tea | Manage Sections</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
        <style>
          /*#dangerous-btn{
            margin-left:26%;
          }*/
          @media (min-width: 500px) {
            .btn {
              display: inline;
							margin-left: 27%;
            }
          }
        </style>
        <link rel="stylesheet" href="css/stylesheet.css">

        <?php $page_id = 8;?>
    </head>
    <body>
        <?php
            include("nav_bar.php");
            nav_echoer($page_id);
        ?>
        <div class="container">
            <div class="jumbotron" style="background:#2A47A3;margin-left:-15px;margin-right: -15px;">
                <h1>Divisional Weather Entry</h1>
                <p></p>
                <p></p>
                <h3 style="color:#fff">Division</h3>
                <form class="form-inline">
                        <select id="division" class="form-control input-group">
                          <option>Balasan</option>
                          <option>Bidhannagar</option>
                          <option>Hansqua</option>
                          <option>Kishoribag</option>
                        </select>
                        <div class="input-group">
  	                        <input type="text" name="date_value" class="form-control" id="datepicker" value="" placeholder="" onChange="enable_add()">
  	                        <span class="input-group-addon">
  	                            <i class="glyphicon glyphicon-calendar"></i>
  	                        </span>
  	                    </div>

                  <input type="submit" name="dt_sec_submit" class="btn btn-default" value="Click to Add" style="width:auto; margin:  -10px 0 0 5px;">
                </form>

            </div>

            <div class="tab-container">
              <ul class="nav nav-tabs nav-justified">
                  <li class="active"><a href="#tab1" data-toggle="tab">Edit Entry</a></li>
                  <li><a href="#tab2" data-toggle="tab">Add Entry</a></li>
              </ul>
              <div class="tab-content" style="background-color:#FFFFFF">
                <div class="tab-pane active" id="tab1">
                    <form class="form group" style="margin-top:15px;">
                      <div class="input-group">
                        <label for="max_rain">RainFall Maximum (in mm)</label>
                        <input type="number" placeholder="Maximum Rainfall" class="form form-control max_rain">
                      </div>
                      <div class="input-group">
                          <label for="min_rain">RainFall Minimum</label>
                          <input type="number" placeholder="Minimum Rainfall" class="form form-control min_rain">
                      </div>
                      <div class="input-group">
                        <label for="max_temp">Temparature Maximum( in &degC)</label>
                        <input type="number" placeholder="Maximum Temparature" class="form form-control max_temp">
                      </div>
                      <div class="input-group">
                        <label for="min_temp">Temparature Minimum (in &degC)</label>
                        <input type="number" placeholder="Minimum Temparature" class="form form-control min_temp">
                      </div>
                      <div class="input-group">
                        <label for="sun_hour">Sunshine Hour</label>
                        <input type="number" placeholder="Sunshine Hour" class="form form-control sun_hour">
                      </div>
                      <div class="input-group">
                        <label for="weath_cond">Weather Condition</label>
                        <input type="text" placeholder="Weather Condition" class="form form-control weath_cond">
                      </div>
                      <input type="submit" class="btn btn-success" value="Add Data" style="margin:10px 0 10px 0px;position:relative;">
                      <input type="submit" class="btn btn-danger" value="Delete Entry">


                  </form>
                </div>
                <div class="tab-pane" id="tab2">
                    <form class="form group" style="margin-top:15px;">
                      <div class="input-group">
                        <label for="max_rain">RainFall Maximum (in mm)</label>
                        <input type="number" placeholder="Maximum Rainfall" class="form form-control max_rain">
                      </div>
                      <div class="input-group">
                          <label for="min_rain">RainFall Minimum</label>
                          <input type="number" placeholder="Minimum Rainfall" class="form form-control min_rain">
                      </div>
                      <div class="input-group">
                        <label for="max_temp">Temparature Maximum( in &degC)</label>
                        <input type="number" placeholder="Maximum Temparature" class="form form-control max_temp">
                      </div>
                      <div class="input-group">
                        <label for="min_temp">Temparature Minimum (in &degC)</label>
                        <input type="number" placeholder="Minimum Temparature" class="form form-control min_temp">
                      </div>
                      <div class="input-group">
                        <label for="sun_hour">Sunshine Hour</label>
                        <input type="number" placeholder="Sunshine Hour" class="form form-control sun_hour">
                      </div>
                      <div class="input-group">
                        <label for="weath_cond">Weather Condition</label>
                        <input type="text" placeholder="Weather Condition" class="form form-control weath_cond">
                      </div>
                      <input type="submit" class="btn btn-success" value="Add Data" style="margin:10px 0 10px 20px;"><p></p>
                    </form>
                </div>
              </div>
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

        <script>
            $(function() {
            $("#datepicker").datepicker({dateFormat: 'dd-mm-yy'});
            });
        </script>
    </body>
</html>
