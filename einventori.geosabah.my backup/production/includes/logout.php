<?php
session_start();
session_unset();
session_destroy();

header("location: ../login.php");
exit();

?>


<?php
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');
?>
<?php
apc_clear_cache();
?>

<?php
opcache_reset();
?>
