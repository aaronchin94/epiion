<?php
require_once '../PhpSpreadSheet/PhpOffice/autoload.php';
require_once 'includes/db.php';
include 'includes/initialization.php';
include_once 'includes/secure_function.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // check if a file was uploaded
  if (!isset($_FILES['excel-file'])) {
    die('No file uploaded');
  }

  // load the uploaded file using PhpSpreadsheet
  $inputFileType = IOFactory::identify($_FILES['excel-file']['tmp_name']);
  $reader = IOFactory::createReader($inputFileType);
  $spreadsheet = $reader->load($_FILES['excel-file']['tmp_name']);
  $worksheet = $spreadsheet->getActiveSheet();

  // initialize arrays for existing and new emails
$existing_emails = array();
$new_emails = array();

// iterate through rows and insert data into staff table
$skipFirstRow = true;

foreach ($worksheet->getRowIterator() as $row) {
    if ($skipFirstRow) {
        $skipFirstRow = false;
        continue; // Skip the first row and move on to the next row
    }

    $email = $worksheet->getCellByColumnAndRow(7, $row->getRowIndex())->getValue();
    $email = mysqli_real_escape_string($connection, $email);

  // check if email already exists in database
  // $result = mysqli_query($connection, "SELECT email FROM staff WHERE email = '$email'");
  $stmt = $conn->prepare("SELECT email FROM staff WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->free_result();
  if ($result->num_rows() > 0) {
    // email already exists, add to existing_emails array
    array_push($existing_emails, $email);
  } else {
    // email doesn't exist, add to new_emails array
    array_push($new_emails, array(
      $nama = strtoupper(mysqli_real_escape_string($connection, $worksheet->getCellByColumnAndRow(1, $row->getRowIndex())->getValue())),
      $ic = mysqli_real_escape_string($connection, $worksheet->getCellByColumnAndRow(2, $row->getRowIndex())->getValue()),
      $jawatan = mysqli_real_escape_string($connection, $worksheet->getCellByColumnAndRow(3, $row->getRowIndex())->getValue()),
      $gred = mysqli_real_escape_string($connection, $worksheet->getCellByColumnAndRow(4, $row->getRowIndex())->getValue()),
      $lokasi = mysqli_real_escape_string($connection, $worksheet->getCellByColumnAndRow(5, $row->getRowIndex())->getValue()),
      $unit = mysqli_real_escape_string($connection, $worksheet->getCellByColumnAndRow(6, $row->getRowIndex())->getValue()),
      $tel = mysqli_real_escape_string($connection, $worksheet->getCellByColumnAndRow(8, $row->getRowIndex())->getValue())
    ));
    
    // build the SQL query and execute it
    $sql = "INSERT INTO staff (name, ic, jawatan, gred, lokasi, unit, email, tel) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmtIS = $conn->prepare($sql);
    $stmtIS->bind_param("ssssssss",$nama, $ic, $jawatan, $gred, $lokasi, $unit, $email, $tel);
    
    if (!$stmtIS->execute()) {
      echo "Error: " . $sql . "<br>" . mysqli_error($connection);
    }
  }

  $stmt->close();
  $stmtIS->close();
}

// create alert messages
$existing_emails_msg = "";
$new_emails_msg = "";

if (!empty($existing_emails)) {
$existing_emails_msg = "Harap maaf, emel berikut telah didaftarkan. :<br>" . implode(", ", $existing_emails);
} else {
$existing_emails_msg = ".<br><br>Tiada emel yang telah didaftarkan.";
}

if (!empty($new_emails)) {
if (!empty($existing_emails)) {
$new_emails_msg = "<br><br>Pendaftaran telah berjaya bagi emel lain. ";
} else {
$new_emails_msg = "<br><br>Pendaftaran telah berjaya bagi semua emel yang dimuatnaik. ";
}
} else {
$new_emails_msg = ".<br><br>Tiada emel yang berjaya didaftarkan.";
}

$alert_msg = "";

if (empty($existing_emails) && !empty($new_emails)) {
$alert_msg .= "Semua emel yang dimuatnaik telah berjaya didaftarkan. ";
} else {
if (!empty($existing_emails_msg)) {
$alert_msg .= $existing_emails_msg . "\n\n";
}

if (!empty($new_emails_msg)) {
$alert_msg .= $new_emails_msg;
}
}

}
?>


<!-- HTML code for the pop-up modal -->
<div id="alert-modal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <p><?php echo sanitizeText($alert_msg); ?></p>
    <button align-center id="ok-btn">OK</button>
  </div>
</div>

<!-- CSS code for the modal -->
<!-- CSS code for the modal using Bootstrap -->
<style>
  /* The modal */
  .modal {
    display: none;
    position: fixed;
    z-index: 1050;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    background-color: rgba(0, 0, 0, 0.5);
  }

  /* Modal content */
  .modal-content {
    position: relative;
    top: 50%;
    transform: translateY(-50%);
    background-color: #fff;
    border-radius: 0.3rem;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    margin: 0 auto;
    padding: 1rem;
    max-width: 500px;
  }

  /* The Close button */
  .close {
    position: absolute;
    top: 0.5rem;
    right: 0.5rem;
    font-size: 1.5rem;
    font-weight: 700;
    color: #000;
    opacity: 0.5;
  }

  .close:hover,
  .close:focus {
    color: #000;
    opacity: 1;
    text-decoration: none;
    cursor: pointer;
  }
  
  /* Button */
  #ok-btn {
    margin-top: 1rem;
    padding: 0.5rem 1rem;
    font-size: 1rem;
    font-weight: 600;
    border-radius: 0.3rem;
    color: #fff;
    background-color: #007bff;
    border: none;
    cursor: pointer;
  }
  
  #ok-btn:hover {
    background-color: #0062cc;
  }
  
</style>


<!-- JavaScript code for the modal -->
<script>
  // Get the modal
  var modal = document.getElementById("alert-modal");

  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName("close")[0];

  // Get the OK button
  var okBtn = document.getElementById("ok-btn");

  // When the user clicks on the OK button, redirect to staff_register.php
  okBtn.onclick = function() {
    window.location.href = 'staff_register.php';
  }

  // When the user clicks on <span> (x), close the modal and redirect to staff_register.php
  span.onclick = function() {
    modal.style.display = "none";
    window.location.href = 'staff_register.php';
  }

  // Display the modal with the alert message
  modal.style.display = "block";
</script>

  