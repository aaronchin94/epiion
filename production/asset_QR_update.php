<?php
include_once 'includes/db.php';
include_once '../phpqrcode/qrlib.php';

$asset_type = $_POST['asset_type'];
$asset_id = $_POST['asset_id'];
$id = $_POST['id'];
$path = 'qrcode/';
$qrcode = $path . $asset_type . '_qr_' . $id . ".png";
$qrimage = $asset_type . '_qr_' . $id . ".png";

// auto get domain name
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
$domain = $_SERVER['HTTP_HOST'];
$domainName = $protocol . "://" . $domain ."/";    // "https://demo-hubhasil.geosabah.my/";

function generateRandomString($length = 12) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

$qr_id = generateRandomString(12);


switch ($asset_type) {
    case 'Komputer':
        $qrtext = $domainName."production/asset_QR_view.php?asset_id=$asset_id";
        $query = mysqli_query($connection, "UPDATE komputer SET  qrcode='$qrimage', QRId='$qr_id' WHERE k_id=$id");
        break;
    case 'LAN':
        $qrtext = $domainName."production/asset_QR_view.php?asset_id=$asset_id";
        $query = mysqli_query($connection, "UPDATE lan_switch SET  qrcode='$qrimage', QRId='$qr_id' WHERE ls_id=$id");
        break;
    case 'Laptop':
        $qrtext = $domainName."production/asset_QR_view.php?asset_id=$asset_id";
        $query = mysqli_query($connection, "UPDATE laptop SET  qrcode='$qrimage', QRId='$qr_id' WHERE la_id=$id");
        break;
    case 'LCD':
        $qrtext = $domainName."production/asset_QR_view.php?asset_id=$asset_id";
        $query = mysqli_query($connection, "UPDATE lcd SET  qrcode='$qrimage', QRId='$qr_id' WHERE l_id=$id");
        break;
    case 'Monitor':
        $qrtext = $domainName."production/asset_QR_view.php?asset_id=$asset_id";
        $query = mysqli_query($connection, "UPDATE monitor SET  qrcode='$qrimage', QRId='$qr_id' WHERE m_id=$id");
        break;
    case 'Printer':
        $qrtext = $domainName."production/asset_QR_view.php?asset_id=$asset_id";
        $query = mysqli_query($connection, "UPDATE printer SET  qrcode='$qrimage', QRId='$qr_id' WHERE p_id=$id");
        break;
    case 'Scanner':
        $qrtext = $domainName."production/asset_QR_view.php?asset_id=$asset_id";
        $query = mysqli_query($connection, "UPDATE scanner SET  qrcode='$qrimage', QRId='$qr_id' WHERE s_id=$id");
        break;
    case 'Tablet':
        $qrtext = $domainName."production/asset_QR_view.php?asset_id=$asset_id";
        $query = mysqli_query($connection, "UPDATE tablet SET  qrcode='$qrimage', QRId='$qr_id' WHERE t_id=$id");
        break;
    case 'UPS':
        $qrtext = $domainName."production/asset_QR_view.php?asset_id=$asset_id";
        $query = mysqli_query($connection, "UPDATE ups SET  qrcode='$qrimage', QRId='$qr_id' WHERE u_id=$id");
        break;
    case 'AVR':
        $qrtext = $domainName."production/asset_QR_view.php?asset_id=$asset_id";
        $query = mysqli_query($connection, "UPDATE avr SET  qrcode='$qrimage', QRId='$qr_id' WHERE a_id=$id");
        break;
}


if ($query) {
    ?>
    <script>
        alert("Data updated successfully");
    </script>
    <?php
}



QRcode::png($qrtext, $qrcode, 'H', 6, 6);
echo "<img src='" . $qrcode . "'>";
?>