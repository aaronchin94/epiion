<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
include 'includes/db.php';
include 'includes/session.php';
include_once 'secure_function.php';

function send_maintenance_email($token, $asset_id, $row)
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
        $mail->addAddress('aarondalejchin@gmail.com'); // Add a recipient
        //$mail->addCC('kurohx@gmail.com');


        //Content
        $mail->isHTML(true); // Set email format to HTML
        $timestamp = date('Y-m-d H:i:s'); // Format the current date and time
        $mail->Subject = '[Auto message e-PII] Permohonan Penyelenggaraan Aset ID ' . intval($asset_id) . ' - ' . sanitizeText($timestamp);
        $mail->Body = "
        <p>Adalah dimaklumkan bahawa permohonan diminta oleh:</p>
        <p>Nama Penuh: {$row['name']}</p>
        <p>Bahagian/Seksyen/Unit: {$row['unit']}</p>
        <p>Tarikh: $timestamp</p>
        <p>No Telefon: {$row['tel']}</p>
        <br>
        <p>Sila luluskan/tolak permohonan penyelenggaraan menggunakan pautan berikut:</p>
        <p><a href='http://localhost/einventori.geosabah.my/production/asset_maintenance_details.php?token=".sanitizeText($token)."'>Lihat Permohonan Penyelenggaraan</a></p>
        <p style='opacity: 0.8'>Sistem Pengurusan Inventori ICT (e-PII)</p>
        ";

         $mail->send();

        //echo "<script>alert('Email Akan Dihantar Ke ' ' Untuk Kelulusan');</script>";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

if (isset($_POST["maintenance_type"])) {
    // Establishing database connection
    include 'includes/db.php';


    // File upload handling
    $allowedtypes = ['image/jpeg', 'image/png', 'application/pdf'];
    $allowedextensions = ['jpg', 'jpeg', 'png', 'pdf'];
    $maxFileSize = 2 * 1024 * 1024; // 2 MB
    $uploadedFiles = [];

    if (!empty($_FILES['maintenance_files']['name'][0])) {
        for ($i = 0; $i < count($_FILES['maintenance_files']['name']); $i++) {
            $filename = basename($_FILES['maintenance_files']['name'][$i]);
            $uploadfile = $_FILES['maintenance_files']['tmp_name'][$i];
            $targetpath = "uploads/" . $filename;

            // Check file size
            $fileSize = $_FILES['maintenance_files']['size'][$i];
            if ($fileSize > $maxFileSize) {
                echo "<script>alert('Saiz Fail \"$filename\" terlalu besar. Saiz maksimum adalah 2 MB.'); </script>";
                continue; // Skip further processing of this file
            }

            // Check file type
            $fileType = $_FILES['maintenance_files']['type'][$i];
            if (!in_array($fileType, $allowedtypes)) {
                continue;
            }

            // Check file extension
            $fileExtension = pathinfo($filename, PATHINFO_EXTENSION);
            if (!in_array(strtolower($fileExtension), $allowedextensions)) {
                continue;
            }

            if (move_uploaded_file($uploadfile, $targetpath)) {
                $uploadedFiles[] = $filename;
            }
        }
    }


    // Prepare a statement
    $stmt = $connection->prepare("INSERT INTO maintenance 
        (staff_id, asset, asset_id, model, serial, 
        maintenance_type, maintenance_priority, maintenance_description, maintenance_files, maintenance_reason, 
        maintenance_date, RequestedBy, InsertedAt, UpdatedAt) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?)");  // token, tokenexpiry, 

    // Bind parameters
    $stmt->bind_param("ssssssssssssss", $staff_id, $asset_type, $asset_id, $model, $serial, $maintenance_type, $maintenance_priority, $maintenance_description, $maintenance_files, $maintenance_reason, $maintenance_date, $RequestedBy, $InsertedAt, $UpdatedAt);  // $token, $tokenexpiry, 


    // Taking all values from the form data
    $staff_id = mysqli_real_escape_string($connection, $_POST['staff_id']);
    $asset_type = mysqli_real_escape_string($connection, $_POST['asset_type']);
    $asset_id = mysqli_real_escape_string($connection, $_POST['asset_id']);
    $model = mysqli_real_escape_string($connection, $_POST['model']);
    $serial = mysqli_real_escape_string($connection, $_POST['serial']);
    $maintenance_type = mysqli_real_escape_string($connection, $_POST['maintenance_type']);
    $maintenance_priority = mysqli_real_escape_string($connection, $_POST['maintenance_priority']);
    $maintenance_description = mysqli_real_escape_string($connection, $_POST['maintenance_description']);
    $maintenance_files = implode(', ', $uploadedFiles); // Combining uploaded file names into a string
    $maintenance_reason = mysqli_real_escape_string($connection, $_POST['maintenance_reason']);
    $maintenance_date = mysqli_real_escape_string($connection, $_POST['maintenance_date']);
    $RequestedBy = $row['id'];
    $token = bin2hex(random_bytes(16));
    $tokenexpirys = date('Y-m-d H:i:s', strtotime('+1 week'));
    $InsertedAt = date('Y-m-d H:i:s');
    $UpdatedAt = date('Y-m-d H:i:s');

    //For Email Purpose
    send_maintenance_email($token, $asset_id, $row);




    // Execute the statement 
    if ($stmt->execute()) {
        // get the last id, insert into maintenance_token table
        $getLast_id = $stmt->insert_id;
        $lid_ins = "INSERT INTO `maintenance_token`(`maintenance_id`, `token`, `tokenexpiry`) VALUES (?, ?, ?)";
        $stmt1 = $connection->prepare($lid_ins);
        $stmt1->bind_param("iss", $getLast_id, $token, $tokenexpirys);
        $stmt1->execute();
        echo "<script>alert('Permohonan Berjaya. Email Telah Dihantar Ke Pelulus Untuk Kelulusan'); window.location.href='asset_maintenance_view.php'</script>";
        $stmt1->close();
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
