<?php
// Connect to the database
include 'includes/db.php';
include_once 'includes/secure_function.php';

// Retrieve token from URL and validate it

$token = mysqli_real_escape_string($connection, $_GET['token']);
$query = "SELECT * FROM password_reset_tokens WHERE token='$token'";
$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) == 0) {
    // Token not found or expired
    echo "<script>alert('Invalid or expired token');
	        window.location.href='includes/logout.php'</script>";
} else {
    $row = mysqli_fetch_assoc($result);
    $email = $row['email'];
    $expires = $row['expires'];
    if ($expires < time()) {
        // Token has expired
        echo "<script>alert('Token has expired');
	        window.location.href='includes/logout.php'</script>";
    }
}
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
    </script>
</head>

<head>
    <!-- Confirm Buttion-->
    <script language="JavaScript" type="text/javascript">
        function checkChangePassword() {
            return confirm('Kata laluan akan ditetapkan semula. Adakah ingin teruskan ?');
        }
    </script>
</head>

<body class="login">
    <div>
        <div class="login_wrapper">
            <section class="login_content">
                <form role="form" action="includes/password_reset_update.php" method="POST">
                    <input type="text" hidden name="id" value="<?= sanitizeText($row["staff_id"]) ?>">
                    <input type="text" hidden name="email" value="<?= sanitizeText($row["email"]) ?>">
                    <input type="text" hidden name="token" value="<?= sanitizeText($row["token"]) ?>">
                    <h1>Tetapkan kata laluan</h1>
                    <div>
                        <input type="password" name="np" id="np" required class="form-control" placeholder="Masukkan kata laluan anda">
                    </div>
                    <div>
                        <input type="password" name="c_np" id="c_np" required class="form-control" placeholder="Sila ulang kata laluan anda">
                    </div>
                    <div>
                        <b>Syarat bagi pemilihan Kata Laluan Pintar ialah:-</b>
                        <br>Panjang kata laluan sekurang-kurangnya lapan (8) aksara;
                        <!-- <br>Sekurang-kurangnya satu (1) huruf besar;
				            <br>Sekurang-kurangnya satu (1) huruf kecil;
				            <br>Sekurang-kurangnya satu (1) nombor; dan
				            <br>Sekurang-kurangnya satu (1) simbol (! @#$^*&); -->
                    </div>

                    <p>
                    <div>
                        <button type="submit" onclick="return checkChangePassword()" class="btn btn-warning">Tetapkan kata laluan</button>
                    </div>

                    <div class="clearfix"></div>
                    <p>
                    <p>Hakcipta Terpelihara © <br>Jabatan Pertanian Sabah 2007 – 2023</p>
        </div>
    </div>
    </form>
    </section>

    </div>
    </div>
</body>

<script>
    var password = document.getElementById("np");
    var confirm_password = document.getElementById("c_np");


    // Function to validate password and confirm password fields
    function validatePassword() {
        var np = password.value;
        var c_np = confirm_password.value;

        if (np !== c_np) {
            confirm_password.setCustomValidity("Kata laluan baharu tidak sepadan");
        } else if (np.length < 8) {
            confirm_password.setCustomValidity("Kata laluan baharu mesti mengandungi sekurang-kurangnya 8 aksara dan menggabungkan huruf besar, huruf kecil, nombor dan simbol.");
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
<!-- Select2 -->h
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