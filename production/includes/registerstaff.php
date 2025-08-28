<?php 
include 'db.php';
include_once 'secure_function.php';
?>

<?php error_reporting (E_ALL ^ E_NOTICE); ?>
    <?php
    if(isset($_POST["submit"])){

         
        // Taking all 5 values from the form data(input)
        $name       =   strtoupper($_POST['name']);
        $ic         =   $_POST['ic'];
        $jawatan    =   $_POST['jawatan'];
	    $gred       =   $_POST['gred'];
        $lokasi     =   $_POST['lokasi'];
        $unit       =   $_POST['unit'];
        $email      =   $_POST['email'];
        $tel        =   $_POST['tel'];

        

        // $sql = "INSERT INTO staff (name, ic, jawatan, gred, lokasi, unit, email, tel) VALUES ('$name','$ic','$jawatan','$gred','$lokasi','$unit','$email','$tel')";
        $stmt = $connection->prepare("INSERT INTO staff (name, ic, jawatan, gred, lokasi, unit, email, tel)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        
        $poiu = "SELECT COUNT(*) as count FROM staff WHERE `ic` = '$ic'";
        $runsql = mysqli_query($connection, $poiu);
        $row = mysqli_fetch_assoc($runsql);
        $rowcount = $row['count'];
        // $rowcount = mysqli_num_rows($runsql);
        
        if($rowcount >= 1){
            echo "<script>alert('IC telah didaftarkan. Pendaftaran IC yang sama tidak dibenarkan.');
            window.location.href='../staff_register.php'</script>";
        } else {
            $stmt->bind_param("ssssssss", $name, $ic, $jawatan, $gred, $lokasi, $unit, $email, $tel);
            if($stmt->execute()){
                echo "<script>alert('Pendaftaran Berjaya');
                window.location.href='../staff_register.php'</script>";
            } 
            else{
                echo "ERROR: Hush! Sorry $sql. "
                    . mysqli_error($connection);
            }
        }
        
    }
    else{
        header("Location: ../index.php");
        // Close connection
        mysqli_close($connection);
    }
    ?>