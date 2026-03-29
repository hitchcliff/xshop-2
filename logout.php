<?php
include('./templates/header.php');

unset($_SESSION['customer']);
$redirectUrl = BASE_URL . "account-signin.php";
header("Location: $redirectUrl");

exit;