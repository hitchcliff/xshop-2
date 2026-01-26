<?php


include('./components/header.php');

unset($_SESSION['admin']);
$redirectUrl = ADMIN_URL . "login.php";
header("Location: $redirectUrl");

exit;