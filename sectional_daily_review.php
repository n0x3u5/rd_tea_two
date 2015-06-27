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
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/1.0.6/css/dataTables.responsive.css">
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
                <h3 style="color:#fff">Section:</h3>
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
                                    <th>Section</th>
                                    <th>Prune</th>
                                    <th>Plucked Area</th>
                                    <th>Leaf</th>
                                    <th>Hz Quantity</th>
                                    <th>Hz area</th>
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
                         <table  id="spray_day" class="table table-hover" border="1">
                             <thead style="border: solid 2px green">
                                 <tr>
                                    <th>Date</th>
                                    <th>section</th>
                                    <th>Hz Area</th>
                                    <th>D area</th>
                                    <th>Mandays</th>
                                    <th>DR hz<br/>(mixer)</th>
                                    <th>DR Hz<br/>(paniwala)</th>
                                    <th>DRUM<br/>(Short)</th>
                                    <th>Mandays<br/>(MR DBLY)</th>
                                    <th>NL Mandays<br/>(DR DBLY)</th>
                                    <th>Mandays<br/>(DR DUbly)</th>
                                    <th>Mandays<br/>(M/C Dubly)</th>
                                    <th>DR Dbly<br/>(Mixer)</th>
                                    <th>DR dbly<br/>(Paniwala)</th>
                                    <th>Cocktail</th>
                                    <th>Pest and <br/>Disease</th>
                                    <th>Intensity Of<br/>Infection</th>
                                    <th>No Drums<br/>Sprayed</th>
                                    <th>INS 1</th>
                                    <th>DOSE</th>
                                    <th>INS 1<br/> (QTY)</th>
                                    <th>INS 2</th>
                                    <th>DOSE</th>
                                    <th>INS 2<br/>(QTY)</th>
                                    <th>ACC 3</th>
                                    <th>DOSE</th>
                                    <th>ACC 3 <br/>(QTY)</th>
                                    <th>SYTH 4</th>
                                    <th>DOSE</th>
                                    <th>SYTH 4<br/>(QTY)</th>

                                    <th>STR 5</th>
                                    <th>DOSE</th>
                                    <th>STR 5<br/>(QTY)</th>

                                    <th>FNG 6</th>
                                    <th>DOSE</th>
                                    <th>FNG 6<br/>(QTY)</th>

                                    <th>WDC 7</th>
                                    <th>DOSE</th>
                                    <th>WDC 7<br/>(QTY)</th>
                                    <th>WDC 8</th>
                                    <th>DOSE</th>
                                    <th>WDC 8<br/>(QTY)</th>
                                    <th>UREA</th>
                                    <th>DOSE</th>
                                    <th>NTR 9<br/>(QTY)</th>
                                    <th>ZINC</th>
                                    <th>DOSE</th>
                                    <th>NTR 10<br/>(QTY)</th>
                                    <th>BOORON</th>
                                    <th>DOSE</th>
                                    <th>NTR 11<br/>(QTY)</th>
																		<th>Other</th>
                                    <th>DOSE</th>
                                    <th>Other<br/>(QTY)</th>
                                </tr>
                             </thead>
                        </table>
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
        <script src="https://cdn.datatables.net/responsive/1.0.6/js/dataTables.responsive.js"></script>
        <script>
            $(document).ready(function() {
                    $('#pluck_day').dataTable({"scrollX": true});
                    $('#spray_day').dataTable({"scrollX": true});

            });
        </script>
    </body>
</html>
