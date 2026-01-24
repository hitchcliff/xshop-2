<?php

$dbhost = 'localhost';
$dbname = "xshop-2-admin";
$dbuser = "root";
$dbpass = "";

try {
    $pdo = new PDO("mysql:host={$dbhost};dbname={$dbname}", $dbuser, $dbpass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection error: " . $e->getMessage();
}

define("BASE_URL", "http://localhost/xshop-2-admin/");
define("ADMIN_URL", BASE_URL . "admin/");

define("SMTP_HOST", "sandbox.smtp.mailtrap.io");
define("SMTP_PORT", "587");
define("SMTP_USERNAME", "37d7397e075dd4");
define("SMTP_PASSWORD", "479204d25cd0b0");
