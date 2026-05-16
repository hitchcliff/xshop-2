<?php

include('./components/header.php');
include('./components/nav.php');
include('./components/sidebar.php');

if (!isset($_SESSION['admin'])) {

    $redirectUrl = ADMIN_URL . "login.php";

    header("Location: $redirectUrl");
}


// product
$id = $_REQUEST['id'];
$url = ADMIN_URL . 'product-category-view.php';

$sql = "DELETE FROM product_categories WHERE id='$id'";
$result = $pdo->query($sql);

if ($result->rowCount() > 0) {
    $success_message = "Deleted successfully";
    $_SESSION['success_message'] = $success_message;
} else {
    $error_message = "Error deleting product id: " . $id;
    $_SESSION['error_message'] = $error_message;
}


header("Location: $url");
exit;