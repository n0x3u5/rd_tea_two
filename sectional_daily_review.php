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
                <!-- <form class="form-inline">
                    <div class="form-group">
                            <select class="form-control" style="width:50%">
                              <option>1w</option>
                              <option>19</option>
                              <option>5E</option>
                              <option>6N</option>
                              <option>7w</option>
                            </select>
                            <select class="form-control" style="width:50%">
                              <option>2015</option>
                              <option>2016</option>
                              <option>2017</option>
                              <option>2018</option>
                              <option>2019</option>
                            </select>
                            <select class="form-control" style="width:50%">
                              <option>2015</option>
                              <option>2016</option>
                              <option>2017</option>
                              <option>2018</option>
                              <option>2019</option>
                            </select>

                    </div>
                    <button class="btn btn-default" type="submit">Click to Find</button>
                </form> -->
            </div>

            <!-- <div class="row" style="background:#bbcdd7;">
                <div class="col-sm-1"><h4>Section<br/></h4><p> 1west</p></div>
                <div class="col-sm-1" style="text-align:center;"><h4>Jat/<br>Clone</h4><p> Genus</p></div>
                <div class="col-sm-2" style="text-align:center;"><h4>Shade(temp)<br/> Species</h4><p>bioregions</p></div>
                <div class="col-sm-2"><h4>Shade (perm.) Species</h4><p>Acer saccharum</p></div>
                <div class="col-sm-2"><h4>Frame(in Inch) HEight</h4><p>10"</p></div>
                <div class="col-sm-2"><h4>Bush(in Inch)<br>Height</h4><p> 7"</p></div>
                <div class="col-sm-1"><h4>Area</h4>(in Hector)<p> 120</p></div>


            </div>
            <p></p>
            <div class="row" style="background:#bbcdd7;">
                    <div class="col-sm-1"><h4>Year of Planting</h4><p> 1972</p></div>
                    <div class="col-sm-1"><h4>Plant spacing</h4><p> 3"</p></div>
                    <div class="col-sm-2"><h4>Temporary shade spacing</h4><p> 2"</p></div>
                    <div class="col-sm-2"><h4>Permanent Shade Spacing</h4><p> 3"</p></div>
                    <div class="col-sm-1"><h4>Ext./<br>Replant</h4><p> Y</p></div>
                    <div class="col-sm-1"><h4>Plant Density</h4><p> Poor</p></div>
                    <div class="col-sm-1"><h4>Drain-status</h4><p> medium</p></div>
                    <div class="col-sm-1" style="text-align:center;"><h4>Bush<br>popolation</h4><p> Poor</p></div>
                    <div class="col-sm-2" style="text-align:center;"><h4>Soil type and<br>topography</h4><p>rich</p></div>


            </div> -->

            <div class="tab-container" style="margin-top:10px;">
                <ul class="nav nav-tabs nav-justified">
                    <li class="active"><a href="#tab1" data-toggle="tab"> Plucking</a></li>
                    <li><a href="#tab2" data-toggle="tab">Spraying</a></li>
                    <li ><a href="#tab3" data-toggle="tab">Weather</a></li>
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

                    <div class="tab-pane" id="tab3">
                        <div class="row" style="width:95%;margin:auto">
                            <table  id="weather" class="table table-hover" border="1 px solid green">
                                <thead style="border:solid 2px green">
                                    <tr>
                                        <th colspan="2">RainFall(in mm.)</th>
                                        <th colspan="2">Temparature  (in &degC)</th>
                                        <th rowspan="2">Sunshine Hour</th>
                                        <th rowspan="2"> Weather condition</th>
                                    </tr>
                                    <tr>
                                        <th>Day</th>
                                        <th>Night</th>
                                        <th>Max</th>
                                        <th>Min</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>80</td>
                                        <td>100</td>
                                        <td>35</td>
                                        <td>29</td>
                                        <td>12</td>
                                        <td>10</td>
                                    </tr>
                                    <tr>
                                        <td>0</td>
                                        <td>90</td>
                                        <td>25</td>
                                        <td>20</td>
                                        <td>8</td>
                                        <td>9</td>
                                    </tr>
                                    <tr>
                                        <td>00</td>
                                        <td>00</td>
                                        <td>31</td>
                                        <td>29</td>
                                        <td>10</td>
                                        <td>11</td>
                                    </tr>
                                    <tr>
                                        <td>80</td>
                                        <td>100</td>
                                        <td>35</td>
                                        <td>29</td>
                                        <td>7</td>
                                        <td>11</td>
                                    </tr>
                                    <tr>
                                        <td>80</td>
                                        <td>100</td>
                                        <td>35</td>
                                        <td>29</td>
                                        <td>12</td>
                                        <td>10</td>
                                    </tr>
                                    <tr>
                                        <td>0</td>
                                        <td>90</td>
                                        <td>25</td>
                                        <td>20</td>
                                        <td>8</td>
                                        <td>9</td>
                                    </tr>
                                    <tr>
                                        <td>00</td>
                                        <td>00</td>
                                        <td>31</td>
                                        <td>29</td>
                                        <td>10</td>
                                        <td>11</td>
                                    </tr>
                                    <tr>
                                        <td>80</td>
                                        <td>100</td>
                                        <td>35</td>
                                        <td>29</td>
                                        <td>7</td>
                                        <td>11</td>
                                    </tr>
                                    <tr>
                                        <td>80</td>
                                        <td>100</td>
                                        <td>35</td>
                                        <td>29</td>
                                        <td>12</td>
                                        <td>10</td>
                                    </tr>
                                    <tr>
                                        <td>0</td>
                                        <td>90</td>
                                        <td>25</td>
                                        <td>20</td>
                                        <td>8</td>
                                        <td>9</td>
                                    </tr>
                                    <tr>
                                        <td>00</td>
                                        <td>00</td>
                                        <td>31</td>
                                        <td>29</td>
                                        <td>10</td>
                                        <td>11</td>
                                    </tr>
                                    <tr>
                                        <td>80</td>
                                        <td>100</td>
                                        <td>35</td>
                                        <td>29</td>
                                        <td>7</td>
                                        <td>11</td>
                                    </tr>
                                    <tr>
                                        <td>80</td>
                                        <td>100</td>
                                        <td>35</td>
                                        <td>29</td>
                                        <td>12</td>
                                        <td>10</td>
                                    </tr>
                                    <tr>
                                        <td>0</td>
                                        <td>90</td>
                                        <td>25</td>
                                        <td>20</td>
                                        <td>8</td>
                                        <td>9</td>
                                    </tr>
                                    <tr>
                                        <td>00</td>
                                        <td>00</td>
                                        <td>31</td>
                                        <td>29</td>
                                        <td>10</td>
                                        <td>11</td>
                                    </tr>
                                    <tr>
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
                    $('#weather').dataTable();
            });
        </script>
    </body>
</html>
