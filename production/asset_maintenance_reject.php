<?php
require_once 'includes/db.php';
include_once 'includes/secure_function.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

function send_asset_email($maintenance_id, $email_pemohon)
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
        $mail->addAddress(sanitizeEmail($email_pemohon)); // Add a recipient



        //Content
        $mail->isHTML(true); // Set email format to HTML
        $timestamp = date('Y-m-d H:i:s'); // Format the current date and time
        $mail->Subject = '[TESTING] Status Permohonan Penyelenggaraan ID ' . $maintenance_id . ' - ' . $timestamp;
        $mail->Body = "
        <p>Adalah dimaklumkan bahawa permohonan penyelenggaraan:</p>
        <p>ID Penyelenggaraan: ".intval($maintenance_id)."</p>
        <p>Permohonan Telah <b>Ditolak</b>.</p>
        <p style='opacity: 0.8'>Sistem Pengurusan Inventori ICT (e-PII)</p>
        ";

        $mail->send();

        //echo "<script>alert('Email Akan Dihantar Ke ' ' Untuk Kelulusan');</script>";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

if (isset ($_POST['token'])) {
    $token = $_POST['token'];
    $maintenance_id = mysqli_real_escape_string($connection, $_POST['maintenance_id']);
    $email_pemohon = mysqli_real_escape_string($connection, $_POST['email_pemohon']);
    $rejection_reason = $_POST['rejection_reason'];

    $sql = "UPDATE maintenance SET maintenance_status = 3, rejection_reason = ? WHERE maintenance_id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("si", $rejection_reason, $maintenance_id); // Assuming 'maintenance_id' is an integer


    if ($stmt->execute()) {
        $success = true;
        send_asset_email($maintenance_id, $email_pemohon);
    } else {
        $success = false;
    }

    $stmt->close();

} elseif (isset ($_POST['id'])) {
    // Store the 'id' parameter value
    $maintenance_id = $_POST['id'];
    $email_pemohon = mysqli_real_escape_string($connection, $_POST['email_pemohon']);
    $rejection_reason = $_POST['rejection_reason'];

    $sql = "UPDATE maintenance SET maintenance_status = 3, rejection_reason = ? WHERE maintenance_id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("si", $rejection_reason, $maintenance_id); // Assuming 'maintenance_id' is an integer

    if ($stmt->execute()) {
        // Update successful
        $success = true;
        send_asset_email($maintenance_id, $email_pemohon);
    } else {
        // Update failed
        $success = false;
    }
    $stmt->close();
}
