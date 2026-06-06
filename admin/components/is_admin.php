<?php
if (!isset($_SESSION['admin'])) {

    $redirectUrl = ADMIN_URL . "login.php";

    header("Location: $redirectUrl");
}