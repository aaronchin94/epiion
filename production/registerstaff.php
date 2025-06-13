<?php error_reporting (E_ALL ^ E_NOTICE); ?>
        <?php
        if(isset($_POST["submit"])){

        // servername => localhost
        // username => root
        // password => empty
        // database name => staff
        $conn = mysqli_connect("localhost", "sabah_wuser", "70be8036125732e724d96024de2339d15a3194f3d2f6c462", "inventory");
         
        // Check connection
        if($conn === false){
            die("ERROR: Could not connect. "
                . mysqli_connect_error());
        }
         
        // Taking all 5 values from the form data(input)
        $name       =   $_POST['name'];
        $ic         =   $_POST['ic'];
        $jawatan    =   $_POST['jawatan'];
        $gred       =   $_POST['gred'];
        $lokasi     =   $_POST['lokasi'];
        $unit       =   $_POST['unit'];
        $email      =   $_POST['email'];
        $tel        =   $_POST['tel'];

        
        // Performing insert query execution
        // here our table name is college
        $sql = "INSERT INTO staff  VALUES ('0','$name','$ic','$jawatan','$gred','$lokasi','$unit','$email','$tel')";
         
        if(mysqli_query($conn, $sql)){
            echo "<script>alert('Pendaftaran Berjaya');
            window.location.href='../staff_register.php'</script>";

            //echo "<h3>data stored in a database successfully."
              //  . " Please browse your localhost php my admin"
                //. " to view the updated data</h3>";
                
 
        } 
        else{
            echo "ERROR: Hush! Sorry $sql. "
                . mysqli_error($conn);
        }
    }
    else{
        header("Location: ../index.php");
        // Close connection
        mysqli_close($conn);
    }
        ?>