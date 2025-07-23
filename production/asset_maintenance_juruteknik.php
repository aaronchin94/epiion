<?php

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
        $mail->Password = 'idhqvrjnrwamlbbt'; // old> muizodpcbslaeljn
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; //PHPMailer::ENCRYPTION_SMTPS; //PHPMailer::ENCRYPTION_STARTTSL; // Enable TLS encryption 'ssl';
        $mail->Port = 587; // TCP port to connect to . 25 for NO . & 587 -ssl;

        //Recipients
        $mail->setFrom('noreply.doasbh@gmail.com', 'Sistem Pengurusan Inventori ICT (e-PII)');
        $mail->addAddress(sanitizeEmail($email_pemohon)); // Add a recipient

        

        //Content
        $mail->isHTML(true); // Set email format to HTML
        $timestamp = date('Y-m-d H:i:s'); // Format the current date and time
        $mail->Subject = '[TESTING] Status Permohonan Penyelenggaraan ID ' . sanitizeText($maintenance_id) . ' - ' . sanitizeText($timestamp);
        $mail->Body = "
        <p>Adalah dimaklumkan bahawa permohonan penyelenggaraan:</p>
        <p>ID Penyelenggaraan: ".intval($maintenance_id)."</p>
        <p>Permohonan Telah Diluluskan.</p>
        <p>Sila Hantar Aset Kepada Lokasi Juruteknik Dalam Pautan Berikut:</p>
        <p style='opacity: 0.8'>Sistem Pengurusan Inventori ICT (e-PII)</p>
        ";

        $mail->send();

        //echo "<script>alert('Email Akan Dihantar Ke ' ' Untuk Kelulusan');</script>";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}



if (isset($_POST["technician_id"])) { 
    // Establishing database connection
    include 'includes/db.php';

    // Prepare a statement
    $stmt = $connection->prepare("INSERT INTO maintenance_work 
        (maintenance_id, technician_id, assignment_date, work_status) 
        VALUES (?, ?, ?, ?)");

    // Check if the statement preparation was successful
    if (!$stmt) {
        echo "Error in preparing statement: " . $connection->error;
        exit();
    }

    // Taking all values from the form data
    $maintenance_id = mysqli_real_escape_string($connection, $_POST['maintenance_id']); 
    $technician_id = mysqli_real_escape_string($connection, $_POST['technician_id']);
    $assignment_date = date('Y-m-d');
    $work_status = 0;
    // EMAIL IS DEFAULT TO DAISY ONLY!!!
    $email_pemohon = mysqli_real_escape_string($connection, $_POST['email_pemohon']);
    // echo "oii".$maintenance_id."--".$technician_id."--".$assignment_date."--".$work_status."--".$email_pemohon."--";
    // Bind parameters
    $stmt->bind_param("ssss", $maintenance_id, $technician_id, $assignment_date, $work_status);
    send_asset_email( $maintenance_id, $email_pemohon);

    // Execute the statement        window.location.href='asset_maintenance_view.php'
    if ($stmt->execute()) {
        echo "<script>
                    alert('Pemberian Tugas Berjaya.');
                    window.location.href = 'asset_maintenance_view.php';
                </script>";
    } else {
        echo "ERROR: Hush! Sorry " . $stmt->error;
    }

    // Close statement
    $stmt->close();

    // Close connection
    mysqli_close($connection);
} else {
    header("Location: ../index.php");
}
?>