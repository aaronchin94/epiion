<?php
// Include the QR library
include '../phpqrcode/qrlib.php';

// Data to encode
$text = "https://serena.dowebb.com";

// Directory to save QR code image
$path = 'qrcode/';
$fileName = 'serenadowebb.png';
$file = $path . $fileName;

// Create directory if not exists
if (!file_exists($path)) {
    mkdir($path, 755, true);
}

// Generate the QR code and save to file
QRcode::png($text, $file, 'H', 6);

// Display the QR code image (browser path)
echo '<h3>Generated QR Code:</h3>';
echo '<img src="' . $path . $fileName . '" alt="QR Code">';?>
