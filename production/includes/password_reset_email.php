<?php
include_once 'db.php';
include_once 'secure_function.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../../PHPMailer/src/Exception.php';
require '../../PHPMailer/src/PHPMailer.php';
require '../../PHPMailer/src/SMTP.php';

// Retrieve user input
$id = $_POST['id'];
$ic = $_POST['ic'];

// Validate inpu
$id = mysqli_real_escape_string($connection, $_POST['id']);
$email = mysqli_real_escape_string($connection, $_POST['email']);
$query = "SELECT * FROM staff WHERE email='$email' AND id='$id'";
$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) == 0) {
    // Email address not found
    echo "Email address or Staff_ID not found";
} else {
    // Generate unique token and store it in the database
    $token = bin2hex(random_bytes(32));
    $expires = time() + 10800; // Token expires in 3 hours
    $query = "INSERT INTO password_reset_tokens (staff_id, email, token, expires) VALUES (?, ?, ?, ?)";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("isss", $id, $email, $token, $expires);
    $stmt->execute();
    

    $reset_url = "https://einventori.geosabah.my/production/password_reset.php?token=$token";

    //Send an email to the user with the temporary password
    $mail = new PHPMailer(true); // true enables exceptions
    try {
        //Server settings
        //$mail->SMTPDebug = SMTP::DEBUG_OFF; // Disable debug output
        $mail->isSMTP(); // Send using SMTP
        $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = 'noreply.doasbh@gmail.com'; // SMTP username old noreply.doasbh@gmail.com
        $mail->Password = 'muizodpcbslaeljn'; // old> muizodpcbslaeljn
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; //PHPMailer::ENCRYPTION_SMTPS; //PHPMailer::ENCRYPTION_STARTTSL; // Enable TLS encryption 'ssl';
        $mail->Port = 587; // TCP port to connect to . 25 for NO . & 587 -ssl;

        //Recipients
        $mail->setFrom('noreply.doasbh@gmail.com', 'Sistem Pengurusan Inventori ICT (e-PII)');
        $mail->addAddress($email); // Add a recipient

        //Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = '[Auto message e-PII] Kata laluan telah ditetapkan semula';
        $mail->Body = '
        Kata laluan telah ditetapkan semula bagi akaun anda 
        <p> No. Kad Pengenalan : ' . sanitizeText($ic) . ' 
        <p>
        <p>Sila tetapkan semula dengan pautan berikut : 
        <p>
        <p>' . sanitizeText($reset_url) . '
        <p>
	<p> <i> Pautan sah untuk 3 jam sahaja </i>
        <p>Sistem Pengurusan Inventori ICT (e-PII)';


        $mail->send();

        echo "<script>alert('Tetapan semula kata laluan bagi ".sanitizeText($ic)." telah dihantar ke emel ".sanitizeEmail($email).". ');
        window.location.href='../user_view.php'</script>";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}