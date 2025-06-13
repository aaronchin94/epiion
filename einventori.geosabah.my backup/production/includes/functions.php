<?php

function confirmQuery($result) {

    global $connection;

    if(!$result ) {

          die("QUERY FAILED ." . mysqli_error($connection));


      }


}

function escape($string) {

global $connection;

return mysqli_real_escape_string($connection, trim($string));


}



function username_exists($username){


    global $connection;

    $query = "SELECT ic FROM staff WHERE access = 1 AND ic = '$username'";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);

    if(mysqli_num_rows($result) > 0) {


        return true;

    } else {

        return false;

    }





}


function register_user($name, $username, $ic, $password, $jawatan, $lokasi, $unit, $email, $tel, $role){

    global $connection;

        $name       = mysqli_real_escape_string($connection, $name);
        $username   = mysqli_real_escape_string($connection, $username);
        $ic         = mysqli_real_escape_string($connection, $ic);
        $password        = mysqli_real_escape_string($connection, $password);

        $jawatan    = mysqli_real_escape_string($connection, $jawatan);
        $lokasi     = mysqli_real_escape_string($connection, $lokasi);
        $unit       = mysqli_real_escape_string($connection, $unit);
        $email       = mysqli_real_escape_string($connection, $emal);
        $tel        = mysqli_real_escape_string($connection, $tel);
        $role       = mysqli_real_escape_string($connection, $role);

        $password = password_hash( $password, PASSWORD_BCRYPT, array('cost' => 12));

        $query = "INSERT INTO users (name, username, ic, password, jawatan, lokasi, unit, email, tel, role) ";
        $query = "VALUES('{$name}', '{$username}', '{$ic}', '{$password}', '{$jawatan}', '{$lokasi}', '{$unit}', '{$email}', '{$tel}', '{$role}')";
        
        $register_user_query = mysqli_query($connection, $query);
        print_r($_POST);
        confirmQuery($register_user_query);
        echo("Error description: " . $mysqli -> error);
}


function login_user($username, $password){

// Set the timezone to your local timezone
date_default_timezone_set('Asia/Kuching');


    global $connection;

    $username = trim($username);
    $password = trim($password);

    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);

    $query = "SELECT * FROM staff WHERE access = 1 AND ic = '$username' ";
    $select_user_query = mysqli_query($connection, $query);

    if (!$select_user_query) {
        die("QUERY FAILED" . mysqli_error($connection));
    }

    if (mysqli_num_rows($select_user_query) == 0) {
        return false; // No user found
    }

    $row = mysqli_fetch_array($select_user_query);
    $db_user_id        = $row['id'];
    $db_username       = $row['ic'];
    $db_user_password  = $row['password'];
    $db_user_role      = $row['role'];
    $db_user_access    = $row['access'];

    if (($db_user_role == "Admin" || $db_user_role == "Pendaftar") && $db_user_access == "1") {
        if (password_verify($password,$db_user_password)) {
            session_start();
            $_SESSION['username'] = $db_username;
            $_SESSION['role'] = $db_user_role;
            $_SESSION['id'] = $db_user_id;
	   

            $login_time = date('Y-m-d H:i:s');
	    session_start();
	    $_SESSION['login_time'] = $login_time;

	
            $insert_query = "INSERT INTO login_session (staff_id, staff_ic, login_time, last_seen_time) VALUES ($db_user_id, '$db_username', '$login_time', '$login_time')";
            $result = mysqli_query($connection, $insert_query);
            if (!$result) {
                die("QUERY FAILED" . mysqli_error($connection));
            }

            header("Location: index.php");
            exit();
        } else {
            return false; // Invalid password
        }
    } else {
        header("Location: login.php"); // Invalid user role or access
        exit();
    }

}
?>


<?php

function add_password_validation_script() {
    ?>
    <script>
        function validatePassword() {
            var op = document.getElementById("op").value;
            var np = document.getElementById("np").value;
            var c_np = document.getElementById("c_np").value;

            // Check if new password and confirm new password fields match
            if (np != c_np) {
                alert("New password and confirm new password fields do not match.");
                return false;
            }

            // Check if new password meets the specified requirements
            var passwordPattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]).{8,}$/;
            if (!passwordPattern.test(np)) {
                alert("New password must be at least 8 characters long and contain a combination of uppercase letters, lowercase letters, numbers, and symbols.");
                return false;
            }

            return true;
        }
    </script>
    <?php
}

?>