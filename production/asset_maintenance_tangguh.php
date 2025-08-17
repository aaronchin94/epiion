<?php
require_once 'includes/db.php';
include_once 'includes/secure_function.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

function send_asset_email( $maintenance_id, $email_pemohon)
{
    $mail = new PHPMailer(true);
    try {
        //Server settings
        //$mail->SMTPDebug = SMTP::DEBUG_OFF; // Disable debug output
        $mail->isSMTP(); // Send using SMTP
        $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = 'noreply.doasbh@gmail.com'; // SMTP username old noreply.doasbh@gmail.com
        $mail->Password = 'ibqorvjgyhqgnkng'; // old> muizodpcbslaeljn
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; //PHPMailer::ENCRYPTION_SMTPS; //PHPMailer::ENCRYPTION_STARTTSL; // Enable TLS encryption 'ssl';
        $mail->Port = 587; // TCP port to connect to . 25 for NO . & 587 -ssl;

        //Recipients
        $mail->setFrom('noreply.doasbh@gmail.com', 'Sistem Pengurusan Inventori ICT (e-PII)');
        $mail->addAddress($email_pemohon); // Add a recipient

        

        //Content
        $mail->isHTML(true); // Set email format to HTML
        $timestamp = date('Y-m-d H:i:s'); // Format the current date and time
        $mail->Subject = '[TESTING] Status Permohonan Penyelenggaraan ID ' . intval($maintenance_id) . ' - ' . sanitizeText($timestamp);
        $mail->Body = "
        <p>Adalah dimaklumkan bahawa permohonan penyelenggaraan:</p>
        <p>ID Penyelenggaraan: $maintenance_id</p>
        <p>Permohonan Telah <b>Ditangguh</b>.</p>
        <p style='opacity: 0.8'>Sistem Pengurusan Inventori ICT (e-PII)</p>
        ";

        $mail->send();

        //echo "<script>alert('Email Akan Dihantar Ke ' ' Untuk Kelulusan');</script>";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $maintenance_id = mysqli_real_escape_string($connection, $_POST['maintenance_id']);
    $email_pemohon = mysqli_real_escape_string($connection, $_POST['email_pemohon']);

    $sql = "UPDATE maintenance SET maintenance_status = 1 WHERE token = ?";

    $stmt = $connection->prepare($sql);
    $stmt->bind_param("s", $token);


    if ($stmt->execute()) {
        $success = true;
        send_asset_email($maintenance_id, $email_pemohon);
        echo '<script>alert("Permohonan Berjaya Ditangguh!"); window.location.href = "asset_maintenance_view.php";</script>';
    } else {
        $success = false;
    }

    $stmt->close();

} elseif (isset($_GET['id'])) {
    // Store the 'id' parameter value
    $maintenance_id = $_GET['id'];
    $email_pemohon = mysqli_real_escape_string($connection, $_POST['email_pemohon']);

    // Update maintenance status to 2
    $sql = "UPDATE maintenance SET maintenance_status = 1 WHERE maintenance_id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $maintenance_id); // Assuming 'maintenance_id' is an integer

    if ($stmt->execute()) {
        // Update successful
        $success = true;
        send_asset_email($maintenance_id, $email_pemohon);
        echo '<script>alert("Permohonan Berjaya Ditangguh!"); window.location.href = "asset_maintenance_view.php";</script>';
    } else {
        // Update failed
        $success = false;
    }
    $stmt->close();
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Alert and Close Page</title>
    <script type="text/javascript">
        // Define a function to show the alert and close the page
        function showAlertAndRedirect() {
            <?php if ($success): ?>
                alert("Permohonan Penyelenggaraan Telah Ditangguh");
            <?php else: ?>
                alert("Error. Sila Cuba Lagi.");
            <?php endif; ?>
            <?php if ($success_redirect): ?>
                window.location.href = "asset_maintenance_view.php";
            <?php endif; ?>
        }

        window.onload = showAlertAndRedirect;
    </script>
</head>

<body>
</body>

</html>