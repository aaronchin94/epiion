        <?php
        if(isset($_POST["submit"])){

            $username   =   $_POST['username'];
            $password   =   $_POST['password'];
            $role       =   $_POST['role'];

            require_once 'db.php';
        } 
        else {
            header("location: ../login.php");
            exit();
        }
    
        ?>
       