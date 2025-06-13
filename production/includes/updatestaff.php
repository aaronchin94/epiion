<?php include "db.php"; ?>

<?php error_reporting (E_ALL ^ E_NOTICE); ?>
        <?php
        if(isset($_POST["submit"])){
        
        // Taking all 5 values from the form data(input)
        $id 		= mysqli_real_escape_string($connection, $_POST['id']);
        $name       	=   mysqli_real_escape_string($connection, $_POST['name']);
        $ic       	=   mysqli_real_escape_string($connection, $_POST['ic']);
        $jawatan    	=   mysqli_real_escape_string($connection, $_POST['jawatan']);
        $gred       	=   mysqli_real_escape_string($connection, $_POST['gred']);
        $lokasi       	=   mysqli_real_escape_string($connection, $_POST['lokasi']);
        $unit       	=   mysqli_real_escape_string($connection, $_POST['unit']);
        $email       	=   mysqli_real_escape_string($connection, $_POST['email']);
        $tel       	=   mysqli_real_escape_string($connection, $_POST['tel']);
        // Performing insert query execution
        // here our table name is college
        $sql = "UPDATE staff  SET name='$name', ic='$ic', jawatan='$jawatan', gred='$gred', lokasi='$lokasi', unit='$unit', email='$email', tel='$tel' 
                WHERE id='$id' ";
         
        if(mysqli_query($connection, $sql)){

	//echo "ERROR: Hush! Sorry $sql. "
                //. mysqli_error($connection);



            echo "<script>alert('Kemaskini Berjaya');
            window.location.href='../staff_view.php'</script>";

                
 
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