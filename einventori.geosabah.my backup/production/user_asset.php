<!DOCTYPE html>
<html lang="en">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sistem Pengurusan Aset DOA | </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
    <?php $var_value = $_GET['varname'];?>
              </div>
    <?php 
    
    $connection = mysqli_connect("localhost", "sabah_wuser", "70be8036125732e724d96024de2339d15a3194f3d2f6c462","inventory");
    $query_drop = "SELECT * FROM staff where staff.ic = '$var_value' ";
    $result_drop = $connection->query($query_drop);
    
?>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><span>Sistem Pengurusan Aset DOA</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>John Doe</h2>
              </div>
              <div class="clearfix"></div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li id="home"><a href="index.html"><i class="fa fa-home"></i> Laman Utama </a></li>
                  <li><a><i class="fa fa-users"></i> Pengguna <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="user_register.html">Daftar Pengguna Baru</a></li>
                      <li><a href="user_view.html">Carian Pengguna</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-desktop"></i> Aset <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="asset_register.html">Daftar Aset</a></li>
                      <li><a href="asset_view.html">Carian Aset</a></li>
                    </ul>
                  </li>
              </div>
            </div>
            <!-- /sidebar menu -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <div class="nav toggle">
              <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>
            <nav class="nav navbar-nav">
              <ul class=" navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                  <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                    John Doe
                  </a>
                  <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="user_changepassword.html"> Tukar Kata laluan</a>
                    <a class="dropdown-item" href="login.html"><i class="fa fa-sign-out pull-right"></i> Log Keluar</a>
                  </div>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Aset</h3>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                  <div class="x_title">

                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <h6>Maklumat Pengguna</h6>
                    <br>
                    <label class="col-form-label col-md-1 col-sm-1 label-align">Nama</label>
                    <div class="col-md-2 col-sm-1 ">
                                    <input id="assetid" name="assetid" type="text" class="form-control"  
                                      readonly="readonly" value="<?php 

                            foreach($result_drop as $row){
                                echo $row["name"];
                            }
                            ?>" >
                    </div>

                    <label class="col-form-label col-md-1 col-sm-1 label-align">Jawatan</label>
                    <div class="col-md-2 col-sm-1 ">
                                    <input id="assetid" name="assetid" type="text" class="form-control"  
                                      readonly="readonly" value="<?php 
                            foreach($result_drop as $row){
                                echo $row["jawatan"];
                            }
                            ?>" >
                    </div>

                    <label class="col-form-label col-md-2 col-sm-1 label-align">Bahagian/Seksyen/Unit</label>
                    <div class="col-md-2 col-sm-1 ">
                                    <input id="assetid" name="assetid" type="text" class="form-control"  
                                      readonly="readonly" value="<?php 
                            foreach($result_drop as $row){
                                echo $row["unit"];
                            }
                            ?>" >
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!--senarai computer pengguna-->
            <div class="row">
              <div class="col-md-6">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Senarai Komputer</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" style="display: block; width:100%">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Aset ID</th>
                          <th>Model</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                      $query = "SELECT * FROM komputer WHERE komputer.ic = '$var_value'";
                      $result = mysqli_query($connection, $query);

                      if ($result === FALSE) {
                        die(mysqli_error($connection));
                      }

                      $i = 0;
                      while($row = mysqli_fetch_assoc($result)) {
                          $i              = $i+1;
                          $asset_id             = $row['asset_id'];
                          $model           = $row['model'];
                          $status        = $row['status'];

                          echo "<tr>";
                          echo "<th scope='row'>$i</th>";
                          echo "<td>$asset_id</td>";
                          echo "<td>$model</td>";
                          echo "<td>$status</td>";
                          ?>
                          <?php
                          }
                          ?>

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
                <!--/senarai komputer pengguna-->

                <!--senarai monitor pengguna-->
              
                <div class="col-md-6">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>Senarai Monitor</h2>
                      <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                      </ul>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content" style="display: block; width:100%">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Aset ID</th>
                            <th>Model</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                      $query = "SELECT * FROM monitor WHERE monitor.ic = '$var_value'";
                      $result = mysqli_query($connection, $query);

                      if ($result === FALSE) {
                        die(mysqli_error($connection));
                      }

                      $i = 0;
                      while($row = mysqli_fetch_assoc($result)) {
                          $i              = $i+1;
                          $asset_id             = $row['asset_id'];
                          $model           = $row['model'];
                          $status        = $row['status'];

                          echo "<tr>";
                          echo "<th scope='row'>$i</th>";
                          echo "<td>$asset_id</td>";
                          echo "<td>$model</td>";
                          echo "<td>$status</td>";
                          ?>
                          <?php
                          }
                          ?>

                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              
              <!--/senarai monitor pengguna-->

              <!--senarai Printer pengguna-->
            <div class="row">
              <div class="col-md-6">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Senarai Printer</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" style="display: block; width:100%">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Aset ID</th>
                          <th>Model</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                      $query = "SELECT * FROM printer WHERE printer.ic = '$var_value'";
                      $result = mysqli_query($connection, $query);

                      if ($result === FALSE) {
                        die(mysqli_error($connection));
                      }

                      $i = 0;
                      while($row = mysqli_fetch_assoc($result)) {
                          $i              = $i+1;
                          $asset_id             = $row['asset_id'];
                          $model           = $row['model'];
                          $status        = $row['status'];

                          echo "<tr>";
                          echo "<th scope='row'>$i</th>";
                          echo "<td>$asset_id</td>";
                          echo "<td>$model</td>";
                          echo "<td>$status</td>";
                          ?>
                          <?php
                          }
                          ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
                <!--/senarai Printer pengguna-->

                <!--senarai Scanner pengguna-->
              
                <div class="col-md-6">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>Senarai Scanner</h2>
                      <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                      </ul>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content" style="display: block; width:100%">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Aset ID</th>
                            <th>Model</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <?php
                      $query = "SELECT * FROM scanner WHERE scanner.ic = '$var_value'";
                      $result = mysqli_query($connection, $query);

                      if ($result === FALSE) {
                        die(mysqli_error($connection));
                      }

                      $i = 0;
                      while($row = mysqli_fetch_assoc($result)) {
                          $i              = $i+1;
                          $asset_id             = $row['asset_id'];
                          $model           = $row['model'];
                          $status        = $row['status'];

                          echo "<tr>";
                          echo "<th scope='row'>$i</th>";
                          echo "<td>$asset_id</td>";
                          echo "<td>$model</td>";
                          echo "<td>$status</td>";
                          ?>
                          <?php
                          }
                          ?>
                        <tbody>

                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              
              <!--/senarai scanner pengguna-->

              <!--senarai UPS pengguna-->
            <div class="row">
              <div class="col-md-6">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Senarai UPS</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" style="display: block; width:100%">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Aset ID</th>
                          <th>Model</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <?php
                      $query = "SELECT * FROM ups WHERE ups.ic = '$var_value'";
                      $result = mysqli_query($connection, $query);

                      if ($result === FALSE) {
                        die(mysqli_error($connection));
                      }

                      $i = 0;
                      while($row = mysqli_fetch_assoc($result)) {
                          $i              = $i+1;
                          $asset_id             = $row['asset_id'];
                          $model           = $row['model'];
                          $status        = $row['status'];

                          echo "<tr>";
                          echo "<th scope='row'>$i</th>";
                          echo "<td>$asset_id</td>";
                          echo "<td>$model</td>";
                          echo "<td>$status</td>";
                          ?>
                          <?php
                          }
                          ?>
                      <tbody>

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
                <!--/senarai UPS pengguna-->

                <!--senarai AVR pengguna-->
              
                <div class="col-md-6">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>Senarai AVR</h2>
                      <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                      </ul>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content" style="display: block; width:100%">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Aset ID</th>
                            <th>Model</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                      $query = "SELECT * FROM avr WHERE avr.ic = '$var_value'";
                      $result = mysqli_query($connection, $query);

                      if ($result === FALSE) {
                        die(mysqli_error($connection));
                      }

                      $i = 0;
                      while($row = mysqli_fetch_assoc($result)) {
                          $i              = $i+1;
                          $asset_id             = $row['asset_id'];
                          $model           = $row['model'];
                          $status        = $row['status'];

                          echo "<tr>";
                          echo "<th scope='row'>$i</th>";
                          echo "<td>$asset_id</td>";
                          echo "<td>$model</td>";
                          echo "<td>$status</td>";
                          ?>
                          <?php
                          }
                          ?>

                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              
              <!--/senarai AVR pengguna-->

              <!--senarai LCD pengguna-->
            <div class="row">
              <div class="col-md-6">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Senarai LCD </h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" style="display: block; width:100%">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Aset ID</th>
                          <th>Model</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                      $query = "SELECT * FROM lcd WHERE lcd.ic = '$var_value'";
                      $result = mysqli_query($connection, $query);

                      if ($result === FALSE) {
                        die(mysqli_error($connection));
                      }

                      $i = 0;
                      while($row = mysqli_fetch_assoc($result)) {
                          $i              = $i+1;
                          $asset_id             = $row['asset_id'];
                          $model           = $row['model'];
                          $status        = $row['status'];

                          echo "<tr>";
                          echo "<th scope='row'>$i</th>";
                          echo "<td>$asset_id</td>";
                          echo "<td>$model</td>";
                          echo "<td>$status</td>";
                          ?>
                          <?php
                          }
                          ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
                <!--/senarai LCD pengguna-->


            </div>
          </div>
          <!-- /page content -->

          <!-- footer content -->
          <footer>
            <div class="pull-right">
              <span>Hakcipta Terpelihara © Jabatan Pertanian Sabah 2007 – 2022</span>
            </div>
            <div class="clearfix"></div>
          </footer>
          <!-- /footer content -->
        </div>
      </div>

      <!-- jQuery -->
      <script src="../vendors/jquery/dist/jquery.min.js"></script>
      <!-- Bootstrap -->
      <script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
      <!-- FastClick -->
      <script src="../vendors/fastclick/lib/fastclick.js"></script>
      <!-- NProgress -->
      <script src="../vendors/nprogress/nprogress.js"></script>

      <!-- Custom Theme Scripts -->
      <script src="../build/js/custom.min.js"></script>
  </body>

</html>
