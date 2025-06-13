<?php
require_once 'includes/db.php';
include "includes/functions.php";

session_start();
$asset_id = $_POST['asset_id'];


if (!empty($_SESSION['username'])) {
    asset_redirect($asset_id);
} else {
    header("Location: login.php?asset_id=$asset_id");
}
exit;
?>