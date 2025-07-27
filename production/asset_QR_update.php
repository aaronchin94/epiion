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
        $query = $connection->prepare("UPDATE komputer SET  qrcode=?, QRId=? WHERE k_id=?");
        break;
    case 'LAN':
        $qrtext = $domainName."production/asset_QR_view.php?asset_id=$asset_id";
        $query = $connection->prepare("UPDATE lan_switch SET  qrcode=?, QRId=? WHERE ls_id=?");
        break;
    case 'Laptop':
        $qrtext = $domainName."production/asset_QR_view.php?asset_id=$asset_id";
        $query = $connection->prepare("UPDATE laptop SET  qrcode=?, QRId=? WHERE la_id=?");
        break;
    case 'LCD':
        $qrtext = $domainName."production/asset_QR_view.php?asset_id=$asset_id";
        $query = $connection->prepare("UPDATE lcd SET  qrcode=?, QRId=? WHERE l_id=?");
        break;
    case 'Monitor':
        $qrtext = $domainName."production/asset_QR_view.php?asset_id=$asset_id";
        $query = $connection->prepare("UPDATE monitor SET  qrcode=?, QRId=? WHERE m_id=?");
        break;
    case 'Printer':
        $qrtext = $domainName."production/asset_QR_view.php?asset_id=$asset_id";
        $query = $connection->prepare("UPDATE printer SET  qrcode=?, QRId=? WHERE p_id=?");
        break;
    case 'Scanner':
        $qrtext = $domainName."production/asset_QR_view.php?asset_id=$asset_id";
        $query = $connection->prepare("UPDATE scanner SET  qrcode=?, QRId=? WHERE s_id=?");
        break;
    case 'Tablet':
        $qrtext = $domainName."production/asset_QR_view.php?asset_id=$asset_id";
        $query = $connection->prepare("UPDATE tablet SET  qrcode=?, QRId=? WHERE t_id=?");
        break;
    case 'UPS':
        $qrtext = $domainName."production/asset_QR_view.php?asset_id=$asset_id";
        $query = $connection->prepare("UPDATE ups SET  qrcode=?, QRId=? WHERE u_id=?");
        break;
    case 'AVR':
        $qrtext = $domainName."production/asset_QR_view.php?asset_id=$asset_id";
        $query = $connection->prepare("UPDATE avr SET  qrcode=?, QRId=? WHERE a_id=?");
        break;
}

$query->bind_param("ssi", $qrimage, $qr_id, $id);
if ($query->execute()) {
    ?>
    <script>
        alert("Data updated successfully");
    </script>
    <?php
}



QRcode::png($qrtext, $qrcode, 'H', 6, 6);
echo "<img src='" . $qrcode . "'>";
?>