<?php
$site_title = "Rechnung";
include 'inc/header.inc.php';
$user = check_user();
if (!$_SESSION['cart']) {
  header("Location:shop_form.php");
}
?>
