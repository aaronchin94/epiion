<?php
include_once 'includes/db.php';
include_once 'includes/session.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>E-Inventori Jabatan Pertanian Sabah | </title>
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
        function checkLogout() {
            return confirm('Log keluar ?');
        }
    </script>
</head>

<body class="nav-md footer_fixed">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="index.php" class="site_title"><span>DOA Sabah e-PII </span></a>
                    </div>

                    <div class="clearfix"></div>

                    <!-- menu profile quick info -->
                    <div class="profile clearfix">
                        <div class="profile_info">
                            <span>Selamat datang,</span>
                            <h2><?php echo $row['name'] ?></h2>

                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <!-- /menu profile quick info -->

                    <br />

                    <!-- sidebar menu -->

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
                                    <?php echo '<span class="badge badge-info">' . $row['role'] . '</span> ' . $row['name'] . ' '; ?>
                                </a>
                                <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="user_changepassword.php"> Tukar Kata laluan</a>
                                    <a class="dropdown-item" onclick="return checkLogout()" href="includes/logout.php"><i class="fa fa-sign-out pull-right"></i> Log Keluar</a>
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
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <div class="title_left">
                                        <h3>Tetapan Kata laluan</h3>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <form role="form" action="includes/first_password.php" method="post" class="pure-form form-horizontal form-label-left">
                                        <input type="text" hidden name="id" value="<?= $row["id"] ?>">

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="ic">No Kad Pengenalan <span class="required">*</span></label>
                                            <div class="col-md-4 col-sm-6">
                                                <input type="text" name="ic" id="ic" required="required" class="form-control" disabled="disabled" value="<?php echo $row['ic'] ?>" placeholder="No Kad Pengenalan (tanpa -)" maxlength="12">
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align">Kata laluan baru <span class="required">*</span></label>
                                            <div class="col-md-4 col-sm-6">
                                                <input type="password" name="np" id="np" required class="form-control">
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align">Ulang Kata laluan baru <span class="required">*</span></label>
                                            <div class="col-md-4 col-sm-6">
                                                <div>
                                                    <input type="password" name="c_np" id="c_np" required class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align">
                                            </label>
                                            <div class="col-md-4 col-sm-3 ">
                                                <b>Syarat bagi pemilihan Kata Laluan adalah:-</b>
                                                <br>Panjang kata laluan sekurang-kurangnya lapan (8) aksara;
                                            </div>
                                        </div>


                                        <div class="item form-group">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align"></label>
                                            <div class="col-md-4 col-sm-3">
                                                <button type="submit" onclick="return validatePassword()" class="btn btn-danger">Tetap Semula</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- /page content -->

            <?php
            include_once 'footer.php';
            ?>

            <script>
                var password = document.getElementById("np");
                var confirm_password = document.getElementById("c_np");
                var op = document.getElementById("op");
                var ic = document.getElementById("ic");

                // Function to validate password and confirm password fields
                function validatePassword() {
                    var np = password.value;
                    var c_np = confirm_password.value;

                    if (np !== c_np) {
                        confirm_password.setCustomValidity("Kata laluan baharu tidak sepadan");
                    } else if (np.length < 8) {
                        confirm_password.setCustomValidity("Kata laluan baharu mesti mengandungi sekurang-kurangnya 8 aksara dan menggabungkan huruf besar, huruf kecil, nombor dan simbol.");
                    } else if (np.includes(ic.value)) {
                        confirm_password.setCustomValidity("Kata laluan baharu tidak boleh mengandungi nombor kad pengenalan.");
                    } else {
                        confirm_password.setCustomValidity('');
                    }
                }

                // Call the validatePassword function when the password and confirm password fields are changed
                password.onchange = validatePassword;
                confirm_password.onkeyup = validatePassword;
            </script>


            <!-- jQuery -->
            <script src="../vendors/jquery/dist/jquery.min.js"></script>
            <!-- Bootstrap -->
            <script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
            <!-- FastClick -->
            <script src="../vendors/fastclick/lib/fastclick.js"></script>
            <!-- NProgress -->
            <script src="../vendors/nprogress/nprogress.js"></script>
            <!-- bootstrap-progressbar -->
            <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
            <!-- iCheck -->
            <script src="../vendors/iCheck/icheck.min.js"></script>
            <!-- bootstrap-daterangepicker -->
            <script src="../vendors/moment/min/moment.min.js"></script>
            <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
            <!-- bootstrap-wysiwyg -->
            <script src="../vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
            <script src="../vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
            <script src="../vendors/google-code-prettify/src/prettify.js"></script>
            <!-- jQuery Tags Input -->
            <script src="../vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
            <!-- Switchery -->
            <script src="../vendors/switchery/dist/switchery.min.js"></script>
            <!-- Select2 -->
            <script src="../vendors/select2/dist/js/select2.full.min.js"></script>
            <!-- Parsley -->
            <script src="../vendors/parsleyjs/dist/parsley.min.js"></script>
            <!-- Autosize -->
            <script src="../vendors/autosize/dist/autosize.min.js"></script>
            <!-- jQuery autocomplete -->
            <script src="../vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
            <!-- starrr -->
            <script src="../vendors/starrr/dist/starrr.js"></script>
            <!-- Custom Theme Scripts -->
            <script src="../build/js/custom.min.js"></script>

</body>

</html>