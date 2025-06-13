<?php 
include "db.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../../PHPMailer/src/Exception.php';
require '../../PHPMailer/src/PHPMailer.php';
require '../../PHPMailer/src/SMTP.php';
if(isset($_POST["resetpw"])){
// Retrieve user input
$id = $_POST['id'];
$ic = $_POST['ic'];
$email = $_POST['email'];

// Query the database for the user
$query = "SELECT * FROM staff WHERE email='$email' and id='$id' and ic='$ic'";
$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) == 1) {
    // Generate a temporary password
    $rawtemp_password = substr(md5(time()), 0, 8);
    $temp_password = password_hash( $rawtemp_password, PASSWORD_BCRYPT, array('cost' => 12));
    
    // Store the temporary password in the database
    $query = "UPDATE staff SET password='$temp_password' , firstlogin= '1' WHERE email='$email' and id='$id' and ic='$ic'";
    mysqli_query($connection, $query);
// Send an email to the user with the temporary password
    $mail = new PHPMailer(true); // true enables exceptions
    try {
        //Server settings
        //$mail->SMTPDebug = SMTP::DEBUG_OFF; // Disable debug output
        $mail->isSMTP(); // Send using SMTP
        $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = 'noreply.doasbh@gmail.com'; // SMTP username
        $mail->Password = 'muizodpcbslaeljn'; // SMTP password  kifapteixcluuzeh
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;//PHPMailer::ENCRYPTION_SMTPS; //PHPMailer::ENCRYPTION_STARTTSL; // Enable TLS encryption 'ssl';
        $mail->Port = 587; // TCP port to connect to . 25 for NO . & 587 -ssl;

        //Recipients
        $mail->setFrom('noreply.doasbh@gmail.com', 'e-PII Test email system');
        $mail->addAddress($email); // Add a recipient

        //Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = '[Auto message e-PII] Kata laluan telah ditukar ';
        $mail->Body = '
        Kata laluan telah ditukar bagi akaun anda 
        <p> No. Kad Pengenalan : '.$ic.' 
        <p>Kata laluan sementara anda : ' . $rawtemp_password . ' 
        <p>Sila log masuk dan tukar kata laluan anda dengan segera.
        <p>
        <p>Log masuk : https://einventori.geosabah.my/asset/production/login.php
        <p>
        **Masih dalam percubaan**
        <p>-System Admin e-PII';
        
    
        $mail->send();
        
        echo "<script>alert('Kata laluan sementara bagi $ic telah dihantar ke emel $email. ');
        window.location.href='../user_view.php'</script>";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}" ;
    }
} else {
    // Display an error message to the user
    echo 'The entered email or username does not exist.';
}
}
else{
    header("Location: ../index.php");
}