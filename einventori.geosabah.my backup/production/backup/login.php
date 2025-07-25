
<?
   // error_reporting(E_ALL);
   // ini_set("display_errors", 1);
?>
<?php include "includes/db.php"; ?>
<?php include "includes/functions.php"; ?>
<?php error_reporting(E_ALL ^ E_NOTICE); ?>
<?php
$error = false;
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $error = ['ic' => '', 'password' => '', ];
    if (strlen($username) < 4) {
        $error['username'] = 'Username needs to be longer';
    }
    if ($username == '') {
        $error['username'] = 'Username cannot be empty';
    }
    if (!username_exists($username)) {
        $error['username'] = 'No such user.';
    }
    if ($password == '') {
        $error['password'] = 'Password cannot be empty';
    }
    foreach ($error as $key => $value) {
        if (empty($value)) {
            unset($error[$key]);
        }
    } // foreach
    if (empty($error)) {
        if (login_user($username, $password) == false) {
            $error = true;
        }
    } else {
        //echo "Error logging in User";
        
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

    <title>e-Inventori Jabatan Pertanian Sabah</title>
	<link rel="icon" type="image/x-icon" href="/images/favicon.ico">

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="../vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
  </head>



  <body class="login">
    <div>
      <a class="hiddenanchor" id="signin"></a>

	
      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">

	<img src="images/DOA_logo.png" alt="logo" />
	<span><h3> Sistem Pengurusan Inventori ICT (e-PII) <p> Jabatan Pertanian Sabah </p> </h3></span>
                  
          <form role="form" action="login.php" method="post" id="login-form" autocomplete="off">
              <h1>Log Masuk</h1>
              <div class="form-group">
            <input type="text" name="username" id="username" class="form-control" placeholder="No. Kad Pengenalan"
            autocomplete="on" value="<?php echo isset($username) ? $username : '' ?>">

            <div class="form-group">
            <input type="password" name="password" id="key" class="form-control" placeholder="Kata Laluan">
            <p class="error-message"><?php echo isset($error['password']) ? $error['password'] : '' ?></p>
            </div>
            <div class="form-group">
            <button type="submit" name="login" id="btn-login" class="btn btn-primary submit" value='Log Masuk'>Log Masuk</button>
                        <?php if ($error) {
    echo '<br /><a class="login-error-message"</a>';
    echo '<br /><p class="login-error-message">Wrong password or username. Please try again.</p>';
} ?></>
                    </form>
        
              </div>

              <div class="clearfix"></div>
                <div>
                  <br/>
                  <p>Hakcipta Terpelihara © <br>Jabatan Pertanian Sabah 2022</p>
                </div>
              </div>
            </form>
          </section>
        </div>
  </body>
</html>
