<?php
include 'includes/db.php';
include 'includes/session.php';
include_once 'includes/firstlogincheck.php';
include_once 'includes/counter.php';
include_once 'includes/secure_function.php';

// Clear cache headers
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sistem Pengurusan Inventori ICT (e-PII) | Jabatan Pertanian Sabah</title>
    <link rel="icon" type="image/x-icon" href="images/DOA_logo.png">

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
    <script language="JavaScript" type="text/javascript">
function checkLogout(){
    return confirm('Log keluar ?');
}
</script>



<!-- asdasdasd  -->

  <!-- iCheck -->
  <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
  <!-- bootstrap-wysiwyg -->
  <link href="../vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
  <!-- Select2 -->
  <link href="../vendors/select2/dist/css/select2.min.css" rel="stylesheet">
  <!-- Switchery -->
  <link href="../vendors/switchery/dist/switchery.min.css" rel="stylesheet">
  <!-- starrr -->
  <link href="../vendors/starrr/dist/starrr.css" rel="stylesheet">
  <!-- bootstrap-daterangepicker -->
  <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">


  <!-- Datatables -->
  <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="../build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md footer_fixed">
    <div class="container body">    
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.php" class="site_title"><img src="images/DOA_logo.png" height="50" alt="Description of the image">
              <span style="font-size: 11.5px;"><b>e-PII Jabatan Pertanian Sabah</b></span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_info">
                <span>Selamat datang,</span>
                <h2><?php echo sanitizeText($row['name']) ?></h2>
                
              </div>
              <div class="clearfix"></div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu">
                  <li id="home"><a href="index.php"><i class="fa fa-home"></i> Laman Utama </a></li>
                  <?php
                  if($row['role'] == "Admin"){
                  echo "<li><a><i class='fa fa-user'></i> Pendaftar <span class='fa fa-chevron-down'></span></a>
                    <ul class='nav child_menu'>
                      <li><a href='user_register.php'>Daftar Pendaftar Baru</a></li>
                      <li><a href='user_view.php'>Carian Pendaftar</a></li>
                    </ul>
                  </li>";
                }
                  ?>
                  <li><a><i class="fa fa-desktop"></i> Aset <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="asset_register.php">Daftar Aset</a></li>
                      <li><a href="asset_view.php">Carian Aset</a></li>
                      
                    </ul>
                  </li>

                  <li><a><i class="fa fa-wrench"></i> Penyelenggaraan <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="asset_maintenance_view.php">Senarai Permohonan</a></li>
                      <?php if($row['role'] == "Admin"){?>
                        <li><a href="asset_maintenance_work.php">Senarai Kerja</a></li> 
                      <?php } ?>
                    </ul>
                  </li>

<?php
                  if($row['role'] == "Admin"){
                  echo "<li><a><i class='fa fa-users'></i> Kakitangan <span class='fa fa-chevron-down'></span></a>
                    <ul class='nav child_menu'>
                      <li><a href='staff_register.php'>Daftar Kakitangan</a></li>
                      <li><a href='staff_view.php'>Carian Kakitangan</a></li>
                    </ul>
                  </li>";
}?>
              </div>
            </div>
            <!-- /sidebar menu -->

<!-- visitor counter-->
            <div class="menu_section sidebar-footer "> 
              <H3>Pengunjung hari ini: <?php echo $today_visitors; ?> orang
              <br>Jumlah Pengunjung: <?php echo $total_visitors; ?> orang</p></h3>
            </div>
            <!-- visitor counter-->
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
                  <?php echo '<span class="badge badge-info">'. sanitizeText($row['role']) .'</span> '. sanitizeText($row['name']) .' ';?>  
                  </a>
                  <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item"  href="user_changepassword.php"> Tukar Kata laluan</a>
                    <a class="dropdown-item" onclick="return checkLogout()" href="includes/logout.php"><i class="fa fa-sign-out pull-right"></i> Log Keluar</a>
                  </div>
                </li>
              </ul>
            </nav>
          </div>
        </div>

      <!-- /top navigation -->

<script src="js/preload.js"></script>