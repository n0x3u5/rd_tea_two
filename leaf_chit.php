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
    <title>R.D. Tea |Daily Leaf Chit</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.css">
    <link rel="stylesheet" href="css/stylesheet.css">
    <link rel="icon" href="images/logo_rdtea.png"/>
    <?php $page_id = 11;?>
    <style>
			.jumbotron {
				background:#520808;
			}
			.jumbotron h1,h3 {
				color:#EDD2D2;
			}
      .jumbotron form input[type="submit"] {
				background: #FFC107;
				color: #000000;
			}
			.container{
				width:85%;
			}
			th{
				text-align: center;
			}
			.main-content .btn {
				box-shadow: none;
			}
			div.DTTT { margin-bottom: 0.5em; float: right; }
    	div.dataTables_wrapper { clear: both; }
    </style>
  </head>
  <body>
    <?php
      include("nav_bar.php");
      nav_echoer($page_id);
    ?>
    <div class="container">
      <div class="jumbotron">
        <h1>Leaf Chit</h1>
  			<h3>Hansqua Division</h3>
        <form class="form-inline" action="leaf_chit.php" method="post">
          <div class="form-group">
            <label class="sr-only" for="sectionPicker">Email address</label>
            <select class="form-control" id="sectionPicker">
							<option selected>Choose a section...</option>
							<option>1EXTA</option>
							<option>1EXTB</option>
							<option>EXT3</option>
							<option>4W</option>
						</select>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="datepicker" placeholder="dd-mm-yy">
          </div>
          <input type="submit" class="btn btn-warning" name="btn_submit" value="Get Data">
        </form>
      </div>
			<div class="main-content">

				<table id="leaf_chit_table" class="table table-hover table-bordered" cellspacing="0" width="100%">
					<thead>
						<tr class="col-head">
								<th rowspan="2">Labour<br/>Category</th>
								<th colspan="9">Unpruned</th>
								<th colspan="9">Pruned</th>
								<th colspan="3">Grand Total</th>
						</tr>
						<tr>
							<th>Date<br/>Last<br/>Plucked</th>
							<th>Rnd.<br/>Days</th>
							<th>Sec.</th>
							<th>Area<br/>Plkd<br/>(Hec.)</th>
							<th>Plkrs.</th>
							<th>Plkrs<br/>per<br/>Hec.</th>
							<th>Leaf<br/>Plkd</th>
							<th>Avg.<br/>Prod.</th>
							<th>Task</th>
							<th>Date<br/>Last<br/>Plkd.</th>
							<th>Rnd.<br/>Days</th>
							<th>Sec.</th>
							<th>Area<br/>Plkd.<br/>(Hec.)</th>
							<th>Plkrs.</th>
							<th>Plkrs.<br/>per<br/>Hec.</th>
							<th>Leaf<br/>Plkd</th>
							<th>Avg.<br/>Prod.</th>
							<th>Task</th>
							<th>Tot.<br/>Area<br/>Plkd.<br/>(Hec.)</th>
							<th>Tot.<br/>Pluckers</th>
							<th>Tot.<br/>Leaf<br/>Plkd.</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Perm. Men</td>
							<td>27-06-2015</td>
							<td>1EXTA </td>
							<td>5</td>
							<td>112</td>
							<td>22</td>
							<td>2330</td>
							<td>21</td>
							<td>7</td>
							<td>24</td>
							<td>27-06-2015</td>
							<td>1EXTA</td>
							<td>5</td>
							<td>112</td>
							<td>22</td>
							<td>2330</td>
							<td>21</td>
							<td>7</td>
							<td>24</td>
							<td>10</td>
							<td>224</td>
							<td>4660</td>
						</tr>
						<tr>
							<td>Perm. Women</td>
							<td>28-06-2015</td>
							<td>1EXTA </td>
							<td>5</td>
							<td>112</td>
							<td>22</td>
							<td>2330</td>
							<td>21</td>
							<td>7</td>
							<td>24</td>
							<td>28-06-2015</td>
							<td>1EXTA</td>
							<td>5</td>
							<td>112</td>
							<td>22</td>
							<td>2330</td>
							<td>21</td>
							<td>7</td>
							<td>24</td>
							<td>10</td>
							<td>224</td>
							<td>4660</td>
						</tr>
						<tr>
							<td>Temp. Men</td>
							<td>29-06-2015</td>
							<td>1EXTA </td>
							<td>5</td>
							<td>112</td>
							<td>22</td>
							<td>2330</td>
							<td>21</td>
							<td>7</td>
							<td>24</td>
							<td>29-06-2015</td>
							<td>1EXTA</td>
							<td>5</td>
							<td>112</td>
							<td>22</td>
							<td>2330</td>
							<td>21</td>
							<td>7</td>
							<td>24</td>
							<td>10</td>
							<td>224</td>
							<td>4660</td>
						</tr>
						<tr>
							<td>Temp. Women</td>
							<td>30-06-2015</td>
							<td>1EXTA </td>
							<td>5</td>
							<td>112</td>
							<td>22</td>
							<td>2330</td>
							<td>21</td>
							<td>7</td>
							<td>24</td>
							<td>30-06-2015</td>
							<td>1EXTA</td>
							<td>5</td>
							<td>112</td>
							<td>22</td>
							<td>2330</td>
							<td>21</td>
							<td>7</td>
							<td>24</td>
							<td>10</td>
							<td>224</td>
							<td>4660</td>
						</tr>
						<tr>
							<td>Incentives</td>
							<td>01-07-2015</td>
							<td>1EXTA </td>
							<td>5</td>
							<td>112</td>
							<td>22</td>
							<td>2330</td>
							<td>21</td>
							<td>7</td>
							<td>24</td>
							<td>01-07-2015</td>
							<td>1EXTA</td>
							<td>5</td>
							<td>112</td>
							<td>22</td>
							<td>2330</td>
							<td>21</td>
							<td>7</td>
							<td>24</td>
							<td>10</td>
							<td>224</td>
							<td>4660</td>
						</tr>
						<tr>
							<td>Cash Pluckers</td>
							<td>02-07-2015</td>
							<td>1EXTA </td>
							<td>5</td>
							<td>112</td>
							<td>22</td>
							<td>2330</td>
							<td>21</td>
							<td>7</td>
							<td>24</td>
							<td>02-07-2015</td>
							<td>1EXTA</td>
							<td>5</td>
							<td>112</td>
							<td>22</td>
							<td>2330</td>
							<td>21</td>
							<td>7</td>
							<td>24</td>
							<td>10</td>
							<td>224</td>
							<td>4660</td>
						</tr>
						<tr>
							<td>Perm. Men</td>
							<td>03-07-2015</td>
							<td>1EXTA </td>
							<td>5</td>
							<td>112</td>
							<td>22</td>
							<td>2330</td>
							<td>21</td>
							<td>7</td>
							<td>24</td>
							<td>03-07-2015</td>
							<td>1EXTA</td>
							<td>5</td>
							<td>112</td>
							<td>22</td>
							<td>2330</td>
							<td>21</td>
							<td>7</td>
							<td>24</td>
							<td>10</td>
							<td>224</td>
							<td>4660</td>
						</tr>
					</tbody>
				</table>
			</div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="http://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/tabletools/2.2.4/js/dataTables.tableTools.min.js"></script>
		<script src="https://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js"></script>
		<script>
			$(function() {
				$("#datepicker").datepicker({
					dateFormat: "dd-mm-yy"
				});
				var table = $('#leaf_chit_table').DataTable({
						"scrollX": true,
						"ordering": false,
						dom: 'T<"clear">lfrtip',
						tableTools: {
	            "aButtons": [
	                "copy",
	                "xls",
	                {
	                    "sExtends": "pdf",
	                    "sPdfOrientation": "landscape",
	                },
	                "print"
	            	]
        		},
						"aoColumns": [
								null,
								{ "sType": "date-uk" },
								null,
								null,
								null,
								null,
								null,
								null,
								null,
								null,
								{ "sType": "date-uk" },
								null,
								null,
								null,
								null,
								null,
								null,
								null,
								null,
								null,
								null,
								null
						]
	    	});
			// 	var tt = new $.fn.dataTable.TableTools(table);
    	// 	$( tt.fnContainer() ).insertBefore('div.dataTables_wrapper');
			});
			jQuery.extend( jQuery.fn.dataTableExt.oSort, {
			"date-uk-pre": function ( a ) {
			var ukDatea = a.split('-');
			return (ukDatea[2] + ukDatea[1] + ukDatea[0]) * 1;
			},

			"date-uk-asc": function ( a, b ) {
			return ((a < b) ? -1 : ((a > b) ? 1 : 0));
			},

			"date-uk-desc": function ( a, b ) {
			return ((a < b) ? 1 : ((a > b) ? -1 : 0));
			}
		} );
		</script>
  </body>
</html>
