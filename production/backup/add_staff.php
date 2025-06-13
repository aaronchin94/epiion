<?php
require_once '../PhpSpreadSheet/PhpOffice/autoload.php';


require_once 'includes/db.php';

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

  // iterate through rows and insert data into staff table
$skipFirstRow = true;
foreach ($worksheet->getRowIterator() as $row) {
  // skip the first row
  if ($skipFirstRow) {
    $skipFirstRow = false;
    continue;
  }

  $nama = $worksheet->getCellByColumnAndRow(1, $row->getRowIndex())->getValue();
  $ic = $worksheet->getCellByColumnAndRow(2, $row->getRowIndex())->getValue();
  $jawatan = $worksheet->getCellByColumnAndRow(3, $row->getRowIndex())->getValue();
  $gred = $worksheet->getCellByColumnAndRow(4, $row->getRowIndex())->getValue();
  $lokasi = $worksheet->getCellByColumnAndRow(5, $row->getRowIndex())->getValue();
  $unit = $worksheet->getCellByColumnAndRow(6, $row->getRowIndex())->getValue();
  $email = $worksheet->getCellByColumnAndRow(7, $row->getRowIndex())->getValue();
  $tel = $worksheet->getCellByColumnAndRow(8, $row->getRowIndex())->getValue();

    // escape the values to prevent SQL injection attacks
    $nama = mysqli_real_escape_string($connection, $nama);
    $ic = mysqli_real_escape_string($connection, $ic);
    $jawatan = mysqli_real_escape_string($connection, $jawatan);
    $gred = mysqli_real_escape_string($connection, $gred);
    $lokasi = mysqli_real_escape_string($connection, $lokasi);
    $unit = mysqli_real_escape_string($connection, $unit);
    $email = mysqli_real_escape_string($connection, $email);
    $tel = mysqli_real_escape_string($connection, $tel);

    // build the SQL query and execute it
    $sql = "INSERT INTO staff (name, ic, jawatan, gred, lokasi, unit, email, tel) VALUES ('$nama', '$ic', '$jawatan', '$gred', '$lokasi', '$unit', '$email', '$tel')";
    if (!mysqli_query($connection, $sql)) {
        echo "Error: " . $sql . "<br>" . mysqli_error($connection);
    }
  }

  // redirect back to the main page
  echo "<script>alert('Senarai kakitangan telah berjaya dimuat naik'); window.location='staff_register.php';</script>";
  exit();
}
?>
