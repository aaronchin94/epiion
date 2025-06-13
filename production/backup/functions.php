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

    $query = "SELECT ic FROM users WHERE ic = '$username'";
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


     global $connection;

    $username = trim($username);
    $password = trim($password);

    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);


    $query = "SELECT * FROM users WHERE ic = '{$username}' ";
    $select_user_query = mysqli_query($connection, $query);


    if (!$select_user_query) {

        die("QUERY FAILED" . mysqli_error($connection));

    }




    while ($row = mysqli_fetch_array($select_user_query)) {

        $db_user_id        = $row['id'];
        $db_username       = $row['username'];
        $db_user_password  = $row['password'];
        $db_user_role      = $row['role'];

        if($db_user_role == "Admin" || "User"){

           if (password_verify($password,$db_user_password)) {

            session_start();
            echo $_SESSION['username'] = $db_username;
            echo $_SESSION['role'] = $db_user_role;
            echo $_SESSION['id'] = $db_user_id;

             header("Location: index.php");
             exit();
die();

           } else {

             return false;
           }

       }else{
        header("Location: login.php");

       }



    }

    return true;

}








 ?>

