<?php

require_once 'includes/db.php';
include 'includes/initialization.php';

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Sistem Pengurusan Inventori ICT (e-PII) | Jabatan Pertanian Sabah</title>
  <link rel="icon" type="image/x-icon" href="images/DOA_logo.png">

  <!-- Bootstrap -->
  <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="../build/css/custom.min.css" rel="stylesheet">
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
</head>

<body class="nav-md">
  <div>
    <!-- page content -->
    <div class="right_col" role="main">
      <div class="">
        <div class="page-title">
          <div class="">
            <a href="index.php" class="site_title"><img src="images/DOA_logo.png" height="50"
                alt="Description of the image">
              <span style="font-size: 11.5px;"><b>e-PII Jabatan Pertanian Sabah</b></span></a>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12 col-sm-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Asset Search</h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <div class="container">
                  <div class="row justify-content-center">
                    <div class="col-md-6">
                      <div class="card">
                        <div class="card-body">
                          <h5 class="card-title">Please Provide QR ID of Assets</h5>
                          <form action="asset_QR_search.php" method="POST">
                            <div class="form-group">
                              <input type="text" class="form-control" id="QRId" name="QRId" placeholder="Enter QR ID">
                            </div>
                            <button type="submit" class="btn btn-primary">Search</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
    <!-- /page content -->

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
