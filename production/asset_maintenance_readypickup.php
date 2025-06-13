<?php
require_once "includes/db.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';


function send_asset_email($workID, $maintenance_id, $email_pemohon)
{
    $mail = new PHPMailer(true);
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
        $mail->addAddress($email_pemohon); // Add a recipient

        

        //Content
        $mail->isHTML(true); // Set email format to HTML
        $timestamp = date('Y-m-d H:i:s'); // Format the current date and time
        $mail->Subject = '[TESTING] Status Permohonan Penyelenggaraan ID ' . $maintenance_id . ' - ' . $timestamp;
        $mail->Body = "
        <p>Adalah dimaklumkan bahawa kerja penyelenggaraan:</p>
        <p>ID Penyelenggaraan: $maintenance_id</p>
        <p>ID Kerja: $workID</p>
        <p>Penyelenggaraan Telah <b>SIAP</b>.</p>
        <p>Sila Tuntut Aset Anda.</p>
        <p style='opacity: 0.8'>Sistem Pengurusan Inventori ICT (e-PII)</p>
        ";

        $mail->send();

        //echo "<script>alert('Email Akan Dihantar Ke ' ' Untuk Kelulusan');</script>";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if remark and work ID are set and not empty
    if (isset($_POST["remark"]) && !empty($_POST["remark"]) && isset($_POST["work_id"]) && !empty($_POST["work_id"])) {
        // Get the remark and work ID from the form submission
        $remark = $_POST["remark"];
        $workID = $_POST["work_id"];
        $maintenance_id = $_POST["maintenance_id"];
        $email_pemohon = $_POST["email_pemohon"];

        // Update the record in the database
        $query = "UPDATE maintenance_work SET remarks = '$remark', work_status = 1, completion_date = NOW() WHERE work_id = '$workID'";


        $result = mysqli_query($connection, $query);

        if ($result) {
            // Success message
            echo "Remark updated successfully.";
            send_asset_email($workID, $maintenance_id, $email_pemohon);
        } else {
            // Error message
            echo "Error: " . mysqli_error($connection);
        }
    } else {
        // Remark or work ID is not set or empty
        echo "Remark and work ID are required.";
    }
} else {
    // If the form is not submitted via POST method, redirect or handle accordingly
    echo "Invalid request method.";
}
?>
