<?php
	require_once('/includes/sessions.php');
	require_once('/includes/functions.php');

	if(!isset($_SESSION['user'])) {
		redirect_to("index.php");
	}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>R.D. Tea | Yearly Sectional Review</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
				<link rel="stylesheet" href="https://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.css">
				<link rel="stylesheet" href="css/stylesheet.css">
				<style rel="stylesheet">
					.card_style{
						margin-left:6%;
						margin-bottom:1%;
						background-color:#FFFFFF;
						border-style: outset;
					}
				</style>
        <link rel="icon" href="images/logo_rdtea.png"/>
        <?php $page_id = 4;?>
    </head>
    <body>
        <?php
            include("nav_bar.php");
            nav_echoer($page_id);
        ?>
        <div class="container">
            <div class="jumbotron" style="background:#303F9F;margin-left:-15px;margin-right: -15px;">
                <h1>Sectional Review </h1>
                <p style="color:">(Yearly)</p>
            </div>

            <div class="row">
                <div class="col-sm-2 card_style"><h4>Section Name</h4><p> 1west</p></div>
                <div class="col-sm-2 card_style"><h4>Jat/Clone</h4><p> Genus</p></div>
                <div class="col-sm-2 card_style"><h4>Shade(temp) Species</h4><p>bioregions</p></div>
                <div class="col-sm-2 card_style"><h4>Shade (perm.) Species</h4><p>Acer saccharum</p></div>
            </div>
            <div class="row">
							<div class="col-sm-2 card_style"><h4>Frame(in Inch) HEight</h4><p>10"</p></div>
							<div class="col-sm-2 card_style"><h4>Bush(in Inch)<br>Height</h4><p> 7"</p></div>
							<div class="col-sm-2 card_style"><h4>Area</h4>(in Hectare)<p> 120</p></div>
							<div class="col-sm-2 card_style"><h4>Year of Planting</h4><p> 1972</p></div>
						</div>
						<div class="row">
							<div class="col-sm-2 card_style"><h4>Plant spacing</h4><p> 3"</p></div>
			        <div class="col-sm-2 card_style"><h4>TEmporary shade spacing</h4><p> 2"</p></div>
							<div class="col-sm-2 card_style"><h4>Permanent Shade Spacing</h4><p> 3"</p></div>
							<div class="col-sm-2 card_style"><h4>Ext./<br>Replant</h4><p> Y</p></div>
						</div>
						<div class="row">
							<div class="col-sm-2 card_style"><h4>Plant Density</h4><p> Poor</p></div>
							<div class="col-sm-2 card_style"><h4>Drain-status</h4><p> medium</p></div>
							<div class="col-sm-2 card_style"><h4>Bush<br>popolation</h4><p> Poor</p></div>
							<div class="col-sm-2 card_style"><h4>Soil type and<br>topography</h4><p>rich</p></div>
						</div>

            <div class="tab-container" style="margin-top:10px;">
                <ul class="nav nav-tabs nav-justified">
                    <li class="active"><a href="#tab1" data-toggle="tab">Prune </a></li>
                    <li><a href="#tab2" data-toggle="tab">Soil  </a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab1">
                            <table  id="prune_year" class="display table table-hover" border="1" cellspacing="0" width="100%">
                                <thead  style="background-color:#A5D6A7">
                                    <tr>
                                        <th rowspan="2"   style="text-align:center padding:2 0 2 0 ">Year</th>
                                        <th rowspan="2"   style="text-align:center">Prune</th>
                                        <th rowspan="2"   style="text-align:center">Tipping</th>
                                        <th rowspan="2"   style="text-align:center">Made Tea<br>(in Kg/Ha)</th>
                                        <th rowspan="2"   style="text-align:center">Vacancy<br>(in %)</th>
                                        <th rowspan="2"   style="text-align:center">Shade<br> Status</th>
                                        <th colspan="2"   style="text-align:center">Infilling
                                        </th>
                                        <th rowspan="2"  style="text-align:center">Remarks</th>
                                    </tr>
                                    <tr>
                                        <th>Tea</th>
                                        <th>Shade</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>

                                        <td   style="text-align:center">27-06-2015</td>
                                        <td   style="text-align:center">2</td>
                                        <td   style="text-align:center">3</td>
                                        <td   style="text-align:center">4</td>
                                        <td   style="text-align:center">5</td>
                                        <td   style="text-align:center">6</td>
                                        <td   style="text-align:center">7</td>
                                        <td   style="text-align:center">8</td>
                                        <td   style="text-align:center">Demand is increasing, Need more labour to prune the land faster.</td>
                                    </tr>
                                    <tr>

                                        <td   style="text-align:center">28-06-2015</td>
                                        <td   style="text-align:center">23</td>
                                        <td   style="text-align:center">34</td>
                                        <td   style="text-align:center">45</td>
                                        <td   style="text-align:center">56</td>
                                        <td   style="text-align:center">67</td>
                                        <td   style="text-align:center">78</td>
                                        <td   style="text-align:center">89</td>
                                        <td   style="text-align:center">The draining system is not performing properly.</td>
                                    </tr>
																		<tr>

                                        <td   style="text-align:center">29-06-2015</td>
                                        <td   style="text-align:center">23</td>
                                        <td   style="text-align:center">34</td>
                                        <td   style="text-align:center">45</td>
                                        <td   style="text-align:center">56</td>
                                        <td   style="text-align:center">67</td>
                                        <td   style="text-align:center">78</td>
                                        <td   style="text-align:center">89</td>
                                        <td   style="text-align:center">The draining system is not performing properly.</td>
                                    </tr>
																		<tr>

                                        <td   style="text-align:center">30-06-2015</td>
                                        <td   style="text-align:center">23</td>
                                        <td   style="text-align:center">34</td>
                                        <td   style="text-align:center">45</td>
                                        <td   style="text-align:center">56</td>
                                        <td   style="text-align:center">67</td>
                                        <td   style="text-align:center">78</td>
                                        <td   style="text-align:center">89</td>
                                        <td   style="text-align:center">The draining system is not performing properly.</td>
                                    </tr>
																		<tr>

                                        <td   style="text-align:center">01-07-2015</td>
                                        <td   style="text-align:center">23</td>
                                        <td   style="text-align:center">34</td>
                                        <td   style="text-align:center">45</td>
                                        <td   style="text-align:center">56</td>
                                        <td   style="text-align:center">67</td>
                                        <td   style="text-align:center">78</td>
                                        <td   style="text-align:center">89</td>
                                        <td   style="text-align:center">The draining system is not performing properly.</td>
                                    </tr>
																		<tr>

                                        <td   style="text-align:center">02-07-2015</td>
                                        <td   style="text-align:center">23</td>
                                        <td   style="text-align:center">34</td>
                                        <td   style="text-align:center">45</td>
                                        <td   style="text-align:center">56</td>
                                        <td   style="text-align:center">67</td>
                                        <td   style="text-align:center">78</td>
                                        <td   style="text-align:center">89</td>
                                        <td   style="text-align:center">The draining system is not performing properly.</td>
                                    </tr>
                                </tbody>
                            </table>
                    </div>
                    <div class="tab-pane" id="tab2">
                        <table  id="soil_year" class="table table-hover display" border="1" cellspacing="0" width="100%">
                            <thead  style="background-color:#A5D6A7">
                                <tr>
                                    <th rowspan="2">Year</th>
                                    <th rowspan="2">Made Tea(in Kg/Ha)</th>
                                    <th colspan="3">Manuring Kg/Ha</th>
                                    <th rowspan="2">Top(in pH)</th>
                                    <th rowspan="2">SUb (in pH)</th>
                                    <th rowspan="2">Org C  (in %)</th>
                                    <th rowspan="2">Av P(in ppm)</th>
                                    <th rowspan="2">Av P (in ppm)</th>
                                    <th rowspan="2">Av k (in ppm)</th>
                                    <th rowspan="2">Avbl N (in %)</th>
                                    <th rowspan="2">Avbl S(in ppm)</th>

                                </tr>
                                <tr>
                                    <th>N</th>
                                    <th>P</th>
                                    <th>k</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>

                                    <td   style="text-align:center">1970</td>
                                    <td   style="text-align:center">2</td>
                                    <td   style="text-align:center">3</td>
                                    <td   style="text-align:center">4</td>
                                    <td   style="text-align:center">5</td>
                                    <td   style="text-align:center">6</td>
                                    <td   style="text-align:center">7</td>
                                    <td   style="text-align:center">8</td>
                                    <td   style="text-align:center">9</td>
                                    <td   style="text-align:center">10</td>
                                    <td   style="text-align:center">11</td>
                                    <td   style="text-align:center">12</td>
                                    <td   style="text-align:center">13</td>
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
        <script src="http://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js">
        </script>
        <script>
            $(document).ready(function() {
							$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
						    e.target // activated tab
						    e.relatedTarget // previous tab
						    var table = $.fn.dataTable.fnTables(true);
						    if (table.length > 0) {
					        $(table).dataTable().fnAdjustColumnSizing();
						    }
							});
               $('#prune_year').dataTable({"scrollX": true});
               $('#soil_year').dataTable({"scrollX": true});
            });
        </script>
    </body>
</html>
