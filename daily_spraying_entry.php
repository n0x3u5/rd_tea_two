<!DOCTYPE html>
<html>
    <head>
      <meta charset="utf-8">
      <title>R.D. Tea | Manage Sections</title>
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
            <form class="form-inline">
              <select class="form-control" placeholder="Section Name">
                <option>1 Extension A</option>
              </select>
              <div class="form-group">
                <div class="input-group" style="width:100%">
                  <input type="text" class="form-control" id="datepicker" placeholder="dd-mm-yyyy">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                </div>
              </div>
                <button type="submit" class="btn btn-success" style="margin-top:-1px;">Submit</button>
          </form>
        </div>
          <div class="col-sm-12 card_style" style="padding-bottom:15px;">
            <ul class="nav nav-tabs nav-justified">
              <li class="active"><a href="#tab1" data-toggle="tab">Update or Delete Record</a></li>
              <li><a href="#tab2" data-toggle="tab">Add Record</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab1">
                <form class="form-horizontal">
                  <div class="row">
                    <div class="col-sm-6">
                      <button type="button" class="btn btn-danger pull-left" data-toggle="modal" data-target="#confirmModal">Delete Record</button>
                    </div>
                    <div class="col-sm-2 col-sm-offset-4">
                      <button type="submit" class="btn btn-success btn-lg">Edit Record</button>
                    </div>
                  </div>
                  <div class="row main-form">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="left_hzar" class="col-sm-1 control-label">Hazri Area</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_hzar">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_dbar" class="col-sm-1 control-label">Doubly Area</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_dbar">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_hzmd" class="col-sm-1 control-label">Hazri Mandays</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_hzmd">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_hzmx" class="col-sm-1 control-label">DR Hazri (mixer)</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_hzmx">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_hzpw" class="col-sm-1 control-label">DR Hazri (paniwalla)</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_hzpw">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drum" class="col-sm-1 control-label">Drum (short)</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drum">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_mrmd" class="col-sm-1 control-label">MR Doubly Mandays</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_mrmd">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_nlmd" class="col-sm-1 control-label">DR Doubly NL Mandays</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_nlmd">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drmd" class="col-sm-1 control-label">DR Doubly Mandays</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drmd">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_mcmd" class="col-sm-1 control-label">MC Doubly Mandays</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_mcmd">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_dbmx" class="col-sm-1 control-label">DR Doubly Mixer</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_dbmx">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_dbpw" class="col-sm-1 control-label">DR Doubly Paniwalla</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_dbpw">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_cocktail" class="col-sm-1 control-label">Cocktail</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_cocktail">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_pst" class="col-sm-1 control-label">Pest and Disease</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_pst">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_infint" class="col-sm-1 control-label">Infection Intensity</label>
                        <div class="col-sm-10 col-sm-offset-1">
                            <select class="form-control" name="">
                              <option></option>
                              <option>H</option>
                              <option>M</option>
                              <option>L</option>
                            </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">Drums Sprayed</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">INS1 Name</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">INS1 Dose</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">INS1 Quantity</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">INS2 Name</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">INS2 Dose</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">INS2 Quantity</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">ACC3 Name</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">ACC3 Dose</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">ACC3 Quantity</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">SYNTH4 Name</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">SYNTH4 Dose</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">SYNTH4 Quantity</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">STR5 Name</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">STR5 Dose</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">STR5 Quantity</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">FNG6 Name</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">FNG6 Dose</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">FNG6 Quantity</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">WDC7 Name</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">WDC7 Dose</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">WDC7 Quantity</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">WDC8 Name</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">WDC8 Dose</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">WDC8 Quantity</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">Urea</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">Dose</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">NTR9 Quantity</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">Zinc</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">Dose</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">NTR10 Quantity</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">Booron</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">Dose</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">NTR11 Quantity</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">Other_1</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">Dose</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">Other_1 Quantity</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">Other_2</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">Dose</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">Other_2 Quantity</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">Other_3</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">Dose</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">Other_3 Quantity</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmModal">Delete Record</button>
                    </div>
                    <div class="col-sm-2 col-sm-offset-4">
                      <button type="submit" class="btn btn-success btn-lg">Edit Record</button>
                    </div>
                  </div>
                  <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
                        </div>
                        <div class="modal-body">
                          <p>Are you sure you want to delete this record?</p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-danger btn-lg">Confirm Delete</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <div class="tab-pane" id="tab2">
                <form class="form-horizontal">
                  <div class="row">
                    <div class="col-sm-12">
                      <button type="submit" class="btn btn-success pull-right btn-lg">Add Record</button>
                    </div>
                  </div>
                  <div class="row main-form">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="left_hzar" class="col-sm-1 control-label">Hazri Area</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_hzar">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_dbar" class="col-sm-1 control-label">Doubly Area</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_dbar">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_hzmd" class="col-sm-1 control-label">Hazri Mandays</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_hzmd">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_hzmx" class="col-sm-1 control-label">DR Hazri (mixer)</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_hzmx">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_hzpw" class="col-sm-1 control-label">DR Hazri (paniwalla)</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_hzpw">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drum" class="col-sm-1 control-label">Drum (short)</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drum">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_mrmd" class="col-sm-1 control-label">MR Doubly Mandays</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_mrmd">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_nlmd" class="col-sm-1 control-label">DR Doubly NL Mandays</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_nlmd">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drmd" class="col-sm-1 control-label">DR Doubly Mandays</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drmd">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_mcmd" class="col-sm-1 control-label">MC Doubly Mandays</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_mcmd">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_dbmx" class="col-sm-1 control-label">DR Doubly Mixer</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_dbmx">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_dbpw" class="col-sm-1 control-label">DR Doubly Paniwalla</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_dbpw">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_cocktail" class="col-sm-1 control-label">Cocktail</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_cocktail">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_pst" class="col-sm-1 control-label">Pest and Disease</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_pst">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_infint" class="col-sm-1 control-label">Infection Intensity</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_infint">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">Drums Sprayed</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">INS1 Name</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">INS1 Dose</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">INS1 Quantity</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">INS2 Name</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">INS2 Dose</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">INS2 Quantity</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">ACC3 Name</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">ACC3 Dose</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">ACC3 Quantity</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">SYNTH4 Name</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">SYNTH4 Dose</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">SYNTH4 Quantity</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">STR5 Name</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">STR5 Dose</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">STR5 Quantity</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">FNG6 Name</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">FNG6 Dose</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">FNG6 Quantity</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">WDC7 Name</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">WDC7 Dose</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">WDC7 Quantity</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">WDC8 Name</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">WDC8 Dose</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">WDC8 Quantity</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">Urea</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">Dose</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">NTR9 Quantity</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">Zinc</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">Dose</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">NTR10 Quantity</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">Booron</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">Dose</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">NTR11 Quantity</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">Other</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">Dose</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">Other_1</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">Dose</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">Other_1 Quantity</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">Other_2</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">Dose</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">Other_2 Quantity</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">Other_3</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">Dose</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="left_drsp" class="col-sm-1 control-label">Other_3 Quantity</label>
                        <div class="col-sm-10 col-sm-offset-1">
                          <input type="text" class="form-control" id="left_drsp">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <button type="submit" class="btn btn-success pull-right btn-lg">Add Record</button>
                    </div>
                  </div>
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
    				$( "#datepicker" ).datepicker({dateFormat: 'dd-mm-yy'});
    				});
    		</script>
        </body>
    </body>
</html>
