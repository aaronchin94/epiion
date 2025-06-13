<?php

require_once 'includes/db.php';

// Check if QR ID is provided and not empty
if (isset($_POST['QRId']) && !empty($_POST['QRId'])) {
    // Sanitize input to prevent SQL injection
    $QRId = mysqli_real_escape_string($connection, $_POST['QRId']);

    // Query to get asset ID based on QR ID
    $query = "SELECT asset_id FROM komputer WHERE QRId = '$QRId'
          UNION
          SELECT asset_id FROM laptop WHERE QRId = '$QRId'
          UNION
          SELECT asset_id FROM avr WHERE QRId = '$QRId'
          UNION
          SELECT asset_id FROM lan_switch WHERE QRId = '$QRId'
          UNION
          SELECT asset_id FROM lcd WHERE QRId = '$QRId'
          UNION
          SELECT asset_id FROM monitor WHERE QRId = '$QRId'
          UNION
          SELECT asset_id FROM printer WHERE QRId = '$QRId'
          UNION
          SELECT asset_id FROM scanner WHERE QRId = '$QRId'
          UNION
          SELECT asset_id FROM tablet WHERE QRId = '$QRId'
          UNION
          SELECT asset_id FROM ups WHERE QRId = '$QRId'";

          

    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        // Fetch the asset ID
        $asset = mysqli_fetch_assoc($result);
        $asset_id = $asset['asset_id'];

        // Redirect to asset view page with asset ID parameter
        header("Location: http://localhost/einventori.geosabah.my/production/asset_QR_view.php?asset_id=$asset_id");
        exit; // Stop further execution
    } else {
        // Handle case when no asset found for the provided QR ID
        echo "Asset not found for the provided QR ID";
    }
}

