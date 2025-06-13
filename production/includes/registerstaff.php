<?php 
include 'db.php';
?>

<?php error_reporting (E_ALL ^ E_NOTICE); ?>
        <?php
        if(isset($_POST["submit"])){

        // servername => localhost
        // username => root
        // password => empty
        // database name => staff
        
         
        // Taking all 5 values from the form data(input)
        $name       =   strtoupper($_POST['name']);
        $ic         =   $_POST['ic'];
        $jawatan    =   $_POST['jawatan'];
	$gred       =   $_POST['gred'];
        $lokasi     =   $_POST['lokasi'];
        $unit       =   $_POST['unit'];
        $email      =   $_POST['email'];
        $tel        =   $_POST['tel'];

        
        // Performing insert query execution
        // here our table name is college
        $sql = "INSERT INTO staff (name, ic, jawatan, gred, lokasi, unit, email, tel) VALUES ('$name','$ic','$jawatan','$gred','$lokasi','$unit','$email','$tel')";

;

         
        if(mysqli_query($connection, $sql)){
            echo "<script>alert('Pendaftaran Berjaya');
            window.location.href='../staff_register.php'</script>";

            //echo "<h3>data stored in a database successfully."
              //  . " Please browse your localhost php my admin"
                //. " to view the updated data</h3>";
                
 
        } 
        else{
            echo "ERROR: Hush! Sorry $sql. "
                . mysqli_error($connection);
        }
    }
    else{
        header("Location: ../index.php");
        // Close connection
        mysqli_close($connection);
    }
        ?>