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
        <link rel="icon" href="images/logo_rdtea.png"/>
        <?php $page_id = 5;?>
    </head>
    <body>
        <?php
            include("nav_bar.php");
            nav_echoer($page_id);
        ?>
        <div class="container">
            <div class="jumbotron" style="background:#0A6B16;margin-left:-15px;margin-right: -15px;">
                <h1>Sectional Review </h1>
                <p style="color:">(Daily)</p>
                <p></p>
                <p></p>
                <h3 style="color:#fff">Section: 45</h3>
                <form class="form-inline">
                  <div class="form-group">
                    <!-- <label class="sr-only" for="sec_select">Email address</label> -->
                    <select id="sec_select" class="form-control">
                      <option>1w</option>
                      <option>19</option>
                      <option>5E</option>
                      <option>6N</option>
                      <option>7w</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <!-- <label class="sr-only" for="start_year">Password</label> -->
                    <select id="start_year" class="form-control">
                      <option>2015</option>
                      <option>2016</option>
                      <option>2017</option>
                      <option>2018</option>
                      <option>2019</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <!-- <label class="sr-only" for="end_year">Password</label> -->
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


            <div class="tab-container" style="margin-top:10px;">
                <ul class="nav nav-tabs nav-justified">
                    <li class="active"><a href="#tab1" data-toggle="tab"> Plucking</a></li>
                    <li><a href="#tab2" data-toggle="tab">Spraying</a></li>
                </ul>
                <div class="tab-content"  style="background-color:#FFF">
                    <div class="tab-pane active" id="tab1">
                        <table  id="pluck_day" class="table table-hover" border="1">
                            <thead style="border: solid 2px green">
                                <tr>
                                    <th>Date</th>
                                    <th>Division</th>
                                    <th>Section</th>                                                                                                            <th>Status</th>
                                    <th>Area</th>
                                    <th>Prune</th>
                                    <th>Plucked Area</th>
                                    <th>Leaf</th>
                                    <th>Hz Quantity</th>
                                    <th>HJ area</th>
                                    <th>Db Quantity</th>
                                    <th>Db area</th>
                                    <th>Mandays</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="text-align:center;">10-6-2015</td>
                                    <td>HN</td>
                                    <td>1West</td>
                                    <td>Medium</td>
                                    <td>1.89</td>
                                    <td>LP</td>
                                    <td>12</td>
                                    <td>957</td>
                                    <td></td>
                                    <td>917</td>
                                    <td></td>
                                    <td>40</td>
                                    <td>6</td>
                                </tr>
                                <tr>
                                    <td style="text-align:center;">10-6-2015</td>
                                    <td>HN</td>
                                    <td>1West</td>
                                    <td>Medium</td>
                                    <td>1.89</td>
                                    <td>LP</td>
                                    <td>12</td>
                                    <td>957</td>
                                    <td></td>
                                    <td>917</td>
                                    <td></td>
                                    <td>40</td>
                                    <td>6</td>
                                </tr>
                                <tr>
                                    <td style="text-align:center;">10-6-2015</td>
                                    <td>HN</td>
                                    <td>1West</td>
                                    <td>Medium</td>
                                    <td>1.89</td>
                                    <td>LP</td>
                                    <td>12</td>
                                    <td>957</td>
                                    <td></td>
                                    <td>917</td>
                                    <td></td>
                                    <td>40</td>
                                    <td>6</td>
                                </tr>
                                <tr>
                                    <td style="text-align:center;">10-6-2015</td>
                                    <td>HN</td>
                                    <td>1West</td>
                                    <td>Medium</td>
                                    <td>1.89</td>
                                    <td>LP</td>
                                    <td>12</td>
                                    <td>957</td>
                                    <td></td>
                                    <td>917</td>
                                    <td></td>
                                    <td>40</td>
                                    <td>6</td>
                                </tr>
                                <tr>
                                    <td style="text-align:center;">10-6-2015</td>
                                    <td>HN</td>
                                    <td>1West</td>
                                    <td>Medium</td>
                                    <td>1.89</td>
                                    <td>LP</td>
                                    <td>12</td>
                                    <td>957</td>
                                    <td></td>
                                    <td>917</td>
                                    <td></td>
                                    <td>40</td>
                                    <td>6</td>
                                </tr>
                                <tr>
                                    <td style="text-align:center;">10-6-2015</td>
                                    <td>HN</td>
                                    <td>1West</td>
                                    <td>Medium</td>
                                    <td>1.89</td>
                                    <td>LP</td>
                                    <td>12</td>
                                    <td>957</td>
                                    <td></td>
                                    <td>917</td>
                                    <td></td>
                                    <td>40</td>
                                    <td>6</td>
                                </tr>
                                <tr>
                                    <td style="text-align:center;">10-6-2015</td>
                                    <td>HN</td>
                                    <td>1West</td>
                                    <td>Medium</td>
                                    <td>1.89</td>
                                    <td>LP</td>
                                    <td>12</td>
                                    <td>957</td>
                                    <td></td>
                                    <td>917</td>
                                    <td></td>
                                    <td>40</td>
                                    <td>6</td>
                                </tr>
                                <tr>
                                    <td style="text-align:center;">10-6-2015</td>
                                    <td>HN</td>
                                    <td>1West</td>
                                    <td>Medium</td>
                                    <td>1.89</td>
                                    <td>LP</td>
                                    <td>12</td>
                                    <td>957</td>
                                    <td></td>
                                    <td>917</td>
                                    <td></td>
                                    <td>40</td>
                                    <td>6</td>
                                </tr>
                                <tr>
                                    <td style="text-align:center;">10-6-2015</td>
                                    <td>HN</td>
                                    <td>1West</td>
                                    <td>Medium</td>
                                    <td>1.89</td>
                                    <td>LP</td>
                                    <td>12</td>
                                    <td>957</td>
                                    <td></td>
                                    <td>917</td>
                                    <td></td>
                                    <td>40</td>
                                    <td>6</td>
                                </tr>
                                <tr>
                                    <td style="text-align:center;">10-6-2015</td>
                                    <td>HN</td>
                                    <td>1West</td>
                                    <td>Medium</td>
                                    <td>1.89</td>
                                    <td>LP</td>
                                    <td>12</td>
                                    <td>957</td>
                                    <td></td>
                                    <td>917</td>
                                    <td></td>
                                    <td>40</td>
                                    <td>6</td>
                                </tr>
                                <tr>
                                    <td style="text-align:center;">10-6-2015</td>
                                    <td>HN</td>
                                    <td>1West</td>
                                    <td>Medium</td>
                                    <td>1.89</td>
                                    <td>LP</td>
                                    <td>12</td>
                                    <td>957</td>
                                    <td></td>
                                    <td>917</td>
                                    <td></td>
                                    <td>40</td>
                                    <td>6</td>
                                </tr>
                                <tr>
                                    <td style="text-align:center;">10-6-2015</td>
                                    <td>HN</td>
                                    <td>1West</td>
                                    <td>Medium</td>
                                    <td>1.89</td>
                                    <td>LP</td>
                                    <td>12</td>
                                    <td>957</td>
                                    <td></td>
                                    <td>917</td>
                                    <td></td>
                                    <td>40</td>
                                    <td>6</td>
                                </tr>
                                <tr>
                                    <td style="text-align:center;">10-6-2015</td>
                                    <td>HN</td>
                                    <td>1West</td>
                                    <td>Medium</td>
                                    <td>1.89</td>
                                    <td>LP</td>
                                    <td>12</td>
                                    <td>957</td>
                                    <td></td>
                                    <td>917</td>
                                    <td></td>
                                    <td>40</td>
                                    <td>6</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="tab2">
                        <!-- <table  id="pluck_day" class="table table-hover" border="1">

                        </table> -->
                    </div>


                </div>
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <script src="http://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
        <script src="http://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js"></script>
        <script src="http://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js">
        </script>
        <script>
            $(document).ready(function() {
                    $('#pluck_day').dataTable();
                    $('#spray_day').dataTable();
            });
        </script>
    </body>
</html>
