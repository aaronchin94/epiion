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
        $sql = "UPDATE staff SET name = ?, ic = ?, jawatan = ?, gred = ?, lokasi = ?, unit = ?, email = ?, tel = ? WHERE id = ?";
         //      "UPDATE staff SET name = ?, ic = ?, jawatan = ?, gred = ?, lokasi = ?, unit = ?, email = ?, tel = ?, id = ? WHERE name = ? AND ic = ? AND jawatan = ? AND gred = ? AND lokasi = ? AND unit = ? AND email = ? AND tel = ? AND id = ?"
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("ssssssssi", $name, $ic, $jawatan, $gred, $lokasi, $unit, $email, $tel, $id);

        if($stmt->execute()){


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