<?php error_reporting (E_ALL ^ E_NOTICE); ?>

<?php use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../../PHPMailer/src/Exception.php';
require '../../PHPMailer/src/PHPMailer.php';
require '../../PHPMailer/src/SMTP.php';
?>

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
	$id         =   $_POST['id'];
        $jawatan    =   $_POST['jawatan'];
        $lokasi     =   $_POST['lokasi'];
        $unit       =   $_POST['unit'];
        $email      =   $_POST['email'];
        $tel        =   $_POST['tel'];
        $role       =   $_POST['role'];

// Generate unique token and store it in the database
	$token = bin2hex(random_bytes(32));
	$expires = time() + 86400; // Token expires in 1 day
	$query = "INSERT INTO password_reset_tokens (staff_id, email, token, expires) VALUES ('$id','$email', '$token', $expires)";
	mysqli_query($conn , $query);

    $reset_url = "https://einventori.geosabah.my/production/password_reset.php?token=$token";

         
        // Generate a temporary password
        //$temp_password = substr(md5(time()), 0, 8);
        //$password = password_hash( $temp_password, PASSWORD_BCRYPT, array('cost' => 12));
        // Performing insert query execution    
        // here our table name is college
        $sql = "UPDATE staff SET access = 1, role = '$role' WHERE id = '$id'";
      

         
        if(mysqli_query($conn, $sql)){

            //Send an email to the user with the temporary password
    $mail = new PHPMailer(true); // true enables exceptions
        //Server settings
        //$mail->SMTPDebug = SMTP::DEBUG_OFF; // Disable debug output
        $mail->isSMTP(); // Send using SMTP
        $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = 'noreply.doasbh@gmail.com'; // SMTP username
        $mail->Password = 'ibqorvjgyhqgnkng'; // SMTP password  kifapteixcluuzeh
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;//PHPMailer::ENCRYPTION_SMTPS; //PHPMailer::ENCRYPTION_STARTTSL; // Enable TLS encryption 'ssl';
        $mail->Port = 587; // TCP port to connect to . 25 for NO . & 587 -ssl;

        //Recipients
        $mail->setFrom('noreply.doasbh@gmail.com', 'Sistem Pengurusan Inventori ICT (e-PII)');
        $mail->addAddress($email); // Add a recipient

        //Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = '[Auto message e-PII] Makluman Pendaftaran '.$name.' sebagai '.$role.' ';
        $mail->Body = '
        Adalah dimaklumkan bahawa penama dibawah :  
        <p>Nama Penuh : '.$name.'
        <br> No. Kad Pengenalan : '.$ic.' </br>
        <br> Emel : '.$email.' </br>
        <br> Jawatan : '.$jawatan.' </br>
        <br> Daerah : '.$lokasi.' </br>
        <br> Bahagian/Seksyen/Unit : '.$unit.' </br>
        <p>
	<p> Sila log masuk kali pertaman menggunakan pautan berikut : 
	<p> 
        <p>'.$reset_url.'
	<p> 
	<p> <i> Pautan sah untuk masa 1 hari sahaja </i>
        <p>Sistem Pengurusan Inventori ICT (e-PII)';
        
    
        $mail->send();

 		//echo "ERROR: Hush! Sorry $sql. $id"
                //. mysqli_error($conn);
            echo "<script>alert('Pendaftaran Berjaya bagi $name ($ic) sebagai $role. Sila semak emel untuk dapatkan kata laluan sementara.');
            window.location.href='../user_register.php'</script>";              
 
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