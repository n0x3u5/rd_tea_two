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
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/stylesheet.css">
        <?php $page_id = 6;?>
    </head>
    <body>
        <?php
            include("nav_bar.php");
            nav_echoer($page_id);
        ?>
        <div class="container">
            <div class="jumbotron" style="background:#2A47A3;margin-left:-15px;margin-right: -15px;">
                <h1>Divisional Weather Details </h1>
                <p></p>
                <p></p>
                <h3 style="color:#fff">Division
                    <form>
                        <select id="division" class="form-control input-group">
                          <option>1w</option>
                          <option>7east</option>
                          <option>5n</option>
                          <option>6w</option>
                          <option>20n</option>
                        </select>
                    </form>
                </h3>
                <form class="form-inline">
                  <div class="form-group">
                    <select id="start_year" class="form-control">
                      <option>2015</option>
                      <option>2016</option>
                      <option>2017</option>
                      <option>2018</option>
                      <option>2019</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <select id="end_year" class="form-control">
                      <option>2015</option>
                      <option>2016</option>
                      <option>2017</option>
                      <option>2018</option>
                      <option>2019</option>
                    </select>
                  </div>
                  <button type="submit" class="btn btn-default" style="margin-top:0px;">Get Data</button>
                </form>

            </div>

            <div class="row" style="background-color:#FFF">
                <div   style="width:90%;margin:auto;">
                    <table id="weather" class="table table-hover" border="1">
                        <thead style="border: solid 2px black">
                            <tr>
                                <th rowspan="2">Date</th>
                                <th colspan="2">RainFall</th>
                                <th colspan="2">Temparature</th>
                                <th rowspan="2">Sunshine Hour</th>
                                <th rowspan="2">Weather condition</th>
                            </tr>
                            <tr>
                                <th>Day</th>
                                <th>Night</th>
                                <th>max</th>
                                <th>Min</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>10-06-2015</td>
                                <td>0</td>
                                <td>90</td>
                                <td>25</td>
                                <td>20</td>
                                <td>8</td>
                                <td>9</td>
                            </tr>
                            <tr>
                                <td>10-06-2015</td>
                                <td>00</td>
                                <td>00</td>
                                <td>31</td>
                                <td>29</td>
                                <td>10</td>
                                <td>11</td>
                            </tr>
                            <tr>
                                <td>10-06-2015</td>
                                <td>80</td>
                                <td>100</td>
                                <td>35</td>
                                <td>29</td>
                                <td>7</td>
                                <td>11</td>
                            </tr>
                            <tr>
                                <td>10-06-2015</td>
                                <td>80</td>
                                <td>100</td>
                                <td>35</td>
                                <td>29</td>
                                <td>12</td>
                                <td>10</td>
                            </tr>
                            <tr>
                                <td>10-06-2015</td>
                                <td>0</td>
                                <td>90</td>
                                <td>25</td>
                                <td>20</td>
                                <td>8</td>
                                <td>9</td>
                            </tr>
                            <tr>
                                <td>10-06-2015</td>
                                <td>00</td>
                                <td>00</td>
                                <td>31</td>
                                <td>29</td>
                                <td>10</td>
                                <td>11</td>
                            </tr>
                            <tr>
                                <td>10-06-2015</td>
                                <td>80</td>
                                <td>100</td>
                                <td>35</td>
                                <td>29</td>
                                <td>7</td>
                                <td>11</td>
                            </tr>
                            <tr>
                                <td>10-06-2015</td>
                                <td>80</td>
                                <td>100</td>
                                <td>35</td>
                                <td>29</td>
                                <td>12</td>
                                <td>10</td>
                            </tr>
                            <tr>
                                <td>10-06-2015</td>
                                <td>0</td>
                                <td>90</td>
                                <td>25</td>
                                <td>20</td>
                                <td>8</td>
                                <td>9</td>
                            </tr>
                            <tr>
                                <td>10-06-2015</td>
                                <td>00</td>
                                <td>00</td>
                                <td>31</td>
                                <td>29</td>
                                <td>10</td>
                                <td>11</td>
                            </tr>
                            <tr>
                                <td>10-06-2015</td>
                                <td>80</td>
                                <td>100</td>
                                <td>35</td>
                                <td>29</td>
                                <td>7</td>
                                <td>11</td>
                            </tr>
                            <tr>
                                <td>10-06-2015</td>
                                <td>80</td>
                                <td>100</td>
                                <td>35</td>
                                <td>29</td>
                                <td>12</td>
                                <td>10</td>
                            </tr>
                            <tr>
                                <td>10-06-2015</td>
                                <td>0</td>
                                <td>90</td>
                                <td>25</td>
                                <td>20</td>
                                <td>8</td>
                                <td>9</td>
                            </tr>
                            <tr>
                                <td>10-06-2015</td>
                                <td>00</td>
                                <td>00</td>
                                <td>31</td>
                                <td>29</td>
                                <td>10</td>
                                <td>11</td>
                            </tr>
                            <tr>
                                <td>10-06-2015</td>
                                <td>80</td>
                                <td>100</td>
                                <td>35</td>
                                <td>29</td>
                                <td>7</td>
                                <td>11</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <script src="http://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
        <script src="http://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js"></script>
	    <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js">
		</script>
		<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready(function() {
                    $('#weather').dataTable({"scrollX": true});
            });
        </script>
    </body>
</html>
