<?php
// filepath: toko-buah/includes/logout.php
session_start();
session_destroy();
header("Location: ../pages/login.php");
exit();
?>